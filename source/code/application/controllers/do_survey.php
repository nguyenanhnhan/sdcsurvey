<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Do_survey extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array ('ion_auth', 'form_validation', 'session', 'uuid'));
		$this->load->helper(array('url', 'date', 'file', 'form'));
	}
	
	function index($faculty_id, $survey_id, $student_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model','design_template_model', 
			'survey_question_model', 'survey_answer_template_model', 'survey_answer_relation_model', 
			'survey_answer_model', 'province_model', 'infor_model'));
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get(FALSE, $survey_id);
			
			// Lay cac mau cau hoi va cau tra loi tuong ung voi phieu khao sat
			$data['survey_question'] = $this->survey_question_model->get($survey_id);
			
			// Lay cau tra loi tuong ung voi cau hoi
			$data['survey_answer_template'] = NULL;
			for ($i = 0, $len = count($data['survey_question']); $i < $len ; $i++)
			{
				$data['survey_answer_template'][$data['survey_question'][$i]['question_id']] = $this->survey_answer_template_model->get($data['survey_question'][$i]['question_id']);
			}
			
			// Lay cau tra loi la sub cua cau tra loi kia
			$data['survey_answer_template_sub'] = NULL;
			for ($i=0, $len_q=count($data['survey_question']); $i<$len ; $i++)
			{
				$answer_template_array = $data['survey_answer_template'][$data['survey_question'][$i]['question_id']];
				for ($j=0, $len_a=count($answer_template_array); $j<$len_a; $j++)
				{
					if ($answer_template_array[$j]['sub_answer'] == 1)
					{
						$data['survey_answer_template_sub'][$answer_template_array[$j]['answer_template_id']] = $this->survey_answer_template_model->get($answer_template_array[$j]['answer_template_id']);
					}
				}
			}
			
			// Lay cac cau hoi co lien he voi cau tra loi
			$data['question_relation']          = $this->survey_answer_relation_model->get_all();
			$data['distinct_question_relation'] = $this->survey_answer_relation_model->get_distinct();
			
			// Du lieu Tinh/Than
			$data['provinces'] = $this->province_model->get();
			
			// Lay mau design nhap thong tin
			$template             = $this->design_template_model->get_design_template($data['survey']['design_template_id']);
			$read_content         = read_file($template['template_link']);
			$data['read_content'] = $read_content;
			
			// Ma sinh vien
			$data['student_id'] = $student_id;
			
			// Dat co kiem tra thong tin, neu co san tren bang infor thi du lieu nay chi can update
			$data_student_temp = $this->infor_model->get_student_infor($survey_id, $student_id);
			if (!empty($data_student_temp)) $data['flag_update'] = 1;
			else $data['flag_update'] = 0;
			
			// neu day la du lieu update, tien hanh lay du lieu khao sat
			if ($data['flag_update']==1)
			{
				$data['survey_answers']=$this->survey_answer_model->get($data_student_temp['infor_id']);
			}
			
			$this->load->view('do_survey/index', $data);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function save($survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model', 
			'survey_answer_template_model', 'survey_answer_relation_model', 'province_model', 'infor_model', 'survey_answer_model'));
			
			// LAY THONG TIN NGUOI PHU TRACH KHAO SAT
			$user = $this->ion_auth->user()->row();
			$user_name = $user->username;
			
			// LAY THONG TIN NHAP
			$data['student_infor']['student_id'] = $this->input->post('student_id');
			$data['student_infor']['type_id']    = '0334bd35-9ae4-4922-948b-65354ad2fe1e'; // Set cung: Khao sat qua dien thoai
			
			// Tach ho va ten
			$full_name                           = explode(" ",trim($this->input->post('name')));
			$data['student_infor']['first_name'] = NULL;
			$data['student_infor']['last_name']  = NULL;
			for ($i=0,$len=count($full_name);$i<$len-1;$i++)
			{
				$data['student_infor']['first_name'].=$full_name[$i].' ';
			}
			$data['student_infor']['last_name']=end($full_name);
			
			$data['student_infor']['class_id']       = $this->input->post('class');
			$data['student_infor']['graduated_year'] = $this->input->post('graduated_year');
			$data['student_infor']['address']        = $this->input->post('address');
			$data['student_infor']['faculty_id']     = $this->input->post('faculty');
			$data['student_infor']['home_phone']     = $this->input->post('home_phone');
			$data['student_infor']['hand_phone']     = $this->input->post('hand_phone');
			$data['student_infor']['email_address']  = $this->input->post('email_address');
			
			$hiden_update_flag = $this->input->post('hiden_update_value');
			if ($hiden_update_flag==0) // Tao moi thong tin
			{
				// LUU THONG TIN NHAP
				$infor_id = $this->uuid->v4();
				$result_ins = $this->infor_model->staff_insert($user_name,$infor_id,$survey_id, $data['student_infor']);
				// KET THUC LUU THONG TIN NHAP
				
				// LAY THONG TIN KHAO SAT
				$data['survey_questions'] = $this->survey_question_model->get($survey_id);
				if (!empty($data['survey_question'])==NULL)
				{
					for ($i=0,$len=count($data['survey_questions']);$i<$len;$i++)
					{
						$question = $data['survey_questions'][$i];
						$answer_templates = $this->survey_answer_template_model->get($question['question_id'],FALSE);
						
						// Cau tra loi dau tien co dang Radio Button hoac Radio Button + Text Box
						if ($answer_templates[0]['option_type']=='r' || $answer_templates[0]['option_type']=='rt')
						{
							$data_temp = $this->input->post($question['question_id'].'_ar');
							if (!empty($data_temp))
							{
								$answ_temp=$this->survey_answer_template_model->get_answer_template($data_temp);
								if ($answ_temp['option_type']=='rt')
								{
									$data_text=$this->input->post($question['question_id'].'_rt');
									$this->survey_answer_model->staff_insert($user_name, $infor_id, $question['question_id'], $answ_temp['answer_template_id'],$data_text);
								}
								else
								{
									$this->survey_answer_model->staff_insert($user_name, $infor_id, $question['question_id'], $data_temp, 'TRUE');
								}
								
							}
						}
						
						// Cau tra loi dau tien co dang Checkbox Button hoac Checkbox Button + Text Box
						if ($answer_templates[0]['option_type']=='c' || $answer_templates[0]['option_type']=='ct')
						{
							$data_temp = $this->input->post($question['question_id'].'_ac');
							
							if (!empty($data_temp))
							{
								for ($j=0,$len=count($data_temp);$j<$len;$j++)
								{
									$answr_temp=$this->survey_answer_template_model->get_answer_template($data_temp[$j]);
									if ($answr_temp['option_type']=='ct')
									{
										$data_text=$this->input->post($answr_temp['answer_template_id'].'_ct');
										$this->survey_answer_model->staff_insert($user_name, $infor_id, $question['question_id'],$data_temp[$j],$data_text);
									}
									else
									{
										$this->survey_answer_model->staff_insert($user_name,$infor_id,$question['question_id'],$data_temp[$j], 'TRUE');
									}
								}
							}
						}
						
						// Cau tra loi dau tien co dang Text
						if ($answer_templates[0]['option_type']=='t')
						{
							foreach ($answer_templates as $answer_template_item)
							{
								$data_text = $this->input->post($answer_template_item['answer_template_id'].'_at');
								if(!empty($data_text))
								{
									$this->survey_answer_model->staff_insert($user_name,$infor_id,$question['question_id'],$answer_template_item['answer_template_id'],$data_text);
									// kiem tra xem cau tra loi tren co cau tra loi con hay khong
									$answ_temp=$this->survey_answer_template_model->get_answer_template($answer_template_item['answer_template_id']);
									if ($answ_temp['sub_answer']==1)// Co
									{
										// Lay cau tra loi co ma cau hoi la cau tra loi parrent
										$data_sub=$this->survey_answer_template_model->get($answ_temp['answer_template_id'],FALSE);
										$data_sub_text=$this->input->post($data_sub[0]['answer_template_id']);
										// Them vao db
										$this->survey_answer_model->staff_insert($user_name,$infor_id,$answer_template_item['answer_template_id'],$data_sub[0]['answer_template_id'],$data_sub_text);
									}
								}
							}
							
						}
					}
				}
			}
			else // Cap nhat thong tin
			{
				// Lay infor_id
				$infor_surveyed = $this->infor_model->get_student_infor($survey_id, $data['student_infor']['student_id']);
				// CAP NHAT LAI THONG TIN SINH VIEN KHAO SAT
				$this->infor_model->staff_update($user_name,$infor_surveyed['infor_id'],$survey_id,$data['student_infor']);
				$infor_id = $infor_surveyed['infor_id'];
				
				// CAP NHAT LAI THONG TIN CAU TRA LOI
				/*
$data['survey_questions'] = $this->survey_question_model->get($survey_id);
				if (!empty($data['survey_question'])==NULL)
				{
					for ($i=0,$len=count($data['survey_questions']);$i<$len;$i++)
					{
						$question = $data['survey_questions'][$i];
						$answer_templates = $this->survey_answer_template_model->get($question['question_id'],FALSE);
						
						// Cau tra loi dau tien co dang Radio Button hoac Radio Button + Text Box
						if ($answer_templates[0]['option_type']=='r' || $answer_templates[0]['option_type']=='rt')
						{
							
							// Them moi
							$data_temp = $this->input->post($question['question_id'].'_ar');
							if (!empty($data_temp))
							{
								$answ_temp=$this->survey_answer_template_model->get_answer_template($data_temp);
								if ($answ_temp['option_type']=='rt')
								{
									$data_text=$this->input->post($question['question_id'].'_rt');
									$this->survey_answer_model->staff_insert($user_name, $infor_surveyed['infor_id'], $question['question_id'], $answ_temp['answer_template_id'],$data_text);
								}
								else
								{
									
									$this->survey_answer_model->staff_insert($user_name, $infor_id, $question['question_id'], $data_temp, 'TRUE');
								}
								
							}
						}
						
						// Cau tra loi dau tien co dang Checkbox Button hoac Checkbox Button + Text Box
						if ($answer_templates[0]['option_type']=='c' || $answer_templates[0]['option_type']=='ct')
						{
							
							// Them moi
							$data_temp = $this->input->post($question['question_id'].'_ac');
							
							if (!empty($data_temp))
							{
								for ($j=0,$len=count($data_temp);$j<$len;$j++)
								{
									$answr_temp=$this->survey_answer_template_model->get_answer_template($data_temp[$j]);
									if ($answr_temp['option_type']=='ct')
									{
										$data_text=$this->input->post($answr_temp['answer_template_id'].'_ct');
										$this->survey_answer_model->staff_insert($user_name, $infor_id, $question['question_id'],$data_temp[$j],$data_text);
									}
									else
									{
										$this->survey_answer_model->staff_insert($user_name,$infor_id,$question['question_id'],$data_temp[$j], 'TRUE');
									}
								}
							}
						}
						
						// Cau tra loi dau tien co dang Text
						if ($answer_templates[0]['option_type']=='t')
						{
							foreach ($answer_templates as $answer_template_item)
							{
								// THEM MOI
								$data_text = $this->input->post($answer_template_item['answer_template_id'].'_at');
								if(!empty($data_text))
								{
									$this->survey_answer_model->staff_insert($user_name,$infor_id,$question['question_id'],$answer_template_item['answer_template_id'],$data_text);
									// kiem tra xem cau tra loi tren co cau tra loi con hay khong
									$answ_temp=$this->survey_answer_template_model->get_answer_template($answer_template_item['answer_template_id']);
									if ($answ_temp['sub_answer']==1)// Co
									{
										// Lay cau tra loi co ma cau hoi la cau tra loi parrent
										$data_sub=$this->survey_answer_template_model->get($answ_temp['answer_template_id'],FALSE);
										$data_sub_text=$this->input->post($data_sub[0]['answer_template_id']);
										// Them vao db
										$this->survey_answer_model->staff_insert($user_name,$infor_id,$answer_template_item['answer_template_id'],$data_sub[0]['answer_template_id'],$data_sub_text);
									}
								}
							}
							
						}
					}
				}
*/
			}
		}
		else
		{
			redirect('auth');
		}
	}
		
	////////////////////
	// AJAX Function ///
	////////////////////
	function get_student_infor($survey_id,$student_id)
	{
		$this->load->model(array('student_model', 'infor_model'));
		
		$data['student_infor'] = NULL;
		// Uu tien lay thong tin sinh vien tren bang sur_infor truoc
		$data['student_infor'] = $this->infor_model->get_student_infor($survey_id, $student_id);
		if (empty($data['student_infor'])) $data['student_infor'] = $this->student_model->get_student_infor($survey_id, $student_id);
		
		echo json_encode($data['student_infor']);
	}
	
	function get_answer_for_question($question_id)
	{
		$this->load->model(array('survey_answer_template_model'));
		
		$data['answer_for_question']=$this->survey_answer_template_model->get($question_id,FALSE);
		echo json_encode($data['answer_for_question']);
	}
}