<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Modify Password</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modify Password</h1>
                </div>
            </div><!--/.row-->
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
             <?php echo form_open(base_url() . "change_password",array("id" => "password"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Old password </label>
                                    <input type="password" name="oldpassword" class="form-control" placeholder="Old Password" value = "<?php echo set_value('oldpassword'); ?>" required >
                                </div>
                                <div class="form-group">
                                    <label>New password </label>
                                    <input type="password" name="newpassword" class="form-control" placeholder="New Password" value = "<?php echo set_value('newpassword'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Confirm password </label>
                                    <input type="password" name="confirmpassword" class="form-control" placeholder="Confirm Password" value = "<?php echo set_value('confirmpassword'); ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Modify Password">
                                </div>
                                <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->