<?php
	defined('BASEPATH') OR exit('direct script access allowed');

class Admin extends CI_Controller{

	public function __construct()
	{
	parent::__construct();
	$this->load->model('users');
	$this->load->database();
	$this->load->helper('url_helper');
	$this->load->helper('url');
	}

	public function index($page="home")
	{
		if(! file_exists(APPPATH.'views/admin/'.$page.'.php'))
		{
			show_404();
		}
	$data['title'] = ucfirst($page);
	$data['records'] = $this->users->display_data();

	$this->load->view('templates/header',$data);
	$this->load->view('admin/'.$page,$data);
	$this->load->view('templates/footer',$data);

	}
	public function pro_edit($id=Null,$page="edit_profile")
	{
		if(! file_exists(APPPATH.'views/admin/'.$page.'.php'))
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
			return redirect('/admin/');

		}
		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			
			$data['id'] = $id;
			$data['record'] = $this->users->display_user($id);
			$data['title'] = $page;

			$this->load->view('templates/header',$data);
			$this->load->view('admin/'.$page,$data);
			$this->load->view('templates/footer',$data);
		}     
	}

	public function delete_record($id=Null)
	{
		

		$this->users->delete_user($id);
		return redirect('/admin/');
		
	}

}
?>