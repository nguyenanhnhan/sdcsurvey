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
									Thêm người dùng vào nhóm <?php echo $group['name'].' [id='.$group['id'].']' ?>
								</h3>
							</div>
							<div class="box-content nopadding">	
								<form action="<?php echo base_url('admin/insert_to_group/'.$group['id']) ?>" method="POST" class="form-horizontal form-bordered">
									<div class="control-group">
										<label for="users" class="control-label">Người dùng</label>
										<div class="controls">
											<select name="users[]" id="users" multiple="multiple" class="chosen-select input-xxlarge">
												<?php foreach ($users_not_in_group as $user_not_group) { ?>
												<option value="<?php echo $user_not_group['id'] ?>"><?php echo $user_not_group['username'] ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Thêm vào nhóm">
										<a href="<?php echo base_url('admin/groups') ?>" class="btn">Quay lại trang trước</a>
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
										<?php foreach($users_in_group as $user_in_group) { ?>
										<tr>
											<td><a href="<?php echo base_url('admin/remove_user_group/'.$group['id'].'/'.$user_in_group['id']) ?>" class="btn btn-danger"><i class="icon-remove"</a></td>
											<td><?php echo $user_in_group['username'] ?></td>
											<td><?php echo trim($user_in_group['first_name']).' '.trim($user_in_group['last_name']) ?></td>
											<td><?php echo $user_in_group['email'] ?></td>
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
