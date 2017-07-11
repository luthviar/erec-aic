<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Man_power extends CI_Controller {

	public $tabel = 'tp_manpower';
	public $field = 'manpower_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if(($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 5)) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('man_power/m_manpower');
				$this->load->model('setting/m_area');
				$this->load->model('master/m_department');
				$this->load->model('master/m_unit');
				$this->load->model('master/m_position');
				$this->load->model('user/m_user');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'approval');
				
				// set sub active
				$this->session->set_userdata('sub_active', 'approval_manpower');
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
		$data['list'] = $this->m_global->get_by_idss_order($this->tabel, 'manpower_status', 1, 'is_approved', 0, 'area_id', $this->session->userdata('area_id'), 'manpower_id', 'DESC');
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('manpower/v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function edit_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(4));
		
		// cek id
		if($id == "") {
            get_redirecting('approval/man-power');
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
				if($this->m_manpower->get_isapproved_by_id($id) != 0) {
					get_redirecting('approval/man-power');
				}
				
				// set view
				$this->load->view('../v_header');
				$this->load->view('../v_top');
				$this->load->view('manpower/v_edit', $data);
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
			'is_approved'			=> $status,
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
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('approval/man-power');
    }
}   