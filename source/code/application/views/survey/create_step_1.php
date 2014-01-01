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
							<a href="#">Tạo phiếu khảo sát</a>
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
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey/add'); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="control-group">
										<label class="control-label">Tên phiếu khảo sát</label>
										<div class="controls">
											<input type="text" class="span12" name="survey_name" id="survey_name">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Mã báo cáo</label>
										<div class="controls">
											<input type="text" class="span2" name="modified_char_report" id="modified_char_report">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Sử dụng lại</label>
										<div class="controls">
											<div class="span12">
												<select name="reuse" id="reuse" class="chosen-select span8">
													<option value="">&nbsp;</option>
													<?php
														// Mau khao sat dung de sao chep
														foreach ($surveys as $survey_item)
														{
															echo "<option value='".$survey_item['survey_id']."'>".$survey_item['survey_name']."</option>";
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Bậc học</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="is_vocation" id="is_vocation" class='chosen-select'>
													<option value="0">Đại học</option>
													<option value="1">Trung cấp chuyên nghiệp</option>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Đã tốt nghiệp</label>
										<div class="controls">
											<input id="is_graduated" name="is_graduated" type="checkbox" class="icheck-me" data-skin="square" data-color="blue" />
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
															echo "<option value='".$course_item."'>".$course_item."</option>";
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
															echo "<option value='".$graduated_year."'>".$graduated_year."</option>";
														}
													?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group" id="div_faculty">
										<label class="control-label">Áp dụng cho Khoa</label>
										<div class="controls">
											<div class="span12">
												<select name="survey_faculty[]" id="survey_faculty" multiple="true" class="chosen-select span12">
													<?php foreach ($faculties as $faculty):
														if ($faculty['is_vocation']==0){?>
														<option value="<?php echo $faculty['faculty_id'] ?>"><?php echo $faculty['faculty_name'] ?></option>
													<?php } endforeach ?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group" id="div_vocation">
										<label class="control-label">Áp dụng cho Ban TCCN</label>
										<div class="controls">
											<div class="span12">
												<select name="survey_faculty_vocation[]" id="survey_faculty_vocation" multiple="true" class="chosen-select span12">
													<?php foreach ($faculties as $faculty):
														if ($faculty['is_vocation']==1){?>
														<option value="<?php echo $faculty['faculty_id'] ?>"><?php echo $faculty['faculty_name']?></option>
													<?php } endforeach?>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Áp dụng từ ngày</label>
										<div class="controls">
											<input type="text" name="start_date" id="start_date" class="input-medium datepick">
										</div>
									</div>
									<div class="control-group">
										<label for="textfield" class="control-label">Áp dụng đến ngày</label>
										<div class="controls">
											<input type="text" name="end_date" id="end_date" class="input-medium datepick">
										</div>
									</div>
									<div class="control-group">
										<label for="" class="control-label">Phiếu khảo sát cần được đánh giá</label>
										<div class="controls">
											<input type="checkbox" name="is_evaluated" id="is_evaluated" class="icheck-me" data-skin="square" data-color="blue" />
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
				
				// ham loc Bac hoc anh huong den Khoa/Ban
				$('#is_vocation').change(function(){
					/* var is = $('#is_vocation option:selected').val(); */
					if ($('#is_vocation option:selected').val()==1){
						$('#div_faculty').hide();
						$('#div_vocation').show();
					}
					else{
						$('#div_faculty').show();
						$('#div_vocation').hide();
					}
					/* // De tham khao
					$.ajax({
						url: "<?php echo base_url('survey/get_faculties')?>"+"/"+is,
						type: 'POST',
						dataType: 'json',
						success: function(data){
						
							// Xoa tat ca option trong the select
							$('#survey_faculty option').each(function(){
								$(this).remove();
							});
							
							// Xoa tat ca <li> trong the <ul class=".chzn-results"
							$('#survey_faculty_chzn > .chzn-drop > .chzn-results > li').each(function(){
								$(this).remove();
							});
							
							for (var i=0, len = data.faculties.length; i<=len; i++){
								$('#survey_faculty').append("<option value='"+data.faculties[i].faculty_id+"'>"+data.faculties[i].faculty_name+"</option>");
								$('#survey_faculty_chzn > .chzn-choices').append("<li class='search-choice' id='survey_faculty_chzn_c_"+i+"'><span>"+data.faculties[i].faculty_name+"</span><a href='javascript:void(0)' class='search-choice-close' rel='"+i+"'></a></li>");
								$('#survey_faculty_chzn > .chzn-drop > .chzn-results').append("<li id='survey_faculty_chzn_o_"+i+"' class='active-result' style='' >"+data.faculties[i].faculty_name+"</li>");
							}
						}
							
					});
					*/

				});
			 });
		</script>
