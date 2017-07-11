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
						<h3 class="box-title">Add Unit</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('master/unit');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>master/unit/insert-data" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Name <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="" name="nama" autocomplete="off" required="" minlength="3" maxlength="255" />
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