<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">
    <title>{{ config('app.name', 'Laravel') }}</title>

	<link rel="stylesheet" href="{{asset('assets/styles/style.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/fonts/themify-icons/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/waves/waves.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/sweet-alert/sweetalert.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/percircle/css/percircle.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/chart/chartist/chartist.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/fullcalendar/fullcalendar.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/fullcalendar/fullcalendar.print.css')}}" media='print'>

	
	<link rel="stylesheet" href="{{asset('assets/plugin/datatables/media/css/dataTables.bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('assets/plugin/datatables/extensions/Responsive/css/responsive.bootstrap.min.css')}}">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
<div class="main-menu">
	<header class="header">
		<a href="index.html" class="logo">
		<!-- <i class="ico ti-rocket"></i> -->
		Blessing Online</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content mCustomScrollbar _mCS_1"><div id="mCSB_1" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside" style="max-height: none;" tabindex="0"><div id="mCSB_1_container" class="mCSB_container" style="position:relative; top:0; left:0;" dir="ltr">

		@include('layouts.admin.sidebar')
		<!-- /.navigation -->
	</div><div id="mCSB_1_scrollbar_vertical" class="mCSB_scrollTools mCSB_1_scrollbar mCS-light mCSB_scrollTools_vertical" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_1_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; display: block; height: 80px; max-height: 232px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 30px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div></div>
	<!-- /.content -->
</div>
<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">Home</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		<!-- <div class="ico-item"> -->
			<!-- <a href="#" class="ico-item ti-search js__toggle_open" data-target="#searchform-header"></a> -->
			<!-- <form action="#" id="searchform-header" class="searchform js__toggle"><input type="search" placeholder="Search..." class="input-search"><button class="ti-search button-search" type="submit"></button></form> -->
			<!-- /.searchform -->
		<!-- </div> -->
		<!-- /.ico-item -->
		<!-- <a href="#" class="ico-item ti-email notice-alarm js__toggle_open" data-target="#message-popup"></a>
		<a href="#" class="ico-item ti-bell notice-alarm js__toggle_open" data-target="#notification-popup"></a> -->
		<div class="ico-item">
			<i class="ti-user"></i>
			<ul class="sub-ico-item">
				<!-- <li><a href="#">Settings</a></li> -->
				<form method="post" id="logoutform" action="{{route('logout')}}" class="">
					@csrf
				</form>
				<li><a class="2"  onclick='return document.getElementById("logoutform").submit()' href="#">Log Out</a></li>
				</form>
			</ul>
			<!-- /.sub-ico-item -->
		</div>
	</div>
	<!-- /.pull-right -->
</div>
    @yield('content')
    </body>
	<script src="{{asset('assets/scripts/jquery.min.js')}}"></script>
	<script src="{{asset('assets/scripts/modernizr.min.js')}}"></script>
	<script src="{{asset('assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<script src="{{asset('assets/plugin/nprogress/nprogress.js')}}"></script>
	<script src="{{asset('assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
	<script src="{{asset('assets/plugin/waves/waves.min.js')}}"></script>
	<script src="{{asset('assets/plugin/chart/sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('assets/scripts/chart.sparkline.init.min.js')}}"></script>
	<script src="{{asset('assets/plugin/percircle/js/percircle.js')}}"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js')}}"></script>
	<script src="{{asset('assets/plugin/chart/chartist/chartist.min.js')}}"></script>
	<script src="{{asset('assets/scripts/jquery.chartist.init.min.js')}}"></script>
	<script src="{{asset('assets/plugin/moment/moment.js')}}"></script>
	<script src="{{asset('assets/plugin/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('assets/scripts/fullcalendar.init.js')}}"></script>
	<script src="{{asset('assets/scripts/main.min.js')}}"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="{{asset('assets/plugin/datatables/media/js/jquery.dataTables.min.js')}}"></script>
	<script src="{{asset('assets/plugin/datatables/media/js/dataTables.bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/plugin/datatables/extensions/Responsive/js/dataTables.responsive.min.js')}}"></script>
	<script src="{{asset('assets/plugin/datatables/extensions/Responsive/js/responsive.bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/scripts/datatables.demo.min.js')}}"></script>
	<script>
		<?php
			/**
			$(".select2WithClient").select2({
				ajax: {
					url: '{{route("client.searchajax")}}',
					dataType: 'json'
				}
			});
			$(".select2WithUsers").select2({
				ajax: {
					url: '{{route("users.searchajax")}}',
					dataType: 'json'
				}
			});
			 */
		?>


			
	</script>
</body>
</html>