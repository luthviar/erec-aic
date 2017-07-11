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
		
		<style>
			.medium {
				font-size: 14px;
			}
			
			.small {
				font-size: 10px;
			}
		</style>
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
						<i class="fa fa-sign-in"></i> LAPORAN PENGAJUAN PERSONEL REQUISITION
						<?php $img = $this->load->model('setting/m_company')->get_file_by_id(1); ?>
						<img src="<?php echo base_url() ."assets/uploads/".(($img != "")?"company/". $img:"no_image.png"); ?>" class="img-circle pull-right" height="32" >
					</h2>
				</div>
				<!-- /.col -->
			</div>
		  
			<p class="lead">Pireq Number : <b><?php echo $row->request_code; ?></b></p>
			
			<div class="row invoice-info">
				<div class="col-sm-6 invoice-col">
					Rincian Permintaan
					<address>
						unit :<br>
						<strong><?php echo strip_tags($this->load->model('master/m_unit')->get_name_by_id($this->m_manpower->get_unit_by_id($this->m_manpower->get_id_by_detail($row->mpp_id)))); ?></strong><br>
						Diminta oleh :<br>
						<strong><?php echo (($row->prepared_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->prepared_id))); ?></strong><br>
						Permintan Karyawan Posisi :<br>
						<strong><?php echo strip_tags($this->m_position->get_name_by_id($this->m_manpower->get_position_by_detail($row->mpp_id))); ?></strong><br>
						Jumlah Permintaan :<br>
						<strong><?php echo $row->request_count; ?> Orang</strong><br>
						Catatan :<br>
						<strong><?php echo strip_tags($row->request_description); ?></strong><br>
					</address>
				</div>
				<!-- /.col -->
				<div class="col-sm-6 invoice-col">
					Rincian Tanggal
					<address>
						Status Pekerja :<br>
						<strong>Contract</strong><br>
						Tanggal Waktu Pengajuan :<br>
						<strong><?php echo (($row->request_date == "")?"-":convert_to_dmy($row->request_date) .' '. convert_to_his($row->request_time)); ?></strong><br>
						Pemintaan Tanggal Pemenuhan :<br>
						<strong><?php echo convert_to_dmy($row->request_overdue); ?></strong><br>
						Alasan :<br>
						<strong>Replacement</strong><br>
					</address>
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
			
			<div class="form-group" style="border-bottom: 1px solid #eee;"></div>
			
			<!-- accepted payments column -->
			<div class="row">
				<!-- accepted payments column -->
				<div class="col-xs-4">
					<p class="medium">Approval 1</p>
					<br /><br />
					<p class="small">.....................</p>
					<p class="medium"><?php echo (($row->approval1_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->approval1_id))); ?></p>
					<p class="small"><?php echo (($row->approval1_date == "")?"-":convert_to_dmy($row->approval1_date)); ?></p>
					<p class="small"><?php echo (($row->approval1_date == "")?"-":convert_to_his($row->approval1_time)); ?></p>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<p class="medium">Approval 2</p>
					<br /><br />
					<p class="small">.....................</p>
					<p class="medium"><?php echo (($row->approval2_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->approval2_id))); ?></p>
					<p class="small"><?php echo (($row->approval2_date == "")?"-":convert_to_dmy($row->approval2_date)); ?></p>
					<p class="small"><?php echo (($row->approval2_date == "")?"-":convert_to_his($row->approval2_time)); ?></p>
				</div>
				<!-- /.col -->
				<div class="col-xs-4">
					<p class="medium">Approval 3</p>
					<br /><br />
					<p class="small">.....................</p>
					<p class="medium"><?php echo (($row->recruitment_id == "")?"-":strip_tags($this->m_user->get_name_by_id($row->recruitment_id))); ?></p>
					<p class="small"><?php echo (($row->recruitment_date == "")?"-":convert_to_dmy($row->recruitment_date)); ?></p>
					<p class="small"><?php echo (($row->recruitment_date == "")?"-":convert_to_his($row->recruitment_time)); ?></p>
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