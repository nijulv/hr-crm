<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                    <li class="active"> Bank Payments</li>
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
                                    <label>Bank Payment code <small class="text-muted"></small><span class="required">*</span></label>
                                    <input type="text" name="bank_payment_code" id="bank_payment_code" class="form-control" required maxlength="20" readonly="readonly" value="<?php echo set_value('bank_payment_code',$bank_payment_code_value) ?>">
                                </div>
                                <div class="form-group">
                                    <label>Amount to bank <span class="required">*</span> <span class = "check_div" id = "amonut_error_msg" ></span></label>
                                    <input type="text" name="bank_payment" id="bank_payment" class="form-control" placeholder="Amount to bank" maxlength="9" value = "<?php echo set_value('bank_payment',$balance_amount); ?>" required onkeypress="return numberValidate(event);">
                                </div>
                                <div class="form-group">
                                    <label>Amount in hand</label>
                                    <input type="text" name="amount_hand" id="amount_hand" class="form-control" placeholder="Amount in hand" maxlength="9" readonly="readonly" value = "<?php echo set_value('amount_hand'); ?>" onkeypress="return numberValidate(event);">
                                </div>
                                <div class="form-group">
                                    <label>Comments <small class="text-muted"></small></label>
                                    <textarea class="form-control" name="reason" id="user" maxlength="550" style="height: 150px !important;"><?php echo set_value('reason');?></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="reset" id="btnCancel_paymentbank" class="btn btn-default">Cancel</button>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                                <input type = "hidden" name = "balance_amount" id = "balance_amount" value = "<?php echo $balance_amount;?>">
                             <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->