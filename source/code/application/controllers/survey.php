<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Survey extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation', 'session', 'uuid'));
		$this->load->helper(array('url', 'date', 'file'));
	}
	
	function index($stype_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model','survey_model'));
			
			$data['surveys']      = $this->survey_model->get($stype_id);
			$data['survey_type']  = $this->survey_type_model->get($stype_id);
			
			$user                 = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin']     = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/list', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect ('auth');
		}
	}
	
	// Tao Phieu khao sat - Buoc 1
	function create_step_1($stype_id)
	{
		if ($this->ion_auth->logged_in())
		{
			
			$this->load->model(array('survey_type_model', 'survey_model','faculty_model'));
			
			$data['survey_type'] = $this->survey_type_model->get($stype_id);
			
			// Lay nam tot nghiep
			$graduated_year_array = array("");
			for ($i = 1999; $i <= date('Y') - 1; $i++)
			{
				array_push($graduated_year_array, $i);
			}
			$data['graduated_years'] = $graduated_year_array;
			
			// Lay cac khoa dang hoc, chua tot nghiep
			$course_array         = array("");
			$count_graduated_year = count($graduated_year_array);
			for ($i = $count_graduated_year; $i <=$count_graduated_year+4; $i++)
			{
				array_push($course_array, $i);
			}
			$data['courses_learning'] = $course_array;
			
			// Lay cac mau khao sat truoc co cung loai khao sat
			$data['surveys']          = $this->survey_model->get($stype_id);
			
			// Lay tat ca cac khoa ban
			$data['faculties']        = $this->faculty_model->get();
			
			$user                 = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin']     = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/create_step_1', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect ('auth');
		}
	}
	
	// Ham them phieu khao sat khi tao moi
	function add()
	{
		if ($this->ion_auth->logged_in())
		{
		
			$this->load->model(array('survey_model', 'survey_faculty_model', 'survey_question_model', 'survey_answer_template_model'));
			
			$survey_id                   = $this->uuid->v4();
			$survey_name                 = $this->input->post('survey_name');
			$survey_modified_char_report = $this->input->post("modified_char_report");
			$reused_survey_id            = $this->input->post('reuse');
			$survey_type_id              = $this->input->post('hidden_stype_id');
			$course                      = $this->input->post('course');
			$graduated_year              = $this->input->post('graduated_year');
			$is_graduated                = (bool)$this->input->post('is_graduated');
			$is_vocation                 = (bool)$this->input->post('is_vocation');
			
			$array_sdate                 = explode('/', $this->input->post('start_date'));
			$start_date                  = $array_sdate[2].'/'.$array_sdate[1].'/'.$array_sdate[0];
			
			$array_edate                 = explode('/', $this->input->post('end_date'));
			$end_date                    = $array_edate[2].'/'.$array_edate[1].'/'.$array_edate[0];
			
			$is_evaluated                = (bool)$this->input->post('is_evaluated');
			
			// Lay thong tin cac Khoa/Ban duoc phep su dung mau khao sat
			$survey_faculties['data'] = NULL;
			if ($is_vocation==1)
			{
				if (empty($this->input->post['survey_faculty_vocation']) != NULL)
					$survey_faculties['data'] = $this->input->post('survey_faculty_vocation');
			}
			else 
			{
				if (empty($this->input->post['survey_faculty']) != NULL)
					$survey_faculties['data'] = $this->input->post('survey_faculty');
			}
		
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$uid = $user->id;
			
			$this->survey_model->add($uid,$survey_id,$survey_type_id,$reused_survey_id, $survey_name, $survey_modified_char_report, $course, 
			$graduated_year, $is_graduated, $start_date, $end_date, $is_vocation, $is_evaluated);
			
			// Them vao bang sur_survey_faculty nham phan quyen khao sat cho tung khoa/ban
			if (!empty($survey_faculties['data']))
			{
				for($i=0, $len = count($survey_faculties['data']); $i < $len; $i++)
				{
					$this->survey_faculty_model->insert($uid, $survey_id, $survey_faculties['data'][$i]);
				}
			}
/* 			redirect ('survey/index/'.$survey_type_id); */

			if (!empty($reused_survey_id))
			{
				$cp_questions = $this->survey_question_model->get($reused_survey_id, FALSE);
				foreach ($cp_questions as $cp_question)
				{
					// sao chep cau hoi
					$question_id = $this->uuid->v4(); // xac dinh question id
					
					$data_question = array (
						"question_id"         => $question_id,
						"reused_question_id"  => $cp_question["question_id"],
						"survey_id"           => $survey_id,
						"content"             => $cp_question["content"],
						"view_order"          => $cp_question["view_order"],
						"max_option"          => $cp_question["max_option"],
						"start_hide"          => $cp_question["start_hide"],
						"required"            => $cp_question["required"],
						"view_style"          => $cp_question["view_style"],
						"is_vocation"         => $cp_question["is_vocation"],
						"is_validated"        => $cp_question["is_validated"],
						"is_evaluated"        => $cp_question["is_evaluated"],
						"is_deleted"          => $cp_question["is_deleted"],
						"flag_working"        => $cp_question["flag_working"],
						"flag_underwork"      => $cp_question["flag_underwork"],
						"created_by_user_id"  => $uid
					);
					if ($this->survey_question_model->insert_v2($data_question))
					{
						// Sao chep cau tra loi mau
						// lay tat ca cau tra loi mau cua cau hoi dung lai
						$cp_answers = $this->survey_answer_template_model->get($cp_question["question_id"]);
						
						foreach ($cp_answers as $cp_answer)
						{
							$answer_template_id = $this->uuid->v4();
							$data_answer = array (
								"answer_template_id"        => $answer_template_id,
								"reused_answer_template_id" => $cp_answer["answer_template_id"],
								"question_id"               => $question_id,
								"option_type"               => $cp_answer["option_type"],
								"view_order"                => $cp_answer["view_order"],
								"label"                     => $cp_answer["label"],
								"exception"                 => $cp_answer["exception"],
								"required"                  => $cp_answer["required"],
								"sub_answer"                => $cp_answer["sub_answer"],
								"is_deleted"                => $cp_answer["is_deleted"],
								"created_by_user_id"        => $uid
							);
							
							if ($this->survey_answer_template_model->insert_v2($data_answer))
							{
								if ($cp_answer["sub_answer"] == TRUE)
								{
									$cp_sub_answers = $this->survey_answer_template_model->get($cp_answer["answer_template_id"]);
									
									foreach ($cp_sub_answers as $cp_sub_answer)
									{
										$data_sub_answer = array (
											"answer_template_id"        => $this->uuid->v4(),
											"reused_answer_template_id" => $cp_sub_answer["answer_template_id"],
											"question_id"               => $answer_template_id,
											"option_type"               => $cp_sub_answer["option_type"],
											"view_order"                => $cp_sub_answer["view_order"],
											"label"                     => $cp_sub_answer["label"],
											"exception"                 => $cp_sub_answer["exception"],
											"required"                  => $cp_sub_answer["required"],
											"sub_answer"                => $cp_sub_answer["sub_answer"],
											"is_deleted"                => $cp_sub_answer["is_deleted"],
											"created_by_user_id"        => $uid
										);
										$this->survey_answer_template_model->insert_v2($data_sub_answer);
									}
								}// end copy sub answer template
							}
						}// end copy answer template
					}// end copy question
				}
			}// end process reuse template
			redirect ('survey/edit_step_2/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect ('auth');
		}
		
	}
	
	// Ham xoa phieu khao sat
	function delete($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model'));
			
			$survey_data = $this->survey_model->get($survey_type_id, $survey_id);
			
			if ($survey_data["status"]==FALSE)
			{
				// Tien hanh xao data trong bang sur_survey
				$this->survey_model->delete($survey_id);
			}
			
			redirect ('survey/index/'.$survey_type_id);
		}
		else
		{
			redirect ('auth');
		}
	}
	
	// Ham chinh sua buoc 1, chi view noi dung len view
	function edit_step_1($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model', 'survey_model', 'faculty_model', 'survey_faculty_model'));
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay nam tot nghiep
			$graduated_year_array = array("");
			for ($i = 1999; $i <= date('Y') - 1; $i++)
			{
				array_push($graduated_year_array, $i);
			}
			$data['graduated_years'] = $graduated_year_array;
			
			// Lay cac khoa dang hoc, chua tot nghiep
			$course_array = array("");
			$count_graduated_year = count($graduated_year_array);
			for ($i = $count_graduated_year; $i <=$count_graduated_year+4; $i++)
			{
				array_push($course_array, $i);
			}
			$data['courses_learning'] = $course_array;
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			// Lay tat ca cac khoa ban
			$data['faculties'] = $this->faculty_model->get();
			
			// Lay danh sach cac khoa duoc ap dung phieu khao sat
			$data['survey_faculties'] = $this->survey_faculty_model->get($survey_id);
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();

			if ($data["survey"]["status"]==FALSE)
			{
				$this->load->view('templates/header',$data);
				$this->load->view('survey/edit_step_1',$data);
				$this->load->view('templates/footer');
			}
			else
			{
				redirect ('survey/index/'.$survey_type_id);
			}
		}
		else
		{
			redirect ('auth');
		}
	}
	
	// Ham cap nhat buoc 1
	function update_step_1($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model', 'survey_model', 'survey_faculty_model'));
			
			// Lay tat ca thong tin tren form
			$survey_name    = $this->input->post('survey_name');
			$course         = $this->input->post('course');
			$graduated_year = $this->input->post('graduated_year');
			$is_graduated   = (bool)$this->input->post('is_graduated');
			$is_vocation    = (bool)$this->input->post('is_vocation');
			
			$array_sdate    = explode('/', $this->input->post('start_date'));
			$start_date     = $array_sdate[2].'/'.$array_sdate[1].'/'.$array_sdate[0];
			
			$array_edate    = explode('/', $this->input->post('end_date'));
			$end_date       = $array_edate[2].'/'.$array_edate[1].'/'.$array_edate[0];
			
			$is_evaluated   = (bool)$this->input->post('is_evaluated');
		
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay thong tin cac Khoa/Ban duoc phep su dung mau khao sat
			$survey_faculties['data'] = NULL;
			if ($is_vocation==1)
			{
				if (empty($this->input->post['survey_faculty_vocation']) != NULL)
					$survey_faculties['data'] = $this->input->post('survey_faculty_vocation');
			}
			else 
			{
				if (empty($this->input->post['survey_faculty']) != NULL)
					$survey_faculties['data'] = $this->input->post('survey_faculty');
			}
			// Tien hanh cap nhat
			$this->survey_model->update_step_1($uid, $survey_id, $survey_name, $course, $graduated_year, $is_graduated, 
			$is_vocation, $start_date, $end_date, $is_evaluated);
			
			// Tien hanh cap nhat trong bang sur_survey_faculty
			// Xoa tat ca data lien quan
			$this->survey_faculty_model->delete($survey_id);
			// Chen them data moi vao bang sur_survey_faculty
			if (!empty($survey_faculties['data']))
			{
				for($i=0, $len = count($survey_faculties['data']); $i < $len; $i++)
				{
					$this->survey_faculty_model->insert($uid, $survey_id, $survey_faculties['data'][$i]);
				}
			}
			redirect ('survey/edit_step_2/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect ('auth');
		}
	}
	
	function edit_step_2($survey_type_id, $survey_id)
	{
		if($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model','design_template_model','survey_type_model'));
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			// Lay mau nhap thong tin sinh vien
			$data['design_templates'] = $this->design_template_model->get();
			
			$user                     = $this->ion_auth->user()->row();
			$data['display_name']     = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin']         = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/edit_step_2',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect ('auth');
		}
	}
	
	function update_step_2($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model','design_template_model','survey_type_model'));
			
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay tat ca thong tin tren form
			$design_template_id = $this->input->post('design_template');
			
			// lay data cua phieu
			$survey_data = $this->survey_model->get($survey_type_id, $survey_id);
			
			if ($surve_data["status"]==FALSE)
			{
				// Cap nhat vao bang sur_survey
				$this->survey_model->update_step_2($uid, $survey_id, $design_template_id);
			}
			
			redirect('survey/edit_step_3/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function edit_step_3($survey_type_id, $survey_id)
	{
		if($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model','survey_type_model', 'survey_question_model', 'survey_answer_template_model', 'province_model'));
			
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type']     = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey']          = $this->survey_model->get($survey_type_id, $survey_id);
			
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
			
			// Du lieu Tinh/Than
			$data['provinces']      = $this->province_model->get();
			
			// Lay max view order
			$data['max_view_order'] = $this->survey_question_model->get_max_view_order($survey_id);
			
			$data['display_name']   = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin']       = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/edit_step_3',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function update_step_3($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model', 'survey_answer_template_model'));
			
			// Lay thong tin tren form
			$question_id        = $this->uuid->v4();
			$reused_question_id = FALSE;
			$content            = $this->input->post('survey_question');
			$view_order         = $this->input->post('view_order');
			$start_hide         = (bool)$this->input->post('is_hide');
			$required           = (bool)$this->input->post('is_required');
			$view_style         = 1;
			$is_validated       = 0;
			$is_evaluated       = 0;
			$answer_type        = $this->input->post('answer_type');
						
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay thong tin cac mau cau tra loi
			$control['dyn_control']       = $this->input->post('dyn_control');
			$control['dyn_other_control'] = $this->input->post('dyn_other_control');
			
			// Dem tong so lua chon tra loi
			$max_option = 0;
			if (!empty($control['dyn_control'])) $max_option       += count($control['dyn_control']);
			if (!empty($control['dyn_other_control'])) $max_option += count($control['dyn_other_control']);
			
			// Them cau hoi vao bang sur_question
			$result = $this->survey_question_model->insert($uid, $question_id, $reused_question_id, $survey_id, $content, $view_order, $max_option, $start_hide, $required, $view_style, $is_validated, $is_evaluated);
			
			// Them cau tra loi vao bang sur_answer_template
			if ($result)
			{
				// Them lua chon chuan
				$option_type = $answer_type;
				$c_count     = 0;
				for ($i = 0, $len = count($control['dyn_control']); $i < $len; $i++)
				{
					$c_count++;
					$answer_template_id = $this->uuid->v4();
					$label              = $control['dyn_control'][$i];
					$view_order         = $c_count;
					$exception          = 0;
					$answ_required      = $required;
					$sub_answer         = 0;
					$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception,$answ_required, $sub_answer);
				}
				
				// Them lua chon khac chuan
				if(!empty($control['dyn_other_control']))
				{
					for ($i = 0, $len = count($control['dyn_other_control']); $i < $len; $i++)
					{
						$other_option_type = NULL;
						if ($option_type == 'r') $other_option_type = 'rt';
						else 
						{
							if ($option_type == 'c') $other_option_type = 'ct';
							else $other_option_type = 'pr';
						}
						
						// Them lua chon khac, neu option type = r hoac c
						if ($option_type == 'r' || $option_type == 'c')
						{
							$c_count++;
							$answer_template_id = $this->uuid->v4();
							$label              = $control['dyn_other_control'][$i];
							$view_order         = $c_count;
							$exception          = 0;
							$answ_required      = $required;
							$sub_answer         = 0;
							$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $other_option_type, $view_order, $label, $exception, $answ_required, $sub_answer);
						}
						else
						{
							$c_count++;
							$answer_template_id = $this->uuid->v4();
							$label              = $control['dyn_other_control'][$i];
							$view_order         = $c_count;
							$exception          = 0;
							$answ_required      = $required;
							$sub_answer         = 1;
							// Chen truoc 1 cau tra loi dang van ban
							$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception, $answ_required, $sub_answer);
							
							// Chen cau tra loi Tinh/Thanh di chung voi cau tra loi van ban
							$question_sub_id    = $answer_template_id;
							$answer_template_id = $this->uuid->v4();
							$label              = "Tỉnh/Thành";
							$sub_answer         = 0;
							$answ_required      = 0;
							$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_sub_id, $other_option_type, $view_order, $label, $exception, $answ_required, $sub_answer);
						}
					}
				}
				
			}
			
			redirect('survey/edit_step_3/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function delete_question($survey_type_id, $survey_id, $question_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_question_model'));
			
			$this->survey_question_model->delete($question_id);
			
			redirect('survey/edit_step_3/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function edit_question($survey_type_id, $survey_id, $question_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model', 'survey_answer_template_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			// Lay cac cau hoi trong survey
			$data['question_survey'] = $this->survey_question_model->get($survey_id);
			
			// Lay cau hoi 
			$data['survey_question'] = $this->survey_question_model->get_question($question_id);
			
			// Lay cau tra loi tuong ung voi cau hoi
			$data['survey_answer_template'] = $this->survey_answer_template_model->get($question_id);
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/edit_question', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function update_question($survey_type_id, $survey_id, $question_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model', 'survey_answer_template_model'));
			
			// Lay thong tin tren form
			$reused_question_id  = FALSE;
			$content             = $this->input->post('survey_question');
			$start_hide          = (bool)$this->input->post('is_hide');
			$required            = (bool)$this->input->post('is_required');
			$view_style          = 1;
			$is_validated        = (bool)$this->input->post('is_validated');
			$is_evaluated        = (bool)$this->input->post('is_evaluated');
			$flag_working        = (bool)$this->input->post("flag_working");
			$flag_underwork      = (bool)$this->input->post("flag_underwork");
			$answer_type         = $this->input->post('answer_type');
			$view_order          = 0;
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay thong tin cac mau cau tra loi
			$control['dyn_control']       = $this->input->post('dyn_control');
			$control['dyn_other_control'] = $this->input->post('dyn_other_control');
			
			// Dem tong so lua chon tra loi
			$max_option = 0;
			if (!empty($control['dyn_control'])) $max_option += count($control['dyn_control']);
			if (!empty($control['dyn_other_control'])) $max_option += count($control['dyn_other_control']);
			
			// Cap nhat lai cau hoi
			$this->survey_question_model->update($uid, $survey_id, $question_id, $reused_question_id, $content,$view_order, $max_option, $start_hide, $required, $view_style, $is_validated, $is_evaluated, $flag_working, $flag_underwork);
			
			// Xoa cac mau cau tra loi cu
			$result      = $this->survey_question_model->delete_answer($question_id);
			
			// Them lua chon chuan
			$option_type = $answer_type;
			$c_count     = 0;
			
			for ($i = 0, $len = count($control['dyn_control']); $i < $len; $i++)
			{
				$c_count++;
				$answer_template_id = $this->uuid->v4();
				$label              = $control['dyn_control'][$i];
				$view_order         = $c_count;
				$exception          = 0;
				$answ_required      = $required;
				$sub_answer         = 0;
				$result = $this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception, $answ_required, $sub_answer);
			}
			// Them lua chon khac chuan
			if(!empty($control['dyn_other_control']))
			{
				for ($i = 0, $len = count($control['dyn_other_control']); $i < $len; $i++)
				{
					$other_option_type = NULL;
					if ($option_type == 'r') $other_option_type = 'rt';
					else 
					{
						if ($option_type == 'c') $other_option_type = 'ct';
						else $other_option_type = 'pr';
					}
					
					// Them lua chon khac, neu option type = r hoac c
					if ($option_type == 'r' || $option_type == 'c')
					{
						$c_count++;
						$answer_template_id = $this->uuid->v4();
						$label              = $control['dyn_other_control'][$i];
						$view_order         = $c_count;
						$exception          = 0;
						$answ_required      = $required;
						$sub_answer         = 0;
						$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $other_option_type, $view_order, $label, $exception, $answ_required, $sub_answer);
					}
					else
					{
						$c_count++;
						$answer_template_id = $this->uuid->v4();
						$label              = $control['dyn_other_control'][$i];
						$view_order         = $c_count;
						$exception          = 0;
						$answ_required      = $required;
						$sub_answer         = 1;
						// Chen truoc 1 cau tra loi dang van ban
						$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception, $answ_required, $sub_answer);
						
						// Chen cau tra loi Tinh/Thanh di chung voi cau tra loi van ban
						$question_sub_id    = $answer_template_id;
						$answer_template_id = $this->uuid->v4();
						$label              = "Tỉnh/Thành";
						$sub_answer         = 0;
						$answ_required      = 0;
						$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_sub_id, $other_option_type, $view_order, $label, $exception, $answ_required, $sub_answer);
					}
				}
			}
			redirect('survey/edit_step_3/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function edit_step_4($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model', 'survey_answer_template_model', 'province_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
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
			
			// Du lieu Tinh/Thanh
			$data['provinces']    = $this->province_model->get();
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin']     = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/edit_step_4',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function update_step_4($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey']      = $this->survey_model->get($survey_type_id, $survey_id);
			
			$sort_question       = $this->input->post('view_order');
			print_r($sort_question); die;
			// Sap xep lai cau hoi
			if (!empty($sort_question))
			{
				for ($i=0,$len=count($sort_question);$i<$len;$i++)
				{
					$this->survey_question_model->update_sort($uid, $sort_question[$i], $i+1);
				}
			}
			
			redirect ('survey/edit_step_4/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function edit_effect($survey_type_id, $survey_id, $question_id, $answer_template_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model', 'survey_answer_template_model', 'survey_answer_relation_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			// Lay cac mau cau hoi va cau tra loi tuong ung voi phieu khao sat
			$data['survey_question'] = $this->survey_question_model->get($survey_id);
			
			// Lay tat ca cac cau hoi ngoai tru no co view order lon hon no
			$data['survey_question_other'] = $this->survey_question_model->get_question_other($survey_id, $question_id);
			
			// Lay cau hoi tuong ung cau tra loi
			$data['question'] = $this->survey_question_model->get_question($question_id);
			
			// Lay thong tin cau tra loi can chinh hieu ung
			$data['asnwer_template_item'] = $this->survey_answer_template_model->get_answer_template($answer_template_id);

			// Lay cac cau hoi co lien he voi cau tra loi
			$data['question_relation'] = $this->survey_answer_relation_model->get($answer_template_id);
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/edit_effect',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function add_effect($survey_type_id, $survey_id, $question_id, $answer_template_id)
	{
		if($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'survey_question_model', 'survey_answer_template_model', 'survey_answer_relation_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay du lieu tren form
			$data['hide_control'] = $this->input->post('survey_question_hide');
			$data['show_control'] = $this->input->post('survey_question_show');
			$this->survey_answer_relation_model->delete($answer_template_id);
			
			if(!empty($data['hide_control']))
			{
				$this->survey_answer_template_model->update_effect($uid, $answer_template_id,1);
				for ($i=0,$len=count($data['hide_control']);$i<$len;$i++)
				{
					$this->survey_answer_relation_model->insert($uid, $answer_template_id, $data['hide_control'][$i], 0, 1);
				}
			}
			else
			{
				$this->survey_answer_template_model->update_effect($uid, $answer_template_id,0);
			}
			
			if(!empty($data['show_control']))
			{
				$this->survey_answer_template_model->update_effect($uid, $answer_template_id,1);
				for ($i=0,$len=count($data['show_control']);$i<$len;$i++)
				{
					$this->survey_answer_relation_model->insert($uid, $answer_template_id, $data['show_control'][$i], 1, 1);
				}
			}
			else
			{
				$this->survey_answer_template_model->update_effect($uid, $answer_template_id,0);
			}
			
			redirect ('survey/edit_step_4/'.$survey_type_id.'/'.$survey_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	// Tong ket thong tin tao Phieu khao sat
	function create_summary($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'faculty_model', 'survey_faculty_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			// Lay tat ca cac khoa ban
			$data['faculties'] = $this->faculty_model->get();
			
			// Lay danh sach cac khoa duoc ap dung phieu khao sat
			$data['survey_faculties'] = $this->survey_faculty_model->get($survey_id);
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/create_summary',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function preview($survey_type_id, $survey_id)
	{
		if($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model','design_template_model', 'survey_question_model', 'survey_answer_template_model', 'survey_answer_relation_model', 'province_model'));
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
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
			
			$this->load->view('survey/preview', $data);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function sort_question($survey_type_id, $survey_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'faculty_model', 'survey_faculty_model', 'survey_question_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay danh sach cau hoi
			$data["questions"] = $this->survey_question_model->get($survey_id);
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/sort_question',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect("auth");
		}
	}
	
	function sort_answer($survey_type_id, $survey_id, $question_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_model', 'survey_type_model', 'faculty_model', 'survey_faculty_model', 'survey_question_model', 'survey_answer_template_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay du lieu cau hoi
			$data["question"] = $this->survey_question_model->get_question($question_id);
			
			// lay danh sach cau tra loi
			$data["answers"] = $this->survey_answer_template_model->get($question_id);
			
			
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey/sort_answer',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect("auth");
		}
	}
	
	////////////////////////////////////
	// AJAX function
	////////////////////////////////////
	function get_faculties($is_vocation)
	{
		$this->load->model(array('faculty_model'));
		
		// Lay khoa ban
		$data['faculties'] = $this->faculty_model->get_is_vocation($is_vocation);
		
		echo json_encode($data);
	}
	
	function update_view_order()
	{
		$this->load->model(array('survey_model','survey_question_model'));
		// Lay thong tin nguoi dung
		$user = $this->ion_auth->user()->row();
		$uid  = $user->id;
		
		$question_id = $_REQUEST["question_id"];
		$view_order = $_REQUEST["view_order"];
		
		$this->survey_question_model->update_sort($uid, $question_id, $view_order);
	}
	
	function update_answer_view_order()
	{
		$this->load->model(array('survey_answer_template_model'));
		// Lay thong tin nguoi dung
		$user = $this->ion_auth->user()->row();
		$uid  = $user->id;
		
		$answer_template_id = $_REQUEST["answer_template_id"];
		$view_order = $_REQUEST["view_order"];
		
		$this->survey_answer_template_model->update_sort($uid, $answer_template_id, $view_order);

	}
	
	function update_status()
	{
		$this->load->model('survey_model');
		
		// Lay thong tin nguoi dung
		$user=$this->ion_auth->user()->row();
		$uid=$user->id;
		
		$survey_id = $_REQUEST["survey_id"];
		$status = $_REQUEST["status"];
		
		$data['status'] = $this->survey_model->update_status($uid, $survey_id, $status);
		echo json_encode($data);
	}
}