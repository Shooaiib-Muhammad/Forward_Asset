

    <?php
if(!($this->session->has_userdata('user_id'))){
  redirect('login');
}else{
?>


                     
<?php
      $this->load->view('header');
    ?>

<body class="mod-bg-1 ">
        <!-- DOC: script to save and load page settings -->
        <script>
            /**
             *	This script should be placed right after the body tag for fast execution 
             *	Note: the script is written in pure javascript and does not depend on thirdparty library
             **/
            'use strict';

            var classHolder = document.getElementsByTagName("BODY")[0],
                /** 
                 * Load from localstorage
                 **/
                themeSettings = (localStorage.getItem('themeSettings')) ? JSON.parse(localStorage.getItem('themeSettings')) :
                {},
                themeURL = themeSettings.themeURL || '',
                themeOptions = themeSettings.themeOptions || '';
            /** 
             * Load theme options
             **/
            if (themeSettings.themeOptions)
            {
                classHolder.className = themeSettings.themeOptions;
                console.log("%c✔ Theme settings loaded", "color: #148f32");
            }
            else
            {
                console.log("Heads up! Theme settings is empty or does not exist, loading default settings...");
            }
            if (themeSettings.themeURL && !document.getElementById('mytheme'))
            {
                var cssfile = document.createElement('link');
                cssfile.id = 'mytheme';
                cssfile.rel = 'stylesheet';
                cssfile.href = themeURL;
                document.getElementsByTagName('head')[0].appendChild(cssfile);
            }
            /** 
             * Save to localstorage 
             **/
            var saveSettings = function()
            {
                themeSettings.themeOptions = String(classHolder.className).split(/[^\w-]+/).filter(function(item)
                {
                    return /^(nav|header|mod|display)-/i.test(item);
                }).join(' ');
                if (document.getElementById('mytheme'))
                {
                    themeSettings.themeURL = document.getElementById('mytheme').getAttribute("href");
                };
                localStorage.setItem('themeSettings', JSON.stringify(themeSettings));
            }
            /** 
             * Reset settings
             **/
            var resetSettings = function()
            {
                localStorage.setItem("themeSettings", "");
            }

        </script>
        <!-- BEGIN Page Wrapper -->
        <div class="page-wrapper">
            <div class="page-inner">
                <!-- BEGIN Left Aside -->
                <?php
      $this->load->view('aside');
    ?>
                <!-- END Left Aside -->
                <div class="page-content-wrapper">
                    <!-- BEGIN Page Header -->
                    <?php
      $this->load->view('template');
    ?>
                    <!-- END Page Header -->
                    <!-- BEGIN Page Content -->
                    <!-- the #js-page-content id is needed for some plugins to initialize -->
                    <main id="js-page-content" role="main" class="page-content">
                          <div>
                            <div>
                            
                            <!-- Popup Form Button --> 

                            <!-- <button type="button" class="btn btn-primary btn-lg" style="margin-left:86%;" data-toggle="modal" data-target="#ModalLoginForm">
    + Add Asset Purchase
</button> -->
<div id="ModalAssetMoving" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add/Edit Assets Location </h1>
            </div>
            <div class="modal-body">
                <form name="formMove" id="myFormMove" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="lid">
                        </div>
                    </div>

                    <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="assetIDMove">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Asset</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="assetMove" >
                        </div>
                    </div>

              
                    <div class="form-group">
                     <div>
                     <label for="sel1">Building :</label>
                        <select class="form-control" id="sel1" name="assetBuildMove" >
                        <option value="0" disabled>Select one of the following</option>
                        <?php
                                   if (isset($Building)) {
                                  foreach ($Building as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['BID'] ?>" ><?php echo $Key['BuildingName'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                        </div> 
                   </div>

                   
                   <div class="form-group">
                     <div>
                     <label for="sel1">Department :</label>
                        <select class="form-control" id="sel1" name="assetDeptMove" onchange="getComboC(this)">
                        <option value="0" disabled >Select one of the following</option>
                        <?php
                                   if (isset($Departments)) {
                                  foreach ($Departments as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['DeptID'] ?>" ><?php echo $Key['DeptName'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                        </div> 
                   </div>

                
        
                <div class="form-group">
                     <div>
                     <label for="sel1"> Section :</label>
                        <select class="form-control" id="sel1" name="assetSecMove" id="loadsec" >
                        <option value="0">Select one of the following</option>
                            </select>
                        </div> 
                   </div>

                    <!-- <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div> -->
                    <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="assetMoveStatus"> Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveAssetLocation" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateAssetLocation" style="display:none" >Update</button>   

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                          
                 </div>
                    </div>
                </form>
       
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Extra large modal -->
<div id="ModalLoginForm" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
<!-- Modal HTML Markup -->
<!-- <div  class="modal fade"> -->
   <!--  <div class="modal-dialog" role="document">
        <div class="modal-content">-->
            <div class="modal-header">
                <h1 class="modal-title">Asset information</h1>
                
            </div>
            <div class="modal-body">
                <form name="form" id="myForm" method="POST" action="" enctype="multipart/form-data">
                    <!-- <input type="hidden" name="_token" value=""> -->
                   <div class="row">
                   <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="pid">
                        </div>
                    </div>    
                   <div class="form-group col-md-3">
                      <label >Asset Type :</label>
                      <div>
                        <select class="form-control" name="assetType" onchange="getComboB(this)">
                        <option value="0" disabled>Select one of the following</option>
                        <?php
                                   if (isset($AssetType)) {
                                  foreach ($AssetType as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['TID'] ?>" ><?php echo $Key['AssertType'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                     </div>
                 </div> 
   <div class="form-group col-md-3">
                      <label >Asset : </label>
                      <div>
                        <select class="form-control" name="asset" >
                        <option value="0" >Select one of the following</option>
                            </select>
                     </div>
                 </div> 
                 
                       <div class="form-group col-md-3">
                     <div>
                     <label for="sel1">Building :</label>
                        <select class="form-control" id="sel1" name="assetBuild" >
                        <option value="0" disabled>Select one of the following</option>
                        <?php
                                   if (isset($Building)) {
                                  foreach ($Building as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['BID'] ?>" ><?php echo $Key['BuildingName'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                        </div> 
                   </div>

                   <div class="form-group col-md-3">
                     <div>
                     <label for="img">Upload Image:</label>
                     
                    <input type="file" name="img"/>
                        </div> 
                   </div>

                      <div class="form-group col-md-3">
                     <div>
                     <label for="sel1">Department :</label>
                        <select class="form-control" id="sel1" name="assetDept" onchange="getComboA(this)">
                        <option value="0" disabled >Select one of the following</option>
                        <?php
                                   if (isset($Departments)) {
                                  foreach ($Departments as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['DeptID'] ?>" ><?php echo $Key['DeptName'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                        </div> 
                   </div>

                
        
 <div class="form-group col-md-3">
                     <div>
                     <label for="sel1"> Section :</label>
                        <select class="form-control" id="sel1" name="assetSec" id="loadsec" >
                        <option value="0">Select one of the following</option>
                            </select>
                        </div> 
                   </div>
                    <div class="form-group col-md-3">
                        <label class="control-label">Cost :</label>
                        <div>
                            <input type="number" class="form-control input-lg" name="assetCost" placeholder="Enter Cost">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                        <label class="control-label">Purchase Date :</label>
                        <div>
                            <input type="date" class="form-control input-lg" name="assetPurchaseDate" placeholder="Enter Purchase Date">
                        </div>
                    </div>
 <div class="form-group col-md-3">
                        <label class="control-label">installation Date :</label>
                        <div>
                            <input type="date" class="form-control input-lg" name="insdate" >
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                    <label class="control-label" style="border 2px solid black"> Expiry Date</label> 
                    <button id= "myAnchor" class="btn btn-success btn-sm p-1 float-sm-right" >+</button>
                    <div id="myDIV" style="display:none">
                            <input type="date" class="form-control input-lg" name="assetExpiry" placeholder="Enter Expiry">
                        </div>
                    </div>


      
                    <div class="form-group col-md-3">
                      <label>Depreciation Method :</label>
                      <div>
                        <select class="form-control" name="assetDepMethId" >
                        <option value="0" disabled >Select one of the following</option>
                        <?php
                                   if (isset($DepMethod)) {
                                  foreach ($DepMethod as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['ID'] ?>" ><?php echo $Key['DepresionMethod'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                     </div>
                 </div> 

                 <div class="form-group col-md-3">
                      <label>Original Life :</label>
                      <div>
                        <select class="form-control" name="assetOriLifeId" >
                        <option value="0" disabled>Select one of the following</option>
                        <?php
                                   if (isset($OriginalLife)) {
                                  foreach ($OriginalLife as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['ID'] ?>" ><?php echo $Key['OriginalLife'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                     </div>
                 </div> 

                
                 <div class="form-group col-md-3">
                      <label >Vendor :</label>
                      <div>
                        <select class="form-control" name="assetVenId" >
                        <option value="0" disabled >Select one of the following</option>
                        <?php
                                   if (isset($Vendors)) {
                                  foreach ($Vendors as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['VendorID'] ?>" ><?php echo $Key['VendorName'] ?></option>
                        <?php
                        }
                       }
                  ?>
                            </select>
                     </div>
                 </div> 

  <div class="form-group col-md-3">
                        <label class="control-label">Assign To:</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="user" placeholder="Assign To">
                        </div>
                    </div>
                 <div class="form-group col-md-3">
                      <label >Status :</label>
                      <div>
                        <select class="form-control" name="assetStatus" >
                        <option value="" disabled>Select one of the following</option>
                            <option value="Active">Active</option>
                            <option value="Non Active">Non Active</option>
                            </select>
                     </div>
                 </div> 
  <div class="form-group col-md-3">
                      <label >Brand :</label>
                      <div>
                        <select class="form-control" name="brand" >
                        <option value="" disabled>Select one of the following</option>
                            <option value="Local">Local</option>
                            <option value="Imported">Imported</option>
                            </select>
                     </div>
                 </div> 
     
                   <div class="form-group col-md-3">
                        <label class="control-label">Overall Cost :</label>
                        <div>
                            <input type="number" class="form-control input-lg" name="overCost" placeholder="Enter Overall Cost">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                    <label class="control-label">Overall Date :</label>
                        <div>
                            <input type="date" class="form-control input-lg" name="assetOverallDate" placeholder="Enter Overall Date">
                        </div>
                    </div>

                    <div class="form-group col-md-3">
                      <label >State :</label>
                      <div>
                        <select class="form-control" name="assetState" >
                        <option value="" disabled >Select one of the following</option>
                            <option value="In Use">In Use</option>
                            <option value="In Stock">In Stock</option>
                            <option value="Missing">Missing</option>
                            <option value="Under Maintain">Under Maintain</option>
                            </select>
                     </div>
                 </div> 
      
                    <div class="form-group ">
                        <label class="control-label">Short Description :</label>
                        <div>
                        <textarea name="assetShortDes" id="assetShortDesId" rows="5" cols="90" placeholder="Enter Short Description"></textarea>
                        </div>
                    </div>
              
                    <!-- <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" name="password">
                        </div>
                    </div> -->
                    <!-- <div class="form-group col-md-3">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="status"> Status
                                </label>
                            </div>
                        </div>
                    </div> --> 
                    </div>
                    <br><br>
                    <div class="row">
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveButtonAsset" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateButtonAsset" style="display:none" >Update</button>   

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                           <!--  <a class="btn btn-link" href="">Forgot Your Password?</a> -->
                        </div>
                    </div>
        </div>
        
                </form>
        
                     </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="ModelDeleteloc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Asset Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-asset">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>
<br><br>
                                <!--Table responsive-->
                                <div id="panel-8" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                        <i class='fal fa fa-table text-primary'></i>&nbsp;&nbsp;Assets Information 
</span>
                                        </h2>
                                        <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" class="d-grid gap-2 d-md-block float-right" data-target=".bd-example-modal-xl" id="createAsset">+ Create Asset</button>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <!--         <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                          <!--   <div class="panel-tag">
                                                Make table responsive with <code>.table-responsive</code>. Maximum breakpoint can be applied by adding <code>.table-responsive-sm</code>, <code>.table-responsive-ms</code>, <code>.table-responsive-lg</code>, <code>.table-responsive-xl</code>
                                            </div> -->
                                            <div class="table-responsive-lg">
                        
                                                                    <table class="table table-striped table-hover table-sm" id="tableExport">
                                                                            <thead>
                                                                                <tr>
                                                                                <th> Image</th>
                                                                                <th>Code</th>
                                                                                    <th>Type</th>
                                                                                    <th>Asset</th>
                                                                                    <th>Building</th>
                                                                                    <th>Department</th>
                                                                                    <th>Section</th>
                                                                                    <th>Cost</th>

                                                                                    <th>Purchase</th>
                                                                                 
                                                            
                                                                                    <th>Dep. Method</th>
                                                                                    <th>Org. Life</th>


                                                                                    <th>Actions</th>
                                                                                </tr>
                                                                            </thead>
                                                                            <tbody>

                                                                            <?php
                                                                if (isset($Assets)) {
                                                                    foreach ($Assets as $Key) {
                                                                    
                                                                ?>

                                                                <tr>
                                                                <td ><img src="<?php echo base_url('/assets/img/img/'.$Key['image']) ?>" alt="Asset Picture" height="50px" width="50px" style="border-radius: 50%;"/></td>
                                                                <td ><?php echo $Key['TransCode']; ?></td>  
                                                                <td ><?php echo $Key['AssertType']; ?></td>
                                                                    <td ><?php echo $Key['Name']; ?></td>
                                                                    <td ><?php echo $Key['BuildingName']; ?></td>

                                                                    <td ><?php echo $Key['DeptName']; ?></td>
                                                                    <td ><?php echo $Key['SectionName']; ?></td>
                                                                    <td ><?php echo Round($Key['Cost']); ?></td>

                                                                    <td ><?php echo $Key['PurcaseDate']; ?></td>
                                                                   
                                                 

                                                                    <td ><?php echo $Key['DepresionMethod']; ?></td>
                                                                    <td ><?php echo $Key['OriginalLife']; ?></td>

                                                                                   
                                                                    <td > 
                                                                    <button data-value=<?php echo $Key['AsstID'] ?> data-toggle="modal" data-target="#ModalAssetMoving" class="btn btn-primary btn-sm btnMoveAsset"><i style="font-size:15px;">Move</i> </button>&nbsp;&nbsp;
                                                                    <button  data-value=<?php echo $Key['AsstID'] ?> data-toggle="modal" data-target="#ModalLoginForm" class="btn btn-primary btn-sm btnEditAsset"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                                                    <button  data-value=<?php echo $Key['AsstID'] ?> data-toggle="modal" data-target="#ModelDeleteloc" class="btn btn-primary btn-sm btn-delete"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                                                                  
                                                                <!--   <a class="btn" href="#ModalProjectForm"><i class="fa fa-pencil-square-o"  style="font-size:25px;"></i> 
                                                                    <a class="btn" href="#"><i class="fa fa-trash" aria-hidden="true" style="font-size:25px;"></i> -->
                                                                </td>
                                                                </tr>
                                                                <?php
                                                                        }
                                                                }
                                                                ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
               <?php
               
              
               ?>
                    <?php
        $this->load->view('after-main');
       ?>
        <!-- END Page Settings -->
        <!-- base vendor bundle: 
			 DOC: if you remove pace.js from core please note on Internet Explorer some CSS animations may execute before a page is fully loaded, resulting 'jump' animations 
						+ pace.js (recommended)
						+ jquery.js (core)
						+ jquery-ui-cust.js (core)
						+ popper.js (core)
						+ bootstrap.js (core)
						+ slimscroll.js (extension)
						+ app.navigation.js (core)
						+ ba-throttle-debounce.js (core)
						+ waves.js (extension)
						+ smartpanels.js (extension)
						+ src/../jquery-snippets.js (core) -->
       <?php
        $this->load->view('Foter');
       ?>

<script>       
$(document).ready(function(){


$('#tableExport').on('click',".btn-delete",function(e){

llid = $(this).attr('data-value')
postData = {
llid
}
console.log(llid); 
$('.btn-confirm-del-asset').click(function(e){
url = '<?php echo base_url('AssetsPurchase/deleteAsset') ?>'

$.post(url,postData,
function(data, status){
window.location.reload();  

});


})
}); 


$('#createAsset').click(function(e){
    $("#saveButtonAsset").css("display", "inline-block");
    $("#updateButtonAsset").css("display", "none");
    $("#myForm").trigger("reset");
    $('form[name=form]').attr('action','<?php echo base_url('AssetsPurchase/AddAsset') ?>');
    $('select[name=assetDept]').val('0');
    $('select[name=assetBuild]').val('0');
    $('select[name=assetType]').val('0');
    $('select[name=assetSec]').val('0');
    $('select[name=asset]').val('0');
    $('select[name=assetDepMethId]').val('0');
    $('select[name=assetOriLifeId]').val('0');
    $('select[name=assetVenId]').val('0');
    


});

$('#tableExport').on('click',".btnMoveAsset",function(e){
    $("#saveAssetLocation").css("display", "inline-block");
    $("#updateAssetLocation").css("display", "none");
    $("#myFormMove").trigger("reset");
    $('select[name=assetBuildMove]').val('0');
    $('select[name=assetDeptMove]').val('0');
    $('select[name=assetSecMove]').val('0');
    $('select[name=assetMoveStatus]').val('0');
    $('form[name=formMove]').attr('action','<?php echo base_url('AssetsPurchase/AddAssetLocation') ?>');
    var formData =[];
         let   llid = $(this).attr('data-value');
      postData = {
        llid
      }
      
      $('input[name=assetIDMove]').val(llid);
      url = '<?php echo base_url('AssetsPurchase/getAsset') ?>'
      
      $.post(url,postData,
    function(data, status){
      var returnedData = JSON.parse(data);
     
      url2 = '<?php echo base_url('assettype/getChartValue') ?>'
   let llid = returnedData[0].AssetChartId;
      postData2 = {
        llid
      }

      $.post(url2,postData2,
    function(data, status){
      var returnedData = JSON.parse(data);
      console.log(returnedData[0]);  
      $("input[name=assetMove]").val(returnedData[0].Name);
    });
    
  }); 
  
});



$('#tableExport').on('click',".btnEditAsset",function(e){

    $("#saveButtonAsset").css("display", "none");
    $("#updateButtonAsset").css("display", "inline-block");
    $('form[name=form]').attr('action','<?php echo base_url('AssetsPurchase/EditAsset') ?>');
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      url = '<?php echo base_url('AssetsPurchase/getAsset') ?>'
//alert(url);
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
    console.log(returnedData);
    $("input[name=pid]").val(returnedData[0].AsstID);
     $("input[name=user]").val(returnedData[0].Assignto);
   
    
    $("select[name=assetType]").val(returnedData[0].AsTypeID);
  let idofPro = returnedData[0].AsTypeID;
 
 postData = {
    idofPro
  }
    url2 = '<?php echo base_url('AssetsPurchase/getChartOfAssets') ?>' 
 
    $.post(url2,postData,
function(data, status){
  var returnedData2 = JSON.parse(data);


   dataaa1 = returnedData2;

   options = "<option value='' disabled>Select Chart of Asset</option>"
     for (i = 0; i < dataaa1.length; i++) {
       if(returnedData[0].AssetChartId == dataaa1[i].ID){
        options +=  '<option value="' + dataaa1[i].ID + '" selected>' + dataaa1[i].Name + '</option>'
       }
     options +=  '<option value="' + dataaa1[i].ID + '">' + dataaa1[i].Name + '</option>'
         }
        $("select[name=asset]").html(options)

});

    $("select[name=assetBuild]").val(returnedData[0].BID);
    $("select[name=assetDept]").val(returnedData[0].DeptID);

    url3 = '<?php echo base_url('assetlocation/getSectionEdit') ?>' 
    var idofEdit = returnedData[0].DeptID; 

 postData = {
    idofEdit
  }
    $.post(url3,postData,
function(data, status){
  var returnedData2 = JSON.parse(data);
   dataaa1 = returnedData2;
   options = "<option value='' disabled>Select Section</option>"
     for (i = 0; i < dataaa1.length; i++) {
       if(returnedData[0].SecID == dataaa1[i].SectionID){
        options +=  '<option value="' + dataaa1[i].SectionID + '" selected>' + dataaa1[i].SectionName + '</option>'
       }
     options +=  '<option value="' + dataaa1[i].SectionID + '">' + dataaa1[i].SectionName + '</option>'
         }
        $("select[name=assetSec]").html(options)

});

    $("input[name=assetCost]").val(returnedData[0].Cost);
    let split_p_date = returnedData[0].PurcaseDate.split("-");
    let split_p_date_last = split_p_date[2].split(" ");
    let new_p_date = split_p_date[0] + "-"+split_p_date[1] + "-"+split_p_date_last[0];
    console.log(new_p_date);
    
    $("input[name=assetPurchaseDate]").val(new_p_date);

    let split_exp_date = returnedData[0].ExpiryDate.split("-");
    let split_exp_date_last = split_exp_date[2].split(" ");
    let new_exp_date = split_exp_date[0] + "-"+split_exp_date[1] + "-"+split_exp_date_last[0];
    console.log(new_exp_date);

    $("input[name=assetExpiry]").val(new_exp_date);


    $("select[name=assetDepMethId]").val(returnedData[0].DpMethodID);

    $("select[name=assetOriLifeId]").val(returnedData[0].OriginalLifeID);
    $("select[name=assetVenId]").val(returnedData[0].VendorID);
    $("input[name=assetStatus]").val(returnedData[0].status);
 $("select[name=brand]").val(returnedData[0].BrandType);
    $("input[name=overCost]").val(returnedData[0].OverHallCost);

    let split_over_date = returnedData[0].OverHallDate.split("-");
    let split_over_date_last = split_over_date[2].split(" ");
    let new_over_date = split_over_date[0] + "-"+split_over_date[1] + "-"+split_over_date_last[0];
    console.log(new_over_date);

    $("input[name=assetOverallDate]").val(new_over_date);

    let split_instalation_date = returnedData[0].InstallationDate.split("-");
    let split_instalation_date_last = split_instalation_date[2].split(" ");
    let new_inslation_date = split_instalation_date[0] + "-"+split_instalation_date[1] + "-"+split_instalation_date_last[0];
    console.log(new_inslation_date);

    $("input[name=insdate]").val(new_inslation_date);
    

    $("select[name=assetState]").val(returnedData[0].State);
    $("#assetShortDesId").text(returnedData[0].des);

 }); 

});


    });
</script> 

<script>

document.getElementById("myAnchor").addEventListener("click", function(event){
  event.preventDefault()
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }


});

function getComboA(selectObject) {
  var idofPro = selectObject.value;  
 // console.log(value);
 postData = {
    idofPro
  }
 
  url = '<?php echo base_url('assetlocation/getSection') ?>'
  
  $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
   console.log(returnedData);
 
   dataaa = returnedData;
   options = "<option value='' selected>Select Section</option>"
     for (i = 0; i < dataaa.length; i++) {
     options +=  '<option value="' + dataaa[i].SectionID + '">' + dataaa[i].SectionName + '</option>'
         }
        $("select[name=assetSec]").html(options)


  }); 
  
}

function getComboB(selectObject) {
  
   var idofPro = selectObject.value;  
 // console.log(value);
 postData = {
    idofPro
  }
 
  url = '<?php echo base_url('AssetsPurchase/getChartOfAssets') ?>'
  
  $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
   console.log(returnedData);
 
   dataaa = returnedData;
   options = "<option value='' selected>Select Chart of Asset</option>"
     for (i = 0; i < dataaa.length; i++) {
     options +=  '<option value="' + dataaa[i].ID + '">' + dataaa[i].Name + '</option>'
         }
        $("select[name=asset]").html(options)


  });  
  
}

function getComboC(selectObject) {
  var idofPro = selectObject.value;  
 // console.log(value);
 postData = {
    idofPro
  }
 
  url = '<?php echo base_url('assetlocation/getSection') ?>'
  
  $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
   console.log(returnedData);
 
   dataaa = returnedData;
   options = "<option value='' selected>Select Section</option>"
     for (i = 0; i < dataaa.length; i++) {
     options +=  '<option value="' + dataaa[i].SectionID + '">' + dataaa[i].SectionName + '</option>'
         }
        $("select[name=assetSecMove]").html(options)


  }); 
  
}
</script> 
</body>
</html>
<?php

}

?>