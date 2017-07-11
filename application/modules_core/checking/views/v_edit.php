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
						<h3 class="box-title">Edit Request</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('checking');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<!-- Custom Tabs -->
						<?php foreach($detail as $row) : ?>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>checking/update-data">
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->request_id); ?>" />
							<div class="nav-tabs-custom default">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">Detail Information</a></li>
									<li><a href="#tab_2" data-toggle="tab">Approval Information</a></li>	
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<div class="box-body table-responsive">
											<div class="box-body">
												<div class="form-group">
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-5">
														<input type="radio" name="status" value="4" Checked /> <label><?php echo get_approved(1); ?></label>
													</div>
													<div class="col-sm-5">
														<input type="radio" name="status" value="2" /> <label><?php echo get_approved(2); ?></label>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Note</label>
													<div class="col-sm-10">
														<textarea class="form-control" rows="2" name="note" style="resize: none;"></textarea>
													</div>
												</div>
												<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Area</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->m_area->get_name_by_id($row->area_id)); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Department</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->load->model('master/m_department')->get_name_by_id($this->m_manpower->get_department_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Unit</label>
													<div class="col-sm-10">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->load->model('master/m_unit')->get_name_by_id($this->m_manpower->get_unit_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Count</label>
													<div class="col-sm-1">
														<input type="number" class="form-control" value="<?php echo $row->request_count; ?>" readonly style="text-align: right;padding-right: 2px;" />
													</div>
													<span class="col-sm-5"></span>
													<label class="col-sm-2 control-label">Overdue</label>
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
													<div class="col-sm-10">
														<input type="text" class="form-control" value="<?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?>" readonly />
													</div>
												</div>
												<div class="form-group">
													<span class="col-sm-2"></span>
													<div class="col-sm-10">
														<input type="reset" name="reset" value="Clear" class="btn" />
														<input type="submit" name="submit" value="Save Change" class="btn btn-primary" />
													</div>
												</div>
											</div><!-- /.box-body -->	
										</div><!-- /.box-body -->
									</div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
										<div class="box-body table-responsive">
											<div class="box-body">
												<div class="form-group">
													<label class="col-sm-2 control-label">Prepared By</label>
													<div class="col-sm-5">
														<input type="text" class="form-control" value="<?php echo (($row->prepared_id == '')?'':strip_tags($this->m_user->get_name_by_id($row->prepared_id))); ?>" readonly />
													</div>
													<span class="col-sm-2"></span>
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
													<div class="col-sm-10">
														<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo strip_tags($row->request_description); ?></textarea>
													</div>
												</div>
												<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Approval 1</label>
													<div class="col-sm-5">
														<input type="text" class="form-control" value="<?php echo (($row->approval1_id == '')?'-':strip_tags($this->m_user->get_name_by_id($row->approval1_id))); ?>" readonly />
													</div>
													<span class="col-sm-2"></span>
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
													<div class="col-sm-10">
														<textarea class="form-control" rows="2" style="resize: none;" readonly><?php echo (($row->approval1_description == "")?"-":strip_tags($row->approval1_description)); ?></textarea>
													</div>
												</div>
											</div><!-- /.box-body -->		
										</div><!-- /.box-body -->
									</div><!-- /.tab-pane -->
								</div><!-- /.tab-content -->
							</div><!-- nav-tabs-custom -->
						</form>
						<?php endforeach; ?>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->