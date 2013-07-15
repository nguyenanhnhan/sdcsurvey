<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Survey_result extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array ('ion_auth', 'form_validation', 'session'));
		$this->load->helper('url');
	}
	
	function index()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model', 'survey_model', 'faculty_model', 'student_model', 'infor_model', 'survey_faculty_model'));
			// Load het cac Khoa/Ban
			$data['faculties'] = $this->faculty_model->get();
			
			$this->load->view('templates/header');
			$this->load->view('survey_result/index', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function filter()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model', 'survey_model', 'faculty_model', 'student_model', 'infor_model', 'survey_faculty_model'));
			
			// Lay thong tin tren form
			$faculty_id = $this->input->post('faculty'); 
			$survey_id  = $this->input->post('survey');
			$type_id    = $this->input->post('filter');
			
			redirect ('survey_result/result_filter/'.$faculty_id.'/'.$survey_id.'/'.$type_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function result_filter($faculty_id, $survey_id, $type_id)
	{
		
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model', 'survey_model', 'faculty_model', 'student_model', 'infor_model', 'survey_faculty_model'));
			
			// Lay mau khao sat hien muon xem
			$data['survey'] = $this->survey_model->get(FALSE, $survey_id);
			
			// Lay thong tin khoa
			$data['faculty'] = $this->faculty_model->get($faculty_id);
		
			$data['students_no_survey'] = NULL;
			$data['students_surveyed']  = NULL;
			
			// Lay thong tin sinh vien
			if ($type_id==0) // Lay tat ca sinh vien chua khao sat va da khao sat
			{
				// Lay sinh vien da khao sat
				$data['students_surveyed'] = $this->infor_model->gets_of_faculty($faculty_id, $survey_id);
				
				// Lay sinh vien chua khao sat
				$data['students_no_survey']=$this->student_model->get_student_of_faculty($faculty_id, $survey_id);
			}
			else
			{
				if ($type_id==1) // Lay tat ca sinh vien da khao sat
				{
					$data['students_surveyed'] = $this->infor_model->gets_of_faculty($faculty_id, $survey_id);
				}
				else
				{
					if ($type_id==2) // Lay tat ca sinh vien chua khao sat
					{
						// Lay sinh vien chua khao sat
						$data['students_no_survey']=$this->student_model->get_student_of_faculty($faculty_id, $survey_id);
					}
					else
					{
						// lay sinh vien da khao sat theo hinh thuc thuc hien
						$data['students_surveyed']=$this->infor_model->gets_of_faculty($faculty_id, $survey_id, $type_id);
					}
				}
				
			}// Ket thuc lay thong tin sinh vien
			
			$this->load->view('templates/header');
			$this->load->view('survey_result/result_filter',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	///////////////////
	// AJAX function //
	///////////////////
	function get_survey_of_faculty($faculty_id)
	{
		$this->load->model('survey_faculty_model');
		$data['surveys_faculty'] = $this->survey_faculty_model->get_survey($faculty_id);
		
		echo json_encode($data);
		
	}
}