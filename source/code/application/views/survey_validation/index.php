		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Kiểm tra độ tin cậy</h1>
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
							<a href="<?php echo base_url('survey_confirm') ?>">Kiểm tra độ tin cậy</a>
						</li>
					</ul>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									Điều kiện lấy dữ liệu ngẫu nhiên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<form action="<?php echo base_url('survey_validation/get_random') ?>" method="POST" class='form-horizontal form-bordered'>
									<div class="control-group">
										<label class="control-label">Loại khảo sát</label>
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
										<label class="control-label">Chọn câu hỏi</label>
										<div class="controls">
											<select name="question" id="question" class="chosen-select span12" data-placeholder="Chọn câu hỏi để lấy dữ liệu">
											
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Chọn câu trả lời</label>
										<div class="controls">
											<select name="answer_template" id="answer_template" class="chosen-select span6" data-placeholder="Chọn câu trả lời để lấy dữ liệu">
											
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Khoa</label>
										<div class="controls">
											<select name="faculty" id="faculty" class="chosen-select span6" data-placeholder="Chọn Khoa">
											
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">[Tên công ty]</label>
										<div class="controls">
											<select name="q_company_name" id="q_company_name" class="chosen-select span8" data-placeholder="Chọn câu hỏi để trích xuất">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_company_name" id="a_company_name" class="chosen-select span8" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">[Địa chỉ công ty]</label>
										<div class="controls">
											<select name="q_company_address" id="q_company_address" class="chosen-select span8" data-placeholder="Chọn câu hỏi để trích xuất">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_company_address" id="a_company_address" class="chosen-select span8" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">[Điện thoại]</label>
										<div class="controls">
											<select name="q_company_phone" id="q_company_phone" class="chosen-select span8" data-placeholder="Chọn câu hỏi để trích xuất">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_company_phone" id="a_company_phone" class="chosen-select span8" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">[Công việc đang làm]</label>
										<div class="controls">
											<select name="q_company_job" id="q_company_job" class="chosen-select span8" data-placeholder="Chọn câu hỏi trích xuất">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_company_job" id="a_company_job" class="chosen-select span8" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Số phần % cần lấy</label>
										<div class="controls">
											<select name="percent" id="percent" class="chosen-select span2" data-nosearch="true">
												<option value="5">5%</option>
												<option value="10">10%</option>
												<option value="15">15%</option>
												<option value="20">20%</option>
												<option value="25" selected="">25%</option>
												<option value="30">30%</option>
												<option value="35">35%</option>
												<option value="40">40%</option>
												<option value="45">45%</option>
												<option value="50">50%</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Tên danh sách</label>
										<div class="controls">
											<input type="text" name="list_name" id="list_name" class="input-xxlarge"/>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Lấy ngẫu nhiên</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Danh sach da thuc hien lay ngau nhien -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									Danh sách đã lấy dữ liệu ngẫu nhiên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<table class="table table-bordered table-nomargin">
									<!-- Table content -->
									<thead>
										<tr>
											<th style="width: 70px"></th>
											<th>Tên danh sách dữ liệu cần kiểm tra</th>
											<th style="width:150px">Ngày tạo</th>
											<!-- <th style="width:100px">Người tạo</th> -->
										</tr>
									</thead>
									<tbody>
										<?php foreach ($validation_list_random as $list_item) { ?>
											<tr>
												<td>
													<a href="<?php echo base_url('survey_validation/delete/'.$list_item['list_id']); ?>" class="btn btn-danger"><i class="icon-remove"></i></a>
													<a href="<?php echo base_url('survey_validation/view/'.$list_item['list_id']); ?>" class="btn btn-success"><i class="icon-eye-open"></i></a>
												</td>
												<td><?php echo $list_item['list_name']; ?></td>
												<td><?php echo mdate('%d/%m/%Y %H:%i:%s',strtotime($list_item['created_on_date'])); ?></td>
											</tr>
											<!--
<tr>
												<td colspan="3">
													<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
														<tbody>
															<tr><td>Rendering engine:</td><td>Gecko 1.7</td></tr>
															<tr><td>Link to source:</td><td>Could provide a link here</td></tr>
															<tr><td>Extra info:</td><td>And any further details here (images etc)</td></tr>
														</tbody>
													</table> 
												</td>
											</tr>
-->
										<?php } ?>
										<!--
<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="#" class="btn btn-success"><i class="icon-eye-open"></i></a>
											</td>
											<td>
												Internet
												Explorer 4.0
											</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="#" class="btn btn-success"><i class="icon-eye-open"></i></a>
											</td>
											<td>Nokia N800</td>
											<td></td>
											<td></td>
										</tr>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="#" class="btn btn-success"><i class="icon-eye-open"></i></a>
											</td>
											<td>NetFront 3.4</td>
											<td></td>
											<td></td>
										</tr>
-->
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- javascript -->
		<script type="text/javascript">
			$(document).ready(function(){
				// Khi chon dropdown Loai khao sat
				$('#survey_type').chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('survey_validation/gets_survey') ?>"+"/"+$('#survey_type').val(),
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
				
				// Khi chon dropdown Phieu khao sat
				$('#survey').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('survey_validation/gets_survey_faculty') ?>"+"/"+$('#survey').val(),
						dataType: 'json',
						success: function (data) {
							if (data.survey_faculties.length > 0 )
							{
								$('#faculty option').remove();
								$('#faculty').trigger('chosen:updated');
								for (var i=0; i<data.survey_faculties.length; i++)
								{
									$('#faculty').append('<option value="'+data.survey_faculties[i].faculty_id+'">'+data.survey_faculties[i].faculty_name+'</option>');
								}
								$('#faculty').trigger("chosen:updated");
							}
						}
					});
					
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('survey_validation/gets_question_answer_no_text') ?>"+"/"+$('#survey').val(),
						dataType: 'json',
						success: function (data) {
							$('#question option').remove();
							$('#question').trigger('chosen:updated');
							$('#question').append('<option value=""></option>');
							for (var i=0; i<data.questions.length; i++)
							{
								$('#question').append('<option value="'+data.questions[i].question_id+'">'+data.questions[i].content+'</option>');
							}
							$('#question').trigger("chosen:updated");
						}
					});
					
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('survey_validation/gets_question_answer_with_text') ?>"+"/"+$('#survey').val(),
						dataType: 'json',
						success: function (data) {
							$('#q_company_name option').remove();
							$('#q_company_address option').remove();
							$('#q_company_phone option').remove();
							$('#q_company_job option').remove();
							
							$('#q_company_name').trigger('chosen:updated');
							$('#q_company_address').trigger('chosen:updated');
							$('#q_company_phone').trigger('chosen:updated');
							$('#q_company_job').trigger('chosen:updated');
							
							$('#q_company_name').append('<option></option>');
							$('#q_company_address').append('<option></option>');
							$('#q_company_phone').append('<option></option>');
							$('#q_company_job').append('<option></option>');
							for (var i=0; i<data.questions.length; i++)
							{
								$('#q_company_name').append('<option value="'+data.questions[i].question_id+'">'+data.questions[i].content+'</option>');
								$('#q_company_address').append('<option value="'+data.questions[i].question_id+'">'+data.questions[i].content+'</option>');
								$('#q_company_phone').append('<option value="'+data.questions[i].question_id+'">'+data.questions[i].content+'</option>');
								$('#q_company_job').append('<option value="'+data.questions[i].question_id+'">'+data.questions[i].content+'</option>');
							}
							$('#q_company_name').trigger('chosen:updated');
							$('#q_company_address').trigger('chosen:updated');
							$('#q_company_phone').trigger('chosen:updated');
							$('#q_company_job').trigger('chosen:updated');
						}
					});
				});
				
				// Khi chon dropdown Cau hoi
				$('#question').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('survey_validation/gets_answer_template') ?>"+"/"+$('#question').val(),
						dataType: 'json',
						success: function(data){
							$('#answer_template option').remove();
							$('#answer_template').trigger('chosen:updated');
							for (var i=0; i<data.answer_template.length; i++)
							{
								$('#answer_template').append('<option value="'+data.answer_template[i].answer_template_id+'">'+data.answer_template[i].label+'</option>');
							}
							$('#answer_template').trigger('chosen:updated');
						}
					});
				});
				
				// khi chon dropdown cau hoi ten cong ty
				$('#q_company_name').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url:"<?php echo base_url('survey_validation/gets_answer_template') ?>"+"/"+$('#q_company_name').val(),
						dataType: 'json',
						success: function(data){
							$('#a_company_name option').remove();
							$('#a_company_name').trigger('chosen:updated');
							for (var i=0; i<data.answer_template.length; i++)
							{
								$('#a_company_name').append('<option value="'+data.answer_template[i].answer_template_id+'">'+data.answer_template[i].label+'</option>');
							}
							$('#a_company_name').trigger('chosen:updated');
						}
					});
				});
				
				// khi chon dropdown cau hoi dia chi cong ty
				$('#q_company_address').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url:"<?php echo base_url('survey_validation/gets_answer_template') ?>"+"/"+$('#q_company_address').val(),
						dataType: 'json',
						success: function(data){
							$('#a_company_address option').remove();
							$('#a_company_address').trigger('chosen:updated');
							for (var i=0; i<data.answer_template.length; i++)
							{
								$('#a_company_address').append('<option value="'+data.answer_template[i].answer_template_id+'">'+data.answer_template[i].label+'</option>');
							}
							$('#a_company_address').trigger('chosen:updated');
						}
					});
				});
				
				// khi chon dropdown cau hoi so dien thoai cong ty
				$('#q_company_phone').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url:"<?php echo base_url('survey_validation/gets_answer_template') ?>"+"/"+$('#q_company_phone').val(),
						dataType: 'json',
						success: function(data){
							$('#a_company_phone option').remove();
							$('#a_company_phone').trigger('chosen:updated');
							for (var i=0; i<data.answer_template.length; i++)
							{
								$('#a_company_phone').append('<option value="'+data.answer_template[i].answer_template_id+'">'+data.answer_template[i].label+'</option>');
							}
							$('#a_company_phone').trigger('chosen:updated');
						}
					});
				});
				
				// khi chon dropdown cau hoi cong viec tai cong ty
				$('#q_company_job').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url:"<?php echo base_url('survey_validation/gets_answer_template') ?>"+"/"+$('#q_company_job').val(),
						dataType: 'json',
						success: function(data){
							$('#a_company_job option').remove();
							$('#a_company_job').trigger('chosen:updated');
							for (var i=0; i<data.answer_template.length; i++)
							{
								if (data.answer_template[i].label)
								{
									$('#a_company_job').append('<option value="'+data.answer_template[i].answer_template_id+'">'+data.answer_template[i].label+'</option>');
								}
								else
								{
									$('#a_company_job').append('<option value="'+data.answer_template[i].answer_template_id+'">Câu trả lời không có nhãn</option>');
								}
							}
							$('#a_company_job').trigger('chosen:updated');
						}
					});
				});
			});
		</script>