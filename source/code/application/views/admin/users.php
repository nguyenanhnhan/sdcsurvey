		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Tài khoản người dùng</h1>
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
							<a href="<?php echo base_url('admin/users') ?>">Quản trị tài khoản người dùng</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-group"></i>
									Tài khoản người dùng
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 102px">Điều khiển</th>
											<th>Tài khoản</th>
											<th>Họ và tên</th>
											<th>Email</th>
											<th>Ngày tham gia</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="<?php echo base_url('admin/edit_user') ?>" class="btn"><i class="icon-edit"></i></a>
												<a href="#" class="btn"><i class="icon-group"></i></a>
											</td>
											<td>admin</td>
											<td>Administrator</td>
											<td>admin@admin.com</td>
											<td>02/07/2013</td>
										</tr>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="<?php echo base_url('admin/edit_user') ?>" class="btn"><i class="icon-edit"></i></a>
												<a href="#" class="btn"><i class="icon-group"></i></a>
											</td>
											<td>nguyenanhnhan</td>
											<td>Nguyễn Ảnh Nhân</td>
											<td>nguyenanhnhan@vanlanguni.edu.vn</td>
											<td>02/07/2013</td>
										</tr>
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
											<a href="<?php echo base_url('admin/add_user')?>" class="btn btn-primary" rel="tooltip" title="Tạo mới người dùng">
												<i class="icon-plus"></i> Thêm người dùng
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
