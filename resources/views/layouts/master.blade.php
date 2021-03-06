<!DOCTYPE html>
<!--
This is a starter assets page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inventory Management System</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins -->
	<link rel="stylesheet" href="assets/dist/css/skins/skin-purple.css">

	{{-- page based CSS --}}
	@yield('CSS')

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body class="hold-transition skin-purple sidebar-mini" style="font-size: medium">
<div class="wrapper">

	<!-- Main Header -->
	<header class="main-header">

		<!-- Logo -->
		<a href="{{ url('/') }}" class="logo">
			<!-- mini logo for sidebar mini 50x50 pixels -->
			<span class="logo-mini"><b>I</b>MS</span>
			<!-- logo for regular state and mobile devices -->
			<span class="logo-lg"><i class="fa fa-desktop"></i><b> I-M-S</b></span>
		</a>

		<!-- Header Navbar -->
		<nav class="navbar navbar-static-top" role="navigation">
			<!-- Sidebar toggle button-->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
			</a>

			<!-- Navbar Right Menu -->
			{{--<div class="navbar-custom-menu">
				<ul class="nav navbar-nav">
					
					<!-- User Account Menu -->
					<li class="dropdown user user-menu">
						<!-- Menu Toggle Button -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<!-- The user image in the navbar-->
							<img src="assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
							<!-- hidden-xs hides the username on small devices so only the image appears. -->
							<span class="hidden-xs">Alexander Pierce</span>
						</a>
						<ul class="dropdown-menu">
							<!-- The user image in the menu -->
							<li class="user-header">
								<img src="assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

								<p>
									Alexander Pierce - Web Developer
									<small>Member since Nov. 2012</small>
								</p>
							</li>

							--}}{{-- <!-- Menu Body -->
							<li class="user-body">
								<div class="row">
									<div class="col-xs-4 text-center">
										<a href="#">Followers</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Sales</a>
									</div>
									<div class="col-xs-4 text-center">
										<a href="#">Friends</a>
									</div>
								</div>
								<!-- /.row -->
							</li> --}}{{--

							<!-- Menu Footer-->
							<li class="user-footer">
								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat">Profile</a>
								</div>
								<div class="pull-right">
									<a href="#" class="btn btn-default btn-flat">Sign out</a>
								</div>
							</li>
						</ul>
					</li>

					
				</ul>
			</div>
--}}
		</nav>
	</header>

		@include('layouts.nav')

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">

		<!-- Main content -->
		<section class="content">

			<!-- Content Header (Page header) -->
			<h2>

				@yield('page-title')

			</h2>

			<hr style="border-style: inset;" />
			<!-- Your Page Content Here -->

				@yield('content')

		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->

	<!-- Main Footer -->
	@include('layouts.footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/app.min.js"></script>

{{-- page based JS --}}
@yield('JavaScript')

</body>
</html>
