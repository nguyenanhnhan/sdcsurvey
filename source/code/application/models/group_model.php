<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// Lay danh sach nguoi dung khong thuoc group
	function get_users_not_in_group($group_id)
	{
		$query = $this->db->query("SELECT *
								   FROM users
								   WHERE users.id NOT IN (SELECT users_groups.user_id FROM users_groups WHERE users_groups.group_id = '".$group_id."')");
		return $query->result_array();
	}
	
	// lay danh sach nguoi dung thuoc group
	function get_users_in_group($group_id)
	{
		$query = $this->db->query("SELECT *
								   FROM users
								   WHERE users.id IN (SELECT users_groups.user_id FROM users_groups WHERE users_groups.group_id = '".$group_id."')");
		return $query->result_array();
	}
	
	// Chen nguoi dung vao group
	function insert_to_group($group_id, $user_id)
	{
		$data = Array(
			'group_id'=>$group_id,
			'user_id'=>$user_id
		);
		
		return $this->db->insert('users_groups',$data);
	}
}