		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Nhóm tài khoản</h1>
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
							<a href="<?php echo base_url('admin/groups') ?>">Nhóm tài khoản</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							Quản lý nhóm người dùng
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
									Thêm người dùng vào nhóm
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">	
								<form action="#" method="POST" class="form-horizontal form-striped">
									<div class="control-group">
										<label class="control-label">Tên nhóm</label>
										<div class="controls">
											<label class="control-label">Admin (Id: 1)</label>
										</div>
									</div>
									<div class="control-group">
										<label for="users" class="control-label">Người dùng</label>
										<div class="controls">
											<select name="users" id="users" multiple="multiple" class="chosen-select input-xxlarge">
												<option value="1">Option-1</option>
												<option value="2">Option-2</option>
												<option value="3">Option-3</option>
												<option value="4">Option-4</option>
												<option value="5">Option-5</option>
												<option value="6">Option-6</option>
												<option value="7">Option-7</option>
												<option value="8">Option-8</option>
												<option value="9">Option-9</option>
											</select>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Thêm vào nhóm">
										<input type="reset" class="btn" value="Huỷ" onclick="location.href='<?php echo base_url('admin/groups'); ?>';">
									</div>
								</form>
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 36px"></th>
											<th>Tài khoản</th>
											<th>Họ và tên</th>
											<th>Email</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
											</td>
											<td>admin</td>
											<td>Nguyễn Ảnh Nhân</td>
											<td>admin@admin.com</td>
										</tr>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
											</td>
											<td>buiminhphung</td>
											<td>Bùi Minh Phụng</td>
											<td>buiminhphung@vanlanguni.edu.vn</td>
										</tr>
									</tbody>
								</table> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
