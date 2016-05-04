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
                    <a class="navbar-brand" href="#"></a>
                    <ul class="user-menu" >
                        <li class="dropdown pull-right">   
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Welcome <?php if(s('ADMIN_NAME')){echo s('ADMIN_NAME');} ?> <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="<?php echo base_url()?>edit_profile"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                                <li><a href="<?php echo base_url()?>change_password"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Change Password</a></li>
                                <li><a href="<?php echo base_url()?>logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="logo" align="center"></div>
          
            <ul class="nav menu"> 
                <li class="<?php echo $link_dashboard;?>"><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <?php if(s('ADMIN_TYPE') == 0) {?>
                    <li class="<?php echo $link_agent;?>"><a href="<?php echo base_url()?>manage_agents"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Manage Agents</a></li>
                <?php }?>
                <li class="<?php echo $link_user;?>"><a href="<?php echo base_url()?>manageuser"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Manage Users</a></li>
                <li class="<?php echo $link_payment;?>"><a href="<?php echo base_url()?>manage_payment"><svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Manage Payments</a></li>
                <li class = "<?php echo $link_bank;?>"><a href="<?php echo base_url()?>manage_cash"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Manage Bank Payment </a></li>

                <li role="presentation" class="divider"></li>
                <li><a href="<?php echo base_url()?>logout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
            </ul>

        </div><!--/.sidebar-->
            <?php
                //contents goes here
                echo $content;
            ?>
            
        <script src="<?php echo assets_url();?>js/jquery-1.11.1.min.js"></script>
        <script src="<?php echo assets_url();?>js/bootstrap.min.js"></script>
        <script src="<?php echo assets_url();?>js/chart.min.js"></script>
        <script src="<?php echo assets_url();?>js/chart-data.js"></script>
        <script src="<?php echo assets_url();?>js/easypiechart.js"></script>
        <script src="<?php echo assets_url();?>js/easypiechart-data.js"></script>
        <script src="<?php echo assets_url();?>js/bootstrap-datepicker.js"></script>
        <script> var base_url = '<?php echo base_url(); ?>'; </script>
        <script src="<?php echo assets_url();?>jquery-validation/js/jquery.validate.min.js"></script>
        <script src="<?php echo assets_url();?>js/manageuser.js"></script>
        <script src="<?php echo assets_url();?>js/managepayments.js"></script>
        <script src="<?php echo assets_url();?>js/manageagent.js"></script>
        <script src="<?php echo assets_url();?>js/manageprofile.js"></script>
        <script src="<?php echo assets_url();?>js/managepayments.js"></script>
        <script src="<?php echo assets_url();?>js/managebankdetails.js"></script>
        <script src="<?php echo assets_url();?>js/bootstrap-table.js"></script>
        <script src="<?php echo assets_url();?>js/bootbox.min.js"></script>
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
          

