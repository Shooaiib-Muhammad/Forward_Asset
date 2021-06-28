<?php

class Material extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
		$data['MaterialValues'] = $this->ID->CallMat();
		$data['ProValues'] = $this->ID->CallProject();
		$data['Uom'] = $this->ID->CallUom();
		$data['MatData'] = $this->ID->CallMatData();
        $this->load->view('add_material', $data);
    }

    public function MaterialsPro(){
		$data['ProjValues'] = $this->ID->CallProject();
		$arr=$data['ProjValues'];
		echo json_encode($arr);
	} 

	function getDependent(){
		$proId = $_POST['idofPro'];
		
		$data['DependentValue'] = $this->ID->getDependentValue($proId);
          $arr=$data['DependentValue'];
		echo json_encode($arr);
	}

	function AddMaterials(){
		$Month = date('m');
        $Year = date('Y');
        $Day = date('d');
        $CurrentDate = $Year . '-' . $Month . '-' . $Day;
        $ProCurDate =  $CurrentDate;
		$matProName = $this->input->post('materialEProName');
		$matDepName = $this->input->post('materialEDepName');
		$matName = $this->input->post('materialEName');
		$matQty = $this->input->post('materialEQty');
		$matUom = $this->input->post('materialEUom');
		$matNar = $this->input->post('MatENarration');
		$user =  $this->session->userdata('user_id');

		
        $this->ID->AddMaterial($matProName, $matDepName, $matName, $matQty, $matUom, $matNar,$user, $ProCurDate);  

	}


	public function deleteMat(){
		$proId = $_POST['llid'];
		$this->ID->deleteMaterial($proId);	
        

	}

    public function getMaterial()
	{
		$proId = $_POST['llid'];
	
		$data['ProjectValue'] = $this->ID->getMaterialValue($proId);
          $arr=$data['ProjectValue'];
		echo json_encode($arr);
		
    }

	public function EditMaterials(){
		$matDid =  $this->input->post('projectDDID');
		$matProName = $this->input->post('materialEProName');
		$matDepName = $this->input->post('materialEDepName');
		$matName = $this->input->post('materialEName');
		$matQty = $this->input->post('materialEQty');
		$matUom = $this->input->post('materialEUom');
		$matNar = $this->input->post('MatENarration');	
        $user =  $this->session->userdata('user_id');

		$this->ID->editMaterial($matDid, $matProName, $matDepName,$matName, $matQty, $matUom, $matNar, $user); 

		$this->load->view('add_material');

	}

}