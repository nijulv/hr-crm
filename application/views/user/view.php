                <?php if($user_details['status']==0){
                $status="Prospect";
                }
                if($user_details['status']==1){
                $status="Client";
                }
                if($user_details['status']==2){
                $status="Deleted";
                }?>
            <div class="row">
                    <div class="col-lg-12">
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>First Name : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                       <?php echo $user_details['first_name']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Last Name : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['last_name']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Email : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                       <?php echo $user_details['email']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Phone : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['phone']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Business Category : </b>
                                    </div>
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <?php echo $user_details['category_name']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Quality Rating : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['star_rate']?> Star
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>State : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $get_state['name']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>District : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $get_district['name']?>
                                    </div>
                                </div>
                                 <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>City : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['city']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Address : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['address']?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Pincode : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['pincode']?>
                                    </div>
                                </div>
                                <?php if( $user_details['attachments'] != ''){ ?>
                                    <div class="row" style="padding-bottom: 15px;">
                                        <div class="col-lg-4 col-sm-4 col-md-4">
                                            <b>Attachment 1: </b>
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-md-8">
                                            <?php echo $user_details['attachments']?>
                                        </div>
                                    </div>
                                <?php }?>
                                <?php if( $user_details['attachments2'] != ''){ ?>
                                    <div class="row" style="padding-bottom: 15px;">
                                        <div class="col-lg-4 col-sm-4 col-md-4">
                                            <b>Attachment 2: </b>
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-md-8">
                                            <?php echo $user_details['attachments2']?>
                                        </div>
                                    </div>
                                <?php }?>
                                <?php if( $user_details['attachments3'] != ''){ ?>
                                    <div class="row" style="padding-bottom: 15px;">
                                        <div class="col-lg-4 col-sm-4 col-md-4">
                                            <b>Attachment 3: </b>
                                        </div>
                                        <div class="col-lg-8 col-sm-8 col-md-8">
                                            <?php echo $user_details['attachments3']?>
                                        </div>
                                    </div>
                                <?php }?>
                                 <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-4 col-sm-4 col-md-4">
                                        <b>Status : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                      <?php echo $status ?>
                                    </div>
                                </div>
                    </div>
                </div>
