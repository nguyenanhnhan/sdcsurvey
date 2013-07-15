<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_faculty_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// get
	function get($survey_id=FALSE, $faculty_id=FALSE)
	{
		// Khong co bien tham so $survey_id
		if ($survey_id===FALSE)
		{
			$query = $this->db->get_where('sur_survey_faculty', array('faculty_id'=>$faculty_id));
			return $query->result_array();
		}
		// Khong co bien tham so $faculty_id
		elseif ($faculty_id===FALSE)
		{
			$query = $this->db->get_where('sur_survey_faculty', array('survey_id'=>$survey_id));
			return $query->result_array();
		}
		// Khong co ca 2 bien tham so
		else
		{
			$query = $this->db->get('sur_survey_faculty');
			return $query->result_array();
		}
		
	}
	
	// Lay danh sach phieu khao sat theo khoa
	function get_survey($faculty_id)
	{	
		$this->db->select(array('sur_survey_faculty.survey_id', 'survey_name'));
		$this->db->from('sur_survey_faculty');
		$this->db->join('sur_survey', 'sur_survey.survey_id = sur_survey_faculty.survey_id');
		$this->db->where('sur_survey_faculty.faculty_id',$faculty_id);
		
		$query = $this->db->get();
		
		return $query->result_array();
	}
	
	// delete row
	function delete($survey_id)
	{
		// Xoa vinh vien khoi he thong
		return $this->db->delete('sur_survey_faculty', array('survey_id'=>$survey_id));
	}
	
	// insert row
	function insert($uid, $survey_id, $faculty_id)
	{
		$data = array (
			'survey_id'          => $survey_id,
			'faculty_id'         => $faculty_id,
			'created_by_user_id' => $uid,
			'created_on_date'    => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		return $this->db->insert('sur_survey_faculty', $data);
	}
	
}