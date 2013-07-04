<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Survey extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation', 'session'));
		$this->load->helper('url');
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
	
	function create_step_1($stype_id)
	{
		if ($this->ion_auth->logged_in())
		{
			
			$this->load->model(array('survey_type_model'));
			
			$data['survey_type'] = $this->survey_type_model->get($stype_id);
			$this->load->view('templates/header');
			$this->load->view('survey/create_step_1', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect ('auth');
		}
	}
}