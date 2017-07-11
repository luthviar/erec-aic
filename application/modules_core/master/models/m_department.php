<?php

class M_department extends CI_Model {

	public $tb = 'tm_department';
	public $fd = 'department_id';
	
	function get_name_by_id($id) {
        $this->db->select('department_name');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$department_name = $row->department_name;
			}    

			return $department_name;
		}
		else {
			return "";
		}	
    }
}		