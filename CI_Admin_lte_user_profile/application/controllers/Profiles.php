<?php
	defined('BASEPATH') OR exit('direct script access allowed');

class Profiles extends CI_Controller{

	public function __construct()
	{
	parent::__construct();
	$this->load->model('admin');
	$this->load->model('profile');
	$this->load->database();
	$this->load->helper('url_helper');
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
   	$this->load->helper('array');

	}

	public function index($page='profile')
	{
		if(! file_exists(APPPATH.'views/profile/'.$page.'.php'))
		{
			show_404();
		}

		$data['title'] = ucfirst($page);
		
		if(!$this->session->userdata('id'))
		{
			$this->load->view('assets/header',$data);
			$this->load->view('admin_lte/admin',$data);
			$this->load->view('assets/footer',$data);	
		}
		else
		{
			$id=$this->session->userdata('id');
			$user_e = $this->profile->getdata_join($id);
			if($user_e)
			{
				$data['user'] = $user_e;	
			}
			$this->load->view('assets/header_2',$data);
			$this->load->view('assets/sidebar',$data);
			$this->load->view('profile/'.$page,$data);
			$this->load->view('assets/footer_2',$data);
		}
	}

	public function insert_data()
	{
		if($this->input->server("REQUEST_METHOD")==="POST")
		{
			$this->form_validation->set_rules('course', 'course', 'required');
			$this->form_validation->set_rules('skills', 'skills', 'required');
			$this->form_validation->set_rules('bio', 'bio', 'required');
			$this->form_validation->set_rules('college', 'college', 'required');
			//var_dump($this->session->userdata()); 
			
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message', 'Please enter Data properly');
	            redirect('profiles/edit_profile');
			}
			else		
			{
				$record['user_id']= $this->session->userdata('id'); 
				$record['college'] = $this->input->post("college");
				$record['course'] = $this->input->post("course");
				$data['user_id']= $this->session->userdata('id'); 
				$data['skills']= $this->input->post("skills");
				$data['bio'] = $this->input->post("bio");
				$user = $this->profile->profile_insert($data);
				$edu = $this->profile->edu_insert($record);

				if($user)
				{
					echo 2;

					exit();
				}
				else
				{
					$this->session->set_flashdata('message', 'Please enter Data properly');
	            	redirect('profiles/edit_profile');
				}
			}

		}
	}
	public function edit_data()
	{
		if($this->input->server("REQUEST_METHOD")==="POST")
		{
			$this->form_validation->set_rules('course', 'course', 'required');
			$this->form_validation->set_rules('skills', 'skills', 'required');
			$this->form_validation->set_rules('bio', 'bio', 'required');
			$this->form_validation->set_rules('college', 'college', 'required');
			//var_dump($this->session->userdata()); 
			
			if($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('message', 'Please enter Data properly');
	            redirect('profiles/edit_profile');
			}
			else		
			{
				$record['user_id']= $this->session->userdata('id'); 

				$record['course'] = $this->input->post("course");
				$record['college'] = $this->input->post("college");
				$data['user_id']= $this->session->userdata('id'); 
				$data['skills']= $this->input->post("skills");
				$data['bio'] = $this->input->post("bio");
				$user = $this->profile->profile_edit($data);
				$edu = $this->profile->edu_edit($record);

				if($user && $edu)
				{
					echo 2;

					exit();
				}
				else
				{
					$this->session->set_flashdata('message', 'Please enter Data properly');
	            	redirect('profiles/edit_profile');
				}
			}

		}
	}

	public function edit_profile($page='edit_profile')
	{
		if(! file_exists(APPPATH.'views/profile/'.$page.'.php'))
		{
			show_404();
		}

		$data['title'] = ucfirst($page);

		

		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			$data['user'] = null;

			$id = $this->session->userdata('id');
			$user_e = $this->profile->getdata_join($id);
			if($user_e)
			{
				$data['user'] = $user_e;	
			}
				
			$data['countries'] = $this->profile->get_country();

			
			$this->load->view('assets/header_2',$data);
			$this->load->view('assets/sidebar',$data);
			$this->load->view('profile/'.$page,$data);
			$this->load->view('assets/footer_2',$data);
		}
	}
	public function country()
	{
		$countries = $this->profile->get_country();
		return $countries;
	}
	public function state()
	{
		//$id = $this->input->post('id');
		/*$id = 1;
		$states = $this->profile->get_state($id);
		echo  $states;*/
		echo $this->profile->get_state($this->input->post('id'));
	}
	public function city($id)
	{
		$cities = $this->profile->get_city();
		return $cities; 
	}
	public function fetch_state()
	 {
	  if($this->input->post('id'))
	  {
	   echo $this->profile->fetch_state($this->input->post('id'));
	  }
	 }
	public function fetch_city()
	 {
	  if($this->input->post('id'))
	  {
	   echo $this->profile->fetch_city($this->input->post('id'));
	  }
	 }

	public function demo()
	{
		 $data['country'] = $this->profile->get_country();
 		 $this->load->view('profile/abc', $data);
	}
}


?>