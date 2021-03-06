		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Tài khoản người dùng</h1>
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
							<a href="<?php echo base_url('admin/users') ?>">Quản trị tài khoản người dùng</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-group"></i>
									Tài khoản người dùng
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 90px">Điều khiển</th>
											<th>Tài khoản</th>
											<th>Họ và tên</th>
											<th>Email</th>
											<th>Ngày tham gia</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($users as $user) { ?>
										<tr>
											<td>
												<a href="<?php echo base_url('admin/delete_user/'.$user['id'])?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
												<a href="<?php echo base_url('admin/edit_user/'.$user['id']) ?>" class="btn btn-success"><i class="fa fa-edit"></i></a>
											</td>
											<td><?php echo $user['username'] ?></td>
											<td><?php echo trim($user['first_name'].' '.trim($user['last_name'])) ?></td>
											<td><?php echo $user['email'] ?></td>
											<td><?php echo mdate('%d/%m/%Y',strtotime(unix_to_human($user['created_on']))) ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
				<div class="row" style="margin-top: 5px;">
					<div class="col-sm-12">
						<div class="box">
							<div class="box-content nopadding">
								<div class="pull-right">
									<div class="btn-toolbar">
										<div class="btn-group">
											<a href="<?php echo base_url('admin/add_user')?>" class="btn btn-primary" rel="tooltip" title="Tạo mới người dùng">
												<i class="fa fa-plus"></i> Thêm người dùng
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
