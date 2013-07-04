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
							<a href="<?php echo base_url('survey_types') ?>">Loại khảo sát</a>
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
								<form action="" method="post" class="form-horizontal form-striped">
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
													<option value="1">Option-1</option>
													<option value="2">Option-2</option>
													<option value="3">Option-3</option>
													<option value="4">Option-4</option>
													<option value="5">Option-5</option>
													<option value="6">Option-6</option>
													<option value="7">Option-7</option>
													<option value="8">Option-8</option>
													<option value="9">Option-9</option>
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
											<input id="is_graduated" type="checkbox" class="icheck-me" data-skin="square" data-color="blue" />
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Khoá</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="course" id="course" class="chosen-select">
													<option value="0">1</option>
													<option value="1">2</option>
													<option value="2">3</option>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Năm tốt nghiệp</label>
										<div class="controls">
											<div class="input-xlarge">
												<select name="graduated_year" id="graduated_year" class="chosen-select">
													<option value="1999">1999</option>
													<option value="2000">2000</option>
													<option value="2001">2001</option>
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
									<div class="form-actions">
										<button class="btn btn-primary" id="next" name="next" type="submit">Tiếp bước 2</button>
										<a href="<?php echo base_url('survey/index/'.$survey_type['survey_type_id'])?>" class="btn">Huỷ</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
