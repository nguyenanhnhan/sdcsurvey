		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin sinh viên</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big" id="date">February 22, 2013</span>
									<span id="clock"></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url() ?>admin">Root</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="import_student">Nhập danh sách sinh viên</a>
						</li>
					</ul>
				</div>
				<?php if (!empty($error)) {?>
				<div class="alert alert-danger fade in" style="margin-top:10px; margin-bottom:-10px">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong><?php echo $error; ?></strong>
				</div>
				<?php } ?>
				
				<?php if (!empty($success)) {?>
				<div class="alert alert-success fade in" style="margin-top:10px; margin-bottom:-10px">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong><?php echo $success; ?></strong>
				</div>
				<?php } ?>
				
				<?php if (!empty($ignore)) {?>
				<div class="alert alert-info fade in" style="margin-top:10px; margin-bottom:-10px">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong><?php echo $ignore; ?></strong>
				</div>
				<?php } ?>

				<?php if (!empty($updated)) {?>
				<div class="alert alert-info fade in" style="margin-top:10px; margin-bottom:-10px">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<strong><?php echo $updated; ?></strong>
				</div>
				<?php } ?>
				<!-- danh sách lỗi email -->
				<?php if (!empty($invalid)){ ?>
				<div class="alert alert-danger fade in" style="margin-top:10px; margin-bottom:-10px">
					<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					Các sinh viên có MSSV:
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
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-cloud-upload"></i>
									Nhập danh sách sinh viên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url("admin/upload_student_list") ?>" method="POST" enctype="multipart/form-data" class='form-horizontal form-bordered'>
									<div class="form-group">
										<label for="survey_type" class="control-label col-sm-2">Loại khảo sát</label>
										<div class="col-sm-10">
											<select name="survey_type" id="survey_type" class='chosen-select form-control' data-placeholder="Chọn loại khảo sát" data-nosearch="true">
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
									<div class="form-group">
										<label class="control-label col-sm-2">Phiếu khảo sát</label>
										<div class="col-sm-10">
											<select name="survey" id="survey" class='chosen-select form-control' data-placeholder="Chọn phiếu khảo sát cần kết xuất dữ liệu" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="file" class="control-label col-sm-2">Danh sách sinh viên</label>
										<div class="col-sm-10">
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<span class="btn btn-default btn-file">
													<span class="fileinput-new">Chọn file</span>
													<span class="fileinput-exists">Thay đổi file</span>
													<input type="file" name="userfile">
												</span>
												<span class="fileinput-filename"></span>
												<a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
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
