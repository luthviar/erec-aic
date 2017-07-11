<?php

class M_company extends CI_Model {

	public $tb = 'tm_company';
	public $fd = 'company_id';
	
	function get_name_by_id($id) {
        $this->db->select('company_name');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$company_name = $row->company_name;
			}    

			return $company_name;
		}
		else {
			return "";
		}	
    }
	
	function get_file_by_id($id) {
        $this->db->select('company_image');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$company_image = $row->company_image;
			}    

			return $company_image;
		}
		else {
			return "";
		}	
    }
	function get_phone_by_id($id) {
        $this->db->select('company_phone');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$company_phone = $row->company_phone;
			}    

			return $company_phone;
		}
		else {
			return "";
		}	
    }
	
	function get_email_by_id($id) {
        $this->db->select('company_email');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$company_email = $row->company_email;
			}    

			return $company_email;
		}
		else {
			return "";
		}	
    }
	
	function get_address_by_id($id) {
        $this->db->select('company_address');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$company_address = $row->company_address;
			}    

			return $company_address;
		}
		else {
			return "";
		}	
    }	 
}		