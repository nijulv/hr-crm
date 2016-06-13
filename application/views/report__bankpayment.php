<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active">Bank Statement</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bank Statement</h1>
            </div>
        </div>
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("",array("id" => "form_report"));?>
                        
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type = "text" id = "payment_code" name = "payment_code" class = "form-control" placeholder="Payment Code" value = "<?php echo set_value('payment_code'); ?>">
                                <div class = "suggesstion-box"></div>
                            </div>
                            <div class="col-md-3">
                                <input type = "text" name = "search_amount" class = "form-control" placeholder="amount" value = "<?php echo set_value('search_amount'); ?>">
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search');?>" id = "fromdate_search" readonly="readonly" style="background:white;"  name = "fromdate_search" class = "form-control" placeholder = "From date">
                            </div>
                            <div class="col-md-3">
                                <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search');?>" id = "todate_search" readonly="readonly" style="background:white;"  name = "todate_search" class = "form-control" placeholder = "To date">
                            </div>  
                        </div> 
                        &nbsp;<br/>
                        <button type="submit" class="btn btn-info" style = " margin-left: 43%;" >Search</button>
                        <button type="button" class="btn btn-default reportclear" style = "" >Clear</button><br>
                         <?php echo form_close(); ?>
                        <br>
                        <div class="form-group pull-right">
                            <button name="print" class="btn btn-default" onclick="#"><i class="fa fa-print"></i> Print</button>
                            <button name="print" class="btn btn-info" onclick="#"><i class="fa fa-share-square"></i> Share</button>
                            <button name="print" class="btn btn-success" onclick="#"><i class="fa fa-file-excel-o"></i> Export excel</button>

                        </div>
                        <?php if (!empty($details)) { ?>
                        <div class="row">  
                            <div class = "col-md-12">
                            <div class="table-container table-responsive">  
                                <?php echo $links; ?> 
                            <table class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style = "text-align:center;">#</th>
                                        <?php if(s('ADMIN_TYPE') == 0){ ?>
                                            <th>Agent Name</th>
                                        <?php }?>
                                        <th>Payment Code</th>
                                        <th style = "text-align:center;"> Payments Date</th> 
                                         <th style="text-align: right">Amount To Bank</th>
                                        <th style="text-align: right">Amount In Hand</th>
                                        <th>Comments</th>
                                        <th style = "text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;  
                                    $Total_bank_payment = 0;
                                    $Total_amount_hand = 0;
                                    foreach ($details as $data) { 
                                        $Total_bank_payment = $Total_bank_payment + $data['bank_payment'];
                                        $Total_amount_hand = $Total_amount_hand + $data['amount_hand'];?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                                <td><?php echo $data['afirstname'].' '.$data['alastname'];?></td> 
                                            <?php }?>
                                             <td><?php echo $data['bank_payment_code'];?></td>
                                             <td style = "text-align:center;"><?php echo date('d-M-Y', strtotime($data['date']));?></td>
                                            <td style="text-align: right"><?php echo number_format($data['bank_payment']);?></td>
                                            <td style="text-align: right"><?php echo number_format($data['amount_hand']);?></td>
                                             <td><?php echo $data['reason'];?></td>
                                            <td style = "text-align:center;">
                                                <a href="javascript: void(0)" class="label label-primary more" data-from="bank_payment" data-id="<?php echo $data['bank_payment_id']; ?>" ><i class="fa fa-list"></i> View More</a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                                <tr>
                                   <?php if(s('ADMIN_TYPE') == 0){ $colspan = 4;?><?php } else { $colspan = 3; }?>
                                    <td colspan = <?php echo $colspan;?>  style = "text-align:right;"><b>Total Amount</b></td>
                                    <td style = "text-align:right;"><b><?php echo number_format($Total_bank_payment);?></b></td>
                                    <td style = "text-align:right;"><b><?php echo number_format($Total_amount_hand);?></b></td>
                                    <td colspan = "2"><b>&nbsp;</b></td>
                                </tr>
                            </table>
                             <?php echo $links; ?> 
                            </div>
                        </div>
                        <?php } else {
                            echo '<div class="nodata">No records found.</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>