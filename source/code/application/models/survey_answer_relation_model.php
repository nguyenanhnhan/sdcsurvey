<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_answer_relation_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// get 
	function get($answer_template_id)
	{
		$query=$this->db->get_where('sur_answer_relation', array('answer_template_id'=>$answer_template_id));
		return $query->result_array();
	}
	
	function get_all()
	{
		$query=$this->db->get('sur_answer_relation');
		return $query->result_array();
	}
	
	function get_distinct()
	{
		$this->db->distinct('answer_template_id');
		$query=$this->db->get('sur_answer_relation');
		return $query->result_array();
	}
	
	// insert
	function insert($uid, $answer_template_id, $question_id, $attribute, $value)
	{
		$data = array(
			'answer_template_id'=>$answer_template_id,
			'question_id'=>$question_id,
			'attribute'=>$attribute,
			'value'=>$value,
			'created_by_user_id'=>$uid,
			'created_on_date'=>mdate('%Y/%m/%d %H:%m:%s',now())
		);
		// Kiem tra du lieu truoc khi insert
		// Neu trung khoa thi khong them vao
		$data_check = $this->db->get_where('sur_answer_relation', array('answer_template_id'=>$answer_template_id, 'question_id'=>$question_id))->result_array();
		if (count($data_check)==0) 
			return $this->db->insert('sur_answer_relation', $data);
	}
	
	function delete($answer_template_id)
	{
		return $this->db->delete('sur_answer_relation',array('answer_template_id'=>$answer_template_id));
	}
	
}