		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Phiếu khảo sát</h1>
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
							<a href="<?php echo base_url('survey_type') ?>">Loại khảo sát</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('survey_type/index/'.$survey_type['survey_type_id'])?>">
								<?php echo $survey_type['survey_type_name']; ?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('survey/index/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>">
								<?php echo $survey['survey_name']; ?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Sửa phiếu khảo sát</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-pencil"></i>
									Thông tin phiếu khảo sát
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey/update_step_3/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="form-group">
										<label class="control-label col-sm-2">Câu hỏi khảo sát</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="survey_question" id="survey_question">
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Câu hỏi cần trả lời</label>
										<div class="col-sm-10">
											<input id="is_required" name="is_required" type="checkbox" data-skin="square" data-color="blue" class="icheck-me form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Câu hỏi ẩn</label>
										<div class="col-sm-10">
											<input id="is_hide" name="is_hide" type="checkbox" data-skin="square" data-color="blue" class="icheck-me form-control"/>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Thứ tự sắp xếp</label>
										<div class="col-sm-10">
											<div class="col-xs-5">
												<select class="chosen-select form-control" name='view_order' data-nosearch="true">
													<!--
													<?php for($i=0,$len=count($survey_question);$i<$len;$i++){ ?>
														<option value="<?php echo $i+1 ?>">Vị trí <?php echo $i+1 ?></option>
													<?php } ?>
													-->
													<option value="<?php echo $max_view_order['view_order']+1 ?>" selected>Cuối cùng</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Dạng câu trả lời</label>
										<div class="col-sm-10">
											<div class="col-xs-5">
												<select id="answer_type" name="answer_type" class="chosen-select form-control" data-nosearch="true">
													<option value="r">Một lựa chọn</option>
													<option value="c">Nhiều lựa chọn</option>
													<option value="t">Văn bản</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2"></label>
										<div class="col-sm-10">
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
									<div class="form-group">
										<label class="control-label col-sm-2">Mẫu câu trả lời</label>
										<div class="col-sm-10" id="dyn_zone" style="min-height:40px">

										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Bổ sung thống kê</label>
										<div class="col-sm-10">
											<div class="check-line">
												<input type="checkbox" id="flag_working" class='icheck-me' data-skin="square" data-color="blue"/>
												<label class='inline' for="flag_working">Câu hỏi bổ nghĩa cho thống kê Có việc làm</label>
											</div>
											<div class="check-line">
												<input type="checkbox" id="flag_underwork" class="icheck-me" data-skin="square" data-color="blue"/>
												<label class="inline" for="flag_underwork">Câu hỏi bổ nghĩa cho thống kê Chưa có việc làm</label>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit">Lưu</button>
										<a href="<?php echo base_url('survey/edit_step_4/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'])?>" class="btn">Tiếp bước 4</a>
										<a href="<?php echo base_url('survey/edit_step_2/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'])?>" class="btn">Quay lại bước 2</a>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Bảng câu hỏi -->
				<?php
					for ($i=0, $len_q=count($survey_question); $i<$len_q; $i++)
					{
						$q_count = $i+1;
				?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered <?php if ($survey_question[$i]['required']==1) echo 'red'; else echo 'green'; ?>">
							<div class="box-title">
								<h3>
									<?php echo '#'.$q_count.' '.$survey_question[$i]['content']; ?>
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<!-- Ma noi dung tra loi cau hoi -->
								<?php
									// Chu thich Array
									// $survey_answer_template[$survey_question[$i]['question_id']: Array cau tra loi theo question_id
									// [$j]: vi tri trong Array cau tra loi
									// ['label']: ten field tuong ung can lay data
									$answer_template = $survey_answer_template[$survey_question[$i]['question_id']];
									for ($j=0, $len_a=count($answer_template); $j<$len_a; $j++)
									{
									?>
										<div class="form-group">
											<div class="controls">
									<?php
										switch ($answer_template[$j]['option_type'])
										{
											case 'r': // radio button
										?>
												<div class="check-line">
													<input type="radio" class="icheck-me" data-skin="minimal" name="<?php echo $survey_question[$i]['question_id'].'_a' ?>" value="<?php echo $answer_template[$j]['answer_template_id'] ?>">
													<label class="inline"><?php echo $answer_template[$j]['label']?></label>
												</div>
										<?php
												break;
											case 'c': // checkbox
										?>
												<div class="check-line">
													<input type="checkbox" class="icheck-me" data-skin="minimal" name="?php echo $survey_question[$i]['question_id'].'_a' ?>" value="<?php echo $answer_template[$j]['answer_template_id'] ?>">
													<label class="inline"><?php echo $answer_template[$j]['label']?></label>
												</div>
										<?php
												break; // text
											case 't':
												if ($answer_template[$j]['sub_answer']==0)
												{
										?>
												<!-- <div class="row-fluid">
													<div class="span12"> -->
														<label class="control-label"><?php echo $answer_template[$j]['label']?></label>
														<div class="controls controls-row">
															<input type="text" class="form-control" name="<?php echo $answer_template[$j]['answer_template_id']?>">
														</div>
													<!-- </div>
												</div> -->
										<?php
												}
												else
												{
										?>
												<div class="row">
													<div class="col-sm-8">
														<label class="control-label"><?php echo $answer_template[$j]['label']?></label>
														<div class="controls controls-row">
															<input type="text" class="form-control" name="<?php echo $answer_template[$j]['answer_template_id']?>">
														</div>
													</div>
													<div class="col-sm-4">
														<label class="control-label">Tỉnh/Thành</label>
														<div class="controls controls-row">
															<select class="chosen-select" style="width:100%" id='<?php echo $survey_answer_template_sub[$answer_template[$j]['answer_template_id']][0]['answer_template_id'] ?>'>
																<?php foreach ($provinces as $province_item):?>
																<option value='<?php echo $province_item['province_id']; ?>'><?php echo $province_item['province_name']; ?></option>
																<?php endforeach ?>
															</select>
														</div>
													</div>
												</div>
										<?php
												
												} /* print_r($survey_answer_template_sub); */
												break;
											case 'rt': // radio button + textbox
										?>

												<div class="check-line">
													<input type="radio" class="icheck-me" data-skin="minimal">
													<label class="inline"><?php echo $answer_template[$j]['label']?></label>
												</div>
												<input type="text" class="form-control">
										<?php	
												break;
												
											case 'ct': // checkbox + textbox
										?>
												
												<div class="check-line">
													<input type="checkbox" class="icheck-me" data-skin="minimal">
													<label class="inline"><?php echo $answer_template[$j]['label']?></label>
												</div>
												<input type="text" class="form-control">

										<?php
												break;
										}
										?>
											</div>
										</div>
										<?php
									} 
								?>
								<div style="form-actions">
									<a href="<?php echo base_url('survey/edit_question/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'].'/'.$survey_question[$i]['question_id']) ?>" class="btn btn-info">Chỉnh sửa</a>
									<a href="<?php echo base_url('survey/delete_question/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'].'/'.$survey_question[$i]['question_id']) ?>" class="btn btn-danger">Xoá</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					} // end for loop
				?>
			</div>
		</div>
		<!--- Javascript -->
		<script type="text/javascript">
			$(document).ready(function() {
				// Initial Funcion
				var init = function(){
					
				}
				
				init();
				// Bien dem so control duoc them vao
				var c_count = 1;
				
				$('#answer_type').change(function(){
					$('#dyn_zone div').remove();
					c_count = 1;
				});
				
				//remove a object    
				$('#myform').on('click', '.removeVar', function(){
					$(this).parents("div .input-group").remove();
					c_count--;
				});
				
				// Them cau tra loi khi click 'Them cau tra loi'
				$('#add_more_answer').on('click', function(){
					
					if ($('#answer_type option:selected').val() == 't')
					{
						$node = "<div class='input-group' style='margin-bottom:2px'><input type='text' name='dyn_control[]' id='dyn_control_"+c_count+"' placeholder='Tiêu đề' class='form-control' /><div class='input-group-btn'><span class='btn removeVar' style='height:34px'>Xoá</span></div></div>";
						$('#dyn_zone').append($node);
						c_count ++;
					}
					else
					{ 
						if($('#answer_type option:selected').val() == 'r')
						{
							$node = "<div class='input-group' style='margin-bottom:2px'><span class='input-group-addon'><i class='fa fa-circle-o'></i></span><input type='text' name='dyn_control[]' id='dyn_control_"+c_count+"' placeholder='Tiêu đề' class='form-control' /><div class='input-group-btn'><span class='btn removeVar' style='height:34px'>Xoá</span></div></div>";
							$('#dyn_zone').append($node);
						}
						else
						{
							$node = "<div class='input-group' style='margin-bottom:2px'><span class='input-group-addon'><i class='fa fa-square-o'></i></span><input type='text' name='dyn_control[]' id='dyn_control_"+c_count+"' placeholder='Tiêu đề' class='form-control' /><div class='input-group-btn'><span class='btn removeVar' style='height:34px'>Xoá</span></div></div>";
							$('#dyn_zone').append($node);
						}
					}
				});
				
				// Them cau tra loi khi click 'Them cau hoi khac'
				$('#add_other_answer').on('click',function(){
					
					if($('#answer_type option:selected').val() == 'r')
					{
						$node = "<div class='input-group' style='margin-bottom:2px'><span class='input-group-addon'><i class='fa fa-circle-o'></i></span><input type='text' name='dyn_other_control[]' placeholder='Lựa chọn khác' class='form-control' /><div class='input-group-btn'><span class='btn removeVar' style='height:34px'>Xoá</span></div></div>";
						$('#dyn_zone').append($node);
					}
					else
						if($('#answer_type option:selected').val() == 'c')
						{
							$node = "<div class='input-group' style='margin-bottom:2px'><span class='input-group-addon'><i class='fa fa-square-o'></i></span><input type='text' name='dyn_other_control[]' placeholder='Lựa chọn khác' class='form-control' /><div class='input-group-btn'><span class='btn removeVar' style='height:34px'>Xoá</span></div></div>";
							$('#dyn_zone').append($node);
						}
				});
				
				// Them cau tra loi khi click 'Them Tinh/Thanh'
				$('#add_province').on('click',function(){
					if ($('#answer_type option:selected').val() == 't')
					{
						// $node = "<div class='input-group' style='margin-bottom:2px'><span class='input-group-addon'><input type='text' placeholder='Tiêu đề' name='dyn_other_control[]' class='input-xxlarge' />&nbsp;<span class='uneditable-input' >Tỉnh/Thành</span><span class='btn removeVar'>Xoá</span></p>";
						$node = "<div class='input-group' style='margin-bottom:2px'><div class='col-xs-9'><input type='text' name='dyn_other_control[]' placeholder='Tiêu đề' class='form-control' /></div><div class='col-xs-3'><input type='text' placeholder='Tỉnh/Thành' class='form-control' disabled /></div><div class='input-group-btn'><span class='btn removeVar' style='height:34px'>Xoá</span></div></div>";
						$('#dyn_zone').append($node);
					}
				});

				// Bo sung thong ke
				$("#flag_working").change(function(){

					if ($(this).is(":checked"))
					{
						$("#flag_underwork").iCheck('uncheck');
					}
				});

				$("#flag_underwork").change(function(){
					if ($(this).is(":checked"))
					{
						$("#flag_working").iCheck('uncheck');
					}
				});
			});
			
		</script>
		
