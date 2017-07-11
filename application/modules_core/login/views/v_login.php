<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="<?php echo base_url(); ?>"><b>MPP </b>Application</a>
		</div><!-- /.login-logo -->
		<div class="login-box-body">
			<?php
				$message = $this->session->flashdata('message');
				echo $message == '' ? '<p class="login-box-msg">Sign in to start your session</p>' : '<p class="login-box-msg merah">' . $message . '</p>';
			?>
			<form action="<?php echo base_url(); ?>login/process-login" method="post">
				<div class="form-group has-feedback">
					<input type="text" class="form-control" placeholder="Username" name="username" autocomplete="off" required />
					<span class="glyphicon glyphicon-user form-control-feedback"></span>
				</div>
				<div class="form-group has-feedback">
					<input type="password" class="form-control" placeholder="Password" name="password" autocomplete="off" required />
					<span class="glyphicon glyphicon-lock form-control-feedback"></span>
				</div>
				<div class="row">
					<div class="col-xs-12">
						<div class="checkbox icheck col-xs-7"></div>
						<button type="submit" class="col-xs-5 btn btn-sm btn-social btn-github"><span class="fa fa-key"></span> <center>Sign In</center></button>
					</div><!-- /.col -->
				</div>
			</form>
		</div><!-- /.login-box-body -->
	</div><!-- /.login-box -->