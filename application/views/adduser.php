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
	    <form class="" enctype="multipart/form-data" method ="POST" action="<?php echo base_url() ?>adduser" name="frmUserdetails" id="frmUserdetails">  
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="txtFirstname">First Name<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtLastname">Last Name</label>
                                        <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname') ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUseremail">Email<span class="required">*</span></label>
                                        <input type="email" class="form-control" name="useremail" id="useremail" value="<?php echo set_value('useremail') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label  for="txtPhonenumber">Phone<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo set_value('phonenumber') ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUseraddress">Address</label>
                                        <textarea class="form-control" name="useraddress" id="useraddress" style="height:150px ! important;" value="<?php echo set_value('address') ?>" ></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label  for="txtPincode">Pincode</label>
                                        <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo set_value('pincode') ?>" >
                                     </div>
                                    <div class="form-group">
                                        <label  for="txtAttachment">Attachment</label>
                                        <input type="file" class="form-control" name="attachment" id="attachment" style="height:500px;padding-bottom: 48px;" value="<?php echo set_value('attachment') ?>">
                                        <div>Allowed types: pdf|doc|docx</div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUserstatus">Status<span class="required">*</span></label>
                                        <select name="userstatus" id="Userstatus" class="form-control">
                                            <option value="0">Guest</option>
                                            <option value="1">User</option>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <button type="reset" id="btnCancel" class="btn btn-default">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
</div>