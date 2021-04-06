<?php

class Test extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	} 

	public function login_data($email,$password)
	{

		$this->db->where('email', $email);
        $this->db->where('password',$password);
        $query = $this->db->get('login');

        if($query->num_rows() == 1) {
            return $query->row();
        }

        return false;

	}

	public function display_data()
	{
		$query = $this->db->query('SELECT * FROM `login`');
		return $query->result();
	}

	public function current($email)
	{
		$this->db->where('email',$email);
		$this->db->where('logged_in_status',TRUE);
		$query = $this->db->get('login');

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
		
	}
	public function match_session($email,$session_id)
	{
		$this->db->where('email',$email);
		$this->db->where('session_id',$session_id);
		$query = $this->db->get('login');

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
	}
	public function update_session($email,$val)
	{
		$this->db->where('email',$email);
		$this->db->update('login',$val);
	}

	public function check_sesssion($session_id)
	{
		$this->db->where('session_id',$session_id);
		$query = $this->db->get('login');

		if($query->num_rows() == 1)
		{
			return $query->row();
		}
	}

	public function join_demo($id)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('comments','comments.uid = users.id');
		$query = $this->db->get();
		if($query->num_rows() == 1)
		{
			return $query->row();
		}
	}
}

?>