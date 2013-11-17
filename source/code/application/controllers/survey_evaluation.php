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
			$this->load->model(array('survey_type_model', 'survey_list_evaluation_model'));
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay danh sach loai khao sat
			$data['survey_type'] = $this->survey_type_model->get(FALSE);
			
			// Lay danh sach danh gia
			$data['survey_evaluation_list'] = $this->survey_list_evaluation_model->get();
			
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
	
	function get_list()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_list_evaluation_model','survey_evaluation_model', 'survey_answer_model'));
			
			$list_id                 = $this->uuid->v4();
			$list_name               = $this->input->post('list_name');
			$faculty_id              = $this->input->post('faculty');
			$class_id                = $this->input->post('class');
			$survey_type_id          = $this->input->post('survey_type');
			$survey_id               = $this->input->post('survey');
			$question_company_name   = $this->input->post('q_company_name');
			$answer_company_name     = $this->input->post('a_company_name');
			$question_doing_job      = $this->input->post('q_doing_job');
			$answer_doing_job        = $this->input->post('a_doing_job');
			
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$user_name = $user->username;
			
			$var_array = array (
				'list_id'               => $list_id,
				'list_name'             => $list_name,
				'faculty_id'            => $faculty_id,
				'class_id'              => $class_id,
				'survey_type_id'        => $survey_type_id,
				'survey_id'             => $survey_id,
				'question_company_name' => $question_company_name,
				'answer_company_name'   => $answer_company_name,
				'question_doing_job'    => $question_doing_job,
				'answer_doing_job'      => $answer_doing_job,
				'created_by_user_id'    => $user_name,
				'created_on_date'       => mdate('%Y/%m/%d %H:%i:%s', now())
			);
			
			// Chen du lieu vao bang sur_evaluation_list
			$this->survey_list_evaluation_model->insert($var_array);
			
			// Lay danh sach sinh vien thoa dieu kien trong sur_evaluation_list
			$data_gen = $this->survey_evaluation_model->generation($list_id);
			
			foreach ($data_gen as $gen_item)
			{
				$company_name       = $this->survey_answer_model->get_answer_content($gen_item['infor_id'], $answer_company_name);
				$doing_job          = $this->survey_answer_model->get_answer_content($gen_item['infor_id'], $answer_doing_job);
				$var_array_gen = array (
					'evaluation_id'        => $this->uuid->v4(),
					'list_evaluation_id'   => $list_id,
					'infor_id'             => $gen_item['infor_id'],
					'company_name'         => $company_name['content'],
					'doing_job'            => $doing_job['content'],
					'rate_score'           => 0
				);
				
				$this->survey_evaluation_model->insert($var_array_gen);
			}
			
			redirect('survey_evaluation');
		}
		else
		{
			redirect("auth");
		}
	}
	
	function delete($list_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_list_evaluation_model','survey_evaluation_model'));
			
			$this->survey_list_evaluation_model->delete($list_id);
			
			redirect('survey_evaluation');
		}
		else
		{
			redirect("auth");
		}
	}
	
	function view($list_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model('survey_evaluation_model');
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// lay danh sach can kiem tra
			$data['student_list'] = $this->survey_evaluation_model->get($list_id);

			// Goi view
			$this->load->view('templates/header',$data);
			$this->load->view('survey_evaluation/detail', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect("auth");
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
	
	// ham lay cac cau tra loi voi ma cau hoi
	function gets_answer_template($question_id)
	{
		$this->load->model('survey_answer_template_model');
		$data['answer_template'] = $this->survey_answer_template_model->get($question_id,FALSE);
		
		echo json_encode($data);
	}
	
	function update_rate_score($evaluation_id, $rate_score)
	{
		$this->load->model('survey_evaluation_model');
		
		// Lay thong tin nguoi dung
		$user = $this->ion_auth->user()->row();
		$user_name = $user->username;

		$this->survey_evaluation_model->update_rate_score($evaluation_id, $rate_score, $user_name);	
	}
	
	function get_note($evaluation_id)
	{
		$this->load->model('survey_evaluation_model');
		
		$data['note'] = $this->survey_evaluation_model->get_note($evaluation_id);
		
		echo json_encode($data);
	}
	
	function update_note()
	{
		$this->load->model('survey_evaluation_model');
		
		// Lay thong tin nguoi dung
		$user = $this->ion_auth->user()->row();
		$user_name = $user->username;
		$evaluation_id = $_REQUEST["evaluation_id"];
		$note = $_REQUEST["note"];
		$this->survey_evaluation_model->update_note($evaluation_id, $note, $user_name);
	}
}

/* End of file survey_evaluation.php */
/* Location: ./application/controllers/survey_evaluation.php */