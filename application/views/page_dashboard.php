
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
                console.log(themeSettings.themeOptions);

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
                    <main id="js-page-content" role="main" class="page-content" >
                            <?php
      if($this->session->flashdata('info')){ 
    
    
      ?>
    <div class="alert alert-danger alert-dismissible show fade" id="msgbox">
                    <div class="alert-body">
                      <button class="close" data-dismiss="alert">
                        <span>&times;</span>
                      </button>
                      <?php echo $this->session->flashdata('info');?>
                    </div>
                  </div>
                  <?php
      }

                  ?>
                    <!--     <ol class="breadcrumb page-breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">SmartAdmin</a></li>
                            <li class="breadcrumb-item">Application Intel</li>
                            <li class="breadcrumb-item active">Introduction</li>
                            <li class="position-absolute pos-top pos-right d-none d-sm-block"><span class="js-get-date"></span></li>
                        </ol>
                        <div class="subheader">
                            <h1 class="subheader-title">
                                <i class='fal fa-info-circle'></i> Introduction
                                <small>
                                    A brief introduction to this WebApp
                                </small>
                            </h1>
                        </div>
                        <div class="fs-lg fw-300 p-5 bg-white border-faded rounded mb-g">
                            <h3 class="mb-g">
                                Hi Everyone,
                            </h3>
                            <p>
                                Some time ago we asked for your input, whether you were a seasoned SmartAdmin user or just peeking around the corner, and WOW, did you deliver! After reading each and everyone of your replies on the survey, we have taken each piece of praise and criticism to heart to scope out our plans for SmartAdmin. All feedback will be used to make your favorite theme that much better, but these were some of the highlights.
                            </p>
                            <p>
                                A whopping 72% of you said you were ready for a fresh new design, while SmartAdmin is and a revolutionary view on what a good bootstrap based template should be, having something new to look at can make anyone feel invigorated. And let's be honest, who doesn't like a modern update of your favorite theme! While most you are still happy with the current variations, around 50% of you have asked for vue.js support. With this framework rapidly gaining popularity it is surely one to include in the family of frameworks! And, last, but certainly not least, a very large majority of a staggering 90% wanted more plugins and regular updates.
                            </p>
                            <p>
                                SmartAdmin takes great care to ensure that valuable and popular plugins are supported as much as possible on a drop-in basis, meaning without doing heavy modifications to extend the look and feel of your favorite admin template :) . And if the plugin is in demand enough, we won't hesitate to put in the hours to support the look and feel of SmartAdmin.
                            </p>
                            <p>
                                But how you ask? Well in order to make the next version of SmartAdmin the best ever and to re-deliver on our promise of continued support and quality, we wrote the theme from the ground-up using the latest Bootstrap practises. As a result we are better able to support new frameworks as they come up and ensure that plugin support is quick and reliable. In addition we have partnered up with some of the communities best developers to ensure that our tailor made variations are of top-notch quality and follow the principles that we at SmartAdmin take to heart.
                            </p>
                            <p>
                                We're really confident that SmartAdmin 4.0 will bring back that first theme experience while still keeping the familiarity that you have grown used to. It's a brand new theme, but with all the things you love and then some. And to ensure that you our loyal customers get this experience first-hand, we will be publishing the HTML update free-of-charge as an update to your current SmartAdmin license!
                            </p>
                            <p>
                                Last but not least, we would like to thank each and everyone of you, our loyal customers, for your patience and continued support in SmartAdmin. Without you this would not have been possible!
                            </p>
                            <p>
                                Sincerely,<br>
                                The SmartAdmin Team<br>
                            </p>
                        </div>
                        <h3>
                            SmartAdmin Team
                            <small class="mb-0">We build cool things...</small>
                        </h3>
                        <div class="d-flex flex-wrap demo demo-h-spacing mt-3 mb-3">
                            <div class="rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">
                                <img src="img/demo/authors/sunny.png" alt="Sunny A." class="img-thumbnail img-responsive rounded-circle" style="width:5rem; height: 5rem;">
                                <div class="ml-2 mr-3">
                                    <h5 class="m-0">
                                        Sunny A. (UI/UX Expert)
                                        <small class="m-0 fw-300">
                                            Lead Author
                                        </small>
                                    </h5>
                                    <a href="https://twitter.com/@myplaneticket" class="text-info fs-sm" target="_blank">@myplaneticket</a> -
                                    <a href="https://wrapbootstrap.com/user/myorange" class="text-info fs-sm" target="_blank" title="Contact Sunny"><i class="fal fa-envelope"></i></a>
                                </div>
                            </div>
                            <div class="rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">
                                <img src="img/demo/authors/josh.png" alt="Jos K." class="img-thumbnail img-responsive rounded-circle" style="width:5rem; height: 5rem;">
                                <div class="ml-2 mr-3">
                                    <h5 class="m-0">
                                        Jos K. (ASP.NET Developer)
                                        <small class="m-0 fw-300">
                                            Partner &amp; Contributor
                                        </small>
                                    </h5>
                                    <a href="https://twitter.com/@atlantez" class="text-info fs-sm" target="_blank">@atlantez</a> -
                                    <a href="https://wrapbootstrap.com/user/Walapa" class="text-info fs-sm" target="_blank" title="Contact Jos"><i class="fal fa-envelope"></i></a>
                                </div>
                            </div>
                            <div class="rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">
                                <img src="img/demo/authors/jovanni.png" alt="Jovanni Lo" class="img-thumbnail img-responsive rounded-circle" style="width:5rem; height: 5rem;">
                                <div class="ml-2 mr-3">
                                    <h5 class="m-0">
                                        Jovanni L. (PHP Developer)
                                        <small class="m-0 fw-300">
                                            Partner &amp; Contributor
                                        </small>
                                    </h5>
                                    <a href="https://twitter.com/@lodev09" class="text-info fs-sm" target="_blank">@lodev09</a> -
                                    <a href="https://wrapbootstrap.com/user/lodev09" class="text-info fs-sm" target="_blank" title="Contact Jovanni"><i class="fal fa-envelope"></i></a>
                                </div>
                            </div>
                            <div class="rounded-pill bg-white shadow-sm p-2 border-faded mr-3 d-flex flex-row align-items-center justify-content-center flex-shrink-0">
                                <img src="img/demo/authors/roberto.png" alt="Jovanni Lo" class="img-thumbnail img-responsive rounded-circle" style="width:5rem; height: 5rem;">
                                <div class="ml-2 mr-3">
                                    <h5 class="m-0">
                                        Roberto R. (Rails Developer)
                                        <small class="m-0 fw-300">
                                            Partner &amp; Contributor
                                        </small>
                                    </h5>
                                    <a href="https://twitter.com/@sildur" class="text-info fs-sm" target="_blank">@sildur</a> -
                                    <a href="https://wrapbootstrap.com/user/sildur" class="text-info fs-sm" target="_blank" title="Contact Roberto"><i class="fal fa-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                        <p class="fs-lg">
                            <a href="#" class="fw-500 fs-xl">> Ready to join our dedicated team?</a><br>
                            We are always on the lookout to expand and add unique app flavors to SmartAdmin. If you think you can contribute and create your very own flavors, get in touch with us or <a href="#" target="_blank">click here to learn more</a> about our partnership program.
                        </p> -->
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

    </body>
</html>
<?php

}

?>