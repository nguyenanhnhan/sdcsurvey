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
							<a href="#">Phân quyền nhóm tài khoản</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-group"></i>
									Phân quyền nhóm tài khoản
								</h3>
							</div>
							<div class="box-content">	
								<form action="<?php echo base_url('admin/insert_permission/'.$group['id']) ?>" method="POST" class="form-vertical">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="" class="control-label">Nhóm vai trò</label>
												<div class="controls controls-row">
													<select name="group" id="group" class="chosen-select form-control">
														<option value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6">
											<div class="control-group">
												<label for="" class="control-label">Khoa / Ban</label>
												<div class="controls controls-row">
													<select name="faculty" id="faculty" class="chosen-select form-control">
														<?php foreach ($faculties as $faculty) { ?>
														<option value="<?php echo $faculty['faculty_id'] ?>"><?php echo $faculty['faculty_name'] ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<label for="" class="control-label">Quyền hạn</label>
											<div class="controls controls-row">
												<div class="check-line">
													<input name='view' type="checkbox" class="icheck-me" data-skin="square" data-color="blue" checked="true"><label class="inline">Xem báo cáo</label>
												</div>
											</div>
										</div>
										<div class="col-sm-3">
											<label for="" class="control-label">&nbsp;</label>
											<div class="controls controls-row">
												<div class="check-line">
													<input name='edit' type="checkbox" class="icheck-me" data-skin="square" data-color="blue" checked="true"><label class="inline">Thao tác trên dữ liệu</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<hr/>
										<input type="submit" class="btn btn-primary" name="submit" value="Lưu">
										<a href="<?php echo base_url('admin/groups') ?>" class="btn">Quay lại trang trước</a>
									</div>
								</form>
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort dataTable-custom" data-nosort="0,1,2">
									<thead>
										<tr>
											<th style="width: 36px"></th>
											<th style="width: 40px">Xem</th>
											<th style="width: 40px">Sửa</th>
											<th>Khoa / Ban</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($permissions as $permission) { ?>
										<tr>
											<td><a href="<?php echo base_url('admin/delete_permission/'.$permission['id'].'/'.$permission['group_id']) ?>" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td>
											<td>
												<?php if ($permission['view'] == 1) {?>
												<span class="btn btn-success"><i class="fa fa-check"></i></span>
												<?php } ?>
											</td>
											<td>
												<?php if ($permission['edit'] == 1) {?>
												<span class="btn btn-success"><i class="fa fa-check"></i></span>
												<?php } ?>
											</td>
											<td><?php echo $permission['faculty_name'] ?></td>
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
