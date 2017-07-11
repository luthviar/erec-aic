<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<?php
			if($this->session->flashdata('message') != "") {
				$data['status'] = $this->session->flashdata('status');	
				$data['notify'] = $this->session->flashdata('message');
				$this->load->view('../v_alert', $data);
			}
		?>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
            <div class="col-xs-12">
				<!-- Default box -->
				<div class="box box-default box-solid">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Preference</h3>
					</div>
					<div class="box-body table-responsive">
						<?php foreach($detail as $row) : ?>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>setting/preference/update-data">
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->preference_id); ?>" />
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Title Home</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $row->preference_hometittle; ?>" name="home_tittle" autocomplete="off" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="4" name="home_desc" style="resize: none;"><?php echo strip_tags($row->preference_homedescription); ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Title Message</label>
									<div class="col-sm-8">
										<input type="text" class="form-control" value="<?php echo $row->preference_messagetittle; ?>" name="msg_tittle" autocomplete="off" />
									</div>
								</div>
									<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
									<div class="col-sm-8">
										<textarea class="form-control" rows="6" name="msg_desc" style="resize: none;"><?php echo strip_tags($row->preference_messagedescription); ?></textarea>
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