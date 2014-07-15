		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Nhóm tài khoản</h1>
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
							<a href="<?php echo base_url('admin/groups') ?>">Nhóm tài khoản</a>
						</li>
					</ul>
				</div>
				<div class="row-">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-group"></i>
									Nhóm tài khoản
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 130px">Điều khiển</th>
											<th>Tên nhóm</th>
											<th>Mô tả</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($groups as $group) { ?>
										<tr>
											<td>
												<a href="<?php echo base_url('admin/delete_group/'.$group['id']) ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
												<a href="<?php echo base_url('admin/group_permission/'.$group['id']) ?>" class="btn"><i class="fa fa-cogs"></i></a>
												<a href="<?php echo base_url('admin/group_user/'.$group['id']) ?>" class="btn"><i class="fa fa-group"></i></a>
											</td>
											<td><?php echo $group['name']?></td>
											<td><?php echo $group['description'] ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-content nopadding">
								<div class="pull-right">
									<div class="btn-toolbar">
										<div class="btn-group">
											<a href="<?php echo base_url('admin/add_group')?>" class="btn btn-primary" rel="tooltip" title="Tạo nhóm tài khoản">
												<i class="icon-plus"></i> Tạo nhóm
											</a>
										</div>
									</div>
								</div>
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
