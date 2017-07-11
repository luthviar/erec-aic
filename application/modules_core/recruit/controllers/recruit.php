<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Recruit extends CI_Controller {

	public $tabel = 'tp_request';
	public $field = 'request_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if($this->session->userdata('authority_id') == 6) { 
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
				$this->session->set_userdata('nav_active', 'recruit');
				
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
		$data['list'] = $this->m_global->get_by_id_order_status_arr('tp_request', 'request_status', array(4, 8), 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		
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
            get_redirecting('recruit');
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
				$status = $this->m_request->get_status_by_id($id);
				if(($status == 4) || ($status == 8)) {
					// set view
					$this->load->view('../v_header');
					$this->load->view('../v_top');
					$this->load->view('v_edit', $data);
					$this->load->view('../v_bottom');
					$this->load->view('../v_footer');
				}
				else {	
					get_redirecting('recruit');
				}
			}
		}
    }
	
	function update_data() {
		// get from post
		$id			 = simple_decrypt($this->input->post('id'));
		$status	 	 = $this->input->post('status');
		$description = $this->input->post('note');

		// set array
		$data = array(
			'request_status'			=> $status,
			'recruitment_date'			=> get_ymd(),
			'recruitment_time'			=> get_his(),
			'recruitment_description'	=> (($description == "")?NULL:nl2br($description)),
			'recruitment_id'			=> $this->session->userdata('user_id')
		);
		
		// cek result
		$result = $this->m_crud->update($this->tabel, $this->field, $data, $id); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			// send email
			$this->load->helper('sending_email');
			$this->load->helper('format_email');
				
			// get SM
			$area = $this->m_request->get_area_by_id($id);
			if($area == 1) {
				$authority 		= 4;
				$authority_um 	= 5;
			}
			else {
				$authority 		= 2;
				$authority_um 	= 3;
			}
			
			$user 		= $this->m_global->get_by_id_order('tm_user', 'authority_id', $authority, 'area_id', $area, 'user_id', 'ASC');
			$user_um 	= $this->m_global->get_by_id_order('tm_user', 'authority_id', $authority_um, 'area_id', $area, 'user_id', 'ASC');
			$user_rec 	= $this->m_global->get_by_id_order('tm_user', 'authority_id', 6, 'area_id', $area, 'user_id', 'ASC');
			$emhc 		= $this->m_global->get_by_id_order('tm_user', 'authority_id', 5, 'area_id', 1, 'user_id', 'ASC');
		
			$arr_email = [];
			foreach($user as $row) {
				$arr_email[] = $row->user_email;
			}
			
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
			
			$format	= format_request($id);
			if($arr_email != "") {
				$sending_email = sending_emailnya(2, $arr_email, $format);		
			}
			
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('recruit');
    }
	
	function update_detail_data() {
		// get from post
		$id		= $this->input->post('detail');
		$nik	= $this->input->post('nik');
		$name	= $this->input->post('name');
		
		// set array
		$data = array(
			'nik'	=> $nik,
			'name'	=> $name
		);
		
		// cek result
		$id_nya = $this->m_request->get_id_by_detail($id);
		$result = $this->m_crud->update('td_request', 'id', $data, $id); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('recruit/edit-data/'. simple_encrypt($id_nya));
    }
}   