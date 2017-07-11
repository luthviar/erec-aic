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
						<h3 class="box-title">Edit Department</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('master/department');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<?php foreach($detail as $row) : ?>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>master/department/update-data" enctype="multipart/form-data">
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->department_id); ?>" />
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-5">
										<input type="radio" name="status" value="1" <?php echo (($row->department_status == 1)?"Checked":""); ?> /> <label><?php echo get_status(1); ?></label>
									</div>
									<div class="col-sm-5">
										<input type="radio" name="status" value="0" <?php echo (($row->department_status == 0)?"Checked":""); ?> /> <label><?php echo get_status(0); ?></label>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Name <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo strip_tags($row->department_name); ?>" name="nama" autocomplete="off" required="" minlength="3" maxlength="255" />
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
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->