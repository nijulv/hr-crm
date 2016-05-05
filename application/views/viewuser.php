<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">View User</li>
                </ol>
            </div><!--/.row-->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View User</h1>
                </div>
            </div><!--/.row-->
            <?php if(!empty($user_details)){?>
            <?php if($user_details['status']==0){
                $status="Guest";
                }
                if($user_details['status']==1){
                $status="User";
                }
                if($user_details['status']==2){
                $status="Deleted";
                }?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>First Name : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['first_name']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Last Name : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['last_name']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Email : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['email']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Phone : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['phone']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>State : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $get_state['name']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>District : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $get_district['name']; ?>
                                    </div>
                                </div>
                                 <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>City : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['city']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Address : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['address']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Pincode : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['pincode']; ?>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Attachment : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $user_details['attachments']; ?>
                                    </div>
                                </div>
                                 <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Status : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <?php echo $status; ?>
                                    </div>
                                </div>
                                 <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b> </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <form action="<?php echo base_url() ?>manageuser">
                                         <button type="submit" class="btn btn-default">Back to list</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            <?php } ?>
</div>