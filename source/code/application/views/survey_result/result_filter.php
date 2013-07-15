		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Danh sách sinh viên tham gia khảo sát</h1>
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
							<a href="<?php echo base_url('survey_result/index/')?>">Kết quả khảo sát</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Danh sách sinh viên tham gia</a>
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
									<i class="icon-plus"></i>
									Danh sách sinh viên tham gia khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table id="student_list" class="table table-hover table-nomargin dataTable">
									<thead>
										<tr>
											<th></th>
											<th>MSSV</th>
											<th>Họ</th>
											<th>Tên</th>
											<th>Lớp</th>
											<th>Trạng thái</th>
											<th>HT Khảo sát</th>
											<th>Thực hiện</th>
											<th>Vào lúc</th>
											<th>Điều chỉnh</th>
											<th>Vào lúc</th>
										</tr>
									</thead>
									<tbody>
										
									  	<?php
									  		if ($students_no_survey!=NULL){
										  		foreach ($students_no_survey as $student_no_survey_item){ ?>
									  	<tr>
											<td><a target="_blank" href=" <?php echo base_url('do_survey/index/'.$faculty['faculty_id'].'/'.$survey['survey_id'].'/'.$student_no_survey_item['student_id']) ?>" class="btn btn-success"><i class="icon-eye-open"></i></a></td>
											<td><?php echo $student_no_survey_item['student_id'] ?></td>
											<td><?php echo $student_no_survey_item['first_name'] ?></td>
											<td><?php echo $student_no_survey_item['last_name'] ?></td>
											<td><?php echo $student_no_survey_item['class_id']?></td>
											<td>Chưa khảo sát</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									  	<?php } } ?>
									  	<?php
									  	if ($students_surveyed!=NULL){	
									  		foreach ($students_surveyed as $student_surveyed_item){ ?>
									  	<tr>
											<td><a target="_blank" href="<?php echo base_url('do_survey/index/'.$faculty['faculty_id'].'/'.$survey['survey_id'].'/'.$student_surveyed_item['student_id']) ?>" class="btn btn-success"><i class="icon-eye-open"></i></a></td>
											<td><?php echo $student_surveyed_item['student_id'] ?></td>
											<td><?php echo $student_surveyed_item['first_name'] ?></td>
											<td><?php echo $student_surveyed_item['last_name'] ?></td>
											<td><?php echo $student_surveyed_item['class_id']?></td>
											<td>Đã khảo sát</td>
											<td></td>
											<td>
												<?php 
												if (!empty($student_surveyed_item['interviewer_id'])==NULL) 
													echo $student_surveyed_item['created_by_user_id']; 
												else 
													echo $student_surveyed_item['interviewer_id']; 
												?>
											</td>
											<td>
												<?php 
												if (!empty($student_surveyed_item['interview_on_date'])==NULL) 
													echo mdate('%d/%m/%Y',strtotime($student_surveyed_item['created_on_date'])); 
												else 
													echo mdate('%d/%m/%Y',strtotime($student_surveyed_item['interview_on_date']));
												?>
											</td>
											<td><?php echo $student_surveyed_item['last_modified_by_user_id']; ?></td>
											<td>
												<?php 
													if (!empty($student_surveyed_item['last_modified_on_date']))
														echo mdate('%d/%m/%Y',strtotime($student_surveyed_item['last_modified_on_date']));
												?>
											</td>
										</tr>
									  	<?php }} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-content nopadding">
								<div class="pull-right">
									<div class="btn-toolbar">
										<div class="btn-group">
											<a href="<?php echo base_url('survey_result/index/')?>" class="btn btn-primary" rel="tooltip" title="Quay lại trang lọc DSSV">
												Quay lại
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		$(document).ready(function(){
			
		});
		</script>
