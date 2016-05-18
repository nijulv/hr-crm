<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                    <li class="active">Add Payment</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Payment</h1>
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
             <?php echo form_open(base_url() . "add_payments",array("id" => "payments"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Client <span class="required">*</span></label>
                                        <select name="user" id="user" class="form-control" required>
                                            <option value = "">Select Client</option>
                                            <?php if($users){
                                                foreach ($users as $user) { ?>
                                            <option value = "<?php echo $user['user_id']?>"><?php echo $user['first_name'].' '.$user['last_name']?></option>
                                                <?php }}?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Payment Title <span class="required">*</span><small class="text-muted"><i>(It should be easy to identify later)</i></small></label>
                                        <input type="text" name="title" id="title" class="form-control" placeholder="Payment Title" maxlength="60" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Amount <span class="required">*</span></label>
                                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount" maxlength="9" required onkeypress="return numberValidate(event);">
                                    </div>
                                    <div class="form-group">
                                        <label>Comments <small class="text-muted"></small></label>
                                        <textarea class="form-control" name="comments" maxlength="550" style="height: 150px !important;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Add Payment">
                                    </div>
                                 <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->