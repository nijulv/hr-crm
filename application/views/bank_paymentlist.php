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
                        <div class="col-sm-8 col-lg-8 col-md-8 hidden-xs" style = "display:none;">
                        List Bank Payments details
                        </div>
                        <div class="pull-right">
                            <div class="form-group">
                                <?php if(s('ADMIN_TYPE') == 1){ ?> <a href = "<?php echo base_url()?>add_bankpayments"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New </button></a><?php }?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                         <?php echo form_open("",array("id" => "form_report"));?>
                        <div class="row">
                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                <div class="col-md-2">
                                    <input type = "text" name = "search_name_agent" class="form-control" placeholder="Agent name" value = "<?php echo set_value('search_name_agent'); ?>">
                                     
                                </div>
                            <?php }?>
                            <div class="col-md-2">
                                <input type = "text" name = "search_user" class="form-control" placeholder="Client/Prospect name" value = "<?php echo set_value('search_user'); ?>">
                                 
                            </div>
                            <div class="col-md-2"> 
                                 <input type = "text" name = "search_user" onkeypress="return numberValidate(event);" class = "form-control"  placeholder="Amount" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                            <div class="col-md-2"> 
                                <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search', date('Y-m-01'));?>" id = "fromdate_search" readonly="readonly"  style="background:white;" name = "fromdate_search" class = "form-control" placeholder = "From date">
                            </div>
                            <div class="col-md-2"> 
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search',date('Y-m-d'));?>" id = "todate_search" readonly="readonly" style="background:white;"  name = "todate_search" class = "form-control" placeholder = "To date">
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
                                        <th style = "text-align:center;"> Payments Date</th> 
                                        <th style = "text-align:right;">Amount to bank</th>
                                        <th style = "text-align:right;">Amount in hand</th>
                                        <th>Comments</th>
                                        <th style = "text-align:center;"> <?php if(s('ADMIN_TYPE') == 1){ ?> Admin approval status<?php }else {?>Actions <?php }?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;    
                                    $bank_payment = 0;
                                    $amount_hand = 0;
                                    foreach ($details as $data) {   
                                        $bank_payment = $bank_payment + $data['bank_payment'];
                                        $amount_hand = $amount_hand + $data['amount_hand']; ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                                <td><?php echo $data['afirstname'].' '.$data['alastname'];?></td> 
                                            <?php }?>
                                            <td style = "text-align:center;"><?php echo date('d-M-Y', strtotime($data['date']));?></td>  
                                            <td style = "text-align:right;"><?php echo $data['bank_payment'];?></td> 
                                            <td style = "text-align:right;"><?php echo $data['amount_hand'];?></td>
                                            <td><?php echo $data['reason'];?> <?php if($data['admin_comments'] != ''){ echo '  <br/><b>Admin comment - </b>'.$data['admin_comments']; }?></td>
                                            <td style = "text-align:center;">
                                                <?php if(s('ADMIN_TYPE') == 1){ 
                                                    if($data['agree_status'] == 1){?>
                                                        <span style = "color:green">Adnin approved</span>
                                                    <?php } 
                                                    else if($data['agree_status'] == 2){?>
                                                        <span style = "color:red">Adnin rejected</span>

                                                    <?php } else {?>  
                                                        <!--<a href="<?php echo base_url(); ?>edit_bankpayments/<?php echo $data['bank_payment_id'] ?>" class="label label-default"><span class="fa fa-pencil"></span> Edit</a>
                                                        <a id="delete" class="label label-danger delete" data-id="<?php echo $data['bank_payment_id']?>" data-url="deletebankpayments"><span class="fa fa-trash"></span> Delete</a> -->
                                                        <a type="button" href="javascript: void(0)" class="label label-warning">Pending</a>
                                                    <?php }?>
                                                <?php } else {
                                                            if($data['agree_status'] == 0){?>
                                                                    <a href="javascript: void(0)" id="agree_bankpayments"  class="agree_bankpayment" data-id="<?php echo $data['bank_payment_id']?>" data-url="agree_payment"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a> &nbsp;&nbsp;
                                                                    <a href="javascript: void(0)" id="disagree_bankpayments"  class="disagree_bankpayment" data-id="<?php echo $data['bank_payment_id']?>" data-url="disagree_payment"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
                                                            <?php } 
                                                            else if($data['agree_status'] == 1){?>
                                                                <span style = "color:green">Approved</span>
                                                            <?php } 
                                                            else {?>
                                                                <span style = "color:red">Rejected</span>                                                            
                                                            <?php }?>
                                                <?php }?>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                                <?php if(s('ADMIN_TYPE') == 0){ $colspan = 3;?><?php } else { $colspan = 2; }?>
                                <tr>
                                    <td colspan=<?php echo $colspan;?> style = "text-align:right;"><b>Total</b></td>
                                    <td style = "text-align:right;"><b><?php echo number_format($bank_payment);?></b></td>
                                    <td style = "text-align:right;"><b><?php echo number_format($amount_hand);?></b></td>
                                    <td colspan="2"><b>&nbsp;</b></td>
                                </tr>
                            </table>
                            <?php echo $links; ?>
                        </div>
                        <?php } else {
                            echo '<div class="nodata">No records found.</div>';
                        } ?> 
                    </div> 
                </div>
            </div>
        </div>
    </div>