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
							<a href="<?php echo base_url('admin/edit_profile') ?>">Hiệu chỉnh hồ sơ</a>
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
								<ul class="tabs tabs-inline tabs-top">
									<li class='active'>
										<a href="#profile" data-toggle='tab'><i class="icon-user"></i> Thông tin cơ bản</a>
									</li>
									<li>
										<a href="#change_password" data-toggle='tab'><i class="icon-lock"></i> Đổi mật khẩu</a>
									</li>
									<li>
										<a href="#security" data-toggle='tab'><i class="icon-lock"></i> Bảo mật</a>
									</li>
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane active" id="profile">
										<form action="<?php echo base_url('admin/update_user')?>" class="form-horizontal form-validate" method="post">
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
															<div class="input-xlarge uneditable-input"><?php echo $username; ?></div>
														</div>
													</div>
													<div class="control-group">
														<label for="first_name" class="control-label">Họ và tên đệm</label>
														<div class="controls">
															<input type="text" name="first_name" class='input-xlarge' value="<?php echo $first_name; ?>">
														</div>
													</div>
													<div class="control-group">
														<label for="last_name" class="control-label">Tên</label>
														<div class="controls">
															<input type="text" name="last_name" class='input-xlarge' value="<?php echo $last_name; ?>">
														</div>
													</div>
													<div class="control-group">
														<label for="phone" class="control-label">Số điện thoại</label>
														<div class="controls">
															<input type="text" name="phone" class="input-xlarge" value="<?php echo $phone; ?>">
														</div>
													</div>
													<div class="control-group">
														<label for="email" class="control-label">Địa chỉ email</label>
														<div class="controls">
															<input type="text" name="email" id="email" class='input-xlarge' value="<?php echo $email; ?>" data-rule-required="true" data-rule-email="true">
														</div>
													</div>
													<div class="form-actions">
														<input type="submit" class="btn btn-primary" value="Lưu">
														<input type="reset" class="btn" value="Không thay đổi">
													</div>
													<div id="infoMessage"><?php echo $message;?></div>
												</div>
											</form>
										</div>
									</div>
									<div class="tab-pane" id="change_password">
										<form action="#" method="post" class="form-horizontal form-validate" id="form_change_password">
											<div class="control-group">
												<label for="old_password" class="control-label">Mật khẩu đang sử dụng</label>
												<div class="opass controls">
													<input type="password" name="old_password" id="old_password" class="input-xlarge" data-rule-required="true">
												</div>
											</div>
											<div class="control-group">
												<label for="new_password" class="control-label">Mật khẩu mới</label>
												<div class="npass controls">
													<input type="password" name="new_password" id="new_password" class="input-xlarge" data-rule-required="true">
												</div>
											</div>
											<div class="cpass control-group">
												<label for="confirm_password" class="control-label">Xác nhận mật khẩu</label>
												<div class="controls">
													<input type="password" name="confirm_password" id="confirm_password" class="input-xlarge" data-rule-equalTo="#new_password">
												</div>
											</div>
											<div class="form-actions">
												<input type="submit" class="btn btn-primary" value="Lưu">
											</div>
										</form>
									</div>
									<div class="tab-pane" id="security">
										<form action="#" class="form-horizontal">
											<div class="control-group">
												<label for="asdf" class="control-label">Disable account for</label>
												<div class="controls">
													<select name="email" id="email">
														<option value="1">1 week</option>
														<option value="2">2 weeks</option>
														<option value="3">3 weeks</option>
													</select>
												</div>
											</div>
											<div class="control-group">
												<label for="asdf" class="control-label">Lock account?</label>
												<div class="controls">
													<a href="more-locked.html" class="btn btn-danger">Lock account now</a>
												</div>
											</div>
											<div class="form-actions">
												<input type="submit" class='btn btn-primary' value="Save">
												<input type="reset" class='btn' value="Discard changes">
											</div>
										</form>
									</div><!-- end tab sercurity -->
								</div><!-- end tab content -->
							</div><!--  end box content -->
						</div><!-- end box -->
					</div><!-- end span -->
				</div><!-- end row-fluid -->
			</div><!-- end contain-fluid -->
		</div><!-- end main -->
