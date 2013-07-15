<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		/* $this->load->library('uuid'); */
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
	
	// delete row
	function delete($survey_id)
	{
		$this->db->delete('sur_survey_faculty', array('survey_id'=>$survey_id));
		$this->db->delete('sur_survey',array('survey_id'=>$survey_id));
	}
	
	// add row
	
	function add($uid, $survey_id, $stype_id, $reused_survey_id, $survey_name, $course, $graduated_year,$is_graduated, $start_date, $end_date, 
				$is_vocation, $is_evaluated)
	{
		
		/**
		 * data
		 * 
		 * @param: $uid - Ma nguoi dung
		 * @param: $stype_id - Ma loai khao sat
		 * @param: $resued_survey_id - Ma phieu khao sat dung de sao chep
		 * @param: $survey_name - Ten phieu khao sat
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
		'survey_id'          => $survey_id,
		'survey_type_id'     => $stype_id,
		'reused_survey_id'   => $reused_survey_id,
		'survey_name'        => $survey_name,
		'course'             => $course,
		'graduated_year'     => $graduated_year,
		'is_graduated'       => $is_graduated,
		'start_date'         => $start_date,
		'end_date'           => $end_date,
		'is_vocation'        => $is_vocation,
		'is_evaluated'       => $is_evaluated,
		'is_deleted'         => FALSE,
		'created_by_user_id' => $uid,
		'created_on_date'    => mdate('%Y/%m/%d %H:%i:%s',now())
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
}