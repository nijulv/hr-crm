<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
    <div class="container topnav">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
<!--            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>-->
            <a class="navbar-brand topnav" href="#">Rain-CRM</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
<!--        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        LOGIN <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-toggle="modal" data-target="#login-modal2">AGENT</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#login-modal">ADMIN</a></li>  
                    </ul>
                </li>
            </ul>
        </div>-->
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>


<!-- Header -->
<a name="about"></a>
<div class="intro-header">
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">	
            <?php
            $error = f('error_message') ? f('error_message') : validation_errors();
            if (!empty($error)) {
                echo '<div class="text-center">                                        
                        <div class="alert alert-danger">
                        ' . $error . '
                        </div>                                        
                     </div>';
            }
            ?>
            <?php if (f('success_message') != '') : ?>
                <div class="text-center">                                        
                    <div class="alert alert-success">
                        <?php echo f('success_message'); ?>
                    </div>                                        
                </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <h1>Rain-CRM</h1>
                    <h3>Organize a big team!</h3>
                    <hr class="intro-divider">
                    <ul class="list-inline intro-social-buttons">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#login-modal" class="btn btn-home btn-lg">ADMIN LOGIN</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#login-modal2" class="btn btn-home btn-lg">AGENT LOGIN</a>
                        </li>

                    </ul>    
                </div>
            </div>

        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->
<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            
            <div class="col-lg-6">
                <div class="pull-left">
                    <ul class="list-inline">
                        <li>
                            <a href="#">Home</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="http://www.rainconcert.in/about-us" target="_blank">About</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="http://www.rainconcert.in/services/" target="_blank">Services</a>
                        </li>
                        <li class="footer-menu-divider">&sdot;</li>
                        <li>
                            <a href="http://www.rainconcert.in/contact" target="_blank">Contact</a>
                        </li>
                    </ul>
                    <p class="copyright text-muted small">Copyright &copy; Rain-CRM 2016. All Rights Reserved</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="pull-right">
                    <h5 class="pull-right">Powered By</h5>
                    <a href="http://www.rainconcert.in/" target="_blank">
                        <img src="http://www.rainconcert.in/assets/images/rainconcert_logo.jpg" class="img-responsive" width="200">
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>