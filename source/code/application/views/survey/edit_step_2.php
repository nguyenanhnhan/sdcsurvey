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
									<i class="icon-pencil"></i>
									Thông tin phiếu khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey/update_step_2/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>" method="post" class="form-horizontal form-bordered" id="myform">
									<div class="form-group">
										<label class="control-label col-sm-2">Khung nhập thông tin</label>
										<div class="col-sm-10">
											<div class="col-xs-5">
												<select id="design_template" name="design_template" class="chosen-select form-control">
													<?php 
														foreach ($design_templates as $design_item)
														{
															echo "<option value='".$design_item['design_template_id']."' img='".img_url().$design_item['image_link']."''>".$design_item['design_template_name']."</option>";	
														}
													?> 
												</select>
											</div>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Mô tả nội dung</label>
										<div class="col-sm-10" style="height:355px">
											<img id="img_present" alt=""/>
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
			 	
			 	$('#img_present').attr('src', img);
			 				 	
				$('#design_template').change(function(){
					var img = $('#design_template option:selected').attr('img');
					$('#img_present').attr('src', img);
				});
			 });
		</script>
