<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Survey extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation', 'session'));
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
			
			$this->load->model(array('survey_type_model', 'survey_model'));
			
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
		
			$this->load->model(array('survey_model'));
		
			$survey_name      = $this->input->post('survey_name');
			$reused_survey_id = $this->input->post('reuse');
			$survey_type_id   = $this->input->post('hidden_stype_id');
			$course           = $this->input->post('course');
			$graduated_year   = $this->input->post('graduated_year');
			$is_graduated     = (bool)$this->input->post('is_graduated');
			$is_vocation      = $this->input->post('is_vocation');
			
			$array_sdate = explode('/', $this->input->post('start_date'));
			$start_date       = $array_sdate[2].'/'.$array_sdate[1].'/'.$array_sdate[0];
			
			$array_edate = explode('/', $this->input->post('end_date'));
			$end_date         = $array_edate[2].'/'.$array_edate[1].'/'.$array_edate[0];
			
			$is_evaluated     = (bool)$this->input->post('is_evaluated');
		
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$uid = $user->id;
			
			$this->survey_model->add($uid,$survey_type_id,$reused_survey_id, $survey_name, $course, 
			$graduated_year, $is_graduated, $start_date, $end_date, $is_vocation, $is_evaluated);
			
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
			$this->load->model(array('survey_type_model', 'survey_model'));
			
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
			$this->load->model(array('survey_type_model', 'survey_model'));
			
			// Lay tat ca thong tin tren form
			$survey_name    = $this->input->post('survey_name');
			$course         = $this->input->post('course');
			$graduated_year = $this->input->post('graduated_year');
			$is_graduated   = (bool)$this->input->post('is_graduated');
			$is_vocation    = $this->input->post('is_vocation');
			
			$array_sdate    = explode('/', $this->input->post('start_date'));
			$start_date     = $array_sdate[2].'/'.$array_sdate[1].'/'.$array_sdate[0];
			
			$array_edate    = explode('/', $this->input->post('end_date'));
			$end_date       = $array_edate[2].'/'.$array_edate[1].'/'.$array_edate[0];
			
			$is_evaluated   = (bool)$this->input->post('is_evaluated');
		
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			// Tien hanh cap nhat
			$this->survey_model->update_step_1($uid, $survey_id, $survey_name, $course, $graduated_year, $is_graduated, 
			$is_vocation, $start_date, $end_date, $is_evaluated);
			
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
}