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
						<h3 class="box-title">Detail Man Power</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('report/man-power');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<div class="nav-tabs-custom default">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab1" data-toggle="tab">Information</a></li>
								<li><a href="#tab2" data-toggle="tab">Progress</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab1">
									<div class="box-body table-responsive">
										<?php foreach($detail as $row) : ?>
										<form class="form-horizontal" method="post">
											<input type="hidden" name="id" value="<?php echo simple_encrypt($row->manpower_id); ?>" />
											<div class="box-body">
												<div class="form-group">
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-3">
														<label>
															<input type="checkbox" class="flat-red" Checked disabled />
															&nbsp;&nbsp; <?php echo get_approved($row->manpower_status); ?>
														</label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Area</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo (($row->area_id == '')?'':strip_tags($this->m_area->get_name_by_id($row->area_id))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Department</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo (($row->department_id == '')?'':strip_tags($this->m_department->get_name_by_id($row->department_id))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Unit</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo (($row->unit_id == '')?'':strip_tags($this->m_unit->get_name_by_id($row->unit_id))); ?>" readonly />
													</div>
												</div>
												<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
												<div class="form-group">
													<span class="col-sm-2"></span>
													<div class="col-sm-9"></div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-9">
														<div class="box">
															<div class="nav-tabs-custom default">
																<ul class="nav nav-tabs">
																	<li class="active"><a href="#tab_1" data-toggle="tab">Position</a></li>
																</ul>
																<div class="tab-content">
																	<div class="tab-pane active" id="tab_1">
																		<div class="box-body table-responsive">
																			<div class="box-body table-responsive no-padding">
																				<table class="table table-hover">
																					<tr>
																						<td><b>Name</b></td>
																						<td width="10%"><b>MPP</b></td>
																						<td width="10%"><b>Actual</b></td>	
																					</tr>
																					<?php 
																						$detail_data = $this->m_global->get_by_id_and_order('td_manpower', 'manpower_id', $row->manpower_id, 'id', 'ASC');
																						foreach($detail_data as $rows) : 
																					?>
																					<tr>
																						<td><?php echo strip_tags($this->m_position->get_name_by_id($rows->position_id)); ?></td>
																						<td align="center"><?php echo $rows->mpp; ?></td>
																						<td align="center"><?php echo $rows->actual; ?></td>
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
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-9">
														<a href="javascript:void(0);" OnClick="link_preview('report/man-power', '<?php echo simple_encrypt($row->manpower_id); ?>');" class="btn btn-primary pull-right" style="margin-right: 5px;">
															<i class="fa fa-print"></i> Print Preview
														</a>
													</div>	
												</div>
											</div><!-- /.box-body -->	
										</form>
										<?php endforeach; ?>
									</div><!-- /.box-body -->	
								</div><!-- /.tab-pane -->
								<div class="tab-pane" id="tab2">
									<div class="box-body table-responsive">
										<form class="form-horizontal" method="post" action="">
											<div class="form-group">
												<label class="col-sm-2 control-label">Prepared By</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" value="<?php echo (($row->prepared_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->prepared_id))); ?>" readonly />
												</div>
												<span class="col-sm-1"></span>
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</div>
														<div class="bootstrap-timepicker">
															<input type="text" class="form-control pull-right" value="<?php echo (($row->manpower_date == "")?"-":convert_to_dmy($row->manpower_date)) .' '. (($row->manpower_time == "")?"-":convert_to_his($row->manpower_time)); ?>" readonly />
														</div>
													</div><!-- /.input group -->
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Description</label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo (($row->manpower_description == "")?"":strip_tags($row->manpower_description)); ?></textarea>
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Approved By</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" value="<?php echo (($row->approval_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->approval_id))); ?>" readonly />
												</div>
												<span class="col-sm-1"></span>
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-clock-o"></i>
														</div>
														<div class="bootstrap-timepicker">
															<input type="text" class="form-control pull-right" value="<?php echo (($row->approval_date == "")?"-":convert_to_dmy($row->approval_date)) .' '. (($row->approval_time == "")?"-":convert_to_his($row->approval_time)); ?>" readonly />
														</div>
													</div><!-- /.input group -->
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Note</label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo (($row->approval_description == "")?"":strip_tags($row->approval_description)); ?></textarea>
												</div>
											</div>
										</form>	
									</div><!-- /.box-body -->
								</div><!-- /.tab-pane -->
							</div><!-- /.tab-content -->
						</div><!-- nav-tabs-custom -->	
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->