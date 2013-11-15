		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Đánh giá thông tin</h1>
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
									Điều kiện lấy dữ liệu đánh giá thông tin
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<form action="#" method="POST" class="form-horizontal form-bordered">
									<!-- Loai khao sat -->
									<div class="control-group">
										<label class="control-label">Loại khảo sát</label>
										<div class="controls">
											<select name="survey_type" id="survey_type" class='chosen-select span8' data-placeholder="Chọn loại khảo sát" data-nosearch="true">
												<option value=""></option>
												<?php foreach ($survey_type as $item) {?>
												<option value="<?php echo $item['survey_type_id'] ?>"><?php echo $item['survey_type_name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<!-- Phieu khao sat -->
									<div class="control-group">
										<label class="control-label">Phiếu khảo sát</label>
										<div class="controls">
											<select name="survey" id="survey" class='chosen-select span12' data-placeholder="Chọn phiếu khảo sát cần kết xuất dữ liệu" data-nosearch="true">
											</select>
										</div>
									</div>
									<!-- Khoa -->
									<div class="control-group">
										<label class="control-label">Khoa</label>
										<div class="controls">
											<select name="faculty" id="faculty" class="chosen-select span6" data-placeholder="Chọn Khoa">
											
											</select>
										</div>
									</div>
									<!-- Lop -->
									<div class="control-group">
										<label class="control-label">Lớp</label>
										<div class="controls">
											<select name="class" id="class" class="chosen-select span6" data-placeholder="Chọn Lớp">
											</select>
										</div>
									</div>
									
									<!-- Ten cong ty dang lam viec -->
									<div class="control-group">
										<label class="control-label">[Tên công ty]</label>
										<div class="controls">
											<select name="q_company_name" id="q_company_name" class="chosen-select span8" data-placeholder="Chọn câu hỏi để trích xuất">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_company_name" id="a_company_name" class="chosen-select span8" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true">
											</select>
										</div>
									</div>
									
									<!-- Cong viec dang lam -->
									<div class="control-group">
										<label class="control-label">[ Công việc thực hiện ]</label>
										<div class="controls">
											<select name="q_doing_job" id="q_doing_job" class="chosen-select span12" data-placeholder="Chọn câu hỏi để trích xuất" data-nosearch="true">
											</select>
										</div>
									</div>
									<div class="control-group">
										<div class="controls">
											<select name="a_doing_job" id="a_doing_job" class="chosen-select span12" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true">
											</select>
										</div>
									</div>
									
									<!-- Action -->
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Lấy danh sách đánh giá</button>
									</div>
								</form> 
							</div>
						</div>
					</div>
				</div>
				
				<div class="row-fluid">
					<div class="span12">
						<!-- Danh sach danh gia -->
						<div class="box box-color box-bordered">
								<div class="box-title">
									<h3>
										<!-- Widget title -->
										Danh sách đánh giá thông tin
									</h3>
									<div class="actions">
										<a href="#" class="btn btn-mini content-slideUp">
											<i class="icon-angle-down"></i>
										</a>
									</div>
								</div>
								<div class="box-content nopadding">
									<!-- Widget Content --> 
									<table class="table table-hover table-nomargin">
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
										<tr>
											<td>Trident</td>
											<td>
												Internet
												Explorer 4.0
											</td>
											<td class='hidden-350'>Win 95+</td>
											<td class='hidden-1024'>4</td>
											<td class='hidden-480'>X</td>
											<td>
												<div class="slider" data-step="1" data-min="0" data-max="5" data-key="1" id="1">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td class="center">
												<a href="#modal-2" class="btn btn-info" data-toggle="modal" data-key="1"><i class="icon-edit"></i></a>
											</td>
										</tr>
										<tr>
											<td>Presto</td>
											<td>Nokia N800</td>
											<td class='hidden-350'>N800</td>
											<td class='hidden-1024'>-</td>
											<td class='hidden-480'>A</td>
											<td>
												<div class="slider" data-step="1" data-min="0" data-max="5">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td class="center">
												<a href="#" class="btn btn-info"><i class="icon-edit"></i></a>
											</td>
										</tr>
										<tr>
											<td>Misc</td>
											<td>NetFront 3.4</td>
											<td class='hidden-350'>Embedded devices</td>
											<td class='hidden-1024'>-</td>
											<td class='hidden-480'>A</td>
											<td>
												<div class="slider" data-step="1" data-min="0" data-max="5">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td class="center">
												<a href="#" class="btn btn-info"><i class="icon-edit"></i></a>
											</td>
										</tr>
										<tr>
											<td>Misc</td>
											<td>Dillo 0.8</td>
											<td class='hidden-350'>Embedded devices</td>
											<td class='hidden-1024'>-</td>
											<td class='hidden-480'>X</td>
											<td>
												<div class="slider" data-step="1" data-min="0" data-max="5">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td class="center">
												<a href="#" class="btn btn-info"><i class="icon-edit"></i></a>
											</td>
										</tr>
										<tr>
											<td>Misc</td>
											<td>Links</td>
											<td class='hidden-350'>Text only</td>
											<td class='hidden-1024'>-</td>
											<td class='hidden-480'>X</td>
											<td>
												<div class="slider" data-step="1" data-min="0" data-max="5">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td class="center">
												<a href="#" class="btn btn-info"><i class="icon-edit"></i></a>
											</td>
										</tr>
										<tr>
											<td>Misc</td>
											<td>Lynx</td>
											<td class='hidden-350'>Text only</td>
											<td class='hidden-1024'>-</td>
											<td class='hidden-480'>X</td>
											<td>
												<div class="slider" data-step="1" data-min="0" data-max="5">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td class="center">
												<a href="#" class="btn btn-info"><i class="icon-edit"></i></a>
											</td>
										</tr>
									</tbody>
								</table>
								</div>
							</div>
						</div>
						<!-- Ket thuc -->
					</div>
				</div>
			</div>
		</div>
		
		<!-- Modal -->
		<div id="modal-2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="myModalLabel">Modal header</h3>
			</div>
			<div class="modal-body">
				<input type="text" multiple="true" id="myNote"/>
			</div>
			<div class="modal-footer">
				<button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				<button class="btn btn-primary" data-dismiss="modal" id="modalSave">Save changes</button>
			</div>
		</div>
		<input type="hidden" id="tempValue" />
		<!-- javascript -->
		<script type="text/javascript">
			$(document).ready(function(){
				// Khi chon loai khao sat
				$("#survey_type").chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('survey_evaluation/gets_survey') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function(data){ // Thuc hien viec liet ke cau hoi khao sat tuong ung
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
				// Khi chon phieu khao sat
				$('#survey').chosen().change(function(){
					$.ajax({
						type: 'POST',
						url: "<?php echo base_url('survey_evaluation/gets_survey_faculty') ?>"+"/"+$('#survey').val(),
						dataType: 'json',
						success: function (data) { // Thuc hien viec liet ke Khoa tham gia khao sat
							if (data.survey_faculties.length > 0 )
							{
								$('#faculty option').remove();
								$('#faculty').trigger('chosen:updated');
								
								$("#faculty").append("<option value=''></option>");
								
								for (var i=0; i<data.survey_faculties.length; i++)
								{
									$('#faculty').append('<option value="'+data.survey_faculties[i].faculty_id+'">'+data.survey_faculties[i].faculty_name+'</option>');
								}
								$('#faculty').trigger("chosen:updated");
							}
						}
					});
					
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('survey_evaluation/gets_question_is_evaluated') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function (data){
							
							if (data.questions.length > 0)
							{
								$("#q_company_name option").remove();
								$("#q_company_name").trigger("chosen:updated");
								
								$("#q_company_name").append("<option value=''></option>");
								
								for (var i=0; i<data.questions.length; i++)
								{
									$("#q_company_name").append("<option value='"+data.questions[i].question_id+"'>"+data.questions[i].content+"</option>");
								}
								$("#q_company_name").trigger("chosen:updated");
							}
						}
					});
				});
				
				// Khi chon khoa
				$("#faculty").chosen().change(function (){
					$.ajax({
						type: "POST",
						url:"<?php echo base_url('survey_evaluation/gets_class_by_faculty') ?>"+"/"+$("#survey").val()+"/"+$(this).val(),
						dataType: "json",
						success: function (data){ // Thuc hien viec liet ke Lop tham gia khao sat
							if (data.classes.length > 0)
							{
								$("#class option").remove();
								$("#class").trigger("chosen:updated");
								
								$("#class").append("<option value=''></option>");
								
								for (var i=0; i<data.classes.length; i++)
								{
									$("#class").append("<option value='"+data.classes[i].class_id+"'>"+data.classes[i].class_id+"</option>");
								}
								$("#class").trigger("chosen:updated");
							}
						}
					});
				});
			
				// Phan xu ly trong danh sach danh gia
				$("#1").slider({
					value: 4,
				});
				$("#1 .amount").text(4);
				
				$(".slider").slider({
					stop: function (event, ui)
					{
						alert($(this).attr('data-key'));
					}
				});
				
				$("a[href='#modal-2']").click(function(){
					$("#temp_value").val($(this).attr('data-key'));
				});
				
				$("#modalSave").click(function(){
					alert($("#tempValue").val());
				});
				
				$("#modal-2").bind('show', function(){
					$(".modal-body #myNote").val("Hello world");
				});
			});
		</script>
		