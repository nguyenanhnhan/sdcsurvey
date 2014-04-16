		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Dashboard</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big" id="date">February 22, 2013</span>
									<span id="clock"></span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="#">Root</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('admin')?>">Dashboard</a>
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
									<i class="icon-info-sign"></i>
									Thông tin
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<ul class="tabs tabs-inline tabs-top">
									<li>
										<a href="#t1" data-toggle="tab">Thông tin đăng nhập</a>
									</li>
									<li>
										<a href="#t2" data-toggle="tab">Thông tin máy chủ</a>
									</li>
									<li class="active">
										<a href="#t3" data-toggle="tab">Phiên bản ứng dụng</a>
									</li>
								</ul>
								<div class="tab-content padding tab-content-inline tab-content-bottom">
									<div class="tab-pane" id="t1">
										Đang cập nhật.....
									</div>
									<div class="tab-pane" id="t2">
										Đang cập nhật.....
									</div>
									<div class="tab-pane active" id="t3">
										<ul class="timeline">
											<li>
												<div class="timeline-content">
													<div class="left">
														<div class="icon green">
															<i class="fa fa-bullhorn"></i>
														</div>
														<div class="date">2 / 1 / 2014</div>
													</div>
													<div class="activity">
														<div class="user"><a href="#">Nguyễn Ảnh Nhân</a> 
														<span>Phiên bản 4.1.0.0, </span></div>
														<ul class="timeline-images">
															<p><strong>Tính năng mới</strong></p>
															<p>- [ Nhân viên quản lý ] Ghi chú trong phiếu khảo sát</p>
															<p>- [ Admin ] Thêm link tải mẫu template nhập thông tin sinh viên</p>
															<p><strong>Sửa lỗi</strong></p>
															<p>- [ Nhân viên quản lý ] Phiếu khảo sát trùng mã sinh viên</p>
															<p>- [ Admin ] Sao chép phiếu khảo sát</p>
															<p>- Nhiều lỗi nhỏ</p>
															<p>- Loại bỏ khung CHAT hỗ trợ </p>
														</ul>
													</div>
												</div>
												<div class="line"></div>
											</li>
											<li>
												<div class="timeline-content">
													<div class="left">
														<div class="icon green">
															<i class="fa fa-bullhorn"></i>
														</div>
														<div class="date">29 / 7</div>
													</div>
													<div class="activity">
														<div class="user"><a href="#">Nguyễn Ảnh Nhân</a> 
														<span>Phiên bản 4.0.5.2, </span></div>
														<ul class="timeline-images">
															<p>Phiên bản 4.0.5.2 Cập nhật</p>
															<p>- Lược bỏ bắt buộc nhập số điện thoại gia đình trong phiếu khảo sát</p>
															<p>- Thêm module chat hỗ trợ người dùng trực tuyến, chỉ dùng cho người quản lý.</p>
															<p>- Cập nhật lại dữ liệu sai (không có mã khoa)</p>
														</ul>
													</div>
												</div>
												<div class="line"></div>
											</li>
											<li>
												<div class="timeline-content">
													<div class="left">
														<div class="icon green">
															<i class="fa fa-bullhorn"></i>
														</div>
														<div class="date">23 / 7</div>
													</div>
													<div class="activity">
														<div class="user"><a href="#">Nguyễn Ảnh Nhân</a> 
														<span>Phiên bản 4.0.5.1, </span></div>
														<ul class="timeline-images">
															<p>Phiên bản 4.0.5.1 Cập nhật</p>
															<p>- Sửa lỗi chồng hiệu ứng hiển thị khi xem lại phiếu đã khảo sát => không nhìn thấy các thông tin ẩn</p>
															<p>- Mở chức năng khảo sát dành cho Quản lý sinh viên các khoa</p>
														</ul>
													</div>
												</div>
												<div class="line"></div>
											</li>
											<li>
												<div class="timeline-content">
													<div class="left">
														<div class="icon green">
															<i class="fa fa-bullhorn"></i>
														</div>
														<div class="date">15 / 7</div>
													</div>
													<div class="activity">
														<div class="user"><a href="#">Nguyễn Ảnh Nhân</a> 
														<span>Phiên bản 4.0.5.0, </span></div>
														<ul class="timeline-images">
															<p>Phiên bản 4.0.5.0 Cập nhật</p>
															<p>- Khảo sát sinh viên theo khoa</p>
															<p>- Cập nhật khảo sát</p>
															<p>- Validate trên phiếu khảo sát</p>
															<p>- Send mail (đang fix bug lỗi send mail trên server mail.vanlanguni.edu.vn)</p>
															<p>- Import danh sách 2 khoa CNSH và khoa CNMT để test</p>
															<p>- Thay đổi một số cấu trúc trong CSDL để đáp ứng nhu cầu khảo sát nhiều khoa, nhiều phiếu</p>
														</ul>
													</div>
												</div>
												<div class="line"></div>
											</li>
											<li>
												<div class="timeline-content">
													<div class="left">
														<div class="icon green">
															<i class="fa fa-bullhorn"></i>
														</div>
														<div class="date">12 / 7</div>
													</div>
													<div class="activity">
														<div class="user"><a href="#">Nguyễn Ảnh Nhân</a> 
														<span>Phiên bản 4.0.2.1, </span></div>
														<ul class="timeline-images">
															<p>Phiên bản 4.0.2.1 Cập nhật</p>
															<p>- Lọc danh sách sinh viên tham gia khảo sát</p>
															<p>- Hiện danh sách sinh viên tham gia khảo sát</p>
															<p>- Fixbug lỗi không dùng được hàm date_format trên CentOS</p>
														</ul>
													</div>
												</div>
												<div class="line"></div>
											</li>
											<li>
												<div class="timeline-content">
													<div class="left">
														<div class="icon green">
															<i class="fa fa-bullhorn"></i>
														</div>
														<div class="date">11 / 7</div>
													</div>
													<div class="activity">
														<div class="user"><a href="#">Nguyễn Ảnh Nhân</a> 
														<span>Khởi tạo Ứng dụng khảo sát phiên bản 4.0.0.0 lên server 172.16.3.68</span></div>
														<ul class="timeline-images">
															<p>Phiên bản 4.0.0.0 preview chú trọng việc tạo phiếu khảo sát và thể hiện đúng kết quả do người dùng tạo. Chi tiết các tính năng:</p>
															<p>- Tạo loại khảo sát</p>
															<p>- Tạo phiếu khảo sát</p>
															<p>--- Tạo phiếu khảo sát có thể áp dụng riêng cho một Khoa/Ban hay nhiều Khoa/Ban thực hiện cùng lúc</p>
															<p>--- Hỗ trợ các control trong câu trả lời: <strong>Một lựa chọn</strong>, <strong>Nhiều lựa chọn</strong>, <strong>Văn bản</strong>, <strong>Một lựa chọn đính kèm văn bản</strong>, <strong>Nhiều lựa chọn đính kèm văn bản</strong>, <strong>Văn bản đính kèm Tỉnh/Thành.</strong></p>
															<p>--- Hỗ trợ dựng Thông tin đối tượng khảo sát theo template dựng trước</p>
															<p>- Chỉnh sửa phiếu khảo sát</p>
															<p>- Tạo hiệu ứng Ẩn/Hiện cho Câu hỏi tương ứng với câu trả lời.</p>
															<p>- Xem kết quả sau khi tạo</p>
															<p>- Đăng nhập
															<p>- Chỉnh sửa thông tin cá nhân</p>
															<p>- <strong>Coming Soon:</strong> Quản lý sinh viên khảo sát, Gửi mail mời khảo sát</p>
														</ul>
													</div>
												</div>
												<div class="line"></div>
											</li>
										</ul> <!-- End Timeline -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			paceOptions = {
				ajax: false, // disabled
	  			document: false, // disabled
	  			eventLag: false, // disabled
			}
		</script>
