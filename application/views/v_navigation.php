<?php
	$nav_dashboard = ""; $nav_setting = ""; $nav_master = ""; $nav_user = ""; $nav_manpower = "";	$nav_leave = "";	$nav_request = "";	$nav_checking = "";	$nav_recruit = "";	$nav_apply = "";	$nav_approval = "";	$nav_report = "";
	switch($this->session->userdata('nav_active')) {
		case "dashboard" :
			$nav_dashboard = ' active"';
		break;
		case "setting" :
			$nav_setting = ' active"';
		break;
		case "master" :
			$nav_master = ' active';
		break;
		case "user" :
			$nav_user = ' active"';
		break;
		case "manpower" :
			$nav_manpower = ' active"';
		break;
		case "leave" :
			$nav_leave = ' active"';
		break;
		case "request" :
			$nav_request = ' active"';
		break;
		case "approval" :
			$nav_approval = ' active"';
		break;
		case "checking" :
			$nav_checking = ' active"';
		break;
		case "recruit" :
			$nav_recruit = ' active"';
		break;
		case "apply" :
			$nav_apply = ' active"';
		break;
		case "report" :
			$nav_report = ' active"';
		break;
	}
	
	$sub_setting_company = ""; 		$sub_setting_preference = ""; 	$sub_setting_area = ""; $sub_setting_authority = ""; 
	$sub_master_department = "";	$sub_master_unit = "";			$sub_master_position = "";
	$sub_approval_manpower = "";	$sub_approval_leave = "";		$sub_approval_request = "";	
	$sub_report_mpp = "";			$sub_report_leave = "";			$sub_report_request = "";
	switch($this->session->userdata('sub_active')) {
		case "setting_company" :
			$sub_setting_company = ' active"';
		break;
		case "setting_preference" :
			$sub_setting_preference = ' active"';
		break;
		case "setting_area" :
			$sub_setting_area = ' active"';
		break;
		case "setting_authority" :
			$sub_setting_authority = ' active"';
		break;
		
		case "master_department" :
			$sub_master_department = ' active';
		break;
		case "master_unit" :
			$sub_master_unit = ' active';
		break;
		case "master_position" :
			$sub_master_position = ' active';
		break;
		
		case "approval_manpower" :
			$sub_approval_manpower = ' active';
		break;
		case "approval_leave" :
			$sub_approval_leave = ' active';
		break;
		case "approval_request" :
			$sub_approval_request = ' active';
		break;
		
		case "report_mpp" :
			$sub_report_mpp = ' active';
		break;
		case "report_leave" :
			$sub_report_leave = ' active';
		break;
		case "report_request" :
			$sub_report_request = ' active';
		break;
	}
?>
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu">
	<li class="header" style="background-color:#444444;padding:1px;"></li>
	<li class="<?php echo $nav_dashboard; ?>"><a href="javascript:void(0);" OnClick="link_to('dashboard')"><i class="fa fa-dashboard"></i> <span> Dashboard</span></a></li>
	<?php if($this->session->userdata('authority_id') == 1) { ?>
	<li class="treeview <?php echo $nav_setting; ?>">
		<a href="javascript:void(0);">
			<i class="fa fa-cog"></i> <span> Setting</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li class="<?php echo $sub_setting_company; ?>"><a href="javascript:void(0);" OnClick="link_to('setting/company')"><i class="fa fa-angle-double-right"></i> Company</a></li>
			<li class="<?php echo $sub_setting_preference; ?>"><a href="javascript:void(0);" OnClick="link_to('setting/preference')"><i class="fa fa-angle-double-right"></i> Preference</a></li>
			<li class="<?php echo $sub_setting_area; ?>"><a href="javascript:void(0);" OnClick="link_to('setting/area')"><i class="fa fa-angle-double-right"></i> Area</a></li>
			<li class="<?php echo $sub_setting_authority; ?>"><a href="javascript:void(0);" OnClick="link_to('setting/authority')"><i class="fa fa-angle-double-right"></i> Authority</a></li>
		</ul>
	</li>
	<li class="treeview <?php echo $nav_master; ?>">
		<a href="javascript:void(0);">
			<i class="fa fa-sliders"></i> <span> Master</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li class="<?php echo $sub_master_department; ?>"><a href="javascript:void(0);" OnClick="link_to('master/department')"><i class="fa fa-angle-double-right"></i> Department</a></li>
			<li class="<?php echo $sub_master_unit; ?>"><a href="javascript:void(0);" OnClick="link_to('master/unit')"><i class="fa fa-angle-double-right"></i> Unit</a></li>
			<li class="<?php echo $sub_master_position; ?>"><a href="javascript:void(0);" OnClick="link_to('master/position')"><i class="fa fa-angle-double-right"></i> Position</a></li>
		</ul>
	</li>
	<li class="<?php echo $nav_user; ?>"><a href="javascript:void(0);" OnClick="link_to('user')"><i class="fa fa-user"></i> <span> User</span></a></li>
	<?php } ?> 
	
	<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4) || ($this->session->userdata('authority_id') == 5)) { ?>
	<li class="<?php echo $nav_manpower; ?>"><a href="javascript:void(0);" OnClick="link_to('man-power')"><i class="fa fa-table"></i> <span> Man Power</span></a></li>
	<?php } ?>
	<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { ?>
	<li class="<?php echo $nav_apply; ?>"><a href="javascript:void(0);" OnClick="link_to('apply')"><i class="fa fa-file-text-o"></i> <span> Apply</span></a></li>
	<?php } ?>
	<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { ?>
	<li class="<?php echo $nav_leave; ?>"><a href="javascript:void(0);" OnClick="link_to('leave')"><i class="fa fa-sign-out"></i> <span> Leave</span></a></li>
	<li class="<?php echo $nav_request; ?>"><a href="javascript:void(0);" OnClick="link_to('request')"><i class="fa fa-sign-in"></i> <span> Request</span></a></li>
	<?php } ?>

	<?php if(($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 5)) { ?>
	<li class="treeview <?php echo $nav_approval; ?>">
		<a href="javascript:void(0);">
			<i class="fa fa-check-circle"></i> <span> Approval</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li class="<?php echo $sub_approval_leave; ?>"><a href="javascript:void(0);" OnClick="link_to('approval/leave')"><i class="fa fa-angle-double-right"></i> Leave</a></li>
			<?php if($this->session->userdata('authority_id') == 3) { ?>
			<li class="<?php echo $sub_approval_request; ?>"><a href="javascript:void(0);" OnClick="link_to('approval/request')"><i class="fa fa-angle-double-right"></i> Request</a></li>
			<?php } ?>
		</ul>
	</li>
	<?php } ?>

	<?php if($this->session->userdata('authority_id') == 5) { ?>
	<li class="<?php echo $nav_checking; ?>"><a href="javascript:void(0);" OnClick="link_to('checking')"><i class="fa fa-check-circle-o"></i> <span> Checking</span></a></li>
	<?php } ?>

	<?php if($this->session->userdata('authority_id') == 6) { ?>
	<li class="<?php echo $nav_recruit; ?>"><a href="javascript:void(0);" OnClick="link_to('recruit')"><i class="fa fa-file-text"></i> <span> Recruit</span></a></li>
	<?php } ?>
	
	<?php if($this->session->userdata('authority_id') != 1) { ?>
	<li class="treeview <?php echo $nav_report; ?>">
		<a href="javascript:void(0);">
			<i class="fa fa-calendar"></i> <span> Report</span>
			<i class="fa fa-angle-left pull-right"></i>
		</a>
		<ul class="treeview-menu">
			<li class="<?php echo $sub_report_mpp; ?>"><a href="javascript:void(0);" OnClick="link_to('report/man-power')"><i class="fa fa-angle-double-right"></i> Man Power</a></li>
			<li class="<?php echo $sub_report_leave; ?>"><a href="javascript:void(0);" OnClick="link_to('report/leave')"><i class="fa fa-angle-double-right"></i> Leave</a></li>
			<li class="<?php echo $sub_report_request; ?>"><a href="javascript:void(0);" OnClick="link_to('report/request')"><i class="fa fa-angle-double-right"></i> Request</a></li>
		</ul>
	</li>
	<?php } ?>
</ul>