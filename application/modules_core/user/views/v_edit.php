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
						<h3 class="box-title">Edit User</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('user');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<!-- Custom Tabs -->
						<div class="nav-tabs-custom default">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Detail Information</a></li>
								<li><a href="#tab_2" data-toggle="tab">Change Password</a></li>	
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<div class="box-body table-responsive">
										<?php foreach($detail as $row) : ?>
										<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/update-data" enctype="multipart/form-data">
											<input type="hidden" name="id" value="<?php echo simple_encrypt($row->user_id); ?>" />
											<input type="hidden" name="otoritas" value="1" />
											<div class="box-body">
												<input type="hidden" name="status" value="<?php echo $row->user_status; ?>" />
												<div class="form-group">
													<label class="col-sm-2 control-label"></label>
													<div class="col-sm-5">
														<input type="radio" name="status" value="1" <?php echo (($row->user_status == 1)?"Checked":""); ?> /> <label><?php echo get_status(1); ?></label>
													</div>
													<div class="col-sm-5">
														<input type="radio" name="status" value="0" <?php echo (($row->user_status == 0)?"Checked":""); ?> /> <label><?php echo get_status(0); ?></label>
													</div>
												</div>
												<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Username</label>
													<div class="col-sm-5">
														<input type="text" class="form-control" value="<?php echo $row->user_name; ?>" name="username" readonly />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Area <span class="merah">*</span></label>
													<div class="col-sm-5">
														<select class="form-control select2" name="area" required>
															<option value="" disabled selected>Select Area</option>
															<?php $area = $this->m_global->get_all('tm_area'); ?>
															<?php foreach($area as $rw) : ?>
															<option value="<?php echo $rw->area_id; ?>" <?php echo (($row->area_id == $rw->area_id)?"Selected":""); ?>><?php echo strip_tags($rw->area_name); ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Authority <span class="merah">*</span></label>
													<div class="col-sm-5">
														<select class="form-control select2" name="authority" required>
															<option value="" disabled selected>Select Authority</option>
															<?php $authority = $this->m_global->get_all('tm_authority'); ?>
															<?php foreach($authority as $rw) : ?>
															<option value="<?php echo $rw->authority_id; ?>" <?php echo (($row->authority_id == $rw->authority_id)?"Selected":""); ?>><?php echo strip_tags($rw->authority_name); ?></option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Name <span class="merah">*</span></label>
													<div class="col-sm-9">
														<input type="text" class="form-control" value="<?php echo $row->user_fullname; ?>" name="nama"  autocomplete="off" required="" minlength="5" maxlength="255" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Email <span class="merah">*</span></label>
													<div class="col-sm-9">
														<input type="email" class="form-control" value="<?php echo $row->user_email; ?>" name="email" autocomplete="off" required="" minlength="5" maxlength="255" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Image</label>
													<div class="col-sm-9">
														<a href="<?php echo base_url() ."assets/uploads/".(($row->user_image != "")?"user/". $row->user_image:"no_image.png"); ?>" alt="<?php echo strip_tags($row->user_name); ?>" data-popup="lightbox">
															<img src="<?php echo base_url() ."assets/uploads/".(($row->user_image != "")?"user/thumb/". $row->user_image:"no_image.png"); ?>" alt="<?php echo strip_tags($row->user_fullname); ?>" class="margin" width="160" />
														</a>
														<input type="file" value="" name="userfile" />
														<p class="help-block">.jpg |.png (max file size 2MB)</p>
													</div>
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
								</div><!-- /.tab-pane -->
								<div class="tab-pane" id="tab_2">
									<div class="box-body table-responsive">
										<?php foreach($detail as $row) : ?>
										<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/update-password">
											<input type="hidden" name="id" value="<?php echo simple_encrypt($row->user_id); ?>" />
											<div class="box-body">
												<div class="form-group">
													<label class="col-sm-2 control-label">New Password <span class="merah">*</span></label>
													<div class="col-sm-9">
														<input type="password" class="form-control" value="" name="n_pass" autocomplete="off" required="" minlength="5" maxlength="25" />
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Confirm Password <span class="merah">*</span></label>
													<div class="col-sm-9">
														<input type="password" class="form-control" value="" name="c_pass" autocomplete="off" required="" minlength="5" maxlength="25" />
													</div>
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
								</div><!-- /.tab-pane -->
							</div><!-- /.tab-content -->
						</div><!-- nav-tabs-custom -->
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->