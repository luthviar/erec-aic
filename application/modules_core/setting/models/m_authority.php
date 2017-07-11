<?php

class M_authority extends CI_Model {

	public $tb = 'tm_authority';
	public $fd = 'authority_id';
	
	function get_name_by_id($id) {
        $this->db->select('authority_name');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$authority_name = $row->authority_name;
			}    

			return $authority_name;
		}
		else {
			return "";
		}	
    }
}		