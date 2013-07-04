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

<body class='login'>
	<div class="wrapper">
		<h1><a href="#"><img src="<?php echo img_url() ?>sdc-logo-big.png" alt="" class='retina-ready' width="59" height="49">SDC Panel</a></h1>
		<div class="login-body">
			<h2><?php echo lang('login_heading');?></h2>
			<form action="<?php echo base_url('auth/login') ?>" method='post' class='form-validate' id="form_login">
				<div class="control-group">
					<div class="email controls">
						<input type="text" name='identity' id='identity' placeholder="<?php echo lang('login_identity_label');?>" class='input-block-level' data-rule-required="true">
					</div>
				</div>
				<div class="control-group">
					<div class="pw controls">
						<input type="password" name="password" id='password' placeholder="<?php echo lang('login_password_label');?>" class='input-block-level' data-rule-required="true">
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
				<a href="<?php echo base_url('auth/forgot_password') ?>"><span><?php echo lang('login_forgot_password');?></span></a>
			</div>
		</div>
	</div>

	<!--
<h1><?php echo lang('login_heading');?></h1>
	<p><?php echo lang('login_subheading');?></p>
	
	<div id="infoMessage"><?php echo $message;?></div>
	
	<?php echo form_open("auth/login");?>
	
	  <p>
	    <?php echo lang('login_identity_label', 'identity');?>
	    <?php echo form_input($identity);?>
	  </p>
	
	  <p>
	    <?php echo lang('login_password_label', 'password');?>
	    <?php echo form_input($password);?>
	  </p>
	
	  <p>
	    <?php echo lang('login_remember_label', 'remember');?>
	    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
	  </p>
	
	
	  <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>
	
	<?php echo form_close();?>
	
	<p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>
-->
</body>
</html>