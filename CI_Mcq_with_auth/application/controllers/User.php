<?php
	defined('BASEPATH') OR exit('direct script access allowed');

class User extends CI_Controller{

	public function __construct()
	{
	parent::__construct();
	$this->load->model('users');
	$this->load->database();
	$this->load->helper('url_helper');
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('form_validation');
	}

	public function register($page="register")
	{
		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}

	if($this->input->server("REQUEST_METHOD")==="POST")
	{


		$data['username'] = $this->input->post("username");
		$data['email'] = $this->input->post("email");
		$data['contact'] = $this->input->post("contact");
		$data['password'] = $this->input->post("password");




		$result = $this->users->insert_user($data);

		if($result>0)
		{
			$this->home();
		}

	}
	$data['title'] = ucfirst($page);

	$this->load->view('templates/header',$data);
	$this->load->view('user/'.$page,$data);
	$this->load->view('templates/footer',$data);
	}

	public function home($page="home")
	{
		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = ucfirst($page);

		$this->load->view('templates/header',$data);
		$this->load->view('user/'.$page,$data);
		$this->load->view('templates/footer',$data);

	}

	public function profile($id=Null,$page="profile")
	{
		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}

		$data['title'] = ucfirst($page);

		$data['record'] = $this->users->display_user($id);

	$this->load->view('templates/header',$data);
	$this->load->view('user/'.$page,$data);
	$this->load->view('templates/footer',$data);

	}

	public function profile_e($id=Null,$page="edit_profile")
	{
		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}

		if($this->input->server("REQUEST_METHOD")==="POST")
		{
			$value['id']= $this->input->post('id');
			$value['username'] = $this->input->post("username");
			$value['email'] = $this->input->post("email");
			$value['contact'] = $this->input->post("contact");
			$value['password'] = $this->input->post("password");
			//$this->load->view('user/demo',$value);

			$this->users->update_data($id,$value);
			return redirect('/user/profile/'.$id);

		}
		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			
			$data['id'] = $id;
			$data['record'] = $this->users->display_user($id);
			$data['title'] = $page;

			$this->load->view('templates/header',$data);
			$this->load->view('user/'.$page,$data);
			$this->load->view('templates/footer',$data);
		}     
	}


	public function login($page='login')
	{

		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}
		if($this->input->server("REQUEST_METHOD")==="POST")
		{

			$email = $this->security->xss_clean($this->input->post('email'));
			$password = $this->security->xss_clean($this->input->post('password'));

			$result = $this->users->login($email,$password);

			if($result)
			{
				$user_data = array(
				'id' => $result->id,
				'username' => $result->username
				);

				$this->session->set_userdata($userdata);
				redirect('user/profile/');
			}


		}

		/*$email = $this->security->xss_clean($this->input->post('email'));
        $password = $this->security->xss_clean($this->input->post('password'));*/
        $this->load->view('templates/header',$data);
		$this->load->view('user/'.$page,$data);
		$this->load->view('templates/footer',$data);
	}


	public function insert($page="insert")
	{
		if(! file_exists(APPPATH.'views/user/'.$page.'.php'))
		{
			show_404();
		}
		

		if($this->input->server("REQUEST_METHOD")==="POST")
		{
		$this->form_validation->set_rules('username', 'username', 'required|alpha');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('contact', 'contact', 'required|numeric|exact_length[10]');
		$this->form_validation->set_rules('password', 'password', 'required');
			if($this->form_validation->run() == FALSE)
			{
				$data['title'] = ucfirst($page);
				$this->load->view('templates/header',$data);
				$this->load->view('user/'.$page,$data);
				$this->load->view('templates/footer',$data);

			}
			else
			{

			$value['username'] = $this->input->post("username");
			$value['email'] = $this->input->post("email");
			$value['contact'] = $this->input->post("contact");
			$value['password'] = $this->input->post("password");

			$result = $this->users->insert_user($value);
			
			if($result>0)
			{
				$this->home();
			}
			}


		}
		
		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			$data['title'] = ucfirst($page);
			$this->load->view('templates/header',$data);
			$this->load->view('user/'.$page,$data);
			$this->load->view('templates/footer',$data);
		}
	}

}
?>