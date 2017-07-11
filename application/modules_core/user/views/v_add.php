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
						<h3 class="box-title">Add User</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('user');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>user/insert-data" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Area <span class="merah">*</span></label>
									<div class="col-sm-5">
										<select class="form-control select2" name="area" required>
											<option value="" disabled selected>Select Area</option>
											<?php $area = $this->m_global->get_all('tm_area'); ?>
											<?php foreach($area as $rw) : ?>
											<option value="<?php echo $rw->area_id; ?>"><?php echo strip_tags($rw->area_name); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Username <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="" name="username" autocomplete="off" required="" minlength="5" maxlength="255" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Password <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="password" class="form-control" value="" name="password" autocomplete="off" required="" minlength="5" maxlength="25" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Authority <span class="merah">*</span></label>
									<div class="col-sm-5">
										<select class="form-control select2" name="authority" required>
											<option value="" disabled selected>Select Authority</option>
											<?php $authority = $this->m_global->get_all('tm_authority'); ?>
											<?php foreach($authority as $rw) : ?>
											<option value="<?php echo $rw->authority_id; ?>"><?php echo strip_tags($rw->authority_name); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Name <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="" name="nama" autocomplete="off" required="" minlength="5" maxlength="255" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Email <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="email" class="form-control" value="" name="email" autocomplete="off" required="" minlength="5" maxlength="255" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Image</label>
									<div class="col-sm-9">
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
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->