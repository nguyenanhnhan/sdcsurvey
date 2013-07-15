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
		$query = $this->db->query("SELECT * FROM sur_student WHERE survey_id='".$survey_id."' AND faculty_id='".$faculty_id."'
		AND student_id NOT IN (SELECT student_id FROM sur_infor WHERE survey_id='".$survey_id."' AND faculty_id='".$faculty_id."' )");
		return $query->result_array();
		
	}
	
	function get_student_infor($survey_id, $student_id)
	{		
		// Ke do moi den thong tin sinh vien duoc import
		$query = $this->db->get_where('sur_student', array('survey_id'=>$survey_id, 'student_id'=>$student_id));
		return $query->row_array();
	}
	
}