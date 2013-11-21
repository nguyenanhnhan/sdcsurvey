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
