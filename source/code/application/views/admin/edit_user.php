		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Hồ sơ người dùng</h1>
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
							<a href="#">Chỉnh sửa tài khoản người dùng</a>
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
									<i class="icon-user"></i>
									Hồ sơ cá nhân
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<div class="box-content nopadding">
									<ul class="tabs tabs-inline tabs-top">
										<li class='active'>
											<a href="#profile" data-toggle='tab'><i class="icon-user"></i> Thông tin cơ bản</a>
										</li>
										<li>
											<a href="#notifications" data-toggle='tab'><i class="icon-bullhorn"></i> Thông báo</a>
										</li>
										<li>
											<a href="#security" data-toggle='tab'><i class="icon-lock"></i> Bảo mật</a>
										</li>
									</ul>
									<div class="tab-content padding tab-content-inline tab-content-bottom">
										<div class="tab-pane active" id="profile">
											<form action="#" class="form-horizontal">
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
														<label for="user_name" class="control-label">Tên tài khoản</label>
														<div class="controls">
															<div class="input-xlarge uneditable-input">nguyenanhnhan</div>
														</div>
													</div>
													<div class="control-group">
														<label for="first_name" class="control-label">Họ và tên đệm</label>
														<div class="controls">
															<input type="text" name="first_name" class='input-xlarge' value="Nguyễn Ảnh">
														</div>
													</div>
													<div class="control-group">
														<label for="last_name" class="control-label">Tên</label>
														<div class="controls">
															<input type="text" name="last_name" class='input-xlarge' value="Nhân">
														</div>
													</div>
													<div class="control-group">
														<label for="phone" class="control-label">Số điện thoại</label>
														<div class="controls">
															<input type="text" name="phone" class="input-xlarge">
														</div>
													</div>
													<div class="control-group">
														<label for="email" class="control-label">Địa chỉ email</label>
														<div class="controls">
															<input type="text" name="email" class='input-xxlarge' value="nguyenanhnhan@vanlanguni.edu.vn">
															<div class="form-button">
																<a href="#" class="btn btn-grey-4 change-input">Thay đổi</a>
															</div>
														</div>
													</div>
													<div class="control-group">
														<label for="password" class="control-label">Mật khẩu</label>
														<div class="controls">
															<input type="password" name="password" class='input-xlarge' value="************">
															<div class="form-button">
																<a href="#" class="btn btn-grey-4 change-input">Thay đổi</a>
															</div>
														</div>
													</div>
													<div class="form-actions">
														<input type="submit" class="btn btn-primary" value="Lưu">
														<input type="reset" class="btn" value="Không thay đổi" onclick="location.href='<?php echo base_url('admin/users') ?>'">
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
