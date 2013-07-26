<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta content="text/html; charset=utf-8" http-equiv="content-type" />
	<title>Form</title>
	<link href="<?php echo css_url() ?>StyleSheet.css" rel="stylesheet" type="text/css" />
	<!-- jQuery -->
	<script src="<?php echo js_url() ?>jquery.min.js"></script>
</head>
<body>
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
  
  <form class="form" name="form_question_answer">
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
					<input type="radio" name="<?php echo $survey_question[$i]['question_id'].'_a' ?>" id="<?php echo $answer_template[$j]['answer_template_id'] ?>"><?php echo $answer_template[$j]['label']?>
					<br />
			<?php
					break;
				case 'c': // checkbox
			?>
					<input type="checkbox" name="<?php echo $survey_question[$i]['question_id'].'_a' ?>" id="<?php echo $answer_template[$j]['answer_template_id'] ?>"><?php echo $answer_template[$j]['label']?>
					<br />
			<?php
					break; // text
				case 't':
					if ($answer_template[$j]['sub_answer']==0)
					{
			?>
						<p><?php echo $answer_template[$j]['label']?></p>
						<p class="longInput">
							<input type="text" name="<?php echo $answer_template[$j]['answer_template_id']?>" id="<?php echo $answer_template[$j]['answer_template_id']?>" >
						</p>
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
				            <td class="longInput"><input type="text" name="<?php echo $answer_template[$j]['answer_template_id']?>" id=""<?php echo $answer_template[$j]['answer_template_id']?>""></td>
				            <td class="city">
				            	<select class="chosen-select" id='<?php echo $survey_answer_template_sub[$answer_template[$j]['answer_template_id']][0]['answer_template_id'] ?>'>
								<?php foreach ($provinces as $province_item):?>
								<option value='<?php echo $province_item['province_id']; ?>'><?php echo $province_item['province_name']; ?></option>
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
					<p>
					<input type="radio"><?php echo $answer_template[$j]['label']?>
					<input type="text" style="input-medium">
					</p>
			<?php	
					break;
					
				case 'ct': // checkbox + textbox
			?>
					<p>
					<input type="checkbox"><?php echo $answer_template[$j]['label']?>
					<input type="text" style="input-medium">
					</p>
			<?php
					break;
			}
		} // end switch?>
	</div>
	<?php
	} // end for
	?>
	</form> 
  </div>
  <div class="roundbottom" style="background: url(<?php echo img_url();?>do_survey/br.gif) no-repeat top right;"> 
  	<img src="<?php echo img_url() ?>do_survey/bl.gif" alt="" width="15" height="15" class="corner"> 
  </div>
</div> 
	
    <div class="lastbox">
		* Anh/Chị vui lòng kiểm tra lại thông tin sau đó click chọn "Đồng ý" để hoàn thành phiếu khảo sát.
	</div>

<form class="formEnd">
	<span class="submit"><input type="submit" value="Đồng ý" /></span>
</form>
<hr />
<div class="bottom">
	<p class="bottomTitle">Trường Đại học Dân lập Văn Lang </p>
    Trụ sở: 45 Nguyễn Khắc Nhu, Q1, TP. HCM - ĐT: (84.8) 3836 1412 - 3836 7933   |  CS. 2: 233A Phan Văn Trị , P.11, Q. Bình Thạnh
</div>
</div> <!-- wrapper-->
<!-- JAVASCRIPT -->
<script type="text/javascript">
	$(document).ready(function(){
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
								if($relation['attribute']==1) $attr = 'show("slow")'; else $attr = 'hide("slow")';
								echo "$('#".$relation['question_id']."').".$attr.";";
							}
						}
					?>
					});
					<?
					
				}
			}
		} 
			
		?>
	});
</script>
</body>
</html>
