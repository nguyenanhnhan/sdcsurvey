<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_list_random_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// lay danh sach random
	function get()
	{
		$this->db->order_by('created_on_date','ASC');
		$query = $this->db->get('sur_list_random');
		return $query->result_array();
	}
	
	// chen du lieu vao table
	function insert($var_array)
	{
		return $this->db->insert('sur_list_random',$var_array);
	}
	
	// Xoa du lieu
	function delete($list_id)
	{
		$this->db->delete('sur_validation',array('list_id'=>$list_id));
		return $this->db->delete('sur_list_random', array('list_id'=>$list_id));
	}
}