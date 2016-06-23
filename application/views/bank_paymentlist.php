<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
            <li class="active"> Bank Payment</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Manage Bank Payments
            <div class="pull-right">
                        <div class="form-group">
                            <?php if (s('ADMIN_TYPE') == 1) { ?> <a href = "<?php echo base_url() ?>add_bankpayments"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New </button></a><?php } ?>
                        </div>
                    </div>
                </h1>
        </div>
    </div><!--/.row-->
    <?php
    $error = f('error_message') ? f('error_message') : validation_errors();
    if (!empty($error)) {
        echo '<div class="text-center">                                        
                        <div class="alert alert-danger">
                        ' . $error . '
                        </div>                                        
                     </div>';
    }
    ?>
<?php if (f('success_message') != '') : ?>
        <div class="text-center">                                        
            <div class="alert alert-success">
    <?php echo f('success_message'); ?>
            </div>                                        
        </div>
<?php endif; ?>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="height: 100px;">
                    <div class="col-xs-12 col-md-6 col-lg-4">
                        <div class="panel panel-teal panel-widget teal-border">
                            <div class="row no-padding">
                               <div class="col-sm-2 col-lg-2 widget-left">
                                   <i class="fa fa-inr" aria-hidden="true" style="font-size: 36px;"></i>
                                </div>
                                <div class="col-sm-10 col-lg-10 widget-right">
                                    <div class="large" id = ""><?php echo number_format($total_collection) ?></div>  
                                    <div class="text-muted">Total Collection</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-4">
                        <div class="panel panel-blue panel-widget blue-border">
                            <div class="row no-padding">
                                <div class="col-sm-2 col-lg-2 widget-left">
                                   <i class="fa fa-inr" aria-hidden="true" style="font-size: 36px;"></i>
                                </div>
                                <div class="col-sm-10 col-lg-10 widget-right">
                                    <div class="large" id = ""><?php echo number_format($total_bank_amount) ?></div>  
                                    <div class="text-muted">
                                        <?php if (s('ADMIN_TYPE') == 1) { ?> Total Bank Paid <?php } else { ?> Total Cash Received<?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-4">
                        <div class="panel panel-green panel-widget green-border">
                            <div class="row no-padding">
                                <div class="col-sm-2 col-lg-2 widget-left">
                                   <i class="fa fa-inr" aria-hidden="true" style="font-size: 36px;"></i>
                                </div>
                                <div class="col-sm-10 col-lg-10 widget-right">
                                    <div class="large" id = ""><?php echo number_format($balance_amount) ?></div>  
                                    <div class="text-muted">
                                        <?php if (s('ADMIN_TYPE') == 1) { ?> Total Cash in Hand <?php } else { ?> Total Cash in Agents<?php } ?> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                 
                </div>
                <div class = "clearfix"></div>
                <div class="panel-body">
                        <?php echo form_open("", array("id" => "form_report")); ?>
                    <div class="row">
                        <?php if (s('ADMIN_TYPE') == 0) { ?>
                            <div class="col-md-2">
                                <input type = "text" id = "search_name_agent" name = "search_name_agent" class="form-control" placeholder="Agent name" value = "<?php echo set_value('search_name_agent'); ?>">
                                <div class = "suggesstion-box-agent"></div>
                            </div>
                        <?php } ?>
                        <div class="col-md-2"> 
                            <input type = "text" class = "form-control" value = "<?php echo set_value('bank_payment_code'); ?>" name = "bank_payment_code" class = "form-control" placeholder = "Payments Code">
                        </div>
                        <div class="col-md-2"> 
                            <input type = "text" name = "search_user" onkeypress="return numberValidate(event);" class = "form-control"  placeholder="Amount" value = "<?php echo set_value('search_user'); ?>">
                        </div>
                        <div class="col-md-2"> 
                            <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search', date('Y-m-01')); ?>" id = "fromdate_search" readonly="readonly"  style="background:white;" name = "fromdate_search" class = "form-control" placeholder = "From date">
                        </div>
                        <div class="col-md-2"> 
                            <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search', date('Y-m-d')); ?>" id = "todate_search" readonly="readonly" style="background:white;"  name = "todate_search" class = "form-control" placeholder = "To date">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-info">Search</button>
                            <button type="button" class="btn btn-default reportclear" style = "" >Clear</button>
                        </div>
                    </div> 
                    <input type = "hidden" name = "search_result" value = "1">
                    <input type = "hidden" name = "search_agent_id_hidden" id = "search_agent_id_hidden">
                    <input type = "hidden" name = "search_user_id_hidden" id = "search_user_id_hidden">
                    <?php form_close(); ?>
                    <br>
                        <?php if (!empty($details)) { ?>
                        <div class="table-container table-responsive">
                            <?php echo $links; ?>
                            <table class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style = "text-align:center;">#</th>
                                        <?php if (s('ADMIN_TYPE') == 0) { ?>
                                            <th>Agent Name</th>
                                        <?php } ?>
                                        <th style = "text-align:center;"> Payments Date</th> 
                                        <th style = "text-align:center;"> Payments Code</th> 
                                        <th style = "text-align:right;">Amount to bank</th>
                                        <th>Comments</th>
                                        <th style = "text-align:center;"> <?php if (s('ADMIN_TYPE') == 1) { ?> Admin approval status<?php } else { ?>Actions <?php } ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i++;
                                    $bank_payment = 0;
                                    foreach ($details as $data) {
                                        $bank_payment = $bank_payment + $data['bank_payment'];
                                        ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <?php if (s('ADMIN_TYPE') == 0) { ?>
                                                <td><?php echo $data['afirstname'] . ' ' . $data['alastname']; ?></td> 
                                            <?php } ?>
                                            <td style = "text-align:center;"><?php echo date('d-M-Y', strtotime($data['date'])); ?></td>  
                                            <td style = "text-align:center;"><?php echo $data['bank_payment_code']; ?></td>  
                                            <td style = "text-align:right;"><?php echo $data['bank_payment']; ?></td> 
                                            <td>
                                                <?php if ($data['reason'] != '') {
                                                    if (s('ADMIN_TYPE') == 0) { 
                                                        echo '<b>Agent comment - </b>' . $data['reason'];
                                                    }
                                                    else {
                                                        echo '<b>My comment - </b>' . $data['reason'];
                                                    }
                                                }
                                                if ($data['admin_comments'] != '') {
                                                    if (s('ADMIN_TYPE') == 0) { 
                                                        echo '<br><b>My comment - </b>' . $data['admin_comments'];
                                                    }
                                                    else {
                                                        echo '<br><b>Admin comment - </b>' . $data['admin_comments'];
                                                    }
                                                } ?>
                                            </td>
                                            <td style = "text-align:center;">
                                                <?php if (s('ADMIN_TYPE') == 1) {
                                                    if ($data['agree_status'] == 1) {?>
                                                        <span style = "color:green">Adnin received</span>
                                                    <?php } else if ($data['agree_status'] == 2) {?>
                                                        <span style = "color:red">Adnin not received</span>
                                                    <?php } else { ?>  
                                                        <!--<a href="<?php echo base_url(); ?>edit_bankpayments/<?php echo $data['bank_payment_id'] ?>" class="label label-default"><span class="fa fa-pencil"></span> Edit</a>
                                                        <a id="delete" class="label label-danger delete" data-id="<?php echo $data['bank_payment_id'] ?>" data-url="deletebankpayments"><span class="fa fa-trash"></span> Delete</a> -->
                                                        <a type="button" href="javascript: void(0)" class="label label-warning">Pending for admin approval</a>
                                                    <?php } ?>
                                                <?php } else {
                                                    if ($data['agree_status'] == 0) { ?>
                                                        <a href="javascript: void(0)" id="agree_bankpayments"  class="label label-success agree_bankpayment" data-id="<?php echo $data['bank_payment_id'] ?>" data-url="agree_payment">Received</a>
                                                        <a href="javascript: void(0)" id="disagree_bankpayments"  class="label label-danger disagree_bankpayment" data-id="<?php echo $data['bank_payment_id'] ?>" data-url="disagree_payment">Not Received</a>
                                                    <?php } else if ($data['agree_status'] == 1) {?>
                                                        <span style = "color:green">Received</span>
                                                    <?php } else {?>
                                                        <span style = "color:red">Not received</span>                                                            
                                                    <?php } ?>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            <?php if (s('ADMIN_TYPE') == 0) {
                                $colspan = 4; ?><?php } 
                            else {
                                $colspan = 3;
                            } ?>
                                <tr>
                                    <td colspan=<?php echo $colspan; ?> style = "text-align:right;"><b>Total</b></td>
                                    <td style = "text-align:right;"><b><?php echo number_format($bank_payment); ?></b></td>
                                    <td colspan="3"><b>&nbsp;</b></td>
                                </tr>
                            </table>
                        <?php echo $links; ?>
                        </div>
                        <?php
                        } else {
                            echo '<div class="nodata">No records found.</div>';
                        }?> 
                </div> 
            </div>
        </div>
    </div>
</div>