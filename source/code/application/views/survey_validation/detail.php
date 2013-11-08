		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Kiểm tra độ tin cậy</h1>
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
							<a href="<?php echo base_url('survey_validation') ?>">Kiểm tra độ tin cậy</a>
						</li>
					</ul>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									Danh sách kiểm tra ngẫu nhiên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<table class="table table-bordered table-nomargin">
									<!-- Table content -->
									<thead>
										<tr>
											<th></th>
											<th>Mã SV</th>
											<th>Họ và tên đệm</th>
											<th>Tên</th>
											<th>Lớp</th>
											<th>Số đt Cty</th>
											<th><i class="icon-flag"></i></th>
											<th>Người xác thực</th>
											<th>Xác thực</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($student_list as $student_item) { ?>
										<tr>
											<td><a href="<?php echo base_url('do_survey/index/'.$student_item['faculty_id'].'/'.$student_item['survey_id'].'/'.$student_item['student_id'].'/'.$student_item['type_id']) ?>" class="btn btn-info"><i class="icon-eye-open"></i></a></td>
											<td><?php echo $student_item['student_id']; ?></td>
											<td><?php echo $student_item['first_name']; ?></td>
											<td><?php echo $student_item['last_name']; ?></td>
											<td><?php echo $student_item['class_id']; ?></td>
											<td><?php echo $student_item['company_phone']; ?></td>
											<td>
												<?php if ($student_item['value']=='TRUE') { ?>
												<i class="icon-ok"></i>
												<?php } elseif ($student_item['value']=='FALSE') { ?>
												<i class="icon-remove"></i>
												<?php } ?>
											</td>
											<td><?php echo $student_item['created_by_user_id']; ?></td>
											<td>
												<a href="<?php echo base_url('survey_validation/confirm/'.$student_item['list_id'].'/'.$student_item['validation_id'].'/TRUE'); ?>" class="btn btn-success"><i class="icon-ok"></i></a>
												<a href="<?php echo base_url('survey_validation/confirm/'.$student_item['list_id'].'/'.$student_item['validation_id'].'/FALSE'); ?>" class="btn"><i class="icon-remove"></i></a>
											</td>
										</tr>
										<tr>
											<td colspan="9">
												<table style="padding-left:50px" border="0">
													<tr>
														<td colspan="2">Xác thực bởi: <?php echo $student_item['created_by_user_id'] ?></td>
													</tr>
													<tr>
														<td>Tên công ty:</td>
														<td><?php echo $student_item['company_name'] ?></td>
													</tr>
													<tr>
														<td>Địa chỉ:</td>
														<td><?php echo $student_item['company_address'] ?></td>
													</tr>
													<tr>
														<td>Số điện thoại:</td>
														<td><?php echo $student_item['company_phone'] ?></td>
													</tr>
													<tr>
														<td>Công việc đang làm:</td>
														<td><?php echo $student_item['doing_job'] ?></td>
													</tr>
												</table>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
								<div style="padding-left: 50px;padding-top: 5px;padding-bottom: 5px;">Tổng sinh viên đang được xác thực 25%</div>
							</div>
						</div>
					</div>
				</div>
				
			</div>
		</div>
		<!-- javascript -->
		<script type="text/javascript">
			
		</script>