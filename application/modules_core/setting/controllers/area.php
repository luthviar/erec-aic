<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Area extends CI_Controller {

	public $tabel = 'tm_area';
	public $field = 'area_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if($this->session->userdata('authority_id') == 1) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('m_area');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'setting');
				
				// set sub active
				$this->session->set_userdata('sub_active', 'setting_area');
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
		$data['list'] = $this->m_global->get_all($this->tabel);
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('area/v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
}   