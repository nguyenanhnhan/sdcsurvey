<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Inform extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation', 'session', 'uuid'));
		$this->load->helper(array('url', 'date', 'file'));
	}
	
	function index()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model', 'survey_model', 'faculty_model', 'student_model', 'infor_model', 'survey_faculty_model'));
			
			// LAY THONG TIN NGUOI PHU TRACH KHAO SAT
			$user               = $this->ion_auth->user()->row();
			$user_name          = $user->username;
			$data['user_email'] = $user->email;
			
			// Load het cac Khoa/Ban
			$data['faculties'] = $this->faculty_model->get();
			
			$data['mail_template'] = read_file("assets/template/inform_email/mailTemplateDH.html");

			$this->load->view('templates/header');
			$this->load->view('inform/send_mail',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function send()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model', 'survey_model', 'faculty_model', 'student_model', 'infor_model', 'survey_faculty_model'));
			
			
			// LAY THONG TIN TREN FORM
			$data['title'] = $this->input->post('title');
			$data['content'] = $this->input->post('editor');
			
			$data ['content'] = str_replace('[Student|FullName]', 'Nguyen Anh Nhan', $data['content']);
			
			echo $data['content'];die;
			
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