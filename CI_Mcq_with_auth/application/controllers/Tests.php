<?php
	defined('BASEPATH') OR exit('direct script access allowed');

class Tests extends CI_Controller{

	public function __construct()
	{
	parent::__construct();
	$this->load->model('test');
	$this->load->database();
	$this->load->helper('url_helper');
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
  /*  if($this->session->userdata('email'))
	    {
	    	$session_id = $this->session->userdata('session_id');
	    	$ch = $this->test->check_sesssion($session_id);
	    	if(!$ch)
	    	{
	    		$this->logout();
	    	}

	    }*/

	}



	public function index($page="home")
	{
		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}
		$data['users'] = $this->test->display_data();
		$data['title'] = ucfirst($page);

		$this->load->view('templates/header',$data);
		$this->load->view('test/'.$page,$data);
		$this->load->view('templates/footer',$data);
	}

	public function login($page="login")
	{
		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}

		if($this->input->server("REQUEST_METHOD")==="POST")
		{
			$email= $this->input->post("email");
			$cur = $this->test->current($email);
			if($cur)
			{

				$session_id = $this->session->userdata('session_id');
				$mat = $this->session->match_session($email,$session_id);
				if(!$mat)
				{

					$this->load->library('session');
					$this->session->sess_destroy();
					/*$val = TRUE;
					$this->test->update_session($email,$session_id,$val);*/

				}

				
				/*$userdata = array(
                'id' => '',
                'username' => '',
                'email' => ''
            	);*/
            	//$this->session->unset_userdata($userdata);

            	$email= $this->input->post("email");
				$password = $this->input->post("password");
				$user = $this->test->login_data($email,$password);
				$this->load->library('session');
				if($user)
				{
	            	$userdata = array(
	                'id' => $user->id,
	                'username' => $user->username,
	                'email' => $user->email
	            	);
	            $this->session->set_userdata($userdata);
	            $session_id = $this->session->userdata('session_id');
	            $val['logged_in_status'] = TRUE;
				$val['session_id'] = $session_id;
				$this->test->update_session($email,$val);
				$this->session->set_flashdata('message', 'success '.$val->$session_id);
	            redirect('tests/login');
				}
				else
				{
				$this->session->set_flashdata('message', 'Invalid email or password');
	            redirect('tests/login');
				}
				
			}
			else
			{
				$email= $this->input->post("email");
				$password = $this->input->post("password");
				$user = $this->test->login_data($email,$password);
				$this->load->library('session');
				if($user)
				{
	            	$userdata = array(
	                'id' => $user->id,
	                'username' => $user->username,
	                'email' => $user->email
	            	);
	            $this->session->set_userdata($userdata);
	            $session_id = $this->session->userdata('session_id');
	            $val['logged_in_status'] = TRUE;
				$val['session_id'] = $session_id;
				$this->test->update_session($email,$val);
				$this->session->set_flashdata('message', 'success '.$val->$session_id);
	            redirect('tests/login');
				}
				else
				{
				$this->session->set_flashdata('message', 'Invalid email or password');
	            redirect('tests/login');
				}

			}
			
			/*else
			{
				$this->session->set_flashdata('message', 'Some user is alredy logged in');
	            redirect('tests/login');
			}*/
		}


		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			$data['title'] = ucfirst($page);

			$this->load->view('templates/header',$data);
			$this->load->view('test/'.$page,$data);
			$this->load->view('templates/footer',$data);
		}
	}
	public function logout()
	{
		$email = $this->session->userdata('email');
		$val['logged_in_status'] = FALSE;
		$this->test->update_session($email,$val);
		$this->session->sess_destroy();
        redirect('tests/login');
	}

	/*public function ajax_refresh_session(){
        //check authorized
       // $this->session->grant_access('user|admin|clinic_admin|doctor');
                
                //load json helper
        $this->load->helper('json');
        
        //Call the sess_update method to actually regenerate the session ID
        if( $this->session->is_logged_in() )
            $this->session->sess_regenerate(false);

        json_response("Session refreshed");
    } */

 }

?>
