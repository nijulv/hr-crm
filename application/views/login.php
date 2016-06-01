
    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="navbar-header" id="bs-example-navbar-collapse-1" style = "padding-left: 93%;">
                    <ul class="nav navbar-nav">
                        
                        <li>
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
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>

        <!-- Full Width Image Header -->
        <header class="header-image">
            <div class="headline">
                <div class="container">
                    <center></center>
                    <h1 style="color: #0069AA">HR-CRM</h1>
                    <h2></h2>
                </div>
            </div>
        </header>
        
        <div class="col-sm-6 col-sm-offset-3">	
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
         </div>
        <!-- Page Content -->
        <div class="container">
            <br><br>
            <h1 align="center" class="tagline">Organize a big team!</h1>
            <hr class="featurette-divider">
            <!-- First Featurette -->
            <div class="featurette" id="about">
                <img class="featurette-image img-circle img-responsive pull-right" src="<?php echo assets_url();?>images/facilitation.jpg">
                <h2 class="featurette-heading">Neque porro <span class="text-muted">quisquam</span></h2>
                <p class="lead">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard 
                    dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                    It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. 
                    It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with 
                    desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                </p>
            </div>
            <hr class="featurette-divider">
            <!-- Footer -->
            <footer>
                <div class="row">
                    <div class="col-lg-12">
                        <p>© Copyright <?php echo date('Y');?> HR-CRM</p>
                    </div>
                </div>
            </footer>
        </div>
        <!-- /.container -->