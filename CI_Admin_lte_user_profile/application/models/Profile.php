<?php

class Profile extends CI_Model{

	public function __construct()
	{
		$this->load->database();
		
	} 

	public function getdata_join($id)
	{
		$this->db->select('*');
		$this->db->from('profile');
		$this->db->where('profile.user_id',$id);
		$this->db->join('education_details','education_details.user_id = profile.user_id');
		$result = $this->db->get();
		if($result->num_rows() == 1) {
            return $result->row();
        }
        return false;
	}
	public function getdata($id)
	{
		$this->db->where('user_id',$id);
		$result = $this->db->get('profile');
		if($result->num_rows() == 1) {
            return $result->row();
        }
        return false;
	}

	public function profile_insert($data)
	{
		$result = $this->db->insert('profile',$data);
		if($result)
		{
			return true;
		}
		return false;
	}
	public function edu_insert($data)
	{
		$result = $this->db->insert('education_details',$data);
		if($result)
		{
			return true;
		}
		return false;
	}
	public function profile_edit($data)
	{
		$this->db->where('user_id',$data['user_id']);
		$result = $this->db->update('profile',$data);
		if($result)
		{
			return true;
		}
		return false;

	}
	public function edu_edit($data)
	{
		$this->db->where('user_id',$data['user_id']);
		$result = $this->db->update('education_details',$data);
		if($result)
		{
			return true;
		}
		return false;
	}
	public function get_country()
	{	
		$this->db->select('id,country_name');
		$this->db->order_by("country_name", "ASC");
		$result = $this->db->get('countries');

		
		if($result->num_rows()> 0) {
            return $result->result();
        }
        return false;

	}
	public function get_state($id)
	{
		$this->db->where('country_id',$id);
		$this->db->order_by("state_name", "ASC");
		$states = $this->db->get('states');
		$output = '<option value="">Select State</option>';
		if($states->num_rows()> 0) {
            foreach($states->result() as $state)
                        {
                          $output .= '<option value="'.$state->id.'">'.$state->country_name.'</option>';
                       }
        }
        return $output;
	}
	public function get_city($id)
	{
		$this->db->where('state_id',$id);
		$this->db->order_by("city_name", "ASC");
		$result = $this->db->get('cities');
		if($result->num_rows()> 0) {
            return $result->result();
        }
        return false;
	}
	public function fetch_state($id)
	{
	  $this->db->where('country_id', $id);
	  $this->db->order_by('state_name', 'ASC');
	  $query = $this->db->get('states');
	  $output = '<option value="">Select State</option>';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->id.'">'.$row->state_name.'</option>';
	  }
	  return $output;
	}

	public  function fetch_city($id)
 	{
	  $this->db->where('state_id', $id);
	  $this->db->order_by('city_name', 'ASC');
	  $query = $this->db->get('cities');
	  $output = '<option value="">Select City</option>';
	  foreach($query->result() as $row)
	  {
	   $output .= '<option value="'.$row->id.'">'.$row->city_name.'</option>';
	  }
	  return $output;
 	}
}