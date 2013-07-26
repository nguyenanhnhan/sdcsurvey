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
							Tạo nhóm tài khoản
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
									Tạo mới nhóm tài khoản
								</h3>
							</div>
							<div class="box-content nopadding">	
								<form action="<?php echo base_url('admin/insert_group') ?>" method="POST" class="form-horizontal form-bordered">
									<div class="control-group">
										<label for="group_name" class="control-label">Tên nhóm</label>
										<div class="controls">
											<input type="text" name="group_name" id="group_name" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label for="group_description" class="control-label">Mô tả</label>
										<div class="controls">
											<textarea name="group_description" rows="3" id="group_description" class="input-block-level"></textarea>
										</div>
									</div>
									<div class="form-actions">
										<input type="submit" class="btn btn-primary" value="Lưu">
										<a href="<?php echo base_url('admin/groups') ?>" class="btn">Huỷ</a>
<!-- 										<input type="reset" class="btn" value="Huỷ" onclick="location.href='<?php echo base_url('admin/groups'); ?>';"> -->
									</div>
									<div id="infoMessage"><?php echo $message;?></div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
