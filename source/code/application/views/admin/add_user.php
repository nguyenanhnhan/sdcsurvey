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
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Tạo tài khoản người dùng</a>
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
									Tạo tài khoản người dùng
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<form action="" method="post" class="form-horizontal">
									<div class="row-fluid">
										<div class="span2">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 200px;">
													<!-- avatar default -->
													<?php echo $this->config->item('avatar_default'); ?>
												</div>
												<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 200px; line-height: 20px;"></div>
												<div>
													<span class="btn btn-file">
														<span class="fileupload-new">Đổi hình đại diện</span>
														<span class="fileupload-exists">Thay đổi</span>
														<input type="file" name='imagefile' />
													</span>
													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Huỷ bỏ</a>
												</div>
											</div>
										</div>
										<div class="span10">
											<div class="control-group">
												<label for="account_name" class="control-label">Tên tài khoản</label>
												<div class="controls">
													<input type="text" name="account_name" class="input-xlarge" placeholder="Tên dùng đăng nhập">
												</div>
											</div>
											<div class="control-group">
												<label for="" class="control-label">Họ</label>
												<div class="controls">
													<input type="text" name="first_name" class="input-xlarge" placeholder="Họ và tên đệm">
												</div>
											</div>
											<div class="control-group">
												<label for="" class="control-label">Tên</label>
												<div class="controls">
													<input type="text" name="last_name" class="input-xlarge" placeholder="Tên">
												</div>
											</div>
											<div class="control-group">
												<label for="" class="control-label">Số điện thoại</label>
												<div class="controls">
													<input type="text" name="phone" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label for="" class="control-label">Địa chỉ Email</label>
												<div class="controls">
													<div class="input-prepend">
														<span class="add-on">@</span>
														<input type="text" name="email" class="input-xlarge" placeholder="Nhập địa chỉ email">
													</div>
												</div>
											</div>
											<div class="control-group">
												<label for="" class="control-label">Mật khẩu</label>
												<div class="controls">
													<div class="input-prepend">
														<span class="add-on"><i class="icon-key"></i></span>
														<input type="password" name="password" class="input-xlarge">
													</div>
												</div>
											</div>
											<div class="control-group">
												<label for="confirm_password" class="control-label">Xác nhận mật khẩu</label>
												<div class="controls">
													<div class="input-prepend">
														<span class="add-on"><i class="icon-key"></i></span>
														<input type="password" name="confirm_password" class="input-xlarge">
													</div>
												</div>
											</div>
											<div class="form-actions">
												<button type="submit" class="btn btn-primary">Lưu</button>
												<button type="reset" class="btn" onclick="location.href='<?php echo base_url('admin/users') ?>'">Huỷ</button>
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
