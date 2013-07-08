<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_answer_template_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// get
	function get($question_id, $template_id = FALSE)
	{
		if($template_id===FALSE)
		{
			$query = $this->db->get_where('sur_answer_template', array('question_id'=>$question_id));
			return $query->result_array();
		}
		$query = $this->db->get_where('sur_answer_template',array('question_id'=>$question_id, 'template_id'=>$template_id));
		return $query->row_array();
	}
	
	// insert row
	function insert($uid, $answer_template_id, $question_id, $option_type, $view_order, $label, $exception, $sub_answer)
	{
		$data = array(
			'answer_template_id' => $answer_template_id,
			'question_id'        => $question_id,
			'option_type'        => $option_type,
			'view_order'         => $view_order,
			'label'              => $label,
			'exception'          => $exception,
			'sub_answer'         => $sub_answer,
			'created_by_user_id' => $uid,
			'created_on_date'    => mdate('%Y/%m/%d %H:%m:%s', now())
		);
		
		return $this->db->insert('sur_answer_template', $data);
	}
	
}
