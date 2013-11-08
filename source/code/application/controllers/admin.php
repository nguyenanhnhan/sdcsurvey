<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation','session'));
		$this->load->helper('url');
	}
	
	function index()
	{	
		if ($this->ion_auth->logged_in())
		{
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
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
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
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
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
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
			$user          = $this->ion_auth->user()->row();
			$message       = $this->session->flashdata('message');
			$data          = array (
				'id'         => $user->id,
				'username'   => $user->username,
				'first_name' => $user->first_name,
				'last_name'  => $user->last_name,
				'email'      => $user->email,
				'phone'      => $user->phone,
				'message'    => $message,
			);
			
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/edit_profile',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function update_profile()
	{
		if ($this->ion_auth->logged_in())
		{	
			$user = $this->ion_auth->user()->row();
			$email = $this->input->post('email');
			
			$data          = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'phone'      => $this->input->post('phone'),
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
	
	function change_pass($id)
	{
		if ($this->ion_auth->logged_in())
		{
		
			$new_password = $this->input->post('new_password');
			
			$data = array(
				'password'=>$new_password
			);
			
			if ($this->ion_auth->update($id,$data))
			{
				$this->session->set_flashdata('message','Mật khẩu mới đã được cập nhật');
			}
			else 
			{
				$this->session->set_flashdata('message','Có lỗi xảy ra khi cập nhật lại mật khẩu');
			}
			redirect('admin/edit_user/'.$id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function change_pass_profile()
	{
		if ($this->ion_auth->logged_in())
		{
		
			$new_password = $this->input->post('new_password');
			
			$data = array(
				'password'=>$new_password
			);
			
			$id = $this->ion_auth->user()->row()->id;
			if ($this->ion_auth->update($id,$data))
			{
				$this->ion_auth->logout();
				redirect('auth');
			}
			else 
			{
				$this->session->set_flashdata('message','Có lỗi xảy ra khi cập nhật lại mật khẩu');
				redirect('admin/edit_profile/');
			}
		}
		else
		{
			redirect('auth');
		}
	}
	
	function update_user($id)
	{
		if ($this->ion_auth->logged_in())
		{	
			$user = $this->ion_auth->user($id)->row();
			$email = $this->input->post('email');
			
			$data          = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'phone'      => $this->input->post('phone'),
				'email'      => $this->input->post('email'),
			);
			$this->ion_auth->update($user->id, $data);
			
			$this->session->set_flashdata('message','<strong>Thông tin người dùng đã được lưu</strong>');
			
			redirect ('admin/edit_user/'.$user->id);
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
			$data['groups'] = $this->ion_auth->groups()->result_array();
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/groups',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function delete_group($id)
	{
		if ($this->ion_auth->logged_in())
		{
			
			if ($this->ion_auth->is_admin())
			{
				$this->ion_auth->delete_group($id);
			}
			redirect('admin/groups','refresh');
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
			$data['message'] = $this->session->flashdata('message');
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/add_group',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function insert_group()
	{
		if ($this->ion_auth->logged_in())
		{
			if ($this->ion_auth->is_admin())
			{
				$group_name        = $this->input->post('group_name');
				$group_description = $this->input->post('group_description');
				$group             = $this->ion_auth->create_group($group_name, $group_description);
				
				if (!$group)
				{
					$data['message'] = $this->session->set_flashdata('message',$this->ion_auth->messages());
					
					redirec('admin/add_group');
				}
				else
				{
					redirect('admin/groups');
				}
			}
		}
		else
		{
			redirect('auth');
		}
	}
	
	function group_user($group_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('group_model'));
		
			$data['group']              = $this->ion_auth->group($group_id)->row_array();
			
			// Lay danh sach nguoi dung khong thuoc nhom nay
			$data['users_not_in_group'] = $this->group_model->get_users_not_in_group($group_id);
			
			// Lay danh sach nguoi dung thuoc nhom nay
			$data['users_in_group']     = $this->group_model->get_users_in_group($group_id);
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/group_user',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function remove_user_group($group_id, $user_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$user = $this->ion_auth->user()->row_array();
			
			if ($this->ion_auth->is_admin())
			{
				if ($user['id']!=$user_id)
				{
					$this->ion_auth->remove_from_group($group_id, $user_id);
				}
			}
			redirect ('admin/group_user/'.$group_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function insert_to_group($group_id)
	{
		if ($this->ion_auth->logged_in())
		{
			// Chi co quyen admin moi co the chen thong tin
			if ($this->ion_auth->is_admin())
			{
				$this->load->model(array('group_model'));
				
				$users = $this->input->post('users');
				
				// Co thong tin moi thuc thi cau lenh
				if(!empty($users))
				{
					for ($i=0,$len=count($users);$i<$len;$i++)
					{
						$this->group_model->insert_to_group($group_id, $users[$i]);
					}
				}
				redirect ('admin/group_user/'.$group_id);
				
			}
		}
		else
		{
			redirect('auth');
		}
	}
	
	function group_permission($id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('group_permission_model'));
			
			$data['group'] = $this->ion_auth->group($id)->row_array();
			$data['faculties'] = $this->group_permission_model->get_faculties($id);
			
			// Lay thong tin quyen han cua group
			$data['permissions'] = $this->group_permission_model->get_group_permission($id);
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/group_permission',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function insert_permission($group_id)
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('group_permission_model'));
			
			$faculty_id = $this->input->post('faculty');
			$view       = (bool)$this->input->post('view');
			$edit       = (bool)$this->input->post('edit');
			
			// Lay thong tin nguoi dang nhap
			$user       = $this->ion_auth->user()->row_array();
			$uid        = $user['id'];
			
			if(!empty($faculty_id))
			$this->group_permission_model->insert_permission($uid,$group_id,$faculty_id,$view,$edit);
			
			redirect ('admin/group_permission/'.$group_id);
		}
		else
		{
			redirect('auth');
		}
	}
	
	function delete_permission($id,$group_id)
	{
		if ($this->ion_auth->logged_in())
		{
			if ($this->ion_auth->is_admin())
			{
				$this->load->model(array('group_permission_model'));
				$this->group_permission_model->delete_permission($id);
			}
			redirect ('admin/group_permission/'.$group_id);
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
			// Lay danh sach nguoi dung
			$data['users'] = $this->ion_auth->users()->result_array();
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/users',$data);
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
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/add_user');
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function insert_user()
	{
		if ($this->ion_auth->logged_in())
		{
			// Lay thong tin tren form
			$user_name        = $this->input->post('user_name');
			$email            = $this->input->post('email');
			$password         = $this->input->post('password');
			$additional_data  = array (
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'phone'      => $this->input->post('phone')
			);
			
			if (!$this->ion_auth->username_check($user_name))
			{
				$this->ion_auth->register($user_name,$password,$email,$additional_data);
				
				redirect ('admin/users');
			}
			else
			{
				redirect ('admin/add_user');
			}
		}
		else
		{
			redirect('auth');
		}
	}
	
	function delete_user($id)
	{
		if ($this->ion_auth->logged_in())
		{
			if ($this->ion_auth->is_admin())
			{
				$user = $this->ion_auth->user()->row();
				if ($user->id != $id)
				{
					$this->ion_auth->delete_user($id);
				}
				redirect ('admin/users');
			}
		}
		else
		{
			redirect('auth');
		}
	}
	
	function edit_user($id)
	{
		if ($this->ion_auth->logged_in())
		{
			$data['edit_user'] = $this->ion_auth->user($id)->row_array();
			$data['message']  = $this->session->flashdata('message');
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/edit_user',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
}

