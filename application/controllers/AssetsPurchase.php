<?php

class AssetsPurchase extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AMS', 'ID');
		$this->load->library('session');
	}

    public function index()
	{
		$data['Assets'] = $this->ID->getAssets();
		$data['AssetType'] = $this->ID->getAssetTypes();
		$data['Building'] = $this->ID->getAssetBuildings();
		$data['Departments'] = $this->ID->getDepartmentsLocation();
		$data['OriginalLife'] = $this->ID->getOriginalLifes();
		$data['DepMethod'] = $this->ID->getDepreciations();
		$data['Vendors'] = $this->ID->getVendors();
				// $data['employees'] = $this->ID->getimployees();
		// 		$data['Images'] = $this->ID->getimages();



 	// 	foreach($data['Images'] as $keys){

  //  $image = imagecreatefromstring($keys['EmpPic']); 
   
  //   ob_start(); //You could also just output the $image via header() and bypass this buffer capture.
  //   imagejpeg($image, "D:/SportEmp/".$keys['CNIC'].".jpg");
 
	   
		// }
		
        $this->load->view('assets_purchase', $data);
		
    }

	public function AddAsset()
{
	if(!empty($_FILES['img']['name'])){

		$config['upload_path'] = 'assets\img\img';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['file_name'] = basename($_FILES["img"]["name"]) ;
		
		//Load upload library and initialize configuration
		$this->load->library('upload',$config);
	   $this->upload->initialize($config);
		 
		if($this->upload->do_upload('img')){
	   $uploadData = $this->upload->data();
	   $picture = $uploadData['file_name'];
	   $config['image_library'] = 'gd2';  
	   $config['source_image'] = 'assets/img/img/'.$picture;
	   $config['create_thumb'] = FALSE;  
	   $config['maintain_ratio'] = FALSE;  
	   $config['quality'] = '60%';  
	   $config['width'] = 800;  
	   $config['height'] = 600;  
	   $config['new_image'] = 'assets/img/img/'.$picture;
	   $this->load->library('image_lib', $config);  
	   $this->image_lib->resize(); 
		}else{
	    Echo "helll";
	
		 $picture = '';
		}
	   }else{
		
		$picture = '';
	   }

	/*    $target_dir = "uploads/";
	   $target_file = $target_dir . basename($_FILES["img"]["name"]);
   
	   $uploadOk = 1;
	   $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	   if (isset($_POST["submit"])) {
		   $check = getimagesize($_FILES["img"]["tmp_name"]);
		   if ($check !== false) {

			   $uploadOk = 1;
		   } else {

			   $uploadOk = 0;
		   }
	   }


	   // Check file size
	   if ($_FILES["img"]["size"] > 500000) {

		   $uploadOk = 0;
	   }


	   if (
		   $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		   && $imageFileType != "gif"
	   ) {

		   $uploadOk = 0;
	   }

	   if ($uploadOk == 0) {
	   } else {
		   if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
			   $picture = $target_file;
		   } else {
		   }
	   }

$picture;

echo $picture;
die(); */
	
	$type = $this->input->post('assetType');
	if($type == 0){
		$type = null;
	}
	$name = $this->input->post('asset');
	if($name == 0){
		$name = null;
	}
	$build = $this->input->post('assetBuild');
	if($build == 0){
		$build = null;
	}
	$dept = $this->input->post('assetDept');
	if($dept == 0){
		$dept = null;
	}

	$sec = $this->input->post('assetSec');
	if($sec == 0){
		$sec = null;
	}
	$cost = $this->input->post('assetCost');
	$pDate = $this->input->post('assetPurchaseDate');
	$exp = $this->input->post('assetExpiry');

	$depMeth = $this->input->post('assetDepMethId');
	if($depMeth == 0){
		$depMeth = null;
	}
	$orig = $this->input->post('assetOriLifeId');
	if($orig == 0){
		$orig = null;
	}
	$ven = $this->input->post('assetVenId');
	if($ven == 0){
		$ven = null;
	}
	$status = $this->input->post('assetStatus');
	$overcost = $this->input->post('overCost');

	$overDate = $this->input->post('assetOverallDate');
	$state = $this->input->post('assetState');
	$des = $this->input->post('assetShortDes');
	$code = rand();
  
				$insdate = $this->input->post('insdate');
	$user = $this->input->post('user');
	$brand = $this->input->post('brand');
	$this->ID->AddAsset($type,$name,$build,$dept,$sec,$cost,$pDate,$exp,$orig,$ven,$status,$overcost,$overDate,$state,$code,$des, $depMeth,$picture,$insdate,$user,$brand); 
	
}

public function getAsset()
{
	$Id = $_POST['llid'];

	$data['assetValue'] = $this->ID->getAsset($Id);
	  $arr=$data['assetValue'];
	echo json_encode($arr);
	
}

public function getAssets()
{
	$data['assetValues'] = $this->ID->getAssets();
	  $arr=$data['assetValues'];
	echo json_encode($arr);
	
}

public function EditAsset()
{

	if(!empty($_FILES['img']['name'])){

		$config['upload_path'] = 'assets\img\img';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['file_name'] = basename($_FILES["img"]["name"]) ;
		
		//Load upload library and initialize configuration
		$this->load->library('upload',$config);
	   $this->upload->initialize($config);
		 
		if($this->upload->do_upload('img')){
	   $uploadData = $this->upload->data();
	   $picture = $uploadData['file_name'];
	   $config['image_library'] = 'gd2';  
	   $config['source_image'] = 'assets/img/img/'.$picture;
	   $config['create_thumb'] = FALSE;  
	   $config['maintain_ratio'] = FALSE;  
	   $config['quality'] = '60%';  
	   $config['width'] = 800;  
	   $config['height'] = 600;  
	   $config['new_image'] = 'assets/img/img/'.$picture;
	   $this->load->library('image_lib', $config);  
	   $this->image_lib->resize(); 
		}else{
	    Echo "helll";
		
		 $picture = '';
		}
		$id =  $this->input->post('pid');
		$type = $this->input->post('assetType');
		if($type == 0){
			$type = null;
		}
		$name = $this->input->post('asset');
		if($name == 0){
			$name = null;
		}
		$build = $this->input->post('assetBuild');
		if($build == 0){
			$build = null;
		}
		$dept = $this->input->post('assetDept');
		if($dept == 0){
			$dept = null;
		}
	
		$sec = $this->input->post('assetSec');
		if($sec == 0){
			$sec = null;
		}
		$cost = $this->input->post('assetCost');
		$pDate = $this->input->post('assetPurchaseDate');
		$exp = $this->input->post('assetExpiry');
	
		$depMeth = $this->input->post('assetDepMethId');
		if($depMeth == 0){
			$depMeth = null;
		}
		$orig = $this->input->post('assetOriLifeId');
		if($orig == 0){
			$orig = null;
		}
		$ven = $this->input->post('assetVenId');
		if($ven == 0){
			$ven = null;
		}
		$status = $this->input->post('assetStatus');
		$overcost = $this->input->post('overCost');
	
		$overDate = $this->input->post('assetOverallDate');
		$state = $this->input->post('assetState');
		$des = $this->input->post('assetShortDes');
	$insdate = $this->input->post('insdate');
	$user = $this->input->post('user');
	$brand = $this->input->post('brand');
		$this->ID->EditAsset($id,$type,$name,$build,$dept,$sec,$cost,$pDate,$exp,$orig,$ven,$status,$overcost,$overDate,$state,$des,$depMeth,$picture,$insdate,$user,$brand); 
	}else{
	
		$id =  $this->input->post('pid');
		$type = $this->input->post('assetType');
		if($type == 0){
			$type = null;
		}
		$name = $this->input->post('asset');
		if($name == 0){
			$name = null;
		}
		$build = $this->input->post('assetBuild');
		if($build == 0){
			$build = null;
		}
		$dept = $this->input->post('assetDept');
		if($dept == 0){
			$dept = null;
		}
	
		$sec = $this->input->post('assetSec');
		if($sec == 0){
			$sec = null;
		}
		$cost = $this->input->post('assetCost');
		$pDate = $this->input->post('assetPurchaseDate');
		$exp = $this->input->post('assetExpiry');
	
		$depMeth = $this->input->post('assetDepMethId');
		if($depMeth == 0){
			$depMeth = null;
		}
		$orig = $this->input->post('assetOriLifeId');
		if($orig == 0){
			$orig = null;
		}
		$ven = $this->input->post('assetVenId');
		if($ven == 0){
			$ven = null;
		}
		$status = $this->input->post('assetStatus');
		$overcost = $this->input->post('overCost');
	
		$overDate = $this->input->post('assetOverallDate');
		$state = $this->input->post('assetState');
		$des = $this->input->post('assetShortDes');
		$insdate = $this->input->post('insdate');
	$user = $this->input->post('user');
	$brand = $this->input->post('brand');
		$this->ID->EditAssetWithoutPicture($id,$type,$name,$build,$dept,$sec,$cost,$pDate,$exp,$orig,$ven,$status,$overcost,$overDate,$state,$des,$depMeth,$insdate,$user,$brand); 
	
	   }

	
}

public function deleteAsset(){
	$proId = $_POST['llid'];
	$this->ID->deleteAsset($proId);	

}

public function getChartOfAssets(){
	$proId = $_POST['idofPro'];
	$data['chartValue'] =	$this->ID->getChartOfAssets($proId);
	$arr=$data['chartValue'];
  echo json_encode($arr);
	

}

public function AddAssetLocation()
{

	$assMove = $this->input->post('assetIDMove');
	$buildMove = $this->input->post('assetBuildMove');
	$depMove = $this->input->post('assetDeptMove');

	$sectionMove = $this->input->post('assetSecMove');

	$status = $this->input->post('assetMoveStatus');
	if($status =="on"){
		$status =1;
	}
	else{
		$status=0;
	}

	$this->ID->AddAssetMovingLocation($assMove,$buildMove,$depMove,$sectionMove,$status); 
	
}


}