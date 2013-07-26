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
									Nhóm tài khoản
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 105px">Điều khiển</th>
											<th>Tên nhóm</th>
											<th>Mô tả</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($groups as $group) { ?>
										<tr>
											<td>
												<a href="<?php echo base_url('admin/delete_group/'.$group['id']) ?>" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="<?php echo base_url('admin/group_permission/'.$group['id']) ?>" class="btn"><i class="icon-cogs"></i></a>
												<a href="<?php echo base_url('admin/group_user/'.$group['id']) ?>" class="btn"><i class="icon-group"></i></a>
											</td>
											<td><?php echo $group['name']?></td>
											<td><?php echo $group['description'] ?></td>
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
											<a href="<?php echo base_url('admin/add_group')?>" class="btn btn-primary" rel="tooltip" title="Tạo nhóm tài khoản">
												<i class="icon-plus"></i> Tạo nhóm
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
