		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin sinh viên</h1>
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
							<a href="<?php echo base_url() ?>admin">Root</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="import_student">Nhập danh sách sinh viên</a>
						</li>
					</ul>
				</div>
				<?php if (!empty($error)) {?>
				<div class="alert alert-error fade in" style="margin-top:10px; margin-bottom:0px" aria-hidden="true">
					<a href="#" class="btn btn-mini close" data-dismiss="alert"><i class="icon-remove"></i></a>
					<strong><?php echo $error; ?></strong>
				</div>
				<?php } ?>
				
				<?php if (!empty($success)) {?>
				<div class="alert alert-success fade in" style="margin-top:10px; margin-bottom:0px" aria-hidden="true">
					<a href="#" class="btn btn-mini close" data-dismiss="alert"><i class="icon-remove"></i></a>
					<strong><?php echo $success; ?></strong>
				</div>
				<?php } ?>
				
				<?php if (!empty($ignore)) {?>
				<div class="alert alert-info fade in" style="margin-top:10px; margin-bottom:0px" aria-hidden="true">
					<a href="#" class="btn btn-mini close" data-dismiss="alert"><i class="icon-remove"></i></a>
					<strong><?php echo $ignore; ?></strong>
				</div>
				<?php } ?>

				<?php if (!empty($invalid)){ ?>
				<div class="alert alert-error fade in" style="margin-top:10px; margin-bottom:0px" aria-hidden="true">
					<a href="#" class="btn btn-mini close" data-dismiss="alert"><i class="icon-remove"></i></a>
					Các sinh viên có MSV:
					<strong>
						<?php 
						$objects_number = count($invalid);
						$count = 0;
						foreach ($invalid as $item) {
							$count++;
							if ($count == $objects_number) echo $item;
							else echo $item.",";
						}?> 
					</strong>
					không đúng định dạng email.
				</div>
				<?php } ?>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-upload-alt"></i>
									Nhập danh sách sinh viên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url("admin/upload_student_list") ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered'>
									<div class="control-group">
										<label for="survey_type" class="control-label">Loại khảo sát</label>
										<div class="controls">
											<select name="survey_type" id="survey_type" class='chosen-select span8' data-placeholder="Chọn loại khảo sát" data-nosearch="true">
												<option value=""></option>
												<?php 
												foreach ($survey_type as $survey_type_item) { 
													if (isset($survey_type_selected)){
														if ($survey_type_item['survey_type_id'] == $survey_type_selected)
														{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" selected><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
														else 
														{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" ><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
													}
													else
													{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" ><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
												}?>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Phiếu khảo sát</label>
										<div class="controls">
											<select name="survey" id="survey" class='chosen-select span12' data-placeholder="Chọn phiếu khảo sát cần kết xuất dữ liệu" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<label for="file" class="control-label">Danh sách sinh viên</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="input-append">
													<div class="uneditable-input span3">
														<i class="icon-file fileupload-exists"></i> 
														<span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-file">
														<span class="fileupload-new">Chọn file</span>
														<span class="fileupload-exists">Thay đổi file</span>
														<input type="file" name="userfile" />
													</span>
													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Huỷ</a>
												</div>
											</div>
											<span class="help-block">Chỉ chấp nhận file .xls (Dung lượng tối đa: 10MB). Tải file mẫu <a href="<?php echo base_url("assets/template/students_list/students_list_import.xls")?>">tại đây </a></span>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Tiến hành cập nhật vào hệ thống</button>
										<button type="reset" class="btn">Huỷ</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
			
			window.setTimeout(function() { $(".alert-success").alert('close'); }, 3000);
			
			window.setTimeout(function() { $(".alert-info").alert('close'); }, 5000);
			
			/*
function createAutoClosingAlert(selector, delay) {
				var alert = $(selector).alert();
				window.setTimeout(function() { alert.alert('close') }, delay);
			}
*/
		
			$('#survey_type').chosen().change(function(){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('admin/gets_survey') ?>"+"/"+$('#survey_type').val(),
					dataType: 'json',
					success: function(data) {
						if (data.surveys.length > 0)
						{
							$('#survey option').remove();
							$('#survey').trigger("chosen:updated");
							
							$('#survey').append('<option value=""></option>');
							for (var i=0; i<data.surveys.length; i++)
							{
								$('#survey').append('<option value="'+data.surveys[i].survey_id+'">'+data.surveys[i].survey_name+'</option>');
							}
							$('#survey').trigger("chosen:updated");
						}
					}
				});
			});
		});
		</script>
