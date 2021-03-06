		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Biểu đồ trực quan</h1>
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
							<a href="#">Tình hình khảo sát</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered">
							<div class="box-title">
								<h3>
									<i class="fa fa-edit"></i>
									Tình hình khảo sát
								</h3>
							</div>
							<div class="box-content nopadding">
								<form action="#" method="post" class="form-horizontal form-bordered">
									<div class="form-group">
										<label for="survey_type" class="control-label col-sm-2">Loại khảo sát</label>
										<div class="col-sm-10">
											<select name="survey_type" id="survey_type" class='chosen-select form-control' data-placeholder="Chọn loại khảo sát">
												<option value=""></option>
												<?php 
												foreach ($survey_type as $survey_type_item) { 
													if (isset($survey_type_selected)){
														if ($survey_type_item['survey_type_id'] == $survey_type_selected)
														{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" selected><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
														else 
														{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" ><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
													}
													else
													{?>
														<option value="<?php echo $survey_type_item['survey_type_id'] ?>" ><?php echo $survey_type_item['survey_type_name'] ?></option>
												  <?php }
												}?>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-sm-2">Phiếu khảo sát</label>
										<div class="col-sm-10">
											<select name="survey" id="survey" class='chosen-select form-control' data-placeholder="Chọn phiếu khảo sát cần xem biểu đồ" data-nosearch="true"></select>
										</div>
									</div>
								</form>	
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="box box-color box-bordered col-sm-12">
						<div class="box-title">
							<h3>
								<i class="fa fa-static">Biểu đồ</i>
							</h3>
						</div>
						<div class="box-content">
							<div id="sum_graph" style="height: 500px"></div>
							<div>&nbsp;</div>
							<div id="fac_graph" style="height: 700px"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function (){
			
				$('#survey_type').chosen().change(function(){
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('report/gets_survey') ?>"+"/"+$('#survey_type').val(),
						dataType: 'json',
						success: function(data) {
							if (data.surveys.length > 0)
							{
								$('#survey option').remove();
								$('#survey').trigger("chosen:updated");
								
								$('#survey').append('<option value=""></option>');
								for (var i=0; i<data.surveys.length; i++)
								{
									$('#survey').append('<option value="'+data.surveys[i].survey_id+'">'+data.surveys[i].survey_name+'</option>');
								}
								$('#survey').trigger("chosen:updated");
							}
						}
					});
				});
				
				$('#survey').chosen().change(function(){
					
					// Sum graph
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('report/get_sum_student_survey') ?>"+"/"+$('#survey').val(),
						dataType: 'json',
						success: function(data){
							// chart area
							var chart = new Highcharts.Chart({
								chart: {
									renderTo: 'sum_graph',
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
											['Đã khảo sát', parseInt(data.sum_student_surveyed.sum_student_surveyed)],
											['Chưa khảo sát', parseInt(data.sum_student_survey.sum_student) - parseInt(data.sum_student_surveyed.sum_student_surveyed)]
										]
									}
								]
							});
							// end chart
						}
					});
					
					// Faculties graph
					$.ajax({
						type: "POST",
						url: "<?php echo base_url('report/get_sum_student_faculty_survey') ?>",
						data: "survey_id="+$("#survey").val(),
						dataType: "json",
						success: function(data)
						{
							// chart area
							// chuyen sang kieu Int so sinh vien da khao sat
							var surveyed = $();
							for (i = 0; i < data.surveyed.length; i++)
							{
								surveyed.push(parseInt(data.surveyed[i]));
							}
							
							// chuyen sang kieu Int so sinh vien chua khao sat
							var not_yet_survey = $();
							for (i=0; i< data.not_yet_survey.length; i++)
							{
								not_yet_survey.push(parseInt(data.not_yet_survey[i]));
							}
							
							var char = new Highcharts.Chart({
								chart: {
									renderTo: 'fac_graph',
									type: 'bar',
								},
								title: {
									text: 'Tình hình khảo sát của Khoa'
								},
								xAxis: {
									categories: data.faculties
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
										data: surveyed
									}, 
									{
										name: 'Chưa khảo sát',
										data: not_yet_survey
									}
								]
							});
							// end chart
						}
					});
				
				});
			});

		</script>
