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
		$query = $this->db->query("SELECT COUNT(*) AS 'sum_student'
								   FROM sur_student
								   WHERE faculty_id = '".$faculty_id."' AND survey_id = '".$survey_id."'");
		return $query->row_array();
	}
}