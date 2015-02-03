<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->library('uuid');
	}
	
	// get all row
	function get($survey_type_id=FALSE, $survey_id=FALSE)
	{
		if ($survey_id === FALSE)
		{
			$query = $this->db->get_where('sur_survey', array('survey_type_id'=>$survey_type_id));
			return $query->result_array();
		}
		
		$query = $this->db->get_where('sur_survey', array('survey_id' => $survey_id));
		return $query->row_array();
	}
	
	// get date of survey
	function get_date_of_survey($survey_id)
	{
		$query = "SELECT survey_id, course, YEAR(created_on_date) AS created_on_year, MONTH(created_on_date) AS created_on_month
				  FROM sur_survey
				  WHERE survey_id = '".$survey_id."'";
		return $this->db->query($query)->row_array();
	}
	
	// lay cac phieu khao sat co nam lon hon
	function get_survey_less_than_year($year)
	{
		$query = "SELECT survey_id, course, YEAR(created_on_date) AS created_on_year, MONTH(created_on_date) AS created_on_month
				 FROM sur_survey
				 WHERE YEAR(created_on_date) >= ".$year;
		return $this->db->query($query)->result_array();
	}
	
	// lay cac cau hoi cung loai khao sat co cau hoi tuong ung
	function get_like_question($survey_type_id,$survey_id, $question_id)
	{
		$query = "SELECT sur_question.*
				  FROM sur_survey INNER JOIN sur_survey_type ON sur_survey.survey_type_id = sur_survey_type.survey_type_id
				  	   INNER JOIN sur_question ON sur_question.survey_id = sur_survey.survey_id
				  WHERE sur_survey_type.survey_type_id = '".$survey_type_id."'AND sur_question.survey_id='".$survey_id."' AND (sur_question.question_id = '".$question_id."' OR sur_question.reused_question_id = '".$question_id."')";
		return $this->db->query($query)->row_array();
	}
	
	// Lay cac cau tra loi cung loai cau tra loi mau de so  sanh
	function get_like_answer($question_id, $answer_template_id)
	{
		$query = "SELECT *
				  FROM sur_answer_template
				  WHERE question_id = '".$question_id."' AND (answer_template_id = '".$answer_template_id."' OR reused_answer_template_id = '".$answer_template_id."')";
		return $this->db->query($query)->row_array();
	}
	
	// delete row
	function delete($survey_id)
	{
		$this->db->delete('sur_survey_faculty', array('survey_id'=>$survey_id));
		$this->db->delete('sur_survey',array('survey_id'=>$survey_id));
	}
	
	// add row
	
	function add($uid, $survey_id, $stype_id, $reused_survey_id, $survey_name, $survey_modified_char_report, $course, $graduated_year,$is_graduated, $start_date, $end_date, 
				$is_vocation, $is_evaluated)
	{
		
		/**
		 * data
		 * 
		 * @param: $uid - Ma nguoi dung
		 * @param: $stype_id - Ma loai khao sat
		 * @param: $resued_survey_id - Ma phieu khao sat dung de sao chep
		 * @param: $survey_name - Ten phieu khao sat
		 * @param: $survey_modified_char_report - Ky tu dung dinh danh khi xuat report
		 * @param: $course - Khoa hoc
		 * @param: $graduated_year - Nam tot nghiep
		 * @param: $is_graduated - Da tot nghiep
		 * @param: $start_date - Ngay ap dung
		 * @param: $end_date - Ngay ket thuc
		 * @param: $is_vocation - 0: Bac dai hoc, 1: Bac Trung cap chuyen nghiep
		 * @param: $design_template_id - Mau thiet ke nhap lieu thong tin sinh vien
		 * @param: $title
		 * @param: $status - trang thai hoat dong
		 * @param: $is_evaluated - Phieu khao sat can duoc danh gia
		 *
		 */
		$data = array(
			'survey_id'               => $survey_id,
			'survey_type_id'          => $stype_id,
			'reused_survey_id'        => $reused_survey_id,
			'survey_name'             => $survey_name,
			'modified_char_report'    => $survey_modified_char_report,
			'course'                  => $course,
			'graduated_year'          => $graduated_year,
			'is_graduated'            => $is_graduated,
			'start_date'              => $start_date,
			'end_date'                => $end_date,
			'is_vocation'             => $is_vocation,
			'is_evaluated'            => $is_evaluated,
			'is_deleted'              => FALSE,
			'created_by_user_id'      => $uid,
			'created_on_date'         => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		return $this->db->insert('sur_survey',$data);
	}
	
	// update step 1
	function update_step_1($uid,$survey_id, $survey_name, $course, $graduated_year, $is_graduated, $is_vocation, $start_date, $end_date, $is_evaluated)
	{
		$data = array(
			'survey_name'              => $survey_name,
			'course'                   => $course,
			'graduated_year'           => $graduated_year,
			'is_graduated'             => $is_graduated,
			'start_date'               => $start_date,
			'end_date'                 => $end_date,
			'is_vocation'              => $is_vocation,
			'is_evaluated'             => $is_evaluated,
			'last_modified_by_user_id' => $uid,
			'last_modified_on_date'    => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		$this->db->where('survey_id', $survey_id);
		
		return $this->db->update('sur_survey', $data);
	}
	
	// update step 2
	function update_step_2($uid, $survey_id, $design_template_id)
	{
		$data = array(
			'design_template_id'       => $design_template_id,
			'last_modified_by_user_id' => $uid,
			'last_modified_on_date'    => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		$this->db->where('survey_id', $survey_id);
		
		return $this->db->update('sur_survey', $data);
	}
	
	// update step 3
	function update_step_3($uid, $survey_id, $title)
	{
		$data = array(
			'title' => $title,
			'last_modified_by_user_id' => $uid,
			'last_modified_on_date' => mdate('%Y/%m/%d %H:%i:%s', now())
		);
		
		$this->db->where('survey_id', $survey_id);
		return $this->db->update('sur_survey', $data);
	}
	
	// update status
	function update_status($uid, $survey_id, $status)
	{
		$data = array(
			"status"                     => $status,
			"last_modified_by_user_id"   => $uid,
			"last_modified_on_date"      => mdate("%Y/%m/%d %H:%i:%s", now())
		);
		$this->db->where("survey_id", $survey_id);
		return $this->db->update("sur_survey", $data);
	}
}