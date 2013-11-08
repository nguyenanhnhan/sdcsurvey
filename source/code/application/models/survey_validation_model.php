<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_validation_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// lay thong tin theo list_id
	function get($list_id)
	{
		$query = "SELECT sur_validation.infor_id,
						 sur_validation.list_id,
						 sur_validation.validation_id, 
						 sur_list_random.survey_id, 
						 sur_infor.student_id, 
						 sur_infor.class_id, 
						 sur_infor.first_name, 
						 sur_infor.last_name, 
						 sur_validation.company_name, 
						 sur_validation.company_address, 
						 sur_validation.company_phone, 
						 sur_validation.doing_job, 
						 sur_validation.`value`, 
						 sur_validation.note, 
						 sur_validation.created_by_user_id, 
						 sur_infor.type_id, 
						 sur_infor.faculty_id
				 FROM sur_validation INNER JOIN sur_infor ON sur_validation.infor_id = sur_infor.infor_id
				 INNER JOIN sur_list_random ON sur_validation.list_id = sur_list_random.list_id
				 WHERE sur_validation.list_id = '".$list_id."'";
				 
		return $this->db->query($query)->result_array();
	}
	
	// sinh danh sach random
	function generation($faculty_id, $answer_template_id)
	{
		$query = "SELECT sur_infor.infor_id, sur_infor.first_name, sur_infor.last_name
				  FROM sur_infor INNER JOIN sur_answer ON sur_infor.infor_id = sur_answer.infor_id
				  WHERE sur_infor.faculty_id = '".$faculty_id."' AND 
				  sur_answer.answer_template_id = '".$answer_template_id."'
				  ORDER BY RAND()";
		return $this->db->query($query)->result_array();
	}
	
	// chen du lieu vao bang
	function insert($var_array)
	{
		return $this->db->insert('sur_validation',$var_array);
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
}