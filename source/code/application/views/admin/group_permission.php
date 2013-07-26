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
							</div>
							<div class="box-content">	
								<form action="<?php echo base_url('admin/insert_permission/'.$group['id']) ?>" method="POST" class="form-vertical">
									<div class="row-fluid">
										<div class="span6">
											<div class="control-group">
												<label for="" class="control-label">Nhóm vai trò</label>
												<div class="controls controls-row">
													<select name="group" id="group" class="chosen-select">
														<option value="<?php echo $group['id'] ?>"><?php echo $group['name'] ?></option>
													</select>
												</div>
											</div>
										</div>
										<div class="span6">
											<div class="control-group">
												<label for="" class="control-label">Khoa / Ban</label>
												<div class="controls controls-row">
													<select name="faculty" id="faculty" class="chosen-select">
														<?php foreach ($faculties as $faculty) { ?>
														<option value="<?php echo $faculty['faculty_id'] ?>"><?php echo $faculty['faculty_name'] ?></option>
														<?php } ?>
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
													<input name='view' type="checkbox" class="icheck-me" data-skin="square" data-color="blue" checked="true"><label class="inline">Xem báo cáo</label>
												</div>
											</div>
										</div>
										<div class="span3">
											<label for="" class="control-label">&nbsp;</label>
											<div class="controls controls-row">
												<div class="check-line">
													<input name='edit' type="checkbox" class="icheck-me" data-skin="square" data-color="blue" checked="true"><label class="inline">Thao tác trên dữ liệu</label>
												</div>
											</div>
										</div>
									</div>
									<div class="row-fluid">
										<hr/>
										<input type="submit" class="btn btn-primary" name="submit" value="Lưu">
										<a href="<?php echo base_url('admin/groups') ?>" class="btn">Quay lại trang trước</a>
									</div>
								</form>
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0,1,2">
									<thead>
										<tr>
											<th style="width: 36px"></th>
											<th style="width: 40px">Xem</th>
											<th style="width: 40px">Sửa</th>
											<th>Khoa / Ban</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($permissions as $permission) { ?>
										<tr>
											<td><a href="<?php echo base_url('admin/delete_permission/'.$permission['id'].'/'.$permission['group_id']) ?>" class="btn btn-danger"><i class="icon-remove"></i></a></td>
											<td>
												<?php if ($permission['view'] == 1) {?>
												<span class="btn btn-success"><i class="icon-check"></i></span>
												<?php } ?>
											</td>
											<td>
												<?php if ($permission['edit'] == 1) {?>
												<span class="btn btn-success"><i class="icon-check"></i></span>
												<?php } ?>
											</td>
											<td><?php echo $permission['faculty_name'] ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table> 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
