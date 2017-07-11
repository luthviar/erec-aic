<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Leave extends CI_Controller {

	public $tabel = 'tp_leave';
	public $field = 'leave_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('m_leave');
				$this->load->model('man_power/m_manpower');
				$this->load->model('master/m_position');
				$this->load->model('setting/m_area');
				$this->load->model('user/m_user');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'leave');
				
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
		$data['list'] = $this->m_global->get_by_id_order('tp_leave', 'leave_status', 0, 'area_id', $this->session->userdata('area_id'), 'leave_date', 'DESC');
		
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
            get_redirecting('leave');
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
				if($this->m_leave->get_status_by_id($id) != 0) {
					get_redirecting('leave');
				}
				
				$data['status']	= (($this->session->userdata('authority_id') == 3)?7:9);
				
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
		$result = $this->m_global->set_status($this->tabel, $this->field, $id, 'leave_status', $status); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			// set status process
			$mpp 	= $this->m_leave->get_mpp_by_id($id);
			$temp 	= $this->m_leave->get_count_by_id($id);
			$out 	= $this->m_manpower->get_process_out_by_detail($mpp);
			$count  = doubleval($out) - doubleval($temp); 
			
			if($status == 6) {
				$this->m_global->set_status('td_manpower', 'id', $mpp, 'process_out', $count);
			}
			else {
				// set status process
				if($this->session->userdata('authority_id') == 3) {
					$this->m_global->set_status('td_manpower', 'id', $mpp, 'process_out', $count);
					
					$actual = $this->m_manpower->get_actual_by_detail($mpp);
					$counts = doubleval($actual) - doubleval($temp); 
					$this->m_global->set_status('td_manpower', 'id', $mpp, 'actual', $counts);
				}
			}
			
			// send email
			$this->load->helper('sending_email');
			$this->load->helper('format_email');
				
			// get UM
			$area = $this->m_leave->get_area_by_id($id);
			if($area == 1) {
				$authority = 5;
			}
			else {
				$authority = 3;
			}
			
			$user = $this->m_global->get_by_id_order('tm_user', 'authority_id', $authority, 'area_id', $area, 'user_id', 'ASC');
			foreach($user as $row) {
				$email 	= $row->user_email;
				$format	= format_leave($id);
				
				if($email != "") {
					$sending_email = sending_emailnya(1, $email, $format);		
				}
			}
				
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('leave');
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
				$count = get_available(0, $id);
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

		// cek status
		if(get_available(0, $id) == 0) {
			get_redirecting('dashboard');
		}
		
		$code 	= generate_code(0);
		
		// set array
		if($this->session->userdata('authority_id') == 3) {
			$data = array(
				'leave_date'			=> get_ymd(),
				'leave_time'			=> get_his(),
				'leave_description'		=> (($description == "")?NULL:nl2br($description)),
				'leave_code'			=> $code,
				'leave_count'			=> $count,
				'mpp_id'				=> $id,
				'area_id'				=> $this->session->userdata('area_id'),
				'prepared_id'			=> $this->session->userdata('user_id'),
				'last_user'				=> $this->session->userdata('user_id'),
				'approval_date'			=> get_ymd(),
				'approval_time'			=> get_his(),
				'approval_description'	=> NULL,
				'approval_id'			=> $this->session->userdata('user_id')
			);
		}
		else {
			$data = array(
				'leave_date'			=> get_ymd(),
				'leave_time'			=> get_his(),
				'leave_description'		=> (($description == "")?NULL:nl2br($description)),
				'leave_code'			=> $code,
				'leave_count'			=> $count,
				'mpp_id'				=> $id,
				'area_id'				=> $this->session->userdata('area_id'),
				'prepared_id'			=> $this->session->userdata('user_id'),
				'last_user'				=> $this->session->userdata('user_id')
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
					'leave_id' => $result
				);
				
				$this->m_crud->insert('td_leave', $detail);
			}
			
			// set status process
			$this->m_global->set_status('td_manpower', 'id', $id, 'process_out', $count);
			
			$this->session->set_flashdata('message', get_notification('insert', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('leave/edit-data/'. simple_encrypt($result));
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
		$id_nya = $this->m_leave->get_id_by_detail($id);
		$result = $this->m_crud->update('td_leave', 'id', $data, $id); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('leave/edit-data/'. simple_encrypt($id_nya));
    }
}