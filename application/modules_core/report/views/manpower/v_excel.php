<?php  
    header("Cache-Control: no-cache, no-store, must-revalidate");  
    header("Content-Type: application/vnd.ms-excel");  
    header("Content-Disposition: attachment; filename=Report-Man-Power.xls");  
?> 
<table width="100%" border="1">
    <tr>
        <th height="50" width="50" align="center" bgcolor="#eff3f8">No</th>
		<th width="150" align="center" bgcolor="#eff3f8">Area</th>
        <th width="150" align="center" bgcolor="#eff3f8">Department</th>
        <th width="200" align="center" bgcolor="#eff3f8">Unit</th>
        <th width="500" align="center" bgcolor="#eff3f8">Description</th>
		<th width="200" align="center" bgcolor="#eff3f8">Prepared By</th>
		<th width="200" align="center" bgcolor="#eff3f8">Approval By</th>
		<th width="120" align="center" bgcolor="#eff3f8">Date</th>
		<th width="80" align="center" bgcolor="#eff3f8">Time</th>
		<th width="400" align="center" bgcolor="#eff3f8">Description</th>
		<th width="100" align="center" bgcolor="#eff3f8">Status</th>
   </tr>
    <?php $number=0; if(count($list) != 0) { ?>
    <?php foreach($list as $row) :  ?>
        <tr>
            <td height="20" align="center"><?php echo ++$number; ?></td>
			<td><?php echo strip_tags($this->m_area->get_name_by_id($row->area_id)); ?></td>
			<td><?php echo strip_tags($this->m_department->get_name_by_id($row->department_id)); ?></td>
			<td><?php echo strip_tags($this->m_unit->get_name_by_id($row->unit_id)); ?></td>
			<td><?php echo strip_tags($row->manpower_description); ?></td>
			<td><?php echo strip_tags($this->m_user->get_name_by_id($row->prepared_id)); ?></td>
			<td><?php echo (($row->approval_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->approval_id))); ?></td>
			<td align="center"><?php echo (($row->approval_date == '')?'-':convert_to_dmy($row->approval_date)); ?></td>
			<td align="center"><?php echo (($row->approval_time == '')?'-':convert_to_his($row->approval_time)); ?></td>
			<td><?php echo strip_tags($row->approval_description); ?></td>
			<td align="center"><?php echo get_status($row->manpower_status); ?></td>
        </tr>
    <?php endforeach; ?>
    <?php } else { echo "<tr><td colspan='11' align='center'>Data Not Found</td></tr>";}?>  
</table>