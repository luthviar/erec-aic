<?php
	function format_mpp($id) {	
		// Get a reference to the controller object
		$CI =& get_instance();
		$CI->load->helper('status');
		$CI->load->helper('global');
		
		$CI->load->model('man_power/m_manpower');
		$CI->load->model('setting/m_area');
		$CI->load->model('master/m_department');
		$CI->load->model('master/m_unit');
		$CI->load->model('master/m_position');
		$CI->load->model('user/m_user');
			
		// set data
		$area 		= "";
		$department = "";
		$unit 		= "";
		
		$bottom = "";
		$detail = $CI->m_global->get_by_id('tp_manpower', 'manpower_id', $id);
		foreach($detail as $row) {
			$area 		= (($row->area_id == '')?'-':strip_tags($CI->m_area->get_name_by_id($row->area_id)));
			$department = (($row->department_id == '')?'-':strip_tags($CI->m_department->get_name_by_id($row->department_id)));
			$unit 		= (($row->unit_id == '')?'-':strip_tags($CI->m_unit->get_name_by_id($row->unit_id)));
			
			$detail_data = $CI->m_global->get_by_id_and_order('td_manpower', 'manpower_id', $row->manpower_id, 'id', 'ASC');
			
			$bottom .=
				'
					<tr>
						<td valign=top colspan=2 align=left>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=15>Approved By : '. (($row->approval_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->approval_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->approval_date == "")?"-":convert_to_dmy($row->approval_date)) .'</td>
						<td 202.182.52.74/mpp </td>
					</tr>
				';
		}
		
		$format = ""; $list = "";
		$count = count($detail_data);
		if($count > 0) {
			foreach($detail_data as $rows) { 
				$list .=
					'
						<tr>
							<td>&nbsp;&nbsp;'. strip_tags($CI->m_position->get_name_by_id($rows->position_id)) .'</td>
							<td align="center">'. $rows->mpp .'</td>
							<td align="center">'. $rows->actual .'</td>
						</tr>
					';
			}	
		}			
			
		$format = 
		'
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Notifikasi MPP</title>
			</head>
			<body>
				<table border=0 width=650>
					<tr>
						<td valign=top colspan=2 align=left height=15>
							<table border="0" width="100%">
								<tr>
									<td height="20" valign="top" width="100"><strong>Area</strong></td>
									<td valign="top" width="10"><strong>:</strong></td>
									<td valign="top" >'. $area .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Department</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $department .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Unit</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $unit .'</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign=top height=50>
							<table border=1 width=100%>
								<tr>
									<td height="20">&nbsp;&nbsp;Position</td>
									<td align="center" width="20%">MPP</td>
									<td align="center" width="20%">ACTUAL</td>
								</tr>
								'. $list .'
							</table>
						</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Prepared By : '. (($row->prepared_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->prepared_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->manpower_date == "")?"-":convert_to_dmy($row->manpower_date)) .'</td>
					</tr>
					'. $bottom .'
					<tr>
						<td valign=top colspan=2 align=left height=5>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=10>Please do not reply this message.</td>
					</tr>
				</table>
			</body>
		</html>
		';
		
		return $format;
	}
	
	function format_leave($id) {	
		// Get a reference to the controller object
		$CI =& get_instance();
		$CI->load->helper('status');
		$CI->load->helper('global');
		
		$CI->load->model('leave/m_leave');
		$CI->load->model('setting/m_area');
		$CI->load->model('master/m_department');
		$CI->load->model('master/m_unit');
		$CI->load->model('master/m_position');
		$CI->load->model('man_power/m_manpower');
		$CI->load->model('user/m_user');
			
		// set data
		$area 		= "";
		$department = "";
		$unit 		= "";
		$position 	= "";
		
		$bottom = "";
		$detail = $CI->m_global->get_by_id('tp_leave', 'leave_id', $id);
		foreach($detail as $row) {
			$area 		= strip_tags($CI->m_area->get_name_by_id($CI->m_manpower->get_area_by_id($CI->m_manpower->get_id_by_detail($row->mpp_id))));
			$department = strip_tags($CI->m_department->get_name_by_id($CI->m_manpower->get_department_by_id($CI->m_manpower->get_id_by_detail($row->mpp_id))));
			$unit 		= strip_tags($CI->m_unit->get_name_by_id($CI->m_manpower->get_unit_by_id($CI->m_manpower->get_id_by_detail($row->mpp_id))));
			$position 	= strip_tags($CI->m_position->get_name_by_id($CI->m_manpower->get_position_by_detail($row->mpp_id)));
			
			$detail_data = $CI->m_global->get_by_id_and_order('td_leave', 'leave_id', $row->leave_id, 'id', 'ASC');
			
			$bottom .=
				'
					<tr>
						<td valign=top colspan=2 align=left>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=15>Approved By : '. (($row->approval_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->approval_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->approval_date == "")?"-":convert_to_dmy($row->approval_date)) .'</td>
					</tr>
				';
		}
		
		$format = ""; $list = "";
		$count = count($detail_data);
		if($count > 0) {
			foreach($detail_data as $rows) { 
				$list .=
					'
						<tr>
							<td align="center">'. $rows->nik .'</td>
							<td>&nbsp;&nbsp;'. strip_tags($rows->name) .'</td>
						</tr>
					';
			}	
		}			
			
		$format = 
		'
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Notifikasi Leave</title>
			</head>
			<body>
				<table border=0 width=650>
					<tr>
						<td valign=top colspan=2 align=left height=15>
							<table border="0" width="100%">
								<tr>
									<td height="20" valign="top" width="100"><strong>Area</strong></td>
									<td valign="top" width="10"><strong>:</strong></td>
									<td valign="top" >'. $area .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Department</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $department .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Unit</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $unit .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Position</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $position .'</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign=top height=50>
							<table border=1 width=100%>
								<tr>
									<td height="20" align="center" width="25%">NIK</td>
									<td>&nbsp;&nbsp;Name</td>
								</tr>
								'. $list .'
							</table>
						</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Prepared By : '. (($row->prepared_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->prepared_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->leave_date == "")?"-":convert_to_dmy($row->leave_date)) .'</td>
					</tr>
					'. $bottom .'
					<tr>
						<td valign=top colspan=2 align=left height=5>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=10>Please do not reply this message.</td>
					</tr>
				</table>
			</body>
		</html>
		';
		
		return $format;
	}
	
	function format_request($id) {	
		// Get a reference to the controller object
		$CI =& get_instance();
		$CI->load->helper('status');
		$CI->load->helper('global');
		
		$CI->load->model('request/m_request');
		$CI->load->model('setting/m_area');
		$CI->load->model('master/m_department');
		$CI->load->model('master/m_unit');
		$CI->load->model('master/m_position');
		$CI->load->model('man_power/m_manpower');
		$CI->load->model('user/m_user');
			
		// set data
		$area 		= "";
		$department = "";
		$unit 		= "";
		$position 	= "";
		
		$approval1 = "";	$approval2 = "";	$recruitment = "";
		$detail = $CI->m_global->get_by_id('tp_request', 'request_id', $id);
		foreach($detail as $row) {
			$area 		= strip_tags($CI->m_area->get_name_by_id($CI->m_manpower->get_area_by_id($CI->m_manpower->get_id_by_detail($row->mpp_id))));
			$department = strip_tags($CI->m_department->get_name_by_id($CI->m_manpower->get_department_by_id($CI->m_manpower->get_id_by_detail($row->mpp_id))));
			$unit 		= strip_tags($CI->m_unit->get_name_by_id($CI->m_manpower->get_unit_by_id($CI->m_manpower->get_id_by_detail($row->mpp_id))));
			$position 	= strip_tags($CI->m_position->get_name_by_id($CI->m_manpower->get_position_by_detail($row->mpp_id)));
			$overdue	= convert_to_dmy($row->request_overdue);
			
			$detail_data = $CI->m_global->get_by_id_and_order('td_request', 'request_id', $row->request_id, 'id', 'ASC');
			
			
			$approval1 .=
				'
					<tr>
						<td valign=top colspan=2 align=left>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=15>Approval 1 By : '. (($row->approval1_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->approval1_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->approval1_date == "")?"-":convert_to_dmy($row->approval1_date)) .'</td>
					</tr>
				';
				
			$approval2 .=
				'
					<tr>
						<td valign=top colspan=2 align=left>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=15>Approval 2 By : '. (($row->approval2_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->approval2_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->approval2_date == "")?"-":convert_to_dmy($row->approval2_date)) .'</td>
					</tr>
				';
				
			$recruitment .=
				'
					<tr>
						<td valign=top colspan=2 align=left>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=15>Recruitment By : '. (($row->recruitment_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->recruitment_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->recruitment_date == "")?"-":convert_to_dmy($row->recruitment_date)) .'</td>
					</tr>
				';
		}
		
		$format = ""; $list = "";
		$count = count($detail_data);
		if($count > 0) {
			foreach($detail_data as $rows) { 
				$list .=
					'
						<tr>
							<td align="center">'. $rows->nik .'</td>
							<td>&nbsp;&nbsp;'. strip_tags($rows->name) .'</td>
							<td align="center">'. (($rows->join == "")?"-":convert_to_dmy($rows->join)) .'</td>
						</tr>
					';
			}	
		}			
			
		$format = 
		'
		<html>
			<head>
				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
				<title>Notifikasi Request</title>
			</head>
			<body>
				<table border=0 width=650>
					<tr>
						<td valign=top colspan=2 align=left height=15>
							<table border="0" width="100%">
								<tr>
									<td height="20" valign="top" width="100"><strong>Area</strong></td>
									<td valign="top" width="10"><strong>:</strong></td>
									<td valign="top" >'. $area .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Department</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $department .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Unit</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $unit .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Position</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $position .'</td>
								</tr>
								<tr>
									<td height="20" valign="top"><strong>Overdue</strong></td>
									<td valign="top"><strong>:</strong></td>
									<td valign="top" >'. $overdue .'</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td valign=top height=50>
							<table border=1 width=100%>
								<tr>
									<td height="20" align="center" width="20%">NIK</td>
									<td>&nbsp;&nbsp;Name</td>
									<td height="20" align="center" width="15%">Join</td>
								</tr>
								'. $list .'
							</table>
						</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Prepared By : '. (($row->prepared_id == "")?"-":strip_tags($CI->m_user->get_name_by_id($row->prepared_id))) .'</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=5>Date : '. (($row->request_date == "")?"-":convert_to_dmy($row->request_date)) .'</td>
					</tr>
					'. $approval1 .'
					'. $approval2 .'
					'. $recruitment .'
					<tr>
						<td valign=top colspan=2 align=left height=5>&nbsp;</td>
					</tr>
					<tr>
						<td valign=top colspan=2 align=left height=10>Please do not reply this message.</td>
					</tr>
				</table>
			</body>
		</html>
		';
		
		return $format;
	}
?>