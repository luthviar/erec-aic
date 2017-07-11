<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Apply extends CI_Controller {

	public $tabel = 'tp_request';
	public $field = 'request_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('request/m_request');
				$this->load->model('man_power/m_manpower');
				$this->load->model('master/m_position');
				$this->load->model('setting/m_area');
				$this->load->model('user/m_user');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'apply');
				
				// set sub active
				$this->session->unset_userdata('sub_active');
			}
			else {
				get_redirecting('error');
			}
		}
		else {
			get_redirecting('login');
		}
	}

    function index() {
		// set data
		$data['list'] = $this->m_global->get_by_id_order('tp_request', 'request_status', 5, 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function edit_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(3));
		
		// cek id
		if($id == "") {
            get_redirecting('apply');
        } 
        else {
			// set data
			$data['detail'] = $this->m_global->get_by_id($this->tabel, $this->field, $id);
			
			// cek resut
			if($data['detail'] == null) {
                get_redirecting('error');
            }
			else {
				// cek status
				if($this->m_request->get_status_by_id($id) != 5) {
					get_redirecting('apply');
				}
				
				// set view
				$this->load->view('../v_header');
				$this->load->view('../v_top');
				$this->load->view('v_edit', $data);
				$this->load->view('../v_bottom');
				$this->load->view('../v_footer');
			}
		}
    }
	
	function update_data() {
		// get from post
		$id_nya	= simple_decrypt($this->input->post('id'));
		$check	= $this->input->post('check');
		
		for($i=0; $i<count($check); $i++) {
			// set join date
			$id = simple_decrypt($check[$i]);
			if($id != "") {
				$this->m_global->set_status('td_request', 'id', $id, 'join', get_ymd());
				
				// set status process
				$mpp 	= $this->m_request->get_mpp_by_id($id_nya);
				$out 	= $this->m_manpower->get_process_in_by_detail($mpp);
				$count  = doubleval($out) - 1; 
				$this->m_global->set_status('td_manpower', 'id', $mpp, 'process_in', $count);
			
				$actual = $this->m_manpower->get_actual_by_detail($mpp);
				$count 	= doubleval($actual) + 1; 
				$this->m_global->set_status('td_manpower', 'id', $mpp, 'actual', $count);
			}
		}
		
		$valid = 1;
		$detail = $this->m_global->get_by_id('td_request', 'request_id', $id_nya);
		foreach($detail as $row) {
			if($row->join == "") {
				$valid = 0;
			}
		}
		
		// cek result
		if($valid == 1) { 
			// set array
			$data = array(
				'request_status'	 => 7,
				'closed_date'		 => get_ymd(),
				'closed_time'		 => get_his(),
				'closed_description' => 'Closed',
				'closed_id'			 => $this->session->userdata('user_id')
			);
			
			$result = $this->m_crud->update($this->tabel, $this->field, $data, $id_nya);
		}
		else {
			$result = $this->m_global->set_status($this->tabel, $this->field, $id_nya, 'request_status', 8);
		}
		
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			// send email
			$this->load->helper('sending_email');
			$this->load->helper('format_email');
				
			// get SM
			$area = $this->m_request->get_area_by_id($id_nya);
			if($area == 1) {
				$authority_um 	= 5;
			}
			else {
				$authority_um 	= 3;
			}
			
			$user_um 	= $this->m_global->get_by_id_order('tm_user', 'authority_id', $authority_um, 'area_id', $area, 'user_id', 'ASC');
			$user_rec 	= $this->m_global->get_by_id_order('tm_user', 'authority_id', 6, 'area_id', $area, 'user_id', 'ASC');
			$emhc 		= $this->m_global->get_by_id_order('tm_user', 'authority_id', 5, 'area_id', 1, 'user_id', 'ASC');
		
			$arr_email = [];
			foreach($user_um as $row) {
				$arr_email[] = $row->user_email;
			}
			
			if($area != 1) {
				foreach($emhc as $row) {
					$arr_email[] = $row->user_email;
				}
			}
			
			foreach($user_rec as $row) {
				$arr_email[] = $row->user_email;
			}
			
			$format	= format_request($id_nya);
			if($arr_email != "") {
				$sending_email = sending_emailnya(2, $arr_email, $format);		
			}
			
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('apply');
    }
}   