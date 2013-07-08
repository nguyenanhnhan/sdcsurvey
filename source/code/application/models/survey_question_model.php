<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_question_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	/*
	question_id
	reused_question_id
	survey_id
	content
	view_order
	max_option
	start_hide
	required
	view_style
	is_vocation
	is_validated
	is_evaluated
	is_deleted
	created_by_user_id
	created_on_date
	last_modified_by_user_id
	last_modified_on_date
*/
	// get
	function get($survey_id, $question_id = FALSE)
	{
		if($question_id===FALSE)
		{
			$query = $this->db->get_where('sur_question', array('survey_id'=>$survey_id));
			return $query->result_array();
		}
		$query = $this->db->get_where('sur_question',array('survey_id'=>$survey_id, 'question_id'=>$question_id));
		return $query->result_array();
	}
	
	// insert row
	function insert($uid, $question_id, $reused_question_id, $survey_id, $content, $view_order, 
	$max_option, $start_hide, $required, $view_style, $is_validated, $is_evaluated)
	{
		$data = array(
			'question_id'        => $question_id,
			'reused_question_id' => $reused_question_id,
			'survey_id'          => $survey_id,
			'content'            => $content,
			'view_order'         => $view_order,
			'max_option'         => $max_option,
			'start_hide'         => $start_hide,
			'required'           => $required,
			'view_style'         => $view_style,
			'is_validated'       => $is_validated,
			'is_evaluated'       => $is_evaluated,
			'created_by_user_id' => $uid,
			'created_on_date'    => mdate('%Y/%m/%d %H:%m:%s', now())
		);
		
		return $this->db->insert('sur_question', $data);
	}
	
}
