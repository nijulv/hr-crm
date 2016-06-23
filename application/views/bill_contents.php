<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                    <li class="active">Bill Contents</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage Bill Contents</h1>
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
             <?php echo form_open("",array("id" => "bill_contents","enctype" => "multipart/form-data"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>company Name <small class="text-muted"></small><span class="required">*</span></label>
                                        <input type="text" name="company_name" id="company_name" class="form-control" required maxlength="20" value="<?php echo set_value('company_name',$bill_data['company_name']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>company Email <small class="text-muted"></small><span class="required">*</span></label>
                                        <input type="text" name="company_email" id="company_email" class="form-control" required maxlength="20" value="<?php echo set_value('company_email',$bill_data['company_email']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>company Phone <small class="text-muted"></small><span class="required">*</span></label>
                                        <input type="text" name="company_phone" id="company_phone" class="form-control" required maxlength="10" onkeypress="return numberValidate(event);" value="<?php echo set_value('company_phone',$bill_data['company_phone']) ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Logo <small class="text-muted"></small></label><small><i> (Allowed types are gif|jpg|png)</i></small>
                                        <input type = "file" name = "image" class = "form-control" value = "<?php echo set_value('image'); ?>">
                                    </div>
                                    <?php if($bill_data['logo']){?>
                                        <div id = "logodiv" class="form-group">
                                            <img src = "<?php echo assets_url()?>images/bill/<?php echo $bill_data['logo']?>" width="55%"/>
                                            <a href="javascript:void(0)" data-id="<?php echo $bill_data['bill_data_id'] ?>" class="removelogo" title="Remove"><i class="fa fa-times-circle" aria-hidden="true" style="font-size:22px;"></i></a>
                                        </div>
                                    <?php }?>
                                    
                                    <div class="form-group">
                                        <label>Footer Contents <small class="text-muted"></small></label>
                                        <textarea class="form-control" name="footer_content" maxlength="550" style="height: 150px !important;"><?php echo set_value('footer_content',$bill_data['footer_content']);?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Submit">
                                    </div>
                                <input type = "hidden" name = "bill_data_id" value = "<?php echo $bill_data['bill_data_id']?>" >
                                 <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->