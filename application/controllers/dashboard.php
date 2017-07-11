<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			$this->load->helper('message');
			$this->load->helper('status');
			
			// set nav active
			$this->session->set_userdata('nav_active', 'dashboard');
			
			// set sub active
			$this->session->unset_userdata('sub_active');
		}
		else {
			get_redirecting('login');
		}
	}

	public function index() {
		// set data
		$data['detail'] = $this->m_global->get_by_id('tm_preference', 'preference_id', 1);
		
		$list = array();
		if($this->session->userdata('authority_id') == 5) {
			$list = $this->m_global->get_by_id_order('tp_manpower', 'manpower_status', 1, 'is_approved', 1, 'manpower_id', 'DESC');
		}
		else if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 4)) {
			$list = $this->m_global->get_by_idss_order('tp_manpower', 'manpower_status', 1, 'is_approved', 1, 'area_id', $this->session->userdata('area_id'), 'manpower_id', 'DESC');
		}
			
		$data['list'] = $list;
		
		
		$leave = array();
		if($this->session->userdata('authority_id') == 5) {
			$leave = $this->m_global->get_by_limit_order('tp_leave', 10, 'leave_id', 'DESC');
		}
		else if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 4) || ($this->session->userdata('authority_id') == 6)) {
			$leave = $this->m_global->get_by_id_limit_order('tp_leave', 'area_id', $this->session->userdata('area_id'), 10, 'leave_id', 'DESC');
		}
			
		$data['leave'] = $leave;
		
		$request = array();
		if($this->session->userdata('authority_id') == 5) {
			$request = $this->m_global->get_by_limit_order('tp_request', 10, 'request_id', 'DESC');
		}
		else if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 4) || ($this->session->userdata('authority_id') == 6)) {
			$request = $this->m_global->get_by_id_limit_order('tp_request', 'area_id', $this->session->userdata('area_id'), 10, 'request_id', 'DESC');
		}
			
		$data['request'] = $request;
		
		// set view
		$this->load->view('v_header');
		$this->load->view('v_top');
		$this->load->view('main/v_dashboard', $data);
		$this->load->view('v_bottom');
		$this->load->view('v_footer');
	}
	
	function kirim_email() {
		$this->load->helper('sending_email');
		$this->load->helper('format_email');
		
		$to 	= "firmansyah@aerofood.co.id";
		$msg	= "68676867676";
		
		echo sending_emailnya(0, $to, $msg);
	}
} 