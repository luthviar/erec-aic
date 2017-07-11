<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

	public function __construct() {
    	parent::__construct();
		
		$this->load->helper('status');
	}
	
	function province_by_island() {
        $id = $this->input->post('island') ;
       
		$result = $this->m_global->get_by_id_order('tm_province', 'island_id', $id, 'province_status', 1, 'province_id', 'ASC');
		echo '<option value="" disabled selected>Pilih Propinsi</option>';
		foreach($result as $row ) {
			echo "<option value='". $row->province_id ."'>". strip_tags($row->province_name) ."</option>";
		}
    }
	
	function city_by_province() {
        $id = $this->input->post('province') ;
       
		$result = $this->m_global->get_by_id_order('tm_city', 'province_id', $id, 'city_status', 1, 'city_id', 'ASC');
		echo '<option value="" disabled selected>Pilih Kabupaten / Kota</option>';
		foreach($result as $row ) {
			echo "<option value='". $row->city_id ."'>". strip_tags($row->city_name) ."</option>";
		}
    }
	
	function branch_by_city() {
        $id = $this->input->post('city') ;
       
		$result = $this->m_global->get_by_id_order('tm_branch', 'city_id', $id, 'branch_status', 1, 'branch_id', 'ASC');
		echo '<option value="" disabled selected>Pilih Cabang</option>';
		foreach($result as $row ) {
			echo "<option value='". $row->branch_id ."'>". strip_tags($row->branch_name) ."</option>";
		}
    }
	
	function detail_manpower() {
        $id = $this->input->post('id') ;
       
		$str = "";
		$result = $this->m_global->get_by_id('td_manpower', 'id', $id);
		
		foreach($result as $row ) {
			$mpp 		= $row->mpp;
			$status 	= $row->status;
			$position 	= strip_tags($this->load->model('master/m_position')->get_name_by_id($row->position_id));
			$str .= 
				'
					<div class="form-group">
						<label class="col-sm-2 control-label"></label>
						<div class="col-sm-5">
							<input type="radio" name="status" value="1" '. (($status == 1)?"Checked":"") .' /> <label>'. get_status(1) .'</label>
						</div>
						<div class="col-sm-5">
							<input type="radio" name="status" value="0" '. (($status == 0)?"Checked":"") .' /> <label>'. get_status(0) .'</label>
						</div>
					</div>
					<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">Position</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="'. $position .'" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">MPP</label>
								<div class="col-sm-3">
									<input type="number" class="form-control" value="'. $mpp .'" name="mpp" autocomplete="off" min="0" max="100" style="text-align: right;padding-right: 2px;" />
									<p class="help-block">max = 100</p>
								</div>
							</div>
						</div><!-- /.box-body -->	
					</div><!-- /.box-body -->
				';
		}
		
		echo $str;
    }
	
	function actual_manpower() {
        $id = $this->input->post('id') ;
       
		$str = "";
		$result = $this->m_global->get_by_id('td_manpower', 'id', $id);
		
		foreach($result as $row ) {
			$mpp 		= $row->mpp;
			$actual 	= $row->actual;
			$position 	= strip_tags($this->load->model('master/m_position')->get_name_by_id($row->position_id));
			$str .= 
				'
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">Position</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="'. $position .'" readonly />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">MPP</label>
								<div class="col-sm-3">
									<input type="number" class="form-control" value="'. $mpp .'" name="mpp" readonly style="text-align: right;padding-right: 2px;" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Actual</label>
								<div class="col-sm-3">
									<input type="number" class="form-control" value="'. $actual .'" name="actual" autocomplete="off" min="0" max="100" style="text-align: right;padding-right: 2px;" />
									<p class="help-block">max = '. $mpp .'</p>
								</div>
							</div>
						</div><!-- /.box-body -->	
					</div><!-- /.box-body -->
				';
		}
		
		echo $str;
    }
	
	function badge_manpower() {
		$str = "";
		$result = $this->m_global->get_by_idss_order('tp_manpower', 'manpower_status', 1, 'is_approved', 0, 'area_id', $this->session->userdata('area_id'), 'manpower_id', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				$member_nm 	= strip_tags($this->load->model('master/m_department')->get_name_by_id($row->department_id)); 
				$member_nm	= ((strlen($member_nm) >= 20)?substr($member_nm, 0, 20)."...":$member_nm);
				
				$magazine_nm = strip_tags($this->load->model('master/m_unit')->get_name_by_id($row->unit_id)); 
				$magazine_nm = ((strlen($magazine_nm) >= 20)?substr($magazine_nm, 0, 20)."...":$magazine_nm);
				
				$str .= '
					<li>
						<a href="javascript:void(0);" onClick=link_to("man-power/detail-data/'.simple_encrypt($row->manpower_id).'")>
							<i class="fa fa-exclamation text-info"></i> '. $member_nm .' - '. $magazine_nm .'
						</a>
					</li>
				';	
			}
		}
		
		echo $str;
	}
	
	function count_manpower() {
		$str = "";
		$result = $this->m_global->get_by_idss_order('tp_manpower', 'manpower_status', 1, 'is_approved', 0, 'area_id', $this->session->userdata('area_id'), 'manpower_id', 'DESC');
		if(!empty($result)) {
			$str = '<span class="label-danger" style="position: absolute;top: 9px;right: 7px;text-align: center;font-size: 9px;padding: 2px 3px;line-height: .9;">'.count($result).'</span>';
		}
		
		echo $str;
	}
	
	function detail_leave() {
        $id = $this->input->post('id') ;
       
		$str = "";
		$result = $this->m_global->get_by_id('td_leave', 'id', $id);
		
		foreach($result as $row ) {
			$str .= 
				'
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">Nik</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" value="'. $row->nik .'" name="nik" autocomplete="off" required="" minlength="3" maxlength="25" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="'. strip_tags($row->name) .'" name="name" autocomplete="off" required="" minlength="3" maxlength="255" />
								</div>
							</div>
						</div><!-- /.box-body -->	
					</div><!-- /.box-body -->
				';
		}
		
		echo $str;
    }
	
	function badge_leave() {
		$str = "";
		$result = $this->m_global->get_by_id_order('tp_leave', 'leave_status', 9, 'area_id', $this->session->userdata('area_id'), 'leave_id', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				$nm = strip_tags($this->load->model('master/m_position')->get_name_by_id($this->load->model('man_power/m_manpower')->get_position_by_detail($row->mpp_id))); 
				$nm = ((strlen($nm) >= 20)?substr($nm, 0, 20)."...":$nm);
				
				$str .= '
					<li>
						<a href="javascript:void(0);" onClick=link_to("approval/leave/edit-data/'.simple_encrypt($row->leave_id).'")>
							<i class="fa fa-exclamation-triangle text-info"></i> '. $row->leave_count .' '. $nm . ' resign
						</a>
					</li>
				';	
			}
		}
		
		echo $str;
	}
	
	function count_leave() {
		$str = "";
		$result = $this->m_global->get_by_id_order('tp_leave', 'leave_status', 9, 'area_id', $this->session->userdata('area_id'), 'leave_id', 'DESC');
		if(!empty($result)) {
			$str = '<span class="label-danger" style="position: absolute;top: 9px;right: 7px;text-align: center;font-size: 9px;padding: 2px 3px;line-height: .9;">'.count($result).'</span>';
		}
		
		echo $str;
	}
	
	function badge_request() {
		$str = "";
		$result = $this->m_global->get_by_id_order('tp_request', 'request_status', 9, 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				$nm = strip_tags($this->load->model('master/m_position')->get_name_by_id($this->load->model('man_power/m_manpower')->get_position_by_detail($row->mpp_id))); 
				$nm = ((strlen($nm) >= 20)?substr($nm, 0, 20)."...":$nm);
				
				$str .= '
					<li>
						<a href="javascript:void(0);" onClick=link_to("approval/request/edit-data/'.simple_encrypt($row->request_id).'")>
							<i class="fa fa-exclamation-circle text-info"></i> '. $row->request_count .' requesting for '. $nm . '
						</a>
					</li>
				';	
			}
		}
		
		echo $str;
	}
	
	function count_request() {
		$str = "";
		$result = $this->m_global->get_by_id_order('tp_request', 'request_status', 9, 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		if(!empty($result)) {
			$str = '<span class="label-danger" style="position: absolute;top: 9px;right: 7px;text-align: center;font-size: 9px;padding: 2px 3px;line-height: .9;">'.count($result).'</span>';
		}
		
		echo $str;
	}
	
	function badge_checking() {
		$str = "";
		$result = $this->m_global->get_by_id_and_order('tp_request', 'request_status', 3, 'request_id', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				$nm = strip_tags($this->load->model('master/m_position')->get_name_by_id($this->load->model('man_power/m_manpower')->get_position_by_detail($row->mpp_id))); 
				$nm = ((strlen($nm) >= 20)?substr($nm, 0, 20)."...":$nm);
				
				$str .= '
					<li>
						<a href="javascript:void(0);" onClick=link_to("checking/edit-data/'.simple_encrypt($row->request_id).'")>
							<i class="fa fa-check-square text-info"></i> '. $row->request_count .' requesting for '. $nm . '
						</a>
					</li>
				';	
			}
		}
		
		echo $str;
	}
	
	function count_checking() {
		$str = "";
		$result = $this->m_global->get_by_id_and_order('tp_request', 'request_status', 3, 'request_id', 'DESC');
		if(!empty($result)) {
			$str = '<span class="label-danger" style="position: absolute;top: 9px;right: 7px;text-align: center;font-size: 9px;padding: 2px 3px;line-height: .9;">'.count($result).'</span>';
		}
		
		echo $str;
	}
	
	function badge_recruit() {
		$str = "";
		$result = $this->m_global->get_by_id_order_status_arr('tp_request', 'request_status', array(4, 8), 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				$nm = strip_tags($this->load->model('master/m_position')->get_name_by_id($this->load->model('man_power/m_manpower')->get_position_by_detail($row->mpp_id))); 
				$nm = ((strlen($nm) >= 20)?substr($nm, 0, 20)."...":$nm);
				
				$str .= '
					<li>
						<a href="javascript:void(0);" onClick=link_to("recruit/edit-data/'.simple_encrypt($row->request_id).'")>
							<i class="fa fa-file text-info"></i> '. $row->request_count .' requesting for '. $nm . '
						</a>
					</li>
				';	
			}
		}
		
		echo $str;
	}
	
	function count_recruit() {
		$str = "";
		$result = $this->m_global->get_by_id_order_status_arr('tp_request', 'request_status', array(4, 8), 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		if(!empty($result)) {
			$str = '<span class="label-danger" style="position: absolute;top: 9px;right: 7px;text-align: center;font-size: 9px;padding: 2px 3px;line-height: .9;">'.count($result).'</span>';
		}
		
		echo $str;
	}
	
	function detail_recruit() {
        $id = $this->input->post('id') ;
       
		$str = "";
		$result = $this->m_global->get_by_id('td_request', 'id', $id);
		
		foreach($result as $row ) {
			$str .= 
				'
					<div class="box-body table-responsive">
						<div class="box-body">
							<div class="form-group">
								<label class="col-sm-3 control-label">Nik</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" value="'. $row->nik .'" name="nik" autocomplete="off" required="" minlength="3" maxlength="25" />
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3 control-label">Name</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" value="'. strip_tags($row->name) .'" name="name" autocomplete="off" required="" minlength="3" maxlength="255" />
								</div>
							</div>
						</div><!-- /.box-body -->	
					</div><!-- /.box-body -->
				';
		}
		
		echo $str;
    }
	
	function badge_apply() {
		$str = "";
		$result = $this->m_global->get_by_id_order('tp_request', 'request_status', 5, 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		if(!empty($result)) {
			foreach($result as $row) {
				$nm = strip_tags($this->load->model('master/m_position')->get_name_by_id($this->load->model('man_power/m_manpower')->get_position_by_detail($row->mpp_id))); 
				$nm = ((strlen($nm) >= 20)?substr($nm, 0, 20)."...":$nm);
				
				$str .= '
					<li>
						<a href="javascript:void(0);" onClick=link_to("apply/edit-data/'.simple_encrypt($row->request_id).'")>
							<i class="fa fa-file-o text-info"></i> '. $row->request_count .' requesting for '. $nm . '
						</a>
					</li>
				';	
			}
		}
		
		echo $str;
	}
	
	function count_apply() {
		$str = "";
		$result = $this->m_global->get_by_id_order('tp_request', 'request_status', 5, 'area_id', $this->session->userdata('area_id'), 'request_id', 'DESC');
		if(!empty($result)) {
			$str = '<span class="label-danger" style="position: absolute;top: 9px;right: 7px;text-align: center;font-size: 9px;padding: 2px 3px;line-height: .9;">'.count($result).'</span>';
		}
		
		echo $str;
	}
}