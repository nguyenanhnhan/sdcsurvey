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
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-bordered table-striped table-force-topborder" style="clear: both">
									<tbody>
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
											<td><?php if ($survey['is_graduated'] == 1) echo 'Năm tốt nghiệp'; else 'Đang học khoá'; ?></td>
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
												<input type="checkbox" data-skin="square" data-color="blue" class="icheck-me" <?php if ($survey['status']==1) echo 'checked'; ?>>
											</td>
										</tr>
										<tr>
											<td></td>
											<td>
												<a href="<?php echo base_url('survey/edit_step_1/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']) ?>" class="btn btn-primary">Chỉnh sửa</a>
												<?php if($survey['status']==0) {?>
												<a href="<?php echo base_url('survey/delete/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']) ?>" class="btn btn-danger">Xoá</a>
												<?php } ?>
											</td>
										</tr>
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
		
