<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->library('session');
	}
	
	function index()
	{	
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/dashboard');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect ('auth');
		}
	}
	function import_student()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/import_student');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function export_student()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/export_student');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function edit_profile()
	{
		if ($this->ion_auth->logged_in())
		{
			$user = $this->ion_auth->user()->row();
			$message = $this->session->flashdata('message');
			$data = array (
				'username' => $user->username,
				'first_name' => $user->first_name,
				'last_name' => $user->last_name,
				'email' => $user->email,
				'phone' => $user->phone,
				'message' => $message,
			);
			$this->load->view('templates/header');
			$this->load->view('admin/edit_profile',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function update_user()
	{
		if ($this->ion_auth->logged_in())
		{	
			$user = $this->ion_auth->user()->row();
			$email = $this->input->post('email');
			
			$data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'phone'     => $this->input->post('phone'),
				'email'      => $this->input->post('email'),
			);
			$this->ion_auth->update($user->id, $data);
			
			$this->session->set_flashdata('message','Thông tin người dùng đã được lưu');
			
			redirect ('admin/edit_profile');
		}
		else
		{
			redirect('auth','refresh');
		}
	}
	
	function groups()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/groups');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function add_group()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/add_group');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function group_user()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/group_user');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function group_permission()
	{
		if ($his->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/group_permission');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function users()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/users');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function add_user()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/add_user');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function edit_user()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->view('templates/header');
			$this->load->view('admin/edit_user');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
}

