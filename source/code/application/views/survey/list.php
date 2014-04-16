		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Phiếu khảo sát</h1>
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
							<a href="<?php echo base_url('survey_type') ?>">Loại khảo sát</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#"><?php echo $survey_type['survey_type_name']; ?></a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-list"></i>
									Danh sách Phiếu khảo sát
								</h3>
								<div class="actions">
									<a href="<?php echo base_url('survey/create_step_1/'.$survey_type['survey_type_id'])?>" rel="tooltip" title="Tạo phiếu khảo sát" class="btn btn-mini"><i class="fa fa-plus"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0,1">
									<thead>
										<tr>
											<th class="col-sm-2">Điều khiển</th>
											<th>Tên phiếu khảo sát</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($surveys as $survey_item){ ?>
										<?php if ($survey_item["status"]==FALSE) { ?>
										<tr>
											<td>
												<a href="<?php echo base_url('survey/delete/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
												<a href="<?php echo base_url('survey/edit_step_1/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn"><i class="fa fa-pencil-square-o"></i></a>
												<a href="<?php echo base_url('survey/create_summary/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
												<a href="<?php echo base_url('survey/sort_question/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn"><i class="glyphicon-sort"></i></a>
											</td>
											<td><?php echo $survey_item['survey_name']; ?></td>
										</tr>
										<?php } else { ?>
										<tr>
											<td>
												<a href="#" class="btn btn-success" rel="tooltip" data-original-title="Phiếu đang được khảo sát"><i class="icon-tasks"></i></a>
												<a href="<?php echo base_url('survey/create_summary/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn btn-info"><i class="icon-eye-open"></i></a>
												<a href="<?php echo base_url('survey/sort_question/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn"><i class="glyphicon-sort"></i></a>
											</td>
											<td><?php echo $survey_item['survey_name']; ?></td>
										</tr>
										<?php } // end if else ?>
										<?php } // end foreach?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
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
		</script>
