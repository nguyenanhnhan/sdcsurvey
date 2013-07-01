<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>SDC Survey - Forgot Password</title>
	
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
		<div class="login-body">
			<h2><?php echo lang('forgot_password_heading');?></h2>
			<p style="padding: 0px 30px 5px 30px"><?php echo lang('forgot_password_subheading'); ?></p>
			<form action="auth/forgot_password" method='post' class='form-validate' id="form_login">
				<div class="control-group">
					<div class="email controls">
						<input type="text" name='uemail' placeholder="Email" class='input-block-level' data-rule-required="true" data-rule-email="true">
					</div>
				</div>
				<div>
					<input type="submit" class="btn btn-primary" value="<?php echo lang('forgot_password_submit_btn') ?>">
					<!-- <input type="button" class="btn" value="Quay lại trang đăng nhập" onclick="location.href = '<?php site_url('auth'); ?>';"> -->
					<a href="<?php echo base_url('auth')?>" class="btn">Quay lại trang đăng nhập</a>
				</div>
			</form>
			<div style="padding: 20px 30px 5px 30px">&nbsp;</div>
			<!--
<h1><?php echo lang('forgot_password_heading');?></h1>
			<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>
			
			<div id="infoMessage"><?php echo $message;?></div>
			
			<?php echo form_open("auth/forgot_password");?>
			
			      <p>
			      	<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
			      	<?php echo form_input($email);?>
			      </p>
			
			      <p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>
			
			<?php echo form_close();?>
-->
		</div>
	</div>
</body>
</html>