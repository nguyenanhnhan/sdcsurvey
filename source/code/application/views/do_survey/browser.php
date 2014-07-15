<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

	<title>Thông báo</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo css_url() ?>bootstrap.min.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>themes.css">


	<!-- jQuery -->
	<script src="<?php echo js_url() ?>jquery.min.js"></script>

	<!-- Nice Scroll -->
	<script src="<?php echo js_url() ?>plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo js_url() ?>bootstrap.min.js"></script>

	<!--[if lte IE 9]>
		<script src="<?php echo js_url() ?>plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->

</head>

<body class='error'>
	<div class="wrapper">
		<div class="code">
			<span>Trình duyệt không được hỗ trợ</span>
			<i class="fa fa-warning"></i>
		</div>
		<div class="desc">Vì lý do bảo mật và sự hỗ trợ của Microsoft đối với trình duyệt này đã kết thúc. <br/> Bạn nên chuyển qua sử dụng trình duyệt IE 9 hoặc mới hơn.</div>
		
		<!-- <div class="buttons">
			<div class="pull-left">
				<a href="" class="btn">
					<i class="fa fa-arrow-left"></i>Back</a>
			</div>
		</div> -->
	</div>
</body>

</html>
