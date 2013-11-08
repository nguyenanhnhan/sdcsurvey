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
		$this->db->order_by('view_order','ASC');
		if($question_id===FALSE)
		{
			$query = $this->db->get_where('sur_question', array('survey_id'=>$survey_id));
			return $query->result_array();
		}
		$query = $this->db->get_where('sur_question',array('question_id'=>$question_id));
		return $query->result_array();
	}
	
	function get_question($question_id)
	{
		$query = $this->db->get_where('sur_question',array('question_id'=>$question_id));
		return $query->row_array();
	}
	
	function get_question_other($survey_id, $question_id)
	{
		$data_question = $this->db->get_where('sur_question',array('question_id'=>$question_id))->row_array();
		
		$this->db->where('question_id !=',$question_id);
		$this->db->where('view_order >',$data_question['view_order']);
		$this->db->order_by('view_order','ASC');
		$query = $this->db->get_where('sur_question',array('survey_id'=>$survey_id));
		return $query->result_array();
	}
	
	function get_question_answer_no_text($survey_id) 
	{
		$query = "SELECT *
				  FROM sur_question
				  WHERE survey_id = '".$survey_id."' AND question_id IN (SELECT at.question_id FROM sur_answer_template AS at WHERE at.option_type <> 't')
				  ORDER BY view_order ASC";
		return $this->db->query($query)->result_array();
	}
	
	function get_question_answer_with_text($survey_id)
	{
		$query = "SELECT *
				  FROM sur_question
				  WHERE survey_id='".$survey_id."' AND question_id IN (SELECT at.question_id FROM sur_answer_template AS at WHERE at.option_type = 't')
				  ORDER BY view_order ASC";	
		return $this->db->query($query)->result_array();
	}
	
	function get_max_view_order($survey_id)
	{
		$this->db->select_max('view_order');
		$query=$this->db->get_where('sur_question', array('survey_id'=>$survey_id));
		return $query->row_array();
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
	
	function delete($question_id)
	{
		// Tim sub_answer xoa truoc
		$answer_with_sub = $this->db->get_where('sur_answer_template', array('question_id'=>$question_id,'sub_answer'=>1))->row_array();
		if (!empty($answer_with_sub)) $this->db->delete('sur_answer_template', array('question_id'=>$answer_with_sub['answer_template_id']));
		
		// Xoa cac cau tra loi tuong ung question_id
		$this->db->delete('sur_answer_template', array('question_id'=>$question_id));
		
		// Xoa cau hoi
		return $this->db->delete('sur_question', array('question_id'=>$question_id));
	}
	
	function delete_answer($question_id)
	{
		// Tim sub_answer xoa truoc
		$answer_with_sub = $this->db->get_where('sur_answer_template', array('question_id'=>$question_id,'sub_answer'=>1))->row_array();
		if (!empty($answer_with_sub)) $this->db->delete('sur_answer_template', array('question_id'=>$answer_with_sub['answer_template_id']));
		
		// Xoa cac cau tra loi tuong ung question_id
		return $this->db->delete('sur_answer_template', array('question_id'=>$question_id));
	}
	
	// update question
	function update ($uid, $survey_id,$question_id, $reused_question_id, $content,$view_order, $max_option, $start_hide, $required, $view_style, $is_validated, $is_evaluated)
	{
		// cap nhat view order cac control sau
		/*
$this->db->where('view_order >', $view_order);
		$this->db->order_by('view_order', 'ASC');
		$data_temp = $this->db->get_where('sur_question', array('survey_id'=>$survey_id))->result_array();
		if(!empty($data_temp))
		{
			foreach ($data_temp as $item_update)
			{
				
				$data_temp_2 = array(
					'view_order'               => $item_update['view_order'] + 1,
					'last_modified_by_user_id' => $uid,
					'last_modified_on_date'    => mdate('%Y/%m/%d %H:%m:%s', now())
				);
				$this->db->where('question_id', $item_update['question_id']);
				$this->db->update('sur_question', $data_temp_2);
			}
		}
*/
		
		$data = array(
			'reused_question_id' => $reused_question_id,
			'content'            => $content,
			'max_option'         => $max_option,
			'start_hide'         => $start_hide,
			'required'           => $required,
			'view_style'         => $view_style,
			'is_validated'       => $is_validated,
			'is_evaluated'       => $is_evaluated,
			'last_modified_by_user_id' => $uid,
			'last_modified_on_date'    => mdate('%Y/%m/%d %H:%m:%s', now())
		);
		$this->db->where('question_id', $question_id);
		return $this->db->update('sur_question', $data);
	}
	
	// update sort
	function update_sort($uid, $question_id, $view_order)
	{
		$data=array(
			'view_order'               => $view_order,
			'last_modified_by_user_id' => $uid,
			'last_modified_on_date'    => mdate('%Y/%m/%d %H:%m:%s',now())
		);
		$this->db->where('question_id',$question_id);
		return $this->db->update('sur_question', $data);
	}
	
}
