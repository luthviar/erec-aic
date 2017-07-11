<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class Company extends CI_Controller {

	public $tabel = 'tm_company';
	public $field = 'company_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			if($this->session->userdata('authority_id') == 1) { 
				$this->load->helper('message');
				$this->load->helper('status');
				
				$this->load->model('m_company');
				$this->load->model('../m_crud');
				$this->load->model('../m_global');
				
				// set nav active
				$this->session->set_userdata('nav_active', 'setting');
				
				// set sub active
				$this->session->set_userdata('sub_active', 'setting_company');
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
		$this->load->view('company/v_edit', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
		
	function update_data() {
		$id			= simple_decrypt($this->input->post('id'));
		$name		= $this->input->post('nama');
		$phone		= $this->input->post('telepon');
		$email		= $this->input->post('email');
		$address	= $this->input->post('alamat');
		
		// config upload
		$file 						= "";	
		$upload_path				= "./assets/uploads/company";
		$config['upload_path']   	= $upload_path;
		$config['allowed_types'] 	= "jpg|jpeg|png"; 
		$config['max_size']     	= "2000";
		
		$this->load->library('upload', $config);

		$img = $this->m_company->get_file_by_id($id);
		if ( ! $this->upload->do_upload()) {
			$file = $img;	
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('message', $error['error']);
			$this->session->set_flashdata('status', get_notify_status(0));
		}
		else {
			$data = array('upload_data' => $this->upload->data());
			$file = $data['upload_data']['file_name'];
			
			// delete image
			if($img != "") {
				$filestring = realpath(APPPATH .'.'. $upload_path .'/'. $img);
				@unlink ($filestring);
			}
		}
		
		// set array
		$data = array(
			'company_image'			=> $file,
			'company_name'			=> handling_characters($name),
			'company_phone'			=> $phone,
			'company_email'			=> $email,
			'company_address'		=> (($address == "")?NULL:nl2br($address)),
			'last_user'				=> $this->session->userdata('user_id')
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
		
		get_redirecting('setting/company');
    }
}