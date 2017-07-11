<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Man_power extends CI_Controller {

	public $tabel = 'tp_manpower';
	public $field = 'manpower_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4) || ($this->session->userdata('authority_id') == 5)) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('m_manpower');
				$this->load->model('setting/m_area');
				$this->load->model('master/m_department');
				$this->load->model('master/m_unit');
				$this->load->model('master/m_position');
				$this->load->model('user/m_user');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'manpower');
				
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
		if($this->session->userdata('authority_id') == 5) {
			$data['list'] = $this->m_global->get_by_id($this->tabel, 'manpower_status', 1);
		}
		else {
			$data['list'] = $this->m_global->get_by_id_order($this->tabel, 'is_approved', 0, 'area_id', $this->session->userdata('area_id'), 'manpower_id', 'DESC');
		}	
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function add_data() {
		if($this->session->userdata('authority_id') == 5) {
			// set view
			$this->load->view('../v_header');
			$this->load->view('../v_top');
			$this->load->view('v_add');
			$this->load->view('../v_bottom');
			$this->load->view('../v_footer');
		}
		else {
			get_redirecting('error');
		}	
    }
	
	function insert_data() {
		// get from post
		$description	= $this->input->post('description');
		$area			= $this->input->post('area');
		$department		= $this->input->post('department');
		$unit			= $this->input->post('unit');
		
		// cek exist
		if($this->m_global->check_existings($this->tabel, 'area_id', $area, 'department_id', $department, 'unit_id', $unit) == TRUE) {
			$this->session->set_flashdata('message', get_notification('', 9));
			$this->session->set_flashdata('status', get_notify_status(9));
			
			get_redirecting('man-power');
		}
		
		// set array
		$data = array(
			'manpower_status'		=> 1,
			'manpower_date'			=> get_ymd(),
			'manpower_time'			=> get_his(),
			'manpower_description'	=> (($description == "")?NULL:nl2br($description)),
			'area_id'				=> $area,
			'department_id'			=> $department,
			'unit_id'				=> $unit,
			'prepared_id'			=> $this->session->userdata('user_id'),
			'last_user'				=> $this->session->userdata('user_id')
		);
		
		// cek result
		$result = $this->m_crud->insert_id($this->tabel, $data);
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('insert', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$this->session->set_flashdata('message', get_notification('insert', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}

		get_redirecting('man-power/edit-data/'. simple_encrypt($result));
    }
	
	function edit_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(3));
		
		// cek id
		if($id == "") {
            get_redirecting('man-power');
        } 
        else {
			// set data
			$data['detail'] = $this->m_global->get_by_id($this->tabel, $this->field, $id);
			
			// cek resut
			if($data['detail'] == null) {
                get_redirecting('error');
            }
			else {
				if($this->session->userdata('authority_id') == 5) {
					// set view
					$this->load->view('../v_header');
					$this->load->view('../v_top');
					$this->load->view('v_edit', $data);
					$this->load->view('../v_bottom');
					$this->load->view('../v_footer');
				}
				else {
					get_redirecting('error');
				}	
			}
		}
    }
	
	function update_data() {
		// get from post
		$id		= simple_decrypt($this->input->post('id'));
		$status	= $this->input->post('status');
		
		// cek result
		$result = $this->m_global->set_status($this->tabel, $this->field, $id, 'manpower_status', $status); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			// send email
			if($status == 1) {
				$this->load->helper('sending_email');
				$this->load->helper('format_email');
			
				// get SM
				$area = $this->m_manpower->get_area_by_id($id);
				if($area == 1) {
					$authority = 4;
				}
				else {
					$authority = 2;
				}
				
				$user = $this->m_global->get_by_id_order('tm_user', 'authority_id', $authority, 'area_id', $area, 'user_id', 'ASC');
				foreach($user as $row) {
					$email 	= $row->user_email;
					$format	= format_mpp($id);
					
					if($email != "") {
						$sending_email = sending_emailnya(0, $email, $format);		
					}
				}
			}
			
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('man-power');
    }
	
	function detail_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(3));
		
		// cek id
		if($id == "") {
            get_redirecting('man-power');
        } 
        else {
			// set data
			$data['detail'] = $this->m_global->get_by_id($this->tabel, $this->field, $id);
			
			// cek resut
			if($data['detail'] == null) {
                get_redirecting('error');
            }
			else {
				if($this->session->userdata('authority_id') != 5) {
					// set view
					$this->load->view('../v_header');
					$this->load->view('../v_top');
					$this->load->view('v_detail', $data);
					$this->load->view('../v_bottom');
					$this->load->view('../v_footer');
				}
				else {
					get_redirecting('error');
				}	
			}
		}
    }
	
	function process_data() {
		// get from post
		$id		= simple_decrypt($this->input->post('id'));
		$check	= $this->input->post('check');
		$note	= $this->input->post('note');
		
		if($check == 1) {
			// set array
			$data = array(
				'is_approved'			=> $check,
				'approval_date'			=> get_ymd(),
				'approval_time'			=> get_his(),
				'approval_description'	=> (($note == "")?NULL:nl2br($note)),
				'approval_id'			=> $this->session->userdata('user_id')
			);
			
			// cek result
			$result = $this->m_crud->update($this->tabel, $this->field, $data, $id); 
			if($result == 0) {
				$this->session->set_flashdata('message', get_notification('update', 0));
				$this->session->set_flashdata('status', get_notify_status(0));
			}
			else {
				$this->load->helper('sending_email');
				$this->load->helper('format_email');
				
				// get EMHC
				$area 		= 1;
				$authority 	= 5;
				$user = $this->m_global->get_by_id_order('tm_user', 'authority_id', $authority, 'area_id', $area, 'user_id', 'ASC');
				foreach($user as $row) {
					$email 	= $row->user_email;
					$format	= format_mpp($id);
					
					if($email != "") {
						$sending_email = sending_emailnya(0, $email, $format);		
					}
				}
				
				$this->session->set_flashdata('message', get_notification('update', 1));
				$this->session->set_flashdata('status', get_notify_status(1));
			}	
		}
		
		get_redirecting('man-power');
    }
	
	function insert_detail_data() {
		// get from post
		$id 		= simple_decrypt($this->input->post('manpower'));
		$position 	= $this->input->post('position');
		$mpp 		= $this->input->post('mpp');
		$actual		= $this->input->post('actual');
		
		// cek actual
		if($actual > $mpp) {
			$this->session->set_flashdata("message", "The input MPP value must be greater than or equal to Actual value");
			$this->session->set_flashdata('status', get_notify_status(0));
			get_redirecting('man-power/edit-data/'. simple_encrypt($id));
		}
		
		// set array
		$data = array(
			'position_id'	=> $position,
			'mpp'			=> (($mpp == "")?0:$mpp),
			'actual'		=> (($actual == "")?0:$actual),
			'manpower_id'	=> $id
		);
		
		// cek result
		$result = $this->m_crud->insert('td_manpower', $data);
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('insert', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$this->session->set_flashdata('message', get_notification('insert', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}

		get_redirecting('man-power/edit-data/'. simple_encrypt($id));
    }
	
	function update_actual_data() {
		// get from post
		$id		= $this->input->post('manpower');
		$mpp	= $this->input->post('mpp');
		$actual	= $this->input->post('actual');
		
		// cek result
		$id_nya = $this->m_manpower->get_id_by_detail($id);
		
		// cek count actual
		// cek actual
		if($actual > $mpp) {
			$this->session->set_flashdata("message", "The input Actual value must be less than or equal to MPP value");
			$this->session->set_flashdata('status', get_notify_status(0));
			get_redirecting('man-power/detail-data/'. simple_encrypt($id_nya));
		}
		
		$result = $this->m_global->set_status('td_manpower', 'id', $id, 'actual', $actual); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('man-power/detail-data/'. simple_encrypt($id_nya));
    }
	
	function update_detail_data() {
		// get from post
		$id		= $this->input->post('detail');
		$mpp	= $this->input->post('mpp');
		$status	= $this->input->post('status');
		
		// set array
		$data = array(
			'status'	=> $status,
			'mpp'		=> (($mpp == "")?0:$mpp)
		);
		
		// cek result
		$id_nya = $this->m_manpower->get_id_by_detail($id);
		$result = $this->m_crud->update('td_manpower', 'id', $data, $id); 
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('update', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$this->session->set_flashdata('message', get_notification('update', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}		
		
		get_redirecting('man-power/edit-data/'. simple_encrypt($id_nya));
    }
	
	function delete_detail_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(3));
		
		// cek id
		if($id == "") {
            get_redirecting('man-power');
        } 
        else {
			// set data
			$data['detail'] = $this->m_global->get_by_id('td_manpower', 'id', $id);
			
			// cek resut
			if($data['detail'] == null) {
                get_redirecting('error');
            }
			else {
				// cek result
				$id_nya = $this->m_manpower->get_id_by_detail($id);
				$result = $this->m_crud->delete('td_manpower', 'id', $id); 
				if($result == 0) {
					$this->session->set_flashdata('message', get_notification('delete', 0));
					$this->session->set_flashdata('status', get_notify_status(0));
				}
				else {
					$this->session->set_flashdata('message', get_notification('delete', 1));
					$this->session->set_flashdata('status', get_notify_status(1));
				}		
				
				get_redirecting('man-power/edit-data/'. simple_encrypt($id_nya));
			}
		}
    }
}