<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Type_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	// get
	function gets()
	{
		$this->db->order_by("view_order", "asc");
		$query = $this->db->get('sur_type');
		return $query->result_array();
	}
	
}
