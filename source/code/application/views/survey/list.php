		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Phiếu khảo sát</h1>
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
							<a href="<?php echo base_url('survey_type') ?>">Loại khảo sát</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#"><?php echo $survey_type['survey_type_name']; ?></a>
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
									Danh sách Phiếu khảo sát
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
										<?php foreach ($surveys as $survey_item): ?>
										<tr>
											<td>
												<a href="<?php echo base_url('survey/delete/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn btn-danger"><i class="icon-remove"></i></a>
												<a href="<?php echo base_url('survey/edit_step_1/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn"><i class="icon-edit"></i></a>
												<a href="<?php echo base_url('survey/create_summary/'.$survey_type['survey_type_id'].'/'.$survey_item['survey_id']); ?>" class="btn btn-success"><i class="icon-eye-open"></i></a>
											</td>
											<td><?php echo $survey_item['survey_name']; ?></td>
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
						<div class="box">
							<div class="box-content nopadding">
								<div class="pull-right">
									<div class="btn-toolbar">
										<div class="btn-group">
											<a href="<?php echo base_url('survey/create_step_1/'.$survey_type['survey_type_id'])?>" class="btn btn-primary" rel="tooltip" title="Tạo phiếu khảo sát">
												<i class="icon-plus"></i> Tạo phiếu khảo sát
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
