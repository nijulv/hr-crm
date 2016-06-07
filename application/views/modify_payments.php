<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                    <li class="active">Payments</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Modify Payment</h1>
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
              <?php echo form_open("",array("id" => "payment"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Payment code <small class="text-muted"></small><span class="required">*</span></label>
                                        <input type="text" name="payment_code" id="payment_code" class="form-control" required maxlength="20" readonly="readonly" value="<?php echo set_value('payment_code',$details['payment_code']); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Select Client <span class="required">*</span></label>
                                        <select name="user" id="user" class="form-control" required>
                                            <option value = "">Select Client</option>
                                            <?php if($users){
                                                foreach ($users as $user) { ?>
                                            <option value = "<?php echo $user['user_id']?>" <?php if($user['user_id'] == $details['user_id']) {?> selected<?php }?>><?php echo $user['first_name'].' '.$user['last_name']?></option>
                                                <?php }}?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Payment Title <span class="required">*</span><small class="text-muted"><i>(It should be easy to identify later)</i></small></label>
                                        <input type="text" name="title"id="title" class="form-control" maxlength="60" placeholder="Payment Title" value = "<?php echo set_value('title',$details['title']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount <span class="required">*</span></label>
                                        <input type="text" name="amount" id="amount" class="form-control" maxlength="9" placeholder="Amount" value = "<?php echo set_value('amount',$details['amount']); ?>" required onkeypress="return numberValidate(event);">
                                    </div>
                                    <div class="form-group">
                                        <label>Comments <small class="text-muted"></small></label>
                                        <textarea class="form-control" name="comments" id="comments" maxlength="550" style="height: 150px !important;"><?php echo set_value('comments',$details['comments']);?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="reset" id="btnCancel_payment" class="btn btn-default">Cancel</button>
                                        <input type="submit" class="btn btn-primary" value="Modify Payment">
                                    </div>
                                    <input type = "hidden" name = "id" value = "<?php echo $details['payment_id'];?>">
                                 <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->