<?php

class AssetsOriginalLife extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
		$data['Life'] = $this->ID->getOriginalLifes();
        $this->load->view('assets_original_life', $data);

		
    }
  /*  
    public function dashboard(){
        $this->load->view('page_dashboard');        
    }

    public function process_login(){

        $user = $this->input->post('username');
		$password = $this->input->post('password');
		$this->ID->loginn($user, $password);
	
		if($this->session->has_userdata('user_id')){
			if($password=='123'){
				redirect('changepwd');
			}else{
			redirect('login/dashboard');
			}

		}
    }

	public function logout()
    {
		$this->session->sess_destroy();
		redirect('');
    }
*/

public function AddOriginalLife()
{

/* 		$location = $this->input->post('locationName');
	$status = $this->input->post('status'); */

	$name = $this->input->post('NameLife');
	$status = $this->input->post('Status');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}
	$this->ID->AddOriginalLife($name,$status); 
	
}

public function getOriginalLife()
{
	$Id = $_POST['llid'];

	$data['depValue'] = $this->ID->getOriginalLife($Id);
	  $arr=$data['depValue'];
	echo json_encode($arr);
	
}

public function getOriginalLifes()
{
	$data['originalValues'] = $this->ID->getOriginalLifes();
	  $arr=$data['originalValues'];
	echo json_encode($arr);
	
}

public function EditOriginalLife()
{

	$depId =  $this->input->post('oid');
	$name = $this->input->post('NameLife');
	$status = $this->input->post('Status');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}

	$this->ID->EditOriginalLife($depId, $name,$status); 
	
}

public function deleteOriginalLife(){
	$proId = $_POST['llid'];
	$this->ID->deleteOriginalLife($proId);	

}

}