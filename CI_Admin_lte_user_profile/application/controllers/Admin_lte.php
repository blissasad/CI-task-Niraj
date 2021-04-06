<?php
	defined('BASEPATH') OR exit('direct script access allowed');

class Admin_lte extends CI_Controller{

	public function __construct()
	{
	parent::__construct();
	$this->load->model('admin');
	$this->load->database();
	$this->load->helper('url_helper');
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
   	$this->load->helper('array');

	}

	public function login_ajax()
	{
		  /*Data that we receive from ajax*/
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        //$check = $this->input->post('check');

        $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
            /*If Both Username &  Password that we recieved is invalid, go here, and return 4 as output*/
            $this->session->set_flashdata('message', 'Invalid email or password');
	            redirect('admin_lte/login_page');
        } 
        else 
        {
            /*Create object of model MLogin.php file under models folder*/
           // $Login = new MLogin();
            /*validate($username, $Password) is the function in Mlogin.php*/
            $user = $this->admin->login_data($email,$password);
            if ($user) {
                /*If everything is fine, then go here, and return 1 as output and set session*/
                $userdata = array(
	                'id' => $user->id,
	                'username' => $user->username,
	                'email' => $user->email
	            	);
                	/*if($check)
                	{
                		$cookie = array(
					    'email'   => $user->email,
					    'password'  => $user->password,
					    'username' => $user->username, // Two weeks
						);
						set_cookie($cookie);
                	}*/
	            $this->session->set_userdata($userdata);
                echo 2;
				exit();
            } else {
                /*If Both Username &  Password that we recieved is invalid, go here, and return 5 as output*/
               $this->session->set_flashdata('message', 'Something Went Wrong!');
	            redirect('admin_lte/login_page');
            }
        }		
	}

	public function register_ajax($page='register')
	{
		if(! file_exists(APPPATH.'views/admin_lte/'.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = ucfirst($page);
		if($this->input->server("REQUEST_METHOD")==="POST")
		{
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message', 'Please enter Data properly');
	            redirect('admin_lte/register_ajax');
			}
			else		
			{
				$records['username'] = $this->input->post("username");
				$records['email']= $this->input->post("email");
				$records['password'] = $this->input->post("password");
				$user = $this->admin->register($records);

				if($user)
				{
					echo 2;
					exit();
				}
				else
				{
					$this->session->set_flashdata('message', 'Please enter Data properly');
	            	redirect('admin_lte/register_ajax');
				}
			}
		}

		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			$this->load->view('assets/header',$data);
			$this->load->view('admin_lte/'.$page,$data);
			$this->load->view('assets/footer',$data);
		}


	}
	public function login_page($page = 'admin')
	{
		if(! file_exists(APPPATH.'views/admin_lte/'.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = ucfirst($page);
		if(!$this->session->userdata('id'))
		{
			$this->load->view('assets/header',$data);
			$this->load->view('admin_lte/'.$page,$data);
			$this->load->view('assets/footer',$data);
		}
		else
		{
			redirect('profiles/');
		}
	}



	public function login($page="admin")
	{
		if(! file_exists(APPPATH.'views/admin_lte/'.$page.'.php'))
		{
			show_404();
		}
		//$data['users'] = $this->test->display_data();
		$data['title'] = ucfirst($page);
		if($this->input->server("REQUEST_METHOD")==="POST")
		{	

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'required');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message', 'Invalid email or password');
	            redirect('admin_lte/login');
			}
			else
			{
	        	$email= $this->input->post("email");
				$password = $this->input->post("password");
				$user = $this->admin->login_data($email,$password);
				$this->load->library('session');
				if($user)
				{
	            	$userdata = array(
	                'id' => $user->id,
	                'username' => $user->username,
	                'email' => $user->email
	            	);
	            $this->session->set_userdata($userdata);
				$this->session->set_flashdata('message', 'success ');
				$cookie = array(
					    'email'   => $records['email'],
					    'password'  => $records['password'],
					    'username' => $records['username'] // Two weeks
					);
				set_cookie($cookie);
	            redirect('admin_lte/success');
				}
				else
				{
				$this->session->set_flashdata('message', 'User not found. Please check email and password.');
	            redirect('admin_lte/login');
				}	
			}				
		}	

		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			$this->load->view('assets/header',$data);
			$this->load->view('admin_lte/'.$page,$data);
			$this->load->view('assets/footer',$data);
		}


	}
	public function logout()
	{
		$this->session->sess_destroy();
        redirect('admin_lte/login_page');
	}

	public function success($page="demo")
	{
		if(! file_exists(APPPATH.'views/admin_lte/'.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = ucfirst($page);
		$this->load->view('assets/header',$data);
		$this->load->view('admin_lte/'.$page,$data);
		$this->load->view('assets/footer',$data);
	}

	public function register($page="register")
	{
		if(! file_exists(APPPATH.'views/admin_lte/'.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = ucfirst($page);

		if($this->input->server("REQUEST_METHOD")==="POST")
		{
			$this->form_validation->set_rules('username', 'username', 'required|alpha');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'required|min_length[6]|max_length[20]');
			$this->form_validation->set_rules('c_password', 'c_password', 'required|matches[password]');
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message', 'Please enter Data properly');
	            redirect('admin_lte/register');
			}
			else		
			{
				$records['username'] = $this->input->post("username");
				$records['email']= $this->input->post("email");
				$records['password'] = $this->input->post("password");
				$user = $this->admin->register($records);

				if($user)
				{
					$this->session->set_flashdata('message', 'Registerd Successfully. Please Login.');
					$cookie = array(
					    'email'   => $records['email'],
					    'password'  => $records['password'],
					    'username' => $records['username'] // Two weeks
					);

					set_cookie($cookie);
	            	redirect('admin_lte/login');
				}
				{
					$this->session->set_flashdata('message', 'Something went wrong');
	            	redirect('admin_lte/register');
				}

			}

		}

		if($this->input->server("REQUEST_METHOD")==="GET")
		{		
			$this->load->view('assets/header',$data);
			$this->load->view('admin_lte/'.$page,$data);
			$this->load->view('assets/footer',$data);
		}
	}
}