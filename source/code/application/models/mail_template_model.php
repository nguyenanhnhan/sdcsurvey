<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mail_template_model extends CI_Model
{	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
	}
	
	function save_mail_template($var_array)
	{
		return $this->db->insert('sur_mail_template',$var_array);
	}
	
	function get_mail_template($uid)
	{
		$query = $this->db->get_where("sur_mail_template",array("created_by_user_id"=>$uid));
		return $query->row_array();
	}
	
	function update_mail_template($var_array,$mail_template_id)
	{
		$this->db->where("mail_template_id",$mail_template_id);
		$this->db->update("sur_mail_template",$var_array);
	}
}