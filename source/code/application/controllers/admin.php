<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{	
		$this->load->view('templates/header');
		$this->load->view('admin/dashboard');
		$this->load->view('templates/footer');
	}
	function import_student()
	{
		$this->load->view('templates/header');
		$this->load->view('admin/import_student');
		$this->load->view('templates/footer');
	}
	
	function export_student()
	{
		$this->load->view('templates/header');
		$this->load->view('admin/export_student');
		$this->load->view('templates/footer');
	}
	
	function edit_profile()
	{
		$this->load->view('templates/header');
		$this->load->view('admin/edit_profile');
		$this->load->view('templates/footer');
	}
	
	function groups()
	{
		$this->load->view('templates/header');
		$this->load->view('admin/groups');
		$this->load->view('templates/footer');
	}
	
	function add_group()
	{
		$this->load->view('templates/header');
		$this->load->view('admin/add_group');
		$this->load->view('templates/footer');
	}
	
	function group_user()
	{
		$this->load->view('templates/header');
		$this->load->view('admin/group_user');
		$this->load->view('templates/footer');
	}
	
	function group_permission()
	{
		$this->load->view('templates/header');
		$this->load->view('admin/group_permission');
		$this->load->view('templates/footer');
	}
}

