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
							<a href="javascript:void(0);" OnClick="link_to('request');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<?php foreach($detail as $row) : ?>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>request/update-data">
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->request_id); ?>" />
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label"></label>
									<div class="col-sm-5">
										<?php if($this->session->userdata('authority_id') == 2) { ?>
										<input type="radio" name="status" value="9" required /> <label><?php echo get_approved(9); ?></label>
										<?php } else { ?>
										<input type="radio" name="status" value="3" required /> <label><?php echo get_approved(1); ?></label>
										<?php } ?>
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
											<input type="text" class="form-control pull-right" value="<?php echo convert_to_dmy($row->request_date) .' '. convert_to_his($row->request_time); ?>" readonly />
										</div><!-- /.input group -->
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
								<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="2" name="description" style="resize: none;"><?php echo strip_tags($row->request_description); ?></textarea>
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