		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin gửi mail</h1>
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
							<a href="<?php echo base_url('inform') ?>">Thông báo</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Kết quả sau khi gửi</a>
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
									Các sinh viên vừa được gửi e-mail thông báo
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table dataTable">
									<thead>
										<tr>
											<th>#</th>
											<th>Mã SV</th>
											<th>Lớp</th>
											<th>Họ và tên</th>
											<th>Số ĐT bàn</th>
											<th>Số ĐTDĐ </th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											$count_num = 0;
											if (!empty($student_sended)){
											foreach ($student_sended as $student) { $count_num++;
										?>
										<tr>
											<td><?php echo $count_num ?></td>
											<td><?php echo $student['student_id'] ?></td>
											<td><?php echo $student['class_id'] ?></td>
											<td><?php echo trim($student['first_name']).' '.trim($student['last_name']) ?></td>
											<td><?php echo $student['phone'] ?></td>
											<td><?php echo $student['hand_phone'] ?></td>
											<td><?php echo $student['email'] ?></td>
										</tr>
										<?php }} ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid" style="height:100px">
				
				</div>
			</div>
		</div>
		<!--- Javascript -->
		<script type="text/javascript">
		tinyMCE.init({
			// General options
			selector:"textarea"
		});
		
		$(document).ready(function(){
			
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
					url: "<?php echo base_url('inform/get_survey_of_faculty') ?>"+"/"+$("#faculty option:selected").val(),
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
