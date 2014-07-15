		<div id="main">
			<div class="container-fluid" style="height:800px">
				<div class="page-header">
					<div class="pull-left">
						<h1>Loại khảo sát</h1>
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
							<a href="#">Tổng kết tổng hợp</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-download"></i>
									Kết xuất Tổng kết tổng hợp
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('report/export_summary') ?>" method="post" id="my_form" class="form-horizontal form-bordered">
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
									<div class="form-group" style="vertical-align: middle">
										<label class="control-label col-sm-2">Mẫu câu hỏi xác định Có/Chưa có việc làm</label>
										<div class="col-sm-10" style="min-height:59px">
											<select name="q_sum_work" id="q_sum_work" class="chosen-select form-control" data-placeholder="Chọn mẫu câu hỏi" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2"></label>
										<div class="col-sm-10">
											<select name="a_sum_working" id="a_sum_working" class="chosen-select form-control" data-placeholder="Chọn mẫu trả lời [Có việc làm]" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2"></label>
										<div class="col-sm-10">
											<select name="a_sum_underwork" id="a_sum_underwork" class="chosen-select form-control" data-placeholder="Chọn mẫu trả lời [Chưa có việc làm]" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Câu hỏi kết xuất dữ liệu</label>
										<div class="col-sm-10">
											<select name="sum_question[]" id="sum_question" class='chosen-select form-control' multiple="multiple" data-placeholder="Chọn các câu hỏi cần kết xuất dữ liệu">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Thời điểm thực hiện</label>
										<div class="col-sm-10">
											<select name="time_active[]" id="time_active" class='chosen-select form-control' multiple="multiple" data-placeholder="Chọn các thời điểm cần kết xuất dữ liệu">
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
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url("report/get_survey_of_year") ?>",
						dataType: "json",
						data: "survey_id="+$(this).val(),
						success: function (data) {
							$("#time_active option").remove();
							$("#time_active").trigger("chosen:updated");
							
							$("#time_active").append("<option value=''></option>");
							for (var i=0; i<data.year_summary.length; i++)
							{
								$("#time_active").append("<option value='"+data.year_summary[i].survey_id+"'>"+"Dữ liệu năm "+data.year_summary[i].created_on_year+"</option>");
							}
							$("#time_active").trigger("chosen:updated");
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
				// end Quickly report
			});
		</script>
