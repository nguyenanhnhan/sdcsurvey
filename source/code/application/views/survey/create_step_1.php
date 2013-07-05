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
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey/add'); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="control-group">
										<label class="control-label">Tên phiếu khảo sát</label>
										<div class="controls">
											<input type="text" class="input-xxlarge" name="survey_name" id="survey_name">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Sử dụng lại</label>
										<div class="controls">
											<div class="input-xxlarge">
												<select name="reuse" id="reuse" class='chosen-select'>
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
			 });
		</script>
