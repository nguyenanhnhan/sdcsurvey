<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<!--[if lt IE 9]> 
			<script>	
				window.location = "<?php echo base_url('do_survey/browser') ?>";
			</script>
		<![endif]-->
		<meta content="text/html; charset=utf-8" http-equiv="content-type" />
		<title>Phiếu khảo sát</title>
		<link href="<?php echo css_url() ?>StyleSheet.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo css_url() ?>plugins/note/core.css" rel="stylesheet" type="text/css" />
		<!-- jQuery -->
		<script src="<?php echo js_url() ?>jquery.min.js"></script>
		<script src="<?php echo js_url() ?>plugins/validation/jquery.validate.min.js"></script>
		<script src="<?php echo js_url() ?>plugins/note/core.js"></script>
		<style>
			#my_form input.error {border: 1px dotted red;}
			#my_form label.error {margin-left: 10px !important; width: auto !important; display: none !important;}
			#my_form textarea.error {border: 1px dotted red;}
			#my_form select.error {border: 1px dotted red;}
		</style>
	</head>
<body>
	<form id="my_form" method="post" action="<?php echo base_url('do_survey/save/'.$survey['survey_id'].'/'.$type_id) ?>">
	<input type="hidden" id="hiden_update_value" name="hiden_update_value" value="<?php echo $flag_update ?>" />
	<div id="form_wrapper">
		<div class="top">
			<div id="logo_holder"> <a href="/"><img src="<?php echo img_url() ?>do_survey/logo.png" /></a> </div>
		<div class="clear"></div>
	</div>
	<div class="title_bg">
		<!-- TEN PHIEU KHAO SAT -->
		<div class="title" style="text-transform: uppercase;"> <?php echo $survey['survey_name'] ?> </div>
	</div>

	<div class="roundcont">
		<div class="roundtop" style="background: url(<?php echo img_url();?>do_survey/tr.gif) no-repeat top right;"> 
			<img src="<?php echo img_url() ?>do_survey/tl.gif" alt="" width="15" height="15" class="corner"> 
		</div>
		
		<div class="Container">
			<h2>Hình thức khảo sát</h2>
			<select id="select_survey_type" name="survey_type" required> 
				<option value="0334BD35-9AE4-4922-948B-65354AD2FE1E">Khảo sát qua điện thoại</option>
				<option value="4DB02701-CE28-43C0-8741-29E5CA83245F">Khảo sát qua email</option>
				<option value="E1764151-3EEA-4C20-9902-B326A2FB014E">Khảo sát qua thư bưu điện</option>
				<option value="454C9866-22D2-486B-A79D-FF8C0A293746">Khảo sát trực tiếp</option>
				<option value="8325D43B-355C-4B74-8ED5-BC9C631F6ED4">Khảo sát qua fax</option>
	        </select>
		</div>

		<div class="roundbottom" style="background: url(<?php echo img_url();?>do_survey/br.gif) no-repeat top right;">
			<img src="<?php echo img_url();?>do_survey/bl.gif" alt="" width="15" height="15" class="corner"/>
		</div>
	</div>

	<div class="roundcont">
		<div class="roundtop" style="background: url(<?php echo img_url();?>do_survey/tr.gif) no-repeat top right;"> 
			<img src="<?php echo img_url() ?>do_survey/tl.gif" alt="" width="15" height="15" class="corner"> 
		</div>
		
		<div class="Container">
		<!-- THONG TIN SINH VIEN -->
		<?php echo $read_content; ?>
		</div>

		<div class="roundbottom" style="background: url(<?php echo img_url();?>do_survey/br.gif) no-repeat top right;">
			<img src="<?php echo img_url();?>do_survey/bl.gif" alt="" width="15" height="15" class="corner"/>
		</div>
	</div>

	<div class="roundcont">
		<div class="roundtop" style="background: url(<?php echo img_url();?>do_survey/tr.gif) no-repeat top right;"> 
			<img src="<?php echo img_url() ?>do_survey/tl.gif" alt="" width="15" height="15" class="corner"> 
		</div>
		<div class="Container"> 
			<h2><?php if($survey['is_graduated']==1) echo 'Phần Cựu sinh viên trả lời'; else echo 'Phần Sinh viên trả lời'; ?></h2>
			<p class="explain">Anh/Chị vui lòng trả lời các câu hỏi dưới đây bằng cách click chọn vào phương án trả lời hoặc điền thông tin vào chỗ trống: </p>
			<?php 
			// in cau hoi
			for ($i=0,$len_q=count($survey_question);$i<$len_q;$i++)
			{
				$question_num=$i+1;
			?>
			<div id="<?php echo $survey_question[$i]['question_id'] ?>">
				<p class="question"><?php echo $survey_question[$i]['content'] ?><?php if ($survey_question[$i]['required']==1) echo '<span class="star">*</span>'; ?></p>
				<?php
				// Chu thich Array
				// $survey_answer_template[$survey_question[$i]['question_id']: Array cau tra loi theo question_id
				// [$j]: vi tri trong Array cau tra loi
				// ['label']: ten field tuong ung can lay data
				$answer_template = $survey_answer_template[$survey_question[$i]['question_id']];
				for ($j=0, $len_a=count($answer_template); $j<$len_a; $j++)
				{
					switch ($answer_template[$j]['option_type'])
					{
						case 'r': // radio button
				?>
					<div>
						<input 
							type="radio" 
							name="<?php echo $survey_question[$i]['question_id'].'_ar' ?>" 
							id="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							value="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							<?php if ($survey_question[$i]['required']==1) echo 'required'; ?> 
							title="Câu <?php echo $question_num ?>"
							<?php
								if ($flag_update==1)
								{
									foreach($survey_answers as $survey_answer_item)
									{
										if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
										{
											echo 'checked';
										}
									}
								}
							?>
						>
						<?php echo $answer_template[$j]['label']?>
					</div>
				<?php
						break;
					case 'c': // checkbox
				?>
					<div>
						<input 
							type="checkbox" 
							name="<?php echo $survey_question[$i]['question_id'] ?>_ac[]" 
							id="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							value="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							<?php if ($survey_question[$i]['required']==1) echo 'required'; ?> 
							title="Câu <?php echo $question_num ?>"
							<?php
								if ($flag_update==1)
								{
									foreach($survey_answers as $survey_answer_item)
									{
										if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
										{
											echo 'checked';
										}
									}
								}
							?>
							>
							<?php echo $answer_template[$j]['label'] ?>
					</div>
				<?php
						break; // text
					case 't':
						if ($answer_template[$j]['sub_answer']==0)
						{
				?>
						<div>
							<p><?php echo $answer_template[$j]['label']?></p>
							<p class="longInput">
								<input 
									type="text" 
									name="<?php echo $answer_template[$j]['answer_template_id']?>_at" 
									id="<?php echo $answer_template[$j]['answer_template_id']?>" 
									<?php if ($survey_question[$i]['required']==1) echo 'required'; ?> 
									title="<?php echo $answer_template[$j]['label']?>"
									<?php
										if ($flag_update==1)
										{
											foreach($survey_answers as $survey_answer_item)
											{
												if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
												{
													echo 'value="'.$survey_answer_item['content'].'"';
												}
											}
										}
									?>
									>
							</p>
						</div>
				<?php
						}
						else
						{
				?>
						<table width="100%" cellpadding="0" cellspacing="0">
							<tr>
								<td> Địa chỉ</td>
								<td> Tỉnh/Thành phố</td>    
							</tr>
							<tr>
								<td class="longInput">
									<input 
										type="text" 
										name="<?php echo $answer_template[$j]['answer_template_id']?>_at" 
										id="<?php echo $answer_template[$j]['answer_template_id']?>" 
										<?php if ($survey_question[$i]['required']==1) echo 'required'; ?> 
										title="<?php echo $answer_template[$j]['label']?>"
										<?php
										if ($flag_update==1)
										{
											foreach($survey_answers as $survey_answer_item)
											{
												if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
												{
													echo 'value="'.$survey_answer_item['content'].'"';
												}
											}
										}
										?>
										>
								</td>
								<td class="city">
									<select 
										id='<?php echo $survey_answer_template_sub[$answer_template[$j]['answer_template_id']][0]['answer_template_id'] ?>' 
										name='<?php echo $survey_answer_template_sub[$answer_template[$j]['answer_template_id']][0]['answer_template_id'] ?>'>
										<option value="-1" selected></option>
										<?php foreach ($provinces as $province_item):?>
										<option 
											value='<?php echo $province_item['province_id']; ?>'
											<?php
											if ($flag_update==1)
											{
												foreach($survey_answers as $survey_answer_item)
												{
													if ($survey_answer_item['content']==$province_item['province_id'])
													{
														echo 'selected';
													}
												}
											}
											?>
										><?php echo $province_item['province_name']; ?></option>
										<?php endforeach ?>
									</select>
								</td>
							</tr>
						</table>
				<?php
						
						} /* print_r($survey_answer_template_sub); */
						break;
					case 'rt': // radio button + textbox
				?>
					<div>
						<input 
							type="radio" 
							name="<?php echo $survey_question[$i]['question_id'].'_ar' ?>" 
							id="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							value="<?php echo $answer_template[$j]['answer_template_id']?>" 
							<?php if ($survey_question[$i]['required']==1) echo 'required'; ?>
							<?php
							if ($flag_update==1)
							{
								foreach($survey_answers as $survey_answer_item)
								{
									if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
									{
										echo 'checked';
									}
								}
							}
							?>
						><?php echo $answer_template[$j]['label']?>
						<input 
							type="text" 
							style="input-medium" 
							id="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							name="<?php echo $survey_question[$i]['question_id'].'_rt' ?>"
							<?php
							if ($flag_update==1)
							{
								foreach($survey_answers as $survey_answer_item)
								{
									if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
									{
										echo 'value="'.$survey_answer_item['content'].'"';
									}
								}
							}
							?> 
						>
					</div>
				<?php	
						break;
						
					case 'ct': // checkbox + textbox
				?>
					<div>
						<input 
							type="checkbox" 
							name="<?php echo $survey_question[$i]['question_id'].'_ac[]' ?>" 
							id="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							value="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							<?php if ($survey_question[$i]['required']==1) echo 'required'; ?>
							<?php
							if ($flag_update==1)
							{
								foreach($survey_answers as $survey_answer_item)
								{
									if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
									{
										echo 'checked';
									}
								}
							}
							?>
						><?php echo $answer_template[$j]['label']?>
						<input 
							type="text" 
							style="input-medium" 
							id="<?php echo $answer_template[$j]['answer_template_id'] ?>" 
							name="<?php echo $answer_template[$j]['answer_template_id'].'_ct' ?>"
							<?php
							if ($flag_update==1)
							{
								foreach($survey_answers as $survey_answer_item)
								{
									if ($survey_answer_item['answer_template_id']==$answer_template[$j]['answer_template_id'])
									{
										echo 'value="'.$survey_answer_item['content'].'"';
									}
								}
							}
							?>
						>
					</div>
				<?php
						break;
				}
			} // end switch?>
			</div>
			<?php } // end for ?>
		</div>
	<div class="roundbottom" style="background: url(<?php echo img_url();?>do_survey/br.gif) no-repeat top right;"> 
		<img src="<?php echo img_url() ?>do_survey/bl.gif" alt="" width="15" height="15" class="corner"> 
	</div>
</div> 
	
	    <div class="lastbox">
			* Anh/Chị vui lòng kiểm tra lại thông tin sau đó click chọn "Đồng ý" để hoàn thành phiếu khảo sát.
		</div>

		<div class="formEnd">
			<span class="submit"><input type="submit" value="Lưu phiếu khảo sát" /></span>
			<span class="submit"><a href="<?php echo base_url('survey_result/result_filter/'.$faculty_id.'/'.$survey['survey_id'].'/'.$type_id) ?>">Quay lại danh sách Sinh viên</a></span>
		</div>
		<hr />
		<div class="bottom">
			<p class="bottomTitle">Trường Đại học Dân lập Văn Lang </p>
		    Trụ sở: 45 Nguyễn Khắc Nhu, Q1, TP. HCM - ĐT: (84.8) 3836 1412 - 3836 7933   |  CS. 2: 233A Phan Văn Trị , P.11, Q. Bình Thạnh
		</div>
	</div> <!-- wrapper-->
		
		<!-- Note -->
		<div class="feedback">
			<a id="feedback_button">Ghi chú</a>
			
			<div class="form">
				<h2>Phần ghi chú của phiếu</h2>
				<textarea id="note_text" name="note_text"></textarea>
				<div id="reset_note" style="display:block;background: red; cursor: pointer; padding: 5px; width: 70px; height: 20px; color: #FFFFFF; text-align: center; margin: 5px; font-size: 13px">Xoá ghi chú</div>
			</div>
		</div>
		<!-- End note -->
		
		</form>
	</body>
</html>
<!-- JAVASCRIPT -->
<script type="text/javascript">
	$(window).load(function(){
		init_data();
		$("#my_form").validate({
			rules: {
				email_address: {
					required: true,
					email: true
				}
			}
		});
		
		$("#reset_note").click(function(){
			$("#note_text").val("");
			$("#note_text").focus();
		});
		<?php
		for ($i=0,$len_q=count($survey_question);$i<$len_q;$i++)
		{
			$answer_template = $survey_answer_template[$survey_question[$i]['question_id']];
			for($j=0,$len_a=count($answer_template);$j<$len_a;$j++)
			{
				if($answer_template[$j]['is_effect']==1)
				{
					// Script An/Hien
					?>
					$('#<?php echo $answer_template[$j]['answer_template_id'] ?>').click(function(){ 
					<?php
						foreach($question_relation as $relation)
						{
							if ($relation['answer_template_id']==$answer_template[$j]['answer_template_id'])
							{
								$attr = 'show()';
								if($relation['attribute']==1) 
								{
									$attr = 'show("slow")'; 
									?>
									$.ajax(
									{
										url:"<?php echo base_url('do_survey/get_answer_for_question').'/'.$relation['question_id'] ?>",
										type: "POST",
										dataType: "json",
										success: function(data){
											if (data!=null){
												for (var i=0;i<data.length;i++)
												{
													switch (data[i]['option_type'])
													{
														case 'r':
															if (data[i]['required']==1) 
															$("#"+data[i]['answer_template_id']+"").attr("required",'required');
															break;
														case 'c':
															if (data[i]['required']==1)
															$("#"+data[i]['answer_template_id']+"").attr('required','required');
															break;
														case 't':
															if (data[i]['required']==1)
															$("#"+data[i]['answer_template_id']+"").attr("required",'required');
															break;	
														case 'rt':
															if (data[i]['required']==1)
															$("#"+data[i]['answer_template_id']+"").attr("required",'required');
															break;
														case 'ct':
															if (data[i]['required']==1)
															$("#"+data[i]['answer_template_id']+"").attr('required','required');
															break;
													}
												}
											}
										}
									});
									<?php
								}
								else
								{ 
									$attr = 'hide("slow")';
									?>
									$.ajax(
									{
										url:"<?php echo base_url('do_survey/get_answer_for_question').'/'.$relation['question_id'] ?>",
										type: "POST",
										dataType: "json",
										success: function(data){
											if (data!=null){
												for (var i=0;i<data.length;i++)
												{
													switch (data[i]['option_type'])
													{
														case 'r':
															$("#"+data[i]['answer_template_id']+"").prop('checked',false);
															$("#"+data[i]['answer_template_id']+"").removeAttr("required");
															break;
														case 'c':
															$("#"+data[i]['answer_template_id']+"").attr('checked',false);
															$("#"+data[i]['answer_template_id']+"").removeAttr("required");
															break;
														case 't':
															$("#"+data[i]['answer_template_id']+"").val('');
															$("#"+data[i]['answer_template_id']+"").removeAttr("required");
															break;	
														case 'rt':
															$("#"+data[i]['answer_template_id']+"").attr('checked',false);
															$("#"+data[i]['answer_template_id']+"").removeAttr("required");
															break;
														case 'ct':
															$("#"+data[i]['answer_template_id']+"").attr('checked',false);
															$("#"+data[i]['answer_template_id']+"").removeAttr("required");
															break;
													}
												}
											}
										}
									});
									<?php
								}
								echo "$('#".$relation['question_id']."').".$attr.";";
							}
						}
					?>
					});
					<?php
					
				}
			}
		} 	
		?>
		
		// button kiem tra thong tin sinh vien
		$("#check_student_id").click(function(){
			$.ajax({
				url:"<?php echo base_url('do_survey/get_student_infor').'/'.$survey['survey_id'].'/' ?>"+$("#student_id").val(),
				type: "POST",
				dataType: "json",
				success: function(data){
					if (data!=null){
						$("#name").val($.trim(data['first_name'])+' '+$.trim(data['last_name']));
						$("#class").val(data['class_id']);
						$("#graduated_year").val(data['graduated_year']);
						$("#address").val(data['contact_address']);
						$("#faculty option").each(function(){
							if($(this).val()!=data['faculty_id']) $(this).remove();
						});
						$("#home_phone").val(data['phone']);
						$("#hand_phone").val(data['hand_phone']);
						$("#email_address").val(data['email']);
					}
				}
			});
		});
		
	});
	
	function init_data()
	{
		$.ajax({
			url:"<?php echo base_url('do_survey/get_student_infor').'/'.$survey['survey_id'].'/'.$student_id ?>",
			type: "POST",
			dataType: "json",
			success: function(data){
				if (data!=null){
					$("#student_id").val(data['student_id']);
					$("#name").val($.trim(data['first_name'])+' '+$.trim(data['last_name']));
					$("#class").val(data['class_id']);
					$("#graduated_year").val(data['graduated_year']);
					$("#address").val(data['contact_address']);
					$("#faculty option").each(function(){
						if($(this).val()!=data['faculty_id']) $(this).remove();
					});
					$("#home_phone").val(data['phone']);
					$("#hand_phone").val(data['hand_phone']);
					$("#email_address").val(data['email']);
					$("#note_text").val(data['note']);

					if (<?php echo $flag_update ?>)
						$("#select_survey_type").val(data['type_id']);
				}
			}
		});
	}
</script>
