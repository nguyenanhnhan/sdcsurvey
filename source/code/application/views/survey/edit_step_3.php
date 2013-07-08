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
							<a href="<?php echo base_url('survey/index/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>">
								<?php echo $survey['survey_name']; ?>
							</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Sửa phiếu khảo sát</a>
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
								<form action="<?php echo base_url('survey/update_step_3/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="control-group">
										<label class="control-label">Câu hỏi khảo sát</label>
										<div class="controls">
											<input type="text" class="input-xxlarge" name="survey_question" id="survey_question">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Câu hỏi cần trả lời</label>
										<div class="controls">
											<input id="is_required" name="is_required" type="checkbox" data-skin="square" data-color="blue" class="icheck-me"/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Câu hỏi ẩn</label>
										<div class="controls">
											<input id="is_hide" name="is_hide" type="checkbox" data-skin="square" data-color="blue" class="icheck-me"/>
										</div>
									</div>
									<!--
<div class="control-group">
										<label class="control-label">Thứ tự sắp xếp</label>
										<div class="controls">
											<div class="input-medium">
												<select class="chosen-select">
													<option>Sau cuối</option>
												</select>
											</div>
										</div>
									</div>
-->
									<div class="control-group">
										<label class="control-label">Dạng câu trả lời</label>
										<div class="controls">
											<div class="input-medium">
												<select id="answer_type" name="answer_type" class="chosen-select">
													<option value="r">Một lựa chọn</option>
													<option value="c">Nhiều lựa chọn</option>
													<option value="t">Văn bản</option>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<div class="input-append input-prepend">
												<span id="add_more_answer" class="btn">Thêm câu trả lời</span>
												<div class="btn-group">
													<button class="btn dropdown-toggle" data-toggle="dropdown">
														Khác chuẩn
														<span class="caret"></span>
													</button>
													<ul class="dropdown-menu">
														<li>
															<span id="add_other_answer" class="btn" style="display:block; margin-left: 5px; margin-right: 5px">Thêm lựa chọn khác</span>
														</li>
														<li>
															<span id="add_province" class="btn" style="display:block; margin-left: 5px; margin-right: 5px">Thêm Tỉnh/Thành</span>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Mẫu câu trả lời</label>
										<div class="controls" id="dyn_zone">
											
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit">Lưu</button>
										<a href="#" class="btn">Tiếp bước 4</a>
										<a href="<?php echo base_url('survey/index/'.$survey_type['survey_type_id'])?>" class="btn">Quay lại bước 2</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Bảng câu hỏi -->
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									#1
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<?php print_r($survey_question); ?>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered green">
							<div class="box-title">
								<h3>
									#2. Sau mấy tháng tốt nghiệp Anh/Chị có việc làm đầu tiên?(không kể việc làm thêm khi đang đi học)
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered red">
							<div class="box-title">
								<h3>
									#3. Những nơi anh chị đã từng làm việc ?
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--- Javascript -->
		<script type="text/javascript">
			// Bien dem so control duoc them vao
			var c_count = 1;
			
			$('#answer_type').change(function(){
				$('#dyn_zone p').remove();
				c_count = 1;
			});
			
			//remove a object    
			$('#myform').on('click', '.removeVar', function(){
				$(this).parent().remove();
				c_count--;
			});
			
			// Them cau tra loi khi click 'Them cau tra loi'
			$('#add_more_answer').on('click', function(){
				
				if ($('#answer_type option:selected').val() == 't')
				{
					$node = "<p><input type='text' name='dyn_control[]' id='dyn_control_"+c_count+"' placeholder='Tiêu đề' class='input-xxlarge' /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
					c_count ++;
				}
				else
				{ 
					if($('#answer_type option:selected').val() == 'r')
					{
						$node = "<p><input type='radio' class='icheck-me' data-skin='square' data-color='blue'/>&nbsp;<input type='text' name='dyn_control[]' id='dyn_control_"+c_count+"' placeholder='Tiêu đề' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
						$('#dyn_zone').append($node);
					}
					else
					{
						$node = "<p><input type='checkbox' style='icheck-me' data-color='blue' data-skin='square'/>&nbsp;<input type='text' name='dyn_control[]' id='dyn_control_"+c_count+"' placeholder='Tiêu đề' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
						$('#dyn_zone').append($node);
					}
				}
			});
			
			// Them cau tra loi khi click 'Them cau hoi khac'
			$('#add_other_answer').on('click',function(){
				
				if($('#answer_type option:selected').val() == 'r')
				{
					$node = "<p><input type='radio' class='icheck-me' data-skin='square' data-color='blue'/>&nbsp;<input type='text' name='dyn_other_control[]' id='dyn_other_control_"+c_count+"' placeholder='Lựa chọn khác' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
				}
				else
					if($('#answer_type option:selected').val() == 'c')
					{
						$node = "<p><input type='checkbox' style='icheck-me' data-color='blue' data-skin='square'/>&nbsp;<input type='text' name='dyn_other_control[]' id='dyn_other_control_"+c_count+"' placeholder='Lựa chọn khác' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
						$('#dyn_zone').append($node);
					}
			});
			
			// Them cau tra loi khi click 'Them Tinh/Thanh'
			$('#add_province').on('click',function(){
				if ($('#answer_type option:selected').val() == 't')
				{
					$node = "<p><input type='text' placeholder='Tiêu đề' name='dyn_other_control[]' id='dyn_other_control_"+c_count+"' class='input-xxlarge' />&nbsp;<span class='uneditable-input' >Tỉnh/Thành</span><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
				}
			});
		</script>
		
