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
							<a href="#">Phân quyền nhóm tài khoản</a>
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
									Phân quyền nhóm tài khoản
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">	
								<form action="#" method="POST" class="form-vertical">
									<div class="row-fluid">
										<div class="span6">
											<div class="control-group">
												<label for="" class="control-label">Nhóm vai trò</label>
												<div class="controls controls-row">
													<select name="" id="" class="chosen-select">
														<option value="1">Quản trị hệ thống</option>
														<option value="2">Trung tâm phát triển phần mềm</option>
													</select>
												</div>
											</div>
										</div>
										<div class="span6">
											<div class="control-group">
												<label for="" class="control-label">Khoa / Ban</label>
												<div class="controls controls-row">
													<select name="" id="" class="chosen-select">
														<option value="1">Khoa Kiến trúc</option>
														<option value="2">Khoa Xây dựng</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<div class="span3">
											<label for="" class="control-label">Quyền hạn</label>
											<div class="controls controls-row">
												<div class="check-line">
													<input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" checked="true"><label class="inline">Xem báo cáo</label>
												</div>
											</div>
										</div>
										<div class="span3">
											<label for="" class="control-label">&nbsp;</label>
											<div class="controls controls-row">
												<div class="check-line">
													<input type="checkbox" class="icheck-me" data-skin="square" data-color="blue" checked="true"><label class="inline">Thao tác trên dữ liệu</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<hr/>
										<input type="submit" class="btn btn-primary" name="submit" value="Lưu">
										<input type="reset" class="btn" name="reset" value="Huỷ">
									</div>
								</form>
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0,1,2">
									<thead>
										<tr>
											<th style="width: 36px"></th>
											<th style="text-align:center; width: 100px">Xem báo cáo</th>
											<th style="text-align:center; width: 100px">Thao tác trên dữ liệu</th>
											<th>Khoa / Ban</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
											</td>
											<td style="text-align:center">
												<span class="btn btn-success"><i class="icon-check"></i></span>
											</td>
											<td style="text-align:center">
												<span class="btn btn-success"><i class="icon-check"></i></span>
											</td>
											<td>Khoa Xây dựng</td>
										</tr>
										<tr>
											<td>
												<a href="#" class="btn btn-danger"><i class="icon-remove"></i></a>
											</td>
											<td style="text-align:center">
												<span class="btn btn-success"><i class="icon-check"></i></span>
											</td>
											<td style="text-align:center">
												<span class="btn btn-success"><i class="icon-check-empty"></i></span>
											</td>
											<td>Khoa Công nghệ thông tin</td>
										</tr>
									</tbody>
								</table> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
