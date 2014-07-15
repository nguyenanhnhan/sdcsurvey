		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Hồ sơ người dùng</h1>
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
							<a href="#">Chỉnh sửa tài khoản người dùng</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-user"></i>
									Hồ sơ cá nhân
								</h3>
							</div>
							<div class="box-content nopadding">
								<div class="box-content nopadding">
									<ul class="tabs tabs-inline tabs-top">
										<li class='active'>
											<a href="#profile" data-toggle='tab'><i class="fa fa-user"></i> Thông tin cơ bản</a>
										</li>
										<li>
											<a href="#change_password" data-toggle='tab'><i class="fa fa-bullhorn"></i> Đổi mật khẩu</a>
										</li>
									</ul>
									<div class="tab-content padding tab-content-inline tab-content-bottom">
										<div class="tab-pane active" id="profile">
											<form action="<?php echo base_url('admin/update_user/'.$edit_user['id']) ?>" method="post" class="form-horizontal">
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
												<div class="col-sm-10" style="margin-top:5px;">
													<div class="form-group">
														<label for="user_name" class="control-label col-sm-2">Tên tài khoản</label>
														<div class="col-sm-10">
															<div class="form-control uneditable-input"><?php echo $edit_user['username'] ?></div>
														</div>
													</div>
													<div class="form-group">
														<label for="first_name" class="control-label col-sm-2">Họ và tên đệm</label>
														<div class="col-sm-10">
															<input type="text" name="first_name" class='form-control' value="<?php echo $edit_user['first_name'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label for="last_name" class="control-label col-sm-2">Tên</label>
														<div class="controls">
															<input type="text" name="last_name" class='form-control' value="<?php echo $edit_user['last_name'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label for="phone" class="control-label col-sm-2">Số điện thoại</label>
														<div class="controls">
															<input type="text" name="phone" class="form-control" value="<?php echo $edit_user['phone'] ?>">
														</div>
													</div>
													<div class="form-group">
														<label for="email" class="control-label col-sm-2">Địa chỉ email</label>
														<div class="controls">
															<input type="text" name="email" class='form-control' value="<?php echo $edit_user['email'] ?>">
														</div>
													</div>
													<div class="form-actions">
														<input type="submit" class="btn btn-primary" value="Lưu">
														<input type="reset" class="btn" value="Không thay đổi" onclick="location.href='<?php echo base_url('admin/users') ?>'">
														<a href="<?php echo base_url('admin/users') ?>" class="btn">Quay lại danh sách người dùng</a>
													</div>
													<div id="infoMessage"><?php echo $message;?></div>
												</div>
											</form>
										</div>
										<div class="tab-pane" id="change_password">
											<form action="<?php echo base_url('admin/change_pass/'.$edit_user['id']) ?>" method="post" class="form-horizontal form-validate" id="form_change_password">
												<div class="form-group">
													<label for="new_password" class="control-label col-sm-2">Mật khẩu mới</label>
													<div class="npass col-sm-10">
														<input type="password" name="new_password" id="new_password" class="form-control" data-rule-required="true">
													</div>
												</div>
												<div class="cpass form-group">
													<label for="confirm_password" class="control-label col-sm-2">Xác nhận mật khẩu</label>
													<div class="col-sm-10">
														<input type="password" name="confirm_password" id="confirm_password" class="form-control" data-rule-equalTo="#new_password">
													</div>
												</div>
												<div class="form-actions">
													<input type="submit" class="btn btn-primary" value="Lưu">
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
