		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Tóm lược biểu mẫu khảo sát</h1>
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
							<a href="<?php echo base_url('survey/index/'.$survey_type['survey_type_id']) ?>"><?php echo $survey['survey_name']; ?>
							</a>
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
									Thông tin chung của phiếu khảo sát
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-bordered table-striped table-force-topborder" style="clear: both">
									<tbody>
										<tr>
											<td width="15%">Mã phiếu</td>
											<td width="50%">
												<?php echo $survey["survey_id"]; ?>
											</td>
										</tr>
										<tr>
											<td width="15%">Tên phiếu khảo sát</td>
											<td width="50%">
												<a href="<?php echo base_url('survey/preview/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']) ?>" target="_blank"><?php echo $survey['survey_name']?></a>
											</td>
										</tr>
										<tr>
											<td>Thuộc loại</td>
											<td><?php echo $survey_type['survey_type_name'] ?></td>
										</tr>
										<tr>
											<td>Áp dụng cho bậc</td>
											<td><?php if ($survey['is_vocation']==0) echo 'Đại học'; else echo 'Trung cấp chuyên nghiệp'; ?></td>
										</tr>
										<tr>
											<td>Dành cho các khoa</td>
											<td>
												<?php foreach ($faculties as $faculty): 
													foreach($survey_faculties as $survey_faculty_item)
													{
														if ($faculty['faculty_id']==$survey_faculty_item['faculty_id'])
														{
															echo "<span class='uneditable-input' style='background:rgb(92, 147, 206); color: rgb(253, 252, 252);'>".$faculty['faculty_name']."</span>";
														}	
													}
												?>
												<?php endforeach ?>
											</td>
										</tr>
										<tr>
											<td>
												<?php if ($survey['is_graduated'] == 1) echo 'Năm tốt nghiệp'; else echo 'Đang học khoá'; ?>
											</td>
											<td>
												<?php if ($survey['is_graduated'] == 1) echo $survey['graduated_year']; else echo $survey['course']; ?>
											</td>
										</tr>
										<tr>
											<td>Thời gian áp dụng</td>
											<td>
												<?php 
													echo 'Từ <strong style="text-decoration:underline;">'.mdate('%d/%m/%Y',strtotime($survey['start_date'])).'</strong> đến <strong style="text-decoration:underline">'.mdate('%d/%m/%Y',strtotime($survey['end_date'])).'</strong>'; 
												?>
											</td>
										</tr>
										<tr>
											<td>Đang khảo sát</td>
											<td>
												<input id="doing_survey" name="doing_survey" type="checkbox" data-skin="square" data-color="blue" class="icheck-me" <?php if ($survey['status']==1) echo 'checked'; ?>>
											</td>
										</tr>
										<!-- khong dung -->
										<?php if($survey['status']==FALSE) {?>
										<tr>
											<td></td>
											<td>
												
												<a id="edit_btn" href="<?php echo base_url('survey/edit_step_1/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']) ?>" class="btn btn-primary">Chỉnh sửa</a>
												
												<a id="remove_btn" href="<?php echo base_url('survey/delete/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']) ?>" class="btn btn-danger">Xoá</a>
											</td>
										</tr>
										<!-- dang dung -->
										<?php } elseif($survey['status']==TRUE) {?>
										<tr>
											<td></td>
											<td>
												
												<a id="edit_btn" href="#modal-warning" class="btn btn-primary" data-toggle="modal">Chỉnh sửa</a>
												
												<a id="remove_btn" href="#modal-warning" class="btn btn-danger" data-toggle="modal">Xoá</a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<!-- Fix loi footer tran len tren khi thu nho -->
				<div class="row-fluid" style="height: 50px">

				</div>
			</div>
		</div>
		
		<!-- Modal -->
		<div id="modal-warning" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Thông báo</h3>
			</div>
			<div class="modal-body">
				<p>
					Phiếu khảo sát này đang được sử dụng. Việc sửa nội dung hoặc xoá bị ngăn chặn. Mọi chi tiết liên hệ người quản trị.
				</p>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Thoát</button>
			</div>
		</div>
		
		<script type="text/javascript">
			$(document).ready(function(){
				$("#doing_survey").change(function (){
					if ($("#doing_survey").is(":checked"))
					{
						$.ajax({
							type: "POST",
							url: "<?php echo base_url("survey/update_status"); ?>",
							data:"survey_id=<?php echo $survey['survey_id'] ?>&status=1",
							dataType: "json",
							success: function(data){
								if (data.status == true)
								{
									$("#edit_btn").prop( "href", "#modal-warning" );
									$("#edit_btn").attr( "data-toggle", "modal");
									
									$("#remove_btn").prop( "href", "#modal-warning" );
									$("#remove_btn").attr( "data-toggle", "modal");
								}
							}
						});
					}
					else
					{
						$.ajax({
							type: "POST",
							url: "<?php echo base_url("survey/update_status"); ?>",
							data:"survey_id=<?php echo $survey['survey_id'] ?>&status=0",
							dataType: "json",
							success: function(data){
								if (data.status == true)
								{
									$("#edit_btn").prop( "href", "<?php echo base_url('survey/edit_step_1/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']) ?>" );
									$("#edit_btn").removeAttr ("data-toggle");
									
									$("#remove_btn").prop( "href", "<?php echo base_url('survey/delete/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']) ?>");
									$("#remove_btn").removeAttr ("data-toggle");
								}
							}
						});
					}
				});
			});
		</script>
		
