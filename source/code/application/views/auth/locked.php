<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>SDC Survey - Lock screen</title>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo css_url() ?>bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo css_url() ?>bootstrap-responsive.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>themes.css">


	<!-- jQuery -->
	<script src="<?php echo js_url() ?>jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?php echo js_url() ?>plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="<?php echo js_url() ?>plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo js_url() ?>plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo js_url() ?>bootstrap.min.js"></script>
	<script src="<?php echo js_url() ?>eakroko.js"></script>

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

</head>

<body class='locked'>
	<div class="wrapper">
		<div class="pull-left">
			<img src="<?php echo img_url() ?>demo/nhan_avatar.jpg" alt="" width="200" height="200">
			<a href=" login">Không phải Nhan Nguyen?</a>
		</div>
		<div class="right">
			<div class="upper">
				<h2>Nhan Nguyen</h2>
				<span>Tạm thoát</span>
			</div>
			<form action="auth/login" method='post'>
				<input type="password" placeholder="Mật khẩu">
				<div>
					<input type="submit" value="Đăng nhập lại" class='btn btn-inverse'>
				</div>
			</form>
		</div>
	</div>
	
</body>
</html>