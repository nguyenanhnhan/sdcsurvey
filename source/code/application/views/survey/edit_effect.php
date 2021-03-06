		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Điều chỉnh hiệu ứng</h1>
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
							<a href="#">Điều chỉnh</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-pencil"></i>
									Tạo hiệu ứng ẩn/hiện cho câu trả lời [<?php echo $asnwer_template_item['label'] ?>]
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey/add_effect').'/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'].'/'.$question['question_id'].'/'.$asnwer_template_item['answer_template_id']; ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="form-group">
										<label class="control-label col-sm-2">Ẩn các câu hỏi</label>
										<div class="col-sm-10">
											<select name="survey_question_hide[]" id="survey_question_hide" multiple="true" class="chosen-select" style="width:100%" data-placeholder="Chấp nhận nhiều hơn một lựa chọn">
											<?php foreach ($survey_question_other as $question_item): ?>
												<option value='<?php echo $question_item['question_id'] ?>' 
												<?php foreach ($question_relation as $question_relation_item) 
												{ 
													// Hien cac cau hoi [AN]
													if (($question_relation_item['question_id']==$question_item['question_id']) && ($question_relation_item['attribute']==0)) echo 'selected';	
												} 
												?>
												> <!-- the option, don't del -->
												<?php echo $question_item['content'] ?>
												</option>
											<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Hiện các câu hỏi</label>
										<div class="col-sm-10">
											<select name="survey_question_show[]" id="survey_question_show" multiple="true" class="chosen-select" style="width:100%" data-placeholder="Chấp nhận nhiều hơn một lựa chọn">
											<?php foreach ($survey_question_other as $question_item): ?>
												<option value="<?php echo $question_item['question_id'] ?>"
												<?php foreach ($question_relation as $question_relation_item) 
												{ 
													// Hien cac cau hoi [HIEN]
													if (($question_relation_item['question_id']==$question_item['question_id']) && ($question_relation_item['attribute']==1)) echo 'selected';	
												} 
												?>
												> <!-- the option, don't del -->
												<?php echo $question_item['content'] ?>
												</option>
											<?php endforeach ?>
											</select>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" id="next" name="next" type="submit">Lưu</button>
										<a href="<?php echo base_url('survey/edit_step_4'.'/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'])?>" class="btn">Huỷ</a>
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

		</script>
