<?php

class Project extends CI_Controller
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
		$data['ProValues'] = $this->ID->CallProject();
        $this->load->view('add_project', $data);
//		$this->load->view('page_login');
		
    }
	
	public function getProject()
	{
		$proId = $_POST['llid'];
	
		$data['ProjectValue'] = $this->ID->getProjectValue($proId);
          $arr=$data['ProjectValue'];
		echo json_encode($arr);
		
    }
  

	public function AddProject(){
		$Month = date('m');
        $Year = date('Y');
        $Day = date('d');
        $CurrentDate = $Year . '-' . $Month . '-' . $Day;
        $ProCurDate =  $CurrentDate;
		$proName = $this->input->post('projectName');
		$proStartDate = $this->input->post('projectStartDate');
		$proCompleteDate = $this->input->post('projectCompDate');
		$proDeptName = $this->input->post('DepartmentName');
		$proNarration = trim($this->input->post('projectNarration'));
		$proStatus = $this->input->post('projectStatus');
		$user =  $this->session->userdata('user_id');

		if($proStatus =="on"){
			$proStatus = 1;
		}
		else{
			$proStatus = 0;
		}
		
		$this->ID->addProject($proName, $proStartDate, $proCompleteDate, $proDeptName, $proStatus, $ProCurDate, $proNarration, $user);
         
		$this->load->view('add_project');

	}

	public function deletePro(){
		$proId = $_POST['llid'];
		
		$this->ID->deleteProject($proId);	
        

	}

	public function EditProject(){

		
        $ProHid =  $this->input->post('projectHID');
		$proName = $this->input->post('projectName');
		$proStartDate = $this->input->post('projectStartDate');
		$proCompleteDate = $this->input->post('projectCompDate');
		$proDeptName = $this->input->post('DepartmentName');
		$proNarration = trim($this->input->post('projectNarration'));
		$proStatus = $this->input->post('projectStatus');
		$user =  $this->session->userdata('user_id');

        if($proStatus =="on"){
			$proStatus = 1;
		}
		else{
			$proStatus = 0;
		}
		
		$this->ID->editProject($proName, $proStartDate, $proCompleteDate, $proDeptName, $proStatus, $ProHid, $proNarration, $user); 

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

	function getDependent(){
		$proId = $_POST['idofPro'];
		
		$data['DependentValue'] = $this->ID->getDependentValue($proId);
          $arr=$data['DependentValue'];
		echo json_encode($arr);
	}

}