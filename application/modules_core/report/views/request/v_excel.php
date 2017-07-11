<?php  
    header("Cache-Control: no-cache, no-store, must-revalidate");  
    header("Content-Type: application/vnd.ms-excel");  
    header("Content-Disposition: attachment; filename=Report-Request.xls");  
?> 
<table width="100%" border="1">
    <tr>
        <th height="50" width="50" align="center" bgcolor="#eff3f8">No</th>
		<th width="120" align="center" bgcolor="#eff3f8">Code</th>
        <th width="120" align="center" bgcolor="#eff3f8">Request Date</th>
		<th width="80" align="center" bgcolor="#eff3f8">Time</th>
		<th width="200" align="center" bgcolor="#eff3f8">Area</th>
		<th width="200" align="center" bgcolor="#eff3f8">Position</th>
		<th width="100" align="center" bgcolor="#eff3f8">Count</th>
		<th width="400" align="center" bgcolor="#eff3f8">Description</th>
		<th width="200" align="center" bgcolor="#eff3f8">Prepared By</th>
		<th width="200" align="center" bgcolor="#eff3f8">Approval 1 By</th>
		<th width="120" align="center" bgcolor="#eff3f8">Date</th>
		<th width="80" align="center" bgcolor="#eff3f8">Time</th>
		<th width="400" align="center" bgcolor="#eff3f8">Description</th>
		<th width="200" align="center" bgcolor="#eff3f8">Approval 2 By</th>
		<th width="120" align="center" bgcolor="#eff3f8">Date</th>
		<th width="80" align="center" bgcolor="#eff3f8">Time</th>
		<th width="400" align="center" bgcolor="#eff3f8">Description</th>
		<th width="200" align="center" bgcolor="#eff3f8">Recruitment By</th>
		<th width="120" align="center" bgcolor="#eff3f8">Date</th>
		<th width="80" align="center" bgcolor="#eff3f8">Time</th>
		<th width="400" align="center" bgcolor="#eff3f8">Description</th>
		<th width="200" align="center" bgcolor="#eff3f8">Closed By</th>
		<th width="120" align="center" bgcolor="#eff3f8">Date</th>
		<th width="80" align="center" bgcolor="#eff3f8">Time</th>
		<th width="400" align="center" bgcolor="#eff3f8">Description</th>
		<th width="100" align="center" bgcolor="#eff3f8">Status</th>
   </tr>
    <?php $number=0; if(count($list) != 0) { ?>
    <?php foreach($list as $row) :  ?>
        <tr>
            <td height="20" align="center"><?php echo ++$number; ?></td>
			<td align="center"><?php echo $row->request_code; ?></td>
			<td align="center"><?php echo convert_to_dmy($row->request_date); ?></td>
			<td align="center"><?php echo convert_to_his($row->request_time); ?></td>
			<td><?php echo strip_tags($this->m_area->get_name_by_id($row->area_id)); ?></td>
			<td><?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?></td>
			<td align="center"><?php echo $row->request_count; ?></td>
			<td><?php echo strip_tags($row->request_description); ?></td>
			<td><?php echo strip_tags($this->m_user->get_name_by_id($row->prepared_id)); ?></td>
			<td><?php echo (($row->approval1_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->approval1_id))); ?></td>
			<td align="center"><?php echo (($row->approval1_date == '')?'-':convert_to_dmy($row->approval1_date)); ?></td>
			<td align="center"><?php echo (($row->approval1_time == '')?'-':convert_to_his($row->approval1_time)); ?></td>
			<td><?php echo strip_tags($row->approval1_description); ?></td><td><?php echo (($row->approval2_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->approval2_id))); ?></td>
			<td align="center"><?php echo (($row->approval2_date == '')?'-':convert_to_dmy($row->approval2_date)); ?></td>
			<td align="center"><?php echo (($row->approval2_time == '')?'-':convert_to_his($row->approval2_time)); ?></td>
			<td><?php echo strip_tags($row->approval2_description); ?></td>
			<td><?php echo (($row->recruitment_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->recruitment_id))); ?></td>
			<td align="center"><?php echo (($row->recruitment_date == '')?'-':convert_to_dmy($row->recruitment_date)); ?></td>
			<td align="center"><?php echo (($row->recruitment_time == '')?'-':convert_to_his($row->recruitment_time)); ?></td>
			<td><?php echo strip_tags($row->recruitment_description); ?></td>
			<td><?php echo (($row->closed_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->closed_id))); ?></td>
			<td align="center"><?php echo (($row->closed_date == '')?'-':convert_to_dmy($row->closed_date)); ?></td>
			<td align="center"><?php echo (($row->closed_time == '')?'-':convert_to_his($row->closed_time)); ?></td>
			<td><?php echo strip_tags($row->closed_description); ?></td>
			<td align="center"><?php echo get_approved($row->request_status); ?></td>
		</tr>
    <?php endforeach; ?>
    <?php } else { echo "<tr><td colspan='26' align='center'>Data Not Found</td></tr>";}?>  
</table>