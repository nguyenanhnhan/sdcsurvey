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
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
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
				
				<!-- Tong hop theo hinh thuc khao sat -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									<i class="icon-download"></i>
									Kết xuất theo hình thức khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<form action="<?php echo base_url('report/export_kind_survey') ?>" method="post" class="form-horizontal form-bordered">
									<div class="control-group">
										<label class="control-label">Loại khảo sát</label>
										<div class="controls">
											<select name="kind_survey_type" id="kind_survey_type" class="chosen-select span8" data-placeholder="Chọn loại khảo sát" data-nosearch="true">
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
											<select name="kind_survey" id="kind_survey" class="chosen-select span12" data-placeholder="Chọn phiếu khảo sát" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Ngành đào tạo</label>
										<div class="controls">
											<select name="kind_faculty[]" id="kind_faculty" class='chosen-select span12' multiple="multiple" data-placeholder="Chọn các ngành cần kết xuất dữ liệu">
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
				
				<!-- Tong ket tong hop -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									<i class="icon-download"></i>
									Kết xuất tổng kết tổng hợp
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<form action="<?php echo base_url('report/export_sum_survey') ?>" method="post" class="form-horizontal form-bordered">
									<div class="control-group">
										<label class="control-label">Loại khảo sát</label>
										<div class="controls">
											<select name="sum_survey_type" id="sum_survey_type" class="chosen-select span8" data-placeholder="Chọn loại khảo sát" data-nosearch="true">
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
											<select name="sum_survey" id="sum_survey" class="chosen-select span12" data-placeholder="Chọn phiếu khảo sát" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Mẫu câu hỏi xác định Có/Chưa có việc làm</label>
										<div class="controls">
											<select name="q_sum_work" id="q_sum_work" class="chosen-select span12" data-placeholder="Chọn mẫu câu hỏi" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_sum_working" id="a_sum_working" class="chosen-select span12" data-placeholder="Chọn mẫu trả lời [Có việc làm]" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_sum_underwork" id="a_sum_underwork" class="chosen-select span12" data-placeholder="Chọn mẫu trả lời [Chưa có việc làm]" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Câu hỏi kết xuất dữ liệu</label>
										<div class="controls">
											<select name="sum_question[]" id="sum_question" class='chosen-select span12' multiple="multiple" data-placeholder="Chọn các câu hỏi cần kết xuất dữ liệu">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Ngành đào tạo</label>
										<div class="controls">
											<select name="sum_faculty[]" id="sum_faculty" class='chosen-select span12' multiple="multiple" data-placeholder="Chọn các ngành cần kết xuất dữ liệu">
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
				
				<!-- Tong ket du lieu danh gia -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									<i class="icon-download"></i>
									Kết xuất tổng kết dữ liệu đánh giá
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<form action="<?php echo base_url('report/export_evaluation_survey') ?>" method="post" class="form-horizontal form-bordered">
									<div class="control-group">
										<label class="control-label">Loại khảo sát</label>
										<div class="controls">
											<select name="eval_survey_type" id="eval_survey_type" class="chosen-select span8" data-placeholder="Chọn loại khảo sát" data-nosearch="true">
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
											<select name="eval_survey" id="eval_survey" class="chosen-select span12" data-placeholder="Chọn phiếu khảo sát" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Mẫu câu hỏi xác định Có/Chưa có việc làm</label>
										<div class="controls">
											<select name="q_eval_work" id="q_eval_work" class="chosen-select span12" data-placeholder="Chọn mẫu câu hỏi" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_eval_working" id="a_eval_working" class="chosen-select span12" data-placeholder="Chọn mẫu trả lời [Có việc làm]" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Ngành đào tạo</label>
										<div class="controls">
											<select name="eval_faculty[]" id="eval_faculty" class='chosen-select span12' multiple="multiple" data-placeholder="Chọn các ngành cần kết xuất dữ liệu">
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
				
				// Quickly report
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
				// end Quickly report
				
				
				// Kind survey report
				$('#kind_survey_type').chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('report/gets_survey') ?>"+"/"+$('#kind_survey_type').val(),
						dataType: 'json',
						success: function(data) {
							if (data.surveys.length > 0)
							{
								$('#kind_survey option').remove();
								$('#kind_survey').trigger("chosen:updated");
								
								$('#kind_survey').append('<option value=""></option>');
								for (var i=0; i<data.surveys.length; i++)
								{
									$('#kind_survey').append('<option value="'+data.surveys[i].survey_id+'">'+data.surveys[i].survey_name+'</option>');
								}
								$('#kind_survey').trigger("chosen:updated");
							}
						}
					});
				});
				$('#kind_survey').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('report/gets_survey_faculty') ?>"+"/"+$(this).val(),
						dataType: 'json',
						success: function (data) {
							if (data.survey_faculties.length > 0 )
							{
								$('#kind_faculty option').remove();
								$('#kind_faculty').trigger('chosen:updated');
								for (var i=0; i<data.survey_faculties.length; i++)
								{
									$('#kind_faculty').append('<option value="'+data.survey_faculties[i].faculty_id+'" selected>'+data.survey_faculties[i].faculty_name+'</option>');
								}
								$('#kind_faculty').trigger("chosen:updated");
							}
						}
					});
				});
				
				// Summary survey report
				$('#sum_survey_type').chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('report/gets_survey') ?>"+"/"+$(this).val(),
						dataType: 'json',
						success: function(data) {
							if (data.surveys.length > 0)
							{
								$('#sum_survey option').remove();
								$('#sum_survey').trigger("chosen:updated");
								
								$('#sum_survey').append('<option value=""></option>');
								for (var i=0; i<data.surveys.length; i++)
								{
									$('#sum_survey').append('<option value="'+data.surveys[i].survey_id+'">'+data.surveys[i].survey_name+'</option>');
								}
								$('#sum_survey').trigger("chosen:updated");
							}
						}
					});
				});
				$('#sum_survey').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('report/gets_survey_faculty') ?>"+"/"+$(this).val(),
						dataType: 'json',
						success: function (data) {
							if (data.survey_faculties.length > 0 )
							{
								$('#sum_faculty option').remove();
								$('#sum_faculty').trigger('chosen:updated');
								for (var i=0; i<data.survey_faculties.length; i++)
								{
									$('#sum_faculty').append('<option value="'+data.survey_faculties[i].faculty_id+'" selected>'+data.survey_faculties[i].faculty_name+'</option>');
								}
								$('#sum_faculty').trigger("chosen:updated");
							}
						}
					});
					
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('report/gets_question_answer_work') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function (data) {
							if (data.question.length > 0)
							{
								$("#q_sum_work option").remove();
								$("#q_sum_work").trigger("chosen:updated");
								
								$("#q_sum_work").append("<option value=''></option>");
								for (var i=0; i<data.question.length; i++)
								{
									$("#q_sum_work").append("<option value='"+data.question[i].question_id+"'>"+data.question[i].content+"</option>");
								}
								$("#q_sum_work").trigger("chosen:updated");
							}
						}
					});
					
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('report/gets_question_answer_no_text') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function (data) {
							if (data.questions.length > 0)
							{
								$("#sum_question option").remove();
								$("#sum_question").trigger("chosen:updated");
								
								$("#sum_question").append("<option value=''></option>");
								for (var i=0; i<data.questions.length; i++)
								{
									if (data.questions[i].flag_working == 1 || data.questions[i].flag_underwork == 1)
										$("#sum_question").append("<option value='"+data.questions[i].question_id+"' selected>"+data.questions[i].content+"</option>");
									else
										$("#sum_question").append("<option value='"+data.questions[i].question_id+"'>"+data.questions[i].content+"</option>");
								}
								$("#sum_question").trigger("chosen:updated");
							}
						}
					});
				});
				
				$("#q_sum_work").chosen().change(function(){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('report/gets_answer_template') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function(data) {
							$("#a_sum_working option").remove();
							$("#a_sum_underwork option").remove();
							
							$("#a_sum_working").trigger("chosen:updated");
							$("#a_sum_underwork").trigger("chosen:updated");
							
							$("#a_sum_working").append("<option value=''></option>");
							$("#a_sum_underwork").append("<option value=''></option");
							for (var i=0; i<data.answer_template.length; i++)
							{
								$("#a_sum_working").append("<option value='"+data.answer_template[i].answer_template_id+"'>"+data.answer_template[i].label+"</option>");
								$("#a_sum_underwork").append("<option value='"+data.answer_template[i].answer_template_id+"'>"+data.answer_template[i].label+"</option>");
							}
							$("#a_sum_working").trigger("chosen:updated");
							$("#a_sum_underwork").trigger("chosen:updated");
						}
					})
				});
				
				// Evalution report
				$('#eval_survey_type').chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('report/gets_survey') ?>"+"/"+$(this).val(),
						dataType: 'json',
						success: function(data) {
							if (data.surveys.length > 0)
							{
								$('#eval_survey option').remove();
								$('#eval_survey').trigger("chosen:updated");
								
								$('#eval_survey').append('<option value=""></option>');
								for (var i=0; i<data.surveys.length; i++)
								{
									$('#eval_survey').append('<option value="'+data.surveys[i].survey_id+'">'+data.surveys[i].survey_name+'</option>');
								}
								$('#eval_survey').trigger("chosen:updated");
							}
						}
					});
				});
				
				$('#eval_survey').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('report/gets_survey_faculty') ?>"+"/"+$(this).val(),
						dataType: 'json',
						success: function (data) {
							if (data.survey_faculties.length > 0 )
							{
								$('#eval_faculty option').remove();
								$('#eval_faculty').trigger('chosen:updated');
								for (var i=0; i<data.survey_faculties.length; i++)
								{
									$('#eval_faculty').append('<option value="'+data.survey_faculties[i].faculty_id+'" selected>'+data.survey_faculties[i].faculty_name+'</option>');
								}
								$('#eval_faculty').trigger("chosen:updated");
							}
						}
					});
					
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('report/gets_question_answer_work') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function (data) {
							if (data.question.length > 0)
							{
								$("#q_eval_work option").remove();
								$("#q_eval_work").trigger("chosen:updated");
								
								$("#q_eval_work").append("<option value=''></option>");
								for (var i=0; i<data.question.length; i++)
								{
									$("#q_eval_work").append("<option value='"+data.question[i].question_id+"'>"+data.question[i].content+"</option>");
								}
								$("#q_eval_work").trigger("chosen:updated");
							}
						}
					});
				});
				
				$("#q_eval_work").chosen().change(function(){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('report/gets_answer_template') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function(data) {
							$("#a_eval_working option").remove();
							
							$("#a_eval_working").trigger("chosen:updated");
							
							$("#a_eval_working").append("<option value=''></option>");
							for (var i=0; i<data.answer_template.length; i++)
							{
								$("#a_eval_working").append("<option value='"+data.answer_template[i].answer_template_id+"'>"+data.answer_template[i].label+"</option>");
							}
							$("#a_eval_working").trigger("chosen:updated");
						}
					})
				});
			});
		</script>
