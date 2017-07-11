<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Man_power extends CI_Controller {

	public $tabel = 'tp_manpower';
	public $field = 'manpower_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
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
			$this->session->set_userdata('nav_active', 'report');
			
			// set sub active
			$this->session->set_userdata('sub_active', 'report_mpp');
			
		}
		else {
			get_redirecting('login');
		}
	}

    function index() {
		// get from post
		$department	= $this->input->post('department');
		if($department != "") { $this->session->set_userdata('department', $department); } else { $this->session->unset_userdata('department'); }
		
		$status	= $this->input->post('status');
		if($status != "") { $this->session->set_userdata('status', $status); } else { $this->session->set_userdata('status', 11); }
		
		// set data
		$data['list'] = $this->m_manpower->get_report_all();
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('manpower/v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function export_to_excel() {
		// set data
		$data['list'] = $this->m_manpower->get_report_all();
		
		// set view
		$this->load->view('manpower/v_excel', $data);
    }
	
	function detail_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(4));
		
		// cek id
		if($id == "") {
            get_redirecting('report/manpower');
        } 
        else {
			// set data
			$data['detail'] = $this->m_global->get_by_id($this->tabel, $this->field, $id);
			
			// cek resut
			if($data['detail'] == null) {
                get_redirecting('error');
            }
			else {
				// set view
				$this->load->view('../v_header');
				$this->load->view('../v_top');
				$this->load->view('manpower/v_detail', $data);
				$this->load->view('../v_bottom');
				$this->load->view('../v_footer');
			}
		}
    }
	
	function preview_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(4));
		
		// cek id
		if($id == "") {
            get_redirecting('report/manpower');
        } 
        else {
			// set data
			$data['detail'] = $this->m_global->get_by_id($this->tabel, $this->field, $id);
			
			// cek resut
			if($data['detail'] == null) {
                get_redirecting('error');
            }
			else {
				// set view
				$this->load->view('manpower/v_preview', $data);
			}
		}
    }
}