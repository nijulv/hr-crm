<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active"> Bank Payment</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Bank Payments</h1>
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
            }?>
        <?php if ( f('success_message') != '' ) :?>
            <div class="text-center">                                        
                <div class="alert alert-success">
                    <?php echo f('success_message');?>
                </div>                                        
            </div>
        <?php endif;?>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="col-sm-8 col-lg-8 col-md-8 hidden-xs">
                        List Bank Payments details
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <a href = "<?php echo base_url()?>add_bankpayments"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New </button></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                         <?php echo form_open("",array("id" => "form_report"));?>
                        <div class="row">
                            <div class="col-md-2">
                                 <select name="search_name" id="state" class="form-control">
                                    <option value="">client/prospect</option>
                                  <?php if($userlist){
                                        foreach($userlist as $res){?> 
                                            <option value="<?php echo $res['user_id']; ?>" <?php echo set_select('search_name', $res['user_id'], False); ?> ><?php echo $res['first_name'].' '.$res['last_name']; ?></option>
                                  <?php } }?>
                                </select>
                            </div>
                            <div class="col-md-2"> 
                                 <input type = "text" name = "search_user" onkeypress="return numberValidate(event);" class = "form-control"  placeholder="Amount" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                <div class="col-md-2">
                                     <select name="search_name_agent" id="state" class="form-control">
                                        <option value="">Select Agent</option>
                                      <?php if($agentlist){
                                            foreach($agentlist as $res){?> 
                                                <option value="<?php echo $res['agent_id']; ?>" <?php echo set_select('search_name_agent', $res['agent_id'], False); ?> ><?php echo $res['first_name'].' '.$res['last_name']; ?></option>
                                      <?php } }?>
                                    </select>
                                </div>
                            <?php }?>
                            <div class="col-md-2"> 
                                <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search', date('Y-m-01'));?>" id = "fromdate_search" readonly="readonly"  style="background:white;" name = "fromdate_search" class = "form-control" placeholder = "From date">
                            </div>
                            <div class="col-md-2"> 
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search',date('Y-m-t'));?>" id = "todate_search" readonly="readonly" style="background:white;"  name = "todate_search" class = "form-control" placeholder = "To date">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Search</button>
                                <button type="button" class="btn btn-default reportclear" style = "" >Clear</button>
                            </div>
                        </div> 
                        <input type = "hidden" name = "search_result" value = "1">
                        <?php form_close(); ?>
                        <br>
                        <?php if (!empty($details)) { ?>
                        <div class="table-container table-responsive">
                            <?php echo $links; ?>
                            <table class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style = "text-align:center;">#</th>
                                        <?php if(s('ADMIN_TYPE') == 0){ ?>
                                            <th>Agent Name</th>
                                        <?php }?>
                                        <th> Client Name</th>
                                        <th>Total Payment</th>
                                        <th>Bank Payment</th>
                                        <th>Reason</th>
                                        <th style = "text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;    
                                    $Total_payment = 0;
                                    $Total_bank_payment = 0;
                                    foreach ($details as $data) {   
                                        $Total_payment = $Total_payment + $data['total_payment'];
                                        $Total_bank_payment = $Total_bank_payment + $data['bank_payment'];
                                        $username = array();
                                        $usernames = '';
                                        $names = '';
                                    
                                        $userids = $data['user_id']; 
                                        $user_id =  (explode(",",$userids)); //print_r($user_id);
                                        if($user_id){
                                            foreach ($user_id as $id){
                                                $username[] = get_username($id); 
                                            }
                                        }
                                        if($username){   
                                            foreach ($username as $name){
                                                $names .= $name['first_name'].' '.$name['last_name'] .',';
                                            }
                                        }  
                                        $usernames = rtrim($names, ","); ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                                <td><?php echo $data['afirstname'].' '.$data['alastname'];?></td> 
                                            <?php }?>
                                            <td><?php echo $usernames;?></td> 
                                            <td><?php echo $data['total_payment'];?></td> 
                                            <td><?php echo $data['bank_payment'];?></td>
                                            <td><?php echo $data['reason'];?></td>
                                            <td style = "text-align:center;">
                                                <a href="<?php echo base_url(); ?>edit_bankpayments/<?php echo $data['bank_payment_id'] ?>" class="label label-default"><span class="fa fa-pencil"></span> Edit</a>
                                                <a id="delete" class="label label-danger delete" data-id="<?php echo $data['bank_payment_id']?>" data-url="deletebankpayments"><span class="fa fa-trash"></span> Delete</a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                                <?php if(s('ADMIN_TYPE') == 0){ $colspan = 3;?><?php } else { $colspan = 2; }?>
                                <tr>
                                    <td colspan=<?php echo $colspan;?> style = "text-align:right;"><b>Total</b></td>
                                    <td ><b><?php echo $Total_payment;?></b></td>
                                    <td ><b><?php echo $Total_bank_payment;?></b></td>
                                    <td colspan="2"><b>&nbsp;</b></td>
                                </tr>
                            </table>
                            <?php echo $links; ?>
                        </div>
                        <?php } else {
                            echo '<div class="nodata">Sorry! There is no details available now.</div>';
                        } ?> 
                    </div> 
                </div>
            </div>
        </div>
    </div>