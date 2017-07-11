<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->

<body class="hold-transition skin-blue fixed sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<header class="main-header">
			<!-- Logo -->
			<a href="javascript:void(0);" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>MPP</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>MPP </b>Application</span>
			</a>
			
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="javascript:void(0);" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					<!-- Messages: style can be found in dropdown.less-->
					<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { ?>
					<li class="dropdown notifications-menu">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-table"></i>
							<span id="count_manpower"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">Notification Man Power</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu" id="badge_manpower"></ul>
							</li>
							<li class="footer"><a href="javascript:void(0);" onClick="link_to('man-power');">View all</a></li>
						</ul>
					</li>
					<?php } ?>
					<?php if(($this->session->userdata('authority_id') == 3) || ($this->session->userdata('authority_id') == 5)) { ?>
					<li class="dropdown notifications-menu">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-sign-out"></i>
							<span id="count_leave"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">Notification Leave</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu" id="badge_leave"></ul>
							</li>
							<li class="footer"><a href="javascript:void(0);" onClick="link_to('approval/leave');">View all</a></li>
						</ul>
					</li>
					<?php if($this->session->userdata('authority_id') == 3) { ?>
					<li class="dropdown notifications-menu">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-sign-in"></i>
							<span id="count_request"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">Notification Request</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu" id="badge_request"></ul>
							</li>
							<li class="footer"><a href="javascript:void(0);" onClick="link_to('approval/request');">View all</a></li>
						</ul>
					</li>
					<?php } ?>
					<?php } ?>
					
					<?php if($this->session->userdata('authority_id') == 5) { ?>
					<li class="dropdown notifications-menu">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-check"></i>
							<span id="count_checking"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">Notification Checking</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu" id="badge_checking"></ul>
							</li>
							<li class="footer"><a href="javascript:void(0);" onClick="link_to('checking');">View all</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<?php if($this->session->userdata('authority_id') == 6) { ?>
					<li class="dropdown notifications-menu">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-file-text"></i>
							<span id="count_recruit"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">Notification Recruit</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu" id="badge_recruit"></ul>
							</li>
							<li class="footer"><a href="javascript:void(0);" onClick="link_to('recruit');">View all</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<?php if(($this->session->userdata('authority_id') == 2) || ($this->session->userdata('authority_id') == 4)) { ?>
					<li class="dropdown notifications-menu">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-file-text-o"></i>
							<span id="count_apply"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="header">Notification Apply</li>
							<li>
								<!-- inner menu: contains the actual data -->
								<ul class="menu" id="badge_apply"></ul>
							</li>
							<li class="footer"><a href="javascript:void(0);" onClick="link_to('apply');">View all</a></li>
						</ul>
					</li>
					<?php } ?>
					
					<!-- User Account: style can be found in dropdown.less -->
					<li class="dropdown user user-menu">
						<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown">
							<img src="<?php echo base_url() ."assets/uploads/".(($this->session->userdata('user_image') != "")?"user/thumb/". $this->session->userdata('user_image'):"no_image.png"); ?>" class="user-image" alt="User Image">
							<span class="hidden-xs"><?php echo (($this->session->userdata('user_fullname') != "")?$this->session->userdata('user_fullname'):"-"); ?></span>
						</a>
						<ul class="dropdown-menu">
							<!-- User image -->
							<li class="user-header">
								<img src="<?php echo base_url() ."assets/uploads/".(($this->session->userdata('user_image') != "")?"user/thumb/". $this->session->userdata('user_image'):"no_image.png"); ?>" class="img-circle" alt="User Image">
								<p>
									<?php echo (($this->session->userdata('user_fullname') != "")?$this->session->userdata('user_fullname'):"-"); ?>
									<small>Last login <?php echo (($this->session->userdata('last_login') != "")?convert_to_textual($this->session->userdata('last_login')):"-"); ?></small>
								</p>
							</li>
							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="javascript:void(0);" OnClick="link_to('change-password');" class="btn btn-default btn-flat">Change Password</a>
								</div>
								<div class="pull-right">
									<a href="javascript:void(0);" OnClick="link_to('login/process-logout');" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>
					<!-- Control Sidebar Toggle Button -->
					<li></li>
				</ul>
			</div>
		</nav>
    </header>

    <!-- =============================================== -->

    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		<section class="sidebar">
			<!-- Sidebar user panel -->
			<div class="user-panel">
				<div class="pull-left image">
					<img src="<?php echo base_url() ."assets/uploads/".(($this->session->userdata('user_image') != "")?"user/thumb/". $this->session->userdata('user_image'):"no_image.png"); ?>" class="img-circle" alt="User Image">
				</div>
				<div class="pull-left info">
					<p><?php echo (($this->session->userdata('user_fullname') != "")?$this->session->userdata('user_fullname'):"-"); ?></p>
					<a href="javascript:void(0);"><i class="fa fa-circle text-success"></i> Online</a>
				</div>
			</div>
			<?php $this->load->view('v_navigation'); ?>
		</section>
		<!-- /.sidebar -->
    </aside>