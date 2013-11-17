<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_evaluation_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// lay thong tin theo list_id
	function get($list_id)
	{
		$query = "SELECT sur_evaluation.evaluation_id, 
						 sur_infor.first_name, 
						 sur_infor.last_name,
						 sur_infor.hand_phone, 
						 sur_evaluation.company_name, 
						 sur_evaluation.doing_job, 
						 sur_evaluation.rate_score, 
						 sur_evaluation.note
				 FROM sur_infor INNER JOIN sur_evaluation ON sur_infor.infor_id = sur_evaluation.infor_id
				 WHERE sur_evaluation.list_evaluation_id = '".$list_id."'";
				 
		return $this->db->query($query)->result_array();
	}
	
	// sinh danh sach random
	function generation($list_id)
	{
		$query = "SELECT sur_infor.infor_id
				  FROM sur_infor INNER JOIN sur_answer ON sur_infor.infor_id = sur_answer.infor_id
				  INNER JOIN sur_list_evaluation ON sur_answer.answer_template_id = sur_list_evaluation.answer_company_name AND sur_infor.faculty_id = sur_list_evaluation.faculty_id AND sur_infor.class_id = sur_list_evaluation.class_id
				  WHERE sur_list_evaluation.list_id = '".$list_id."'";
		return $this->db->query($query)->result_array();
	}
	
	// chen du lieu vao bang
	function insert($var_array)
	{
		return $this->db->insert('sur_evaluation',$var_array);
	}
	
	// xac nhan thong tin
	function validate($validation_id, $value, $user_name)
	{
		$data = array(
			'value'=>$value,
			'created_by_user_id'=>$user_name,
			'created_on_date'=>mdate('%Y/%m/%d %H:%i:%s', now())
		);
		$this->db->where('validation_id',$validation_id);
		return $this->db->update('sur_validation',$data);
	}
	
	function update_rate_score($evaluation_id, $rate_score, $user_name)
	{
		$data = array(
			'rate_score' => $rate_score,
			'created_by_user_id'=>$user_name,
			'created_on_date'=>mdate("%Y/%m/%d %H:%i:%s", now())
		);
		$this->db->where("evaluation_id",$evaluation_id);
		return $this->db->update("sur_evaluation",$data);
	}
	
	function get_note($evaluation_id)
	{
		$query = $this->db->get_where("sur_evaluation", array("evaluation_id"=>$evaluation_id));
		return $query->row_array();
	}
	
	function update_note($evaluation_id, $note, $user_name)
	{
		$data = array(
			'note' => $note,
			'last_modified_by_user_id'=>$user_name,
			'last_modified_on_date'=>mdate("%Y/%m/%d %H:%i:%s", now())
		);
		$this->db->where("evaluation_id",$evaluation_id);
		return $this->db->update("sur_evaluation",$data);
	}
}