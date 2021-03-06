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
	
	//get students list with missing information of faculty
	function gets_students_infor_missing_infor_of_faculty($faid, $survey_id, $missinfor)
	{
		$str = "SELECT * 
				FROM sur_infor 
				WHERE survey_id = '".$survey_id."' AND faculty_id = '".$faid."' AND (";
		$i=0; 
		foreach($missinfor as $infor)
		{
			if($i == 0)
				$str = $str . $infor . " = ''";
			else
				$str = $str . " OR " . $infor . " = ''";
			$i++;
		}
		$str = $str . ")";
		//echo $str;
		$query = $this->db->query($str);
		return $query->result_array();
	}
	
	// Insert thong tin nguoi duoc khao sat
	function staff_insert($user_name,$infor_id, $survey_id, $data_infor)
	{
		$data = array (
			'infor_id'           => $infor_id,
			'student_id'         => $data_infor['student_id'],
			'type_id'            => $data_infor['type_id'],
			'faculty_id'         => $data_infor['faculty_id'],
			'class_id'           => $data_infor['class_id'],
			'survey_id'          => $survey_id,
			'first_name'         => $data_infor['first_name'],
			'last_name'          => $data_infor['last_name'],
			'contact_address'    => $data_infor['address'],
			'note'               => $data_infor['note'],
			'graduated_year'     => $data_infor['graduated_year'],
			'phone'              => $data_infor['home_phone'],
			'hand_phone'         => $data_infor['hand_phone'],
			'email'              => $data_infor['email_address'],
			'survey_date'        => mdate('%Y/%m/%d %H:%i:%s',now()),
			'interviewer_id'     => $user_name,
			'interview_on_date'  => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		return $this->db->insert('sur_infor',$data);
	}
	
	function student_insert($user_name,$infor_id,$survey_id,$data_infor)
	{
		$data = array (
			'infor_id'           => $infor_id,
			'student_id'         => $data_infor['student_id'],
			'type_id'            => $data_infor['type_id'],
			'faculty_id'         => $data_infor['faculty_id'],
			'class_id'           => $data_infor['class_id'],
			'survey_id'          => $survey_id,
			'first_name'         => $data_infor['first_name'],
			'last_name'          => $data_infor['last_name'],
			'contact_address'    => $data_infor['address'],
			'graduated_year'     => $data_infor['graduated_year'],
			'phone'              => $data_infor['home_phone'],
			'hand_phone'         => $data_infor['hand_phone'],
			'email'              => $data_infor['email_address'],
			'survey_date'        => mdate('%Y/%m/%d %H:%i:%s',now()),
			'created_by_user_id' => $user_name,
			'created_on_date'    => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		return $this->db->insert('sur_infor',$data);
	}
	
	function staff_update($user_name,$infor_id,$survey_id, $data_infor)
	{
		$data = array (
			'student_id'                 => $data_infor['student_id'],
			'faculty_id'                 => $data_infor['faculty_id'],
			'class_id'                   => $data_infor['class_id'],
			'first_name'                 => $data_infor['first_name'],
			'last_name'                  => $data_infor['last_name'],
			'contact_address'            => $data_infor['address'],
			'graduated_year'             => $data_infor['graduated_year'],
			'phone'                      => $data_infor['home_phone'],
			'hand_phone'                 => $data_infor['hand_phone'],
			'email'                      => $data_infor['email_address'],
			'note'                       => $data_infor['note'],
			'survey_date'                => mdate('%Y/%m/%d %H:%i:%s',now()),
			'last_modified_by_user_id'   => $user_name,
			'last_modified_on_date'      => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		$this->db->where(array('infor_id'=>$infor_id, 'survey_id'=>$survey_id));
		return $this->db->update('sur_infor',$data);
	}
	
	// Phuc vu rieng cho report
	// Dem so sinh vien cua khoa thuc hien khao sat theo hinh thuc khao sat (type_id)
	function count_with_type($survey_id, $type_id, $faculty_id)
	{
		if ($type_id == FALSE)
		{
			$query = $this->db->query("SELECT COUNT(infor_id) AS total
									   FROM sur_infor
									   WHERE survey_id = '".$survey_id."' AND 
									   		 faculty_id = '".$faculty_id."'");
			return $query->row_array();
		}
		$query = $this->db->query("SELECT COUNT(infor_id) AS quantum
								   FROM sur_infor
								   WHERE survey_id = '".$survey_id."' AND 
								   		 type_id = '".$type_id."' AND 
								   		 faculty_id = '".$faculty_id."'");
		return $query->row_array();
	}
	
	
}