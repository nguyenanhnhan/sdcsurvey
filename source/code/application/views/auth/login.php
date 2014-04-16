<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>SDC Survey - Login</title>
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo css_url() ?>bootstrap.min.css">

	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo css_url() ?>plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>themes.css">
	<!-- Pace CSS -->
	<link rel="stylesheet" type="text/css" href="<?php echo css_url() ?>plugins/pace/pace.min.css">


	<!-- jQuery -->
	<script src="<?php echo js_url() ?>jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?php echo js_url() ?>plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="<?php echo js_url() ?>plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo js_url() ?>plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="<?php echo js_url() ?>plugins/icheck/jquery.icheck.min.js"></script>
	<!-- pace (page progress loading) -->
	<script src="<?php echo js_url() ?>plugins/pace/pace.min.js"></script>
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

	<script type="text/javascript">
		paceOptions = {
		  // Disable the 'elements' source
		  elements: false,

		  // Only show the progress on regular and ajax-y page navigation,
		  // not every request
		  restartOnRequestAfter: false
		}
		$(document).ready(function (){
			$("#identity").focus();
		});
	</script>

</head>

<body class='login'>
	<div class="wrapper">
		<h1>
			<a href="#">
				<img src="<?php echo img_url() ?>logo-big.png" alt="" class='retina-ready' width="59" height="49">SDC Panel
			</a>
		</h1>
		<div class="login-body">
			<h2><?php echo lang('login_heading');?></h2>
			<form action="<?php echo base_url('auth/login') ?>" method='post' class='form-validate' id="form_login">
				<div class="form-group">
					<div class="email controls">
						<input type="text" name='identity' id='identity' placeholder="<?php echo lang('login_identity_label');?>" class='form-control' data-rule-required="true">
					</div>
				</div>
				<div class="form-group">
					<div class="pw controls">
						<input type="password" name="password" id='password' placeholder="<?php echo lang('login_password_label');?>" class='form-control' data-rule-required="true">
					</div>
				</div>
				<div id="infoMessage"><?php echo $message;?></div>
				<div class="submit">
					<div class="remember">
						<input type="checkbox" name="remember" class='icheck-me' data-skin="square" data-color="blue" id="remember"> <?php echo lang('login_remember_label', 'remember');?>
					</div>
					<input type="submit" value="<?php echo lang('login_submit_btn') ?>" class='btn btn-primary'>
				</div>
			</form>
			<div class="forget">
				&nbsp;
			</div>
		</div>
	</div>
</body>
</html>