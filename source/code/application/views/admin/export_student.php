		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin sinh viên</h1>
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
							<a href="<?php echo base_url() ?>admin">Root</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Xuất danh sách sinh viên</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-cloud-download"></i>
									Xuất danh sách sinh viên khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url("admin/export_info") ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered'>
									<div class="form-group">
										<label for="survey_type" class="control-label col-sm-2">Loại khảo sát</label>
										<div class="col-sm-10">
											<select name="survey_type" id="survey_type" class='chosen-select form-control' data-placeholder="Chọn loại khảo sát" data-nosearch="true">
												<option value=""></option>
												<?php 
												foreach ($survey_type as $survey_type_item) { 
													if (isset($survey_type_selected)){
														if ($survey_type_item['survey_type_id'] == $survey_type_selected)
														{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" selected><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
														else 
														{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" ><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
													}
													else
													{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" ><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
												}?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Phiếu khảo sát</label>
										<div class="col-sm-10">
											<select name="survey" id="survey" class='chosen-select form-control' data-placeholder="Chọn phiếu khảo sát cần kết xuất dữ liệu" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Ngành đào tạo</label>
										<div class="col-sm-10">
											<select name="faculty[]" id="faculty" class='chosen-select form-control' multiple="multiple" data-placeholder="Chọn các ngành cần kết xuất dữ liệu">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Dữ liệu còn thiếu</label>
										<div class="col-sm-10">
											<select name="data_missing[]" id="data_missing" multiple="multiple" class="chosen-select form-control" data-placeholder="Chọn các câu hỏi cần kết xuất dữ liệu">
												<option value="phone">Điện thoại bàn</option>
												<option value="hand_phone">Điện thoại di động</option>
												<option value="contact_address">Địa chỉ liên hệ</option>
												<option value="email">Địa chỉ thư điện tử (email)</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Sinh viên</label>
										<div class="col-sm-10">
											<input type="radio" id="radio_student" class='icheck-me' data-skin="square" data-color="blue" name="radio_student_option" value="0" checked>
											<label class='inline' for="radio_student">Chưa khảo sát</label>&nbsp;&nbsp;
											<input type="radio" id="radio_student_surveyed" name="radio_student_option" class='icheck-me' data-skin="square" data-color="blue" value="1">
											<label class='inline' for="radio_student_surveyed">Đã khảo sát</label>
										</div>
									</div>
									<div class="form-actions col-sm-offset-2 col-sm-10">
										<button type="submit" class="btn btn-primary">Kết xuất dữ liệu theo chuẩn excel (.xls)</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				
				$('#survey_type').chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('admin/gets_survey') ?>"+"/"+$('#survey_type').val(),
						dataType: 'json',
						success: function(data) {
							if (data.surveys.length > 0)
							{
								$('#survey option').remove();
								$('#survey').trigger("chosen:updated");
								
								$('#survey').append('<option value=""></option>');
								for (var i=0; i<data.surveys.length; i++)
								{
									$('#survey').append('<option value="'+data.surveys[i].survey_id+'">'+data.surveys[i].survey_name+'</option>');
								}
								$('#survey').trigger("chosen:updated");
							}
						}
					});
				});
				
				$('#survey').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('admin/gets_survey_faculty') ?>"+"/"+$('#survey').val(),
						dataType: 'json',
						success: function (data) {
							if (data.survey_faculties.length > 0 )
							{
								$('#faculty option').remove();
								$('#faculty').trigger('chosen:updated');
								for (var i=0; i<data.survey_faculties.length; i++)
								{
									$('#faculty').append('<option value="'+data.survey_faculties[i].faculty_id+'" selected>'+data.survey_faculties[i].faculty_name+'</option>');
								}
								$('#faculty').trigger("chosen:updated");
							}
						}
					});
				});
			});
		</script>
