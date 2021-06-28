<?php

class Department extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
 
		$data['ProjectValues'] = $this->ID->getProjectValues();
		$data['DepartmentValues'] = $this->ID->CallDept();
		$data['MidValues'] = $this->ID->CallMid();
		$data['ProValues'] = $this->ID->CallProject();
        $this->load->view('add_department', $data);
//		$this->load->view('page_login');
		
    }
	
	public function getProject()
	{
		$proId = $_POST['llid'];
	
		$data['ProjectValue'] = $this->ID->getProjectValue($proId);
          $arr=$data['ProjectValue'];
		echo json_encode($arr);
		
    }


	public function AddDepartments(){
		$Month = date('m');
        $Year = date('Y');
        $Day = date('d');
        $CurrentDate = $Year . '-' . $Month . '-' . $Day;
        $ProCurDate =  $CurrentDate;
		$depProName = $this->input->post('depProName');
		$depName = $this->input->post('depName');
		$user =  $this->session->userdata('user_id');
		
		$this->ID->AddDepartment($depProName, $depName, $ProCurDate, $user);
         
		$this->load->view('add_project');

	}

	public function deleteDep(){
		$proId = $_POST['llid'];
		$this->ID->deleteDepartment($proId);	
        

	}

	public function getDepartment()
	{
		$proId = $_POST['llid'];
	
		$data['ProjectValue'] = $this->ID->getMidValue($proId);
          $arr=$data['ProjectValue'];
		echo json_encode($arr);
		
    }

	public function EditDepartments(){

		$Proid =  $this->input->post('projectID');
        $depProName = $this->input->post('depProName');
		$depName = $this->input->post('depName');
		$user =  $this->session->userdata('user_id');
		
		$this->ID->editDep( $depProName, $depName,$user, $Proid); 

		$this->load->view('add_department');
	}

	function getDependent(){
		$proId = $_POST['idofPro'];
		
		$data['DependentValue'] = $this->ID->getDependentValue($proId);
          $arr=$data['DependentValue'];
		echo json_encode($arr);
	}

}