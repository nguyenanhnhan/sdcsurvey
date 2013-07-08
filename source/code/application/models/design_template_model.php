<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Design_template_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->load->library('uuid');
	}
	
	// get all row
	function get()
	{
		$query = $this->db->get('sur_design_template');
		return $query->result_array();
	}
	
	// delete row
	function delete()
	{
		
	}
	
	// add row
	
	function add()
	{
		
	}
	
	// update row
	function update()
	{
		
	}
}