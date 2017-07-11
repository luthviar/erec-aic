<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header"></section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-xs-12">
				<!-- Default box -->
				<div class="box box-default box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Leave</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('leave');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<?php foreach($detail as $row) : ?>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>leave/update-data">
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->leave_id); ?>" />
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-5">
										<input type="radio" name="status" value="<?php echo $status; ?>" required /> <label><?php echo get_approved($status); ?></label>
									</div>
									<div class="col-sm-5">
										<input type="radio" name="status" value="6" /> <label><?php echo get_approved(6); ?></label>
									</div>
								</div>
								<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-3">
										<div class="input-group">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" value="<?php echo convert_to_dmy($row->leave_date) .' '. convert_to_his($row->leave_time); ?>" readonly />
										</div><!-- /.input group -->
									</div>
									<span class="col-sm-2"></span>
									<label class="col-sm-2 control-label">#</label>
									<div class="col-sm-2">
										<div class="input-group">
											<input type="text" class="form-control" value="<?php echo $row->leave_code; ?>" readonly style="font-weight: bold;" />
										</div><!-- /.input group -->
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Position</label>
									<div class="col-sm-5">
										<input type="text" class="form-control" value="<?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?>" readonly />
									</div>
									<label class="col-sm-2 control-label">Count</label>
									<div class="col-sm-2">
										<input type="number" class="form-control" value="<?php echo $row->leave_count; ?>" readonly style="text-align: right;padding-right: 2px;" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="2" name="description" style="resize: none;"><?php echo strip_tags($row->leave_description); ?></textarea>
									</div>
								</div>
								<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
								<div class="form-group">
									<span class="col-sm-2"></span>
									<div class="col-sm-9">
										<?php
											if($this->session->flashdata('message') != "") {
												$data['status'] = $this->session->flashdata('status');	
												$data['notify'] = $this->session->flashdata('message');
												$this->load->view('../v_alert', $data);
											}
										?>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-9">
										<div class="box">
											<div class="nav-tabs-custom default">
												<ul class="nav nav-tabs">
													<li class="active"><a href="#tab_1" data-toggle="tab">Employee</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="tab_1">
														<div class="box-body table-responsive">
															<div class="box-body table-responsive no-padding">
																<table class="table table-hover">
																	<tr>
																		<td width="1%"></td>
																		<td width="25%"><b>Nik</b></td>
																		<td><b>Name</b></td>		
																	</tr>
																	<?php 
																		$detail_data = $this->m_global->get_by_id_and_order('td_leave', 'leave_id', $row->leave_id, 'id', 'ASC');
																		foreach($detail_data as $rows) : 
																	?>
																	<tr>
																		<td align="center">
																			<div class="btn-group">
																				<a href="javascript:void(0);" onClick="edit_detail_leave('<?php echo $rows->id; ?>');" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
																			</div>
																		</td>
																		<td><?php echo $rows->nik; ?></td>
																		<td><?php echo strip_tags($rows->name); ?></td>
																	</tr>
																	<?php endforeach; ?>
																</table>
															</div><!-- /.box-body -->	
														</div><!-- /.box-body -->	
													</div><!-- /.tab-pane -->
												</div><!-- /.tab-content -->
											</div><!-- nav-tabs-custom -->	
										</div><!-- /.box -->
									</div><!-- /.col-xs-12 -->
								</div>
								<div class="form-group">
									<span class="col-sm-2"></span>
									<div class="col-sm-9">
										<input type="reset" name="reset" value="Clear" class="btn" />
										<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
									</div>
								</div>
							</div><!-- /.box-body -->	
						</form>
						<?php endforeach; ?>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->