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
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							Quản lý nhóm người dùng
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-group"></i>
									Thêm người dùng vào nhóm <?php echo $group['name'].' [id='.$group['id'].']' ?>
								</h3>
							</div>
							<div class="box-content nopadding">	
								<form action="<?php echo base_url('admin/insert_to_group/'.$group['id']) ?>" method="POST" class="form-horizontal form-bordered">
									<div class="form-group">
										<label for="users" class="control-label col-sm-2">Người dùng</label>
										<div class="col-sm-10">
											<select name="users[]" id="users" multiple="multiple" class="chosen-select form-control">
												<?php foreach ($users_not_in_group as $user_not_group) { ?>
												<option value="<?php echo $user_not_group['id'] ?>"><?php echo $user_not_group['username'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Thêm vào nhóm">
										<a href="<?php echo base_url('admin/groups') ?>" class="btn">Quay lại trang trước</a>
									</div>
								</form>
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 36px"></th>
											<th>Tài khoản</th>
											<th>Họ và tên</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($users_in_group as $user_in_group) { ?>
										<tr>
											<td><a href="<?php echo base_url('admin/remove_user_group/'.$group['id'].'/'.$user_in_group['id']) ?>" class="btn btn-danger"><i class="fa fa-trash-o"</a></td>
											<td><?php echo $user_in_group['username'] ?></td>
											<td><?php echo trim($user_in_group['first_name']).' '.trim($user_in_group['last_name']) ?></td>
											<td><?php echo $user_in_group['email'] ?></td>
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
