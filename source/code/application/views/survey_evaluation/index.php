		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Đánh giá thông tin</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big" id="date">February 22, 2013</span>
									<span id="clock">Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url('admin') ?>">Root</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('survey_evaluation') ?>">Đánh giá thông tin</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									Điều kiện lấy dữ liệu đánh giá thông tin
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<form action="<?php echo base_url('survey_evaluation/get_list') ?>" method="POST" class="form-horizontal form-bordered" id="my_form">
									<!-- Loai khao sat -->
									<div class="form-group">
										<label class="control-label col-sm-2">Loại khảo sát</label>
										<div class="col-sm-10">
											<select name="survey_type" id="survey_type" class='chosen-select form-control' data-placeholder="Chọn loại khảo sát" data-nosearch="true" required>
												<option value=""></option>
												<?php foreach ($survey_type as $item) {?>
												<option value="<?php echo $item['survey_type_id'] ?>"><?php echo $item['survey_type_name'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<!-- Phieu khao sat -->
									<div class="form-group">
										<label class="control-label col-sm-2">Phiếu khảo sát</label>
										<div class="col-sm-10">
											<select name="survey" id="survey" class='chosen-select form-control' data-placeholder="Chọn phiếu khảo sát cần kết xuất dữ liệu" data-nosearch="true" required>
											</select>
										</div>
									</div>
									<!-- Khoa -->
									<div class="form-group">
										<label class="control-label col-sm-2">Khoa</label>
										<div class="col-sm-10">
											<select name="faculty" id="faculty" class="chosen-select col-sm-8" data-placeholder="Chọn Khoa" required>
											</select>
										</div>
									</div>
									<!-- Lop -->
									<div class="form-group">
										<label class="control-label col-sm-2">Lớp</label>
										<div class="col-sm-10">
											<select name="class" id="class" class="chosen-select col-sm-4" data-placeholder="Chọn Lớp" required>
											</select>
										</div>
									</div>
									
									<!-- Ten cong ty dang lam viec -->
									<div class="form-group">
										<label class="control-label col-sm-2">[Tên công ty]</label>
										<div class="col-sm-10">
											<select name="q_company_name" id="q_company_name" class="chosen-select col-sm-8" data-placeholder="Chọn câu hỏi để trích xuất" data-nosearch="true" required>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2"></label>
										<div class="col-sm-10">
											<select name="a_company_name" id="a_company_name" class="chosen-select col-sm-8" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true" required>
											</select>
										</div>
									</div>
									
									<!-- Cong viec dang lam -->
									<div class="form-group">
										<label class="control-label col-sm-2">[ Công việc thực hiện ]</label>
										<div class="col-sm-10">
											<select name="q_doing_job" id="q_doing_job" class="chosen-select form-control" data-placeholder="Chọn câu hỏi để trích xuất" data-nosearch="true" required>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2"></label>
										<div class="col-sm-10">
											<select name="a_doing_job" id="a_doing_job" class="chosen-select form-control" data-placeholder="Chọn câu trả lời để trích xuất" data-nosearch="true" required>
											</select>
										</div>
									</div>
									
									<!-- Ten danh sach danh gia -->
									<div class="form-group">
										<label class="control-label col-sm-2">Tên danh sách</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" id="list_name" name="list_name" required />
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
				
				<div class="row">
					<div class="col-sm-12">
						<!-- Danh sach -->
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<!-- Widget title -->
									Danh sách đánh giá thông tin
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content -->
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0" id="evaluation_list" >
									<thead>
										<tr>
											<th style="width:100px"></th>
											<th>Tên</th>
											<th style="width:100px">Ngày lập</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($survey_evaluation_list as $list_item) {?>
										<tr>
											<td style="vertical-align:middle">
												<a href="<?php echo base_url('survey_evaluation/delete/'.$list_item['list_id']); ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
												<a href="<?php echo base_url('survey_evaluation/view/'.$list_item['list_id']); ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
											</td>
											<td style="vertical-align:middle"><?php echo $list_item['list_name'] ?></td>
											<td style="vertical-align:middle"><?php echo mdate('%d/%m/%Y %H:%i:%s',strtotime($list_item['created_on_date'])); ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
						<!-- Ket thuc -->
					</div>
				</div>
			</div>
		</div>
		<!-- javascript -->
		<script type="text/javascript">
			$(document).ready(function(){
				if ($('.dataTable').length > 0) {
			        $('.dataTable').each(function() {
			            if ($(this).hasClass("dataTable-custom")) {
			                var opt = {
			                    "sPaginationType": "full_numbers",
			                    "oLanguage": {
			                        "sSearch": "<span>Tìm kiếm:</span> ",
			                        "sInfo": "Đang xem <span>_START_</span> đến <span>_END_</span> trong tổng số <span>_TOTAL_</span> nội dung",
			                        "sLengthMenu": "<span>Hiển thị </span>_MENU_ <span>nội dung trong một trang</span>",
			                        "oPaginate": {
								        "sFirst":      "Đầu",
								        "sLast":       "Cuối",
								        "sNext":       "Sau",
								        "sPrevious":   "Trước"
								    },
			                    },
			                    'sDom': "lfrtip"
			                };
			                if ($(this).hasClass("dataTable-noheader")) {
			                    opt.bFilter = false;
			                    opt.bLengthChange = false;
			                }
			                if ($(this).hasClass("dataTable-nofooter")) {
			                    opt.bInfo = false;
			                    opt.bPaginate = false;
			                }
			                if ($(this).hasClass("dataTable-nosort")) {
			                    var column = $(this).attr('data-nosort');
			                    column = column.split(',');
			                    for (var i = 0; i < column.length; i++) {
			                        column[i] = parseInt(column[i]);
			                    };
			                    opt.aoColumnDefs = [{
			                        'bSortable': false,
			                        'aTargets': column
			                    }];
			                }

			                var oTable = $(this).dataTable(opt);
			                $(this).css("width", '100%');
			                $('.dataTables_filter input').attr("placeholder", "nội dung...").addClass("form-control input-medium");
			                $(".dataTables_length select").wrap("<div class='input-mini'></div>").chosen({
			                    disable_search_threshold: 9999999
			                });
			            }
			        });
			    }
			});
			$(document).ready(function(){
				$("#my_form").validate();
				
				// Khi chon loai khao sat
				$("#survey_type").chosen().change(function(){
					$.ajax({
						type: "GET",
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
						type: 'GET',
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
						type: "GET",
						url: "<?php echo base_url('survey_evaluation/gets_question_is_evaluated') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function (data){
							
							if (data.questions.length > 0)
							{
								$("#q_company_name option").remove();
								$("#q_doing_job option").remove();
								
								$("#q_company_name").trigger("chosen:updated");
								$("#q_doing_job").trigger("chosen:updated");
								
								$("#q_company_name").append("<option value=''></option>");
								$("#q_doing_job").append("<option value=''></option>");
								
								for (var i=0; i<data.questions.length; i++)
								{
									$("#q_company_name").append("<option value='"+data.questions[i].question_id+"'>"+data.questions[i].content+"</option>");
									$("#q_doing_job").append("<option value='"+data.questions[i].question_id+"'>"+data.questions[i].content+"</option>");
								}
								$("#q_company_name").trigger("chosen:updated");
								$("#q_doing_job").trigger("chosen:updated");
							}
						}
					});
				});
				
				// Khi chon cau hoi xac dinh ten cong ty
				$("#q_company_name").chosen().change(function (){
					$.ajax({
						type: "GET",
						url: "<?php echo base_url('survey_evaluation/gets_answer_template') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function (data){
							if (data.answer_template.length > 0)
							{
								$("#a_company_name option").remove();
								$("#a_company_name").trigger("chosen:updated");
								
								$("#a_company_name").append("<option value=''></option>");
								
								for (var i=0; i<data.answer_template.length; i++)
								{
									$("#a_company_name").append("<option value='"+data.answer_template[i].answer_template_id+"'>"+data.answer_template[i].label+"</option>");
								}
								
								$("#a_company_name").trigger("chosen:updated");
							}
						}
					});
				});
				
				// Khi chon cau hoi xac dinh cong viec dang lam
				$("#q_doing_job").chosen().change(function (){
					$.ajax({
						type: "GET",
						url: "<?php echo base_url('survey_evaluation/gets_answer_template') ?>"+"/"+$(this).val(),
						dataType: "json",
						success: function (data){
							if (data.answer_template.length > 0)
							{
								$("#a_doing_job option").remove();
								$("#a_doing_job").trigger("chosen:updated");
								
								$("#a_doing_job").append("<option value=''></option>");
								
								for (var i=0; i<data.answer_template.length; i++)
								{
									if (data.answer_template[i].label){
										$("#a_doing_job").append("<option value='"+data.answer_template[i].answer_template_id+"'>"+data.answer_template[i].label+"</option>");
									}
									else
									{
										$("#a_doing_job").append("<option value='"+data.answer_template[i].answer_template_id+"'>Câu trả lời không có nhãn</option>");
									}
								}
								
								$("#a_doing_job").trigger("chosen:updated");
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
			});
		</script>
		<style>
			#my_form input.error {border: 1px dotted red;}
			#my_form label.error {margin-left: 10px !important; width: auto !important; display: none !important;}
			#my_form textarea.error {border: 1px dotted red;}
			#my_form select.error {border: 1px dotted red;}
		</style>
		