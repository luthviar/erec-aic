<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.jpg" type="image/x-icon" />
		<script type="application/x-javascript">var base_url = '<?php echo base_url(); ?>'</script>

		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css">
			
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ImLTE.min.css">
		<!-- ImLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css">
		
		<!--------------- TYPING/MOVING TITLE ----------------------->
		<script type="text/javascript">
			var rev = "fwd";
			function titlebar(val) {
				var msg = "AIC | RECRUITMENT";
				var res = " ";
				var speed = 100;
				var pos = val;
				var le = msg.length;
				
				if(rev == "fwd") {
					if(pos < le) {
						pos = pos+1;
						scroll = msg.substr(0,pos);
						document.title = scroll;
						timer = window.setTimeout("titlebar("+pos+")",speed);
					}
					else {
						rev = "bwd";
						timer = window.setTimeout("titlebar("+pos+")",speed);
					}
				}	
				else{
					if(pos > 0) {
						pos = pos-1;
						var ale = le-pos;
						scrol = msg.substr(ale,le);
						document.title = scrol;
						timer = window.setTimeout("titlebar("+pos+")",speed);
					}
					else {
							rev = "fwd";
							timer = window.setTimeout("titlebar("+pos+")",speed);
					}
				}
			}
			
			titlebar(1);
		</script>
</head>
<body onload="window.print();">
	<div class="wrapper">
	  <!-- Main content -->
		<?php foreach($detail as $row) : ?>
		<section class="invoice">
			<!-- title row -->
			<div class="row">
				<div class="col-xs-12">
					<h2 class="page-header">
						<i class="fa fa-sign-out"></i> LEAVE.
						<small class="pull-right">status : <b><?php echo get_approved($row->leave_status); ?></b></small>
					</h2>
				</div>
				<!-- /.col -->
			</div>
		  
			<!-- info row -->
			<div class="row invoice-info">
				<div class="col-sm-2 invoice-col">
					<address>
						<table border="0" width="100%">
							<tr><td height="20" valign="top"><strong>Area</strong></td></tr>
							<tr><td height="20" valign="top"><strong>Department</strong></td></tr>
							<tr><td height="20" valign="top"><strong>Unit</strong></td></tr>
							<tr><td height="20" valign="top"><strong>Position</strong></td></tr>
						</table>
					</address>
				</div>
				<!-- /.col -->
				<div class="col-sm-10 invoice-col">
					<address>
						<table border="0" width="100%">
							<tr><td height="20" valign="top"><?php echo strip_tags($this->load->model('setting/m_area')->get_name_by_id($this->m_manpower->get_area_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?></td></tr>
							<tr><td height="20" valign="top"><?php echo strip_tags($this->load->model('master/m_department')->get_name_by_id($this->m_manpower->get_department_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?></td></tr>
							<tr><td height="20" valign="top"><?php echo strip_tags($this->load->model('master/m_unit')->get_name_by_id($this->m_manpower->get_unit_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?></td></tr>
							<tr><td height="20" valign="top"><?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?></td></tr>
						</table>	
					</address>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

			<!-- Table row -->
			<div class="row">
				<div class="col-xs-12 table-responsive">
					<table class="table">
						<thead>
							<tr>
								<th width="30%">NIK</th>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$detail_data = $this->m_global->get_by_id_and_order('td_leave', 'leave_id', $row->leave_id, 'id', 'ASC');
								foreach($detail_data as $rows) : 
							?>
							<tr>
								<td><?php echo $rows->nik; ?></td>
								<td><?php echo strip_tags($rows->name); ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
			
			<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
			<br /><br />
			<!-- accepted payments column -->
			<div class="row">
				<!-- accepted payments column -->
				<div class="col-xs-6">
					<p><?php echo (($row->leave_date == "")?"-":convert_to_dmy($row->leave_date)); ?></p>
					<p class="lead">Prepared By</p>
					<br /><br />
					<p>..............................</p>
					<p class="lead"><?php echo (($row->prepared_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->prepared_id))); ?></p>
				</div>
				<!-- /.col -->
				<div class="col-xs-6">
					<p><?php echo (($row->approval_date == "")?"-":convert_to_dmy($row->approval_date)); ?></p>
					<p class="lead">Approved By</p>
					<br /><br />
					<p>..............................</p>
					<p class="lead"><?php echo (($row->approval_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->approval_id))); ?></p>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<?php endforeach; ?>
		<!-- /.content -->
	</div>
	<!-- ./wrapper -->
</body>
</html>