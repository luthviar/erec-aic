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
						<?php if($this->session->userdata('authority_id') == 5) { ?>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_add('man-power');" class="btn btn-sm btn-social">
								<i class="fa fa-plus-square"></i> Add Data
							</a> 
						</div>
						<?php } ?>
					</div>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th width="15%">Area</th>
									<th width="20%">Department</th>
									<th width="15%">Unit</th>
									<th>Description</th>
									<?php if($this->session->userdata('authority_id') == 5) { ?>
									<th width="10%">Approved</th>
									<?php } ?>
									<th width="10%">Status</th>
									<th width="8%">Action</th>								
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $row) : ?>
								<tr>
									<td><?php echo strip_tags($this->m_area->get_name_by_id($row->area_id)); ?></td>
									<td><?php echo strip_tags($this->m_department->get_name_by_id($row->department_id)); ?></td>
									<td><?php echo strip_tags($this->m_unit->get_name_by_id($row->unit_id)); ?></td>
									<td><?php echo ((strlen($row->manpower_description) > 75)?strip_tags(substr($row->manpower_description, 0, 75) ." ..."):strip_tags($row->manpower_description)); ?></td>
									<?php if($this->session->userdata('authority_id') == 5) { ?>
									<td align="center"><?php echo (($row->is_approved == 0)?"No":"Yes"); ?></td>
									<?php } ?>
									<td align="center"><?php echo get_status($row->manpower_status); ?></td>
									<td align="center">
										<div class="btn-group">
											<?php if($this->session->userdata('authority_id') == 5) { ?>
											<a href="javascript:void(0);" onClick="edit_data('man-power', '<?php echo simple_encrypt($row->manpower_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
											<?php } else { ?>
											<a href="javascript:void(0);" onClick="link_detail('man-power', '<?php echo simple_encrypt($row->manpower_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>	
											<?php } ?>
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