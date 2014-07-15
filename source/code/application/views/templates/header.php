<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>Survey - Dashboard</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo css_url() ?>bootstrap.min.css">
	<!-- jQuery UI -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/jquery-ui/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/jquery-ui/smoothness/jquery.ui.theme.css">
	<!-- PageGuide -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/pageguide/pageguide.css">
	<!-- Fullcalendar -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/fullcalendar/fullcalendar.css">
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/fullcalendar/fullcalendar.print.css" media="print">
	<!-- Tagsinput -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/tagsinput/jquery.tagsinput.css">
	<!-- chosen -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/chosen/chosen.css">
	<!-- multi select -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/multiselect/multi-select.css">
	<!-- timepicker -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/timepicker/bootstrap-timepicker.min.css">
	<!-- colorpicker -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/colorpicker/colorpicker.css">
	<!-- Datepicker -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/datepicker/datepicker.css">
	<!-- Plupload -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/plupload/jquery.plupload.queue.css">
	<!-- select2 -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/select2/select2.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>themes.css">
	<!-- dataTables -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/datatable/TableTools.css">
	<!-- Notify -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/gritter/jquery.gritter.css">
	<!-- Pace CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>plugins/pace/pace.min.css">

	<!-- jQuery -->
	<!-- <script src="<?php echo js_url() ?>jquery.min.js"></script> -->
	<script src="<?php echo js_url() ?>jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?php echo js_url() ?>plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- imagesLoaded -->
	<script src="<?php echo js_url() ?>plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
	<!-- jQuery UI -->
	<script src="<?php echo js_url() ?>plugins/jquery-ui/jquery.ui.core.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/jquery-ui/jquery.ui.widget.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/jquery-ui/jquery.ui.spinner.js"></script>
	<script src="<?php echo js_url() ?>plugins/jquery-ui/jquery.ui.slider.js"></script>
	<!-- dataTables -->
	<script src="<?php echo js_url() ?>plugins/datatable/jquery.dataTables.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/datatable/TableTools.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/datatable/ColReorder.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/datatable/ColVis.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/datatable/FixedColumns.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/datatable/dataTables.scroller.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo js_url() ?>bootstrap.min.js"></script>
	<!-- Bootbox -->
	<script src="<?php echo js_url() ?>plugins/bootbox/jquery.bootbox.js"></script>
	<!-- Masked inputs -->
	<script src="<?php echo js_url() ?>plugins/maskedinput/jquery.maskedinput.min.js"></script>
	<!-- TagsInput -->
	<script src="<?php echo js_url() ?>plugins/tagsinput/jquery.tagsinput.min.js"></script>
	<!-- Datepicker -->
	<script src="<?php echo js_url() ?>plugins/datepicker/bootstrap-datepicker.js"></script>
	<!-- Timepicker -->
	<script src="<?php echo js_url() ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<!-- Colorpicker -->
	<script src="<?php echo js_url() ?>plugins/colorpicker/bootstrap-colorpicker.js"></script>
	<!-- Chosen -->
	<script src="<?php echo js_url() ?>plugins/chosen/chosen.jquery.min.js"></script>
	<!-- MultiSelect -->
	<script src="<?php echo js_url() ?>plugins/multiselect/jquery.multi-select.js"></script>
	<!-- CKEditor -->
	<script src="<?php echo js_url() ?>plugins/ckeditor/ckeditor.js"></script>
	<!-- PLUpload -->
	<script src="<?php echo js_url() ?>plugins/plupload/plupload.full.js"></script>
	<script src="<?php echo js_url() ?>plugins/plupload/jquery.plupload.queue.js"></script>
	<!-- Custom file upload -->
	<script src="<?php echo js_url() ?>plugins/fileupload/bootstrap-fileupload.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/mockjax/jquery.mockjax.js"></script>
	<!-- select2 -->
	<script src="<?php echo js_url() ?>plugins/select2/select2.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo js_url() ?>plugins/icheck/jquery.icheck.min.js"></script>
	<!-- complexify -->
	<script src="<?php echo js_url() ?>plugins/complexify/jquery.complexify-banlist.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/complexify/jquery.complexify.min.js"></script>
	<!-- Validation -->
	<script src="<?php echo js_url() ?>plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/validation/additional-methods.min.js"></script>
	
	<script src="<?php echo js_url() ?>plugins/form/jquery.form.min.js"></script>
	<!-- Notify -->
	<script src="<?php echo js_url() ?>plugins/gritter/jquery.gritter.min.js"></script>
	
	<!-- TinyMCE -->
	<script src="<?php echo js_url() ?>plugins/tinymce/tinymce.min.js"></script>
	
	<!-- HighCharts -->
	<script src="<?php echo js_url() ?>plugins/highcharts/highcharts.js"></script>
	<script src="<?php echo js_url() ?>plugins/highcharts/modules/exporting.js"></script>
	<script src="<?php echo js_url() ?>plugins/highcharts/themes/grid.js"></script>

	<!-- pace (page progress loading) -->
	<script src="<?php echo js_url() ?>plugins/pace/pace.min.js"></script>

	<!-- Theme framework -->
	<!-- <script src="<?php echo js_url() ?>eakroko.min.js"></script> -->
	<script src="<?php echo js_url() ?>eakroko.js"></script>
	<!-- Theme scripts -->
	<!-- <script src="<?php echo js_url() ?>application.min.js"></script> -->
	<script src="<?php echo js_url() ?>application.js"></script>
	<!-- Just for demonstration -->
	<!-- <script src="<?php echo js_url() ?>demonstration.min.js"></script> -->
	<script src="<?php echo js_url() ?>demonstration.js"></script>
	
	<!--[if lte IE 9]>
		<script src="<?php echo js_url() ?>plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo img_url() ?>favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo img_url() ?>apple-touch-icon-precomposed.png" />
	
	<script type="text/javascript">
		function updateClock ( ){
			var currentTime  = new Date();
			
			var currentYear    = currentTime.getFullYear();
			var currentMonth   = currentTime.getMonth();
			var months         = new Array('Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12');
			
			var d              = currentTime.getDate();
			var day            = currentTime.getDay();
			var days           = new Array('Chủ nhật', 'Thứ hai', 'Thứ ba', 'Thứ tư', 'Thứ năm', 'Thứ sáu', 'Thứ bẩy');
			
			var currentHours   = currentTime.getHours();
			var currentMinutes = currentTime.getMinutes();
			var currentSeconds = currentTime.getSeconds();

		  	// Pad the minutes and seconds with leading zeros, if required
			currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
			currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

		  	// Choose either "AM" or "PM" as appropriate
			var timeOfDay = ( currentHours < 12 ) ? "SA" : "CH";
			
			// Convert the hours component to 12-hour format if needed
			currentHours  = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
			
			// Convert an hours component of "0" to "12"
			currentHours  = ( currentHours == 0 ) ? 12 : currentHours;

			// Compose the string for display
			var currentTimeString = days[day] + ", " + currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
			var currentDateString = d + " " + months[currentMonth] + " năm " + currentYear;
			
			// Update the time display
			$("#clock").text(currentTimeString);
			
			$("#date").text(currentDateString);
		}

	</script>
	<!--End of Zopim Live Chat Script-->
</head>
<body data-layout-sidebar="fixed" data-layout-topbar="fixed" onload="updateClock(); setInterval('updateClock()', 1000 )">
	<div id="navigation">
		<div class="container-fluid">
			<a href="#" id="brand">FLAT</a>
			<a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation">
				<i class="fa fa-bars"></i>
			</a>
			<ul class='main-nav'>
				<li>
					<a href="<?php echo base_url('admin')?>">
						<span>Dashboard</span>
					</a>
				</li>
				<?php if ($is_admin==1) { ?>
				<li>
					<a href="#" data-toggle="dropdown" class="dropdown-toggle">
						<span>Hệ thống</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li class="dropdown-submenu">
							<a href="#">Quản lý tài khoản</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo base_url('admin/groups') ?>">Nhóm tài khoản</a>
								</li>
								<li>
									<a href="<?php echo base_url('admin/users') ?>">Tài khoản</a>
								</li>
							</ul>
						</li>
						<li class="dropdown-submenu">
							<a href="#">Danh mục</a>
							<ul class="dropdown-menu">
								<li>
									<a href="#">Tỉnh/Thành</a>
								</li>
								<li>
									<a href="#">Khoa/Ban</a>
								</li>
								<li>
									<a href="#">Khoa - Lớp</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="#">Lịch sử hệ thống</a>
						</li>
					</ul>
				</li>
				<?php } ?>
			</ul>
			<div class="user">
				<div class="dropdown">
					<a href="#" class='dropdown-toggle' data-toggle="dropdown"><?php echo $display_name; ?><img src="<?php echo img_url() ?>demo/default_avatar.png" alt="" style="width: 27px; height: 27px"></a>
					<ul class="dropdown-menu pull-right">
						<li>
							<a href="<?php echo base_url('admin/edit_profile') ?>">Chỉnh sửa hồ sơ cá nhân</a>
						</li>
						<li>
							<a href="<?php echo base_url('auth/logout') ?>">Thoát</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid" id="content" >
		<div id="left">
			<?php if ($is_admin==1) { ?>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Thông tin sinh viên</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li>
						<a href="<?php echo base_url('admin/import_student') ?>">Nhập danh sách Sinh viên</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/export_student') ?>">Xuất danh sách Sinh viên</a>
					</li>
				</ul>
			</div>
			<?php } ?>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Quản lý khảo sát</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<?php if ($is_admin==1) { ?>
					<li>
						<a href="<?php echo base_url('survey_type') ?>">Phiếu khảo sát</a>
					</li>
					<?php  } ?>
					<li>
						<a href="<?php echo base_url('inform')?>">Thông báo</a>
					</li>
					<li>
						<a href="<?php echo base_url('survey_result') ?>">Danh sách SV khảo sát</a>
					</li>
					<?php if ($is_admin==1) { ?>
					<li>
						<a href="<?php echo base_url('survey_evaluation') ?>">Đánh giá</a>
					</li>
					<li>
						<a href="<?php echo base_url('survey_validation') ?>">Kiểm tra độ tin cậy</a>
					</li>
					<?php } ?>
				</ul>
			</div>
			<div class="subnav">
				<div class="subnav-title">
					<a href="#" class='toggle-subnav'>
						<i class="fa fa-angle-down"></i>
						<span>Thống kê</span>
					</a>
				</div>
				<ul class="subnav-menu">
					<li>
						<a href="<?php echo base_url('report/survey_status') ?>">Tình hình khảo sát</a>
					</li>
					<li>
						<a href="<?php echo base_url('report/survey_export') ?>">Kết xuất dữ liệu</a>
					</li>
					<li>
						<a href="<?php echo base_url('report/survey_summary') ?>">Thống kê tổng hợp</a>
					</li>
				</ul>
			</div>
		</div>