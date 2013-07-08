		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Phiếu khảo sát</h1>
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
							<a href="<?php echo base_url('survey_type') ?>">Loại khảo sát</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('survey_type/index/'.$survey_type['survey_type_id'])?>">
								<?php echo $survey_type['survey_type_name']; ?>
							</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#"><?php echo $survey['survey_name']; ?></a>
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
									Thông tin phiếu khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey/update_step_1/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="control-group">
										<label class="control-label">Tên phiếu khảo sát</label>
										<div class="controls">
											<input type="text" class="input-xxlarge" name="survey_name" id="survey_name" value="<?php echo $survey['survey_name']; ?>">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Bậc học  <?php print (bool)$survey['is_graduated'];?></label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="is_vocation" id="is_vocation" class='chosen-select'>
													<?php
														// Hien thi phan biet giua cap bac dao tao
														if ($survey['is_vocation'] == '1')
														{
															echo "<option value='0'>Đại học</option>";
															echo "<option value='1' selected='true'>Trung cấp chuyên nghiệp</option>";
														}
														else
														{
															echo "<option value='0' selected='true'>Đại học</option>";
															echo "<option value='1'>Trung cấp chuyên nghiệp</option>";
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Đã tốt nghiệp</label>
										<div class="controls">
											<input id="is_graduated" name="is_graduated" type="checkbox" class="icheck-me" 
											data-skin="square" data-color="blue" <?php if ($survey['is_graduated']=='1') echo 'checked' ?> />
										</div>
									</div>
									<div class="control-group" id="div_course">
										<label class="control-label">Khoá</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="course" id="course" class="chosen-select">
													<?php
														// Cac khoa hoc chua tot nghiep
														foreach ($courses_learning as $course_item){
															if ($course_item == $survey['course'])
															{
																echo "<option value='".$course_item."' selected='true'>".$course_item."</option>";
															}
															else
															{
																echo "<option value='".$course_item."'>".$course_item."</option>";
															}
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group" id="div_graduated_year">
										<label class="control-label">Năm tốt nghiệp</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="graduated_year" id="graduated_year" class="chosen-select">
													<?php 
														// Nam tot nghiep
														foreach ($graduated_years as $graduated_year) {
															if ($graduated_year == $survey['graduated_year'])
															{
																echo "<option value='".$graduated_year."' selected='true'>".$graduated_year."</option>";
															}
															else
															{
																echo "<option value='".$graduated_year."'>".$graduated_year."</option>";
															}
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group" id="div_faculty">
										<label class="control-label">Áp dụng cho Khoa</label>
										<div class="controls">
											<div class="input-xxxlarge">
												<select name="survey_faculty[]" id="survey_faculty" multiple="true" class="chosen-select">
													<?php foreach ($faculties as $faculty):
														if ($faculty['is_vocation']==0){?>
														<option value="<?php echo $faculty['faculty_id'] ?>" 
														<?php foreach ($survey_faculties as $survey_faculty_item){ if ($faculty['faculty_id'] == $survey_faculty_item['faculty_id']) echo "selected";} ?> >
														<?php echo $faculty['faculty_name'] ?> <!-- option name -->
														</option>
													<?php } endforeach ?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group" id="div_vocation">
										<label class="control-label">Áp dụng cho Ban TCCN</label>
										<div class="controls">
											<div class="input-xxxlarge">
												<select name="survey_faculty_vocation[]" id="survey_faculty_vocation" multiple="true" class="chosen-select">
													<?php foreach ($faculties as $faculty):
														if ($faculty['is_vocation']==1){?>
														<option value="<?php echo $faculty['faculty_id'] ?>"
														<?php foreach ($survey_faculties as $survey_faculty_item){ if ($faculty['faculty_id'] == $survey_faculty_item['faculty_id']) echo "selected";} ?>>
														<?php echo $faculty['faculty_name']?>
														</option>
													<?php } endforeach?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Áp dụng từ ngày</label>
										<div class="controls">
											<input type="text" name="start_date" id="start_date" class="input-medium datepick" 
											value="<?php echo date('d/m/Y',strtotime($survey['start_date'])); ?>">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Áp dụng đến ngày</label>
										<div class="controls">
											<input type="text" name="end_date" id="end_date" class="input-medium datepick"
											value="<?php echo date('d/m/Y', strtotime($survey['end_date'])); ?>">
										</div>
									</div>
									<div class="control-group">
										<label for="" class="control-label">Phiếu khảo sát cần được đánh giá</label>
										<div class="controls">
											<input type="checkbox" name="is_evaluated" id="is_evaluated" class="icheck-me" data-skin="square" 
											data-color="blue" <?php if ($survey['is_evaluated'] == '1') echo 'checked'; ?> />
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" id="next" name="next" type="submit">Tiếp bước 2</button>
										<a href="<?php echo base_url('survey/index/'.$survey_type['survey_type_id'])?>" class="btn">Huỷ</a>
										<!-- Dung luu id loai khao sat -->
										<input type="hidden" id="hidden_stype_id" name="hidden_stype_id" value="<?php echo $survey_type['survey_type_id']; ?>">
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
			 $(document).ready(function	(){
			 
			 	// hide/show div tag #div_course and #div_graduated_year
			 	// when reload page with value of checkbox #is_graduated
			 	if ($('#is_graduated').is(":checked")){
				 	$('#div_course').hide();
				 	$('#div_graduated_year').show();
			 	}
			 	else{
				 	$('#div_course').show();
				 	$('#div_graduated_year').hide();
			 	}
			 	
			 	// action when click checkbox graduated
				$('#is_graduated').click(function(){
					var $this = $(this);
					if ($this.is(':checked')){
						$('#div_course').hide();
						$('#div_graduated_year').show();
					}
					else{
						$('#div_course').show();
						$('#div_graduated_year').hide();
					}
				});
				
				// Khoi tao du lieu Khoa/Ban
				if ($('#is_vocation option:selected').val()==1){
					$('#div_faculty').hide();
					$('#div_vocation').show();
				}
				else{
					$('#div_faculty').show();
					$('#div_vocation').hide();
				}
			 });
		</script>
