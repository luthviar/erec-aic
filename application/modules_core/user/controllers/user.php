<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class User extends CI_Controller {

	public $tabel = 'tm_user';
	public $field = 'user_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if($this->session->userdata('authority_id') == 1) { 
				$this->load->helper('message');
				$this->load->helper('status');
				$this->load->helper('image');
				
				$this->load->model('m_user');
				$this->load->model('setting/m_area');
				$this->load->model('setting/m_authority');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'user');
				
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
		$data['list'] = $this->m_global->get_all($this->tabel);
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function add_data() {
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('v_add');
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function insert_data() {
		// get from post
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$fullname	= $this->input->post('nama');
		$email		= $this->input->post('email');
		$area		= $this->input->post('area');
		$authority	= $this->input->post('authority');
		
		// cek exist
		if($this->m_global->check_exist($this->tabel, 'user_name', labeling($username)) == TRUE) {
			$this->session->set_flashdata('message', get_notification('', 9));
			$this->session->set_flashdata('status', get_notify_status(9));
			
			get_redirecting('user');
		}
		
		// config upload
		$file 						= "";	
		$upload_path				= "./assets/uploads/user";
		$config['upload_path']   	= $upload_path;
		$config['allowed_types'] 	= "jpg|jpeg|png"; 
		$config['max_size']     	= "2000";
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload()) {
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', $error['error']);
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$data = array('upload_data' => $this->upload->data());
			$file = $data['upload_data']['file_name'];
			
			$params =  $upload_path .'/'. $file;
			$res 	= thumbnail($params, 'thumb'); 
		}
		
		// set array
		$data = array(
			'user_image'		=> $file,
			'user_name'			=> labeling($username),
			'user_password'		=> $password,
			'user_fullname'		=> handling_characters($fullname),
			'user_email'		=> $email,
			'area_id'			=> $area,
			'authority_id'		=> $authority,
			'last_user'			=> $this->session->userdata('user_id')
		);
		
		// cek result
		$result = $this->m_crud->insert($this->tabel, $data);
		if($result == 0) {
			$this->session->set_flashdata('message', get_notification('insert', 0));
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$this->session->set_flashdata('message', get_notification('insert', 1));
			$this->session->set_flashdata('status', get_notify_status(1));
		}

		get_redirecting('user');
    }
	
	function edit_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(3));
		
		// cek id
		if($id == "") {
            get_redirecting('user');
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
				$this->load->view('v_edit', $data);
				$this->load->view('../v_bottom');
				$this->load->view('../v_footer');
			}
		}
    }
	
	function update_data() {
		// get from post
		$id			= simple_decrypt($this->input->post('id'));
		$fullname	= $this->input->post('nama');
		$email		= $this->input->post('email');
		$area		= $this->input->post('area');
		$authority	= $this->input->post('authority');
		$status		= $this->input->post('status');
		
		// config upload
		$file 						= "";	
		$upload_path				= "./assets/uploads/user";
		$config['upload_path']   	= $upload_path;
		$config['allowed_types'] 	= "jpg|jpeg|png"; 
		$config['max_size']     	= "2000";
		
		$this->load->library('upload', $config);

		$img = $this->m_user->get_file_by_id($id);
		if ( ! $this->upload->do_upload()) {
			$file = $img;	
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', $error['error']);
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$data = array('upload_data' => $this->upload->data());
			$file = $data['upload_data']['file_name'];
			
			$params =  $upload_path .'/'. $file;
			$res 	= thumbnail($params, 'thumb'); 
			
			// delete image
			if($img != "") {
				$filestring = realpath(APPPATH .'.'. $upload_path .'/'. $img);
				@unlink ($filestring);
				
				$filethumb = realpath(APPPATH .'.'. $upload_path .'/thumb'.'/'. $img);
				@unlink ($filethumb);
			}
		}
		
		// set array
		$data = array(
			'user_status'	=> $status,
			'user_image'	=> $file,
			'user_fullname'	=> handling_characters($fullname),
			'user_email'	=> $email,
			'area_id'		=> $area,
			'authority_id'	=> $authority,
			'last_user'		=> $this->session->userdata('user_id')
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
		
		get_redirecting('user');
    }
	
	function update_password() {
		// get from post
		$id		= simple_decrypt($this->input->post('id'));
		$npass	= $this->input->post('n_pass');
		$cpass	= $this->input->post('c_pass');		
        
		// get password
		$password = $this->m_user->get_password_by_id($id);
		
		if($npass != $cpass) {
			$this->session->set_flashdata("message", "Password doesn't match");
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			// cek result
			$result = $this->m_user->set_password($id, $npass);
			if($result == 0) {
				$this->session->set_flashdata('message', get_notification('update', 0));
				$this->session->set_flashdata('status', get_notify_status(0));
			}
			else {
				$this->session->set_flashdata('message', get_notification('update', 1));
				$this->session->set_flashdata('status', get_notify_status(1));
			}
		}
		
		get_redirecting('user');
    }
}