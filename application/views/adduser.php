<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Add User</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add User</h1>
                </div>
            </div><!--/.row-->
            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">	
               <div class="row">
                <?php if (f('success_message') || @$form_success_message) { ?>
                    <div class="alert alert-success">
                        <strong>Success!</strong> <?php echo f('success_message') ? f('success_message') : @$form_success_message; ?>
                    </div>
                <?php } ?> 
                <?php if (!empty($form_validation_error)) { ?>
                    <div class="alert alert-danger">
                        <strong>Error!</strong> <?php echo $form_validation_error; ?>
                    </div>
                <?php } ?>
               </div>
            </div>
	    <form class="form-label-left form-horizontal" enctype="multipart/form-data" method ="POST" action="<?php echo base_url() ?>adduser" name="frmUserdetails" id="frmUserdetails">   
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtFirstname">First Name<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="firstname" id="firstname" value="<?php echo set_value('firstname') ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtLastname">Last Name<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="lastname" id="lastname" value="<?php echo set_value('lastname') ?>" required>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtUseremail">Email<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="email" class="form-control col-md-7 col-xs-12" name="useremail" id="useremail" value="<?php echo set_value('useremail') ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtPhonenumber">Phone<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="phonenumber" id="phonenumber" value="<?php echo set_value('phonenumber') ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtUseraddress">Address<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <textarea class="form-control col-md-7 col-xs-12" name="useraddress" id="useraddress" style="height:500px;" value="<?php echo set_value('address') ?>" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtPincode">Pincode<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="text" class="form-control col-md-7 col-xs-12" name="pincode" id="pincode" value="<?php echo set_value('pincode') ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtAttachment">Attachment<span class="required">*</span>
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input type="file" class="form-control col-md-7 col-xs-12" name="attachment" id="attachment" style="height:500px;padding-bottom: 48px;" value="<?php echo set_value('attachment') ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12 " for="txtUserstatus">Status
                        </label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <select name="userstatus" id="Userstatus" class="form-control col-md-7 col-xs-12">
                                <option value="0">Guest</option>
                                <option value="1">User</option>
                            </select>
                        </div>
                    </div>
                <div class="ln_solid"></div>
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                           <button type="reset" id="btnCancel" class="btn btn-primary">Cancel</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </div>
                </form>
</div>