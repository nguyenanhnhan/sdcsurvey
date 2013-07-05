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
								<form action="<?php echo base_url('survey/update_step_2/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>" 
								method="post" class="form-horizontal form-bordered" id="myform">
									<div class="control-group">
										<label class="control-label">Khung nhập thông tin</label>
										<div class="controls">
											<div class="input-xlarge">
												<select id="design_template" name="design_template" class="chosen-select">
													<?php 
														foreach ($design_templates as $design_item)
														{
															echo "<option value='".$design_item['design_template_id']."' img='".img_url().$design_item['image_link']."''>".$design_item['design_template_name']."</option>";	
														}
													?> 
												</select>
											</div>
										</div>
										<div class="control_group">
											<label class="control-label">Mô tả nội dung</label>
											<div class="controls">
												<img id="img-present" style="height: 50%" />
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" id="next" name="next" type="submit">Tiếp bước 3</button>
										<a href="<?php echo base_url('survey/edit_step_1/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'])?>" class="btn">Quay lại bước 1</a>
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
			 
			 	var img = $('#design_template option:selected').attr('img');
			 	
			 	$('#img-present').attr('src', img);
			 	
				$('#design_template').change(function(){
					var img = $('#design_template option:selected').attr('img');
					$('#img-present').attr('src', img);
				});
			 });
		</script>
