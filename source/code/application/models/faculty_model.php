<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faculty_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// get
	function get($faculty_id=FALSE)
	{
		if($faculty_id===FALSE)
		{
			$query = $this->db->get('sur_faculty');
			return $query->result_array();
		}
		$query = $this->db->get_where('sur_faculty',array('faculty_id'=>$faculty_id));
		return $query->row_array();
	}
	
	function get_is_vocation($is_vocation=TRUE)
	{
		$query = $this->db->get_where('sur_faculty',array('is_vocation'=>$is_vocation));
		return $query->result_array();
	}
	
}