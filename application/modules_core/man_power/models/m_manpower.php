<?php

class M_manpower extends CI_Model {

	public $tb = 'tp_manpower';
	public $fd = 'manpower_id';
	
	function get_status_by_id($id) {
        $this->db->select('manpower_status');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$manpower_status = $row->manpower_status;
			}    

			return $manpower_status;
		}
		else {
			return 0;
		}	
    }
	
	function get_isapproved_by_id($id) {
        $this->db->select('is_approved');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$is_approved = $row->is_approved;
			}    

			return $is_approved;
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
	
	function get_department_by_id($id) {
        $this->db->select('department_id');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$department_id = $row->department_id;
			}    

			return $department_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_unit_by_id($id) {
        $this->db->select('unit_id');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$unit_id = $row->unit_id;
			}    

			return $unit_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_prepared_by_id($id) {
        $this->db->select('manpower_prepared');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$manpower_prepared = $row->manpower_prepared;
			}    

			return $manpower_prepared;
		}
		else {
			return 0;
		}	
    }
	
	function get_approved_by_id($id) {
        $this->db->select('manpower_approved');
		$this->db->from($this->tb);
		$this->db->where($this->fd, $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$manpower_approved = $row->manpower_approved;
			}    

			return $manpower_approved;
		}
		else {
			return 0;
		}	
    }
	
	function get_id_by_detail($id) {
        $this->db->select('manpower_id');
		$this->db->from('td_manpower');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$manpower_id = $row->manpower_id;
			}    

			return $manpower_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_position_by_detail($id) {
        $this->db->select('position_id');
		$this->db->from('td_manpower');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$position_id = $row->position_id;
			}    

			return $position_id;
		}
		else {
			return 0;
		}	
    }
	
	function get_mpp_by_detail($id) {
        $this->db->select('mpp');
		$this->db->from('td_manpower');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$mpp = $row->mpp;
			}    

			return $mpp;
		}
		else {
			return 0;
		}	
    }
	
	function get_actual_by_detail($id) {
        $this->db->select('actual');
		$this->db->from('td_manpower');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$actual = $row->actual;
			}    

			return $actual;
		}
		else {
			return 0;
		}	
    }
	
	function get_process_in_by_detail($id) {
        $this->db->select('process_in');
		$this->db->from('td_manpower');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$process_in = $row->process_in;
			}    

			return $process_in;
		}
		else {
			return 0;
		}	
    }
	
	function get_process_out_by_detail($id) {
        $this->db->select('process_out');
		$this->db->from('td_manpower');
		$this->db->where('id', $id); 
		$query = $this->db->get();    
        
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$process_out = $row->process_out;
			}    

			return $process_out;
		}
		else {
			return 0;
		}	
    }
	
	function get_report_all() {
		$this->db->select('*');
		$this->db->from($this->tb);
		
		if($this->session->userdata('department') != ""){
			$this->db->where('department_id', $this->session->userdata('department'));
		}
		
		if($this->session->userdata('status') != 11){
			$this->db->where('manpower_status', $this->session->userdata('status'));
		}
		
		if($this->session->userdata('authority_id') != 5){
			$this->db->where('area_id', $this->session->userdata('area_id')); 
		}
		
		$this->db->order_by('manpower_id', 'ASC');
		$this->db->order_by('unit_id', 'ASC');
		$query = $this->db->get();
        return $query->result();
	}
}		