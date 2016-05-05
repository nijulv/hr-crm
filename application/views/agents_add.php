<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Add Agent</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Agent</h1>
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
             <?php echo form_open(base_url() . "add_agents",array("id" => "agents"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agent code <small class="text-muted"></small><span class="required">*</span></label>
                                        <input type="text" name="agent_code" id="agent_code" class="form-control" placeholder="Agent Code" required maxlength="20" value="<?php echo set_value('agent_code') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Username <span class="required">*</span></label>
                                        <input type="text" name="username" id="username"  class="form-control" placeholder="Username" required maxlength="25" value="<?php echo set_value('username') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Password <span class="required">*</span></label>
                                        <input type="text" name="password" id="password" class="form-control" placeholder="Password" required maxlength="30" value="<?php echo set_value('password') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>First name <span class="required">*</span></label>
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" required maxlength="30" onkeypress="return blockSpecialChar(event)" value="<?php echo set_value('first_name') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" maxlength="15" onkeypress="return blockSpecialChar(event)" value="<?php echo set_value('last_name') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" required value="<?php echo set_value('email') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Phone <span class="required">*</span></label>
                                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone" required maxlength="10" onkeypress="return numberValidate(event);" value="<?php echo set_value('phone') ?>">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                <?php if(!empty($state_details)){?>
                                    <div class="form-group">
                                        <label for="txtUserstate">State<span class="required">*</span></label>
                                        <select name="state" id="state" class="form-control" required>
                                            <option value="">Select</option>
                                          <?php foreach($state_details as $res){?> 
                                            <option value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                                          <?php } ?>
                                        </select>
                                    </div> 
                                <?php } ?>
                                    <div class="form-group">
                                        <label for="txtUserdistrict">District<span class="required">*</span></label>
                                        <select name="district" id="district" class="form-control" required>
                                            <option value="">Select</option>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                            <label for="txtCity">City</label>
                                            <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city') ?>" maxlength="15" onkeypress="return blockSpecialChar(event)"
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Address <small class="text-muted"></small></label>
                                        <textarea class="form-control" name="address" id="address"  style="height: 150px !important;" maxlength="500"><?php echo set_value('address') ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="text" name="pincode" id="pincode" class="form-control" maxlength="15" placeholder="Pin code" onkeypress="return numberValidate(event);" value="<?php echo set_value('pincode') ?>">
                                    </div>
                                    <div class="form-group">
                                        <button type="reset" id="btnCancelagent" class="btn btn-default">Cancel</button>
                                        <input type="submit" class="btn btn-primary" value="Add Agents">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
                <?php echo form_close();?> 
        </div><!--/.main-->