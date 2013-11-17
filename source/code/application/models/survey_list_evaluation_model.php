<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Survey_list_evaluation_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// lay danh sach trong bang sur_list_evaluation
	function get()
	{
		$this->db->order_by('created_on_date','ASC');
		$query = $this->db->get('sur_list_evaluation');
		return $query->result_array();
	}
	
	function get_by_faculty($faculty_id)
	{
		$this->db->order_by('created_on_date','ASC');
		$query=$this->db->get_where('sur_list_evaluation',array('faculty_id'=>$faculty_id));
		return $query->result_array();
	}
	
	// chen du lieu vao table
	function insert($var_array)
	{
		return $this->db->insert('sur_list_evaluation',$var_array);
	}
	
	// Xoa du lieu
	function delete($list_id)
	{
		$this->db->delete('sur_evaluation',array('list_evaluation_id'=>$list_id));
		return $this->db->delete('sur_list_evaluation', array('list_id'=>$list_id));
	}
}