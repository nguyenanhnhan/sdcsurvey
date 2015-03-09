		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Danh sách sinh viên tham gia khảo sát</h1>
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
							<a href="<?php echo base_url('survey_result/index/')?>">Kết quả khảo sát</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Danh sách sinh viên tham gia</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-plus"></i>
									Danh sách sinh viên tham gia khảo sát
								</h3>
								<div class="actions">
									<a href="<?php echo base_url('survey_result/index/')?>" class="btn btn--icon" rel="tooltip" title="Quay lại trang lọc DSSV"><i class="fa fa-arrow-circle-left"></i>Quay lại</a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table id="student_list" class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0,1,5">
									<thead>
										<tr>
											<th></th>
											<th>MSSV</th>
											<th>Họ</th>
											<th>Tên</th>
											<th>Lớp</th>
											<th style="text-align:center">Trạng <br> thái</th>
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
											<td><a target="_self" href="<?php echo base_url('do_survey/index/'.$faculty['faculty_id'].'/'.$survey['survey_id'].'/'.$student_no_survey_item['student_id']).'/'.$type_id ?>" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
											<td style="vertical-align:middle"><?php echo strtoupper($student_no_survey_item['student_id']) ?></td>
											<td style="vertical-align:middle" nowrap><?php echo mb_strtoupper($student_no_survey_item['first_name'], "UTF8") ?></td>
											<td style="vertical-align:middle"><?php echo mb_strtoupper($student_no_survey_item['last_name'], "UTF8") ?></td>
											<td style="vertical-align:middle"><?php echo $student_no_survey_item['class_id']?></td>
											<td style="text-align:center; vertical-align:middle"><i class="fa fa-circle-o" style="font-size:20px"></i></td>
											<td style="vertical-align:middle"></td>
											<td style="vertical-align:middle"></td>
											<td style="vertical-align:middle"></td>
											<td style="vertical-align:middle"></td>
											<td style="vertical-align:middle"></td>
										</tr>
									  	<?php } } ?>
									  	<?php
									  	if ($students_surveyed!=NULL){	
									  		foreach ($students_surveyed as $student_surveyed_item){ ?>
									  	<tr valign="middle">
											<td style="vertical-align:middle"><a target="_self" href="<?php echo base_url('do_survey/index/'.$faculty['faculty_id'].'/'.$survey['survey_id'].'/'.$student_surveyed_item['student_id']).'/'.$type_id ?>" class="btn btn-success"><i class="fa fa-eye"></i></a></td>
											<td style="vertical-align:middle"><?php echo strtoupper($student_surveyed_item['student_id']) ?></td>
											<td style="vertical-align:middle" nowrap><?php echo mb_strtoupper($student_surveyed_item['first_name']) ?></td>
											<td style="vertical-align:middle"><?php echo mb_strtoupper($student_surveyed_item['last_name']) ?></td>
											<td style="vertical-align:middle"><?php echo $student_surveyed_item['class_id']?></td>
											<td style="text-align:center; vertical-align:middle"><i class="fa fa-check-circle-o" style="font-size:20px" ></i></td>
											<td style="vertical-align:middle"></td>
											<td style="vertical-align:middle">
												<?php 
												if (!empty($student_surveyed_item['interviewer_id'])==NULL) 
													echo $student_surveyed_item['created_by_user_id']; 
												else 
													echo $student_surveyed_item['interviewer_id']; 
												?>
											</td>
											<td style="vertical-align:middle">
												<?php 
												if (!empty($student_surveyed_item['interview_on_date'])==NULL) 
													echo mdate('%d/%m/%Y',strtotime($student_surveyed_item['created_on_date'])); 
												else 
													echo mdate('%d/%m/%Y',strtotime($student_surveyed_item['interview_on_date']));
												?>
											</td>
											<td style="vertical-align:middle"><?php echo $student_surveyed_item['last_modified_by_user_id']; ?></td>
											<td style="vertical-align:middle">
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
				<!-- <div class="row">
					<div class="col-sm-12">
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
				</div> -->
			</div>
		</div>
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
		</script>
