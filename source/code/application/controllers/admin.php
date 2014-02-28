<?php defined('BASEPATH') OR exit('Mã script không được phép truy xuất trực tiếp.');
class Admin extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library(array('ion_auth','form_validation','session','excel'));
		$this->load->helper(array('form', 'url', 'date', 'email', 'string')); // Load helper url
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
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
			$this->load->model(array('survey_type_model','student_model'));
			
			// Lay danh sach loai khao sat
			$data['survey_type'] = $this->survey_type_model->get(FALSE);
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			$data["error"]="";
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/import_student',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function upload_student_list()
	{
		if ($this->ion_auth->logged_in())
		{	
			$this->load->model(array('survey_type_model','student_model'));
			$this->load->helper('email');
		
			//Set config for upload file
			$config['upload_path'] = './assets/upload/students_list/';
			$config['allowed_types'] = '*';
			$config['max_size']	= '10240';
			$config['file_name'] = 'uploaded_students_list';
			$config['overwrite'] = 'TRUE';
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay danh sach loai khao sat
			$data['survey_type'] = $this->survey_type_model->get(FALSE);
			
			$this->load->library("upload",$config);
			$data["error"]="";
			$data["success"]="";
			$data["ignore"]="";
			$data["invalid"]=array();
			if (!$this->upload->do_upload())
			{
				$data["error"] = $this->upload->display_errors();
			}
			else 
			{
				$data["upload_data"] = $this->upload->data();
				$survey_id = $this->input->post("survey");
				//Initialize excel reading
				$this->load->library('excel');
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
				$objPHPExcel=$objReader->load(FCPATH."/assets/upload/students_list/uploaded_students_list.xls");
				$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
				
				$maxr = count($sheetData);
				$success_count = 0;
				$ignore_count = 0;
				for ($i=2; $i<=$maxr; $i++)
				{
					$faculty_id        = $sheetData[$i]["A"];
					$faculty_name      = $sheetData[$i]["B"];
					$class_id          = $sheetData[$i]["E"];
					$student_id        = $sheetData[$i]["F"];
					$first_name        = $sheetData[$i]["G"];
					$last_name         = $sheetData[$i]["H"];
					$place_of_birth    = $sheetData[$i]["I"];
					$date_of_birth     = $sheetData[$i]["J"];
					$grad_rank         = $sheetData[$i]["K"];
					$phone             = $sheetData[$i]["L"];
					$hand_phone        = $sheetData[$i]["M"];
					$email             = $sheetData[$i]["N"];
					$address           = $sheetData[$i]["O"];
					$course            = $sheetData[$i]["P"];
					$graduated_year    = $sheetData[$i]["Q"];
					
					// Kiem tra sinh vien da import chua
					$student_data = $this->student_model->get_student_infor($survey_id, $student_id);
					if (empty($student_data))
					{
						if (valid_email($email))
						{
							$var_array = array(
								"student_id"         => $student_id,
								"faculty_id"         => $faculty_id,
								"class_id"           => $class_id,
								"survey_id"          => $survey_id,
								"first_name"         => $first_name,
								"last_name"          => $last_name,
								"place_of_birth"     => $place_of_birth,
								"date_of_birth"      => $date_of_birth,
								"graduated_ranking"  => $grad_rank,
								"phone"              => $phone,
								"hand_phone"         => $hand_phone,
								"email"              => $email,
								"contact_address"    => $address,
								"course"             => $course,
								"graduated_year"     => $graduated_year,
								"created_by_user_id" => $user->id,
								"created_on_date"    => mdate('%Y/%m/%d %H:%i:%s', now())
							);
							
							$var_return = $this->student_model->insert_student($var_array);
							$success_count ++;
						}
						else 
						{
							array_push($data["invalid"], $student_id);
						}
					} 
					else
					{
						$ignore_count ++;
					}
				}
				$sum_record = $maxr - 1; // loai tru tieu de cot
				$data["success"]="Đã cập nhật ".$success_count." trong ".$sum_record." dòng dữ liệu";
				$data["ignore"]="Đã bỏ qua ".$ignore_count." dữ liệu trùng.";
			}
			$this->load->view('templates/header',$data);
			$this->load->view('admin/import_student',$data);
			$this->load->view('templates/footer');
			
		}
		else
		{
			redirect("auth");
		}
	}
	
	function export_student()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('survey_type_model','student_model'));
			
			$user = $this->ion_auth->user()->row();
			$data['display_name'] = trim($user->first_name).' '.trim($user->last_name);
			$data['is_admin'] = $this->ion_auth->is_admin();
			
			// Lay danh sach loai khao sat
			$data['survey_type'] = $this->survey_type_model->get(FALSE);
			
			$this->load->view('templates/header',$data);
			$this->load->view('admin/export_student',$data);
			$this->load->view('templates/footer');
		}
		else
		{
			redirect('auth');
		}
	}
	
	function export_info()
	{
		if ($this->ion_auth->logged_in())
		{
			$this->load->model(array('infor_model'));
			
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('Danh_sach_sv_da_ks');
			
			// TIEU DE BAO CAO //
			
			//change the font size
 			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setSize(20);
			//make the font become bold 			
			$this->excel->getActiveSheet()->getStyle("A1")->getFont()->setBold(true);
			$this->excel->getActiveSheet()->mergeCells("A1:R1");
			$this->excel->getActiveSheet()->setCellValue("A1", "DANH SÁCH SINH VIÊN KẾT XUẤT TỪ HỆ THỐNG");
			
			// head of table
			// nganh dao tao
			$this->excel->getActiveSheet()->setCellValue("A3", "Mã SV");
			// Ma khoa
			$this->excel->getActiveSheet()->setCellValue("B3", "Mã Khoa");
			// Ma Lop
			$this->excel->getActiveSheet()->setCellValue("C3", "Mã Lớp");
			// Ho va ten dem
			$this->excel->getActiveSheet()->setCellValue("D3", "Họ và tên đệm");
			// Ten
			$this->excel->getActiveSheet()->setCellValue("E3", "Tên");
			// Nam tot nghiep
			$this->excel->getActiveSheet()->setCellValue("F3", "Năm tốt nghiệp");
			// Phone
			$this->excel->getActiveSheet()->setCellValue("G3", "Số điện thoại bàn");
			// Hand phone
			$this->excel->getActiveSheet()->setCellValue("H3", "Số điện thoại di động");
			// Dia chi lien he
			$this->excel->getActiveSheet()->setCellValue("I3", "Địa chỉ liên hệ");
			// Dia chi email
			$this->excel->getActiveSheet()->setCellValue("J3", "Địa chỉ email");
			
			$survey_type_id  = $this->input->post("survey_type");
			$survey_id       = $this->input->post("survey");
			$faculties       = $this->input->post("faculty");
			$data_missing    = $this->input->post("data_missing");
			
			if (!empty($survey_id))
			{
				if(!empty($faculties))
				{
					$start_row = 4;
					foreach($faculties as $faculty_item)
					{
						if (empty($data_missing))
						{
							$data_export = $this->infor_model->gets_of_faculty($faculty_item, $survey_id);
							foreach($data_export as $data_export_item)
							{
								$this->excel->getActiveSheet()->setCellValue("A".$start_row,$data_export_item["student_id"]);
								$this->excel->getActiveSheet()->setCellValue("B".$start_row,$data_export_item["faculty_id"]);
								$this->excel->getActiveSheet()->setCellValue("C".$start_row,$data_export_item["class_id"]);
								$this->excel->getActiveSheet()->setCellValue("D".$start_row,$data_export_item["first_name"]);
								$this->excel->getActiveSheet()->setCellValue("E".$start_row,$data_export_item["last_name"]);
								$this->excel->getActiveSheet()->setCellValue("F".$start_row,$data_export_item["graduated_year"]);
								
								$phone_number = $data_export_item["phone"];
								$this->excel->getActiveSheet()->setCellValueExplicit("G".$start_row,"$phone_number",PHPExcel_Cell_DataType::TYPE_STRING);
								
								$hand_phone_number = $data_export_item["hand_phone"];
								$this->excel->getActiveSheet()->setCellValueExplicit("H".$start_row,"$hand_phone_number",PHPExcel_Cell_DataType::TYPE_STRING);
								
								$this->excel->getActiveSheet()->setCellValue("I".$start_row,$data_export_item["contact_address"]);
								$this->excel->getActiveSheet()->setCellValue("J".$start_row,$data_export_item["email"]);
								$start_row = $start_row + 1;
							}
						}
						else
						{
							$data_export = $this->infor_model->gets_students_infor_missing_infor_of_faculty($faculty_item, $survey_id, $data_missing);
							
							foreach($data_export as $data_export_item)
							{
								$this->excel->getActiveSheet()->setCellValue("A".$start_row,$data_export_item["student_id"]);
								$this->excel->getActiveSheet()->setCellValue("B".$start_row,$data_export_item["faculty_id"]);
								$this->excel->getActiveSheet()->setCellValue("C".$start_row,$data_export_item["class_id"]);
								$this->excel->getActiveSheet()->setCellValue("D".$start_row,$data_export_item["first_name"]);
								$this->excel->getActiveSheet()->setCellValue("E".$start_row,$data_export_item["last_name"]);
								$this->excel->getActiveSheet()->setCellValue("F".$start_row,$data_export_item["graduated_year"]);
								
								$phone_number = $data_export_item["phone"];
								$this->excel->getActiveSheet()->setCellValueExplicit("G".$start_row,"$phone_number",PHPExcel_Cell_DataType::TYPE_STRING);
								
								$hand_phone_number = $data_export_item["hand_phone"];
								$this->excel->getActiveSheet()->setCellValueExplicit("H".$start_row,"$hand_phone_number",PHPExcel_Cell_DataType::TYPE_STRING);
								
								$this->excel->getActiveSheet()->setCellValue("I".$start_row,$data_export_item["contact_address"]);
								$this->excel->getActiveSheet()->setCellValue("J".$start_row,$data_export_item["email"]);
								$start_row = $start_row + 1;
							}
						}
					}
				}
			}
			
			// ghi ra file
			$filename='danh_sach_sinh_vien_'.mdate("%d_%m_%Y-%h_%i_%a", now()).'.xls'; //save our workbook as this file name
			header('Content-Type: application/vnd.ms-excel'); //mime type
			header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
			header('Cache-Control: max-age=0'); //no cache

			//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
			//if you want to save it as .XLSX Excel 2007 format
			$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
			//force user to download the Excel file without writing it to server's HD
			$objWriter->save('php://output');
		}
		else
		{
			redirect("auth");
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
}

