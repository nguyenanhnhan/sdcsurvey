<?php if ( ! defined('BASEPATH')) exit('Mã script không được phép truy xuất trực tiếp.');

class Survey_evaluation extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library(array ('ion_auth', 'form_validation', 'session', 'uuid'));
		$this->load->helper(array('url', 'date', 'file', 'form'));
	}
	
	function index()
	{
		if ($this->ion_auth->logged_in())
		{	
			$this->load->model(array('survey_type_model', 'survey_list_random_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay danh sach loai khao sat
			$data['survey_type'] = $this->survey_type_model->get(FALSE);
			
			// Goi view
			$this->load->view('templates/header', $data);
			$this->load->view('survey_evaluation/index',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	// AJAX Function
	// ham lay cac phieu khao sat phan theo loai khao sat
	function gets_survey($survey_type_id) 
	{
		$this->load->model('survey_model');
		$data['surveys'] = $this->survey_model->get($survey_type_id);
		
		echo json_encode($data);
	}
	
	// ham lay cac khoa tham gia phieu khao sat
	function gets_survey_faculty($survey_id)
	{
		$this->load->model('survey_faculty_model');
		$data['survey_faculties'] = $this->survey_faculty_model->get($survey_id, FALSE);
		
		echo json_encode($data);
	}
	
	// ham lay lop cua khoa tham gia khao sat
	function gets_class_by_faculty($survey_id, $faculty_id)
	{
		$this->load->model('student_model');
		$data["classes"] = $this->student_model->gets_class_by_faculty($survey_id, $faculty_id);
		
		echo json_encode($data);
	}
	
	// ham lay cau hoi dung de danh gia
	function gets_question_is_evaluated($survey_id)
	{
		$this->load->model('survey_question_model');
		$data["questions"] = $this->survey_question_model->gets_question_is_evaluated($survey_id);
		
		echo json_encode($data);
	}
}

/* End of file survey_evaluation.php */
/* Location: ./application/controllers/survey_evaluation.php */