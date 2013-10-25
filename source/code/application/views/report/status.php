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
							<a href="#">Tình hình khảo sát</a>
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
									Tình hình khảo sát
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="post" class="form-horizontal form-bordered">
									<div class="control-group">
										<label for="survey_type" class="control-label">Loại khảo sát</label>
										<div class="controls">
											<div class="input-xxlarge">
												<select name="survey_type" id="survey_type" class='chosen-select'>
													<option value="1">Option-1</option>
													<option value="2">Option-2</option>
													<option value="3">Option-3</option>
													<option value="4">Option-4</option>
													<option value="5">Option-5</option>
													<option value="6">Option-6</option>
													<option value="7">Option-7</option>
													<option value="8">Option-8</option>
													<option value="9">Option-9</option>
												</select>
											</div>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Phiếu khảo sát</label>
										<div class="controls">
											<div class="input-xxxlarge">
												<select name="survey" id="survey" class='chosen-select'>
													<option value="1">Option-1</option>
													<option value="2">Option-2</option>
													<option value="3">Option-3</option>
													<option value="4">Option-4</option>
													<option value="5">Option-5</option>
													<option value="6">Option-6</option>
													<option value="7">Option-7</option>
													<option value="8">Option-8</option>
													<option value="9">Option-9</option>
												</select>
											</div>
										</div>
									</div>
									<div class="form-actions">
										<button class="btn btn-primary" type="submit" name="submit" value="submint">Xem biểu đồ</button>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="box box-color box-bordered">
						<div class="box-title">
							<h3>
								<i class="icon-static">Biểu đồ</i>
							</h3>
						</div>
						<div class="box-content">
							<div id="sum_graph" style="height: 500px"></div>
							<div>&nbsp;</div>
							<div id="fac_graph" style="height: 1000px"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function (){
				$('#sum_graph').highcharts({
					chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Tình hình khảo sát toàn trường'
					},
					subtitle: {
						text: 'Bậc Đại học'
					},
					tooltip: {
						pointFormat: '{series.name}: <b>{point.y}</b> sinh viên'
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								format: '<b>{point.name}</b>: {point.y} ({point.percentage:.1f}%)'
							},
							showInLegend: true
						}
					},
					series:
					[
						{
							type:'pie',
							name: 'Số lượng',
							data: 
							[
								['Đã khảo sát', 1000],
								['Chưa khảo sát', 500]
							]
						}
					]
				});
				$('#fac_graph').highcharts({
					chart: {
						type: 'bar'
					},
					title: {
						text: 'Tình hình khảo sát của Khoa'
					},
					xAxis: {
						categories: [
							'Kiến Trúc', 
							'Xây Dựng' , 
							'Kinh Tế Thương Mại', 
							'Du Lịch', 
							'Tài Chính Ngân Hàng', 
							'Kế Toán Kiểm Toán', 
							'Mỹ Thuật Công Nghiệp', 
							'Công Nghệ Môi Trường', 
							'Kỹ Thuật Nhiệt Lạnh', 
							'Ngoại Ngữ', 
							'Quan Hệ Công Chúng', 
							'Quản Trị Kinh Doanh', 
							'Công Nghệ Sinh Học', 
							'Công Nghệ Thông Tin'
						]
					},
					yAxis: {
						min: 0,
						title: {
							text: 'Tổng sinh viên'
						}
					},
					legend: {
						backgroundColor: '#FFFFFF',
						reversed: true
					},
					plotOptions: {
						series: {
							stacking: 'normal',
							dataLabels: {
								enabled: true,
								color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'black'
							}
						}
					},
					series: 
					[
						{
							name: 'Đã khảo sát',
							data: [50, 60, 70, 80, 90, 100, 110, 120, 130, 140, 150, 160, 170, 180]
						}, 
						{
							name: 'Chưa khảo sát',
							data: [180, 170, 160, 150, 140, 130, 120, 110, 100, 90, 80, 70, 60, 50]
						}
					]
				});
			});
		</script>
