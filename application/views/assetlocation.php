

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
                    <?php
      if($this->session->flashdata('Proinfo')){ 
    
    
      ?>
    <div class="alert alert-danger alert-dismissible show fade" id="msgbox">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('Proinfo');?>
                    </div>
                  </div>
                  <?php
      }

                  ?>
                          <div>
                            <div>
                            
                            <!-- Popup Form Button --> 

<!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add Building</h1>
            </div>
            <div class="modal-body">
                <form role="form" name="form" id="myForm" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="BID">
                        </div>
                    </div>

                     
                     <div class="form-group">
                        <label class="control-label">Building Name :</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="buildName" placeholder="Building Name">
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
                                    <input type="checkbox" name="locationStatus" id="buildStatus"> Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveButtonBuilding" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateButtonBuilding" style="display:none" >Update</button>   
                            <input type = "reset" class="bg-secondary text-white btn-sm" id="btnClear" />

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                          
                 </div>
                    </div>
                </form>
       
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal -->
<div class="modal fade" id="ModelDeleteloc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Building Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-loc">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>


<div class="modal fade" id="ModelDeleteDept" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Department Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-dept">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModelDeleteSec" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Department Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-sec">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>


<div id="Modaldepartment" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add Department</h1>
            </div>
            <div class="modal-body">
                <form name="formDepartment" id="myformDepartment" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="did">
                        </div>
                    </div>
                  
                     <div class="form-group">
                     <div>
                     <label for="sel1">Select Building  :</label>
                        <select class="form-control" id="sel1" name="assetDepBuild" >
                        <option value="" disabled>Select one of the following</option>
                        <?php
                                   if (isset($Location)) {
                                  foreach ($Location as $Key) {
                           
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
                        <label class="control-label">Department Name </label>
                        <div>
                            <input type="text" class="form-control input-lg" name="assetDeptName" placeholder="Department Name">
                        </div>
                    </div>
           
                    <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="assetDeptStatus"> Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveButtonDepartment" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateButtonDepartment" style="display:none" >Update</button>   
                            
                            <!-- <input type = "reset" class="bg-secondary text-white btn-sm" id="btnClear" /> -->

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                          
                 </div>
                    </div>
                </form>
       
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
        </div>

<div id="Modalsection" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add Section</h1>
            </div>
            <div class="modal-body">
                <form name="formSection" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value=""> -->
                     <div class="form-group">
                     <div>
                     <label for="sel1">Select Building :</label>
                        <select class="form-control" id="sel1" name="assetSecBuild" >
                        <option value="" disabled>Select one of the following</option>
                        <?php
                                   if (isset($Location)) {
                                  foreach ($Location as $Key) {
                           
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
                     <label for="sel1">Select Department :</label>
                        <select class="form-control" id="sel1" name="assetSecDept" >
                        <option value="" disabled >Select one of the following</option>
                        <?php
                                   if (isset($DepartmentsLocation)) {
                                  foreach ($DepartmentsLocation as $Key) {
                           
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
                        <label class="control-label">Section Name :</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="assetSecName" placeholder="Section Name">
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
                                    <input type="checkbox" name="assetSecStatus"> Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveButtonSection" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateButtonSection" style="display:none" >Update</button>   
                            
                            <!-- <input type = "reset" class="bg-secondary text-white btn-sm" id="btnClear" /> -->

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                          
                 </div>
                    </div>
                </form>
       
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
        </div>
<br><br>
<div id="panel-7" class="panel">
                                    <div class="panel-hdr">
                                        <h2>
                                            Asset <span class="fw-300"><i>location</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                          
                                        <!--     <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#nav_pills_default-1">Building</a></li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#nav_pills_default-2">Department</a></li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#nav_pills_default-3">Section</a></li>
                                            
                                            </ul> -->
                                            <div class="tab-content py-3">
                                                <div class="tab-pane fade show active" id="nav_pills_default-1" role="tabpanel">
                                                      <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#ModalLoginForm" class="d-grid gap-2 d-md-block" id="createBuilding">+ Create Building</button>   
                                                      <div class="table-responsive-lg">
                        
                        <table class="table table-striped table-hover table-sm" id="tableExport">
                                <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                    if (isset($Location)) {
                        foreach ($Location as $Key) {
                           
                    ?>

                                    <tr>
                                        <td ><?php echo $Key['BuildingName']; ?></td>
                                        <?php
                    if ($Key['Status'] == 1) {
                        ?>
                                        <td ><span class="badge" style="color:blue;border:1px solid black;color:white;background-color:green">active</span></td>
                                        <?php
                    }
                            else{
                                ?>
                                <td ><span class="badge" style="color:blue;border:1px solid black;color:white;background-color:red">Inactive</span></td>
                               <?php 
                            }
                            ?>    
                                        <td > 
                                        <button  data-value=<?php echo $Key['BID'] ?> data-toggle="modal" data-target="#ModalLoginForm" class="btn btn-primary btn-sm btn-edit-loc waves-effect waves-themed"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                        <button  data-value=<?php echo $Key['BID'] ?> data-toggle="modal" data-target="#ModelDeleteloc" class="btn btn-primary btn-sm btn-delete waves-effect waves-themed"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                             
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
                                                <div class="tab-pane fade" id="nav_pills_default-2" role="tabpanel">
                                                      <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#Modaldepartment" class="d-grid gap-2 d-md-block" id="createDepartment">+ Create Department</button>   
                                                      <div class="table-responsive-lg">
                        
                        <table class="table table-striped table-hover table-sm" >
                                <thead>
                                    <tr>
                                        <th>Building Name</th>
                                        <th>Department Name</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                    if (isset($DepartmentsLocation)) {
                                        foreach ($DepartmentsLocation as $Key) {
                                        
                                    ?>

                                    <tr>
                                        <td ><?php echo $Key['BID']; ?></td>
                                        <td ><?php echo $Key['DeptName']; ?></td>
                                        <?php
                                    if ($Key['Status'] == 1) {
                                        ?>
                                        <td ><span class="badge" style="color:blue;border:1px solid black;color:white;background-color:green">active</span></td>
                                        <?php
                                }
                                        else{
                                ?>
                                <td ><span class="badge" style="color:blue;border:1px solid black;color:white;background-color:red">Inactive</span></td>
                               <?php 
                                        }
                                        ?>    
                                        <td > 
                                        <button  data-value=<?php echo $Key['DeptID'] ?> data-toggle="modal" data-target="#Modaldepartment" class="btn btn-primary btn-sm btn-edit-dept"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                        <button  data-value=<?php echo $Key['DeptID'] ?> data-toggle="modal" data-target="#ModelDeleteDept" class="btn btn-primary btn-sm btn-delete-dept"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                             
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
                                                <div class="tab-pane fade" id="nav_pills_default-3" role="tabpanel">
                                                       <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#Modalsection" class="d-grid gap-2 d-md-block" id="createSection">+ Create Section</button>   
                                                       <div class="table-responsive-lg">
                        
                                        <table class="table table-striped table-hover table-sm" id="tableExport3">
                                                <thead>
                                                    <tr>
                                                        <th>Building Name</th>
                                                        <th>Department Name</th>
                                                        <th>Section Name</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                <?php
                                            if (isset($SectionsLocation)) {
                                                foreach ($SectionsLocation as $Key) {
                                                
                                            ?>

                                                            <tr>
                                                <td ><?php echo $Key['BID']; ?></td>
                                                <td ><?php echo $Key['DeptID']; ?></td>
                                                <td ><?php echo $Key['SectionName']; ?></td>
                                                <?php
                                                if ($Key['Status'] == 1) {
                                                    ?>
                                                <td ><span class="badge" style="color:blue;border:1px solid black;color:white;background-color:green">active</span></td>
                                                <?php
                                                }
                                                        else{
                                                ?>
                                <td ><span class="badge" style="color:blue;border:1px solid black;color:white;background-color:red">Inactive</span></td>
                               <?php 
                                        }
                                        ?>    
                                        <td > 
                                        <button  data-value=<?php echo $Key['SectionID'] ?> data-toggle="modal" data-target="#Modalsection" class="btn btn-primary btn-sm btn-edit-section"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                        <button  data-value=<?php echo $Key['SectionID'] ?> data-toggle="modal" data-target="#ModelDeleteSec" class="btn btn-primary btn-sm btn-delete-sec"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                             
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
     <!--Table responsive-->
    
                            </div>
                        </div>
                    </main>
            
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
    
<script>       
$(document).ready(function(){
/*         $('#data').after('<br><div id="nav" class="pagination"></div>');
        var rowsShown = 10;
        var rowsTotal = $('#data tbody tr').length;
        var numPages = rowsTotal/rowsShown;
        for(i = 0;i < numPages;i++) {
            var pageNum = i + 1;
            $('#nav').append('<li class="page-item"><a class="page-link" href="#" rel="'+i+'">'+pageNum+'</a> &nbsp;&nbsp; ');
        }
        $('#data tbody tr').hide();
        $('#data tbody tr').slice(0, rowsShown).show();
        $('#nav a:first').addClass('active');
        $('#nav a').bind('click', function(){

            $('#nav a').removeClass('active');
            $(this).addClass('active');
            var currPage = $(this).attr('rel');
            var startItem = currPage * rowsShown;
            var endItem = startItem + rowsShown;
            $('#data tbody tr').css('opacity','0.0').hide().slice(startItem, endItem).
                    css('display','table-row').animate({opacity:1}, 300);
        });
*/
        $('.btn-delete-dept').click(function(e){

            llid = $(this).attr('data-value')
      postData = {
        llid
      }
      console.log("LLID",llid);
      $('.btn-confirm-del-dept').click(function(e){
    url = '<?php echo base_url('assetlocation/deleteDepartment') ?>'
      
    $.post(url,postData,
  function(data, status){
    window.location.reload();  
    
  });
}); 
}); 
  $('.btn-delete-sec').click(function(e){

llid = $(this).attr('data-value')
postData = {
llid
}
console.log("LLID",llid);
$('.btn-confirm-del-sec').click(function(e){
url = '<?php echo base_url('assetlocation/deleteSection') ?>'

$.post(url,postData,
function(data, status){
window.location.reload();  

});

      
    })
}); 

$('#tableExport').on('click',".btn-delete",function(e){

llid = $(this).attr('data-value')
postData = {
llid
}
console.log(llid); 
$('.btn-confirm-del-loc').click(function(e){
url = '<?php echo base_url('assetlocation/deleteLocation') ?>'

$.post(url,postData,
function(data, status){
window.location.reload();  

});


})
}); 


$('#createBuilding').click(function(e){
    $("#saveButtonBuilding").css("display", "inline-block");
    $("#updateButtonBuilding").css("display", "none");
    $("#myForm").trigger("reset");
    $('form[name=form]').attr('action','<?php echo base_url('assetlocation/AddAssetLocation') ?>');
});

$('#createDepartment').click(function(e){
    $("#saveButtonDepartment").css("display", "inline-block");
    $("#updateButtonDepartment").css("display", "none");
    $("#myFormDepartment").trigger("reset");
    $('form[name=formDepartment]').attr('action','<?php echo base_url('assetlocation/AddAssetDepartment') ?>');
});

$('#createSection').click(function(e){
    $("#saveButtonSection").css("display", "inline-block");
    $("#updateButtonSection").css("display", "none");
    $("#myFormSection").trigger("reset");
    $('form[name=formSection]').attr('action','<?php echo base_url('assetlocation/AddAssetSection') ?>');
});

$('#tableExport').on('click',".btn-edit-loc",function(e){
    $("#saveButtonBuilding").css("display", "none");
    $("#updateButtonBuilding").css("display", "inline-block");
    $('form[name=form]').attr('action','<?php echo base_url('assetlocation/EditBuilding') ?>');
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      url = '<?php echo base_url('assetlocation/getBuilding') ?>'
      
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
    console.log(returnedData[0]);
    $("input[name=buildName]").val(returnedData[0].BuildingName);
    if(returnedData[0].Status == 1){
        $("input[type=checkbox").prop('checked', true);
    }
    else{
        $("input[type=checkbox").prop('checked', false);
    }
    $("input[name=BID]").val(returnedData[0].BID);

  
 }); 

});

$('.btn-edit-dept').click(function(e){
    
    $("#saveButtonDepartment").css("display", "none");
    $("#updateButtonDepartment").css("display", "inline-block");
    $('form[name=formDepartment]').attr('action','<?php echo base_url('assetlocation/EditDepartment') ?>');
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      console.log("LLID",llid);
      url = '<?php echo base_url('assetlocation/getDepartment') ?>'
      
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
    if(returnedData[0].Status == 1){
        $('input[name=assetDeptStatus]').attr('Checked','Checked');
    //$("").checked = true;
}
else{
    $('input[name=assetDeptStatus]').removeAttr('Checked');
}

$("input[name=assetDeptName]").val(returnedData[0].DeptName);
$("input[name=did]").val(returnedData[0].DeptID);
    url3 = '<?php echo base_url('assetlocation/getBuildings') ?>'
    $.post(url3,
function(data, status){
  var returnedData3 = JSON.parse(data);
   dataaa2 = returnedData3;
   console.log(returnedData[0]);
   console.log(dataaa2);
    options = "<option value='' disabled>Select Asset Category  </option>"
     for (i = 0; i < dataaa2.length; i++) {
       if(returnedData[0].BID == dataaa2[i].BID){
          console.log("Called Building");
        options +=  '<option value="' + dataaa2[i].BID + '" selected>' + dataaa2[i].BuildingName + '</option>'
       }else{
        options +=  '<option value="' + dataaa2[i].BID + '">' + dataaa2[i].BuildingName + '</option>'
       }
     
         }
        $("select[name=assetDepBuild]").html(options)
 
});
  
 }); 



});

$('.btn-edit-section').click(function(e){
    alert("Called");
    $("#saveButtonSection").css("display", "none");
    $("#updateButtonSection").css("display", "inline-block");
    $('form[name=formSection]').attr('action','<?php echo base_url('assetlocation/EditSection') ?>');
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      url = '<?php echo base_url('assetlocation/getSection') ?>'
      
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
    console.log(returnedData[0]);
    $("input[name=buildName]").val(returnedData[0].BuildingName);
    if(returnedData[0].Status == 1){
        $("input[type=checkbox").prop('checked', true);
    }
    else{
        $("input[type=checkbox").prop('checked', false);
    }
    $("input[name=BID]").val(returnedData[0].BID);

  
 }); 

});


    });
</script>
<script>

/* document.getElementById("myAnchor").addEventListener("click", function(event){
  event.preventDefault()
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
*/
  /* document.getElementById("btnClear").addEventListener("click", function(event){
  $('#btnClear').click(function(){				
    event.preventDefault();

				$('#formAsset input[type="text"]').val('');
				$('#formAsset #number').val('');

                $('#formAsset #date').val('');

                $('#formAsset #select').val('');					
		}); */

//});
 



/* 
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
 */
</script>  

<?php
        $this->load->view('Foter');
       ?>
</body>
</html>
<?php

}

?>