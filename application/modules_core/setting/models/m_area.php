<?php

class M_area extends CI_Model {

	public $tb = 'tm_area';
	public $fd = 'area_id';
	
	function get_name_by_id($id) {
        $this->db->select('area_name');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$area_name = $row->area_name;
			}    

			return $area_name;
		}
		else {
			return "";
		}	
    }
}		