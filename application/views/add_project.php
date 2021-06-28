

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
                            
    <!-------------------------------------------------------------- Popup Forms Section -------------------------------------------------------------------------> 

<!-- Modal HTML Markup -->
<div id="ModalProjectForm" class="modal fade" >
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add Project</h1>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('Project/AddProject') ?>" method="POST">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group">
                        <label class="control-label">Project Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="projectName" placeholder="Enter Project Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Start Date</label>
                        <div>
                            <input type="date" id ="datePicker" class="form-control input-lg" name="projectStartDate">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Completion Date</label>
                        <div>
                            <input type="date" class="form-control input-lg" name="projectCompDate">
                        </div>
                    </div>
                    <div class="form-group">
                      <label >Department Name </label>
                      <div>
                      <select class="form-control mySelectProD" name="DepartmentName"  data-live-search="true" searchable="Search here.." style="width: 100%">
                        <option value="" disabled selected>Select one of the following</option>
                      <?php
                                        if (isset($DepartmentValues)) {
                                            foreach ($DepartmentValues as $Key) {
                                               
                                        ?>
                        <option value="<?php echo $Key['LocalCustID']; ?>"><?php echo $Key['CustName']; ?></option>
                        <?php
                                            }
}
?>
                      </select>
                     </div>
                 </div> 

                 <div class="form-group ">
                        <label class="control-label">Narration</label>
                        <div>
                        <textarea id="w3review" name="projectNarration" rows="5" cols="70" placeholder="Enter Narration"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="projectStatus" > Status
                                </label>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success">Save</button>
                            
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
<div class="modal fade" id="ModelDeletePro" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Project Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>


<!-- Modal HTML Markup -->
<div id="exampleModalEdit" class="modal fade" >
    <div  class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Edit Project</h1>
            </div>
            <div class="modal-body">
                <form role="form" action="<?php echo base_url('Project/EditProject') ?>" method="POST">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group">

                        <label class="control-label">Project Name</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-name" name="projectName" placeholder="Enter Project Name">
                        </div>
                    </div>
                   
                    <div class="form-group" style="display:none;">
                        <label class="control-label">Project Head ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-Hid"  name="projectHID">
                        </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="control-label">Start Date</label>
                        <div>
                            <input type="date" class="form-control input-lg" id="project-sdate"  name="projectStartDate">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label">Completion Date</label>
                        <div>
                            <input type="date" class="form-control input-lg" id="project-cdate" name="projectCompDate">
                        </div>
                    </div>
                    <div class="form-group">
                      <label >Department Name </label>
                      <div>
                      <select class="form-control mySelectProDEdit" id="dept-id" name="DepartmentName"  data-live-search="true" searchable="Search here.." style="width: 100%">
                        <option disabled>Select one of the following</option>
                      <?php
                                        if (isset($DepartmentValues)) {
                                            foreach ($DepartmentValues as $Key) {
                                               
                                        ?>
                        <option value="<?php echo $Key['LocalCustID']; ?>"><?php echo $Key['CustName']; ?></option>
                        <?php
                                            }
}
?>
                      </select>
                     </div>
                 </div> 

                 <div class="form-group ">
                        <label class="control-label">Narration</label>
                        <div>
                        <textarea name="projectNarration" id="project-narration" rows="5" cols="70" placeholder="Enter Narration"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="projectStatus" id="project-status" > Status
                                </label>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success btn-confirmEdit">Save</button>

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                          
                        </div>
                    </div>

                    
                </form>
        
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-------------------------------------------------------------------        Ending of Pop Ups ------------------------------------------------->
<br><br>
     <!--Table responsive-->
     <div id="panel-8" class="panel">
     
                                    <div class="panel-hdr">
                                        <h2>
                                        <i class='fal fa fa-table text-primary'></i>&nbsp;&nbsp;Project Data Records 
                                        </h2>
                                        <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#ModalProjectForm" class="d-grid gap-2 d-md-block" >+ Create</button>
                   
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <!--         <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">

                            <div class="table-responsive">
                        
                                            <table class="table table-striped table-hover table-sm" id="tableExport">
                                                    <thead>
                                                        <tr>
                                                            <th>Project Name</th>
                                                            <th>Start Date</th>
                                                            <th>Complete Date</th>
                                                            <th>Department</th>
                                                            <th>Complete Status</th>
                                                            <th>Narration</th>
                                                            <th>User</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                        if (isset($ProjectValues)) {
                                            foreach ($ProjectValues as $Key) {
                                               
                                        ?>

                                                        <tr>
                                                            <td ><?php echo $Key['ProjectName']; ?></td>
                                                            <td ><?php echo $Key['StartDate']; ?></td>
                                                            <td ><?php echo $Key['CompDate']; ?></td>
                                                            <td ><?php echo $Key['CustName']; ?></td>
                                                            <?php
                                        if ($Key['CompStatus'] == 1) {
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
                                                            <td ><?php echo $Key['Narration']; ?></td>
                                                            <td ><?php echo $Key['LoginName']; ?></td>
                                                            <td > 
                                                            <button  data-value=<?php echo $Key['ProjectHID'] ?> data-toggle="modal" data-target="#exampleModalEdit" class="btn btn-primary btn-sm btn-edit"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                                            <button  data-value=<?php echo $Key['ProjectHID'] ?> data-toggle="modal" data-target="#ModelDeletePro" class="btn btn-primary btn-sm btn-delete"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                                                 
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
$(document).ready( function() {
    var now = new Date();
    var month = (now.getMonth() + 1);               
    var day = now.getDate();
    if (month < 10) 
        month = "0" + month;
    if (day < 10) 
        day = "0" + day;
    var today = now.getFullYear() + '-' + month + '-' + day;
    console.log(today);
    $('#datePicker').val(today);
});

</script>

<script>
$(document).ready(function(){
        $('#data').after('<br><div id="nav" class="pagination"></div>');
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

        $('.btn-delete').click(function(e){
            llid = $(this).attr('data-value')
      postData = {
        llid
      }
      console.log(postData); 
      $('.btn-confirm').click(function(e){
    url = '<?php echo base_url('Project/deletePro') ?>'
      
    $.post(url,postData,
  function(data, status){
    window.location.reload();  
    
  });

      
    })
});


$('.btn-edit').click(function(e){
    
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      url = '<?php echo base_url('Project/getProject') ?>'
      
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
    console.log(returnedData[0]);
    var sDate = returnedData[0].StartDate;
    var resSD = sDate.slice(0, 2);
    var resSM= sDate.slice(3, 5);
    var resSY= sDate.slice(6, 10);

    var todayS = resSY + '-' + resSM + '-' + resSD;

    var eDate = returnedData[0].CompDate;
    var resED = eDate.slice(0, 2);
    var resEM= eDate.slice(3, 5);
    var resEY= eDate.slice(6, 10);

    var todayE = resEY + '-' + resEM + '-' + resED;
 


    console.log(todayE);
    $("#project-Hid").val(returnedData[0].ProjectHID);
    $("#project-name").val(returnedData[0].ProjectName);
    $("#project-sdate").val(todayS);
    $("#project-cdate").val(todayE);
    $("#dept-id").val(returnedData[0].DeptID);
    $("#project-narration").text(returnedData[0].Narration);
    if(returnedData[0].CompStatus == 1){
        $('#project-status').attr('Checked','Checked');
    //$("").checked = true;
}
else{
    $('#project-status').removeAttr('Checked');
}

    var newOption = $('<option>');
    newOption.attr('value', returnedData[0].LocalCustID).text(returnedData[0].CustName);

    // Append that to the DropDownList.
    $('#dept-id').append(newOption);

    // Select the Option.
    $("#dept-id > [value=" + returnedData[0].LocalCustID + "]").attr("selected", "true");
  
}); 


})


    });
</script>
<script>
function getComboA(selectObject) {
  var idofPro = selectObject.value;  
 // console.log(value);
 postData = {
    idofPro
  }
  console.log(postData.idofPro);
  url = '<?php echo base_url('Project/getDependent') ?>'
  
  $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
   console.log(returnedData);
 
   dataaa = returnedData;
   options = "<option value=''>Select Department Name  </option>"
     for (i = 0; i < dataaa.length; i++) {
     options +=  '<option value="' + dataaa[i].LocalCustID + '">' + dataaa[i].CustName + '</option>'
         }
        $("#materialDep").html(options)


  }); 
  
}
  function getComboB(selectObject) {
  var idofPro = selectObject.value;  
 // console.log(value);
 postData = {
    idofPro
  }
  console.log(postData.idofPro + "B is called");
  url = '<?php echo base_url('Project/getDependent') ?>'
  
  $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
   console.log(returnedData);
 
   dataaa = returnedData;
   options = "<option value=''>Select Department Name  </option>"
     for (i = 0; i < dataaa.length; i++) {
     options +=  '<option value="' + dataaa[i].LocalCustID + '">' + dataaa[i].CustName + '</option>'
         }
        $("#MatDName").html(options)


  }); 
  
}
</script>

<script>
    $('.mySelect2').select2(
        {
  dropdownParent: $('#ModalDepartmentForm')
}
    );
    
    $('.mySelectProD').select2(
        {
  dropdownParent: $('#ModalProjectForm')
}
    );

    
    $('.mySelectMatPro').select2(
        {
  dropdownParent: $('#ModalMaterialForm')
}
    );

    $('.mySelectProDEdit').select2(
        {
  dropdownParent: $('#exampleModalEdit')
}
    );
    

    $('.mySelect2Edit').select2(
        {
  dropdownParent: $('#exampleModalEditDep')
}
    );
     
    $('.mySelectMatProEdit').select2(
        {
  dropdownParent: $('#exampleModalEditMat')
});

    
    
</script>

</body>
</html>
<?php

}

?>