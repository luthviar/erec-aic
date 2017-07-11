<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Leave extends CI_Controller {

	public $tabel = 'tp_leave';
	public $field = 'leave_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if(($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 5)) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('leave/m_leave');
				$this->load->model('man_power/m_manpower');
				$this->load->model('master/m_position');
				$this->load->model('user/m_user');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'approval');
				
				// set sub active
				$this->session->set_userdata('sub_active', 'approval_leave');
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
		$data['list'] = $this->m_global->get_by_id_order($this->tabel, 'leave_status', 9, 'area_id', $this->session->userdata('area_id'), 'leave_id', 'DESC');
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('leave/v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function edit_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(4));
		
		// cek id
		if($id == "") {
            get_redirecting('approval/leave');
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
				if($this->m_leave->get_status_by_id($id) != 9) {
					get_redirecting('approval/leave');
				}
				
				// set view
				$this->load->view('../v_header');
				$this->load->view('../v_top');
				$this->load->view('leave/v_edit', $data);
				$this->load->view('../v_bottom');
				$this->load->view('../v_footer');
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
			'leave_status'			=> $status,
			'approval_date'			=> get_ymd(),
			'approval_time'			=> get_his(),
			'approval_description'	=> (($description == "")?NULL:nl2br($description)),
			'approval_id'			=> $this->session->userdata('user_id')
		);
		
		// cek result
		$result = $this->m_crud->update($this->tabel, $this->field, $data, $id); 
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
			$this->m_global->set_status('td_manpower', 'id', $mpp, 'process_out', $count);
			
			$actual = $this->m_manpower->get_actual_by_detail($mpp);
			$count 	= doubleval($actual) - doubleval($temp); 
			$this->m_global->set_status('td_manpower', 'id', $mpp, 'actual', $count);
		
			// send email
			$this->load->helper('sending_email');
			$this->load->helper('format_email');
				
			// get SM
			$area = $this->m_leave->get_area_by_id($id);
			if($area == 1) {
				$authority = 4;
			}
			else {
				$authority = 2;
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
		
		get_redirecting('approval/leave');
    }
}   