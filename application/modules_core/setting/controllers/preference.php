<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Preference extends CI_Controller {

	public $tabel = 'tm_preference';
	public $field = 'preference_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if($this->session->userdata('authority_id') == 1) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('setting/m_preference');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'setting');
				
				// set sub active
				$this->session->set_userdata('sub_active', 'setting_preference');
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
		$data['detail'] = $this->m_global->get_by_id($this->tabel, $this->field, 1);
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('preference/v_edit', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
		
	function update_data() {
		$id				= simple_decrypt($this->input->post('id'));
		$home_tittle 	= $this->input->post('home_tittle');
		$home_desc 		= $this->input->post('home_desc');
		$msg_tittle 	= $this->input->post('msg_tittle');
		$msg_desc 		= $this->input->post('msg_desc');
		
		// set array
		$data = array(
			'preference_hometittle'			=> $home_tittle,
			'preference_homedescription'	=> (($home_desc=='')?NULL:(nl2br($home_desc))),
			'preference_messagetittle'		=> $msg_tittle,
			'preference_messagedescription'	=> (($msg_desc=='')?NULL:(nl2br($msg_desc))),
			'last_user'						=> $this->session->userdata('user_id')
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
		
		get_redirecting('setting/preference');
    }
}