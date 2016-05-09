                <?php if($user_details['status']==0){
                $status="Client";
                }
                if($user_details['status']==1){
                $status="User";
                }
                if($user_details['status']==2){
                $status="Deleted";
                }?>
            <div class="row">
                    <div class="col-lg-12">
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>First Name : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                       <?php echo $user_details['first_name']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Last Name : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['last_name']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Email : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                       <?php echo $user_details['email']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Phone : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['phone']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>State : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $get_state['name']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>District : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $get_district['name']?>
                                    </div>
                                </div>
                                 <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>City : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['city']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Address : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['address']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Pincode : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['pincode']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Attachment : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['attachments']?>
                                    </div>
                                </div>
                                 <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Status : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                      <?php echo $status ?>
                                    </div>
                                </div>
                    </div>
                </div>
