<?php

class Mcq extends CI_Model{

	public function __construct()
	{
		$this->load->database();
	} 

	public function display_question()
	{

		$query = $this->db->get('question');
		return $query->result();
	}
	public function display_answer($id)
	{
		$query = $this->db->where('q_id',$id); 
		$query = $this->db->get('answers');
		return $query->result();
	}

	public function display_questions($id)
	{
		$this->db->select('*');
		$this->db->from('question');
		$this->db->join('answers','answers.q_id',$id);
		$query = $this->db->get();
		return $query->result();
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
	public function dis_question($id)
	{

		$this->db->where('id',$id);
		$query = $this->db->get('question');
		return $query->result();
	}
	public function check_answer($id)
	{
		$this->db->where('id',$id); 
		$this->db->where('status',TRUE);
		$query = $this->db->get('answers');
		if($query->num_rows() == 1) {
            return $query->row();
        }

        return false;
	}

	public function count_data()
	{
		$query = $this->db->query('SELECT * FROM question');
		return $query->num_rows();
	}
}

?>