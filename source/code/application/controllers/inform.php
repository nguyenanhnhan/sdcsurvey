<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Inform extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth', 'form_validation', 'session', 'uuid'));
		$this->load->helper(array('url', 'date', 'file'));
		$this->load->model(array('group_permission_model'));
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
			
			$data['faculties']=array();
			// Load cac khoa ban theo quyen han
			$groups = $this->ion_auth->get_users_groups()->result_array();
			foreach($groups as $group)
			{
				
				// Lay quyen han cua group
				$permissions = $this->group_permission_model->get_group_permission($group['id']);
				
				foreach ($permissions as $permissions)
				{
					$flag_existing = 0;
					for ($i=0,$len=count($data['faculties']);$i<$len;$i++)
					{
						if ($data['faculties'][$i]['faculty_id']==trim($permissions['faculty_id'])) 
						{
							$flag_existing = 1;
							break;
						}
					}
					if($flag_existing==0) array_push($data['faculties'], $permissions);
				}
			}
			
			
			// Load het cac Khoa/Ban
			/* $data['faculties'] = $this->faculty_model->get(); */
			
			$data['mail_template'] = read_file("assets/template/inform_email/mailTemplateDH.html");
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();

			$this->load->view('templates/header',$data);
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
			
			// LAY THONG TIN NGUOI PHU TRACH KHAO SAT
			$user         = $this->ion_auth->user()->row();
			$user_name    = $user->username;
			$display_name = trim($user->first_name).' '.trim($user->last_name);

			$data['display_name'] = $display_name;
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// LAY THONG TIN TREN FORM
			$faculty_id             = $this->input->post('faculty');
			$survey_id              = $this->input->post('survey');
			$send_number            = $this->input->post('send_number');
			$title                  = $this->input->post('title');
			$from_email             = $this->input->post('email_address');
			$password               = $this->input->post('password');
			$preview                = $this->input->post('preview');
			
			$data['faculty']        = $this->faculty_model->get($faculty_id);
			
			$data['survey']         = $this->survey_model->get(FALSE,$survey_id);
			
			$data['students']       = $this->student_model->get_student_with_email($faculty_id,$survey_id);
			
			$data['student_sended'] = "";
			$data['error']          = "";
			$data['preview'] = "";
			if (!empty($data['students']))
			{
				$send_counter = 0;
				$preview_counter = 0;
				$students = $data['students'];
				foreach ($data['students'] as $student)
				{
					$send_counter++;
					$content = $this->input->post('editor');
					$content = str_replace('[Faculty|Name]',$data['faculty']['faculty_name'],$content);
					// Thay token [Student|FullName] = Ten sinh vien
					$content = str_replace('[Student|FullName]',trim($student['first_name']).' '.trim($student['last_name']),$content);
					// Thay toke [Survey|Link] = Duong dan den trang khao sat
					$content = str_replace('[Survey|Link]',
						"<a href='".base_url('do_survey/student/'.$faculty_id.'/'.$survey_id.'/'.$student['student_id'])."'>".base_url('do_survey/student/'.$faculty_id.'/'.$survey_id.'/'.$student['student_id'])."</a>",
						$content);
					// In trang xem truoc
					if ($preview=='on') 
					{
						$data['preview'][$preview_counter] = $content;
						$preview_counter ++;
					}
					else // Gui di
					{						
						$config = Array(
							'protocol'  => 'smtp',
							'smtp_host' => 'mail.vanlanguni.edu.vn',
							'smtp_port' => 25,
							'smtp_user' => trim($from_email),
							'smtp_pass' => trim($password),
							'charset'   => 'utf8',
							'mailtype'  => 'html'
						);
						
						$this->email->initialize($config);
				
						$this->email->from($from_email,$display_name);
						$this->email->to($student['email']);
						$this->email->subject($title);
						$this->email->message($content);
						$this->email->set_newline("\r\n");
						if ( ! $this->email->send())
						{
							$data['error'][$send_counter]=$this->email->print_debugger();
						}
						{
							$data['student_sended'][$send_counter] = $student;
						}						
						$data['student_sended'][$send_counter] = $student; // HANG NAY DUNG DE TEST
					}
					$this->email->clear();
					if($send_counter == $send_number) break;
				}
				
				if ($preview=='on') 
				{	
					$this->load->view('templates/header',$data);
					$this->load->view('inform/mail_preview',$data);
					$this->load->view('templates/footer');
				}
				else
				{
					if (!empty($data['error']))
					{ 
						print_r($data['error']);
					}
					else
					{	
						$this->load->view('templates/header',$data);
						$this->load->view('inform/mail_sended',$data);
						$this->load->view('templates/footer');
					}
				}
			}
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