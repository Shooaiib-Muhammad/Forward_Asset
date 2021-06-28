

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
                <h1 class="modal-title">Add Asset Original Life</h1>
            </div>
            <div class="modal-body">
                <form name="form" id="myForm" method="POST" action="">
                    <!-- <input type="hidden" name="_token" value=""> -->
                    <div class="form-group" style="display:none;">
                        <label class="control-label">ID</label>
                        <div>
                            <input type="text" class="form-control input-lg" id="project-bid"  name="oid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Original Life</label>
                        <div>
                            <input type="text" class="form-control input-lg" name="NameLife" placeholder="Enter Original Life">
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
                                    <input type="checkbox" name="Status"> Status
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                        <button type="submit" class="btn btn-success" id="saveButtonOriginal" >Save</button>
                        <button type="submit" class="btn btn-success" id="updateButtonOriginal" style="display:none" >Update</button>   

                            <button class="btn btn-success" data-dismiss="modal">Close</button>
                          

                           <!--  <a class="btn btn-link" href="">Forgot Your Password?</a> -->
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
        <h5 class="modal-title" id="exampleModalCenterTitle">Delete Original Life Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete detail of project? (This process is irreversible)
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-primary btn-confirm-del-original">Yes</button>
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
                                        <i class='fal fa fa-table text-primary'></i>&nbsp;&nbsp;Assets Original Life Records 
                                        </h2>
                                        <button type="button" class="btn btn-primary" style="float:right;" data-toggle="modal" data-target="#ModalLoginForm" class="d-grid gap-2 d-md-block" id="createOriginal">+ Create</button>
                                        <div class="panel-toolbar">
                                            <button class="btn btn-panel" data-action="panel-collapse" data-toggle="tooltip" data-offset="0,10" data-original-title="Collapse"></button>
                                    <!--         <button class="btn btn-panel" data-action="panel-fullscreen" data-toggle="tooltip" data-offset="0,10" data-original-title="Fullscreen"></button>
                                            <button class="btn btn-panel" data-action="panel-close" data-toggle="tooltip" data-offset="0,10" data-original-title="Close"></button> -->
                                        </div>
                                    </div>
                                    <div class="panel-container show">
                                        <div class="panel-content">
                                            <!-- div class="panel-tag">
                                                Make table responsive with <code>.table-responsive</code>. Maximum breakpoint can be applied by adding <code>.table-responsive-sm</code>, <code>.table-responsive-ms</code>, <code>.table-responsive-lg</code>, <code>.table-responsive-xl</code>
                                            </div> -->
                                            <div class="table-responsive-lg">
                        
                                                <table class="table table-striped table-hover table-sm" id="tableExport">
                                                        <thead>
                                                            <tr>
                                                                <th>Original Life</th>
                                                                <th>Status</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        <?php
                                            if (isset($Life)) {
                                                foreach ($Life as $Key) {
                                                
                                            ?>

                                            <tr>
                                                <td ><?php echo $Key['OriginalLife']; ?></td>
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
                                                <button  data-value=<?php echo $Key['ID'] ?> data-toggle="modal" data-target="#ModalLoginForm" class="btn btn-primary btn-sm btn-edit-original"><i class="fa fa-pencil-square-o"  style="font-size:20px;"></i> </button>&nbsp;&nbsp;
                                                <button  data-value=<?php echo $Key['ID'] ?> data-toggle="modal" data-target="#ModelDeleteloc" class="btn btn-primary btn-sm btn-delete"><i class="fa fa-trash"  style="font-size:20px;"></i></button>
                                    
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



$('#tableExport').on('click',".btn-delete",function(e){

llid = $(this).attr('data-value')
postData = {
llid
}
console.log(llid); 
$('.btn-confirm-del-original').click(function(e){
url = '<?php echo base_url('AssetsOriginalLife/deleteOriginalLife') ?>'

$.post(url,postData,
function(data, status){
window.location.reload();  

});


})
}); 


$('#createOriginal').click(function(e){
    $("#saveButtonOriginal").css("display", "inline-block");
    $("#updateButtonOriginal").css("display", "none");
    $("#myForm").trigger("reset");
    $('form[name=form]').attr('action','<?php echo base_url('AssetsOriginalLife/AddOriginalLife') ?>');
});

$('#tableExport').on('click',".btn-edit-original",function(e){
    $("#saveButtonOriginal").css("display", "none");
    $("#updateButtonOriginal").css("display", "inline-block");
    $('form[name=form]').attr('action','<?php echo base_url('AssetsOriginalLife/EditOriginalLife') ?>');
        var formData =[];
            llid = $(this).attr('data-value');
      postData = {
        llid
      }
      url = '<?php echo base_url('AssetsOriginalLife/getOriginalLife') ?>'
      
    $.post(url,postData,
  function(data, status){
    var returnedData = JSON.parse(data);
    console.log(returnedData[0]);
    $("input[name=NameLife]").val(returnedData[0].OriginalLife);
    if(returnedData[0].Status == 1){
        $("input[type=checkbox").prop('checked', true);
    }
    else{
        $("input[type=checkbox").prop('checked', false);
    }
    $("input[name=oid]").val(returnedData[0].ID);

  
 }); 

});


    });
</script>
    </body>
</html>
<?php

}

?>