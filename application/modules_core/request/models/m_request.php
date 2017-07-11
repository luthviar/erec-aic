<?php

class M_request extends CI_Model {

	public $tb = 'tp_request';
	public $fd = 'request_id';
	
	function get_count_by_id($id) {
        $this->db->select('request_count');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$request_count = $row->request_count;
			}    

			return $request_count;
		}
		else {
			return 0;
		}	
    }
	
	function get_status_by_id($id) {
        $this->db->select('request_status');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$request_status = $row->request_status;
			}    

			return $request_status;
		}
		else {
			return 0;
		}	
    }
	
	function get_approval1_by_id($id) {
        $this->db->select('approval1_id');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$approval1_id = $row->approval1_id;
			}    

			return $approval1_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_approval2_by_id($id) {
        $this->db->select('approval2_id');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$approval2_id = $row->approval2_id;
			}    

			return $approval2_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_recruitment_by_id($id) {
        $this->db->select('recruitment_id');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$recruitment_id = $row->recruitment_id;
			}    

			return $recruitment_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_mpp_by_id($id) {
        $this->db->select('mpp_id');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$mpp_id = $row->mpp_id;
			}    

			return $mpp_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_area_by_id($id) {
        $this->db->select('area_id');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$area_id = $row->area_id;
			}    

			return $area_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_prepared_by_id($id) {
        $this->db->select('request_prepared');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$request_prepared = $row->request_prepared;
			}    

			return $request_prepared;
		}
		else {
			return 0;
		}	
    }
	
	function get_id_by_detail($id) {
        $this->db->select('request_id');
		$this->db->from('td_request');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$request_id = $row->request_id;
			}    

			return $request_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_nik_by_detail($id) {
        $this->db->select('nik');
		$this->db->from('td_request');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$nik = $row->nik;
			}    

			return $nik;
		}
		else {
			return "";
		}	
    }
	
	function get_name_by_detail($id) {
        $this->db->select('name');
		$this->db->from('td_request');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$name = $row->name;
			}    

			return $name;
		}
		else {
			return "";
		}	
    }
	
	function get_join_by_detail($id) {
        $this->db->select('join');
		$this->db->from('td_request');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$join = $row->join;
			}    

			return $join;
		}
		else {
			return "";
		}	
    }
	
	function get_report_all() {
		$this->db->select('*');
		$this->db->from($this->tb);
		
		if($this->session->userdata('status') != 11){
			$this->db->where('request_status', $this->session->userdata('status'));
		}
		
		if($this->session->userdata('from') != ""){
			$this->db->where('request_date >=', date("Y-m-d", strtotime($this->session->userdata('from'))));
		}
		else{
			$this->db->where('MONTH(request_date)', date("m"));
			$this->db->where('YEAR(request_date)', date("Y"));
		}
		
		if($this->session->userdata('to') != ""){
			$this->db->where('request_date <=', date("Y-m-d", strtotime($this->session->userdata('to'))));
		}
		else{
			$this->db->where('MONTH(request_date)', date("m"));
			$this->db->where('YEAR(request_date)', date("Y"));
		}
		
		if($this->session->userdata('authority_id') != 5){
			$this->db->where('area_id', $this->session->userdata('area_id')); 
		}
		
		$this->db->order_by('request_date', 'DESC');
		$this->db->order_by('area_id', 'ASC');
		$query = $this->db->get();
        return $query->result();
	}
}		