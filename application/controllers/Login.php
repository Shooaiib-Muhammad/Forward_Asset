<?php

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
		
		/* $this->load->view('page_login'); */
	$this->load->view('page_login');	
		
    }
    

    public function process_login(){

        $user = $this->input->post('username');
		$password = $this->input->post('password');
		$this->ID->loginn($user, $password);
	
		if($this->session->has_userdata('user_id')){
			if($password=='123'){
				redirect('changepwd');
			}else{
			redirect('dashboard');
			}

		}
    }

	public function logout()
    {
		$this->session->sess_destroy();
		redirect('');
    }


}