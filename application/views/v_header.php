<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<link rel="icon" href="<?php echo base_url(); ?>assets/img/favicon.jpg" type="image/x-icon" />
		<script type="application/x-javascript">var base_url = '<?php echo base_url(); ?>'</script>
		<!-- for-mobile-apps -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<script type="application/x-javascript"> 
			addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
			function hideURLbar(){ window.scrollTo(0,1); } 
		</script>
		<!-- //for-mobile-apps -->
		
		<!-- Tell the browser to be responsive to screen width -->
		<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<!-- Bootstrap 3.3.5 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
		<!-- Ionicons -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ionicons/css/ionicons.min.css">
		
		<!-- DataTables -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">
		<!-- iCheck -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">
		<!-- bootstrap wysihtml5 - text editor -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
		<!-- Select2 -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/select2/select2.min.css">
		<!-- daterange picker -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker-bs3.css">
		<!-- Bootstrap time Picker -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/timepicker/bootstrap-timepicker.min.css">
		
		<!-- Fancybox -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fancybox/fancybox.css">
		
		<!-- Theme style -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ImLTE.min.css">
		
		<!-- ImLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/_all-skins.min.css">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	
		<!-- Custom -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/global.css">
		
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