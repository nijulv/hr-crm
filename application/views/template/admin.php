<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CopierChoice|Admin-Panel</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="images/icons/favicon.ico">
        <link rel="apple-touch-icon" href="images/icons/favicon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/icons/favicon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/icons/favicon-114x114.png">
        <!--Loading bootstrap css-->
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,700">
        <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,700,300">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/jquery-ui-1.10.4.custom.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/animate.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/all.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/main.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/style-responsive.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/zabuto_calendar.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/pace.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>styles/jquery.news-ticker.css">
        <link type="text/css" rel="stylesheet" href="<?php echo assets_url(); ?>css/datepicker.css">
        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
            var admin_url = "<?php echo admin_url(); ?>";
            var assets_url = "<?php echo assets_url(); ?>";
        </script>
    </head>
    <body>

        <?php
        $suppler_notification = '';
        $enquiry_notification = '';
        $enquiry_notification_LS = '';
        $suppler_count = load_notification_count($type = 'suppler');
        $enquiry_count = load_notification_count($type = 'enquiries');
        $enquiry_count_ls = load_notification_count($type = 'enquiries_ls');

        if ($suppler_count) {
            $suppler_notification = $suppler_count['count'];
        }
        if ($enquiry_count) {
            $enquiry_notification = $enquiry_count['count'];
        }
        if ($enquiry_count_ls) {
            $enquiry_notification_LS = $enquiry_count_ls['count'];
        }
        ?>
        <div>
            <!--END THEME SETTING-->
            <!--BEGIN BACK TO TOP-->
            <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
            <!--END BACK TO TOP-->
            <!--BEGIN TOPBAR-->
            <div id="header-topbar-option-demo" class="page-header-topbar">
                <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3" class="navbar navbar-default navbar-static-top">
                    <div class="navbar-header">
                        <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>

                        <a id="logo" href="/admin" class="navbar-brand"><span class="fa fa-rocket"></span><span class="logo-text">CC/L2S Admin</span><span style="display: none" class="logo-text-icon">µ</span></a></div>
                    <div class="topbar-main">
                        <!--<a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>-->

                        <form id="topbar-search" action="" method="" class="hidden-sm hidden-xs">
                            <div class="input-icon right text-white" style = "display:none;"><a href="#"><i class="fa fa-search"></i></a><input type="text" placeholder="Search here..." class="form-control text-white"/></div>
                        </form>

                        <ul class="nav navbar navbar-top-links navbar-right mbn">
                            <li class="dropdown topbar-user">
                                <a data-hover="dropdown" href="#" class="dropdown-toggle">
                                    <img src="<?php echo assets_url(); ?>images/avatar/48.png" alt="" class="img-responsive img-circle"/>&nbsp;
                                    <span class="hidden-xs"><?php echo s('ADMIN_NAME') ?></span>&nbsp;<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-user pull-right">
                                    <li><a href="<?php echo admin_url() ?>myprofile"><i class="fa fa-user"></i>My Profile</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo admin_url() ?>changepassword"><i class="fa fa-key"></i>Change Password</a></li>
                                    <li class="divider"></li>
                                    <li><a href="<?php echo admin_url(); ?>logout"><i class="fa fa-power-off"></i>Log Out</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>
            <!--END TOPBAR-->
            <div id="wrapper">
                <!--BEGIN SIDEBAR MENU-->
                <nav id="sidebar" role="navigation" data-step="2" data-intro="" data-position="right" class="navbar-default navbar-static-side">
                    <div class="sidebar-collapse menu-scroll">
                        <ul id="side-menu" class="nav">
                            <div class="clearfix"></div>
                            <li class="">
                                <a href="<?php echo admin_url(); ?>dashboard">
                                    <i class="fa fa-tachometer fa-fw"><div class="icon-bg bg-orange"></div></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>                                                       
                            <li>
                                <a href="javascript:;" id = "contentmanage">
                                    <i class="fa fa-desktop fa-fw"><div class="icon-bg bg-pink"></div></i>
                                    <span class="menu-title">CMS</span><span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" id = "contentmanagelist">
                                    <li><a href="<?php echo admin_url(); ?>about">About Us (CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>articles">Articles (CC)</a></li>
                                    <!-- <li><a href="<?php echo admin_url(); ?>resources">Resources (CC)</a></li> -->
                                    <li><a href="<?php echo admin_url(); ?>sellcopier">Sell Your Copier (CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>landingpages">Landing Pages(CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>webpages">Dynamic Pages(CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>webpagesleads2sale">Dynamic Pages(LS)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>leadcoveragearea">Lead Coverage Area(LS)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>leadspagecontents">Page Contents(LS/CC)</a></li>
                                </ul> 
                            </li>
                            <li>
                                <a href="#" id = "masterinfo">
                                    <i class="fa fa-info-circle fa-fw"><div class="icon-bg bg-pink"></div></i>
                                    <span class="menu-title">Master Info</span><span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" id = "masterinfolist">
                                    <li><a href="<?php echo admin_url(); ?>categories">Categories (CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>manageproduct">Popular Products(CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>makers">Manage Makers/Brands</a></li>
                                    <li><a href="<?php echo admin_url(); ?>managebuyerguide">Buyer Guide</a></li>
                                    <li><a href="<?php echo admin_url(); ?>packages">Package(LS)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>manageindustry">Industries(LS)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>managepostcode">Manage Suburb/Postcode</a></li>
                                </ul> 
                            </li>
                            <li>
                                <a href="#" id = "banners">
                                    <i class="fa fa-image fa-fw"><div class="icon-bg bg-pink"></div></i>
                                    <span class="menu-title">Banners</span><span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" id = "bannerslist">
                                    <li><a href="<?php echo admin_url(); ?>bannersettings"> Banners(CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>leadscarousalsettings"> Banners(LS)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>sellcopierbannersettings"> Sell Your Copier Banners(CC)</a></li>
                                </ul> 
                            </li>
                            <li>
                                <a href="#" id = "promocode">
                                    <i class="fa fa-tags fa-fw"><div class="icon-bg bg-pink"></div></i>
                                    <span class="menu-title">Promocode</span><span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" id = "promocodelist">
                                    <li><a href="<?php echo admin_url(); ?>promotionslinks"> Promotions Links(CC)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>promocodesettings"> Promocode(LS)</a></li>
                                </ul> 
                            </li>
                            <!-- <li>
                                <a href="#" id = "users">
                                    <i class="fa fa-users fa-fw"><div class="icon-bg bg-pink"></div></i>
                                    <span class="menu-title">Users</span><span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" id = "userslist">
                                    <li><a href="<?php echo admin_url(); ?>users"> Suppliers</a></li>
                                    <li><a href="<?php echo admin_url(); ?>leads">Leads</a></li>
                                    <li><a href="<?php echo admin_url(); ?>dropoutleads"> Drop-Out Leads</a></li>
                                </ul> 
                            </li> -->
                            <li>
                                <a href="<?php echo admin_url(); ?>managerefund"><i class="fa fa-gift"><div class="icon-bg bg-green"></div></i>
                                    <span class="menu-title">Manage Refund</span></a>
                            </li>
                            <li>
                                <a href="#" id = "settings">
                                    <i class="fa fa-cogs fa-fw"><div class="icon-bg bg-pink"></div></i>
                                    <span class="menu-title">Settings</span><span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" id = "settingslist">
                                    <li><a href="<?php echo admin_url(); ?>emailsettings"> Emails</a></li>
                                    <li><a href="<?php echo admin_url(); ?>emailalertsettings"> Email Alert</a></li>
                                    <li><a href="<?php echo admin_url(); ?>socialmediasettings">Social Media</a></li>
                                    <li><a href="<?php echo admin_url(); ?>adminsettings">General Settings(Variables)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>leadpricesettings">Lead Pricing</a></li>
                                    <li><a href="<?php echo admin_url(); ?>devicepricesettings">Device Pricing</a></li>
                                    <li><a href="<?php echo admin_url(); ?>rotatingbannerpackages">Rotating Banner Packages(LS)</a></li>
                                    <li><a href="<?php echo admin_url(); ?>reductionpercentagelist">Star Reduction</a></li>
                                </ul> 
                            </li>
                            <li>
                                <a href="javascript:;" id = "report">
                                    <i class="fa fa-bar-chart-o fa-fw"><div class="icon-bg bg-yellow"></div></i>
                                    <span class="menu-title">Reports</span><span class="fa arrow"></span>
                                </a>
                                <ul class="nav nav-second-level collapse" id = "reportlist"> 
                                    <li><a href="<?php echo admin_url(); ?>users">Suppliers</a></li>
                                    <li><a href="<?php echo admin_url(); ?>leads">Leads Report</a></li>
                                    <li><a href="<?php echo admin_url(); ?>dropoutleads"> Drop-Out Leads</a></li>
                                    <li><a href="<?php echo admin_url(); ?>sellyourcopier">"Sell Your Copier" Leads</a></li>
                                    <li><a href="<?php echo admin_url(); ?>preregistrationlist">Pre-Registration(LS)</a></li> 
                                    <li><a href="<?php echo admin_url(); ?>paymentreports"> Transaction Report</a></li>
                                    <li><a href="<?php echo admin_url(); ?>credithistory">Sales Report</a></li>
                                    <li><a href="<?php echo admin_url(); ?>leadmatchhistory">Lead Match History</a></li>
                                    <li><a href="<?php echo admin_url(); ?>feedbackreports"> Feedback</a></li>
                                    <li><a href="<?php echo admin_url(); ?>supplierrequests">Suppliers Requests(From CC) <?php if($suppler_notification != 0) { echo '(<b>'.$suppler_notification.'</b>)'; }?></a></li>           
                                    <li><a href="<?php echo admin_url(); ?>enquiries">Enquiries (CC) <?php if($enquiry_notification != 0) { echo '(<b>'.$enquiry_notification.'</b>)'; }?></a></li>
                                    <li><a href="<?php echo admin_url(); ?>enquiriesleadsales">Enquiries (LS) <?php if($enquiry_notification_LS != 0) { echo '(<b>'.$enquiry_notification_LS.'</b>)'; }?></a></li>
                                    <li><a href="<?php echo admin_url(); ?>rotatingbannerreport"> Banner Statistics</a></li>
                                    <li><a href="<?php echo admin_url(); ?>buyerguidereport"> Buyer Guide Survey Report</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!--END SIDEBAR MENU-->

                <!--BEGIN PAGE WRAPPER-->
                <div id="page-wrapper">       

                    <!--BEGIN TITLE & BREADCRUMB PAGE-->
                    <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                        <div class="page-header pull-left">
                            <div class="page-title"><?php echo $page_heading; ?></div>
                        </div>
                        <ol class="breadcrumb page-breadcrumb pull-right">
                            <li><i class="fa fa-home"></i>&nbsp;<a href="dashboard">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                            <li class="hidden"><a href="#"><?php echo $page_heading; ?></a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                            <li class="active"><?php echo $page_heading; ?></li>
                        </ol>
                        <div class="clearfix">
                        </div>
                    </div>
                    <!--END TITLE & BREADCRUMB PAGE-->

                    <!--BEGIN CONTENT-->
                    <div class="page-content">
<?php echo $content; ?> 
                    </div>
                    <!--END CONTENT-->

                    <!--BEGIN FOOTER-->
                    <div id="footer">
                        <div class="copyright">
                            <a href="#"><?php echo date("Y"); ?> © CopierChoice</a></div>
                    </div>
                    <!--END FOOTER-->
                </div>
                <!--END PAGE WRAPPER-->
            </div>  

        </div>   

        <script src="<?php echo assets_url(); ?>script/jquery-1.10.2.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery-ui.js"></script>
        <script src="<?php echo assets_url(); ?>script/bootstrap.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/bootstrap-hover-dropdown.js"></script>
        <script src="<?php echo assets_url(); ?>script/html5shiv.js"></script>
        <script src="<?php echo assets_url(); ?>script/respond.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.metisMenu.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.slimscroll.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.cookie.js"></script>
        <script src="<?php echo assets_url(); ?>script/icheck.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/custom.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.news-ticker.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.menu.js"></script>
        <script src="<?php echo assets_url(); ?>script/pace.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/holder.js"></script>
        <script src="<?php echo assets_url(); ?>script/responsive-tabs.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.categories.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.pie.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.tooltip.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.resize.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.fillbetween.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.stack.js"></script>
        <script src="<?php echo assets_url(); ?>script/jquery.flot.spline.js"></script>
        <script src="<?php echo assets_url(); ?>script/zabuto_calendar.min.js"></script>
        <script src="<?php echo assets_url(); ?>script/index.js"></script>
        <!--LOADING SCRIPTS FOR CHARTS-->
        <script src="<?php echo assets_url(); ?>script/highcharts.js"></script>
        <script src="<?php echo assets_url(); ?>script/data.js"></script>
        <script src="<?php echo assets_url(); ?>script/drilldown.js"></script>
        <script src="<?php echo assets_url(); ?>script/exporting.js"></script>
        <script src="<?php echo assets_url(); ?>script/highcharts-more.js"></script>
        <script src="<?php echo assets_url(); ?>script/charts-highchart-pie.js"></script>
        <script src="<?php echo assets_url(); ?>script/charts-highchart-more.js"></script>
        <!--CORE JAVASCRIPT-->
        <script src="<?php echo assets_url(); ?>script/main.js"></script>  


        <script src="<?php echo assets_url(); ?>js/bootstrap-datepicker.js"></script>
        <script src="<?php echo assets_url(); ?>script/admin.js"></script>

        <script src="<?php echo assets_url(); ?>js/jscolor.js"></script>
        <script src="<?php echo assets_url(); ?>js/jscolor.min.js"></script>

<?php
// <script src="//cdn.ckeditor.com/4.4.2/basic/ckeditor.js"></script> 
//<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
//<script>tinymce.init({ selector:'textarea' });</script>     
?>

        <script src="//cdn.ckeditor.com/4.5.6/full/ckeditor.js"></script> 


        <script src="<?php echo assets_url() ?>js/tinymcenew/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
        tinymce.init({
            mode: "textareas",
            theme: "modern", width: 1000, height: 600,
            editor_selector: "mceEditor",
            editor_deselector: "mceNoEditor",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking",
                "table contextmenu directionality emoticons paste textcolor responsivefilemanager code"
            ],
            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent |fontselect fontsizeselect styleselect",
            toolbar2: "| responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code  ",
            image_advtab: true,
            external_filemanager_path: "<?php echo assets_url() ?>js/filemanager/filemanager/",
            filemanager_title: "Responsive Filemanager",
            external_plugins: {"filemanager": "<?php echo assets_url() ?>js/filemanager/filemanager/plugin.min.js"}
        });
        </script>

        <script>
            //leftmenu show - hide
            $("#contentmanage").click(function () {
                $("#contentmanagelist").fadeToggle();
            });
            $("#report").click(function () {
                $("#reportlist").fadeToggle();
            });
            $("#admin").click(function () {
                $("#adminlist").fadeToggle();
            });
            $("#masterinfo").click(function () {
                $("#masterinfolist").fadeToggle();
            });
            $("#banners").click(function () {
                $("#bannerslist").fadeToggle();
            });
            $("#promocode").click(function () {
                $("#promocodelist").fadeToggle();
            });
            $("#users").click(function () {
                $("#userslist").fadeToggle();
            });
            $("#settings").click(function () {
                $("#settingslist").fadeToggle();
            });
            // Suburb auto complete 
            $(".suburb").keyup(function () {
                var id = $(this).attr("id");
                var type = $(this).attr("table-type");  //alert(type); 
                if (this.value.length > 0) {
                    $.ajax({
                        type: "POST",
                        url: base_url + "lead_suburb_search",
                        data: {'keyword': $(this).val(), 'selector': id, 'tabletype': type},
                        beforeSend: function () {
                            $(".suburb").css("background", "#FFF url(" + assets_url + "images/LoaderIcon.gif) no-repeat 165px");
                        },
                        success: function (data) {
                            $(".suggesstion-box-suburb").show();
                            $(".suggesstion-box-suburb").html(data);
                            $(".suburb").css("background", "#FFF");
                        }
                    });
                }
                else {
                    $(".suggesstion-box-suburb").hide();
                }
            });

            function selectsuburb_search(val, selector) {
                $("#" + selector).val(val);
                $(".suggesstion-box-suburb").hide();
            }

            $("#has_carousal_yes").click(function () {
                $("#carousal_images_div").show();
            });
            $("#has_carousal_no").click(function () {
                $("#carousal_images_div").hide();
            });

        </script>
        <!-- MENU HIGHLIGHTER -->
        <script>
            var strarr = window.top.location.href;
            var loc = strarr.split("/").reverse();

            if (loc[0]) {
                //console.log("loc: "+loc);			
                //console.log("loc[0]: "+loc[0]);	
//                            /console.log("[href='" + admin_url+loc[0].split("?")[0] + "']");
                $("[href='" + admin_url + loc[0].split("?")[0] + "']").parents().removeClass("collapse");
                $("[href='" + admin_url + loc[0].split("?")[0] + "']").addClass("active-menu");
            }
            else {
                $("[href='" + admin_url + "dashboard" + "']").parents("li").addClass("active");
            }
        </script>

    </body>
</html>

<style>
    .modal-dialog{
        width: 95% !important;
    }
</style>
<!-- Pop up common model -->
<div id="moreDetails" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" data-dismiss="modal" aria-hidden="true" class="close">
                    &times;</button>
                <h4 class="modal-title" id="data-title"> </h4>
            </div>

            <div class="modal-body" id="data-output">
                <div align="center">
                    <i class="fa fa-refresh fa-spin" style="font-size: 48px;"></i>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-default">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Pop up common model -->
