		<div id="main">
			<div class="container-fluid" style="height:800px">
				<div class="page-header">
					<div class="pull-left">
						<h1>Loại khảo sát</h1>
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
							<a href="#">Kết xuất dữ liệu</a>
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
									<i class="icon-download"></i>
									Kết xuất báo cáo nhanh
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('report/export_quick_summary') ?>" method="post" id="my_form" class="form-horizontal form-bordered">
									<div class="control-group">
										<label for="survey_type" class="control-label">Loại khảo sát</label>
										<div class="controls">
											<select name="survey_type" id="survey_type" class='chosen-select span8' data-placeholder="Chọn loại khảo sát" data-nosearch="true">
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
									<div class="control-group">
										<label class="control-label">Phiếu khảo sát</label>
										<div class="controls">
											<select name="survey" id="survey" class='chosen-select span12' data-placeholder="Chọn phiếu khảo sát cần kết xuất dữ liệu" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Ngành đào tạo</label>
										<div class="controls">
											<select name="faculty[]" id="faculty" class='chosen-select span12' multiple="multiple" data-placeholder="Chọn các ngành cần kết xuất dữ liệu">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Theo câu hỏi</label>
										<div class="controls">
											<select name="question[]" id="question" multiple="multiple" class="chosen-select span12" data-placeholder="Chọn các câu hỏi cần kết xuất dữ liệu">
											</select>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" name="export" value="export">Kết xuất dữ liệu theo chuẩn excel 2003 (.xls)</button>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready( function() {
				
				$('#survey_type').chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('report/gets_survey') ?>"+"/"+$('#survey_type').val(),
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
						url: "<?php echo base_url('report/gets_survey_faculty') ?>"+"/"+$('#survey').val(),
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
					
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('report/gets_question_answer_no_text') ?>"+"/"+$('#survey').val(),
						dataType: 'json',
						success: function (data) {
							$('#question option').remove();
							$('#question').trigger('chosen:updated');
							for (var i=0; i<data.questions.length; i++)
							{
								$('#question').append('<option value="'+data.questions[i].question_id+'" selected>'+data.questions[i].content+'</option>');
							}
							$('#question').trigger("chosen:updated");
						}
					});
				});
			});
		</script>
