<?php
	defined('BASEPATH') OR exit('direct script access allowed');

class Mcqs extends CI_Controller{

	public function __construct()
	{
	parent::__construct();
	$this->load->model('mcq');
	$this->load->database();
	$this->load->helper('url_helper');
	$this->load->helper('url');
	$this->load->helper('form');
    $this->load->library('form_validation');
    $this->load->library('session');
   	$this->load->helper('array');

	}

	public function index($page="home")
	{
		if(! file_exists(APPPATH.'views/mcq/'.$page.'.php'))
		{
			show_404();
		}
		//$data['users'] = $this->test->display_data();
		$data['title'] = ucfirst($page);
		$c = Null;
		$userdata = array(
                'c' => $c,
            	);
		$this->session->set_userdata($userdata);
		if($this->input->server("REQUEST_METHOD")==="POST")
		{	
        	$email= $this->input->post("email");
			$password = $this->input->post("password");
			$user = $this->mcq->login_data($email,$password);
			$this->load->library('session');
			if($user)
			{
            	$userdata = array(
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email
            	);
            $this->session->set_userdata($userdata);
			//$this->session->set_flashdata('message', 'success ');
            redirect('mcqs/quiz_dis');
			}
			else
			{
			$this->session->set_flashdata('message', 'Invalid email or password');
            redirect('mcqs/');
			}					
		}	
		$this->load->view('templates/header',$data);
		$this->load->view('mcq/'.$page,$data);
		$this->load->view('templates/footer',$data);
	}
	public function logout()
	{
		$this->session->sess_destroy();
        redirect('mcqs/');
	}

	public function questions($page="questions")
	{
		$data['title'] = ucfirst($page);

		$data['quest'] = $this->mcq->display_question();
		foreach($data['quest'] as $ques)
		{	
			$id = $ques->id;
			$data['ans'] = $this->mcq->display_answer($id);
			//$data['answ'] = $this->mcq->display_answer();
			$this->load->view('templates/header',$data);
			$this->load->view('mcq/'.$page,$data);
			$this->load->view('templates/footer',$data);
			

		}
		$this->load->view('templates/header',$data);
			$this->load->view('mcq/'.$page,$data);
			$this->load->view('templates/footer',$data);
		/*$data['answ'] = $this->mcq->display_answer();
		$this->load->view('templates/header',$data);
		$this->load->view('mcq/'.$page,$data);
		$this->load->view('templates/footer',$data);
*/
	} 
	public function quiz($page="quiz")
	{
		
		if(! file_exists(APPPATH.'views/mcq/'.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = ucfirst($page);
		
		$userdata = Null;
		if($this->session->userdata('q') < 1)
		{
		$userdata = array(
                'q' => 1,
            	);
		}
		$this->session->set_userdata($userdata);

		if($this->input->server("REQUEST_METHOD")==="POST")		
		{

			$id = $this->input->post('id');
			$answer =  $this->input->post('answer');

			/*$id = 1;
			$answer = 'Delhi';*/

			$chk = $this->mcq->check_answer($id,$answer);
			$id += 1;
			$comp = $this->mcq->count_data();
			if($id>$comp)
			{
				$userdata = array(
                'q' => 1,
            	);
				$this->session->set_userdata($userdata);
				redirect('mcqs/');
			}
			else
			{
				$userdata = array(
                'q' => $id,
            	);
				$this->session->set_userdata($userdata);
			}

			if($chk)
			{
			$this->session->set_flashdata('message', 'right ');

            redirect('mcqs/quiz');
			}
			else
			{
			$this->session->set_flashdata('message', 'wrong ');
            redirect('mcqs/quiz');
			}
		}

		if($this->input->server("REQUEST_METHOD")==="GET")
		{
		$c = $this->session->userdata('q');
		$data['quizs'] =$this->mcq->dis_question($c); 
		$this->load->view('templates/header',$data);
		$this->load->view('mcq/'.$page,$data);
		$this->load->view('templates/footer',$data);
		}
	}	

	public function quiz_dis($upid=Null,$page='quiz_dis')
	{

		if(! $this->session->userdata('email'))
    	{
    		redirect('mcqs/');
    	}
		if(! file_exists(APPPATH.'views/mcq/'.$page.'.php'))
		{
			show_404();
		}
		$data['title'] = ucfirst($page);


		if($this->input->server("REQUEST_METHOD")==="POST")		
		{

			$fid = $this->input->post('id');
			$id = $this->input->post('answer');
			//$answer =  $this->input->post('answer');

			$chk = $this->mcq->check_answer($id);
		
			if($chk)
			{
			$this->session->set_flashdata('message', 'right ');

				$c = $this->session->userdata('c');
				$c = $c + 1;
				$this->session->set_userdata('c', $c); 
			

            redirect('mcqs/quiz_dis/'.$fid);
			}
			else
			{
			$this->session->set_flashdata('message', 'wrong ');
            redirect('mcqs/quiz_dis/'.$fid);
			}
		}
		if($this->input->server("REQUEST_METHOD")==="GET")
		{
			$num = 1;
			if($upid)
			{
				$num = $upid;
			}
			$data['quest'] = $this->mcq->dis_question($num);
			if(!$data['quest'])
			{
			$data['result'] = $this->session->userdata('c');
			$c = Null;
			$this->session->set_userdata('c', $c);
			$this->load->view('templates/header',$data);
			$this->load->view('mcq/success',$data);
			$this->load->view('templates/footer',$data);

			}
			else
			{
			$data['answ']  = $this->mcq->display_answer($num);

			$this->load->view('templates/header',$data);
			$this->load->view('mcq/'.$page,$data);
			$this->load->view('templates/footer',$data);

			}
		}	
	}

	public function ad($page='demo')
	{
		$this->load->helper('array');

		$data= Null;

		$this->load->view('templates/header',$data);
		$this->load->view('mcq/'.$page,$data);
		$this->load->view('templates/footer',$data);

	}
}

?>
