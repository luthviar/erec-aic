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
						<h3 class="box-title">Detail Request</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('report/request');" class="btn btn-sm btn-social">
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
											<input type="hidden" name="id" value="<?php echo simple_encrypt($row->request_id); ?>" />
											<div class="box-body">
												<div class="form-group">
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-3">
														<label>
															<input type="checkbox" class="flat-red" Checked disabled />
															&nbsp;&nbsp; <?php echo get_approved($row->request_status); ?>
														</label>
													</div>
													<span class="col-sm-2"></span>
													<label class="col-sm-2 control-label">#</label>
													<div class="col-sm-2">
														<div class="input-group">
															<input type="text" class="form-control" value="<?php echo $row->request_code; ?>" readonly style="font-weight: bold;" />
														</div><!-- /.input group -->
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Area</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->load->model('setting/m_area')->get_name_by_id($this->m_manpower->get_area_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Department</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->load->model('master/m_department')->get_name_by_id($this->m_manpower->get_department_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Unit</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->load->model('master/m_unit')->get_name_by_id($this->m_manpower->get_unit_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Count</label>
													<div class="col-sm-1">
														<input type="number" class="form-control" value="<?php echo $row->request_count; ?>" readonly style="text-align: right;padding-right: 2px;" />
													</div>
													<span class="col-sm-4"></span>
													<label class="col-sm-2 control-label">Placement Date</label>
													<div class="col-sm-2">
														<div class="input-group">
															<div class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</div>
															<input type="text" class="form-control pull-right" value="<?php echo convert_to_dmy($row->request_overdue); ?>" readonly />
														</div><!-- /.input group -->
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Position</label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?>" readonly />
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
																	<li class="active"><a href="#tab_1" data-toggle="tab">Employee</a></li>
																</ul>
																<div class="tab-content">
																	<div class="tab-pane active" id="tab_1">
																		<div class="box-body table-responsive">
																			<div class="box-body table-responsive no-padding">
																				<table class="table table-hover">
																					<tr>
																						<td width="25%"><b>Nik</b></td>
																						<td><b>Name</b></td>
																						<td align="center" width="15%"><b>Join</b></td>
																					</tr>
																					<?php 
																						$detail_data = $this->m_global->get_by_id_and_order('td_request', 'request_id', $row->request_id, 'id', 'ASC');
																						foreach($detail_data as $rows) : 
																					?>
																					<tr>
																						<td><?php echo $rows->nik; ?></td>
																						<td><?php echo strip_tags($rows->name); ?></td>
																						<td align="center"><?php echo (($rows->join == "")?"-":convert_to_dmy($rows->join)); ?></td>
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
														<a href="javascript:void(0);" OnClick="link_preview('report/request', '<?php echo simple_encrypt($row->request_id); ?>');" class="btn btn-primary pull-right" style="margin-right: 5px;">
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
													<input type="text" class="form-control" value="<?php echo (($row->prepared_id == '')?'':strip_tags($this->m_user->get_name_by_id($row->prepared_id))); ?>" readonly />
												</div>
												<span class="col-sm-1"></span>
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" value="<?php echo convert_to_dmy($row->request_date) .' '. convert_to_his($row->request_time); ?>" readonly />
													</div><!-- /.input group -->
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Description</label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo strip_tags($row->request_description); ?></textarea>
												</div>
											</div>
											<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Approval 1</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" value="<?php echo (($row->approval1_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->approval1_id))); ?>" readonly />
												</div>
												<span class="col-sm-1"></span>
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" value="<?php echo (($row->approval1_date == "")?"-":convert_to_dmy($row->approval1_date) .' '. convert_to_his($row->approval1_time)); ?>" readonly />
													</div><!-- /.input group -->
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Description</label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo (($row->approval1_description == "")?"-":strip_tags($row->approval1_description)); ?></textarea>
												</div>
											</div>
											<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Approval 2</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" value="<?php echo (($row->approval2_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->approval2_id))); ?>" readonly />
												</div>
												<span class="col-sm-1"></span>
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" value="<?php echo (($row->approval2_date == "")?"-":convert_to_dmy($row->approval2_date) .' '. convert_to_his($row->approval2_time)); ?>" readonly />
													</div><!-- /.input group -->
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Description</label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo (($row->approval2_description == "")?"-":strip_tags($row->approval2_description)); ?></textarea>
												</div>
											</div>
											<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Recruitment</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" value="<?php echo (($row->recruitment_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->recruitment_id))); ?>" readonly />
												</div>
												<span class="col-sm-1"></span>
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" value="<?php echo (($row->recruitment_date == "")?"-":convert_to_dmy($row->recruitment_date) .' '. convert_to_his($row->recruitment_time)); ?>" readonly />
													</div><!-- /.input group -->
												</div>
											</div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Description</label>
												<div class="col-sm-9">
													<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo (($row->recruitment_description == "")?"-":strip_tags($row->recruitment_description)); ?></textarea>
												</div>
											</div>
											<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
											<div class="form-group">
												<label class="col-sm-2 control-label">Closed</label>
												<div class="col-sm-5">
													<input type="text" class="form-control" value="<?php echo (($row->closed_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->closed_id))); ?>" readonly />
												</div>
												<span class="col-sm-1"></span>
												<div class="col-sm-3">
													<div class="input-group">
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
														<input type="text" class="form-control pull-right" value="<?php echo (($row->closed_date == "")?"-":convert_to_dmy($row->closed_date) .' '. convert_to_his($row->closed_time)); ?>" readonly />
													</div><!-- /.input group -->
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