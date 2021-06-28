

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
                <h1 class="modal-title">Add/Edit Assets Type </h1>
            </div>
            <div class="modal-body">
                <form name="form" id="myForm" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="tid">
                        </div>
                    </div>
              
                    <div class="form-group">
                        <label class="control-label">Asset Type</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="assetName" id="assName" placeholder="Enter Asset Name">
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
                                    <input type="checkbox" name="assetStatus"> Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveAssetType" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateAssetType" style="display:none" >Update</button>   

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                          
                 </div>
                    </div>
                </form>
       
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal Delete Asset Type -->
<div class="modal fade" id="ModelDeletetype" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Asset Type</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-type">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>


<!-- Modal Delete Asset Type -->
<div class="modal fade" id="ModelDeleteChart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Chart of Asset</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-chart">Yes</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>  
    </div>
    </div>
  </div>
</div>


<div id="ModalAss" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Add/Edit  Charts of Asset</h1>
            </div>
            <div class="modal-body">
                <form name="formChart" id="myformChart" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="cid">
                        </div>
                    </div>
                   
                     <div class="form-group">
                     <div>
                     <label for="sel1">Production Type :</label>
                        <select class="form-control" id="sel1" name="assetProdType" >
                        <option value="0" disabled>Select one of the following</option>
                        <option value="1">Production</option>
                             <option value="2">Non Production</option>
                            </select>
                        </div> 
                   </div>
                      <div class="form-group">
                     <div>
                     <label for="sel1">Asset Type :</label>
                        <select class="form-control" id="sel1" name="assetChartType" >
                        <option value="0" disabled>Select one of the following</option>
                        <?php
                                   if (isset($Assettype)) {
                                  foreach ($Assettype as $Key) {
                           
                         ?>

                        <option value="<?php echo $Key['TID'] ?>" ><?php echo $Key['AssertType'] ?></option>
                        <?php
                        }
                       }
                  ?>
    
                            </select>
                        </div> 
                   </div>
                     <div class="form-group">
                        <label class="control-label">Name :</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="assetNameChart" placeholder="Name">
                        </div>
                    </div>
             
                     <div class="form-group">
                        <label class="control-label">UOM: </label>
                        <div>
                            <input type="text" class="form-control input-lg" name="UOM" placeholder="UOM">
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
                                    <input type="checkbox" name="assetChartStatus"> Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveAssetChart" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateAssetChart" style="display:none" >Update</button>   

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
                                            Asset <span class="fw-300"><i>Catagories</i></span>
                                        </h2>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                            <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button>
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            
                                            <ul class="nav nav-pills" role="tablist">
                                                <li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#nav_pills_default-1">Asset Type</a></li>
                                                <li class="nav-item"><a class="nav-link" data-toggle="pill" href="#nav_pills_default-2">Chart of  Asset </a></li>
                                               
                                            </ul>
                                            <div class="tab-content py-3">
                                                <div class="tab-pane fade show active" id="nav_pills_default-1" role="tabpanel">
                                                     <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#ModalLoginForm" class="d-grid gap-2 d-md-block" id="createAssetType">+ Create Asset Type</button>   
                                                     <div class="table-responsive-lg">
                        
                        <table class="table table-striped table-hover table-sm" id="tableExport">
                                <thead>
                                    <tr>
                                        <th>Asset Type</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                   if (isset($Assettype)) {
                                  foreach ($Assettype as $Key) {
                           
                                    ?>

                                    <tr>
                                        <td ><?php echo $Key['AssertType']; ?></td>
                                          <?php
                                       if ($Key['status'] == 1) {
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
                                        <button  data-value=<?php echo $Key['TID'] ?> data-toggle="modal" data-target="#ModalLoginForm" class="btn btn-primary btn-sm btn-edit-asset-type"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                        <button  data-value=<?php echo $Key['TID'] ?> data-toggle="modal" data-target="#ModelDeletetype" class="btn btn-primary btn-sm btn-delete-asset-type"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                             
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
                                                     <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#ModalAss" class="d-grid gap-2 d-md-block" id="createAssetChart" >+ Create Chart of  Asset</button> 
                                                     <div class="table-responsive-lg">
                        
                        <table class="table table-striped table-hover table-sm" id="tableExport2">
                                <thead>
                                    <tr>
                                       <th>Production Type</th>
                                        <th>Asset Type</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>UOM</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php
                                   if (isset($AssetChart)) {
                                  foreach ($AssetChart as $Key) {
                           
                                    ?>

                                    <tr>
                                    <?php
                                   if ($Key['PrdType'] == 1) {
                                      ?>      
                                    <td >Production</td>
                                    <?php
                                   }
                                   else {
                                      ?> 
                                     <td >Non Production</td>
                                    <?php
                                   }
                                   ?>
                                        <td ><?php echo $Key['AssertType']; ?></td>
                                        <td ><?php echo $Key['Name']; ?></td>
                                        <td ><?php echo $Key['Code']; ?></td>
                                        <td ><?php echo $Key['UOM']; ?></td>
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
                                        <button  data-value=<?php echo $Key['ID'] ?> data-toggle="modal" data-target="#ModalAss" class="btn btn-primary btn-sm btn-edit-asset-chart"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                        <button  data-value=<?php echo $Key['ID'] ?> data-toggle="modal" data-target="#ModelDeleteChart" class="btn btn-primary btn-sm btn-delete-asset-chart"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                             
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
                                                    Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork.
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

        $('#tableExport').on('click',".btn-delete-asset-type",function(e){
            llid = $(this).attr('data-value')
      postData = {
        llid
      }
     
      $('.btn-confirm-del-type').click(function(e){
    url = '<?php echo base_url('assettype/deleteAssetType') ?>'
      
    $.post(url,postData,
  function(data, status){
    window.location.reload();  
    
  });

      
    })
});

$('#tableExport2').on('click',".btn-delete-asset-chart",function(e){
            llid = $(this).attr('data-value')
      postData = {
        llid
      }
     
      $('.btn-confirm-del-chart').click(function(e){
    url = '<?php echo base_url('assettype/deleteAssetChart') ?>'
      
    $.post(url,postData,
  function(data, status){
    window.location.reload();  
    
  });

      
    })
});


$('#createAssetType').click(function(e){
    $("#saveAssetType").css("display", "inline-block");
    $("#updateAssetType").css("display", "none");
    $("#myForm").trigger("reset");
    $('form[name=form]').attr('action','<?php echo base_url('assettype/AddAssetType') ?>');
});

$('#createAssetChart').click(function(e){
    $('select[name="assetProdType"]').val('0');
    $('select[name="assetChartType"]').val('0');
    $("#saveAssetChart").css("display", "inline-block");
    $("#updateAssetChart").css("display", "none");
    $("#myformChart").trigger("reset");
    $('select[name=assetProdType]').val('0');
    $('select[name=assetChartType]').val('0');
    $('form[name=formChart]').attr('action','<?php echo base_url('assettype/AddAssetChart') ?>');
});


$('#tableExport').on('click',".btn-edit-asset-type",function(e){
    $("#saveAssetType").css("display", "none");
    $("#updateAssetType").css("display", "inline-block");
    $('form[name=form]').attr('action','<?php echo base_url('assettype/editAssetTypes') ?>');
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      console.log(llid);
      url = '<?php echo base_url('assettype/getAssetType') ?>'
      
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
   
    $("input[name=tid]").val(returnedData[0].TID);
    $("input[name=assetName]").val(returnedData[0].AssertType);

    if(returnedData[0].status == 1){
        $('input[name=assetStatus]').attr('Checked','Checked');
    //$("").checked = true;
}
else{
    $('input[name=assetStatus]').removeAttr('Checked');
}

  
}); 


});


$('#tableExport2').on('click',".btn-edit-asset-chart",function(e){
    $("#saveAssetChart").css("display", "none");
    $("#updateAssetChart").css("display", "inline-block");
    $('form[name=formChart]').attr('action','<?php echo base_url('assettype/editAssetCharts') ?>');
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      console.log(llid);
      url = '<?php echo base_url('assettype/getChartValue') ?>'
      
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);

    $("input[name=cid]").val(returnedData[0].ID);
    if(returnedData[0].PrdType == 1){
        $('select[name="assetProdType"]').val('1')
    }
    else{
        $('select[name="assetProdType"]').val('2')
    }
    
   
    url2 = '<?php echo base_url('assettype/getAssetTypes') ?>'    
    $.post(url2,
function(data, status){
  var returnedData2 = JSON.parse(data);
   dataaa1 = returnedData2;
   console.log(returnedData[0]);
   options = "<option value='' disabled>Select Asset Category  </option>"
     for (i = 0; i < dataaa1.length; i++) {
       if(returnedData[0].AssetType == dataaa1[i].TID){
        options +=  '<option value="' + dataaa1[i].TID + '" selected>' + dataaa1[i].AssertType + '</option>'
       }else{
        options +=  '<option value="' + dataaa1[i].TID + '">' + dataaa1[i].AssertType + '</option>'
       }
     
         }
        $("select[name=assetChartType]").html(options)

});
    $("input[name=assetChartType]").val(returnedData[0].AssetType);
    $("input[name=assetNameChart]").val(returnedData[0].Name);
    $("input[name=UOM]").val(returnedData[0].UOM);

    if(returnedData[0].Status == 1){
        $('input[name=assetChartStatus]').attr('Checked','Checked');
    //$("").checked = true;
}
else{
    $('input[name=assetChartStatus]').removeAttr('Checked');
}
 
}); 


})


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


</script>  

<?php
        $this->load->view('Foter');
       ?>
</body>
</html>
<?php

}

?>