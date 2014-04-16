		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Loại khảo sát</h1>
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
							<a href="#">Quản trị Biểu mẫu khảo sát</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-list"></i>
									Danh sách Loại khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0" id="data">
									<thead>
										<tr>
											<th class = "col-sm-2">Điều khiển</th>
											<th>Tên loại khảo sát</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($survey_type as $stype_item): ?>
										<tr>
											<td>
												<a href="<?php echo base_url('survey_type/delete/'.$stype_item['survey_type_id']); ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
												<a href="<?php echo base_url('survey_type/edit/'.$stype_item['survey_type_id']); ?>" class="btn"><i class="fa fa-pencil-square-o"></i></a>
												<a href="<?php echo base_url('survey/index/'.$stype_item['survey_type_id']); ?>" class="btn btn-success"><i class="fa fa-eye"></i></a>
											</td>
											<td><?php echo $stype_item['survey_type_name']; ?></td>
										</tr>
										<?php endforeach?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-plus"></i>
									Thêm Loại khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey_type/add') ?>" method="post" class="form-horizontal form-bordered">
									<div class="form-group">
										<label for="survey_type" class="control-label col-sm-2">Tên loại khảo sát</label>
										<div class="col-sm-10">
											<input type="text" name="survey_type" id="survey_type" class="form-control">
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit">Thêm</button>
										<button class="btn" type="reset">Huỷ</button>
									</div>
								</form>	
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
