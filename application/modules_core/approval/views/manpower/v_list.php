<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<?php
			if($this->session->flashdata('message') != "") {
				$data['status'] = $this->session->flashdata('status');	
				$data['notify'] = $this->session->flashdata('message');
				$this->load->view('../v_alert', $data);
			}
		?>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-xs-12">
				<!-- Default box -->
				<div class="box box-default box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">List Man Power</h3>
					</div>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th width="15%">Area</th>
									<th width="20%">Department</th>
									<th width="15%">Unit</th>
									<th width="20%">Prepared By</th>
									<th>Description</th>
									<th width="8%">Action</th>								
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $row) : ?>
								<tr>
									<td><?php echo strip_tags($this->m_area->get_name_by_id($row->area_id)); ?></td>
									<td><?php echo strip_tags($this->m_department->get_name_by_id($row->department_id)); ?></td>
									<td><?php echo strip_tags($this->m_unit->get_name_by_id($row->unit_id)); ?></td>
									<td><?php echo strip_tags($this->m_user->get_name_by_id($row->prepared_id)); ?></td>
									<td><?php echo ((strlen($row->manpower_description) > 75)?strip_tags(substr($row->manpower_description, 0, 75) ." ..."):strip_tags($row->manpower_description)); ?></td>
									<td align="center">
										<div class="btn-group">
											<a href="javascript:void(0);" onClick="edit_data('approval/man-power', '<?php echo simple_encrypt($row->manpower_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>	
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->