		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Thông tin sinh viên</h1>
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
							<a href="<?php echo base_url() ?>admin">Root</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="import_student">Nhập danh sách sinh viên</a>
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
									<i class="icon-upload-alt"></i>
									Nhập danh sách sinh viên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="POST" class='form-horizontal form-striped'>
									<div class="control-group">
										<label for="file" class="control-label">Danh sách sinh viên</label>
										<div class="controls">
											<div class="fileupload fileupload-new" data-provides="fileupload">
												<div class="input-append">
													<div class="uneditable-input span3">
														<i class="icon-file fileupload-exists"></i> 
														<span class="fileupload-preview"></span>
													</div>
													<span class="btn btn-file">
														<span class="fileupload-new">Chọn file</span>
														<span class="fileupload-exists">Thay đổi file</span>
														<input type="file" name="aaaa" />
													</span>
													<a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Huỷ</a>
												</div>
											</div>
											<span class="help-block">Chỉ chấp nhận file .xls (Dung lượng tối đa: 10MB)</span>
										</div>
									</div>
									<div class="control-group">
										<label for="grade" class="control-label">Bậc</label>
										<div class="controls">
											<div class="input-xlager span6">
												<select name="grade" id="grade" class="chosen-select">
													<option value="0">Đại học</option>
													<option value="1">Trung cấp chuyên nghiệp</option>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label for="haveGraduated" class="control-label">Đã tốt nghiệp</label>
										<div class="controls">
											<input id="haveGraduated" type="checkbox" class="icheck-me" data-skin="square" data-color="blue" />
										</div>
									</div>
									<div class="control-group">
										<label for="courses" class="control-label">Khoá</label>
										<div class="controls">
											<div class="input-xlager span2">
												<select name="courses" id="courses" class="chosen-select">
													<option value = "14">14</option>
													<option value = "13">13</option>
													<option value = "12">12</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button type="submit" class="btn btn-primary">Tiến hành cập nhật vào hệ thống</button>
										<button type="reset" class="btn">Huỷ</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-list"></i>
									Danh sách sinh viên
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn dataTable-scroll-x dataTable-scroll-y">
									<thead>
										<tr>
											<th>#ID</th>
											<th>Khoa</th>
											<th>Ngành</th>
											<th>Lớp</th>
											<th>MSSV</th>
											<th>Họ</th>
											<th>Tên</th>
											<th>Nơi sinh</th>
											<th>Ngày sinh</th>
											<th>Xếp loại</th>
											<th>Điện thoại bàn</th>
											<th>Điện thoại di động</th>
											<th>Email</th>
											<th>Địa chỉ</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>1</td>
											<td>Lorem ipsum.</td>
											<td>Perferendis molestiae.</td>
											<td>Voluptates pariatur.</td>
											<td>Laudantium repudiandae.</td>
											<td>Ipsum officiis?</td>
											<td>Corporis architecto?</td>
											<td>Minima totam.</td>
											<td>Debitis accusamus.</td>
											<td>Ratione obcaecati.</td>
											<td>Quos ut.</td>
											<td>Cum doloremque?</td>
											<td>Mollitia tempore!</td>
											<td>Repellendus ipsa.</td>
										</tr>
										<tr>
											<td>2</td>
											<td>Lorem ipsum.</td>
											<td>Qui beatae.</td>
											<td>Ea eius!</td>
											<td>Sapiente est.</td>
											<td>Incidunt in.</td>
											<td>Dolorem ducimus!</td>
											<td>Porro animi.</td>
											<td>Ut quia!</td>
											<td>Quia culpa?</td>
											<td>Officiis omnis.</td>
											<td>Corrupti voluptatibus!</td>
											<td>Consequatur ipsa.</td>
											<td>Delectus iusto.</td>
										</tr>
										<tr>
											<td>3</td>
											<td>Lorem ipsum.</td>
											<td>Asperiores sit.</td>
											<td>Placeat commodi.</td>
											<td>Hic rem.</td>
											<td>Voluptatibus dolor.</td>
											<td>Nam vitae!</td>
											<td>Recusandae quaerat.</td>
											<td>Odio rerum.</td>
											<td>Placeat reprehenderit?</td>
											<td>Officiis adipisci?</td>
											<td>Tenetur harum!</td>
											<td>Est illum!</td>
											<td>Molestiae tempora?</td>
										</tr>
										<tr>
											<td>4</td>
											<td>Lorem ipsum.</td>
											<td>Officia voluptate.</td>
											<td>Velit dolor.</td>
											<td>Aliquam in!</td>
											<td>Culpa eum.</td>
											<td>Voluptates doloremque.</td>
											<td>Repellat aliquam.</td>
											<td>Quia iusto.</td>
											<td>Adipisci veniam.</td>
											<td>Aut sequi.</td>
											<td>Sunt quibusdam!</td>
											<td>Harum fuga.</td>
											<td>Inventore quibusdam!</td>
										</tr>
										<tr>
											<td>5</td>
											<td>Lorem ipsum.</td>
											<td>Aliquid hic.</td>
											<td>Rerum dignissimos.</td>
											<td>Minima officia.</td>
											<td>Dolores exercitationem.</td>
											<td>Illo totam?</td>
											<td>Architecto nam!</td>
											<td>Minus cumque.</td>
											<td>Dolore voluptatibus!</td>
											<td>Quam molestiae.</td>
											<td>Quasi amet.</td>
											<td>Ducimus illo?</td>
											<td>Ex iusto.</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
