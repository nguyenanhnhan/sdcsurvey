		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Đánh giá việc làm của sinh viên</h1>
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
									Danh sách sinh viên dùng để đánh giá
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="fa fa-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<!-- Widget Content --> 
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="6" id="evalutionTable">
									<thead>
										<tr>
											<th style="vertical-align: middle">Họ và tên đệm</th>
											<th style="vertical-align: middle">Tên</th>
											<th style="vertical-align: middle">Điện thoại</th>
											<th style="vertical-align: middle">Tên Cty làm việc</th>
											<th style="vertical-align: middle">Công việc thực hiện</th>
											<th style="width:120px; vertical-align: middle">Mức độ phù hợp</th>
											<th style="width:60px; vertical-align: middle">Ghi chú</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($student_list as $student) { ?>
										<tr>
											<td style="vertical-align: middle"><?php echo $student['first_name'] ?></td>
											<td style="vertical-align: middle"><?php echo $student['last_name'] ?></td>
											<td style="vertical-align: middle"><?php echo $student['hand_phone'] ?></td>
											<td style="vertical-align: middle"><?php echo $student['company_name'] ?></td>
											<td style="vertical-align: middle"><?php echo $student['doing_job'] ?></td>
											<td style="vertical-align: middle">
												<div class="slider" data-step="1" data-min="0" data-max="5" data-key="<?php echo $student['evaluation_id'] ?>" id="<?php echo $student['evaluation_id'] ?>">
													<div class="amount"></div>
													<div class="slide"></div>
												</div>
											</td>
											<td style="vertical-align: middle">
												<a href="#modal-note" class="btn btn-info" data-toggle="modal" data-key="<?php echo $student['evaluation_id'] ?>"><i class="fa fa-edit"></i></a>
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

		<div id="modal-note" class="modal fade" role="dialog" style="display: none;" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h4 class="modal-title" id="myModalLabel">Ghi chú</h4>
					</div>
					<!-- /.modal-header -->
					<div class="modal-body">
						<textarea id="my_note" name="my_note" rows="3" style="width: 98%"></textarea>
					</div>
					<!-- /.modal-body -->
					<div class="modal-footer">
						<button class="btn" data-dismiss="modal" aria-hidden="true">Thoát</button>
						<button class="btn btn-primary" data-dismiss="modal" id="modal_save">Lưu ghi chú</button>
					</div>
					<!-- /.modal-footer -->
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<div id="modal-temp" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
						<h3 id="myModalLabel">Ghi chú</h3>
					</div>
					<div class="modal-body">
							
					</div>
					<div class="modal-footer">
						
					</div>
				</div>
			<div>
		</div>
		<input type="hidden" id="temp_value" />
		
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
			});
		</script>