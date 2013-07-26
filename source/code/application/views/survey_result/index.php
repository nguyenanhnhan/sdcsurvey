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
							<a href="#">Kết quả khảo sát</a>
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
									Lọc Danh sách Sinh viên theo Phiếu khảo sát
								</h3>
							</div>
							<div class="box-content">
								<form id="my_form" action="<?php echo base_url('survey_result/filter')?>" method="post" class="form-vertical">
									<div class="row-fluid">
										<div class="span3">
											<div class="control-group">
												<label class="control-label">Khoa/Ban</label>
												<div class="controls controls-row">
													<select name='faculty' id='faculty' class="input-block-level">
														<?php foreach ($faculties as $faculty_item):?>
														<option value="<?php echo trim($faculty_item['faculty_id']) ?>"><?php echo $faculty_item['faculty_name'] ?></option>
														<?php endforeach ?>
													</select>
												</div>
											</div>
										</div>
										<div class="span9">
											<div class="control-group">
												<label for="textfield" class="control-label">Phiếu khảo sát</label>
												<div class="controls controls-row">
													<select name="survey" id="survey" class="input-block-level">
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span4">
											<div class="control-group">
												<label class="control-label">Lọc theo kết quả</label>
												<div class="controls controls-row">
													<select id="filter" name="filter" class="input-block-level">
														<option value="0">Tất cả</option>
														<option value="1">Đã khảo sát</option>
														<option value="0334bd35-9ae4-4922-948b-65354ad2fe1e">--- Khảo sát qua điện thoại</option>
														<option value="4db02701-ce28-43c0-8741-29e5ca83245f">--- Khảo sát qua email</option>
														<option value="e1764151-3eea-4c20-9902-b326a2fb014e">--- Khảo sát qua thư bưu điện</option>
														<option value="454c9866-22d2-486b-a79d-ff8c0a293746">--- Khảo sát trực tiếp</option>
														<option value="8325d43b-355c-4b74-8ed5-bc9c631f6ed4">--- Khảo sát qua fax</option>
														<option value="2">Chưa khảo sát</option>
													</select>
												</div>
											</div>
										</div>
										<div class="span3">
											<div class="control-group">
												<label class="control-label">&nbsp;</label>
												<div class="controls controls-row">
													<button class="btn btn-primary">Tìm kiếm</button>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function (){
			
				// Khoi tao data
				$.ajax({
					url: "<?php echo base_url('survey_result/get_survey_of_faculty') ?>"+"/"+$("#faculty option:selected").val(),
					type: 'POST',
					dataType: 'json',
					success: function(data){
						// remove het option trong select faculty
						$("#survey option").each(function(){
							$(this).remove();
						});
						
						for (var i=0, len=data.surveys_faculty.length; i<len; i++)
						{
							$("#survey").append("<option value='"+data.surveys_faculty[i].survey_id+"'>"+data.surveys_faculty[i].survey_name+"</option>");
						}
					}
				});
				
				// Bat su kien khi chon khoa
				$("#faculty").change(function(){
					$.ajax({
						url: "<?php echo base_url('survey_result/get_survey_of_faculty') ?>"+"/"+$("#faculty option:selected").val(),
						type: 'POST',
						dataType: 'json',
						success: function(data){
							// remove het option trong select faculty
							$("#survey option").each(function(){
								$(this).remove();
							});
							
							for (var i=0, len=data.surveys_faculty.length; i<len; i++)
							{
								$("#survey").append("<option value='"+data.surveys_faculty[i].survey_id+"'>"+data.surveys_faculty[i].survey_name+"</option>");
							}
						}
					});
				});
			});
		</script>
