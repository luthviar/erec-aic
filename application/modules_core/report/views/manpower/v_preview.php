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
						<i class="fa fa-table"></i> MAN POWER.
						<small class="pull-right">status : <b><?php echo get_approved($row->manpower_status); ?></b></small>
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
						</table>
					</address>
				</div>
				<!-- /.col -->
				<div class="col-sm-10 invoice-col">
					<address>
						<table border="0" width="100%">
							<tr><td height="20" valign="top"><?php echo (($row->area_id == '')?'-':strip_tags($this->m_area->get_name_by_id($row->area_id))); ?></td></tr>
							<tr><td height="20" valign="top"><?php echo (($row->department_id == '')?'-':strip_tags($this->m_department->get_name_by_id($row->department_id))); ?></td></tr>
							<tr><td height="20" valign="top"><?php echo (($row->unit_id == '')?'-':strip_tags($this->m_unit->get_name_by_id($row->unit_id))); ?></td></tr>
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
								<th>Position</th>
								<th width="20%" style="text-align:center;">MPP</th>
								<th width="20%" style="text-align:center;">ACTUAL</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								$total_mpp = 0;	$total_actual = 0;
								$detail_data = $this->m_global->get_by_id_and_order('td_manpower', 'manpower_id', $row->manpower_id, 'id', 'ASC');
								foreach($detail_data as $rows) : 
									$total_mpp 		= doubleval($total_mpp) + doubleval($rows->mpp);	
									$total_actual 	= doubleval($total_actual) + doubleval($rows->actual);
							?>
							<tr>
								<td><?php echo strip_tags($this->m_position->get_name_by_id($rows->position_id)); ?></td>
								<td align="center"><?php echo $rows->mpp; ?></td>
								<td align="center"><?php echo $rows->actual; ?></td>
							</tr>
							<?php endforeach; ?>
							<tr>
								<td align="right"></td>
								<td align="center"><?php echo $total_mpp; ?></td>
								<td align="center"><?php echo $total_actual; ?></td>
							</tr>
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
					<p><?php echo (($row->manpower_date == "")?"-":convert_to_dmy($row->manpower_date)); ?></p>
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