<?php

class M_preference extends CI_Model {

	public $tb = 'tm_preference';
	public $fd = 'preference_id';
	
	function get_desc_by_id($id) {
        $this->db->select('preference_description');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$preference_description = $row->preference_description;
			}    

			return $preference_description;
		}
		else {
			return "";
		}	
    }
}		