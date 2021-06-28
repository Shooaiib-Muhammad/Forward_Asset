<?php

class AssetsDepreciationMethod extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
		$data['Methods'] = $this->ID->getDepreciations();
        $this->load->view('assets_depreciation_method', $data);
//		$this->load->view('page_login');
		
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

public function AddDepreciation()
{

/* 		$location = $this->input->post('locationName');
	$status = $this->input->post('status'); */

	$name = $this->input->post('methodName');
	$status = $this->input->post('methodStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}
	$this->ID->AddDepreciation($name,$status); 
	
}

public function getDepreciation()
{
	$Id = $_POST['llid'];

	$data['depValue'] = $this->ID->getDepreciation($Id);
	  $arr=$data['depValue'];
	echo json_encode($arr);
	
}

public function getDepreciations()
{
	$data['depValues'] = $this->ID->getDepreciations();
	  $arr=$data['depValues'];
	echo json_encode($arr);
	
}

public function EditDepreciation()
{

	$depId =  $this->input->post('depid');
	$name = $this->input->post('methodName');
	$status = $this->input->post('methodStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}

	$this->ID->EditDepreciation($depId, $name,$status); 
	
}

public function deleteDepreciation(){
	$proId = $_POST['llid'];
	$this->ID->deleteDepreciation($proId);	

}

}