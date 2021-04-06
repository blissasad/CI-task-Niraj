<?php

class Users extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	} 

	public function insert_user($data)
	{
		$this->db->insert('user',$data);
		return $this->db->insert_id();
	}

	public function display_data()
	{
		$query = $this->db->query('SELECT * FROM `user`');
		return $query->result();
	}

	public function display_user($id)
	{

		$this->db->where('id',$id);	
		$result = $this->db->get('user');

		if($result->num_rows() >0)
		{
			return $result->row_array();
		}

	}

	public function update_user($id,$value)
	{
		$this->db->where('id',$id);
		$this->db->update('user',$value);

	}
	public function update_data($id,$value)
	{
		$this->db->where('id',$id);
		$this->db->update('user',$value);
	}

	public function delete_user($id)
	{
		$this->db->where('id',$id);
		$this->db->delete('user');
	}

	public function login($email,$password)
	{
		$this->db->where('email',$email);
		$this->db->where('password',$password);
		$query = $this->db->get('user');

		if($query->num_rows() == 1) {
            return $query->row();
        }
	}
}

?>
