		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Gửi mail</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="icon-calendar"></i>
								<div class="details">
									<span class="big">February 22, 2013</span>
									<span>Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url('admin') ?>">Root</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Thông báo</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-pencil"></i>
									Gửi email thông báo
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('inform/send'); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="control-group">
										<label class="control-label">Khoa</label>
										<div class="controls">
											<div class="input-xxlarge">
												<select name="faculty" id="faculty" class='chosen-select'>
													<?php foreach ($faculties as $faculty_item):?>
														<option value="<?php echo $faculty_item['faculty_id'] ?>"><?php echo $faculty_item['faculty_name'] ?></option>
														<?php endforeach ?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Phiếu khảo sát</label>
										<div class="controls">
											<div class="input-xxlarge">
												<select name="survey" id="survey" class="input-block-level">
												</select>
											</div>
										</div>
									</div>
									<div class="control-group" style="display:none" >
										<label class="control-label">Ban TCCN</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="vocation" id="vocation" class='chosen-select'>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label" >Từ địa chỉ</label>
										<div class="controls">
											<input type="text" class="input-xlarge" id="email_address" name="email_address" value="<?php echo $user_email; ?>" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Mật khẩu</label>
										<div class="controls">
											<input type="password" class="input-xlarge" id="password" name="password" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tiêu đề mail</label>
										<div class="controls">
											<input id="title" name="title" type="text" class="input-xxlarge" value="From: Van Lang University" />
										</div>
									</div>
									<div class="control-group" id="div_course">
										<label class="control-label">Nội dung</label>
										<div class="controls">
											<textarea name="editor" id ="editor" class='span12' rows="10">
											<?php echo $mail_template ?>
											</textarea>
										</div>
									</div>
									<div class="control-group" id="div_graduated_year">
										<label class="control-label">Số lượng gửi</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="send_number" id="send_number" class="chosen-select">
													<option value="10" selected>10</option>
													<option value="20">20</option>
													<option value="30">30</option>
													<option value="-1">Tất cả</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" id="next" name="next" type="submit">Gửi mail</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid" style="height:100px">
				
				</div>
			</div>
		</div>
		<!--- Javascript -->
		<script type="text/javascript">
		tinyMCE.init({
			// General options
			selector:"textarea"
		});
		
		$(document).ready(function(){
			
			// Khoi tao data
			$.ajax({
				url: "<?php echo base_url('survey_result/get_survey_of_faculty') ?>"+"/"+$("#faculty option:selected").val(),
				type: 'POST',
				dataType: 'json',
				success: function(data){
					// remove het option trong select faculty
					$("#survey option").each(function(){
						$(this).remove();
					});
					
					for (var i=0, len=data.surveys_faculty.length; i<len; i++)
					{
						$("#survey").append("<option value='"+data.surveys_faculty[i].survey_id+"'>"+data.surveys_faculty[i].survey_name+"</option>");
					}
				}
			});
			
			// Bat su kien khi chon khoa
			$("#faculty").change(function(){
				$.ajax({
					url: "<?php echo base_url('inform/get_survey_of_faculty') ?>"+"/"+$("#faculty option:selected").val(),
					type: 'POST',
					dataType: 'json',
					success: function(data){
						// remove het option trong select faculty
						$("#survey option").each(function(){
							$(this).remove();
						});
						
						for (var i=0, len=data.surveys_faculty.length; i<len; i++)
						{
							$("#survey").append("<option value='"+data.surveys_faculty[i].survey_id+"'>"+data.surveys_faculty[i].survey_name+"</option>");
						}
					}
				});
			});
		});
		</script>
