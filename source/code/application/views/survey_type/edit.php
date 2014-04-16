		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Loại khảo sát</h1>
					</div>
					<div class="pull-right">
						<ul class="stats">
							<li class='lightred'>
								<i class="fa fa-calendar"></i>
								<div class="details">
									<span class="big" id="date">February 22, 2013</span>
									<span id="clock">Wednesday, 13:56</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
						<li>
							<a href="<?php echo base_url('admin') ?>">Root</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('survey_type') ?>">Quản trị Biểu mẫu khảo sát</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Sửa loại khảo sát</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-edit"></i>
									Sửa loại khảo sát
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="<?php echo base_url('survey_type/update') ?>" method="post" class="form-horizontal form-bordered">
									<div class="form-group">
										<label for="survey_type" class="control-label col-sm-2">Tên loại khảo sát</label>
										<div class="col-sm-10">
											<input type="text" name="survey_type" id="survey_type" class="form-control" value="<?php echo $stype_item['survey_type_name']; ?>">
											<input type="hidden" value="<?php echo $stype_item['survey_type_id']; ?>" name="hidden_id" id="hidden_id">
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit" name="submit" value="submint">Lưu</button>
										<a href="<?php echo base_url('survey_type') ?>" class="btn">Quay lại</a>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
