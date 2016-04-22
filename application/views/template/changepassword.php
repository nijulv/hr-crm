<!DOCTYPE html>
<html lang="en">
    <head>
        <title>CopierChoice|Admin</title>
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
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/jquery-ui-1.10.4.custom.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/font-awesome.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/bootstrap.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/animate.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/all.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/main.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/style-responsive.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/zabuto_calendar.min.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/pace.css">
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/styles/jquery.news-ticker.css">
        
    </head>
    <body style="background: #1D3962 !important">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-6 col-md-offset-3" style="margin-top: 75px;">
                        <center>
                            <img src="<?php echo base_url(); ?>assets/images/CClogo_nobg_400x91.png" class="img-responsive" width="300">
                            <!--<img src="<?php echo base_url(); ?>assets/images/leads_2_sales_au (235 x 82).png" class="img-responsive">-->
                        </center>
                        <br>
                        <div class="panel panel-blue">
                            <div class="panel-heading">
                                Forgot Password</div>
                            <div class="panel-body pan">
                                <?php
                                    $error = f('error_message') ? f('error_message') : validation_errors();
                                    if(!empty($error)){
                                        echo '<div class="text-center">                                        
                                                <div class="alert alert-danger">
                                                '.$error.'
                                                </div>                                        
                                             </div>';
                                    }
                                ?>
                                <?php if ( f('success_message') != '' ) :?>
                                    <div class="text-center">                                        
                                        <div class="alert alert-success">
                                            <?php echo f('success_message');?>
                                        </div>                                        
                                    </div>
                                <?php endif;?>
                                <?php 
                                    $form_init = array(
                                        "class"     => "form-horizontal"
                                    );
                                    echo form_open("",$form_init);
                                ?>
                                    <div class="form-body pal">
                                        <div class="form-group">
                                            <label for="username" class="col-md-3 control-label">Username</label>
                                            <div class="col-md-9">
                                                <div class="input-icon right">
                                                    <i class="fa fa-user"></i>
                                                    <?php
                                                        $username = array(
                                                            "name"  => "admin_username",
                                                            "placeholder"=>"Username",
                                                            "class" => "form-control"
                                                        );
                                                        echo form_input($username);
                                                    ?>
                                                </div>
                                                <span class="help-block mbn"><a href="<?php echo admin_url()?>"><small>Back to login</small> </a></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions pal">
                                        <div class="form-group mbn">
                                            <div class="col-md-offset-3 col-md-6">
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    echo form_close();
                                ?>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <script src="<?php echo base_url(); ?>assets/script/jquery-1.10.2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery-migrate-1.2.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery-ui.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/bootstrap-hover-dropdown.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/html5shiv.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/respond.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.metisMenu.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.slimscroll.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.cookie.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/icheck.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/custom.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.news-ticker.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.menu.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/pace.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/holder.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/responsive-tabs.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.categories.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.tooltip.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.fillbetween.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/jquery.flot.spline.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/zabuto_calendar.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/index.js"></script>
        <!--LOADING SCRIPTS FOR CHARTS-->
        <script src="<?php echo base_url(); ?>assets/script/highcharts.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/data.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/drilldown.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/exporting.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/highcharts-more.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/charts-highchart-pie.js"></script>
        <script src="<?php echo base_url(); ?>assets/script/charts-highchart-more.js"></script>
        <!--CORE JAVASCRIPT-->
        <script src="<?php echo base_url(); ?>assets/script/main.js"></script>
    </body>

</html>