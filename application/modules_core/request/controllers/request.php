<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Request extends CI_Controller {

	public $tabel = 'tp_request';
	public $field = 'request_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 4)) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('m_request');
				$this->load->model('man_power/m_manpower');
				$this->load->model('master/m_position');
				$this->load->model('user/m_user');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'request');
				
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
		$data['list'] = $this->m_global->get_by_id_and_order('tp_request', 'request_status', 0, 'request_date', 'DESC');
		
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
            get_redirecting('request');
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
				if($this->m_request->get_status_by_id($id) != 0) {
					get_redirecting('request');
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
		$id		= simple_decrypt($this->input->post('id'));
		$status	= $this->input->post('status');
		
		// cek result
		$result = $this->m_global->set_status($this->tabel, $this->field, $id, 'request_status', $status); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			// set status process
			$mpp 	= $this->m_request->get_mpp_by_id($id);
			$temp 	= $this->m_request->get_count_by_id($id);
			$out 	= $this->m_manpower->get_process_in_by_detail($mpp);
			$count  = doubleval($out) - doubleval($temp); 
				
			if($status == 6) {	
				$this->m_global->set_status('td_manpower', 'id', $mpp, 'process_in', $count);
			}
			else {
				// set status process
				if($this->session->userdata('authority_id') == 3) {
					
				}
			}	
			
			// send email
			$this->load->helper('sending_email');
			$this->load->helper('format_email');
				
			// get UM
			$area = $this->m_request->get_area_by_id($id);
			if($area == 1) {
				$authority = 5;
			}
			else {
				$authority = 3;
			}
			
			$user = $this->m_global->get_by_id_order('tm_user', 'authority_id', $authority, 'area_id', $area, 'user_id', 'ASC');
			foreach($user as $row) {
				$email 	= $row->user_email;
				$format	= format_request($id);
				
				if($email != "") {
					$sending_email = sending_emailnya(2, $email, $format);		
				}
			}
			
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('request');
    }
	
    function man_power() {
		// get data
		$id = simple_decrypt($this->uri->segment(3));
		
		// cek id
		if($id == "") {
            get_redirecting('dashboard');
        } 
        else {
			// set data
			$data['detail'] = $this->m_global->get_by_id('td_manpower', 'id', $id);
			
			// cek resut
			if($data['detail'] == null) {
                get_redirecting('error');
            }
			else {
				// cek status
				$count = get_available(1, $id);
				if($count == 0) {
					get_redirecting('dashboard');
				}
				
				// set data
				$data['mpp'] 	= $id;
				$data['count']	= $count;
				
				// set view
				$this->load->view('../v_header');
				$this->load->view('../v_top');
				$this->load->view('v_manpower', $data);
				$this->load->view('../v_bottom');
				$this->load->view('../v_footer');
			}
		}
    }
	
	function insert_data() {
		// get from post
		$id				= simple_decrypt($this->input->post('id'));
		$count			= $this->input->post('count');
		$description	= $this->input->post('description');
		$overdue		= $this->input->post('date_start');

		// cek status
		if(get_available(1, $id) == 0) {
			get_redirecting('dashboard');
		}
		
		$code = generate_code(1);

		// set array
		if($this->session->userdata('authority_id') == 3) {
			$data = array(
				'request_overdue'		=> convert_to_ymd($overdue),
				'request_date'			=> get_ymd(),
				'request_time'			=> get_his(),
				'request_description'	=> (($description == "")?NULL:nl2br($description)),
				'request_code'			=> $code,
				'request_count'			=> $count,
				'mpp_id'				=> $id,
				'area_id'				=> $this->session->userdata('area_id'),
				'prepared_id'			=> $this->session->userdata('user_id'),
				'last_user'				=> $this->session->userdata('user_id'),
				'approval1_date'		=> get_ymd(),
				'approval1_time'		=> get_his(),
				'approval1_description'	=> NULL,
				'approval1_id'			=> $this->session->userdata('user_id')
			);
		}
		else {
			$data = array(
				'request_overdue'		=> convert_to_ymd($overdue),
				'request_date'			=> get_ymd(),
				'request_time'			=> get_his(),
				'request_description'	=> (($description == "")?NULL:nl2br($description)),
				'request_code'			=> $code,
				'request_count'			=> $count,
				'mpp_id'				=> $id,
				'area_id'				=> $this->session->userdata('area_id'),
				'prepared_id'			=> $this->session->userdata('user_id')
			);
		}
		
		// cek result
		$result = $this->m_crud->insert_id($this->tabel, $data);
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('insert', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			// insert detail
			for($i=0; $i<$count; $i++) {
				// set array
				$detail = array(
					'request_id' => $result
				);
				
				$this->m_crud->insert('td_request', $detail);
			}
			
			// set status process
			$this->m_global->set_status('td_manpower', 'id', $id, 'process_in', $count);
			
			$this->session->set_flashdata('message', get_notification('insert', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('request/edit-data/'. simple_encrypt($result));
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
		
		get_redirecting('request/edit-data/'. simple_encrypt($id_nya));
    }
}