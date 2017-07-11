<?php

class M_position extends CI_Model {

	public $tb = 'tm_position';
	public $fd = 'position_id';
	
	function get_name_by_id($id) {
        $this->db->select('position_name');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$position_name = $row->position_name;
			}    

			return $position_name;
		}
		else {
			return "";
		}	
    }
}		