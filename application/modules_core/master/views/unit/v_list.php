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
						<h3 class="box-title">List Unit</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_add('master/unit');" class="btn btn-sm btn-social">
								<i class="fa fa-plus-square"></i> Add Data
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th width="10%">Status</th>
									<th width="8%">Action</th>								
								</tr>
							</thead>
							<tbody>
							  <?php foreach($list as $row) : ?>
								<tr>
									<td><?php echo strip_tags($row->unit_name); ?></td>
									<td align="center"><?php echo get_status($row->unit_status); ?></td>
									<td align="center">
										<div class="btn-group">
											<a href="javascript:void(0);" onClick="edit_data('master/unit', '<?php echo simple_encrypt($row->unit_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
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