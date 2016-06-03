<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active">Client/Prospect</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modify <?php if($user_details['status'] == 0) { echo 'Prospect';} else { echo 'Client';}?></h1>
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
        <?php if(!empty($user_details)){?>
	    <form class="" enctype="multipart/form-data" method ="POST" action="<?php echo base_url() ?>edituser/<?php echo $user_details['user_id']?>" name="frmUserdetails" id="frmUserdetails">   
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="col-md-6">   
                                        <div class="form-group">
                                            <label  for="txtFirstname">First Name<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo $user_details['first_name']?>" required maxlength="30" onkeypress="return blockSpecialChar(event)">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtLastname">Last Name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo $user_details['last_name']?>" maxlength="15" onkeypress="return blockSpecialChar(event)">
                                        </div>
                                        <div class="form-group">
                                            <label  for="txtUseremail">Email<span class="required">*</span></label>
                                            <input type="email" class="form-control col-md-7 col-xs-12" name="useremail" id="useremail" value="<?php echo $user_details['email']?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label  for="txtPhonenumber">Phone<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo $user_details['phone']?>" maxlength="10" required onkeypress="return numberValidate(event);">
                                        </div>
                                     <?php if(!empty($state_details)){?>
                                      <div class="form-group">
                                        <label for="txtUserstate">State<span class="required">*</span></label>
                                        <select name="state" id="state" class="form-control" required>
                                            <option value="">Select</option>
                                          <?php foreach($state_details as $res){?> 
                                            <option value="<?php echo $res['id']; ?>"  <?php if($res['id'] == $user_details['state_id']) {echo 'selected=""';} ?>><?php echo $res['name']; ?></option>
                                          <?php } ?>
                                        </select>
                                     </div> 
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="txtUserdistrict">District<span class="required">*</span></label>
                                        <select name="district" id="district" class="form-control" required>
                                            <?php foreach($district_details as $res){?> 
                                             <option value="<?php echo $res['id']; ?>"  <?php if($res['id'] == $user_details['district_id']) {echo 'selected=""';} ?>><?php echo $res['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtCity">City<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" value="<?php echo $user_details['city']?>" maxlength="25" onkeypress="return blockSpecialChar(event)">
                                    </div>
                                </div>
                                <div class="col-md-6">  
                                        <div class="form-group">
                                            <label for="txtUseraddress">Address</label>
                                            <textarea class="form-control" name="useraddress" id="useraddress" style="height:150px ! important;" maxlength="500"><?php echo $user_details['address']?></textarea>
                                          </div>
                                        <div class="form-group">
                                            <label  for="txtPincode">Pincode</label>
                                            <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo $user_details['pincode']?>" maxlength="6" onkeypress="return numberValidate(event);">
                                        </div>
                                        <div class="form-group">
                                            <label  for="txtAttachment">Attachment 1</label><small><i>(Allowed types are pdf|doc|docx)</i></small>
                                            <input type="file" class="form-control" name="attachment" id="attachment" style="height:500px;padding-bottom: 48px;" value="<?php echo $user_details['attachment']?>">
                                            <?php if($user_details['attachments']){?><div id = "attachment1div"><?php echo $user_details['attachments'];?>  <a  data-no="attachment1" data-id="<?php echo $user_details['user_id'] ?>" href="javascript:void(0)" class="removeimage" title="Remove"><i class="fa fa-times-circle" aria-hidden="true" style="font-size:20px;"></i></a></div><?php }?>
 
                                        </div>
                                        <div class="form-group">
                                            <label  for="txtAttachment">Attachment 2</label><small><i>(Allowed types are pdf|doc|docx)</i></small>
                                            <input type="file" class="form-control" name="attachment2" id="attachment2" style="height:500px;padding-bottom: 48px;" value="<?php echo $user_details['attachment2']?>">
                                            <?php if($user_details['attachments2']){?><div id = "attachment2div"><?php echo $user_details['attachments2'];?>  <a  data-no="attachment2" data-id="<?php echo $user_details['user_id'] ?>" href="javascript:void(0)" class="removeimage" title="Remove"><i class="fa fa-times-circle" aria-hidden="true" style="font-size:20px;"></i></a></div><?php }?>
                                        
                                        </div>
                                        <div class="form-group">
                                            <label  for="txtAttachment">Attachment 3</label><small><i>(Allowed types are pdf|doc|docx)</i></small>
                                            <input type="file" class="form-control" name="attachment3" id="attachment3" style="height:500px;padding-bottom: 48px;" value="<?php echo $user_details['attachment3']?>">
                                            <?php if($user_details['attachments3']){?><div id = "attachment3div"><?php echo $user_details['attachments3'];?>  <a  data-no="attachment3" data-id="<?php echo $user_details['user_id'] ?>" href="javascript:void(0)" class="removeimage" title="Remove"><i class="fa fa-times-circle" aria-hidden="true" style="font-size:20px;"></i></a></div><?php }?>
                                            
                                        </div>
                                        <div class="form-group">
                                            <label  for="txtUserstatus">Status<span class="required">*</span> <span class="check_div" id="payment_status"></span></label>
                                            <select name="userstatus" id="Userstatus" class="form-control">
                                                <option value="0" <?php if($user_details['status'] == '0') {echo 'selected=""';} ?>>Prospect</option>
                                                <option value="1" <?php if($user_details['status']== '1') {echo 'selected=""';} ?>>Client</option>
                                            </select>
                                        </div>
                                </div>
                                <div class="col-md-12" style = "text-align:center;"> 
                                    <input type = "hidden" name = "userid" id = "userid" value = "<?php echo $user_details['user_id'];?>">
                                    <button type="reset" id="btnCancel" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        <?php } ?>
</div>