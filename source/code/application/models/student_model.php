<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Student_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// Lay sinh vien chua khao sat thuoc khoa, lam mau khao sat tuong ung
	function get_student_of_faculty($faculty_id, $survey_id)
	{
		$query = $this->db->query("SELECT * 
								   FROM sur_student 
								   WHERE survey_id='".$survey_id."' AND faculty_id='".$faculty_id."'
								   									AND student_id NOT IN (SELECT student_id 
								   														   FROM sur_infor 
								   														   WHERE survey_id='".$survey_id."' AND faculty_id='".$faculty_id."' )");
		return $query->result_array();
	}
	
	function search_student($survey_id, $first_name, $last_name, $faculty_id, $class_id)
	{
		$query = "SELECT sur_student.student_id, 
						 sur_student.faculty_id, 
						 sur_faculty.faculty_name, 
						 sur_student.class_id, 
						 sur_student.survey_id, 
						 sur_student.first_name, 
						 sur_student.last_name, 
						 sur_student.place_of_birth, 
						 sur_student.date_of_birth, 
						 sur_student.graduated_ranking, 
						 sur_student.phone, 
						 sur_student.hand_phone, 
						 sur_student.email, 
						 sur_student.contact_address, 
						 sur_student.course, 
						 sur_student.graduated_year
				  FROM sur_student INNER JOIN sur_faculty ON sur_student.faculty_id = sur_faculty.faculty_id
				  WHERE survey_id = '".$survey_id."' 
				  		AND first_name = '".$first_name."' 
				  		AND last_name = '".$last_name."' 
				  		AND class_id = '".$class_id."' 
				  		AND sur_faculty.faculty_id = '".$faculty_id."'";
		return $this->db->query($query)->result_array();
	}
	
	function get_student_infor($survey_id, $student_id)
	{		
		// Ke do moi den thong tin sinh vien duoc import
		$query = $this->db->get_where('sur_student', array('survey_id'=>$survey_id, 'student_id'=>$student_id));
		return $query->row_array();
	}
	
	// Lay danh sach sinh vien co email
	function get_student_with_email($faculty_id,$survey_id)
	{
		$this->db->where('email !=',"");
		$query=$this->db->get_where('sur_student',array('survey_id'=>$survey_id,'faculty_id'=>$faculty_id));
		return $query->result_array();
	}
	
	// So luong sinh vien cua khoa tham gia khao sat
	function count_student_survey($survey_id, $faculty_id)
	{
		// So luong sinh vien toan truong tham gia khao sat
		if ($faculty_id==FALSE)
		{
			$query = $this->db->query("SELECT COUNT(*) AS 'sum_student'
								   FROM sur_student
								   WHERE survey_id = '".$survey_id."'");
		return $query->row_array();
		}
		else // So luong sinh vien cua khoa tham gia khao sat
		{
			$query = $this->db->query("SELECT COUNT(*) AS 'sum_student'
									   FROM sur_student
									   WHERE faculty_id = '".$faculty_id."' AND survey_id = '".$survey_id."'");
			return $query->row_array();
		}
	}
	
	// So luong sinh vien da tham gia khao sat
	function count_student_surveyed($survey_id, $faculty_id)
	{
		// So luong sinh vien toan truong da tham gia khao sat
		if ($faculty_id==FALSE)
		{
			$query = $this->db->query ("SELECT COUNT(*) AS 'sum_student_surveyed'
										FROM sur_infor
										WHERE sur_infor.survey_id= '".$survey_id."'");
			return $query->row_array();
		}
		else // So luong sinh vien cua khoa da tham gia khao sat
		{
			$query = $this->db->query ("SELECT COUNT(*) AS 'sum_student_surveyed'
										FROM sur_infor
										WHERE faculty_id = '".$faculty_id."' AND sur_infor.survey_id= '".$survey_id."'");
			return $query->row_array(); 
		}
	}
	
	// Lay lop hoc trong danh sach sinh vien
	function gets_class_by_faculty($survey_id, $faculty_id)
	{
		$query = $this->db->query("SELECT DISTINCT (class_id)
								   FROM sur_student
								   WHERE survey_id = '".$survey_id."' AND faculty_id = '".$faculty_id."'
								   ORDER BY class_id ASC;");
		return $query->result_array();
	}
	
	// insert student
	function insert_student ($data)
	{
		return $this->db->insert("sur_student",$data);
	}

	// update student
	function update_student ($data)
	{
		$data_update = array(
			'faculty_id'               => $data['faculty_id'],
			'class_id'                 => $data['class_id'],
			'first_name'               => $data['first_name'],
			'last_name'                => $data['last_name'],
			'place_of_birth'           => $data['place_of_birth'],
			'date_of_birth'            => $data['date_of_birth'],
			'graduated_ranking'        => $data['grad_rank'],
			'phone'                    => $data['phone'],
			'hand_phone'               => $data['hand_phone'],
			'email'                    => $data['email'],
			'contact_address'          => $data['contact_address'],
			'course'                   => $data['course'],
			'graduated_year'           => $data['graduated_year'],
			'last_modified_by_user_id' => $data['last_modified_by_user_id'],
			'last_modified_on_date'    => $data['last_modified_on_date']
		);

		$this->db->where(array('student_id'=>"'".$data['student_id']."'", 'survey_id'=>$data['survey_id']));
		return $this->db->update('sur_student', $data_update);
	}

}