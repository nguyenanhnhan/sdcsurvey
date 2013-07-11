<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Province_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}

	// get
	function get()
	{
		$query = $this->db->get('sur_province');
		return $query->result_array();
	}
	
}
