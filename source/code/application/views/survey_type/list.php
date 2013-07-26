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
							<a href="#">Quản trị Biểu mẫu khảo sát</a>
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
									Danh sách Loại khảo sát
								</h3>
							</div>
							<div class="box-content nopadding">
								<table class="table table-hover table-nomargin table-bordered dataTable dataTable-nosort" data-nosort="0">
									<thead>
										<tr>
											<th style="width: 102px">Điều khiển</th>
											<th>Tên loại khảo sát</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($survey_type as $stype_item): ?>
										<tr>
											<td>
												<a href="<?php echo base_url('survey_type/delete/'.$stype_item['survey_type_id']); ?>" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="<?php echo base_url('survey_type/edit/'.$stype_item['survey_type_id']); ?>" class="btn"><i class="icon-edit"></i></a>
												<a href="<?php echo base_url('survey/index/'.$stype_item['survey_type_id']); ?>" class="btn btn-success"><i class="icon-eye-open"></i></a>
											</td>
											<td><?php echo $stype_item['survey_type_name']; ?></td>
										</tr>
										<?php endforeach?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="icon-plus"></i>
									Thêm Loại khảo sát
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-refresh"><i class="icon-refresh"></i></a>
									<a href="#" class="btn btn-mini content-remove"><i class="icon-remove"></i></a>
									<a href="#" class="btn btn-mini content-slideUp"><i class="icon-angle-down"></i></a>
								</div>
							</div>
							<div class="box-content">
								<form action="<?php echo base_url('survey_type/add') ?>" method="post" class="form-horizontal">
									<div class="control-group">
										<label for="survey_type" class="control-label">Tên loại khảo sát</label>
										<div class="controls">
											<input type="text" name="survey_type" id="survey_type" class="input-xlarge">
										</div>
										<div class="form-actions">
											<button class="btn btn-primary" type="submit">Thêm</button>
											<button class="btn" type="reset">Huỷ</button>
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
