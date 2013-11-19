		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Đánh giá việc làm của sinh viên</h1>
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
							<a href="<?php echo base_url('survey_evaluation') ?>">Đánh giá thông tin</a>
						</li>
					</ul>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									Danh sách sinh viên dùng để đánh giá
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content --> 
								<table class="table table-hover table-nomargin dataTable dataTable-nofooter dataTable-nosort" data-nosort="6" id="evalutionTable">
									<thead>
										<tr>
											<th>Họ và tên đệm</th>
											<th>Tên</th>
											<th>Điện thoại</th>
											<th>Tên Cty làm việc</th>
											<th>Công việc thực hiện</th>
											<th style="width:120px">Mức độ phù hợp</th>
											<th style="width:60px;">Ghi chú</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($student_list as $student) { ?>
										<tr>
											<td><?php echo $student['first_name'] ?></td>
											<td><?php echo $student['last_name'] ?></td>
											<td><?php echo $student['hand_phone'] ?></td>
											<td><?php echo $student['company_name'] ?></td>
											<td><?php echo $student['doing_job'] ?></td>
											<td>
												<div class="slider" data-step="1" data-min="0" data-max="5" data-key="<?php echo $student['evaluation_id'] ?>" id="<?php echo $student['evaluation_id'] ?>">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td>
												<a href="#modal-note" class="btn btn-info" data-toggle="modal" data-key="<?php echo $student['evaluation_id'] ?>"><i class="icon-edit"></i></a>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Modal -->
		<div id="modal-note" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Ghi chú</h3>
			</div>
			<div class="modal-body">
				<textarea id="my_note" name="my_note" rows="3" style="width: 98%"></textarea>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Thoát</button>
				<button class="btn btn-primary" data-dismiss="modal" id="modal_save">Lưu ghi chú</button>
			</div>
		</div>
		<input type="hidden" id="temp_value" />
		
		<!-- javascript -->
		<script type="text/javascript">
			// Phan xu ly trong danh sach danh gia
			<?php foreach ($student_list as $student) {?>
			$("#<?php echo $student['evaluation_id'] ?>").slider({
				value: <?php echo $student['rate_score'] ?>
			});
			
			$("#<?php echo $student['evaluation_id'] ?> .amount").text(<?php echo $student['rate_score'] ?>);
			<?php }?>
			
			$(".slider").slider({
				stop: function (event, ui)
				{
					$.ajax ({
						type: 'POST',
						url: "<?php echo base_url('survey_evaluation/update_rate_score') ?>"+"/"+$(this).attr("data-key")+"/"+ui.value,
						dataType: 'json',
						success: function (data) { 
						}
					});
/* 					alert($(this).attr('data-key')); */
/* 					alert(ui.value); */
				}
			});
			
			$("a[href='#modal-note']").click(function(){
				$("#temp_value").val($(this).attr("data-key"));
			});
			
			$("#modal-note").bind('show', function(){
				$.ajax({
					type: "GET",
					url: "<?php echo base_url('survey_evaluation/get_note') ?>"+"/"+$("#temp_value").val(),
					dataType: "json",
					success: function (data) {
						$(".modal-body #my_note").val(data.note.note);
					}
				});
			});
			
			$("#modal_save").click(function(){
				$.ajax({
					type: "POST",
					url: "<?php echo base_url('survey_evaluation/update_note')?>",/* +"/"+$("#temp_value").val()+"/"+$(".modal-body #my_note").val(), */
					data: "evaluation_id="+$("#temp_value").val()+"&note="+$(".modal-body #my_note").val(),
					dataType: "json",
					success: function (data) {
					}
				});
			});
		</script>