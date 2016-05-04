<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Modify Profile</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modify Profile</h1>
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
             <?php echo form_open(base_url() . "edit_profile",array("id" => "profile"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Username </label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" value = "<?php echo set_value('username',$details['username']); ?>" required readonly>
                                </div>
                                <div class="form-group">
                                    <label>First name </label>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" value = "<?php echo set_value('first_name',$details['first_name']); ?>" required maxlength="25" onkeypress="return blockSpecialChar(event)">
                                </div>
                                <div class="form-group">
                                    <label>Last name </label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value = "<?php echo set_value('last_name',$details['last_name']); ?>" maxlength="25" onkeypress="return blockSpecialChar(event)">
                                </div>
                                <div class="form-group">
                                    <label>Email </label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" value = "<?php echo set_value('email',$details['email']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Phone </label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" value = "<?php echo set_value('phone',$details['phone']); ?>" required maxlength="10" onkeypress="return numberValidate(event);">
                                </div>
                                <?php
                                if(s('ADMIN_TYPE') == 1){
                                    $style = 'display:block';
                                }
                                else {
                                    $style = 'display:none';
                                }
                                ?>
                                <div style = "<?php echo $style?>">
                                    <div class="form-group">
                                        <label>Agent code </label>
                                        <input type="text" name="agent_code" class="form-control" placeholder="Agent Code" value = "<?php echo set_value('agent_code',$details['agent_code']); ?>" maxlength="15">
                                    </div>
                                    <div class="form-group">
                                        <label>Address <small class="text-muted"></small></label>
                                        <textarea class="form-control" name="address" style="height: 150px !important;" maxlength="500"><?php echo set_value('address',$details['address']);?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Pincode </label>
                                        <input type="text" name="pincode" class="form-control" placeholder="Pincode" value = "<?php echo set_value('pincode',$details['pincode']); ?>" maxlength="10" onkeypress="return numberValidate(event);">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Modify Profile">
                                </div>
                                <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->