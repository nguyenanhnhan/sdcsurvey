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
									Thông tin câu hỏi khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey/update_question/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'].'/'.$survey_question['question_id']); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="control-group">
										<label class="control-label">Câu hỏi khảo sát</label>
										<div class="controls">
											<input type="text" class="input-xxlarge" name="survey_question" id="survey_question" value="<?php echo $survey_question['content'] ?>">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Câu hỏi cần trả lời</label>
										<div class="controls">
											<input id="is_required" name="is_required" type="checkbox" data-skin="square" data-color="blue" class="icheck-me" <?php if ($survey_question['required']==1) echo 'checked' ?>/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Câu hỏi ẩn</label>
										<div class="controls">
											<input id="is_hide" name="is_hide" type="checkbox" data-skin="square" data-color="blue" class="icheck-me" <?php if ($survey_question['start_hide']==1) echo 'checked' ?>/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Thông tin cần cho xác thực</label>
										<div class="controls">
											<input id="is_validated" name="is_validated" type="checkbox" data-skin="square" data-color="blue" class="icheck-me" <?php if ($survey_question['is_validated']==1) echo 'checked' ?>/>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Thông tin cần cho đánh giá</label>
										<div class="controls">
											<input id="is_evaluated" name="is_evaluated" type="checkbox" data-skin="square" data-color="blue" class="icheck-me" <?php if ($survey_question['is_evaluated']==1) echo 'checked' ?>/>
										</div>
									</div>
									<!--
<div class="control-group">
										<label class="control-label">Thứ tự sắp xếp</label>
										<div class="controls">
											<div class="input-medium">
												<select class="chosen-select" name='view_order'>
													<?php for($i=0,$len=count($question_survey);$i<$len;$i++){ ?>
														<option value="<?php echo $i+1 ?>" <?php if($survey_question['view_order']==$i+1) echo 'selected' ?>>Vị trí <?php echo $i+1 ?></option>
													<?php } ?>
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
													<?php if (!empty($survey_answer_template)){?>
													<option value="r" <?php if ($survey_answer_template[0]['option_type']=='r') echo 'selected' ?>>Một lựa chọn</option>
													<option value="c" <?php if ($survey_answer_template[0]['option_type']=='c') echo 'selected' ?>>Nhiều lựa chọn</option>
													<option value="t" <?php if ($survey_answer_template[0]['option_type']=='t') echo 'selected' ?>>Văn bản</option>
													<?php } else { ?>
													<option value="r" >Một lựa chọn</option>
													<option value="c" >Nhiều lựa chọn</option>
													<option value="t" >Văn bản</option>
													<?php } ?>
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
										<a href='<?php echo base_url('survey/edit_step_3/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'])?>' class="btn">Quay lại</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- Fix loi footer tran len tren-->
				<div class="row-fluid" style="height: 50px">

				</div>
			</div>
		</div>
		<!--- Javascript -->
		<script type="text/javascript">
			
			// khoi tao du lieu dua len
			<?php foreach($survey_answer_template as $answer_template_item):?>
			if ($('#answer_type option:selected').val() == 't')
			{
				<?php if($answer_template_item['sub_answer']=='1') {?>
				$node = "<p><input type='text' placeholder='Tiêu đề' name='dyn_other_control[]' class='input-xxlarge' value='<?php echo $answer_template_item['label'] ?>'/>&nbsp;<span class='uneditable-input' >Tỉnh/Thành</span><span class='btn removeVar'>Xoá</span></p>";
				$('#dyn_zone').append($node);
				<?php } else {?>
				$node = "<p><input type='text' name='dyn_control[]' placeholder='Tiêu đề' class='input-xxlarge' value='<?php echo $answer_template_item['label'] ?>'/><span class='btn removeVar'>Xoá</span></p>";
				$('#dyn_zone').append($node);
				<?php } ?>
			}
			else
			{ 
				if($('#answer_type option:selected').val() == 'r')
				{
					<?php if($answer_template_item['option_type']=='rt') {?>
					$node = "<p><input type='radio'/>&nbsp;<input type='text' name='dyn_other_control[]' placeholder='Lựa chọn khác' class='input-large' value='<?php echo $answer_template_item['label'] ?>' /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
					<?php } else {?>
					$node = "<p><input type='radio'/>&nbsp;<input type='text' name='dyn_control[]' placeholder='Tiêu đề' class='input-large'value='<?php echo $answer_template_item['label'] ?>' /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
					<?php } ?>
				}
				else
				{
					<?php if($answer_template_item['option_type']=='ct') {?>
					$node = "<p><input type='checkbox'/>&nbsp;<input type='text' name='dyn_other_control[]' placeholder='Lựa chọn khác' class='input-large' value='<?php echo $answer_template_item['label'] ?>'  /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
					<?php } else {?>
					$node = "<p><input type='checkbox'/>&nbsp;<input type='text' name='dyn_control[]' placeholder='Tiêu đề' class='input-large' value='<?php echo $answer_template_item['label'] ?>' /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
					<?php } ?>
				}
			}
			<? endforeach ?>
			// Ket thuc khoi tao du lieu
			
			
			$('#answer_type').change(function(){
				$('#dyn_zone p').remove();
			});
			
			//remove a object    
			$('#myform').on('click', '.removeVar', function(){
				$(this).parent().remove();
			});
			
			// Them cau tra loi khi click 'Them cau tra loi'
			$('#add_more_answer').on('click', function(){
				
				if ($('#answer_type option:selected').val() == 't')
				{
					$node = "<p><input type='text' name='dyn_control[]' placeholder='Tiêu đề' class='input-xxlarge' /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);

				}
				else
				{ 
					if($('#answer_type option:selected').val() == 'r')
					{
						$node = "<p><input type='radio' />&nbsp;<input type='text' name='dyn_control[]' placeholder='Tiêu đề' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
						$('#dyn_zone').append($node);
					}
					else
					{
						$node = "<p><input type='checkbox' />&nbsp;<input type='text' name='dyn_control[]' placeholder='Tiêu đề' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
						$('#dyn_zone').append($node);
					}
				}
			});
			
			// Them cau tra loi khi click 'Them cau hoi khac'
			$('#add_other_answer').on('click',function(){
				
				if($('#answer_type option:selected').val() == 'r')
				{
					$node = "<p><input type='radio'/>&nbsp;<input type='text' name='dyn_other_control[]' placeholder='Lựa chọn khác' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
				}
				else
					if($('#answer_type option:selected').val() == 'c')
					{
						$node = "<p><input type='checkbox'/>&nbsp;<input type='text' name='dyn_other_control[]' placeholder='Lựa chọn khác' class='input-large' /><span class='btn removeVar'>Xoá</span></p>";
						$('#dyn_zone').append($node);
					}
			});
			
			// Them cau tra loi khi click 'Them Tinh/Thanh'
			$('#add_province').on('click',function(){
				if ($('#answer_type option:selected').val() == 't')
				{
					$node = "<p><input type='text' placeholder='Tiêu đề' name='dyn_other_control[]' class='input-xxlarge' />&nbsp;<span class='uneditable-input' >Tỉnh/Thành</span><span class='btn removeVar'>Xoá</span></p>";
					$('#dyn_zone').append($node);
				}
			});
		</script>
		
