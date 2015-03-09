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
			$sql = ('SELECT sf.*, f.faculty_name 
					 FROM sur_survey_faculty AS sf JOIN sur_faculty AS f ON sf.faculty_id = f.faculty_id 
					 WHERE sf.survey_id = "'.$survey_id.'"');
			return $this->db->query($sql)->result_array();
			
			/*
$query = $this->db->get_where('sur_survey_faculty', array('survey_id'=>$survey_id));
			return $query->result_array();
*/
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
		$query = "SELECT sur_survey_faculty.survey_id, sur_survey.survey_name, sur_survey.status
				  FROM sur_survey_faculty JOIN sur_survey ON sur_survey_faculty.survey_id = sur_survey.survey_id
				  WHERE sur_survey_faculty.faculty_id = '".$faculty_id."' ORDER BY sur_survey.status DESC";

		// $this->db->select(array('sur_survey_faculty.survey_id', 'survey_name', 'sur_survey.status'));
		// $this->db->from('sur_survey_faculty');
		// $this->db->join('sur_survey', 'sur_survey.survey_id = sur_survey_faculty.survey_id');
		// $this->db->where('sur_survey_faculty.faculty_id',$faculty_id);
		// $this->$this->db->order_by('sur_survey.status', 'desc');
		
		// $query = $this->db->get();
		
		return $this->db->query($query)->result_array();
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