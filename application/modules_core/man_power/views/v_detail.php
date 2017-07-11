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
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>man-power/process-data">
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->manpower_id); ?>" />
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-3">
										<label>
											<input type="checkbox" class="flat-red" value="1" name="check" />
											&nbsp;&nbsp; <?php echo get_approved(8); ?>
										</label>	
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Note</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="2" name="note" style="resize: none;"></textarea>
									</div>
								</div>
								<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
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
															<div class="box-body table-responsive no-padding">
																<table class="table table-hover">
																	<tr>
																		<td width="1%"></td>
																		<td><b>Name</b></td>
																		<td width="10%"><b>MPP</b></td>
																		<td width="10%"><b>Actual</b></td>		
																	</tr>
																	<?php 
																		$detail_data = $this->m_global->get_by_id_and_order('td_manpower', 'manpower_id', $row->manpower_id, 'id', 'ASC');
																		foreach($detail_data as $rows) : 
																	?>
																	<tr>
																		<td align="center">
																			<div class="btn-group">
																				<a href="javascript:void(0);" onClick="edit_mpp(<?php echo $rows->id; ?>);" class="btn btn-default btn-sm"><i class="fa fa-pencil"></i></a>
																			</div>
																		</td>
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