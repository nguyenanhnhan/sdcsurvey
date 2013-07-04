		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Loại khảo sát</h1>
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
							<a href="<?php echo base_url('survey_type') ?>">Quản trị Biểu mẫu khảo sát</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Sửa loại khảo sát</a>
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
									<i class="icon-edit"></i>
									Sửa loại khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url('survey_type/update') ?>" method="post" class="form-horizontal">
									<div class="control-group">
										<label for="survey_type" class="control-label">Tên loại khảo sát</label>
										<div class="controls">
											<input type="text" name="survey_type" id="survey_type" class="input-xlarge" value="<?php echo $stype_item['survey_type_name']; ?>">
											<input type="hidden" value="<?php echo $stype_item['survey_type_id']; ?>" name="hidden_id" id="hidden_id">
										</div>
										<div class="form-actions">
											<button class="btn btn-primary" type="submit" name="submit" value="submint">Lưu</button>
											<a href="<?php echo base_url('survey_type') ?>" class="btn">Quay lại</a>
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
