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
						<h3 class="box-title">List Leave</h3>
					</div>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th width="12%">Code</th>
									<th width="12%">Date</th>
									<th width="15%">Position</th>
									<th width="10%">Count</th>
									<th>Description</th>
									<th width="10%">Status</th>
									<th width="8%">Action</th>								
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $row) : ?>
								<tr>
									<td align="center"><?php echo $row->leave_code; ?></td>
									<td align="center"><?php echo convert_to_dmy($row->leave_date); ?></td>
									<td><?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?></td>
									<td align="center"><?php echo $row->leave_count; ?></td>
									<td><?php echo ((strlen($row->leave_description) > 75)?strip_tags(substr($row->leave_description, 0, 75) ." ..."):strip_tags($row->leave_description)); ?></td>
									<td align="center"><?php echo get_approved($row->leave_status); ?></td>
									<td align="center">
										<div class="btn-group">
											<a href="javascript:void(0);" onClick="edit_data('approval/leave', '<?php echo simple_encrypt($row->leave_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
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