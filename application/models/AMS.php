<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AMS extends CI_Model
{

    public function __construct()
	{
		parent::__construct();
		$this->load->database();
        $this->load->library('session');
        
	}


    public function loginn($username, $password)
    {
      
      $query = $this->db->query("SELECT        LoginName, passwd, UserSataus, UserID
      FROM            tbl_MIS_User
      WHERE        (LoginName = '$username') AND (passwd = '$password') ");

        if ($query->num_rows() > 0) {
            $result = $query->row();
            $session_data = array(
                'user_id' => $result->UserID,
                'user_name' => $result->LoginName,
                'userStus' => 1,
                'Status' => $result->UserSataus,
                
            );
            $Status = $result->UserSataus;
         
           //echo $Status;
           // Die;
      
            if($Status==0){
                $this->session->set_flashdata('info', 'Your Account Has Been Disable');
                redirect('Login/page_dashboard');
            }else{
                if($password=='123'){
                    $this->session->set_flashdata('info', 'Please Change Your Password First');
                }else{
                $this->session->set_flashdata('info', 'Welcome in AMS');
                }

            $this->session->set_userdata($session_data);
                

            }
           
        } else {
            //echo "Hello";
            //Die;

            $this->session->set_flashdata('info', 'Your User Name OR Password is In Correct ');
            redirect('');
        }
    

    }

    public function getProjectValues(){
       
		 $MIS = $this->load->database('MIS', TRUE);
        $query = $MIS->query('SELECT        dbo.view_Project_head.*
        FROM            dbo.view_Project_head');
        return $query->result_array();
    }
    
    public function getProjectValue($proId){
         $MIS = $this->load->database('MIS', TRUE);
        $query = $MIS->query("SELECT  dbo.view_Project_head.*
        FROM            dbo.view_Project_head
        WHERE ProjectHID='$proId'"
    );
        return $query->result_array();
    }

    Public function CallDept(){
         $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query('SELECT        CustName, LocalCustID
        FROM            dbo.tbl_Inv_LocalCust');
        return $query->result_array();

    }

    Public function CallMid(){
         $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query('SELECT   dbo.view_Project_middel.*
        FROM     dbo.view_Project_middel');
        return $query->result_array();

    }

    public function addProject($prName, $prStrtDte, $prEndDte, $prDptNme,  $prStatus,  $prEntryDate ,$prNarration,$user){

 $MIS = $this->load->database('MIS', TRUE);
        $query = $MIS->query("INSERT INTO dbo.tbl_Project_H
        (ProjectName
        ,StartDate
        ,CompDate
        ,DeptID
        ,CompStatus
        ,EntryDate
        ,Narration
        ,UserID)
  VALUES
        ('$prName',
        '$prStrtDte',
        '$prEndDte',
        '$prDptNme',
        '$prStatus',
        '$prEntryDate',
        '$prNarration',
        '$user')");
        
        if ($query) {
            $this->session->set_flashdata('Proinfo', 'Project has been added. ');
            redirect('Project');
        } else {
            $this->session->set_flashdata('danger', 'There is an error while creating project.');
            redirect('Project');
        }

    }

    public function editProject($prName, $prStrtDte, $prEndDte, $prDptNme,  $prStatus,  $proId ,$prNarration,$user){

 $MIS = $this->load->database('MIS', TRUE);
        $query = $MIS->query("UPDATE tbl_Project_H 
        SET  ProjectName  =  '$prName' , StartDate  =  '$prStrtDte'  , CompDate  =  '$prEndDte'
           , DeptID  =  '$prDptNme'  , CompStatus  =  '$prStatus' , Narration  =  '$prNarration' WHERE   ProjectHID  =  '$proId' ");
        
        if ($query) {
            $this->session->set_flashdata('Proinfo', 'Project has been Updated. ');
            redirect('Project');
        } else {
            $this->session->set_flashdata('danger', 'There is an error while Updating project.');
            redirect('Project');
        }

    }


    public function deleteProject($proId){
          $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query("DELETE FROM tbl_Project_H
        WHERE ProjectHID='$proId'");
       if ($query) {
        $this->session->set_flashdata('ProDelinfo', 'Project has been added. ');
        redirect('Project');
    } else {
        $this->session->set_flashdata('danger', 'There is an error while creating project.');
        redirect('Project');
    }



    }

    public function AddDepartment($depProName, $depName, $ProCurDate, $user){
 $MIS = $this->load->database('MIS', TRUE);

        $query = $MIS->query("INSERT INTO  dbo.tbl_Project_M 
        (
            DeptID 
        , EntryDate 
        , UserID 
        , ProjectHID )
  VALUES
        (
        '$depName',
        '$ProCurDate',
        $user,
        '$depProName')");
        
        if ($query) {
            $this->session->set_flashdata('Proinfo', 'Department has been added. ');
            redirect('Department');
        } else {
            $this->session->set_flashdata('danger', 'There is an error while creating Department.');
            redirect('Department');
        }

    }

    public function deleteDepartment($proId){
         $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query("DELETE FROM  dbo . tbl_Project_M 
        WHERE ProjectID='$proId'");
       if ($query) {
        $this->session->set_flashdata('ProDelDepinfo', 'Project has been added. ');
        redirect('Department');
    } else {
        $this->session->set_flashdata('danger', 'There is an error while creating project.');
        redirect('Department');
    }



    }

    public function getMidValue($proId){
         $MIS = $this->load->database('MIS', TRUE);
        $query = $MIS->query("SELECT  dbo.view_Project_middel.*
        FROM            dbo.view_Project_middel
        WHERE ProjectID='$proId'"
    );
        return $query->result_array();
    }

    public function editDep($depProName, $depName,$user, $Proid){

 $MIS = $this->load->database('MIS', TRUE);

        $query = $MIS->query("UPDATE  dbo . tbl_Project_M 
   SET  ProjectHID  =  '$depProName'
      , DeptID  =  '$depName' 
      , UserID  =  '$user'
     WHERE   ProjectID  =  '$Proid' ");
        
        if ($query) {
            $this->session->set_flashdata('Proinfo', 'Department has been Updated. ');
            redirect('Department');
        } else {
            $this->session->set_flashdata('danger', 'There is an error while Updating project.');
            redirect('Department');
        }

    }

    function CallProject(){
         $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query('SELECT        ProjectHID, ProjectName
        FROM            dbo.tbl_Project_H');
        return $query->result_array();

    }


    function getDependentValue($proId){
         $MIS = $this->load->database('MIS', TRUE);
        $query = $MIS->query("SELECT dbo.tbl_Project_M.ProjectHID, dbo.tbl_Inv_LocalCust.CustName, dbo.tbl_Inv_LocalCust.LocalCustID
        FROM            dbo.tbl_Project_M INNER JOIN
                                 dbo.tbl_Inv_LocalCust ON dbo.tbl_Project_M.DeptID = dbo.tbl_Inv_LocalCust.LocalCustID
        WHERE        (dbo.tbl_Project_M.ProjectHID = '$proId')"
        );
        return $query->result_array();
      }

      Public function CallMat(){
           $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query('SELECT L4Name, Code
        FROM    dbo.tbl_Inv_L4');
        return $query->result_array();

    }
  
    Public function CallUom(){
         $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query('SELECT        UOM
        FROM            dbo.tbl_Pur_UnitofMeasurementDtl
        GROUP BY UOM');
        return $query->result_array();

    }

    public function AddMaterial($matProName, $matDepName, $matName, $matQty, $matUom, $matNar,$user, $ProCurDate){

 $MIS = $this->load->database('MIS', TRUE);
        $query = $MIS->query("INSERT INTO  dbo . tbl_Project_D 
        ( ProjectHID 
           , DeptID  
           , Code 
           , Qty 
           , UOM 
           , Narration 
           , UserID 
           , EntryDate )
  VALUES
        ( '$matProName' , '$matDepName'   , '$matName'     , '$matQty'    , '$matUom'  , '$matNar'     , '$user'  ,  '$ProCurDate' )");
        
        if ($query) {
            $this->session->set_flashdata('Proinfo', 'Material has been added. ');
            redirect('Material');
        } else {
            $this->session->set_flashdata('danger', 'There is an error while creating Material.');
            redirect('Material');
        }

    }


    function CallMatData(){
 $MIS = $this->load->database('MIS', TRUE);
            $query=$MIS->query('SELECT  dbo.View_Project_Material.*
            FROM            dbo.View_Project_Material');
            return $query->result_array();
    

    }


    public function deleteMaterial($proId){
         $MIS = $this->load->database('MIS', TRUE);
        $query=$MIS->query("DELETE FROM  dbo . tbl_Project_D 
        WHERE  ProjectDID='$proId'");
       if ($query) {
        $this->session->set_flashdata('ProDelDepinfo', 'Material has been Deleted. ');
        redirect('Material');
    } else {
        $this->session->set_flashdata('danger', 'There is an error while Deleting Material.');
        redirect('Material');
    }
}


        public function getMaterialValue($proId){
             $MIS = $this->load->database('MIS', TRUE);
            $query = $MIS->query("SELECT  dbo.View_Project_Material.*
            FROM            dbo.View_Project_Material
            WHERE ProjectDID='$proId'"
        );
            return $query->result_array();
        }


        public function editMaterial($matDid, $matPName, $matDName,$matName, $matQtyy, $matUomm, $matNarrat, $user){


 $MIS = $this->load->database('MIS', TRUE);
            $query = $MIS->query("UPDATE  dbo . tbl_Project_D 
            SET  ProjectHID  =  '$matPName'  
               , DeptID  =  ' $matDName' 
               , Code  =  '$matName'  
               , Qty  =  '$matQtyy'  
               , UOM  =  '$matUomm'  
               , Narration  =  '$matNarrat'  
               , UserID  =  '$user'  
               
          WHERE ProjectDID='$matDid'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Material has been Updated. ');
                redirect('Material');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Material.');
                redirect('Material');
            }
    
        }


/////////////////////////////////////// Asset Type ///////////////////////////////////////////////////////////////

                 public function AddAssetType($type, $status){


                        $query = $this->db->query("INSERT INTO dbo.tbl_Asserts_Type
                        (AssertType,status )
                          VALUES
                        ('$type', '$status')");
                        
                        if ($query) {
                            $this->session->set_flashdata('Proinfo', 'Asset Type has been added. ');
                            redirect('assettype');
                        } else {
                            $this->session->set_flashdata('danger', 'There is an error while creating Asset Type.');
                            redirect('assettype');
                        }
                
                    }



           public function getAssetTypes(){
               $query=$this->db->query('  SELECT *
               FROM tbl_Asserts_Type ');
                 return $query->result_array();   
                 }


      public function deleteAssetType($Id){
        
         $query=$this->db->query("DELETE FROM  tbl_Asserts_Type
          WHERE  TID='$Id'");
          if ($query) {
            $this->session->set_flashdata('ProDelDepinfo', 'Asset Type has been Deleted. ');
             redirect('assettype');
           } else {
              $this->session->set_flashdata('danger', 'There is an error while Deleting Asset Type.');
             redirect('assettype');
             }
        }

        public function getAssetType($Id){
            $query = $this->db->query("SELECT     *
            FROM            tbl_Asserts_Type
            WHERE  TID = '$Id'"
        );
            return $query->result_array();
        }

        public function editAssetType($id, $type, $status){

            $query = $this->db->query("UPDATE  dbo . tbl_Asserts_Type 
            SET  AssertType  =  '$type', 
            status  =  '$status' 
          WHERE  TID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Asset Type has been Updated. ');
                redirect('assettype');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Asset Type.');
                redirect('assettype');
            }
    
        }
                 

///////////////////////////////////////// Asset Location ///////////////////////////////////////////////////////////////


   public function AddAssetLocation($location, $status){

          $query = $this->db->query("INSERT INTO dbo.tbl_Building
          (BuildingName ,Status) VALUES('$location','$status')");
                        
       if ($query) {
             $this->session->set_flashdata('Proinfo', 'Asset Location has been added. ');
                redirect('assetlocation');
             } else {
                 $this->session->set_flashdata('danger', 'There is an error while creating Asset Location.');
                 redirect('assetlocation');
                }
                
           }

        public function EditBuilding($id, $location, $status){

            $query = $this->db->query("UPDATE  dbo . tbl_Building 
            SET  BuildingName  =  '$location', 
                Status  =  '$status' 
          WHERE  BID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Building has been Updated. ');
                redirect('assetlocation');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Building.');
                redirect('assetlocation');
            }
    
        }

     public function getAssetBuildings(){
            $query=$this->db->query('  SELECT        BID, BuildingName, Status
            FROM tbl_Building ');
             return $query->result_array();   
           }

     public function deleteLocation($proId){
        
         $query=$this->db->query("DELETE FROM  dbo.tbl_Building
         WHERE  BID='$proId'");
        if ($query) {
         $this->session->set_flashdata('ProDelDepinfo', 'Building has been Deleted. ');
         redirect('assetlocation');
     } else {
        $this->session->set_flashdata('danger', 'There is an error while Deleting Building.');
         redirect('assetlocation');
     }
 }
 
          public function getBuildValue($proId){
             $query = $this->db->query("SELECT        BID, BuildingName, Status
             FROM            tbl_Building
             WHERE  BID = '$proId'"
         );
             return $query->result_array();
         }
 
//////////////////////////////// Chart of Assets /////////////////////////////////////////////////////

public function AddAssetChart($prodType,$chartType,$name,$code,$uom, $status){


    $query = $this->db->query("INSERT INTO tbl_Assets_Catagory
    (   PrdType ,
        AssetType ,
        Name ,
        Code,
        UOM ,
        Status )
      VALUES
    ('$prodType','$chartType','$name','$code','$uom', '$status')");
    
    if ($query) {
        $this->session->set_flashdata('Proinfo', 'Chart of Asset has been added. ');
        redirect('assettype');
    } else {
        $this->session->set_flashdata('danger', 'There is an error while creating Chart of Asset.');
        redirect('assettype');
    }

}

public function editAssetChart($id,$prodType,$chartType,$name,$code,$uom, $status){

    $query = $this->db->query("UPDATE  dbo . tbl_Assets_Catagory 
    SET   PrdType  =  '$prodType',
        AssetType  =  '$chartType' ,
        Name  =  '$name' ,
        Code  =    '$code',
        UOM  =  '$uom'  ,
        Status  =  '$status' 
  WHERE  ID='$id'");
    
    if ($query) {
        $this->session->set_flashdata('Proinfo', 'Chart of Asset has been Updated. ');
        redirect('assettype');
    } else {
        $this->session->set_flashdata('danger', 'There is an error while Updating Chart of Asset.');
        redirect('assettype');
    }

}


public function getAssetChart(){
    $query=$this->db->query('  SELECT *
    FROM view_chart_Of_Asset');
      return $query->result_array();   
      }


      public function deleteAssetChart($Id){
        
        $query=$this->db->query("DELETE FROM  dbo.tbl_Assets_Catagory
        WHERE  ID='$Id'");
       if ($query) {
        $this->session->set_flashdata('ProDelDepinfo', 'Chart of Asset has been Deleted. ');
        redirect('assettype');
    } else {
       $this->session->set_flashdata('danger', 'There is an error while Deleting Chart of Asset.');
        redirect('assettype');
    }
}

public function getChartValue($Id){
    $query = $this->db->query("SELECT  *
    FROM            tbl_Assets_Catagory
    WHERE  ID = '$Id'"
);
    return $query->result_array();
}


/////////////////////////////////////////////// Assets Location Departments ///////////////////////////////////////

public function getDepartmentsLocation(){
    $query=$this->db->query('  SELECT *
    FROM tbl_HRM_Dept');
      return $query->result_array();   
      }

          
 public function AddAssetDepartment($deptBuild, $deptName,$status){

     $query = $this->db->query("INSERT INTO tbl_HRM_Dept
      (  BID ,
      DeptName ,
      Status )
         VALUES
            ('$deptBuild','$deptName', '$status')");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Department of Asset has been added. ');
                redirect('assetlocation');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while creating Department of Asset.');
                redirect('assetlocation');
            }
        
        }


        public function getDepartmentValue($Id){
            $query = $this->db->query("SELECT  *
            FROM            tbl_HRM_Dept
            WHERE  DeptID = '$Id'"
        );
            return $query->result_array();
        }

        public function EditDepartment($id,$deptBuild, $deptName,$status){

            $query = $this->db->query("UPDATE  dbo . tbl_HRM_Dept 
            SET   BID  =  '$deptBuild',
            DeptName  =  '$deptName' ,
            Status  =  '$status' 
          WHERE  DeptID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Department of Asset has been Updated. ');
                redirect('assetlocation');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Chart of Department.');
                redirect('assetlocation');
            }
        
        }

          

    
    
/////////////////////////////////////////////// Assets Location Sections /////////////////////////////////////////////////////////

public function getSectionsLocation(){
    $query=$this->db->query('  SELECT *
    FROM tbl_HRM_Dept');
      return $query->result_array();   
      }

      public function getAssetSectionsLocation(){
        $query=$this->db->query("  SELECT *
        FROM tbl_HRM_Section
        ");
          return $query->result_array();   
          }

           public function getAssetSectionsLocation1($ID){
        $query=$this->db->query("  SELECT *
        FROM tbl_HRM_Section
        WHERE DeptID = '$ID'
        ");
          return $query->result_array();   
          }
 public function AddAssetSection($deptBuild, $deptName,$status){

     $query = $this->db->query("INSERT INTO tbl_HRM_Dept
      (  BID ,
      DeptName ,
      Status )
         VALUES
            ('$deptBuild','$deptName', '$status')");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Department of Asset has been added. ');
                redirect('assetlocation');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while creating Department of Asset.');
                redirect('assetlocation');
            }
        
        }


        public function getSectionValue($Id){
            $query = $this->db->query("SELECT  *
            FROM            tbl_HRM_Dept
            WHERE  DeptID = '$Id'"
        );
            return $query->result_array();
        }

        public function EditSection($id,$deptBuild, $deptName,$status){

            $query = $this->db->query("UPDATE  dbo . tbl_HRM_Dept 
            SET   BID  =  '$deptBuild',
            DeptName  =  '$deptName' ,
            Status  =  '$status' 
          WHERE  DeptID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Department of Asset has been Updated. ');
                redirect('assetlocation');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Chart of Department.');
                redirect('assetlocation');
            }
        
        }

        public function deleteSection($Id){
        
            $query=$this->db->query("DELETE FROM  tbl_HRM_Dept 
            WHERE  DeptID='$Id'");
           if ($query) {
            $this->session->set_flashdata('ProDelDepinfo', 'Department has been Deleted. ');
            redirect('assetlocation');
        } else {
           $this->session->set_flashdata('danger', 'There is an error while Deleting Department.');
            redirect('assetlocation');
        }
    }      

////////////////////////////////////////////////////////// Depreciation Method ///////////////////////////////////////////////////

public function getDepreciations(){
    $query=$this->db->query('SELECT *
    FROM Tbl_Assets_Depression_method');
      return $query->result_array();   
      }

          
 public function AddDepreciation($name,$status){

     $query = $this->db->query("INSERT INTO Tbl_Assets_Depression_method
      (  DepresionMethod ,
      Status )
         VALUES
            ('$name', '$status')");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Depreciation Method of Asset has been added. ');
                redirect('AssetsDepreciationMethod');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while creating Depreciation Method of Asset.');
                redirect('AssetsDepreciationMethod');
            }
        
        }


        public function getDepreciation($Id){
            $query = $this->db->query("SELECT  *
            FROM            Tbl_Assets_Depression_method
            WHERE  ID = '$Id'"
        );
            return $query->result_array();
        }

        public function EditDepreciation($id,$name,$status){

            $query = $this->db->query("UPDATE  dbo . Tbl_Assets_Depression_method 
            SET   DepresionMethod  =  '$name',
            Status  =  '$status' 
          WHERE  ID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Depreciation Method of Asset has been Updated. ');
                redirect('AssetsDepreciationMethod');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Chart of Depreciation Method.');
                redirect('AssetsDepreciationMethod');
            }
        
        }

        public function deleteDepreciation($Id){
        
            $query=$this->db->query("DELETE FROM  Tbl_Assets_Depression_method 
            WHERE  ID='$Id'");
           if ($query) {
            $this->session->set_flashdata('ProDelDepinfo', 'Depreciation Method has been Deleted. ');
            redirect('AssetsDepreciationMethod');
        } else {
           $this->session->set_flashdata('danger', 'There is an error while Deleting Depreciation Method.');
            redirect('AssetsDepreciationMethod');
        }
    } 
    

////////////////////////////////////////////////////////// Original Life ///////////////////////////////////////////////////////////

public function getOriginalLifes(){
    $query=$this->db->query('  SELECT *
    FROM tbl_Assert_OR_Life');
      return $query->result_array();   
      }

          
 public function AddOriginalLife($name,$status){

     $query = $this->db->query("INSERT INTO tbl_Assert_OR_Life
      (  OriginalLife ,
      Status )
         VALUES
            ('$name', '$status')");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Original Life of Asset has been added. ');
                redirect('AssetsOriginalLife');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while creating Original Life of Asset.');
                redirect('AssetsOriginalLife');
            }
        
        }


        public function getOriginalLife($Id){
            $query = $this->db->query("SELECT  *
            FROM            tbl_Assert_OR_Life
            WHERE  ID = '$Id'"
        );
            return $query->result_array();
        }

        public function EditOriginalLife($id,$name,$status){

            $query = $this->db->query("UPDATE  dbo . tbl_Assert_OR_Life 
            SET   OriginalLife  =  '$name',
            Status  =  '$status' 
          WHERE  ID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Original Life of Asset has been Updated. ');
                redirect('AssetsOriginalLife');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Chart of Original Life.');
                redirect('AssetsOriginalLife');
            }
        
        }

        public function deleteOriginalLife($Id){
        
            $query=$this->db->query("DELETE FROM  tbl_Assert_OR_Life
            WHERE  ID='$Id'");
           if ($query) {
            $this->session->set_flashdata('ProDelDepinfo', 'Original Life Method has been Deleted. ');
            redirect('AssetsOriginalLife');
        } else {
           $this->session->set_flashdata('danger', 'There is an error while Deleting Original Life.');
            redirect('AssetsOriginalLife');
        }
    } 

////////////////////////////////////////////////////////// Vendors ///////////////////////////////////////////////////////////

public function getVendors(){
    $query=$this->db->query('  SELECT *
    FROM tbl_Vendors');
      return $query->result_array();   
      }

          
 public function AddVendor($name,$address,$number,$status){

     $query = $this->db->query("INSERT INTO tbl_Vendors
      (  VendorName , Address, Phone,
      Status )
         VALUES
            ('$name', '$address', '$number', '$status')");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Vendor of Asset has been added. ');
                redirect('vendors');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while creating Vendor of Asset.');
                redirect('vendors');
            }
        
        }


        public function getVendor($Id){
            $query = $this->db->query("SELECT  *
            FROM            tbl_Vendors
            WHERE  VendorID = '$Id'"
        );
            return $query->result_array();
        }

        public function EditVendor($Id, $name,$address,$number,$status){

            $query = $this->db->query("UPDATE  dbo . tbl_Vendors 
            SET   VendorName  =  '$name',Address  =  '$address',Phone  =  '$number', Status  =  '$status' 
          WHERE  VendorID='$Id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Vendor of Asset has been Updated. ');
                redirect('vendors');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Vendor.');
                redirect('vendors');
            }
        
        }

        public function deleteVendor($Id){
        
            $query=$this->db->query("DELETE FROM  tbl_Vendors
            WHERE  VendorID='$Id'");
           if ($query) {
            $this->session->set_flashdata('ProDelDepinfo', 'Vendor has been Deleted. ');
            redirect('vendors');
        } else {
           $this->session->set_flashdata('danger', 'There is an error while Deleting Vendor.');
            redirect('vendors');
        }
    } 


////////////////////////////////////////////////////////// Asset Functions ///////////////////////////////////////////////////////////

public function getAssets(){
    $query=$this->db->query('  SELECT        dbo.view_asset.*
    FROM            dbo.view_asset');
      return $query->result_array();   
      }

          
 public function AddAsset($type,$name,$build,$dept,$sec,$cost,$pDate,$exp,$orig,$ven,$status,$overcost,$overDate,$state,$code,$des,$depMeth,$pic){
    date_default_timezone_set("Asia/Karachi");
     $query = $this->db->query("INSERT INTO tbl_Assert
      (  
       BID 
      , DeptID 
      , SecID 
      , AsTypeID 
      , AssetChartId
      , image
      , PurcaseDate 
      , OverHallDate 
      , OriginalLifeID 
      , ExpiryDate 
      , Cost 
      , OverHallCost 
      , DpMethodID 
      , State
      , TransCode
      , VendorID
      , status
      , des
 )
         VALUES
            ('$build', '$dept', '$sec', '$type','$name', '$pic','$pDate', '$overDate', '$orig','$exp', '$cost', '$overcost', '$depMeth','$state','$code','$ven','$status', '$des')");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Asset has been added. ');
                redirect('AssetsPurchase');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while creating Asset.');
                redirect('AssetsPurchase');
            }
        
        }


        public function EditAsset($id,$type,$name,$build,$dept,$sec,$cost,$pDate,$exp,$orig,$ven,$status,$overcost,$overDate,$state,$des,$depMeth,$pic){
            date_default_timezone_set("Asia/Karachi");
            $query = $this->db->query("UPDATE  dbo . tbl_Assert 
            SET   BID  =  '$build',DeptID  =  '$dept',SecID  =  '$sec', AsTypeID  =  '$type' , 
            AssetChartId  =  '$name',image = '$pic',PurcaseDate  =  '$pDate',OverHallDate  =  '$overDate', OriginalLifeID  =  '$orig',

            ExpiryDate  =  '$exp',Cost  =  '$cost',OverHallCost  =  '$overcost', DpMethodID  =  '$depMeth' , 
            State  =  '$state',VendorID  =  '$ven',status  =  '$status', des  =  '$des' 
          WHERE  AsstID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Vendor of Asset has been Updated. ');
                redirect('AssetsPurchase');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Vendor.');
                redirect('AssetsPurchase');
            }
        
        }

        public function EditAssetWithoutPicture($id,$type,$name,$build,$dept,$sec,$cost,$pDate,$exp,$orig,$ven,$status,$overcost,$overDate,$state,$des,$depMeth){
            date_default_timezone_set("Asia/Karachi");
            $query = $this->db->query("UPDATE  dbo . tbl_Assert 
            SET   BID  =  '$build',DeptID  =  '$dept',SecID  =  '$sec', AsTypeID  =  '$type' , 
            AssetChartId  =  '$name',PurcaseDate  =  '$pDate',OverHallDate  =  '$overDate', OriginalLifeID  =  '$orig',
            ExpiryDate  =  '$exp',Cost  =  '$cost',OverHallCost  =  '$overcost', DpMethodID  =  '$depMeth' , 
            State  =  '$state',VendorID  =  '$ven',status  =  '$status', des  =  '$des' 
          WHERE  AsstID='$id'");
            
            if ($query) {
                $this->session->set_flashdata('Proinfo', 'Vendor of Asset has been Updated. ');
                redirect('AssetsPurchase');
            } else {
                $this->session->set_flashdata('danger', 'There is an error while Updating Vendor.');
                redirect('AssetsPurchase');
            }
        
        }
        public function getAsset($Id){
            $query = $this->db->query("SELECT  *
            FROM            tbl_Assert
            WHERE  AsstID = '$Id'"
        );
            return $query->result_array();
        }

 

        public function deleteAsset($Id){
        
            $query=$this->db->query("DELETE FROM  tbl_Assert
            WHERE  AsstID='$Id'");
           if ($query) {
            $this->session->set_flashdata('ProDelDepinfo', 'Asset has been Deleted. ');
            redirect('AssetsPurchase');
        } else {
           $this->session->set_flashdata('danger', 'There is an error while Deleting Asset.');
            redirect('AssetsPurchase');
        }
    } 

    public function  getChartOfAssets($Id){
        $query=$this->db->query("  SELECT *
        FROM tbl_Assets_Catagory
        WHERE AssetType='$Id'");
          return $query->result_array();   
          }

          public function AddAssetMovingLocation($assMove,$buildMove,$depMove,$sectionMove,$status){
            date_default_timezone_set("Asia/Karachi");
            $date = date('Y-m-d');
             $query = $this->db->query("INSERT INTO tbl_Assets_location
              (  
               AssetID   
            ,  BID 
              , DeptID 
              , SectionID 
              , Date
              , Status
         )
                 VALUES
                    ('$assMove', '$buildMove', '$depMove', '$sectionMove','$date','$status')");
                    
                    if ($query) {
                        $this->session->set_flashdata('Proinfo', 'Asset has been added. ');
                        redirect('AssetsPurchase');
                    } else {
                        $this->session->set_flashdata('danger', 'There is an error while creating Asset.');
                        redirect('AssetsPurchase');
                    }
                
                }
        

          
  
          public function getimages(){
                  $query=$this->db->query("SELECT        dbo.View_156.CNIC, dbo.View_156.EmpPic
FROM            dbo.Table_10 INNER JOIN
                         dbo.View_156 ON dbo.Table_10.CNICN = dbo.View_156.CNIC
WHERE        (dbo.View_156.EmpPic IS NOT NULL)");
      return $query->result_array();   
          }
}
