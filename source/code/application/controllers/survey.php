<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Survey extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation', 'session', 'uuid'));
		$this->load->helper(array('url', 'date'));
	}
	
	function index($stype_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model','survey_model'));
			
			$data['surveys'] = $this->survey_model->get($stype_id);
			$data['survey_type'] = $this->survey_type_model->get($stype_id);
			
			$this->load->view('templates/header');
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
			$course_array = array("");
			$count_graduated_year = count($graduated_year_array);
			for ($i = $count_graduated_year; $i <=$count_graduated_year+4; $i++)
			{
				array_push($course_array, $i);
			}
			$data['courses_learning'] = $course_array;
			
			// Lay cac mau khao sat truoc co cung loai khao sat
			$data['surveys'] = $this->survey_model->get($stype_id);
			
			// Lay tat ca cac khoa ban
			$data['faculties'] = $this->faculty_model->get();
			
			$this->load->view('templates/header');
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
		
			$this->load->model(array('survey_model', 'survey_faculty_model'));
			
			$survey_id        = $this->uuid->v4();
			$survey_name      = $this->input->post('survey_name');
			$reused_survey_id = $this->input->post('reuse');
			$survey_type_id   = $this->input->post('hidden_stype_id');
			$course           = $this->input->post('course');
			$graduated_year   = $this->input->post('graduated_year');
			$is_graduated     = (bool)$this->input->post('is_graduated');
			$is_vocation      = (bool)$this->input->post('is_vocation');
			
			$array_sdate      = explode('/', $this->input->post('start_date'));
			$start_date       = $array_sdate[2].'/'.$array_sdate[1].'/'.$array_sdate[0];
			
			$array_edate      = explode('/', $this->input->post('end_date'));
			$end_date         = $array_edate[2].'/'.$array_edate[1].'/'.$array_edate[0];
			
			$is_evaluated     = (bool)$this->input->post('is_evaluated');
			
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
			
			$this->survey_model->add($uid,$survey_id,$survey_type_id,$reused_survey_id, $survey_name, $course, 
			$graduated_year, $is_graduated, $start_date, $end_date, $is_vocation, $is_evaluated);
			
			// Them vao bang sur_survey_faculty nham phan quyen khao sat cho tung khoa/ban
			if (!empty($survey_faculties['data']))
			{
				for($i=0, $len = count($survey_faculties['data']); $i < $len; $i++)
				{
					$this->survey_faculty_model->insert($uid, $survey_id, $survey_faculties['data'][$i]);
				}
			}
			redirect ('survey/index/'.$survey_type_id);
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
			
			// Tien hanh xao data trong bang sur_survey
			$this->survey_model->delete($survey_id);
			
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
			
			$this->load->view('templates/header');
			$this->load->view('survey/edit_step_1', $data);
			$this->load->view('templates/footer');
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
			
			$this->load->view('templates/header');
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
			
			// Cap nhat vao bang sur_survey
			$this->survey_model->update_step_2($uid, $survey_id, $design_template_id);
			
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
			$this->load->model(array('survey_model','survey_type_model', 'survey_question_model', 'survey_answer_template_model'));
			
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Lay loai khao sat
			$data['survey_type'] = $this->survey_type_model->get($survey_type_id);
			
			// Lay mau khao sat hien muon sua
			$data['survey'] = $this->survey_model->get($survey_type_id, $survey_id);
			
			// Lay cac mau cau hoi va cau tra loi tuong ung voi phieu khao sat
			$data['survey_question'] = $this->survey_question_model->get($survey_id);
			
			// Lay cau tra loi tuong ung voi cau hoi
			for ($i = 0, $len = count($data['survey_question']); $i < $len ; $i++)
			{
				$data['survey_question']['answer'] = $this->survey_answer_template_model->get($data['survey_question'][$i]['question_id']);
			}
			
			// Lay cau tra loi la sub cua cau tra loi kia
			/*
$data['survey_answer_temlate_sub'] = NULL;
			foreach ($data)
*/
			
			$this->load->view('templates/header');
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
			$view_order         = 0;
			$start_hide         = $this->input->post('is_hide');
			$required           = $this->input->post('is_required');
			$view_style         = 1;
			$is_validate        = 0;
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
			if (!empty($control['dyn_control'])) $max_option += count($control['dyn_control']);
			if (!empty($control['dyn_other_control'])) $max_option += count($control['dyn_other_control']);
			
			// Them cau hoi vao bang sur_question
			$result = $this->survey_question_model->insert($uid, $question_id, $reused_question_id, $survey_id, $content, $view_order, $max_option, $start_hide, $required, $view_style, $is_validate, $is_evaluated);
			
			// Them cau tra loi vao bang sur_answer_template
			if ($result)
			{
				// Them lua chon chuan
				$option_type = $answer_type;
				$c_count = 0;
				for ($i = 0, $len = count($control['dyn_control']); $i < $len; $i++)
				{
					$c_count++;
					$answer_template_id = $this->uuid->v4();
					$label              = $control['dyn_control'][$i];
					$view_order         = $c_count;
					$exception          = 0;
					$sub_answer         = 0;
					$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception, $sub_answer);
				}
				
				// Them lua chon khac chuan
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
						$sub_answer         = 0;
						$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $other_option_type, $view_order, $label, $exception, $sub_answer);
					}
					else
					{
						$c_count++;
						$answer_template_id = $this->uuid->v4();
						$label              = $control['dyn_other_control'][$i];
						$view_order         = $c_count;
						$exception          = 0;
						$sub_answer         = 1;
						// Chen truoc 1 cau tra loi dang van ban
						$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception, $sub_answer);
						
						// Chen cau tra loi Tinh/Thanh di chung voi cau tra loi van ban
						$question_sub_id    = $answer_template_id;
						$answer_template_id = $this->uuid->v4();
						$label              = "Tỉnh/Thành";
						$sub_answer         = 0;
						$this->survey_answer_template_model->insert($uid, $answer_template_id, $question_id, $other_option_type, $view_order, $label, $exception, $sub_answer);
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
}