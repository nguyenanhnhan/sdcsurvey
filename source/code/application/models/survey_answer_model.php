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
	
	// Dem so sinh vien cua khoa tra loi cau hoi khao sat
	function count_fsurvey_of_question($faculty_id, $question_id)
	{
		$query=$this->db->query("SELECT COUNT(DISTINCT sur_answer.infor_id) AS 'sum_student'
								 FROM sur_infor INNER JOIN sur_answer ON sur_infor.infor_id = sur_answer.infor_id
								 WHERE question_id = '".$question_id."' AND
								 	   faculty_id = '".$faculty_id."'");
		return $query->row_array();
	}
	
	// Lay danh sach sinh vien cua khoa da tra loi theo mau tra loi
	function get_student_of_answer($faculty_id, $question_id, $answer_template_id)
	{
		$query=$this->db->query("SELECT sur_infor.infor_id, 
										sur_infor.student_id, 
										sur_infor.faculty_id, 
										sur_infor.class_id, 
										sur_infor.first_name, 
										sur_infor.last_name, 
										sur_infor.contact_address, 
										sur_infor.phone, 
										sur_infor.hand_phone, 
										sur_infor.email
								FROM sur_infor INNER JOIN sur_answer ON sur_infor.infor_id = sur_answer.infor_id
								WHERE sur_answer.question_id = '".$question_id."'
								AND sur_answer.answer_template_id = '".$answer_template_id."'
								AND sur_infor.faculty_id = '".$faculty_id."'");
		return $query->result_array();
	}
	
	// Lay noi dung tra loi
	function get_answer_content($infor_id, $answer_template_id)
	{
		$query = $this->db->query("SELECT sur_answer.content
				  				   FROM sur_answer
				  				   WHERE infor_id = '".$infor_id."' AND
				  				   answer_template_id = '".$answer_template_id."'");
		return $query->row_array();
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
	function delete_answer($infor_id)
	{
		return $this->db->delete('sur_answer',array('infor_id'=>$infor_id));
	}
}