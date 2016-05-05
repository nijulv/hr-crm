<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Add Bank Payment</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Bank Payment</h1>
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
             <?php echo form_open(base_url() . "add_bankpayments",array("id" => "bankpayments"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Select Client<span class="required">*</span></label>
                                    <select name="user[]" id="user" class="form-control" required multiple="true" style = "height: 80px !important;">
                                        
                                        <?php if($users){
                                            foreach ($users as $user) { ?>
                                        <option value = "<?php echo $user['user_id']?>"><?php echo $user['first_name'].' '.$user['last_name']?></option>
                                            <?php }}?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Total payment <span class="required">*</span></label>
                                    <input type="text" name="total_payment" id="total_payment" class="form-control" placeholder="Total Payment" maxlength="9" value = "<?php echo set_value('total_payment'); ?>" required onkeypress="return numberValidate(event);">
                                </div>
                                <div class="form-group">
                                    <label>Bank payment <span class="required">*</span></label>
                                    <input type="text" name="bank_payment" id="bank_payment" class="form-control" placeholder="Bank Payment" maxlength="9" value = "<?php echo set_value('bank_payment'); ?>" required onkeypress="return numberValidate(event);">
                                </div>
                                <span id = "warning_msg" style = "color:red;display:none;"></span>
                                <div class="form-group">
                                    <label>Reason <small class="text-muted"></small></label>
                                    <textarea class="form-control" name="reason" id="user" maxlength="550" style="height: 150px !important;"><?php echo set_value('reason');?></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                             <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->