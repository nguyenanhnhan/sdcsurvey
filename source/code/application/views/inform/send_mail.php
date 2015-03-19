		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Gửi mail</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big" id="date">February 22, 2013</span>
									<span id="clock">Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url('admin') ?>">Root</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Thông báo</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-pencil"></i>
									Gửi email thông báo
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('inform/send'); ?>" method="post" class="form-horizontal form-bordered" id="myform" accept-charset="UTF-8">
									<div class="form-group">
										<label class="control-label col-sm-2">Khoa</label>
										<div class="col-sm-10">
											<select name="faculty" id="faculty" class='chosen-select form-control'>
												<?php foreach ($faculties as $faculty_item):?>
													<option value="<?php echo $faculty_item['faculty_id'] ?>"><?php echo $faculty_item['faculty_name'] ?></option>
													<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Phiếu khảo sát</label>
										<div class="col-sm-10">
												<select name="survey" id="survey" class="form-control">
												</select>
										</div>
									</div>
									<div class="form-group" style="display:none" >
										<label class="control-label col-sm-2">Ban TCCN</label>
										<div class="col-sm-10">
											<select name="vocation" id="vocation" class='chosen-select form-control' >
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2" >Từ địa chỉ</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="email_address" name="email_address" value="<?php echo $user_email; ?>" />
											<span class="help-block">Chỉ hỗ trợ địa chỉ e-mail của Trường ĐH Văn Lang</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Đến địa chỉ</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="to_email_address" name="to_email_address" />
											<span class="help-block">Các mail thông báo sẽ gửi đến địa chỉ này. Chỉ có hiệu lực trong quá trình test.</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Mật khẩu</label>
										<div class="col-sm-10">
											<input type="password" class="form-control" id="password" name="password" />
											<span class="help-block">Mật khẩu truy cập e-mail (hệ thống khảo sát không lưu lại mật khẩu này)</span>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Tiêu đề mail</label>
										<div class="col-sm-10">
											<input id="title" name="title" type="text" class="form-control" value="From: Van Lang University" />
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Nội dung &nbsp;
											<i id="replace_content" class="fa fa-undo" rel="tooltip" data-placement="bottom" data-original-title="Nội dung mẫu"></i>
											<i id="save_content" class="fa fa-save" rel="tooltip" data-placement"top" data-original-title="Lưu lại mẫu vừa soạn"></i>
										</label>
										<div class="col-sm-10">
											<textarea name="editor" id ="editor" class='form-control' rows="10">
												<?php echo $mail_template; ?>
											</textarea>
											<div style="color:red"><strong>Chú thích từ khoá</strong></div>
											<ul>
												<li><strong>[Student|Fullname]</strong>: Họ tên sinh viên trích xuất từ danh sách</li>
												<li><strong>[Faculty|Name]</strong>: Tên Khoa</li>
												<li><strong>[Survey|Link]</strong>: Đường dẫn đế phiếu khảo sát</li>
											</ul>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Số lượng gửi</label>
										<div class="col-sm-10">
											<select name="send_number" id="send_number" class="form-control" style="width:100px">
												<option value="10" selected>10</option>
												<option value="20">20</option>
												<option value="30">30</option>
												<option value="-1">Tất cả</option>
											</select>
											<span class="help-block">Việc gửi quá nhiều mail một lúc có thể bị đặt nghi vấn spam mail.</span>
										</div>
									</div>
									<div class="form-group" >
										<label class="control-label col-sm-2">Xem trước nội dung</label>
										<div class="col-sm-10">
											<input type="checkbox" name="preview" id="preview" class="icheck-me" data-skin="square" data-color="blue"/>
											<span class="help-block">Hiển thị nội dung cần gửi. Các nội dung này vẫn chưa được gửi đi.</span>
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
			</div>
		</div>
		<!--- Javascript -->
		<script type="text/javascript">
		$(document).ready(function(){
			
			tinyMCE.init({
				// General options
				selector:"textarea",
				mode: "textareas",
				force_br_newlines : true,
				force_p_newlines : true,
				forced_root_block : '',
 				entity_encoding : "raw"
			});
			

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
			
			$("#replace_content").click(function(){
				 tinyMCE.activeEditor.setContent(<?php echo "'".$mail_template."'"; ?>);
			});
			
			$("#save_content").click(function(){
				$.ajax({
					url:"<?php echo base_url('inform/save_mail_template') ?>",
					type:"POST",
					data:"content="+encodeURIComponent(tinyMCE.activeEditor.getContent())+"&title="+$("#title").val()+"&survey_id="+$("#survey option:selected").val(),
					dataType: "json",
					success: function (data){
						if (data == "TRUE")
						{
							var title = "Thông báo",
							message = "Đã lưu lại mẫu thư",
							time = 1000;
					
							$.gritter.add({
								title: 	(typeof title !== 'undefined') ? title : 'Message - Head',
								text: 	(typeof message !== 'undefined') ? message : 'Body',
								image: 	null,
								sticky: false,
								time: 	(typeof time !== 'undefined') ? time : 3000
							});
						}
						else
						{
							var title = "Thông báo",
							message = "Quá trình lưu xảy ra lỗi",
							time = 2000;
					
							$.gritter.add({
								title: 	(typeof title !== 'undefined') ? title : 'Message - Head',
								text: 	(typeof message !== 'undefined') ? message : 'Body',
								image: 	null,
								sticky: false,
								time: 	(typeof time !== 'undefined') ? time : 3000
							});
						}
					}
				});
			});
		});
		</script>
