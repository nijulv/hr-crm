<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                    <li class="active">Client/Prospect</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Prospect</h1>
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
                                            <input type="text" class="form-control" name="firstname" id="firstname" value="<?php echo set_value('firstname') ?>" required maxlength="30" onkeypress="return blockSpecialChar(event)">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtLastname">Last Name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastname" value="<?php echo set_value('lastname') ?>" maxlength="15" onkeypress="return blockSpecialChar(event)">
                                        </div>
                                        <div class="form-group">
                                            <label for="txtUseremail">Email<span class="required">*</span></label>
                                            <input type="email" class="form-control" name="useremail" id="useremail" value="<?php echo set_value('useremail') ?>" required >
                                        </div>
                                        <div class="form-group">
                                            <label  for="txtPhonenumber">Phone<span class="required">*</span></label>
                                            <input type="text" class="form-control" name="phonenumber" id="phonenumber" value="<?php echo set_value('phonenumber') ?>" maxlength="10" required onkeypress="return numberValidate(event);">
                                        </div>
                                    <?php if(!empty($state_details)){?>
                                    <div class="form-group">
                                            <label for="txtUserstate">State<span class="required">*</span></label>
                                            <select name="state" id="state" class="form-control" required>
                                                <option value="">Select</option>
                                              <?php foreach($state_details as $res){?> 
                                                <option value="<?php echo $res['id']; ?>" <?php echo set_select('state', $res['id'], False); ?> ><?php echo $res['name']; ?></option>
                                              <?php } ?>
                                            </select>
                                        </div> 
                                    <?php } ?>
                                    <div class="form-group">
                                        <label for="txtUserdistrict">District<span class="required">*</span></label>
                                        <select name="district" id="district" class="form-control" required>
                                            <option value="">Select</option>
                                            <?php if($districts){?>
                                                <?php foreach($districts as $res){?> 
                                                    <option value="<?php echo $res['id']; ?>" <?php if($res['id'] == $district_selected){ ?>selected="selected"<?php }?>><?php echo $res['name']; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="txtCity">City<span class="required">*</span></label>
                                        <input type="text" class="form-control" name="city" id="city" value="<?php echo set_value('city') ?>" maxlength="25" onkeypress="return blockSpecialChar(event)">
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUseraddress">Address</label>
                                        <textarea class="form-control" name="useraddress" id="useraddress" style="height:150px ! important;" maxlength="500" ><?php echo set_value('useraddress') ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    
                                     <div class="form-group">
                                        <label for="star_rate">Quality Rating <span class="required">*</span></label>
                                        <select name="star_rate" id="star_rate" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1">1 Star</option>
                                            <option value="2">2 Star</option>
                                            <option value="3">3 Star</option>
                                            <option value="4">4 Star</option>
                                            <option value="5">5 Star</option>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="txtUserstate">Business Category </label>
                                        <select name="business_category" id="business_category" class="form-control">
                                            <option value="">Select</option>
                                          <?php if($category) {
                                              foreach($category as $res){?> 
                                            <option value="<?php echo $res['category_id']; ?>" <?php echo set_select('business_category', $res['category_id'], False); ?> ><?php echo $res['category_name']; ?></option>
                                          <?php } } ?>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label  for="txtPincode">Pincode</label>
                                        <input type="text" class="form-control" name="pincode" id="pincode" value="<?php echo set_value('pincode') ?>" maxlength="6" onkeypress="return numberValidate(event);">
                                     </div>
                                    <div class="form-group">
                                        <label  for="txtAttachment">Attachment 1</label><small><i>(Allowed types are pdf|doc|docx)</i></small>
                                        <input type="file" class="form-control" name="attachment" id="attachment" style="height:500px;padding-bottom: 48px;" value="<?php echo set_value('attachment') ?>">
                                       
                                    </div>
                                    <div class="form-group">
                                        <label  for="txtAttachment">Attachment 2</label><small><i>(Allowed types are pdf|doc|docx)</i></small>
                                        <input type="file" class="form-control" name="attachment2" id="attachment2" style="height:500px;padding-bottom: 48px;" value="<?php echo set_value('attachment2') ?>">
                                       
                                    </div>
                                    <div class="form-group">
                                        <label  for="txtAttachment">Attachment 3</label><small><i>(Allowed types are pdf|doc|docx)</i></small>
                                        <input type="file" class="form-control" name="attachment3" id="attachment3" style="height:500px;padding-bottom: 48px;" value="<?php echo set_value('attachment3') ?>">
                                       
                                    </div>
                                    <div class="form-group">
                                        <label for="txtUserstatus">Status<span class="required">*</span> <span class = "check_div" id = "payment_status" ></span></label>
                                        <select name="userstatus" id="Userstatus" class="form-control">
                                            <option value="0">Prospect</option>
                                            <option value="1">Client</option>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label for="Comments">Comments</label>
                                        <textarea class="form-control" name="comments" id="comments" style="height:150px ! important;" maxlength="500" ><?php echo set_value('comments') ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12" style = "text-align:center;">  
                                    <button type="reset" id="btnCancel" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
</div>