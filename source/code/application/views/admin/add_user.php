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
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Tạo tài khoản người dùng</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-group"></i>
									Tạo tài khoản người dùng
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url('admin/insert_user') ?>" method="post" class="form-horizontal">
									<div class="row">
										<div class="col-sm-3">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 200px;">
													<!-- avatar default -->
													<?php echo $this->config->item('avatar_default'); ?>
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"></div>
												<!-- <div>
													<span class="btn btn-file">
														<span class="fileupload-new">Đổi hình đại diện</span>
														<span class="fileupload-exists">Thay đổi</span>
														<input type="file" name='imagefile' />
													</span>
													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Huỷ bỏ</a>
												</div> -->
											</div>
										</div>
										<div class="col-sm-9">
											<div class="form-group">
												<label for="account_name" class="control-label col-sm-2">Tên tài khoản</label>
												<div class="col-sm-10">
													<input type="text" name="user_name" class="form-control" placeholder="Tên dùng đăng nhập">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="control-label col-sm-2">Họ</label>
												<div class="col-sm-10">
													<input type="text" name="first_name" class="form-control" placeholder="Họ và tên đệm">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="control-label col-sm-2">Tên</label>
												<div class="col-sm-10">
													<input type="text" name="last_name" class="form-control" placeholder="Tên">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="control-label col-sm-2">Số điện thoại</label>
												<div class="col-sm-10">
													<input type="text" name="phone" class="form-control">
												</div>
											</div>
											<div class="form-group">
												<label for="" class="control-label col-sm-2">Địa chỉ Email</label>
												<div class="col-sm-10">
													<div class="input-group">
														<span class="input-group-addon">@</span>
														<input type="text" name="email" class="form-control" placeholder="Nhập địa chỉ email">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="" class="control-label col-sm-2">Mật khẩu</label>
												<div class="col-sm-10">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-key"></i></span>
														<input type="password" name="password" class="form-control">
													</div>
												</div>
											</div>
											<div class="form-group">
												<label for="confirm_password" class="control-label col-sm-2">Xác nhận</label>
												<div class="col-sm-10">
													<div class="input-group">
														<span class="input-group-addon"><i class="fa fa-key"></i></span>
														<input type="password" name="confirm_password" class="form-control">
													</div>
												</div>
											</div>
											<div class="form-actions">
												<button type="submit" class="btn btn-primary">Lưu</button>
												<a href="<?php echo base_url('admin/users') ?>" class="btn">Huỷ</a>
<!-- 												<button type="reset" class="btn" onclick="location.href='<?php echo base_url('admin/users') ?>'">Huỷ</button> -->
											</div>
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
