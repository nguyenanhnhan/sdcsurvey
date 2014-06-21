		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Điều chỉnh Phiếu khảo sát</h1>
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
							<a href="<?php echo base_url('survey_type') ?>">Loại khảo sát</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('survey_type/index/'.$survey_type['survey_type_id'])?>">
								<?php echo $survey_type['survey_type_name']; ?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="<?php echo base_url('survey/index/'.$survey_type['survey_type_id'].'/'.$survey['survey_id']); ?>">
								<?php echo $survey['survey_name']; ?>
							</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Điều chỉnh</a>
						</li>
					</ul>
					<div class="close-bread">
						<a href="#"><i class="icon-remove"></i></a>
					</div>
				</div>
				<div class="row">&nbsp;</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="box">
							<div class="controls">
								<a href="<?php echo base_url('survey/edit_step_3').'/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'] ?>" class="btn">Quay lại bước 3</a>
								<a href="<?php echo base_url('survey/create_summary').'/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'] ?>" class="btn btn-primary">Hoàn tất</a>
							</div>
						</div>
					</div>
				</div>
				
				<!-- Bảng câu hỏi -->
				<?php
					for ($i=0, $len_q=count($survey_question); $i<$len_q; $i++)
					{
						$q_count = $i+1;
				?>
				<div class="row">
					<div class="col-sm-12">
						<div class="box box-color box-bordered <?php if ($survey_question[$i]['required']==1) echo 'red'; else echo 'green'; ?>">
							<div class="box-title">
								<h3>
									<?php echo '#'.$q_count.' '.$survey_question[$i]['content']; ?>
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp"><i class="fa fa-angle-down"></i></a>
								</div>
							</div>
							<?php  
								$answer_template = $survey_answer_template[$survey_question[$i]['question_id']];
								if ($answer_template[0]['option_type']=='r'){
							?>
							<div class="box-content nopadding">
							<table class="table table-hover table-nomargin table-bordered">
									<thead>
										<tr>
											<th style="width: 115px">Xét hiệu ứng</th>
											<th>Lựa chọn</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($answer_template as $template_item): ?>
										<tr>
											<td style="text-align: center">
												<a href='<?php echo base_url('survey/edit_effect').'/'.$survey_type['survey_type_id'].'/'.$survey['survey_id'].'/'.$survey_question[$i]['question_id'].'/'.$template_item['answer_template_id'] ?>' class="btn"><i class="fa fa-edit"></i></a>
											</td>
											<td><?php echo $template_item['label']; ?></td>
										</tr>
										<?php endforeach?>
									</tbody>
								</table>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<?php
					} // end for loop
				?>
				<!-- Fix loi footer tran len tren khi thu nho -->
				<div class="row-fluid" style="height: 50px">
					
				</div>
			</div>
		</div>
		<!--- Javascript -->
		<script type="text/javascript">
			
		</script>
		
