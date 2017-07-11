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
						<h3 class="box-title">Edit Man Power</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('man-power');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<?php foreach($detail as $row) : ?>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>man-power/update-data">
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->manpower_id); ?>" />
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-5">
										<input type="radio" name="status" value="1" <?php echo (($row->manpower_status == 1)?"Checked":""); ?> /> <label><?php echo get_status(1); ?></label>
									</div>
									<div class="col-sm-5">
										<input type="radio" name="status" value="0" <?php echo (($row->manpower_status == 0)?"Checked":""); ?> /> <label><?php echo get_status(0); ?></label>
									</div>
								</div>
								<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Approved By</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo (($row->approval_id == '')?'':strip_tags($this->m_user->get_name_by_id($row->approval_id))); ?>" readonly />
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
								<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="2" name="description" style="resize: none;" readonly><?php echo strip_tags($row->manpower_description); ?></textarea>
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
													<li class="active"><a href="#tab_1" data-toggle="tab">Position</a></li>
												</ul>
												<div class="tab-content">
													<div class="tab-pane active" id="tab_1">
														<div class="box-body table-responsive">
															<?php if($row->is_approved == 0) { ?>
															<div class="box-header">
																<h3 class="box-title"></h3>
																<div class="box-tools pull-right">
																	<a href="javascript:void(0);" OnClick="add_mpp('<?php echo simple_encrypt($row->manpower_id); ?>');" class="btn btn-sm btn-social">
																		<i class="fa fa-plus-circle"></i> Add Position
																	</a>
																</div>
															</div><!-- /.box-header -->
															<?php } ?>
															<div class="box-body table-responsive no-padding">
																<table class="table table-hover">
																	<tr>
																		<?php if($row->is_approved == 0) { ?>
																		<td width="1%"></td>
																		<?php } ?>
																		<td><b>Name</b></td>
																		<td width="10%"><b>MPP</b></td>
																		</tr>
																	<?php 
																		$detail_data = $this->m_global->get_by_id_and_order('td_manpower', 'manpower_id', $row->manpower_id, 'id', 'ASC');
																		foreach($detail_data as $rows) : 
																	?>
																	<tr>
																		<?php if($row->is_approved == 0) {?>
																		<td align="center">
																			<div class="btn-group">
																				<a href="javascript:void(0);" onClick="delete_to('man-power/delete-detail-data/<?php echo simple_encrypt($rows->id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></a>
																			</div>
																		</td>
																		<?php } ?>
																		<td><?php echo strip_tags($this->m_position->get_name_by_id($rows->position_id)); ?></td>
																		<td align="center"><?php echo $rows->mpp; ?></td>
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