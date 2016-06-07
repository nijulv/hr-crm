<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>HR-CRM</title>
        <link href="<?php echo assets_url();?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo assets_url();?>css/datepicker3.css" rel="stylesheet">
        <!--<link href="css/styles.css" rel="stylesheet">-->
        <link href="<?php echo assets_url();?>css/marshall.css" rel="stylesheet">
        <link href="<?php echo assets_url();?>css/bootstrap-table.css" rel="stylesheet">
        <link href="<?php echo assets_url();?>css/styles.css" rel="stylesheet">
        <link href="<?php echo assets_url();?>css/bootstrap-datetimepicker.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo assets_url();?>fonts/font-awesome/css/font-awesome.min.css">
        <!--Icons-->
        <script src="<?php echo assets_url();?>js/lumino.glyphs.js"></script>
        
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <link rel="icon" href="<?php echo assets_url();?>images/fav.jpg" type="image/x-icon" />
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">HR-CRM <span class="label label-warning"><?php if(s('ADMIN_TYPE') == 0) {?> Admin <?php }else { ?>Agent <?php }?></span></a>
                    <ul class="user-menu" >
                        <li class="dropdown pull-right">   
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-plus" aria-hidden="true"></i> Welcome <?php if(s('ADMIN_NAME')){echo s('ADMIN_NAME');} ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url()?>edit_profile"><i class="fa fa-user" aria-hidden="true"></i>  &nbsp;My Profile</a></li>
                                <li><a href="<?php echo base_url()?>change_password"><i class="fa fa-key" aria-hidden="true"></i> &nbsp;Change Password</a></li>
                                <li><a href="<?php echo base_url()?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp;Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="logo" align="center"></div>
          
            <ul class="nav menu"> 
                <li class="<?php echo $link_dashboard;?>"><a href="<?php echo base_url()?>dashboard"><i class="fa fa-tachometer" aria-hidden="true"></i> &nbsp;&nbsp;Dashboard</a></li>
                <?php if(s('ADMIN_TYPE') == 0) {?>
                <li class="<?php echo $link_agent;?>"><a href="<?php echo base_url()?>manage_agents"><i class="fa fa-user-secret" aria-hidden="true"></i> &nbsp;&nbsp;Manage Agents</a></li>
                <?php }?>
                    <li class="<?php echo $link_user;?>"><a href="<?php echo base_url()?>manageuser"><i class="fa fa-users" aria-hidden="true"></i> &nbsp;&nbsp;Manage Client/Prospect</a></li>
                    <li class="<?php echo $link_payment;?>"><a href="<?php echo base_url()?>manage_payment"><i class="fa fa-money" aria-hidden="true"></i> &nbsp;&nbsp;Manage Collection</a></li>
                    <li class = "<?php echo $link_bank;?>"><a href="<?php echo base_url()?>manage_cash"><i class="fa fa-university" aria-hidden="true"></i> &nbsp;&nbsp;Manage Bank Payment </a></li>
               
                <li>
                    <a href="javascript:;" id = "report">
                        <i class="fa fa-bar-chart-o fa-fw"><div class="icon-bg bg-yellow"></div></i>
                        <span class="menu-title">&nbsp;&nbsp;Reports</span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse" id = "reportlist"> 
                         <?php if(s('ADMIN_TYPE') == 0) {?>
                            <li class = "<?php echo $agent_report;?>"><a href="<?php echo base_url(); ?>agent_reports">Agent</a></li>
                         <?php }?>
                        <li class = "<?php echo $user_report;?>"><a href="<?php echo base_url(); ?>user_reports">Client/Prospect</a></li>
                        <li class = "<?php echo $payment_report;?>"><a href="<?php echo base_url(); ?>payment_reports">Collection</a></li>
                    </ul>
                </li>
                
                <li role="presentation" class="divider"></li>
                <li><a href="<?php echo base_url()?>logout"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp;&nbsp;Logout</a></li>
            </ul>
        </div><!--/.sidebar-->
            <?php
                //contents goes here
                echo $content;
            ?>
        <script type="text/javascript">
            var data1 = [100, 120, 55, 665, 150, 200, 500];
            var data2 = [150, 170, 105, 165, 200, 250, 550];
        </script>
        <script src="<?php echo assets_url();?>js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo assets_url();?>js/bootstrap.min.js"></script>
        <script src="<?php echo assets_url();?>js/chart.min.js"></script>
        <script src="<?php echo assets_url();?>js/chart-data.js"></script>
        <script src="<?php echo assets_url();?>js/easypiechart.js"></script>
        <script src="<?php echo assets_url();?>js/easypiechart-data.js"></script>
        <script src="<?php echo assets_url();?>js/bootstrap-datepicker.js"></script>
        <script> var base_url = '<?php echo base_url(); ?>'; </script>
        <script> var assets_url = '<?php echo assets_url(); ?>'; </script>
        <script src="<?php echo assets_url();?>jquery-validation/js/jquery.validate.min.js"></script>
        <script src="<?php echo assets_url();?>js/moment-with-locales.js"></script>
        <script src="<?php echo assets_url();?>js/bootstrap-datetimepicker.js"></script>
        
        <script src="<?php echo assets_url();?>js/manageuser.js"></script>
        <script src="<?php echo assets_url();?>js/managepayments.js"></script>
        <script src="<?php echo assets_url();?>js/manageagent.js"></script>
        <script src="<?php echo assets_url();?>js/manageprofile.js"></script>
        <script src="<?php echo assets_url();?>js/managepayments.js"></script>
        <script src="<?php echo assets_url();?>js/managebankdetails.js"></script>
        <script src="<?php echo assets_url();?>js/bootstrap-table.js"></script>
        <script src="<?php echo assets_url();?>js/bootbox.min.js"></script>
        
        <script>
             $("#report").click(function () {
                $("#reportlist").fadeToggle();
            });
            <?php if($reports == 1){?>
            
                $( "#report" ).trigger( "click" );
            <?php }?>
        </script>   
        
        <script>
            
            $('#calendar').datepicker({});

            !function ($) {
                $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                    $(this).find('em:first').toggleClass("glyphicon-minus");
                });
                $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
            }(window.jQuery);

            $(window).on('resize', function () {
                if ($(window).width() > 768)
                    $('#sidebar-collapse').collapse('show')
            })
            $(window).on('resize', function () {
                if ($(window).width() <= 767)
                    $('#sidebar-collapse').collapse('hide')
            })
        </script>	
    </body>
</html>       
          
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
<div id="viewmyModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h4 class="modal-title">View User</h4>
            </div>
            <div class="modal-body" id="content">

             </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-default" id ="ok" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>