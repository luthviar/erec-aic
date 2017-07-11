<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Api extends CI_Controller {

	public function __construct() {
    	parent::__construct();
		
		$this->load->helper('status');
		$this->load->helper('message');
		$this->load->helper('global');
		$this->load->helper('convert_date');
			
		$this->load->model('../m_crud');
		$this->load->model('../m_global');
	}
	
	/************************************************************************************************************/
	/*************************************************** MEMBER ***************************************************/
	/************************************************************************************************************/
	function get_member_by_email() {
		$id = $this->input->post('email');		// required
		
		if($id != "") {
			$result = $this->m_global->get_search_order('tm_member', 'member_email', $id, 'member_name', 'ASC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->member_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "member/". $row->member_image;
						$tmb = "member/thumb/". $row->member_image;
					}
					
					$str[] = array(
						'member_id'			=> $row->member_id,
						'member_device'		=> $row->member_device,
						'member_name'		=> strip_tags($row->member_name),
						'member_dob'		=> convert_to_dmy($row->member_dob),
						'member_phone'		=> $row->member_phone,
						'member_email'		=> $row->member_email,
						'member_address'	=> strip_tags($row->member_address),
						'member_stat'		=> $row->member_status,
						'member_status'		=> get_status($row->member_status),
						'join_date'			=> convert_to_dmyhis($row->join_date),
						'island_id'			=> $row->island_id,
						'island_name'		=> (($row->island_id=='')?'':(strip_tags($this->load->model('location/m_island')->get_name_by_id($row->island_id)))),
						'province_id'		=> $row->province_id,
						'province_name'		=> (($row->province_id=='')?'':(strip_tags($this->load->model('location/m_province')->get_name_by_id($row->province_id)))),
						'city_id'			=> $row->city_id,
						'city_name'			=> (($row->city_id=='')?'':(strip_tags($this->load->model('location/m_city')->get_name_by_id($row->city_id)))),
						'branch_id'			=> $row->branch_id,
						'branch_name'		=> (($row->branch_id=='')?'':(strip_tags($this->load->model('location/m_branch')->get_name_by_id($row->branch_id)))),
						'member_thumb'		=> base_url() ."assets/uploads/". $tmb,
						'member_image'		=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 	= 1;
				$response["message"] 	= "Success";
				$response["result"]		= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_member_by_id($id="") {
		if($id != "") {
			$result = $this->m_global->get_by_id('tm_member', 'member_id', $id);
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->member_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "member/". $row->member_image;
						$tmb = "member/thumb/". $row->member_image;
					}
					
					$str[] = array(
						'member_id'			=> $row->member_id,
						'member_device'		=> $row->member_device,
						'member_name'		=> strip_tags($row->member_name),
						'member_dob'		=> convert_to_dmy($row->member_dob),
						'member_phone'		=> $row->member_phone,
						'member_email'		=> $row->member_email,
						'member_address'	=> strip_tags($row->member_address),
						'member_stat'		=> $row->member_status,
						'member_status'		=> get_status($row->member_status),
						'join_date'			=> convert_to_dmyhis($row->join_date),
						'island_id'			=> $row->island_id,
						'island_name'		=> (($row->island_id=='')?'':(strip_tags($this->load->model('location/m_island')->get_name_by_id($row->island_id)))),
						'province_id'		=> $row->province_id,
						'province_name'		=> (($row->province_id=='')?'':(strip_tags($this->load->model('location/m_province')->get_name_by_id($row->province_id)))),
						'city_id'			=> $row->city_id,
						'city_name'			=> (($row->city_id=='')?'':(strip_tags($this->load->model('location/m_city')->get_name_by_id($row->city_id)))),
						'branch_id'			=> $row->branch_id,
						'branch_name'		=> (($row->branch_id=='')?'':(strip_tags($this->load->model('location/m_branch')->get_name_by_id($row->branch_id)))),
						'member_thumb'		=> base_url() ."assets/uploads/". $tmb,
						'member_image'		=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 	= 1;
				$response["message"] 	= "Success";
				$response["result"]		= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_login_member() {
		$email 		= $this->input->post('email');		// required	
		$password 	= $this->input->post('password');	// required
		$device 	= $this->input->post('device');
		
		if($email != "" || $password != "") {
			$result = $this->load->model('member/m_member')->get_login($email, $password);	
			
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->member_status == 1) {
						// update device
						$this->m_global->set_status('tm_member', 'member_id', $row->member_id, 'member_device', $device);
						
						// get member by id
						$this->get_member_by_id($row->member_id);
						die();
					}
					else {
						$response["status"] 	= 0;
						$response["message"] 	= "member is Not Active";
						$response["result"]		= $str;	
					}		
				}	
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;	
		}
		
		echo json_encode($response);
	}
	
	function set_register_member() {
		$phone 		= $this->input->post('phone');		// required
		$email		= $this->input->post('email'); 		// required
		$password 	= $this->input->post('password');	// required
		$name 		= $this->input->post('name');		// required	
		$device		= $this->input->post('device');
		$address 	= $this->input->post('address');
		$dob 		= $this->input->post('dob');
		$island		= $this->input->post('island');
		$province	= $this->input->post('province');
		$city		= $this->input->post('city');
		$branch		= $this->input->post('branch');
		
		if($password != "" && $phone != "" && $email != "" && $name != "") {
			// cek exist
			if($this->m_global->check_exist('tm_member', 'member_phone', $phone) == TRUE) {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('', 9);
				$response["result"]		= NULL;
			}
			else if($this->m_global->check_exist('tm_member', 'member_email', $email) == TRUE) {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('', 9);
				$response["result"]		= NULL;
			}
			else {
				// set array
				$data = array(
					'member_status'		=> 1,
					'member_email' 		=> $email,
					'member_phone' 		=> $phone,
					'member_name' 		=> handling_characters($name),
					'member_password' 	=> $password,
					'member_dob' 		=> (($dob=='')?NULL:(convert_to_ymd($dob))),
					'member_device'		=> (($device=='')?NULL:($device)),
					'member_address' 	=> (($address=='')?NULL:(nl2br($address))),
					'island_id'			=> (($island == "")?NULL:$island),
					'province_id'		=> (($province == "")?NULL:$province),
					'city_id'			=> (($city == "")?NULL:$city),
					'branch_id'			=> (($branch == "")?NULL:$branch),
					'join_date'			=> get_ymdhis(),
					'last_user' 		=> NULL
				);
				
				$result = $this->m_crud->insert_id('tm_member', $data);
				if($result != 0) {
					// get member by id
					$this->get_member_by_id($result);
					die();
				}
				else {
					$response["status"] 	= 0;
					$response["message"] 	= get_notification('insert', 0);
					$response["result"]		= NULL;
				}
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function update_member() {
		$id			= $this->input->post('member');		// required
		$phone 		= $this->input->post('phone');		// required
		$name 		= $this->input->post('name');		// required	
		$device		= $this->input->post('device');
		$address 	= $this->input->post('address');
		$dob 		= $this->input->post('dob');
		$island		= $this->input->post('island');
		$province	= $this->input->post('province');
		$city		= $this->input->post('city');
		$branch		= $this->input->post('branch');
		
		if($id != "" && $phone != "" && $name != "") {
			$old_phone = $this->load->model('member/m_member')->get_phone_by_id($id);
			
			if($old_phone != $phone) {
				if($this->m_global->check_exist('tm_member', 'member_phone', $phone) == TRUE) {
					$response["status"] 	= 0;
					$response["message"] 	= get_notification('', 9);
					$response["result"]		= NULL;
					
					echo json_encode($response);
					die();
				}
			}
			
			// set array
			$data = array(
				'member_email' 		=> $email,
				'member_phone' 		=> $phone,
				'member_name' 		=> handling_characters($name),
				'member_device'		=> (($device=='')?NULL:($device)),
				'member_dob' 		=> (($dob=='')?NULL:(convert_to_ymd($dob))),
				'member_address' 	=> (($address=='')?NULL:(nl2br($address))),
				'island_id'			=> (($island == "")?NULL:$island),
				'province_id'		=> (($province == "")?NULL:$province),
				'city_id'			=> (($city == "")?NULL:$city),
				'branch_id'			=> (($branch == "")?NULL:$branch)
			);
			
			$result = $this->m_crud->update('tm_member', 'member_id', $data, $id);
			if($result != 0) {
				// get member by id
				$this->get_member_by_id($id);
				die();
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('update', 0);
				$response["result"]		= NULL;
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function change_password_member() {
		$id		= $this->input->post('member');		// required
		$email	= $this->input->post('email');		// required
		
		if($id != "" && $email != "") {
			$old_email = $this->load->model('member/m_member')->get_email_by_id($id);
			
			if($old_email != $email) {
				if($this->m_global->check_exist('tm_member', 'member_email', $email) == TRUE) {
					$response["status"] 	= 0;
					$response["message"] 	= get_notification('', 9);
					$response["result"]		= NULL;
					
					echo json_encode($response);
					die();
				}
			}
			
			// set array
			$data = array(
				'member_email' => $email
	
			);
			
			$result = $this->m_crud->update('tm_member', 'member_id', $data, $id);
			if($result != 0) {
				// get member by id
				$this->get_member_by_id($id);
				die();
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('update', 0);
				$response["result"]		= NULL;
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function upload_member() {
		$id = $this->input->post('member');		// required
		
		if($id != "") {
			// config upload
			$this->load->helper('image');
			
			$file 						= "";	
			$upload_path				= "./assets/uploads/member/";
			$config['upload_path']   	= $upload_path;
			$config['allowed_types'] 	= "gif|jpg|jpeg|png"; 
			$config['max_size']     	= 0;
			
			$this->load->library('upload', $config);
			$img = $this->load->model('member/m_member')->get_file_by_id($id);	
			
			if ( ! $this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
				$response["status"] 	= 0;
				$response["message"] 	= strip_tags($error['error']);
				$response["result"]		= NULL;	
				
				$file = $img;
			}
			else {
				$data = array('upload_data' => $this->upload->data());
				$file = $data['upload_data']['file_name'];
				
				$params = $upload_path.$file;
				$res 	= thumbnail($params, 'thumb');
				
				$response["status"] 	= 1;
				$response["message"] 	= "Success";
				$response["result"]		= NULL;
				
				// set image to database
				$this->m_global->set_status('tm_member', 'member_id', $id, 'member_image', $file);
				
				// delete image
				if($img != "") {
					$filestring = realpath(APPPATH .'.'. $upload_path .'/'. $img);
					@unlink ($filestring);
					
					$filethumb = realpath(APPPATH .'.'. $upload_path .'/thumb'.'/'. $img);
					@unlink ($filethumb);
				}
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** BLOG ***************************************************/
	/************************************************************************************************************/
	function get_blog_all() {
		$result = $this->m_global->get_order('tp_blog', 'blog_date', 'DESC');
		if(!empty($result)) {
			$str = array();
			foreach($result as $row) {
				if($row->blog_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "blog/". $row->blog_image;
					$tmb = "blog/thumb/". $row->blog_image;
				}

				$str[] = array(
					'blog_id'			=> $row->blog_id,
					'blog_date'			=> convert_to_dmy($row->blog_date),
					'blog_time'			=> convert_to_his($row->blog_time),
					'blog_title'		=> strip_tags($row->blog_title),
					'blog_description'	=> $row->blog_description,
					'author_id'			=> $row->user_id,
					'author_name'		=> (($row->user_id=='')?'':(strip_tags($this->load->model('user/m_user')->get_name_by_id($row->user_id)))),
					'blog_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'blog_image'		=> base_url() ."assets/uploads/". $img
				);
			}
				
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_reply_by_blog() {
		$id = $this->input->post('blog');		// required
		
		if($id != "") {
			$result = $this->m_global->get_by_id_order('tp_reply', 'blog_id', $id, 'reply_status', 1, 'reply_id', 'DESC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					$member_image = $this->load->model('member/m_member')->get_file_by_id($row->member_id);
					if($member_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "member/". $member_image;
						$tmb = "member/thumb/". $member_image;
					}
					
					$str[] = array(	
						'blog_id'		=> $row->blog_id,
						'blog_title'	=> (($row->blog_id=='')?'':(strip_tags($this->load->model('blog/m_blog')->get_name_by_id($row->blog_id)))),
						'reply_date'	=> convert_to_dmy($row->reply_date),
						'reply_time'	=> convert_to_his($row->reply_time),
						'reply_time'	=> $row->reply_message,
						'member_id'		=> $row->member_id,
						'member_name'	=> (($row->member_id=='')?'':(strip_tags($this->load->model('member/m_member')->get_name_by_id($row->member_id)))),
						'member_thumb'	=> base_url() ."assets/uploads/". $tmb,
						'member_image'	=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 	= 1;
				$response["message"] 	= "Success";
				$response["result"]		= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function set_reply() {
		$id			 = $this->input->post('blog');			// required
		$member	 	 = $this->input->post('member');			// required
		$description = $this->input->post('description');
		
		if($id != "" || $member != "") {
			// set array
			$data = array(
				'reply_status'	=> 0,
				'reply_date'	=> get_ymd(),
				'reply_time'	=> get_his(),
				'reply_message'	=> nl2br($description),
				'member_id'	 	=> $member,
				'blog_id' 		=> $id
			);
			
			$result = $this->m_crud->insert('tp_reply', $data);
			if($result != 0) {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('insert', 1);
				
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('insert', 0);
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_blog_by_limit() {
		$limit = $this->input->post('limit');
		
		$result = $this->m_global->get_by_limit_order('tp_blog', $limit, 'blog_date', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				if($row->blog_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "blog/". $row->blog_image;
					$tmb = "blog/thumb/". $row->blog_image;
				}

				$str[] = array(
					'blog_id'			=> $row->blog_id,
					'blog_date'			=> convert_to_dmy($row->blog_date),
					'blog_time'			=> convert_to_his($row->blog_time),
					'blog_title'		=> strip_tags($row->blog_title),
					'blog_description'	=> $row->blog_description,
					'author_id'			=> $row->user_id,
					'author_name'		=> (($row->user_id=='')?'':(strip_tags($this->load->model('user/m_user')->get_name_by_id($row->user_id)))),
					'blog_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'blog_image'		=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}

	function get_blog_by_id($id="") {
		if($id != "") {
			$result = $this->m_global->get_by_id('tp_blog', 'blog_id', $id);
			if(!empty($result)) {
				foreach($result as $row) {
					if($row->blog_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "blog/". $row->blog_image;
						$tmb = "blog/thumb/". $row->blog_image;
					}

					$str[] = array(
						'blog_id'			=> $row->blog_id,
						'blog_date'			=> convert_to_dmy($row->blog_date),
						'blog_time'			=> convert_to_his($row->blog_time),
						'blog_title'		=> strip_tags($row->blog_title),
						'blog_description'	=> $row->blog_description,
						'author_id'			=> $row->user_id,
						'author_name'		=> (($row->user_id=='')?'':(strip_tags($this->load->model('user/m_user')->get_name_by_id($row->user_id)))),
						'blog_thumb'		=> base_url() ."assets/uploads/". $tmb,
						'blog_image'		=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 	= 1;
				$response["message"]	= "Success";
				$response["result"]		= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
			
		
		echo json_encode($response);
	}	
	
	/************************************************************************************************************/
	/*************************************************** ISLAND ***************************************************/
	/************************************************************************************************************/
	function get_island_all() {
		$result = $this->m_global->get_by_id('tm_island', 'island_status', 1);
		if(!empty($result)) {
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $result;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** PROVINCE ***************************************************/
	/************************************************************************************************************/
	function get_province_by_island() {
		$id = $this->input->post('island');		// required
		
		if($id != "") {
			$result = $this->m_global->get_by_id_order('tm_province', 'province_status', 1, 'island_id', $id, 'province_name', 'ASC');
			if(!empty($result)) {
				$response["status"] 	= 1;
				$response["message"] 	= "Success";
				$response["result"]		= $result;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}
		}	
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** CITY ***************************************************/
	/************************************************************************************************************/
	function get_city_by_province() {
		$id = $this->input->post('province');		// required
		
		if($id != "") {
			$result = $this->m_global->get_by_id_order('tm_city', 'city_status', 1, 'province_id', $id, 'province_id', 'ASC');
			if(!empty($result)) {
				$response["status"] 	= 1;
				$response["message"] 	= "Success";
				$response["result"]		= $result;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}
		}	
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** BRANCH ***************************************************/
	/************************************************************************************************************/
	function get_branch_by_city() {
		$id = $this->input->post('city');		// required
		
		if($id != "") {
			$result = $this->m_global->get_by_id_order('tm_branch', 'branch_status', 1, 'city_id', $id, 'city_id', 'ASC');
			if(!empty($result)) {
				$response["status"] 	= 1;
				$response["message"] 	= "Success";
				$response["result"]		= $result;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}
		}	
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** PRODUK ***************************************************/
	/************************************************************************************************************/
	function get_product_by_id($id="") {
		if($id != "") {
			$result = $this->m_global->get_by_id('tm_product', 'product_id', $id);
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->product_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "product/". $row->product_image;
						$tmb = "product/thumb/". $row->product_image;
					}
					
					$str[] = array(
						'product_id'			=> $row->product_id,
						'product_name'			=> strip_tags($row->product_name),
						'product_price'			=> $row->product_price,
						'product_description'	=> $row->product_description,
						'store_id'				=> $row->store_id,
						'store_name'			=> (($row->store_id=='')?'':(strip_tags($this->load->model('store/m_store')->get_name_by_id($row->store_id)))),
						'store_thumb'			=> base_url() ."assets/uploads/". $tmb,
						'store_image'			=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_product_by_store() {
		$id = $this->input->post('store');		// required
		
		if($id != "") {
			$result = $this->m_global->get_by_id('tm_product', 'store_id', $id);
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->product_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "product/". $row->product_image;
						$tmb = "product/thumb/". $row->product_image;
					}
					
					$str[] = array(
						'product_id'			=> $row->product_id,
						'product_name'			=> strip_tags($row->product_name),
						'product_price'			=> $row->product_price,
						'product_description'	=> $row->product_description,
						'store_id'				=> $row->store_id,
						'store_name'			=> (($row->store_id=='')?'':(strip_tags($this->load->model('store/m_store')->get_name_by_id($row->store_id)))),
						'store_thumb'			=> base_url() ."assets/uploads/". $tmb,
						'store_image'			=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_product_all() {
		$result = $this->m_global->get_order('tm_product', 'product_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			foreach($result as $row) {
				if($row->product_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "product/". $row->product_image;
					$tmb = "product/thumb/". $row->product_image;
				}
				
				$str[] = array(
					'product_id'			=> $row->product_id,
					'product_name'			=> strip_tags($row->product_name),
					'product_price'			=> $row->product_price,
					'product_description'	=> $row->product_description,
					'store_id'				=> $row->store_id,
					'store_name'			=> (($row->store_id=='')?'':(strip_tags($this->load->model('store/m_store')->get_name_by_id($row->store_id)))),
					'store_thumb'			=> base_url() ."assets/uploads/". $tmb,
					'store_image'			=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** WARUNG GARUDA ***************************************************/
	/************************************************************************************************************/
	function get_warunggaruda_by_id($id="") {
		if($id != "") {
			$result = $this->m_global->get_by_id('tp_store', 'store_id', $id);
			if(!empty($result)) {
				$str = array();
				$str_image = array();
				foreach($result as $row) {
					if($row->store_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "store/". $row->store_image;
						$tmb = "store/thumb/". $row->store_image;
					}
					
					$str[] = array(
						'store_id'			=> $row->store_id,
						'store_name'		=> strip_tags($row->store_name),
						'store_phone'		=> $row->store_phone,
						'store_email'		=> $row->store_email,
						'store_address'		=> strip_tags($row->store_address),
						'store_latitude'	=> $row->store_latitude,
						'store_longitude'	=> $row->store_longitude,
						'store_description'	=> $row->store_description,
						'store_additional'	=> $row->store_additional,
						'island_id'			=> $row->island_id,
						'island_name'		=> (($row->island_id=='')?'':(strip_tags($this->load->model('location/m_island')->get_name_by_id($row->island_id)))),
						'province_id'		=> $row->province_id,
						'province_name'		=> (($row->province_id=='')?'':(strip_tags($this->load->model('location/m_province')->get_name_by_id($row->province_id)))),
						'city_id'			=> $row->city_id,
						'city_name'			=> (($row->city_id=='')?'':(strip_tags($this->load->model('location/m_city')->get_name_by_id($row->city_id)))),
						'branch_id'			=> $row->branch_id,
						'branch_name'		=> (($row->branch_id=='')?'':(strip_tags($this->load->model('location/m_branch')->get_name_by_id($row->branch_id)))),
						'store_thumb'		=> base_url() ."assets/uploads/". $tmb,
						'store_image'		=> base_url() ."assets/uploads/". $img
					);
					
					$result_image = $this->m_global->get_by_id('td_store_image', 'store_id', $row->store_id);
					foreach($result_image as $rows) {
						if($rows->image == "") {
							$imgs = "no_image.png";
							$tmbs = $imgs;
						}
						else {
							$imgs = "storedetail/". $rows->image;
							$tmbs = "storedetail/thumb/". $rows->image;
						}
						
						$str_image[] = array(
							'store_id'	=> $row->store_id,
							'id'		=> $rows->id,
							'title'		=> strip_tags($rows->title),
							'thumb'		=> base_url() ."assets/uploads/". $tmbs,
							'image'		=> base_url() ."assets/uploads/". $imgs
						);
					}
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
				$response["result_image"]	= $str_image;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_warunggaruda_all() {
		$result = $this->m_global->get_order('tp_store', 'store_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->store_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "store/". $row->store_image;
					$tmb = "store/thumb/". $row->store_image;
				}
				
				$str[] = array(
					'store_id'			=> $row->store_id,
					'store_name'		=> strip_tags($row->store_name),
					'store_phone'		=> $row->store_phone,
					'store_email'		=> $row->store_email,
					'store_address'		=> strip_tags($row->store_address),
					'store_latitude'	=> $row->store_latitude,
					'store_longitude'	=> $row->store_longitude,
					'store_description'	=> $row->store_description,
					'store_additional'	=> $row->store_additional,
					'island_id'			=> $row->island_id,
					'island_name'		=> (($row->island_id=='')?'':(strip_tags($this->load->model('location/m_island')->get_name_by_id($row->island_id)))),
					'province_id'		=> $row->province_id,
					'province_name'		=> (($row->province_id=='')?'':(strip_tags($this->load->model('location/m_province')->get_name_by_id($row->province_id)))),
					'city_id'			=> $row->city_id,
					'city_name'			=> (($row->city_id=='')?'':(strip_tags($this->load->model('location/m_city')->get_name_by_id($row->city_id)))),
					'branch_id'			=> $row->branch_id,
					'branch_name'		=> (($row->branch_id=='')?'':(strip_tags($this->load->model('location/m_branch')->get_name_by_id($row->branch_id)))),
					'store_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'store_image'		=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_store_image', 'store_id', $row->store_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "storedetail/". $rows->image;
						$tmbs = "storedetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'store_id'	=> $row->store_id,
						'id'		=> $rows->id,
						'title'		=> strip_tags($rows->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmbs,
						'image'		=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_warunggaruda_by_limit() {
		$limit = $this->input->post('limit');
		
		$result = $this->m_global->get_by_limit_order('tp_store', $limit, 'store_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->store_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "store/". $row->store_image;
					$tmb = "store/thumb/". $row->store_image;
				}
				
				$str[] = array(
					'store_id'			=> $row->store_id,
					'store_name'		=> strip_tags($row->store_name),
					'store_phone'		=> $row->store_phone,
					'store_email'		=> $row->store_email,
					'store_address'		=> strip_tags($row->store_address),
					'store_latitude'	=> $row->store_latitude,
					'store_longitude'	=> $row->store_longitude,
					'store_description'	=> $row->store_description,
					'store_additional'	=> $row->store_additional,
					'island_id'			=> $row->island_id,
					'island_name'		=> (($row->island_id=='')?'':(strip_tags($this->load->model('location/m_island')->get_name_by_id($row->island_id)))),
					'province_id'		=> $row->province_id,
					'province_name'		=> (($row->province_id=='')?'':(strip_tags($this->load->model('location/m_province')->get_name_by_id($row->province_id)))),
					'city_id'			=> $row->city_id,
					'city_name'			=> (($row->city_id=='')?'':(strip_tags($this->load->model('location/m_city')->get_name_by_id($row->city_id)))),
					'branch_id'			=> $row->branch_id,
					'branch_name'		=> (($row->branch_id=='')?'':(strip_tags($this->load->model('location/m_branch')->get_name_by_id($row->branch_id)))),
					'store_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'store_image'		=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_store_image', 'store_id', $row->store_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "storedetail/". $rows->image;
						$tmbs = "storedetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'store_id'	=> $row->store_id,
						'id'		=> $rows->id,
						'title'		=> strip_tags($rows->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmbs,
						'image'		=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_warunggaruda_by_name() {
		$name = $this->input->post('name');
		
		$result = $this->m_global->get_search_order('tp_store', 'store_name', $name, 'store_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->store_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "store/". $row->store_image;
					$tmb = "store/thumb/". $row->store_image;
				}
				
				$str[] = array(
					'store_id'			=> $row->store_id,
					'store_name'		=> strip_tags($row->store_name),
					'store_phone'		=> $row->store_phone,
					'store_email'		=> $row->store_email,
					'store_address'		=> strip_tags($row->store_address),
					'store_latitude'	=> $row->store_latitude,
					'store_longitude'	=> $row->store_longitude,
					'store_description'	=> $row->store_description,
					'store_additional'	=> $row->store_additional,
					'island_id'			=> $row->island_id,
					'island_name'		=> (($row->island_id=='')?'':(strip_tags($this->load->model('location/m_island')->get_name_by_id($row->island_id)))),
					'province_id'		=> $row->province_id,
					'province_name'		=> (($row->province_id=='')?'':(strip_tags($this->load->model('location/m_province')->get_name_by_id($row->province_id)))),
					'city_id'			=> $row->city_id,
					'city_name'			=> (($row->city_id=='')?'':(strip_tags($this->load->model('location/m_city')->get_name_by_id($row->city_id)))),
					'branch_id'			=> $row->branch_id,
					'branch_name'		=> (($row->branch_id=='')?'':(strip_tags($this->load->model('location/m_branch')->get_name_by_id($row->branch_id)))),
					'store_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'store_image'		=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_store_image', 'store_id', $row->store_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "storedetail/". $rows->image;
						$tmbs = "storedetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'store_id'	=> $row->store_id,
						'id'		=> $rows->id,
						'title'		=> strip_tags($rows->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmbs,
						'image'		=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function search_warunggaruda() {
		$island 	= $this->input->post('island');
		$province 	= $this->input->post('province');
		$city 		= $this->input->post('city');
		$branch 	= $this->input->post('branch');
		
		$result = $this->m_global->get_list_store($island, $province, $city, $branch);
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->store_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "store/". $row->store_image;
					$tmb = "store/thumb/". $row->store_image;
				}
				
				$str[] = array(
					'store_id'			=> $row->store_id,
					'store_name'		=> strip_tags($row->store_name),
					'store_phone'		=> $row->store_phone,
					'store_email'		=> $row->store_email,
					'store_address'		=> strip_tags($row->store_address),
					'store_latitude'	=> $row->store_latitude,
					'store_longitude'	=> $row->store_longitude,
					'store_description'	=> $row->store_description,
					'store_additional'	=> $row->store_additional,
					'island_id'			=> $row->island_id,
					'island_name'		=> (($row->island_id=='')?'':(strip_tags($this->load->model('location/m_island')->get_name_by_id($row->island_id)))),
					'province_id'		=> $row->province_id,
					'province_name'		=> (($row->province_id=='')?'':(strip_tags($this->load->model('location/m_province')->get_name_by_id($row->province_id)))),
					'city_id'			=> $row->city_id,
					'city_name'			=> (($row->city_id=='')?'':(strip_tags($this->load->model('location/m_city')->get_name_by_id($row->city_id)))),
					'branch_id'			=> $row->branch_id,
					'branch_name'		=> (($row->branch_id=='')?'':(strip_tags($this->load->model('location/m_branch')->get_name_by_id($row->branch_id)))),
					'store_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'store_image'		=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_store_image', 'store_id', $row->store_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "storedetail/". $rows->image;
						$tmbs = "storedetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'store_id'	=> $row->store_id,
						'id'		=> $rows->id,
						'title'		=> strip_tags($rows->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmbs,
						'image'		=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_warunggaruda_gallery_by_id() {
		$id = $this->input->post('warunggaruda');			// required
		if($id != "") {	
			$result = $this->m_global->get_by_id_and_order('td_store_image', 'store_id', $id, 'id', 'ASC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "storedetail/". $row->image;
						$tmb = "storedetail/thumb/". $row->image;
					}
					
					$str[] = array(
						'store_id'	=> $row->store_id,
						'id'		=> $row->id,
						'title'		=> strip_tags($row->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmb,
						'image'		=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** JASA KEUANGAN ***************************************************/
	/************************************************************************************************************/
	function get_jasakuangan_by_id($id="") {
		if($id != "") {
			$result = $this->m_global->get_by_id('tp_finance', 'finance_id', $id);
			if(!empty($result)) {
				$str = array();
				$str_image = array();
				foreach($result as $row) {
					if($row->finance_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "finance/". $row->finance_image;
						$tmb = "finance/thumb/". $row->finance_image;
					}
					
					$str[] = array(
						'finance_id'			=> $row->finance_id,
						'finance_name'			=> strip_tags($row->finance_name),
						'finance_phone'			=> $row->finance_phone,
						'finance_email'			=> $row->finance_email,
						'finance_address'		=> strip_tags($row->finance_address),
						'finance_latitude'		=> $row->finance_latitude,
						'finance_longitude'		=> $row->finance_longitude,
						'finance_description'	=> $row->finance_description,
						'finance_additional'	=> $row->finance_additional,
						'finance_thumb'			=> base_url() ."assets/uploads/". $tmb,
						'finance_image'			=> base_url() ."assets/uploads/". $img
					);
					
					$result_image = $this->m_global->get_by_id('td_finance_image', 'finance_id', $row->finance_id);
					foreach($result_image as $rows) {
						if($rows->image == "") {
							$imgs = "no_image.png";
							$tmbs = $imgs;
						}
						else {
							$imgs = "financedetail/". $rows->image;
							$tmbs = "financedetail/thumb/". $rows->image;
						}
						
						$str_image[] = array(
							'finance_id'	=> $row->finance_id,
							'id'			=> $rows->id,
							'title'			=> strip_tags($rows->title),
							'thumb'			=> base_url() ."assets/uploads/". $tmbs,
							'image'			=> base_url() ."assets/uploads/". $imgs
						);
					}
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
				$response["result_image"]	= $str_image;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_jasakuangan_all() {
		$result = $this->m_global->get_order('tp_finance', 'finance_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->finance_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "finance/". $row->finance_image;
					$tmb = "finance/thumb/". $row->finance_image;
				}
				
				$str[] = array(
					'finance_id'			=> $row->finance_id,
					'finance_name'			=> strip_tags($row->finance_name),
					'finance_phone'			=> $row->finance_phone,
					'finance_email'			=> $row->finance_email,
					'finance_address'		=> strip_tags($row->finance_address),
					'finance_latitude'		=> $row->finance_latitude,
					'finance_longitude'		=> $row->finance_longitude,
					'finance_description'	=> $row->finance_description,
					'finance_additional'	=> $row->finance_additional,
					'finance_thumb'			=> base_url() ."assets/uploads/". $tmb,
					'finance_image'			=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_finance_image', 'finance_id', $row->finance_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "financedetail/". $rows->image;
						$tmbs = "financedetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'finance_id'	=> $row->finance_id,	
						'id'			=> $rows->id,
						'title'			=> strip_tags($rows->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmbs,
						'image'			=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_jasakuangan_by_limit() {
		$limit = $this->input->post('limit');
		
		$result = $this->m_global->get_by_limit_order('tp_finance', $limit, 'finance_name', 'ASC'); 
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->finance_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "finance/". $row->finance_image;
					$tmb = "finance/thumb/". $row->finance_image;
				}
				
				$str[] = array(
					'finance_id'			=> $row->finance_id,
					'finance_name'			=> strip_tags($row->finance_name),
					'finance_phone'			=> $row->finance_phone,
					'finance_email'			=> $row->finance_email,
					'finance_address'		=> strip_tags($row->finance_address),
					'finance_latitude'		=> $row->finance_latitude,
					'finance_longitude'		=> $row->finance_longitude,
					'finance_description'	=> $row->finance_description,
					'finance_additional'	=> $row->finance_additional,
					'finance_thumb'			=> base_url() ."assets/uploads/". $tmb,
					'finance_image'			=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_finance_image', 'finance_id', $row->finance_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "financedetail/". $rows->image;
						$tmbs = "financedetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'finance_id'	=> $row->finance_id,	
						'id'			=> $rows->id,
						'title'			=> strip_tags($rows->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmbs,
						'image'			=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_jasakuangan_by_name() {
		$name = $this->input->post('name');
		
		$result = $this->m_global->get_search_order('tp_finance', 'finance_name', $name, 'finance_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->finance_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "finance/". $row->finance_image;
					$tmb = "finance/thumb/". $row->finance_image;
				}
				
				$str[] = array(
					'finance_id'			=> $row->finance_id,
					'finance_name'			=> strip_tags($row->finance_name),
					'finance_phone'			=> $row->finance_phone,
					'finance_email'			=> $row->finance_email,
					'finance_address'		=> strip_tags($row->finance_address),
					'finance_latitude'		=> $row->finance_latitude,
					'finance_longitude'		=> $row->finance_longitude,
					'finance_description'	=> $row->finance_description,
					'finance_additional'	=> $row->finance_additional,
					'finance_thumb'			=> base_url() ."assets/uploads/". $tmb,
					'finance_image'			=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_finance_image', 'finance_id', $row->finance_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "financedetail/". $rows->image;
						$tmbs = "financedetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'finance_id'	=> $row->finance_id,	
						'id'			=> $rows->id,
						'title'			=> strip_tags($rows->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmbs,
						'image'			=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_jasakeuangan_gallery_by_id() {
		$id = $this->input->post('jasakeuangan');			// required
		if($id != "") {	
			$result = $this->m_global->get_by_id_and_order('td_finance_image', 'finance_id', $id, 'id', 'ASC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "financedetail/". $row->image;
						$tmb = "financedetail/thumb/". $row->image;
					}
					
					$str[] = array(
						'finance_id'	=> $row->finance_id,
						'id'			=> $row->id,
						'title'			=> strip_tags($row->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmb,
						'image'			=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** UNIT USAHA KATEGORI ***************************************************/
	/************************************************************************************************************/
	function get_unitusahacategory_all() {
		$result = $this->m_global->get_by_id('tm_businesscategory', 'businesscategory_status', 1);
		if(!empty($result)) {
			$str = array();
			foreach($result as $row) {
				if($row->businesscategory_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "businesscategory/". $row->businesscategory_image;
					$tmb = "businesscategory/thumb/". $row->businesscategory_image;
				}
				
				$str[] = array(
					'businesscategory_id'			=> $row->businesscategory_id,
					'businesscategory_title'		=> strip_tags($row->businesscategory_title),
					'businesscategory_description'	=> $row->businesscategory_description,
					'businesscategory_stat'			=> $row->businesscategory_status,
					'businesscategory_status'		=> get_status($row->businesscategory_status),
					'businesscategory_name'			=> (($row->businesscategory_id=='')?'':(strip_tags($this->load->model('business/m_businesscategory')->get_name_by_id($row->businesscategory_id)))),
					'business_thumb'				=> base_url() ."assets/uploads/". $tmb,
					'business_image'				=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $str;
				
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $result;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** UNIT USAHA ***************************************************/
	/************************************************************************************************************/
	function get_unitusaha_by_id($id="") {
		if($id != "") {
			$result = $this->m_global->get_by_id('tp_business', 'business_id', $id);
			if(!empty($result)) {
				$str = array();
				$str_image = array();
				foreach($result as $row) {
					if($row->business_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "business/". $row->business_image;
						$tmb = "business/thumb/". $row->business_image;
					}
					
					$str[] = array(
						'business_id'			=> $row->business_id,
						'business_name'			=> strip_tags($row->business_name),
						'business_phone'		=> $row->business_phone,
						'business_email'		=> $row->business_email,
						'business_address'		=> strip_tags($row->business_address),
						'business_latitude'		=> $row->business_latitude,
						'business_longitude'	=> $row->business_longitude,
						'business_description'	=> $row->business_description,
						'business_additional'	=> $row->business_additional,
						'business_thumb'		=> base_url() ."assets/uploads/". $tmb,
						'business_image'		=> base_url() ."assets/uploads/". $img
					);
					
					$result_image = $this->m_global->get_by_id('td_business_image', 'business_id', $row->business_id);
					foreach($result_image as $rows) {
						if($rows->image == "") {
							$imgs = "no_image.png";
							$tmbs = $imgs;
						}
						else {
							$imgs = "businessdetail/". $rows->image;
							$tmbs = "businessdetail/thumb/". $rows->image;
						}
						
						$str_image[] = array(
							'business_id'	=> $row->business_id,
							'id'			=> $rows->id,
							'title'			=> strip_tags($rows->title),
							'thumb'			=> base_url() ."assets/uploads/". $tmbs,
							'image'			=> base_url() ."assets/uploads/". $imgs
						);
					}
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
				$response["result_image"]	= $str_image;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_unitusaha_by_category() {
		$id = $this->input->post('category');		// required
		
		if($id != "") {
			$result = $this->m_global->get_by_id('tp_business', 'businesscategory_id', $id);
			if(!empty($result)) {
				$str = array();
				$str_image = array();
				foreach($result as $row) {
					if($row->business_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "business/". $row->business_image;
						$tmb = "business/thumb/". $row->business_image;
					}
					
					$str[] = array(
						'business_id'			=> $row->business_id,
						'business_name'			=> strip_tags($row->business_name),
						'business_phone'		=> $row->business_phone,
						'business_email'		=> $row->business_email,
						'business_address'		=> strip_tags($row->business_address),
						'business_latitude'		=> $row->business_latitude,
						'business_longitude'	=> $row->business_longitude,
						'business_description'	=> $row->business_description,
						'business_additional'	=> $row->business_additional,
						'business_thumb'		=> base_url() ."assets/uploads/". $tmb,
						'business_image'		=> base_url() ."assets/uploads/". $img
					);
					
					$result_image = $this->m_global->get_by_id('td_business_image', 'business_id', $row->business_id);
					foreach($result_image as $rows) {
						if($rows->image == "") {
							$imgs = "no_image.png";
							$tmbs = $imgs;
						}
						else {
							$imgs = "businessdetail/". $rows->image;
							$tmbs = "businessdetail/thumb/". $rows->image;
						}
						
						$str_image[] = array(
							'business_id'	=> $row->business_id,
							'id'			=> $rows->id,
							'title'			=> strip_tags($rows->title),
							'thumb'			=> base_url() ."assets/uploads/". $tmbs,
							'image'			=> base_url() ."assets/uploads/". $imgs
						);
					}
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
				$response["result_image"]	= $str_image;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_unitusaha_all() {
		$result = $this->m_global->get_order('tp_business', 'business_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->business_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "business/". $row->business_image;
					$tmb = "business/thumb/". $row->business_image;
				}
				
				$str[] = array(
					'business_id'			=> $row->business_id,
					'business_name'			=> strip_tags($row->business_name),
					'business_phone'		=> $row->business_phone,
					'business_email'		=> $row->business_email,
					'business_address'		=> strip_tags($row->business_address),
					'business_latitude'		=> $row->business_latitude,
					'business_longitude'	=> $row->business_longitude,
					'business_description'	=> $row->business_description,
					'business_additional'	=> $row->business_additional,
					'business_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'business_image'		=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_business_image', 'business_id', $row->business_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "businessdetail/". $rows->image;
						$tmbs = "businessdetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'business_id'	=> $row->business_id,
						'id'			=> $rows->id,
						'title'			=> strip_tags($rows->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmbs,
						'image'			=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_unitusaha_by_limit() {
		$limit = $this->input->post('limit');
		
		$result = $this->m_global->get_by_limit_order('tp_business', $limit, 'business_name', 'ASC'); 
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->business_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "business/". $row->business_image;
					$tmb = "business/thumb/". $row->business_image;
				}
				
				$str[] = array(
					'business_id'			=> $row->business_id,
					'business_name'			=> strip_tags($row->business_name),
					'business_phone'		=> $row->business_phone,
					'business_email'		=> $row->business_email,
					'business_address'		=> strip_tags($row->business_address),
					'business_latitude'		=> $row->business_latitude,
					'business_longitude'	=> $row->business_longitude,
					'business_description'	=> $row->business_description,
					'business_additional'	=> $row->business_additional,
					'business_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'business_image'		=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_business_image', 'business_id', $row->business_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "businessdetail/". $rows->image;
						$tmbs = "businessdetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'business_id'	=> $row->business_id,
						'id'			=> $rows->id,
						'title'			=> strip_tags($rows->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmbs,
						'image'			=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_unitusaha_by_name() {
		$name = $this->input->post('name');
		
		$result = $this->m_global->get_search_order('tp_business', 'business_name', $name, 'business_name', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			foreach($result as $row) {
				if($row->business_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "business/". $row->business_image;
					$tmb = "business/thumb/". $row->business_image;
				}
				
				$str[] = array(
					'business_id'			=> $row->business_id,
					'business_name'			=> strip_tags($row->business_name),
					'business_phone'		=> $row->business_phone,
					'business_email'		=> $row->business_email,
					'business_address'		=> strip_tags($row->business_address),
					'business_latitude'		=> $row->business_latitude,
					'business_longitude'	=> $row->business_longitude,
					'business_description'	=> $row->business_description,
					'business_additional'	=> $row->business_additional,
					'business_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'business_image'		=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_business_image', 'business_id', $row->business_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "businessdetail/". $rows->image;
						$tmbs = "businessdetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'business_id'	=> $row->business_id,
						'id'			=> $rows->id,
						'title'			=> strip_tags($rows->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmbs,
						'image'			=> base_url() ."assets/uploads/". $imgs
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_unitusaha_gallery_by_id() {
		$id = $this->input->post('unitusaha');			// required
		if($id != "") {	
			$result = $this->m_global->get_by_id_and_order('td_business_image', 'business_id', $id, 'id', 'ASC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "businessdetail/". $row->image;
						$tmb = "businessdetail/thumb/". $row->image;
					}
					
					$str[] = array(
						'business_id'	=> $row->business_id,
						'id'			=> $row->id,
						'title'			=> strip_tags($row->title),
						'thumb'			=> base_url() ."assets/uploads/". $tmb,
						'image'			=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** TRAVEL KATEGORI ***************************************************/
	/************************************************************************************************************/
	function get_travelcategory_all() {
		$result = $this->m_global->get_by_id('tm_travelcategory', 'travelcategory_status', 1);
		if(!empty($result)) {
			$str = array();
			foreach($result as $row) {
				if($row->travelcategory_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "travelcategory/". $row->travelcategory_image;
					$tmb = "travelcategory/thumb/". $row->travelcategory_image;
				}
				
				$str[] = array(
					'travelcategory_id'			=> $row->travelcategory_id,
					'travelcategory_title'		=> strip_tags($row->travelcategory_title),
					'travelcategory_description'=> $row->travelcategory_description,
					'travelcategory_stat'		=> $row->travelcategory_status,
					'travelcategory_status'		=> get_status($row->travelcategory_status),
					'travelcategory_name'		=> (($row->travelcategory_id=='')?'':(strip_tags($this->load->model('travel/m_travelcategory')->get_name_by_id($row->travelcategory_id)))),
					'travel_thumb'				=> base_url() ."assets/uploads/". $tmb,
					'travel_image'				=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $str;
				
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $result;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** TRAVEL ***************************************************/
	/************************************************************************************************************/
	function get_travel_by_id($id="") {
		if($id != "") {
			$result = $this->m_global->get_by_id('tp_travel', 'travel_id', $id);
			if(!empty($result)) {
				$str = array();
				$str_image = array();
				$str_room = array();
				$str_schedule = array();
				foreach($result as $row) {
					if($row->travel_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "travel/". $row->travel_image;
						$tmb = "travel/thumb/". $row->travel_image;
					}
					
					$str[] = array(
						'travel_id'				=> $row->travel_id,
						'travel_title'			=> strip_tags($row->travel_title),
						'travel_price'			=> $row->travel_price,
						'travel_hotel'			=> $row->travel_hotel,
						'travel_plane'			=> $row->travel_plane,
						'travel_itinerary'		=> $row->travel_itinerary,
						'travel_include'		=> $row->travel_include,
						'travel_exclude'		=> $row->travel_exclude,
						'travel_tac'			=> $row->travel_tac,
						'travel_description'	=> $row->travel_description,
						'travelcategory_id'		=> $row->travelcategory_id,
						'travelcategory_name'	=> (($row->travelcategory_id=='')?'':(strip_tags($this->load->model('travel/m_travelcategory')->get_name_by_id($row->travelcategory_id)))),
						'travel_thumb'			=> base_url() ."assets/uploads/". $tmb,
						'travel_image'			=> base_url() ."assets/uploads/". $img
					);
					
					$result_image = $this->m_global->get_by_id('td_travel_image', 'travel_id', $row->travel_id);
					foreach($result_image as $rows) {
						if($rows->image == "") {
							$imgs = "no_image.png";
							$tmbs = $imgs;
						}
						else {
							$imgs = "traveldetail/". $rows->image;
							$tmbs = "traveldetail/thumb/". $rows->image;
						}
						
						$str_image[] = array(
							'travel_id'	=> $row->travel_id,
							'id'		=> $rows->id,
							'title'		=> strip_tags($rows->title),
							'thumb'		=> base_url() ."assets/uploads/". $tmbs,
							'image'		=> base_url() ."assets/uploads/". $imgs
						);
					}
					
					$result_room = $this->m_global->get_by_id('td_travel_room', 'travel_id', $row->travel_id);
					foreach($result_room as $rows) {
						$str_room[] = array(
							'travel_id'	=> $row->travel_id,
							'id'		=> $rows->id,
							'room'		=> $rows->room,
							'price'		=> $rows->price
						);
					}
					
					$result_schedule = $this->m_global->get_by_id('td_travel_schedule', 'travel_id', $row->travel_id);
					foreach($result_schedule as $rows) {
						$str_schedule[] = array(
							'travel_id'	=> $row->travel_id,
							'id'		=> $rows->id,
							'schedule'	=> convert_to_dmy($rows->schedule),
							'seat'		=> $rows->seat
						);
					}
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
				$response["result_image"]	= $str_image;
				$response["result_room"]	= $str_room;
				$response["result_schedule"]= $str_schedule;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_travel_by_category() {
		$id = $this->input->post('category');		// required
		
		if($id != "") {
			$result = $this->m_global->get_by_id_and_order('tp_travel', 'travelcategory_id', $id, 'travel_title', 'ASC');
			if(!empty($result)) {
				$str = array();
				$str_image = array();
				$str_room = array();
				$str_schedule = array();
				foreach($result as $row) {
					if($row->travel_image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "travel/". $row->travel_image;
						$tmb = "travel/thumb/". $row->travel_image;
					}
					
					$str[] = array(
						'travel_id'				=> $row->travel_id,
						'travel_title'			=> strip_tags($row->travel_title),
						'travel_price'			=> $row->travel_price,
						'travel_hotel'			=> $row->travel_hotel,
						'travel_plane'			=> $row->travel_plane,
						'travel_itinerary'		=> $row->travel_itinerary,
						'travel_include'		=> $row->travel_include,
						'travel_exclude'		=> $row->travel_exclude,
						'travel_tac'			=> $row->travel_tac,
						'travel_description'	=> $row->travel_description,
						'travelcategory_id'		=> $row->travelcategory_id,
						'travelcategory_name'	=> (($row->travelcategory_id=='')?'':(strip_tags($this->load->model('travel/m_travelcategory')->get_name_by_id($row->travelcategory_id)))),
						'travel_thumb'			=> base_url() ."assets/uploads/". $tmb,
						'travel_image'			=> base_url() ."assets/uploads/". $img
					);
					
					$result_image = $this->m_global->get_by_id('td_travel_image', 'travel_id', $row->travel_id);
					foreach($result_image as $rows) {
						if($rows->image == "") {
							$imgs = "no_image.png";
							$tmbs = $imgs;
						}
						else {
							$imgs = "traveldetail/". $rows->image;
							$tmbs = "traveldetail/thumb/". $rows->image;
						}
						
						$str_image[] = array(
							'travel_id'	=> $row->travel_id,
							'id'		=> $rows->id,
							'title'		=> strip_tags($rows->title),
							'thumb'		=> base_url() ."assets/uploads/". $tmbs,
							'image'		=> base_url() ."assets/uploads/". $imgs
						);
					}
					
					$result_room = $this->m_global->get_by_id('td_travel_room', 'travel_id', $row->travel_id);
					foreach($result_room as $rows) {
						$str_room[] = array(
							'travel_id'	=> $row->travel_id,
							'id'		=> $rows->id,
							'room'		=> $rows->room,
							'price'		=> $rows->price
						);
					}
					
					$result_schedule = $this->m_global->get_by_id('td_travel_schedule', 'travel_id', $row->travel_id);
					foreach($result_schedule as $rows) {
						$str_schedule[] = array(
							'id'		=> $rows->id,
							'schedule'	=> convert_to_dmy($rows->schedule),
							'seat'		=> $rows->seat
						);
					}
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
				$response["result_image"]	= $str_image;
				$response["result_room"]	= $str_room;
				$response["result_schedule"]= $str_schedule;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_travel_all() {
		$result = $this->m_global->get_order('tp_travel', 'travel_title', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			$str_room = array();
			$str_schedule = array();
			foreach($result as $row) {
				if($row->travel_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "travel/". $row->travel_image;
					$tmb = "travel/thumb/". $row->travel_image;
				}
				
				$str[] = array(
					'travel_id'				=> $row->travel_id,
					'travel_title'			=> strip_tags($row->travel_title),
					'travel_price'			=> $row->travel_price,
					'travel_hotel'			=> $row->travel_hotel,
					'travel_plane'			=> $row->travel_plane,
					'travel_itinerary'		=> $row->travel_itinerary,
					'travel_include'		=> $row->travel_include,
					'travel_exclude'		=> $row->travel_exclude,
					'travel_tac'			=> $row->travel_tac,
					'travel_description'	=> $row->travel_description,
					'travelcategory_id'		=> $row->travelcategory_id,
					'travelcategory_name'	=> (($row->travelcategory_id=='')?'':(strip_tags($this->load->model('travel/m_travelcategory')->get_name_by_id($row->travelcategory_id)))),
					'travel_thumb'			=> base_url() ."assets/uploads/". $tmb,
					'travel_image'			=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_travel_image', 'travel_id', $row->travel_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "traveldetail/". $rows->image;
						$tmbs = "traveldetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'title'		=> strip_tags($rows->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmbs,
						'image'		=> base_url() ."assets/uploads/". $imgs
					);
				}
				
				$result_room = $this->m_global->get_by_id('td_travel_room', 'travel_id', $row->travel_id);
				foreach($result_room as $rows) {
					$str_room[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'room'		=> $rows->room,
						'price'		=> $rows->price
					);
				}
				
				$result_schedule = $this->m_global->get_by_id('td_travel_schedule', 'travel_id', $row->travel_id);
				foreach($result_schedule as $rows) {
					$str_schedule[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'schedule'	=> convert_to_dmy($rows->schedule),
						'seat'		=> $rows->seat
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
			$response["result_room"]	= $str_room;
			$response["result_schedule"]= $str_schedule;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_travel_by_limit() {
		$limit = $this->input->post('limit');
		
		$result = $this->m_global->get_by_limit_order('tp_travel', $limit, 'travel_title', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			$str_room = array();
			$str_schedule = array();
			foreach($result as $row) {
				if($row->travel_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "travel/". $row->travel_image;
					$tmb = "travel/thumb/". $row->travel_image;
				}
				
				$str[] = array(
					'travel_id'				=> $row->travel_id,
					'travel_title'			=> strip_tags($row->travel_title),
					'travel_price'			=> $row->travel_price,
					'travel_hotel'			=> $row->travel_hotel,
					'travel_plane'			=> $row->travel_plane,
					'travel_itinerary'		=> $row->travel_itinerary,
					'travel_include'		=> $row->travel_include,
					'travel_exclude'		=> $row->travel_exclude,
					'travel_tac'			=> $row->travel_tac,
					'travel_description'	=> $row->travel_description,
					'travelcategory_id'		=> $row->travelcategory_id,
					'travelcategory_name'	=> (($row->travelcategory_id=='')?'':(strip_tags($this->load->model('travel/m_travelcategory')->get_name_by_id($row->travelcategory_id)))),
					'travel_thumb'			=> base_url() ."assets/uploads/". $tmb,
					'travel_image'			=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_travel_image', 'travel_id', $row->travel_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "traveldetail/". $rows->image;
						$tmbs = "traveldetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'title'		=> strip_tags($rows->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmbs,
						'image'		=> base_url() ."assets/uploads/". $imgs
					);
				}
				
				$result_room = $this->m_global->get_by_id('td_travel_room', 'travel_id', $row->travel_id);
				foreach($result_room as $rows) {
					$str_room[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'room'		=> $rows->room,
						'price'		=> $rows->price
					);
				}
				
				$result_schedule = $this->m_global->get_by_id('td_travel_schedule', 'travel_id', $row->travel_id);
				foreach($result_schedule as $rows) {
					$str_schedule[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'schedule'	=> convert_to_dmy($rows->schedule),
						'seat'		=> $rows->seat
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
			$response["result_room"]	= $str_room;
			$response["result_schedule"]= $str_schedule;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_travel_by_name() {
		$name = $this->input->post('name');
		
		$result = $this->m_global->get_search_order('tp_travel', 'travel_title', $name, 'travel_title', 'ASC');
		if(!empty($result)) {
			$str = array();
			$str_image = array();
			$str_room = array();
			$str_schedule = array();
			foreach($result as $row) {
				if($row->travel_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "travel/". $row->travel_image;
					$tmb = "travel/thumb/". $row->travel_image;
				}
				
				$str[] = array(
					'travel_id'				=> $row->travel_id,
					'travel_title'			=> strip_tags($row->travel_title),
					'travel_price'			=> $row->travel_price,
					'travel_hotel'			=> $row->travel_hotel,
					'travel_plane'			=> $row->travel_plane,
					'travel_itinerary'		=> $row->travel_itinerary,
					'travel_include'		=> $row->travel_include,
					'travel_exclude'		=> $row->travel_exclude,
					'travel_tac'			=> $row->travel_tac,
					'travel_description'	=> $row->travel_description,
					'travelcategory_id'		=> $row->travelcategory_id,
					'travelcategory_name'	=> (($row->travelcategory_id=='')?'':(strip_tags($this->load->model('travel/m_travelcategory')->get_name_by_id($row->travelcategory_id)))),
					'travel_thumb'			=> base_url() ."assets/uploads/". $tmb,
					'travel_image'			=> base_url() ."assets/uploads/". $img
				);
				
				$result_image = $this->m_global->get_by_id('td_travel_image', 'travel_id', $row->travel_id);
				foreach($result_image as $rows) {
					if($rows->image == "") {
						$imgs = "no_image.png";
						$tmbs = $imgs;
					}
					else {
						$imgs = "traveldetail/". $rows->image;
						$tmbs = "traveldetail/thumb/". $rows->image;
					}
					
					$str_image[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'title'		=> strip_tags($rows->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmbs,
						'image'		=> base_url() ."assets/uploads/". $imgs
					);
				}
				
				$result_room = $this->m_global->get_by_id('td_travel_room', 'travel_id', $row->travel_id);
				foreach($result_room as $rows) {
					$str_room[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'room'		=> $rows->room,
						'price'		=> $rows->price
					);
				}
				
				$result_schedule = $this->m_global->get_by_id('td_travel_schedule', 'travel_id', $row->travel_id);
				foreach($result_schedule as $rows) {
					$str_schedule[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $rows->id,
						'schedule'	=> convert_to_dmy($rows->schedule),
						'seat'		=> $rows->seat
					);
				}
			}
			
			$response["status"] 		= 1;
			$response["message"] 		= "Success";
			$response["result"]			= $str;
			$response["result_image"]	= $str_image;
			$response["result_room"]	= $str_room;
			$response["result_schedule"]= $str_schedule;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function get_travel_gallery_by_id() {
		$id = $this->input->post('travel');			// required
		if($id != "") {	
			$result = $this->m_global->get_by_id_and_order('td_travel_image', 'travel_id', $id, 'id', 'ASC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					if($row->image == "") {
						$img = "no_image.png";
						$tmb = $img;
					}
					else {
						$img = "traveldetail/". $row->image;
						$tmb = "traveldetail/thumb/". $row->image;
					}
					
					$str[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $row->id,
						'title'		=> strip_tags($row->title),
						'thumb'		=> base_url() ."assets/uploads/". $tmb,
						'image'		=> base_url() ."assets/uploads/". $img
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_travel_room_by_id() {
		$id = $this->input->post('travel');			// required
		if($id != "") {	
			$result = $this->m_global->get_by_id_and_order('td_travel_room', 'travel_id', $id, 'id', 'ASC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					$str[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $row->id,
						'room'		=> strip_tags($row->room),
						'price'		=> $row->price,
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_travel_schedule_by_id() {
		$id = $this->input->post('travel');			// required
		if($id != "") {	
			$result = $this->m_global->get_by_id_and_order('td_travel_schedule', 'travel_id', $id, 'id', 'ASC');
			if(!empty($result)) {
				$str = array();
				foreach($result as $row) {
					$str[] = array(
						'travel_id'	=> $row->travel_id,
						'id'		=> $row->id,
						'schedule'	=> convert_to_dmy($row->schedule),
						'seat'		=> $row->seat,
					);
				}
				
				$response["status"] 		= 1;
				$response["message"] 		= "Success";
				$response["result"]			= $str;
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= "No Data Found";
				$response["result"]		= NULL;
			}	
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function set_travel_schedule() {
		$member	 	= $this->input->post('member');				// required
		$schedule	= $this->input->post('schedule');			// required
		
		if($schedule != "" || $member != "") {
			// old seat
			$old_seat = $this->m_global->get_seat_by_schedule($schedule);
			
			if($old_seat <= 0) {
				$response["status"] 	= 0;
				$response["message"] 	= "No Seat Found";
			}
			else {
				// update seat
				$seat = $old_seat - 1;
				$this->m_global->set_status('td_travel_schedule', 'id', $schedule, 'seat', $seat);
				
				$response["status"] 	= 0;
				$response["message"] 	= "Success";
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	/************************************************************************************************************/
	/*************************************************** HOME ***************************************************/
	/************************************************************************************************************/
	function get_home() {
		$banner = $this->m_global->get_by_id_limit_order('tm_banner', 'banner_type', 0, 10, 'banner_id', 'ASC');
		$str_banner = array();
		foreach($banner as $row) {
			if($row->banner_image == "") {
				$img = "no_image.png";
				$tmb = $img;
			}
			else {
				$img = "member/". $row->banner_image;
				$tmb = "member/thumb/". $row->banner_image;
			}	
			
			$str_banner[] = array(
				'banner_id'		=> $row->banner_id,
				'banner_title'	=> strip_tags($row->banner_title),
				'banner_link'	=> $row->banner_link,
				'banner_type'	=> $row->banner_type,
				'banner_thumb'	=> base_url() ."assets/uploads/". $tmb,
				'banner_image'	=> base_url() ."assets/uploads/". $img
			);
		}
		
		$pilihkami = $this->m_global->get_by_limit_order('tm_chooseus', 4, 'chooseus_id', 'ASC');
		$str_pilihkami = array();
		foreach($pilihkami as $row) {
			if($row->chooseus_image == "") {
				$img = "no_image.png";
				$tmb = $img;
			}
			else {
				$img = "chooseus/". $row->chooseus_image;
				$tmb = "chooseus/thumb/". $row->chooseus_image;
			}	
			
			$str_pilihkami[] = array(
				'chooseus_id'			=> $row->chooseus_id,
				'chooseus_title'		=> strip_tags($row->chooseus_title),
				'chooseus_description'	=> $row->chooseus_description,
				'chooseus_thumb'		=> base_url() ."assets/uploads/". $tmb,
				'chooseus_image'		=> base_url() ."assets/uploads/". $img
			);
		}
		
		$beritakini = $this->m_global->get_by_limit_order('tp_article', 2, 'article_date', 'DESC');
		$str_beritakini = array();
		foreach($beritakini as $row) {
			if($row->article_image1 == "") {
				$img1 = "no_image.png";
				$tmb1 = $img1;
			}
			else {
				$img1 = "article/". $row->article_image1;
				$tmb1 = "article/thumb/". $row->article_image1;
			}

			if($row->article_image2 == "") {
				$img2 = "no_image.png";
				$tmb2 = $img2;
			}
			else {
				$img2 = "article/". $row->article_image2;
				$tmb2 = "article/thumb/". $row->article_image2;
			}			
			
			$str_beritakini[] = array(
				'article_id'			=> $row->article_id,
				'article_name'			=> strip_tags($row->article_name),
				'article_date'			=> convert_to_dmy($row->article_date),
				'article_time'			=> convert_to_his($row->article_time),
				'article_title'			=> strip_tags($row->article_title),
				'article_hit'			=> $row->article_hit,
				'article_description1'	=> $row->article_description1,
				'article_description2'	=> $row->article_description2,
				'article_description3'	=> $row->article_description3,
				'author_id'				=> $row->last_user,
				'author_name'			=> (($row->last_user=='')?'':(strip_tags($this->load->model('user/m_user')->get_name_by_id($row->last_user)))),
				'article_thumb1'		=> base_url() ."assets/uploads/". $tmb1,
				'article_image1'		=> base_url() ."assets/uploads/". $img1,
				'article_thumb2'		=> base_url() ."assets/uploads/". $tmb2,
				'article_image2'		=> base_url() ."assets/uploads/". $img2
			);
		}
		
		$response["status"] 			= 1;
		$response["message"] 			= "Success";
		$response["result_banner"]		= $str_banner;
		$response["result_pilihkami"]	= $str_pilihkami;
		$response["result_beritakini"]	= $str_beritakini;
		
		echo json_encode($response);
	}
	
	function get_banner_all() {
		$result = $this->m_global->get_by_id_limit_order('tm_banner', 'banner_type', 0, 10, 'banner_id', 'ASC');
		if(!empty($result)) {
			$str = array();
			foreach($result as $row) {
				if($row->banner_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "member/". $row->banner_image;
					$tmb = "member/thumb/". $row->banner_image;
				}	
				
				$str[] = array(
					'banner_id'		=> $row->banner_id,
					'banner_title'	=> strip_tags($row->banner_title),
					'banner_link'	=> $row->banner_link,
					'banner_type'	=> $row->banner_type,
					'banner_thumb'	=> base_url() ."assets/uploads/". $tmb,
					'banner_image'	=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}

	function get_pilihkami_all() {
		$result = $this->m_global->get_by_limit_order('tm_chooseus', 4, 'chooseus_id', 'ASC');
		if(!empty($result)) {
			$str = array();
			foreach($result as $row) {
				if($row->chooseus_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "chooseus/". $row->chooseus_image;
					$tmb = "chooseus/thumb/". $row->chooseus_image;
				}	
				
				$str[] = array(
					'chooseus_id'			=> $row->chooseus_id,
					'chooseus_title'		=> strip_tags($row->chooseus_title),
					'chooseus_description'	=> $row->chooseus_description,
					'chooseus_thumb'		=> base_url() ."assets/uploads/". $tmb,
					'chooseus_image'		=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}	
	
	function get_beritakini_all() {
		$result = $this->m_global->get_by_limit_order('tp_article', 2, 'article_date', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				if($row->article_image1 == "") {
					$img1 = "no_image.png";
					$tmb1 = $img1;
				}
				else {
					$img1 = "article/". $row->article_image1;
					$tmb1 = "article/thumb/". $row->article_image1;
				}

				if($row->article_image2 == "") {
					$img2 = "no_image.png";
					$tmb2 = $img2;
				}
				else {
					$img2 = "article/". $row->article_image2;
					$tmb2 = "article/thumb/". $row->article_image2;
				}			
				
				$str[] = array(
					'article_id'			=> $row->article_id,
					'article_name'			=> strip_tags($row->article_name),
					'article_date'			=> convert_to_dmy($row->article_date),
					'article_time'			=> convert_to_his($row->article_time),
					'article_title'			=> strip_tags($row->article_title),
					'article_hit'			=> $row->article_hit,
					'article_description1'	=> $row->article_description1,
					'article_description2'	=> $row->article_description2,
					'article_description3'	=> $row->article_description3,
					'author_id'				=> $row->last_user,
					'author_name'			=> (($row->last_user=='')?'':(strip_tags($this->load->model('user/m_user')->get_name_by_id($row->last_user)))),
					'article_thumb1'		=> base_url() ."assets/uploads/". $tmb1,
					'article_image1'		=> base_url() ."assets/uploads/". $img1,
					'article_thumb2'		=> base_url() ."assets/uploads/". $tmb2,
					'article_image2'		=> base_url() ."assets/uploads/". $img2
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}	
	
	/************************************************************************************************************/
	/*************************************************** PROFILE ***************************************************/
	/************************************************************************************************************/
	
	function get_aboutus() {
		$result = $this->m_global->get_by_id('tm_aboutus', 'company_id', 1);
		if(!empty($result)) {
			foreach($result as $row) {
				if($row->aboutus_image == "") {
					$img = "no_image.png";
				}
				else {
					$img = "aboutus/". $row->aboutus_image;
				}

				$str[] = array(
					'aboutus_id'			=> $row->aboutus_id,
					'aboutus_title'			=> strip_tags($row->aboutus_title),
					'aboutus_description'	=> $row->aboutus_description,
					'aboutus_image'			=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}

	function get_management() {
		$result = $this->m_global->get_by_id('tm_management', 'company_id', 1);
		if(!empty($result)) {
			foreach($result as $row) {
				if($row->management_image == "") {
					$img = "no_image.png";
				}
				else {
					$img = "aboutus/". $row->management_image;
				}

				$str[] = array(
					'management_id'				=> $row->management_id,
					'management_title'			=> strip_tags($row->management_title),
					'management_description'	=> $row->management_description,
					'management_image'			=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}	
	
	function get_pressrelease() {
		$result = $this->m_global->get_by_id('tm_pressrelease', 'company_id', 1);
		if(!empty($result)) {
			foreach($result as $row) {
				if($row->pressrelease_image == "") {
					$img = "no_image.png";
				}
				else {
					$img = "aboutus/". $row->pressrelease_image;
				}

				$str[] = array(
					'pressrelease_id'			=> $row->pressrelease_id,
					'pressrelease_title'		=> strip_tags($row->pressrelease_title),
					'pressrelease_description'	=> $row->pressrelease_description,
					'pressrelease_image'		=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}	
	
	function get_privacy() {
		$result = $this->m_global->get_by_id('tm_privacy', 'company_id', 1);
		if(!empty($result)) {
			foreach($result as $row) {
				$str[] = array(
					'privacy_id'			=> $row->privacy_id,
					'privacy_title'			=> strip_tags($row->privacy_title),
					'privacy_description'	=> $row->privacy_description
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}	
	
	function get_termcondition() {
		$result = $this->m_global->get_by_id('tm_termcondition', 'company_id', 1);
		if(!empty($result)) {
			foreach($result as $row) {
				$str[] = array(
					'termcondition_id'			=> $row->termcondition_id,
					'termcondition_title'		=> strip_tags($row->termcondition_title),
					'termcondition_description'	=> $row->termcondition_description
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}	
	
	/************************************************************************************************************/
	/*************************************************** TESTIMONIAL ***************************************************/
	/************************************************************************************************************/
	
	function get_testimonial_all() {
		$result = $this->m_global->get_by_id_and_order('tp_testimonial', 'testimonial_status', 1, 'testimonial_date', 'DESC');
		if(!empty($result)) {
			$str = array();
			foreach($result as $row) {
				$member_image = $this->load->model('member/m_member')->get_file_by_id($row->member_id);
				if($member_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "member/". $member_image;
					$tmb = "member/thumb/". $member_image;
				}

				$str[] = array(
					'testimonial_id'			=> $row->testimonial_id,
					'testimonial_date'			=> convert_to_dmy($row->testimonial_date),
					'testimonial_time'			=> convert_to_his($row->testimonial_time),
					'testimonial_title'			=> strip_tags($row->testimonial_title),
					'testimonial_description'	=> $row->testimonial_description,
					'member_id'					=> $row->member_id,
					'member_name'				=> (($row->member_id=='')?'':(strip_tags($this->load->model('member/m_member')->get_name_by_id($row->member_id)))),
					'member_thumb'				=> base_url() ."assets/uploads/". $tmb,
					'member_image'				=> base_url() ."assets/uploads/". $img
				);
			}
				
			$response["status"] 	= 1;
			$response["message"] 	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
	
	function get_testimonial_by_limit() {
		$limit = $this->input->post('limit');
		
		$result = $this->m_global->get_by_id_limit_order('tp_testimonial', 'testimonial_status', 1, $limit, 'testimonial_date', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				$member_image = $this->load->model('member/m_member')->get_file_by_id($row->member_id);
				if($member_image == "") {
					$img = "no_image.png";
					$tmb = $img;
				}
				else {
					$img = "member/". $member_image;
					$tmb = "member/thumb/". $member_image;
				}

				$str[] = array(
					'testimonial_id'			=> $row->testimonial_id,
					'testimonial_date'			=> convert_to_dmy($row->testimonial_date),
					'testimonial_time'			=> convert_to_his($row->testimonial_time),
					'testimonial_title'			=> strip_tags($row->testimonial_title),
					'testimonial_description'	=> $row->testimonial_description,
					'member_id'					=> $row->member_id,
					'member_name'				=> (($row->member_id=='')?'':(strip_tags($this->load->model('member/m_member')->get_name_by_id($row->member_id)))),
					'member_thumb'				=> base_url() ."assets/uploads/". $tmb,
					'member_image'				=> base_url() ."assets/uploads/". $img
				);
			}
			
			$response["status"] 	= 1;
			$response["message"]	= "Success";
			$response["result"]		= $str;
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "No Data Found";
			$response["result"]		= NULL;
		}	
		
		echo json_encode($response);
	}
	
	function set_testimonial() {
		$member	 	 = $this->input->post('member');			// required
		$title		 = $this->input->post('title');				// required
		$description = $this->input->post('description');
		
		if($title != "" || $member != "") {
			// set array
			$data = array(
				'testimonial_status'		=> 0,
				'testimonial_date'			=> get_ymd(),
				'testimonial_time'			=> get_his(),
				'testimonial_title'			=> handling_characters($title),
				'testimonial_description'	=> nl2br($description),
				'member_id'	 				=> $member,
				'last_user' 				=> NULL
			);
			
			$result = $this->m_crud->insert('tp_testimonial', $data);
			if($result != 0) {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('insert', 1);
				
			}
			else {
				$response["status"] 	= 0;
				$response["message"] 	= get_notification('insert', 0);
			}
		}
		else {
			$response["status"] 	= 0;
			$response["message"] 	= "Please fill the field";
			$response["result"]		= NULL;
		}
		
		echo json_encode($response);
	}
}