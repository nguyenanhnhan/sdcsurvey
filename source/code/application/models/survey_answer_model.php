<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_answer_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// Lay thong tin cac cau tra loi cua nguoi khao sat
	function get($infor_id)
	{
		$query=$this->db->get_where('sur_answer',array('infor_id'=>$infor_id));
		return $query->result_array();
	}
	
	// insert
	function staff_insert($user_name, $infor_id, $question_id, $answer_template_id, $content)
	{
		$data=array(
			'infor_id'           => $infor_id,
			'question_id'        => $question_id,
			'answer_template_id' => $answer_template_id,
			'content'            => $content,
			'created_by_user_id' => $user_name,
			'created_on_date'    => mdate('%Y/%m/%d %H:%i:%s', now())
		);
		
		return $this->db->insert('sur_answer',$data);
	}	
	
	function student_insert($user_name, $infor_id, $question_id, $answer_template_id, $content)
	{
		$data=array(
			'infor_id'           => $infor_id,
			'question_id'        => $question_id,
			'answer_template_id' => $answer_template_id,
			'content'            => $content,
			'created_by_user_id' => $user_name,
			'created_on_date'    => mdate('%Y/%m/%d %H:%i:%s', now())
		);
		
		return $this->db->insert('sur_answer',$data);
	}
	
	// delete
	function delete_answer($infor_id, $question_id)
	{
		return $this->db->delete('sur_answer',array('infor_id'=>$infor_id, 'question_id'=>$question_id, 'answer_template_id'=>$answer_template_id));
	}
}