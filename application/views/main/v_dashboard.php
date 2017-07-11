<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Main content -->
	<?php foreach($detail as $row) : ?>
	<section class="content">
		<div class="callout callout-info">
			<h4><?php echo strip_tags($row->preference_hometittle); ?></h4>
			<p><?php echo $row->preference_homedescription; ?></p>
		</div>
		<!-- Default box -->
		<div class="box box-default box-solid">
			<div class="box-header with-border">
				<h3 class="box-title"><?php echo strip_tags($row->preference_messagetittle); ?></h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div class="box-body">
				<?php echo $row->preference_messagedescription; ?>
			</div><!-- /.box-body -->
		</div><!-- /.box -->
		
		<div class="row">
            <div class="col-md-6">
				<!-- USERS LIST -->
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-sign-out"></i> Latest Leave</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="table-responsive">
							<table class="table no-margin">
								<thead>
									<tr>
										<th width="15%">Code</th>
										<th width="18%">Date</th>
										<th>Position</th>
										<th width="10%">Count</th>
										<th width="10%">Status</th>	
									</tr>
								</thead>
								<tbody>
									<?php foreach($leave as $row) : ?>
									<?php 
										switch($row->leave_status) { 
											case 0 :
												$color = "info";
											break;
											case 1 :	
												$color = "success";
											break;
											case 2 :	
												$color = "danger";
											break;
											case 3 :	
												$color = "success";
											break;
											case 4 :	
												$color = "success";
											break;
											case 5 :	
												$color = "warning";
											break;	
											case 6 :	
												$color = "danger";
											break;	
											case 8 :	
												$color = "warning";
											break;	
											case 7 :	
												$color = "default";
											break;
											case 9 :	
												$color = "warning";
											break;	
											default :
												$color = "default";
											break;
										}
									?>
									<tr>
										<td align="center"><?php echo $row->leave_code; ?></td>
										<td align="center"><?php echo convert_to_dmy($row->leave_date); ?></td>
										<td><?php echo strip_tags($this->load->model('master/m_position')->get_name_by_id($this->load->model('man_power/m_manpower')->get_position_by_detail($row->mpp_id))); ?></td>
										<td align="center"><?php echo $row->leave_count; ?></td>
										<td align="center"><span class="label label-<?php echo $color; ?>"><?php echo get_approved($row->leave_status); ?></span></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.box-body -->
					<div class="box-footer text-center">
						<a href="javascript:void(0)" OnClick="link_to('report/leave');" class="uppercase">View All Leave</a>
					</div>
					<!-- /.box-footer -->
				</div>
				<!--/.box -->
            </div>
            <!-- /.col -->

            <div class="col-md-6">
				<!-- USERS LIST -->
				<div class="box box-default">
					<div class="box-header with-border">
						<h3 class="box-title"><i class="fa fa-sign-in"></i> Latest Request</h3>
						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body no-padding">
						<div class="table-responsive">
							<table class="table no-margin">
								<thead>
									<tr>
										<th width="15%">Code</th>
										<th width="18%">Date</th>
										<th>Position</th>
										<th width="10%">Count</th>
										<th width="10%">Status</th>	
									</tr>
								</thead>
								<tbody>
									<?php foreach($request as $row) : ?>
									<?php 
										switch($row->request_status) { 
											case 0 :
												$color = "info";
											break;
											case 1 :	
												$color = "success";
											break;
											case 2 :	
												$color = "danger";
											break;
											case 3 :	
												$color = "success";
											break;
											case 4 :	
												$color = "success";
											break;
											case 5 :	
												$color = "warning";
											break;	
											case 6 :	
												$color = "danger";
											break;	
											case 8 :	
												$color = "warning";
											break;	
											case 7 :	
												$color = "default";
											break;
											case 9 :	
												$color = "warning";
											break;	
											default :
												$color = "default";
											break;
										}
									?>
									<tr>
										<td align="center"><?php echo $row->request_code; ?></td>
										<td align="center"><?php echo convert_to_dmy($row->request_date); ?></td>
										<td><?php echo strip_tags($this->load->model('master/m_position')->get_name_by_id($this->load->model('man_power/m_manpower')->get_position_by_detail($row->mpp_id))); ?></td>
										<td align="center"><?php echo $row->request_count; ?></td>
										<td align="center"><span class="label label-<?php echo $color; ?>"><?php echo get_approved($row->request_status); ?></span></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<!-- /.table-responsive -->
					</div>
					<!-- /.box-body -->
					<div class="box-footer text-center">
						<a href="javascript:void(0)" OnClick="link_to('report/request');" class="uppercase">View All Request</a>
					</div>
					<!-- /.box-footer -->
				</div>
				<!--/.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
		
		<?php foreach($list as $row) : ?>
		<div>
			<!-- Default box -->
			<div class="box box-default box-solid">
				<div class="box-header with-border">
					<h3 class="box-title">UP DATE MAN POWER</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="col-sm-12">
					<form>
						<div class="box-body">
							<div class="form-group col-sm-12">
								<span class="col-sm-2">Area</span>
								<span class="col-sm-10">: <?php echo strip_tags($this->load->model('setting/m_area')->get_name_by_id($row->area_id)); ?></span> 
							</div>
							<div class="form-group col-sm-12">
								<span class="col-sm-2">Department</span>
								<span class="col-sm-10">: <?php echo strip_tags($this->load->model('master/m_department')->get_name_by_id($row->department_id)); ?></span> 
							</div>
							<div class="form-group col-sm-12">
								<span class="col-sm-2">Unit</span>
								<span class="col-sm-10">: <?php echo strip_tags($this->load->model('master/m_unit')->get_name_by_id($row->unit_id)); ?></span> 
							</div>
						</div>	
					</form>
				</div>
				<div class="box-body table-responsive">
					<table id="example1" class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th width="1%">NO</th>
								<th>Position</th>
								<th width="10%">MPP</th>
								<th width="10%">Actual</th>
								<th width="10%">Process</th>
								<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { ?>
								<th width="8%">Leave</th>
								<th width="8%">Request</th>	
								<?php } ?>
							</tr>
						</thead>
						<tbody>
							<?php 
								$no = 0;	$process = 0;
								$detail = $this->m_global->get_by_id('td_manpower', 'manpower_id', $row->manpower_id); 
								foreach($detail as $rows) {
									$no = $no + 1;
									$process = $rows->process_in + $rows->process_out;
							?>
							<tr>	
								<td align="center"><?php echo $no; ?></td>
								<td><?php echo strip_tags($this->load->model('master/m_position')->get_name_by_id($rows->position_id)); ?></td>
								<td align="center"><?php echo $rows->mpp; ?></td>
								<td align="center"><?php echo $rows->actual; ?></td>
								<td align="center"><?php echo $process; ?></td>	
								<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { ?>
								<td align="center">
									<div class="btn-group">
										<?php if(get_available(0, $rows->id) == 0) { ?>
										<a disabled href="javascript:void(0);" class="btn btn-default btn-sm"><i class="fa fa-sign-out"></i></a>	
										<?php } else { ?>
										<a href="javascript:void(0);" onClick="link_process('leave/man-power/<?php echo simple_encrypt($rows->id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-sign-out"></i></a>	
										<?php } ?>
									</div>
								</td>
								<td align="center">
									<div class="btn-group">
										<?php if(get_available(1, $rows->id) == 0) { ?>
										<a disabled href="javascript:void(0);" class="btn btn-default btn-sm"><i class="fa fa-sign-in"></i></a>
										<?php } else { ?>
										<a href="javascript:void(0);" onClick="link_process('request/man-power/<?php echo simple_encrypt($rows->id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-sign-in"></i></a>
										<?php } ?>											
									</div>
								</td>
								<?php }	?>
							<?php }	?>
							</tr>
						</tbody>	
					</table>	
				</div><!-- /.box-body -->
			</div><!-- /.box -->
			<?php endforeach; ?>
		</div><!-- /.col-xs-12 -->	
	</section><!-- /.content -->
	<?php endforeach; ?>
</div><!-- /.content-wrapper -->