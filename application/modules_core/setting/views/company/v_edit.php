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
						<h3 class="box-title">Edit Company</h3>
					</div>
					<div class="box-body table-responsive">	
						<?php foreach($detail as $row) : ?>
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>setting/company/update-data" enctype="multipart/form-data">		
							<input type="hidden" name="id" value="<?php echo simple_encrypt($row->company_id); ?>" />
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Name <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo strip_tags($row->company_name); ?>" name="nama" autocomplete="off" required="" minlength="3" maxlength="255" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Phone <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo $row->company_phone; ?>" name="telepon" autocomplete="off" required="" minlength="5" maxlength="255" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Email <span class="merah">*</span></label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="<?php echo $row->company_email; ?>" name="email" autocomplete="off" required="" minlength="5" maxlength="255" />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Address</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="2" name="alamat" style="resize: none;"><?php echo strip_tags($row->company_address); ?></textarea>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Image</label>
									<div class="col-sm-9">
										<a href="<?php echo base_url() ."assets/uploads/".(($row->company_image != "")?"company/". $row->company_image:"no_image.png"); ?>" alt="<?php echo strip_tags($row->company_name); ?>" data-popup="lightbox">
											<img src="<?php echo base_url() ."assets/uploads/".(($row->company_image != "")?"company/". $row->company_image:"no_image.png"); ?>" alt="<?php echo strip_tags($row->company_name); ?>" class="margin" width="160" />
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
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->