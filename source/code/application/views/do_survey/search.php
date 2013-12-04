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
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo css_url() ?>themes.css">
	
	<!-- css seprate -->
	<link href="<?php echo css_url() ?>StyleSheet.css" rel="stylesheet" type="text/css" />
	
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

<body>
	<div id="form_wrapper">
		<div class="top">
			<div id="logo_holder"> <a href="/"><img src="<?php echo img_url() ?>do_survey/logo.png" /></a> </div>
		<div class="clear"></div>
	</div
	<div class="roundcont">
		<div class="Container">
			<div style="padding-left:5px"><h2>Tìm Mã sinh viên</h2></div>
			<div style="padding-left:5px">
				<form method="post" action="<?php echo base_url("do_survey/search_student/".$survey_id) ?>">
					<table border="0">
						<tr>
							<td>Họ và tên đệm</td>
							<td><input class="span4" name="first_name"></td>
						</tr>
						<tr>
							<td>Tên</td>
							<td><input class="span4" name="last_name"></td>
						</tr>
						<tr>
							<td>Lớp</td>
							<td><input class="span4" name="class"></td>
						</tr>
						<tr>
							<td>Khoa</td>
							<td>
								<select name="faculty" class="span6">
									<option value=""></option>
									<option value="M">Công nghệ môi trường</option>
									<option value="S">Công nghệ sinh học</option>
									<option value="T">Công nghệ thông tin</option>
									<option value="D">Du lịch</option>
									<option value="K">Kế toán - Kiểm toán</option>
									<option value="A">Kiến trúc</option>
									<option value="C">Kinh tế thương mại</option>
									<option value="H">Mỹ thuật công nghiệp</option>
									<option value="N">Ngoại ngữ</option>
									<option value="I">Nhiệt lạnh</option>
									<option value="P">Quan hệ công chúng</option>
									<option value="Q">Quản trị kinh doanh</option>
									<option value="F">Tài chính ngân hàng</option>
									<option value="X">Xây dựng</option>
								</select>
							</td>
						</tr>
						<tr>
							<td></td>
							<td>
								<button type="submit" class="btn btn-primary">Tìm Mã sinh viên</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div style="padding-left:5px">
				<?php if (!empty($students)) { ?>
				<div><h2>Kết quả</h2></div>
				<?php foreach ($students as $student_item) { ?>
				<div><a href="<?php echo base_url("do_survey/student/".$student_item["faculty_id"]."/".$survey_id."/".$student_item["student_id"]) ?>"><?php echo $student_item["student_id"]." | ".$student_item["first_name"]." | ".$student_item["last_name"]." | ".$student_item["class_id"]." | ".$student_item["faculty_name"] ?></a></div>
				<?php } // end foreach ?>
				<?php } // end if?>
			</div>
		</div>
	</div>
	
</body>
</html>