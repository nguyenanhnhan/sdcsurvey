<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Survey_type extends CI_Controller 
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
			$this->load->model('survey_type_model');
			$data['survey_type'] = $this->survey_type_model->get();
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey_type/list', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function delete($stype_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model','survey_model'));

			$check = $this->survey_model->get($stype_id);

			if (empty($check))
				$this->survey_type_model->delete($stype_id);
			
			redirect('survey_type','refresh');
		}
		else
		{
			redirect('auth');
		}
	}	
	
	function edit($stype_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model('survey_type_model');
			
			/* End of file survey_type.php */
			/* Location: ./application/controllers/survey_type.php */		
			$user = $this->ion_auth->user()->row();
			$uid  = $user->id;
			
			$data['stype_item']   = $this->survey_type_model->get($stype_id);
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin']     = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('survey_type/edit', $data);
			$this->load->view('templates/footer');	
		}
		else
		{
			redirect('auth');
		}
	}
	
	function update()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model('survey_type_model');
			$user = $this->ion_auth->user()->row();
			$uid = $user->id;
			$stype_id = $this->input->post('hidden_id');
			$stype_name = $this->input->post('survey_type');
			$this->survey_type_model->update($uid, $stype_id, $stype_name);
			
			redirect('survey_type');
		}
		else
		{
			redirect('auth');
		}
	}
		
	function add()
	{
		if ($this->ion_auth->logged_in())
		{
			$stype_name = $this->input->post('survey_type');
			$user = $this->ion_auth->user()->row();
			$uid = $user->id;
			
			$this->load->model('survey_type_model');
			
			$this->survey_type_model->add($uid, $stype_name);
			
			redirect ('survey_type','refresh');
		}
		else
		{
			redirect('auth');
		}
	}
}