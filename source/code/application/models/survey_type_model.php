<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_type_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->library('uuid');
	}
	
	// get all row
	function get($stype_id = FALSE)
	{
		if ($stype_id === FALSE)
		{
			$query = $this->db->get('sur_survey_type');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('sur_survey_type', array('survey_type_id' => $stype_id));
		return $query->row_array();
	}
	
	// delete row
	function delete($stype_id)
	{
		$this->db->delete('sur_survey_type',array('survey_type_id'=>$stype_id));
	}
	
	// add row
	function add($uid, $stype_name)
	{
		$data = array(
			'survey_type_id' => $this->uuid->v4(),
			'survey_type_name' => $stype_name,
			'is_deleted' => FALSE,
			'created_by_user_id' => $uid,
			'created_on_date' => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		return $this->db->insert('sur_survey_type',$data);
	}
	
	// update row
	function update($uid, $stype_id, $stype_name)
	{
		$data = array(
			'survey_type_name' =>$stype_name,
			'last_modified_by_user_id' =>$uid,
			'last_modified_on_date' => mdate('%Y/%m/%d %H:%i:%s',now())
		);
		
		$this->db->where('survey_type_id', $stype_id);
		
		return $this->db->update('sur_survey_type', $data);
	}
}