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
									Tài khoản người dùng
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 75px">Điều khiển</th>
											<th>Tài khoản</th>
											<th>Họ và tên</th>
											<th>Email</th>
											<th>Ngày tham gia</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($users as $user) { ?>
										<tr>
											<td>
												<a href="<?php echo base_url('admin/delete_user/'.$user['id'])?>" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="<?php echo base_url('admin/edit_user/'.$user['id']) ?>" class="btn btn-success"><i class="icon-edit"></i></a>
											</td>
											<td><?php echo $user['username'] ?></td>
											<td><?php echo trim($user['first_name'].' '.trim($user['last_name'])) ?></td>
											<td><?php echo $user['email'] ?></td>
											<td><?php echo mdate('%d/%m/%Y',strtotime(unix_to_human($user['created_on']))) ?></td>
										</tr>
										<?php } ?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box">
							<div class="box-content nopadding">
								<div class="pull-right">
									<div class="btn-toolbar">
										<div class="btn-group">
											<a href="<?php echo base_url('admin/add_user')?>" class="btn btn-primary" rel="tooltip" title="Tạo mới người dùng">
												<i class="icon-plus"></i> Thêm người dùng
											</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
