<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Marshall Leadership Consulting</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo assets_url();?>css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo assets_url();?>css/one-page-wonder.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>
    <body>       
        <?php echo $content;?>
        
        
     <!-- jQuery -->
        <script src="<?php echo assets_url();?>js/jquery.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo assets_url();?>js/bootstrap.min.js"></script>
        <script type="text/javascript">
            var base_url = "<?php echo base_url(); ?>";
            var admin_url = "<?php echo admin_url(); ?>";
            var assets_url = "<?php echo assets_url(); ?>";
        </script>
    </body>

</html>
<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h1 style="color: #666">HR-CRM</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -72px;">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <!-- Begin # DIV Form -->
            <div id="div-forms">
                <!-- Begin # Login Form -->
                <?php echo form_open(base_url()."logincheck");?>
                    <div class="modal-body">
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-login-msg">Administrator Login.</span>
                        </div>
                        <br>
                        <input id="login_username" class="form-control" name = "username" type="text" placeholder="Username" required>
                        <input id="login_password" class="form-control" name = "password" type="password" placeholder="Password" required>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-login btn-lg btn-block">Login</button>
                        </div>
                        <div>
                            <button id="login_lost_btn" type="button" class="btn btn-link">Forgot Password?</button>
                        </div>
                    </div>
                    <input type = "hidden" name = "type" value = "admin">
                <?php echo form_close(); ?>
                <!-- End # Login Form -->
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->
<!-- BEGIN # MODAL LOGIN -->
<div class="modal fade" id="login-modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" align="center">
                <h1 style="color: #666">HR-CRM</h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </button>
            </div>
            <!-- Begin # DIV Form -->
            <div id="div-forms">
                <!-- Begin # Login Form -->
                <?php echo form_open(base_url()."logincheck");?>
                    <div class="modal-body">
                        <div id="div-login-msg">
                            <div id="icon-login-msg" class="glyphicon glyphicon-chevron-right"></div>
                            <span id="text-login-msg">Agent Login.</span>
                        </div>
                        <br>
                        <input id="login_username" class="form-control" type="text" name = "username" placeholder="Username" required>
                        <input id="login_password" class="form-control" type="password"  name = "password" placeholder="Password" required>
                    </div>
                    <div class="modal-footer">
                        <div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block btn-login">Login</button>
                        </div>
                        <div>
                            <button id="login_lost_btn" type="button" class="btn btn-link">Forgot Password?</button>
                        </div>
                    </div>
                     <input type = "hidden" name = "type" value = "agent">
                <?php echo form_close(); ?>
                <!-- End # Login Form -->
            </div>
            <!-- End # DIV Form -->
        </div>
    </div>
</div>
<!-- END # MODAL LOGIN -->