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
						<h3 class="box-title">List Leave</h3>
						<div class="box-tools pull-right">
							<a href="javascript:void(0);" OnClick="link_excel('leave');" class="btn btn-sm btn-social">
								<i class="fa fa-print"></i> To Excel
							</a> 
						</div>
					</div>
					<div class="col-sm-12">
						<span class="col-sm-4"></span>
						<div class="col-sm-8" style="margin-top:10px;">
							<form action="<?php echo base_url(); ?>report/leave" method="POST">
								<span class="col-sm-3"></span>
								<div class="form-group col-sm-5">
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-calendar"></i>
										</div>
									  <input type="text" class="form-control" id="reservation" name="reservation" value="<?php echo (($this->session->userdata('from') == "")?"":(convert_to_dmy($this->session->userdata('from')))) .' - '. (($this->session->userdata('to') == "")?"":(convert_to_dmy($this->session->userdata('to')))); ?>" />
									</div>
								</div>
								<div class="form-group col-sm-3">
									<select class="form-control select2" name="status">
										<option value="" disabled selected>Select Status</option>
										<?php for($i=0; $i<=9; $i++) { ?>
										<?php if(($i == 0) || ($i == 9) || ($i == 6) || ($i == 7)) { ?>
										<option value="<?php echo $i; ?>" <?php echo (($this->session->userdata('status') == $i)?"Selected":""); ?>><?php echo get_approved($i); ?></option>
										<?php } ?>
										<?php } ?>
									</select>
								</div> 
								<div class="form-group col-sm-1">
									<button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
								</div>   
							</form>
						</div>
					</div>
					<div class="box-body table-responsive">
						<table id="example0" class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th width="12%">Code</th>
									<th width="12%">Date</th>
									<th width="15%">Position</th>
									<th width="10%">Count</th>
									<th>Description</th>
									<th width="10%">Status</th>	
									<th width="8%">Detail</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($list as $row) : ?>
								<tr>
									<td align="center"><?php echo $row->leave_code; ?></td>
									<td align="center"><?php echo convert_to_dmy($row->leave_date); ?></td>
									<td><?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?></td>
									<td align="center"><?php echo $row->leave_count; ?></td>
									<td><?php echo ((strlen($row->leave_description) > 75)?strip_tags(substr($row->leave_description, 0, 75) ." ..."):strip_tags($row->leave_description)); ?></td>
									<td align="center"><?php echo get_approved($row->leave_status); ?></td>
									<td align="center">
										<div class="btn-group">
											<a href="javascript:void(0);" onClick="link_detail('report/leave', '<?php echo simple_encrypt($row->leave_id); ?>');" class="btn btn-default btn-sm"><i class="fa fa-newspaper-o"></i></a>
										</div>
									</td>
								</tr>
								<?php endforeach; ?>
							</tbody>	
						</table>
					</div><!-- /.box-body -->
				</div><!-- /.box -->
			</div><!-- /.col-xs-12 -->
		</div><!-- /.row -->
	</section><!-- /.content -->
</div><!-- /.content-wrapper -->