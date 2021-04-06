<?php

class Admin extends CI_Model{

	public function __construct()
	{
		$this->load->database();
		$this->tableName = 'fb_users';
        $this->primaryKey = 'id';
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

	public function register($records)
	{
		$result = $this->db->insert('login',$records);
		return $result;
	}

	 public function checkUser($userData = array()){
        if(!empty($userData)){
            //check whether user data already exists in database with same oauth info
            $this->db->select($this->primaryKey);
            $this->db->from($this->tableName);
            $this->db->where(array('oauth_provider'=>$userData['oauth_provider'], 'oauth_uid'=>$userData['oauth_uid']));
            $prevQuery = $this->db->get();
            $prevCheck = $prevQuery->num_rows();
            
            if($prevCheck > 0){
                $prevResult = $prevQuery->row_array();
                
                //update user data
                $userData['modified'] = date("Y-m-d H:i:s");
                $update = $this->db->update($this->tableName, $userData, array('id' => $prevResult['id']));
                
                //get user ID
                $userID = $prevResult['id'];
            }else{
                //insert user data
                $userData['created']  = date("Y-m-d H:i:s");
                $userData['modified'] = date("Y-m-d H:i:s");
                $insert = $this->db->insert($this->tableName, $userData);
                
                //get user ID
                $userID = $this->db->insert_id();
            }
        }
        
        //return user ID
        return $userID?$userID:FALSE;
    }
}