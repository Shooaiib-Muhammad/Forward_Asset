

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
                            <?php
                            if($this->session->flashdata('ProDelDepinfo')){ 
    
    
    ?>
  <div class="alert alert-danger alert-dismissible show fade" id="msgbox">
                  <div class="alert-body">
                    <button class="close" data-dismiss="alert">
                      <span>&times;</span>
                    </button>
                    <?php echo $this->session->flashdata('ProDelDepinfo');?>
                  </div>
                </div>
                <?php
    }

                ?>


                        <div>
                          <div>
                            
    <!-------------------------------------------------------------- Popup Forms Section -------------------------------------------------------------------------> 

<!-- Modal -->
<div class="modal fade" id="ModelDeleteMat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Department Detail</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-Mat">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>


<!-- Modal HTML Markup -->
<div id="exampleModalEditMat" class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" >
    <div  class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Material</h1>
            </div>
            <div class="modal-body">
            <form role="form" name="MatForm" id="myForm" method="POST" action="<?php echo base_url('Material/AddMaterials') ?>">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="row">

                    <div class="form-group" style="display:none;">
                        <label class="control-label">Project D ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-Did"  name="projectDDID">
                        </div>
                    </div>


                    <div class="form-group col-md-6">
                      <label >Project Name </label>
                      <div>
                        <select class="form-control mySelectMatProEdit" id="MatPName" name="materialEProName" data-live-search="true" searchable="Search here.." onchange="getComboB(this)" style="width: 100%">
                        <option value="">Select one of the following</option>
                        <?php
                                        if (isset($ProValues)) {
                                            foreach ($ProValues as $Key) {
                                               
                                        ?>
                       <option value="<?php echo $Key['ProjectHID']; ?>"><?php echo $Key['ProjectName']; ?></option>
                        <?php
                                            }
}
?>
                            </select>
                     </div>
                 </div> 


                    <div class="form-group col-md-6">
                      <label >Department Name </label>
                      <div>
                        <select class="form-control mySelectMatProEdit" id="MatDName" name="materialEDepName" data-live-search="true" searchable="Search here.." style="width: 100%" required>
                        <option value="">Select one of the following</option>
                            </select>
                     </div>
                 </div> 

                 <div class="form-group col-md-6">
                      <label >Material Name </label>
                      <div>
                        <select class="form-control mySelectMatProEdit" id="MateName" name="materialEName" data-live-search="true" searchable="Search here.." style="width: 100%">
                        <option value="" >Select one of the following</option>
                        <?php
                                        if (isset($MaterialValues)) {
                                            foreach ($MaterialValues as $Key) {
                                               
                                        ?>
                       <option value="<?php echo $Key['Code']; ?>"><?php echo $Key['L4Name']; ?></option>
                        <?php
                                            }
}
?>
                     
                            </select>
                     </div>
                 </div> 


                
                 
                   


                    <div class="form-group col-md-6">
                        <label class="control-label">Quantity</label>
                        <div>
                            <input type="number" id="MateQty" class="form-control input-lg" name="materialEQty" placeholder="Enter Material Quantity" >
                        </div>
                    </div> 
                    
                    <div class="form-group col-md-6">
                      <label >UOM</label>
                      <div>
                        <select class="form-control mySelectMatProEdit" id="MateUom" name="materialEUom" data-live-search="true" searchable="Search here.." style="width: 100%">
                        <option value="" >Select one of the following</option>
                        
                        <?php
                                        if (isset($Uom)) {
                                            foreach ($Uom as $Key) {
                                               
                                        ?>
                       <option value="<?php echo $Key['UOM']; ?>"><?php echo $Key['UOM']; ?></option>
                        <?php
                                            }
}
?>
                            </select>
                     </div>
                 </div> 
                 </div>

                 <div class="form-group ">
                        <label class="control-label">Narration</label>
                        <div>
                        <textarea id="MateNarra" name="MatENarration" rows="5" cols="70" placeholder="Enter Narration"></textarea>
                        </div>
                    </div>
                  <br><br>
                    
                    <div class="form-group">
                        <div>
                        <button id="button-save" type="submit" class="btn btn-success">Save</button>
                        <button id="button-edit" type="submit" class="btn btn-success" style="display:none">Update</button>
                            <input type = "reset" class="bg-secondary text-white btn-sm" id="btnClear" />

                            <button class="btn btn-success" id="button-close">Close</button>
                          
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
                                        <i class='fal fa fa-table text-primary'></i>&nbsp;&nbsp;Material Data Records 
                                        </h2>
                                    
                            <button type="button" class="btn btn-primary" style="float:right;" id="addMater" data-toggle="modal" class="d-grid gap-2 d-md-block float-right" data-target=".bd-example-modal-xl" data-backdrop="static" data-keyboard="false">+ Create</button>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <!--         <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                
               
                  
                            <div class="table-responsive">
                                            <table class="table table-striped table-hover table-sm" id="tableExport2">
                                                    <thead>
                                                        <tr>
                                                        <th>Project</th>
                                                        <th>Department</th>
                                                        <th>Material</th>
                                                        <th>Quantity</th>
                                                        <th>UOM</th>
                                                        <th>Narration</th>
                                                        <th>UserID</th>
                                                        <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                        if (isset($MatData)) {
                                            //print_r($MidValues);
                                           
                                            foreach ($MatData as $Key) {
                                               
                                        ?>
                                                        <tr>
                                                        <td><?php echo $Key['ProjectName']; ?></td>
                                                            <td><?php echo $Key['CustName']; ?></td>
                                                            <td><?php echo $Key['L4Name']; ?></td>
                                                            <td><?php echo $Key['Qty']; ?></td>
                                                            <td><?php echo $Key['UOM']; ?></td>
                                                            <td><?php echo $Key['Narration']; ?></td>
                                                            <td><?php echo $Key['LoginName']; ?></td>
                                                            <td > 
                                                            <button  data-value=<?php echo $Key['ProjectDID'] ?> data-toggle="modal" data-target="#exampleModalEditMat" class="btn btn-primary btn-sm btn-edit-Mat"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                                            <button  data-value=<?php echo $Key['ProjectDID'] ?> data-toggle="modal" data-target="#ModelDeleteMat" class="btn btn-primary btn-sm btn-delete-Mat"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                                                 
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

$('#button-save').click(function(e){
  
  $("form").submit(function (event) {
    var formData = {
      materialEProName: $("#MatPName").val(),
      materialEDepName: $("#MatDName").val(),
      materialEName: $("#MateName").val(),
      materialEQty: $("#MateQty").val(),
      materialEUom: $("#MateUom").val(),
      MatENarration: $("#MateNarra").val(),
    };

    $.ajax({
      type: "POST",
      url: "<?php echo base_url('Material/AddMaterials') ?>",
      data: formData,
      dataType: "json",
      encode: true,
    }).done(function (data) {
      console.log("Added Successfully");
    });
    $("#MateQty").val("");
    $("#MateUom").attr('selected', false);
//    $("#MateUom").val([]);

      $('#MateUom').removeAttr('selected').find('option:first').attr('selected', 'true');
   //$("#MateUom").prop("selectedIndex", 0);
   // $("#MateUom option:selected").prop("selected", false);
    //$("#MateUom option:first").attr('selected','selected');
  //  $("#MateUom").find('option:selected').remove().end();
    $('#MateNarra').val('').empty();
     
    event.preventDefault();
  });
});


$('#button-close').click(function(e){
  window.location.reload();
});
        
$('#addMater').click(function(e){
     $("#button-edit").css("display","none");
    $("#button-save").css("display","inline-block");
    $("#myForm").trigger("reset");
    $('form[name=MatForm]').attr('action','<?php echo base_url('Material/AddMaterials') ?>');
        });

$('.btn-delete-Mat').click(function(e){
            llid = $(this).attr('data-value')
      postData = {
        llid
      }
      
      $('.btn-confirm-del-Mat').click(function(e){
        console.log(postData); 
    url = '<?php echo base_url('Material/deleteMat') ?>'
    $.post(url,postData,
  function(data, status){
     // console.log(data+" "+ status);
  window.location.reload();  
    
  });

      
    })
});


$('.btn-edit-Mat').click(function(e){
    
    $("#button-edit").css("display","inline-block");
    $("#button-save").css("display","none");
    
    $('form[name=MatForm]').attr('action','<?php echo base_url('Material/EditMaterials') ?>');


    var formData =[];
        llid = $(this).attr('data-value');
  postData = {
    llid
  }
  url = '<?php echo base_url('Material/getMaterial') ?>'
  
$.post(url,postData,
function(data, status){
var returnedData = JSON.parse(data);
var returnedData = JSON.parse(data);
    console.log(returnedData[0]);
 
    $("#project-Did").val(returnedData[0].ProjectDID);
    $("#MateQty").val(returnedData[0].Qty);
    $("#MateNarra").text(returnedData[0].Narration);


    url2 = '<?php echo base_url('Material/MaterialsPro') ?>'    
    $.post(url2,
function(data, status){
  var returnedData2 = JSON.parse(data);
   console.log(returnedData2);

   dataaa1 = returnedData2;
   console.log(dataaa1);
   options = "<option value='' disabled>Select Project Name  </option>"
     for (i = 0; i < dataaa1.length; i++) {
       if(returnedData[0].ProjectName == dataaa1[i].ProjectName){
        options +=  '<option value="' + dataaa1[i].ProjectHID + '" selected>' + dataaa1[i].ProjectName + '</option>'
       }
     options +=  '<option value="' + dataaa1[i].ProjectHID + '">' + dataaa1[i].ProjectName + '</option>'
         }
        $("#MatPName").html(options)

});

    /* var newOption3 = $('<option>');
    newOption3.attr('value', returnedData[0].LocalCustID).text(returnedData[0].CustName);

    // Append that to the DropDownList.
    $('#MatDName').append(newOption3);

    // Select the Option.
    $("#MatDName > [value=" + returnedData[0].ProjectHID + "]").attr("selected", "true");
 */
    var idofPro = returnedData[0].ProjectHID;  
 // console.log(value);
 postData1 = {
    idofPro
  }

  url1 = '<?php echo base_url('Material/getDependent') ?>'
  
  $.post(url1,postData1,
  function(data, status){
    var returnedData1 = JSON.parse(data);
   console.log(returnedData1);
 
   dataaa = returnedData1;
   options = "<option value='' disabled>Select Department Name  </option>"
     for (i = 0; i < dataaa.length; i++) {
       if(returnedData[0].CustName == dataaa[i].CustName){
        options +=  '<option value="' + dataaa[i].LocalCustID + '" selected>' + dataaa[i].CustName + '</option>'
       }
     options +=  '<option value="' + dataaa[i].LocalCustID + '">' + dataaa[i].CustName + '</option>'
         }
        $("#MatDName").html(options)


  }); 
 

    /* var newOption1 = $('<option>');
    newOption1.attr('value', returnedData[0].LocalCustID).text(returnedData[0].CustName);

    // Append that to the DropDownList.
    $('#MatDName').append(newOption1);

    // Select the Option.
    $("#MatDName > [value=" + returnedData[0].LocalCustID + "]").attr("selected", "true"); */


    var newOption2 = $('<option>');
    newOption2.attr('value', returnedData[0].Code).text(returnedData[0].L4Name);

    // Append that to the DropDownList.
    $('#MateName').append(newOption2);

    // Select the Option.
    $("#MateName > [value=" + returnedData[0].Code + "]").attr("selected", "true");


    var newOption3 = $('<option>');
    newOption3.attr('value', returnedData[0].UOM).text(returnedData[0].UOM);

    // Append that to the DropDownList.
    $('#MateUom').append(newOption3);

    // Select the Option.
    $("#MateUom > [value=" + returnedData[0].UOM + "]").attr("selected", "true");

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
  url = '<?php echo base_url('Material/getDependent') ?>'
  
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
  url = '<?php echo base_url('Material/getDependent') ?>'
  
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
}
    );

    
    
</script>

</body>
</html>
<?php

}

?>