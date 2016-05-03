<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Modify Agents</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modify Agents</h1>
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
              <?php echo form_open("",array("id" => "agents"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agent code <small class="text-muted"></small> <span class="required">*</span></label>
                                    <input type="text" name="agent_code" class="form-control" placeholder="Agent Code" required value = "<?php echo set_value('agent_code',$details['agent_code']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username <span class="required">*</span></label>
                                    <input type="text" name="username" class="form-control" placeholder="Username" required value = "<?php echo set_value('username',$details['username']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password <span class="required">*</span></label>
                                    <input type="text" name="password" class="form-control" placeholder="Password" required value = "<?php echo set_value('password',$details['password']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>First name <span class="required">*</span></label>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required value = "<?php echo set_value('first_name',$details['first_name']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Last name</label>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value = "<?php echo set_value('last_name',$details['last_name']); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="text" name="email" class="form-control" placeholder="Email" required value = "<?php echo set_value('email',$details['email']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Phone <span class="required">*</span></label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" required value = "<?php echo set_value('phone',$details['phone']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Address <small class="text-muted"></small></label>
                                    <textarea class="form-control" name="address" style="height: 150px !important;"><?php echo set_value('address',$details['address']);?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Pincode</label>
                                    <input type="text" name="pincode" class="form-control" placeholder="Pin code" value = "<?php echo set_value('pincode',$details['pincode']); ?>">
                                </div>
                                <div class="form-group">
                                    <button type="reset" id="agtbtnCancel" class="btn btn-default">Cancel</button>
                                    <input type="submit" class="btn btn-primary" value="Modify Agents">
                                </div>
                                <input type = "hidden" name = "id" value = "<?php echo $details['agent_id'];?>">
                                <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->