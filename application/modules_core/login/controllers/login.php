<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Login extends CI_Controller {

    public function __construct() {
    	parent::__construct();
		$this->load->helper('status');
		
		$this->load->model('m_login');
	}

    public function index() {
        if ($this->session->userdata("login") == TRUE) {
			get_redirecting('dashboard');
        }
        else {
			$this->load->view('../v_header');
			$this->load->view("login/v_login");
			$this->load->view('../v_footer');
		}
    }

    function process_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

		$detail = $this->m_login->get_detail_user($username, $password);
        if (!empty($detail)) {
			// get data
			foreach($detail as $row) {
				$user_id 		= $row->user_id;
				$user_email 	= $row->user_email;
				$user_name 		= $row->user_name;
				$user_fullname 	= $row->user_fullname;
				$user_image 	= $row->user_image;
				$last_login 	= $row->last_login;
				$area_id 		= $row->area_id;
				$authority_id 	= $row->authority_id;
				$user_status 	= $row->user_status;
			}
			
			if($user_status != 0) {
				// set session
				$data = array(
					'login' 		=> TRUE,
					'user_id' 		=> $user_id,
					'user_name' 	=> $user_name,
					'user_fullname' => $user_fullname,
					'user_email' 	=> $user_email,
					'user_image' 	=> $user_image,
					'area_id'	 	=> $area_id,
					'authority_id' 	=> $authority_id,
					'last_login' 	=> $last_login
				);
				
				$this->session->set_userdata($data);
				get_redirecting('dashboard');	
			}
			else {
				$this->session->set_flashdata('message', 'User status not active.');
				get_redirecting('login');
			}	
        }
        else {
            $this->session->set_flashdata('message', 'Username or password invalid.');
            get_redirecting('login');
        }
    }
    
    function process_logout() {
		// set last_login
		$this->m_login->set_lastlogin();
		
		$this->session->sess_destroy();
		get_redirecting('login');
    }
}