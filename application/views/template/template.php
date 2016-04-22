<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Marshall Leadership Consulting</title>
        <link href="<?php echo assets_url();?>css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo assets_url();?>css/datepicker3.css" rel="stylesheet">
        <!--<link href="css/styles.css" rel="stylesheet">-->
        <link href="<?php echo assets_url();?>css/marshall.css" rel="stylesheet">
        <!--Icons-->
        <script src="<?php echo assets_url();?>js/lumino.glyphs.js"></script>

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
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
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Welcome Marshall <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                                <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
                                <li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="logo" align="center">
                <img src="<?php echo assets_url();?>images/logo_small2.png" class="img-responsive">
            </div>

            <ul class="nav menu"> 
                <li><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <li class="active"><a href="schedule.html"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Manage Schedule</a></li>
                <li><a href="clients.html"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Manage Clients</a></li>
                <li><a href="manage-payment.html"><svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Manage Payments</a></li>
                <li><a href="manage-invoice.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Manage Invoices</a></li>
                <li><a href="ehr.html"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Manage EHR </a></li>
                <li role="presentation" class="divider"></li>
                <li><a href="index.html"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
            </ul>

        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="index.html"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Scheduler</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Scheduler</h1>
                </div>
            </div><!--/.row-->
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
        <script>
            $('#calendar').datepicker({
            });

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
          

