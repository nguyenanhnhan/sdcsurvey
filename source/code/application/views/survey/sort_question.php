		<div id="main">
			<div class="container-fluid">
				<div class="page-header">
					<div class="pull-left">
						<h1>Sắp xếp câu hỏi khảo sát</h1>
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
							<a href="<?php echo base_url('survey/index').'/'.$survey_type['survey_type_id']; ?>"><?php echo $survey_type['survey_type_name']; ?></a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<a href="#">Sắp xếp câu hỏi</a>
						</li>
					</ul>
				</div>
				<div class="row">
					<div class="col-sm-12 sortable-box">
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
					</div>
				</div>
			</div>
		</div>
		
		<script>
			$(document).ready(function(){
				$(".sortable-box").sortable({
					update: function(event, ui){
/* 						console.clear(); */
						var q_count = 1;
						$(".sort").each(function(){
/* 							console.log($(this).attr("id")); */
							$.ajax({
								type: "POST",
								url:"<?php echo base_url('survey/update_view_order') ?>",
								data:"question_id="+$(this).attr("id")+"&view_order="+q_count,
								dataType:"json",
							});
							q_count++;
						});
					}
				});
				$(".sortable-box").sortable({
					stop: function( event, ui ) {
						var title = "Thông báo",
						message = "Đã cập nhật lại vị trí",
						time = 1000;
				
						$.gritter.add({
							title: 	(typeof title !== 'undefined') ? title : 'Message - Head',
							text: 	(typeof message !== 'undefined') ? message : 'Body',
							image: 	null,
							sticky: false,
							time: 	(typeof time !== 'undefined') ? time : 3000
						});
					}
				});
			});
		</script>
