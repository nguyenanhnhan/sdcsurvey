<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_answer_template_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// get
	function get($question_id, $answer_template_id = FALSE)
	{
		$this->db->order_by('view_order','ASC');
		if($answer_template_id===FALSE)
		{
			$query = $this->db->get_where('sur_answer_template', array('question_id'=>$question_id));
			return $query->result_array();
		}
		$query = $this->db->get_where('sur_answer_template',array('question_id'=>$question_id, 'template_id'=>$answer_template_id));
		return $query->row_array();
	}
	
	function get_answer_template($answer_template_id)
	{
		$query = $this->db->get_where('sur_answer_template', array('answer_template_id'=>$answer_template_id));
		return $query->row_array();
	}
	
	// insert row
	function insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception, $answ_required, $sub_answer)
	{
		$data = array(
			'answer_template_id' => $answer_template_id,
			'question_id'        => $question_id,
			'option_type'        => $option_type,
			'view_order'         => $view_order,
			'label'              => $label,
			'exception'          => $exception,
			'required'           => $answ_required,
			'sub_answer'         => $sub_answer,
			'created_by_user_id' => $uid,
			'created_on_date'    => mdate('%Y/%m/%d %H:%i:%s', now())
		);
		
		return $this->db->insert('sur_answer_template', $data);
	}
	
	// update
	function update_effect($uid, $answer_template_id, $is_effect)
	{
		$data=array(
			'is_effect'                => $is_effect,
			'last_modified_by_user_id' => $uid,
			'last_modified_on_date'    => mdate('%Y/%m/%d %H:%i:%s', now())
		);
		$this->db->where("answer_template_id",$answer_template_id);
		
		return $this->db->update('sur_answer_template', $data);
	}
	
	// update sort
	function update_sort($uid, $answer_template_id, $view_order)
	{
		$data = array(
				"view_order"                => $view_order,
				"last_modified_by_user_id"  => $uid,
				"last_modified_on_date"     => mdate("%Y/%m/%d %H:%i:%s", now())
		);
		$this->db->where("answer_template_id", $answer_template_id);
		return $this->db->update("sur_answer_template", $data);
	}
	
}
