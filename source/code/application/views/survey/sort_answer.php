		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Sắp xếp câu trả lời khảo sát</h1>
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
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="#">Sắp xếp câu trả lời</a>
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
									<!-- Widget title -->
									<?php echo $question["content"] ?>
								</h3>
								<div class="actions">
									<a href="#" class="btn btn-mini content-slideUp">
										<i class="icon-angle-down"></i>
									</a>
								</div>
							</div>
							<div class="box-content sortable-box">
								<!-- Widget Content --> 
								<?php foreach ($answers as $answer_item) { ?>
								<div class="box box-color box-bordered blue sort" id="<?php echo $answer_item["answer_template_id"] ?>">
									<div class="alert alert-info">
										<h5><?php echo $answer_item["label"] ?></h5>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<!--
<?php $q_count = 1; ?>
						<?php foreach ($questions as $question_item) { ?>
						<div class="box box-color box-bordered blue sort" id="<?php echo $question_item["question_id"]; ?>">
							<div class="box-title">
								<h3><?php echo $q_count.'. '.$question_item["content"]; $q_count ++?></h3>
								<?php if ($question_item["max_option"]>1) { ?>
								<div class="actions">
									<a href="<?php echo base_url("survey/sort_answer/".$survey_type["survey_type_id"]."/".$survey["survey_id"]."/".$question_item["question_id"]) ?>" class="btn btn-mini">
										<i class="glyphicon-sort"></i>
									</a>
								</div>
								<?php } ?>
							</div>
						</div>
						<?php } ?>
-->
					</div>
				</div>
			</div>
		</div>
		
		<script>
			$(document).ready(function(){
				$(".sortable-box").sortable({
					update: function(event, ui){
						var a_count = 1;
						$(".sort").each(function(){
							$.ajax({
								type: "POST",
								url:"<?php echo base_url('survey/update_answer_view_order') ?>",
								data:"answer_template_id="+$(this).attr("id")+"&view_order="+a_count,
								dataType:"json",
							});
							a_count++;
						});
					}
				});
			});
		</script>
