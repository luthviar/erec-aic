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
						<h3 class="box-title">Add Man Power</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_to('man-power');" class="btn btn-sm btn-social">
								<i class="fa fa-toggle-left"></i> Back
							</a> 
						</div>
					</div>
					<div class="box-body table-responsive">
						<form class="form-horizontal" method="post" action="<?php echo base_url(); ?>man-power/insert-data">
							<div class="box-body">
								<div class="form-group">
									<label class="col-sm-2 control-label">Area <span class="merah">*</span></label>
									<div class="col-sm-4">
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
									<label class="col-sm-2 control-label">Department <span class="merah">*</span></label>
									<div class="col-sm-5">
										<select class="form-control select2" name="department" required>
											<option value="" disabled selected>Select Department</option>
											<?php $department = $this->m_global->get_by_id('tm_department', 'department_status', 1); ?>
											<?php foreach($department as $rw) : ?>
											<option value="<?php echo $rw->department_id; ?>"><?php echo strip_tags($rw->department_name); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Unit <span class="merah">*</span></label>
									<div class="col-sm-5">
										<select class="form-control select2" name="unit" required>
											<option value="" disabled selected>Select Unit</option>
											<?php $unit = $this->m_global->get_by_id('tm_unit', 'unit_status', 1); ?>
											<?php foreach($unit as $rw) : ?>
											<option value="<?php echo $rw->unit_id; ?>"><?php echo strip_tags($rw->unit_name); ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-2 control-label">Description</label>
									<div class="col-sm-9">
										<textarea class="form-control" rows="2" name="description" style="resize: none;"></textarea>
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