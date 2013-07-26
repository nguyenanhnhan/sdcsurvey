<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Group_permission_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	// Lay thong tin cac khoa chua duoc phan quyen trong group
	function get_faculties($group_id)
	{
		$query = $this->db->query("SELECT *
								   FROM sur_faculty
								   WHERE sur_faculty.faculty_id NOT IN (SELECT faculty_id FROM sur_group_permission WHERE group_id='".$group_id."') AND is_vocation = 0
								   ORDER BY faculty_id ASC");
		return $query->result_array();
	}
	
	// Lay thong tin phan quyen cho nhom
	function get_group_permission($group_id)
	{
		$this->db->select ('id,group_id,sur_faculty.faculty_id,view,edit,sur_faculty.faculty_name');
		$this->db->from ('sur_group_permission');
		$this->db->join ('sur_faculty','sur_faculty.faculty_id = sur_group_permission.faculty_id');
		$this->db->where(array('group_id'=>$group_id));
		$this->db->order_by('sur_faculty.faculty_name asc');
		$query = $this->db->get();
	
		return $query->result_array();
	}
	
	function insert_permission($uid, $group_id, $faculty_id, $view, $edit)
	{
		$data = Array(
			'group_id'           => $group_id,
			'faculty_id'         => $faculty_id,
			'view'               => $view,
			'edit'               => $edit,
			'created_by_user_id' => $uid,
			'created_on_date'    => mdate("%Y/%m/%d %H:%i:%s",now())
		);
		
		return $this->db->insert('sur_group_permission',$data);
	}
	
	function delete_permission($id)
	{
		return $this->db->delete('sur_group_permission', array('id'=>$id));	
	}
}