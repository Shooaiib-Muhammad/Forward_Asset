<?php

class vendors extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
		$data['Vendors'] = $this->ID->getVendors();
        $this->load->view('vendor', $data);

		
    }

	public function AddVendor()
{

	$name = $this->input->post('vName');
	$address = $this->input->post('vAddress');
	$number = $this->input->post('vNumber');
	$status = $this->input->post('vStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}
	$this->ID->AddVendor($name,$address,$number,$status); 
	
}

public function getVendor()
{
	$Id = $_POST['llid'];

	$data['depValue'] = $this->ID->getVendor($Id);
	  $arr=$data['depValue'];
	echo json_encode($arr);
	
}

public function getVendors()
{
	$data['vendorValues'] = $this->ID->getVendors();
	  $arr=$data['vendorValues'];
	echo json_encode($arr);
	
}

public function EditVendor()
{
	$vId =  $this->input->post('vid');
	$name = $this->input->post('vName');
	$address = $this->input->post('vAddress');
	$number = $this->input->post('vNumber');
	$status = $this->input->post('vStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}

	$this->ID->EditVendor($vId, $name,$address,$number,$status); 
	
}

public function deleteVendor(){
	$proId = $_POST['llid'];
	$this->ID->deleteVendor($proId);	

}


}