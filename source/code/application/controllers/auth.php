<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');

class Auth extends CI_Controller 
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
		
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
		$this->load->helper('language');
	}	
	
	function index()
	{
		$data['message'] = $this->session->flashdata('message');
		if (!$this->ion_auth->logged_in())
		{
			$this->load->view('auth/login', $data);
		}
		else 
		{
			redirect ('admin');
		}
	}
	function login()
	{
		$remember = (bool) $this->input->post('remember');
		$identity = $this->input->post('identity');
		$password = $this->input->post('password');
		if ($this->ion_auth->login($identity, $password, $remember))
		{
			redirect('admin');
		}
		else
		{
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('auth');
		}
		
	}
	function logout()
	{
		$this->ion_auth->logout();
		
		redirect('auth');
	}
	
	function forgot_password()
	{
		$this->load->view('auth/forgot_password');
	}
	
	function _render_page($view, $data=null, $render=false)
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}
}