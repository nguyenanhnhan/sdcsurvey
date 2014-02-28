<?php if ( ! defined('BASEPATH')) exit('Mã script không được phép truy xuất trực tiếp.');

class Survey_validation extends CI_Controller {

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
			
			// Lay danh sach random
			$data['validation_list_random'] = $this->survey_list_random_model->get();
			
			// Goi view
			$this->load->view('templates/header', $data);
			$this->load->view('survey_validation/index', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function get_random()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_list_random_model','survey_validation_model', 'survey_answer_model'));
			
			$list_id                     = $this->uuid->v4();
			$survey_type_id              = $this->input->post('survey_type');
			$survey_id                   = $this->input->post('survey');
			$question_id                 = $this->input->post('question');
			$answer_template_id          = $this->input->post('answer_template');
			$faculty_id                  = $this->input->post('faculty');
			$question_company_name       = $this->input->post('q_company_name');
			$answer_company_name         = $this->input->post('a_company_name');
			$question_company_address    = $this->input->post('q_company_address');
			$answer_company_address      = $this->input->post('a_company_address');
			$question_company_phone      = $this->input->post('q_company_phone');
			$answer_company_phone        = $this->input->post('a_company_phone');
			$question_doing_job          = $this->input->post('q_company_job');
			$answer_doing_job            = $this->input->post('a_company_job');
			$get_percent                 = $this->input->post('percent');
			$list_name                   = $this->input->post('list_name');
			
			// Lay thong tin nguoi dung dang dang nhap
			$user = $this->ion_auth->user()->row();
			$user_name = $user->username;
			
			$var_array = array(
				'list_id'                   => $list_id,
				'survey_type_id'            => $survey_type_id,
				'survey_id'                 => $survey_id,
				'question_id'               => $question_id,
				'answer_template_id'        => $answer_template_id,
				'faculty_id'                => $faculty_id,
				'question_company_name'     => $question_company_name,
				'answer_company_name'       => $answer_company_name,
				'question_company_address'  => $question_company_address,
				'answer_company_address'    => $answer_company_address,
				'question_company_phone'    => $question_company_phone,
				'answer_company_phone'      => $answer_company_phone,
				'question_doing_job'        => $question_doing_job,
				'answer_doing_job'          => $answer_doing_job,
				'get_percent'               => $get_percent,
				'list_name'                 => $list_name,
				'created_by_user_id'        => $user_name,
				'created_on_date'           => mdate('%Y/%m/%d %H:%i:%s', now())
			);
			
			// chen du lieu vao danh sach random 
			$this->survey_list_random_model->insert($var_array);
			
			// thuc hien lenh random
			// 1. lay so phan tram sinh vien thoa question_id va answer_template_id
			$data_gens = $this->survey_validation_model->generation($faculty_id, $answer_template_id);

			// 2. Them vao bang sur_validation
			foreach($data_gens as $gen_item)
			{
				$company_name       = $this->survey_answer_model->get_answer_content($gen_item['infor_id'], $answer_company_name);
				$company_address    = $this->survey_answer_model->get_answer_content($gen_item['infor_id'], $answer_company_address);
				$company_phone      = $this->survey_answer_model->get_answer_content($gen_item['infor_id'], $answer_company_phone);
				$doing_job          = $this->survey_answer_model->get_answer_content($gen_item['infor_id'], $answer_doing_job);

				if (!empty($company_name) && !empty($company_address) && !empty($company_phone) && !empty($doing_job))
				{
					$var_array_gen      = array(
						'validation_id'    => $this->uuid->v4(),
						'list_id'          => $list_id,
						'infor_id'         => $gen_item['infor_id'],
						'company_name'     => $company_name['content'],
						'company_address'  => $company_address['content'],
						'company_phone'    => $company_phone['content'],
						'doing_job'        => $doing_job['content']
					);
					$this->survey_validation_model->insert($var_array_gen);
				}
			}

			redirect('survey_validation');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function delete($list_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model('survey_list_random_model');
			
			$this->survey_list_random_model->delete($list_id);

			redirect('survey_validation');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function view($list_id)
	{
		if ($this->ion_auth->logged_in())
		{
		
			$this->load->model('survey_validation_model');
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// lay danh sach can kiem tra
			$data['student_list'] = $this->survey_validation_model->get($list_id);

			// Goi view
			$this->load->view('templates/header',$data);
			$this->load->view('survey_validation/detail', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	// xac nhan thong tin la TRUE hoac FALSE
	function confirm($list_id, $validation_id, $value)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model('survey_validation_model');
			
			// Lay thong tin nguoi dung
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			$user_name = $user->username;
			
			$this->survey_validation_model->validate($validation_id, $value,$data['display_name']);
			
			// lay danh sach can kiem tra
			$data['student_list'] = $this->survey_validation_model->get($list_id);

			// Goi view
			$this->load->view('templates/header',$data);
			$this->load->view('survey_validation/detail', $data);
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
	
	// ham lay cac cau hoi co cau tra loi khong phai dang text
	function gets_question_answer_no_text($survey_id)
	{
		$this->load->model('survey_question_model');
		$data['questions'] = $this->survey_question_model->get_question_answer_no_text($survey_id);
		
		echo json_encode($data);
	}
	
	// ham lay cac cau hoi co cau tra loi dang text
	function gets_question_answer_with_text($survey_id)
	{
		$this->load->model('survey_question_model');
		$data['questions'] = $this->survey_question_model->get_question_answer_with_text($survey_id);
		
		echo json_encode($data);
	}
	
	// ham lay cac cau tra loi voi ma cau hoi
	function gets_answer_template($question_id)
	{
		$this->load->model('survey_answer_template_model');
		$data['answer_template'] = $this->survey_answer_template_model->get($question_id,FALSE);
		
		echo json_encode($data);
	}
	
}

/* End of file survey_validation.php */
/* Location: ./application/controllers/survey_validation.php */