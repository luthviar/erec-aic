<?php if(!defined('BASEPATH')) exit('Akses langsung tidak di perkenankan');

class request extends CI_Controller {

	public $tabel = 'tp_request';
	public $field = 'request_id';
	
    public function __construct() {
    	parent::__construct();
		
		if ($this->session->userdata('login') == TRUE) {	
			$this->load->helper('message');
			$this->load->helper('status');
			
			$this->load->model('request/m_request');
			$this->load->model('man_power/m_manpower');
			$this->load->model('master/m_position');
			$this->load->model('setting/m_area');
			$this->load->model('user/m_user');
			$this->load->model('../m_crud');
			$this->load->model('../m_global');
			
			// set nav active
			$this->session->set_userdata('nav_active', 'report');
			
			// set sub active
			$this->session->set_userdata('sub_active', 'report_request');
		}
		else {
			get_redirecting('login');
		}
	}

    function index() {
		// get from post
		$fromto	= $this->input->post('reservation');
		if($fromto != "") { 
			$from = substr($fromto, 0, 10);
			$data['from'] = convert_to_dmy($from); 
		} 
		else { 
			$data['from'] = get_date_in_month(0, date("m"), date("Y")); 
		}
		
		if($fromto != "") { 
			$to = substr($fromto, 12, 20);
			$data['to'] = convert_to_dmy($to); 
		} 
		else {
			$data['to'] = get_date_in_month(1, date("m"), date("Y")); 
		}
		
		$this->session->set_userdata('from', $data['from']);
		$this->session->set_userdata('to', $data['to']);
		
		$status	= $this->input->post('status');
		if($status != "") { $this->session->set_userdata('status', $status); } else { $this->session->set_userdata('status', 11); }
		
		// set data
		$data['list'] = $this->m_request->get_report_all();
		
		// set view
		$this->load->view('../v_header');
		$this->load->view('../v_top');
		$this->load->view('request/v_list', $data);
		$this->load->view('../v_bottom');
		$this->load->view('../v_footer');
    }
	
	function export_to_excel() {
		// set data
		$data['list'] = $this->m_request->get_report_all();	
		
		// set view
		$this->load->view('request/v_excel',$data);
    }
	
	function detail_data() {
		// get data
		$id = simple_decrypt($this->uri->segment(4));
		
		// cek id
		if($id == "") {
            get_redirecting('report/request');
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
				$this->load->view('request/v_detail', $data);
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
            get_redirecting('report/request');
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
				$this->load->view('request/v_preview', $data);
			}
		}
    }
}