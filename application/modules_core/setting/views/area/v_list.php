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
						<h3 class="box-title">List Area</h3>
					</div>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th>Name</th>
								</tr>
							</thead>
							<tbody>
							  <?php foreach($list as $row) : ?>
								<tr>
									<td><?php echo strip_tags($row->area_name); ?></td>
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