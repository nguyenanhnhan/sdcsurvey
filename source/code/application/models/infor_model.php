<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Infor_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// lay thong tin sinh vien da khao sat theo khoa, theo cach lay khao sat
	function get_of_faculty($faculty_id, $survey_id, $type_id)	
	{
		$query=$this->db->get_where('sur_infor',array("faculty_id"=>$faculty_id, "survey_id"=>$survey_id, "type_id"=>$type_id));
		return $query->result_array();
	}
	
	// lay tat ca thong tin sinh vien da khao sat theo khoa
	function gets_of_faculty($faculty_id, $survey_id)
	{
		$query=$this->db->get_where('sur_infor',array("faculty_id"=>$faculty_id,"survey_id"=>$survey_id));
		return $query->result_array();
	}
	
	function get_student_infor($survey_id, $student_id)
	{
		$query=$this->db->get_where('sur_infor',array("survey_id"=>$survey_id, "student_id"=>$student_id));
		return $query->row_array();
	}
	
	// Insert thong tin nguoi duoc khao sat
	function staff_insert($user_name,$infor_id, $survey_id, $data_infor)
	{
		$data = array (
			'infor_id'          => $infor_id,
			'student_id'        => $data_infor['student_id'],
			'type_id'           => $data_infor['type_id'],
			'faculty_id'        => $data_infor['faculty_id'],
			'class_id'          => $data_infor['class_id'],
			'survey_id'         => $survey_id,
			'first_name'        => $data_infor['first_name'],
			'last_name'         => $data_infor['last_name'],
			'contact_address'   => $data_infor['address'],
			'graduated_year'    => $data_infor['graduated_year'],
			'phone'             => $data_infor['home_phone'],
			'hand_phone'        => $data_infor['hand_phone'],
			'email'             => $data_infor['email_address'],
			'survey_date'       => mdate('%Y/%m/%d %H:%i:%s',now()),
			'interviewer_id'    => $user_name,
			'interview_on_date' => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		return $this->db->insert('sur_infor',$data);
	}
	
	function staff_update($user_name,$infor_id,$survey_id, $data_infor)
	{
		$data = array (
			'student_id'               => $data_infor['student_id'],
			'faculty_id'               => $data_infor['faculty_id'],
			'class_id'                 => $data_infor['class_id'],
			'first_name'               => $data_infor['first_name'],
			'last_name'                => $data_infor['last_name'],
			'contact_address'          => $data_infor['address'],
			'graduated_year'           => $data_infor['graduated_year'],
			'phone'                    => $data_infor['home_phone'],
			'hand_phone'               => $data_infor['hand_phone'],
			'email'                    => $data_infor['email_address'],
			'survey_date'              => mdate('%Y/%m/%d %H:%i:%s',now()),
			'last_modified_by_user_id' => $user_name,
			'last_modified_on_date'    => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		$this->db->where(array('infor_id'=>$infor_id, 'survey_id'=>$survey_id));
		return $this->db->update('sur_infor',$data);
	}
}