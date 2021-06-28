<?php

class assetlocation extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
 		$data['Location'] = $this->ID->getAssetBuildings();
		 $data['DepartmentsLocation'] = $this->ID->getDepartmentsLocation();
		 $data['SectionsLocation'] = $this->ID->getAssetSectionsLocation();
        $this->load->view('assetlocation', $data);

		
    }

/////////////////////////////////////////// Asset Building ///////////////////////////////////////////////////////

	public function AddAssetLocation()
	{
	
/* 		$location = $this->input->post('locationName');
		$status = $this->input->post('status'); */

		$location = $this->input->post('buildName');
		$status = $this->input->post('locationStatus');
        if($status =="on"){
			$status =1;
		}
		else{
			$status=0;
		}
		$this->ID->AddAssetLocation($location, $status); 
		
    }

	public function EditBuilding()
	{
	
/* 		$location = $this->input->post('locationName');
		$status = $this->input->post('status'); */
		$buildId =  $this->input->post('BID');
		$location = $this->input->post('buildName');
		$status = $this->input->post('locationStatus');
        if($status =="on"){
			$status =1;
		}
		else{
			$status=0;
		}
		$this->ID->EditBuilding($buildId,$location, $status); 
		
    }

	public function deleteLocation(){
		$proId = $_POST['llid'];
		$this->ID->deleteLocation($proId);	
        

	}

	public function getBuilding()
	{
		$bId = $_POST['llid'];
	
		$data['buildingValue'] = $this->ID->getBuildValue($bId);
          $arr=$data['buildingValue'];
		echo json_encode($arr);
		
    }


//////////////////////////////////////////////////// Asset Departments ////////////////////////////////////

  
public function AddAssetDepartment()
{

/* 		$location = $this->input->post('locationName');
	$status = $this->input->post('status'); */

	$deptBuild = $this->input->post('assetDepBuild');
	$deptName = $this->input->post('assetDeptName');
	$status = $this->input->post('assetDeptStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}
	$this->ID->AddAssetDepartment($deptBuild, $deptName,$status); 
	
}

public function getDepartment()
{
	$Id = $_POST['llid'];

	$data['departmentValue'] = $this->ID->getDepartmentValue($Id);
	  $arr=$data['departmentValue'];
	echo json_encode($arr);
	
}

public function getDepartments()
{
	$data['departmentValue'] = $this->ID->getDepartmentsLocation();
	  $arr=$data['departmentValue'];
	echo json_encode($arr);
	
}

public function getBuildings()
{

	$data['buildingValue'] = $this->ID->getAssetBuildings();
	  $arr=$data['buildingValue'];
	echo json_encode($arr);
	
}

public function EditDepartment()
{

	$buildId =  $this->input->post('did');
	$deptBuild = $this->input->post('assetDepBuild');
	$deptName = $this->input->post('assetDeptName');
	$status = $this->input->post('assetDeptStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}

	$this->ID->EditDepartment($buildId,$deptBuild, $deptName,$status); 
	
}

public function deleteDepartment(){
	$proId = $_POST['llid'];
	$this->ID->deleteDepartment($proId);	
	

}

//////////////////////////////////////////////////// Asset Sections ////////////////////////////////////

  
public function AddAssetSection()
{

/* 		$location = $this->input->post('locationName');
	$status = $this->input->post('status'); */

	$secBuild = $this->input->post('assetSecBuild');
	$deptName = $this->input->post('assetSecDept');
	$secName = $this->input->post('assetSecName');	
	$status = $this->input->post('assetSecStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}
	$this->ID->AddAssetSection($secBuild, $deptName,$secName,$status); 
	
}

public function getSection()
{

	$Id = $_POST['idofPro'];
	$data['sectionValue'] = $this->ID->getAssetSectionsLocation1($Id);
	  $arr=$data['sectionValue'];
	echo json_encode($arr);
	
}

public function getSectionEdit()
{

	$Id = $_POST['idofEdit'];
	$data['sectionEditValue'] = $this->ID->getAssetSectionsLocation1($Id);
	  $arr=$data['sectionEditValue'];
	echo json_encode($arr);
	
}



public function getSections()
{
	
	$data['sectionValues'] = $this->ID->getAssetSectionsLocation();
	  $arr=$data['sectionValues'];
	echo json_encode($arr);
	
}


public function EditSection()
{

	$secId =  $this->input->post('sid');
	$secBuild = $this->input->post('assetSecBuild');
	$deptName = $this->input->post('assetSecDept');
	$secName = $this->input->post('assetSecName');	
	$status = $this->input->post('assetSecStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}

	$this->ID->EditSection($secId,$secBuild, $deptName,$secName,$status); 
	
}

public function deleteSection(){
	$proId = $_POST['llid'];
	$this->ID->deleteSection($proId);	
	

}

}