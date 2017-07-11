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
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_excel('man-power');" class="btn btn-sm btn-social">
								<i class="fa fa-print"></i> To Excel
							</a> 
						</div>
					</div>
					<div class="col-sm-12">
						<span class="col-sm-4"></span>
						<div class="col-sm-8" style="margin-top:10px;">
							<form action="<?php echo base_url(); ?>report/man-power" method="POST">
								<span class="col-sm-2"></span>
								<div class="form-group col-sm-5">
									<select class="form-control select2" name="department">
										<option value="" disabled selected>Select Department</option>
										<?php $department = $this->m_global->get_list('tm_department', 'department_status');
										foreach ($department as $rows) { ?>
											<option value="<?php echo $rows->department_id; ?>" <?php echo ($this->session->userdata('department')==$rows->department_id)?"selected":""; ?> ><?php echo $rows->department_name; ?></option>
										<?php } ?>
									</select>	
								</div>
								<div class="form-group col-sm-4">
									<select class="form-control select2" name="status">
										<option value="" disabled selected>Select Status</option>
										<?php for($i=0; $i<=1; $i++) { ?>
										<option value="<?php echo $i; ?>" <?php echo (($this->session->userdata('status') == $i)?"Selected":""); ?>><?php echo get_status($i); ?></option>
										<?php } ?>
									</select>
								</div>   
								<div class="pull-right col-sm-1">
									<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
								</div><!-- /.form group -->
							</form>
						</div>
					</div>
					<div class="box-body table-responsive">
						<table id="example1" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th width="15%">Area</th>
									<th width="20%">Department</th>
									<th width="15%">Unit</th>
									<th>Description</th>
									<th width="10%">Status</th>	
									<th width="8%">Detail</th>		
								</tr>
							</thead>
							<tbody>
							  <?php foreach($list as $row) : ?>
								<tr>
									<td><?php echo strip_tags($this->m_area->get_name_by_id($row->area_id)); ?></td>
									<td><?php echo strip_tags($this->m_department->get_name_by_id($row->department_id)); ?></td>
									<td><?php echo strip_tags($this->m_unit->get_name_by_id($row->unit_id)); ?></td>
									<td><?php echo ((strlen($row->manpower_description) > 75)?strip_tags(substr($row->manpower_description, 0, 75) ." ..."):strip_tags($row->manpower_description)); ?></td>
									<td align="center"><?php echo get_status($row->manpower_status); ?></td>
									<td align="center">
										<div class="btn-group">
											<a href="javascript:void(0);" onClick="link_detail('report/man-power', '<?php echo simple_encrypt($row->manpower_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-newspaper-o"></i></a>
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