<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active">Collection Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Collection Report</h1>
            </div>
        </div>
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("",array("id" => "form_report"));?>
                        
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type = "text" name = "search_user" class = "form-control" placeholder="Client name" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                            <div class="col-md-3">
                                <input type = "text" name = "search_title" class = "form-control" placeholder="Title or amount" value = "<?php echo set_value('search_title'); ?>">
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
                         <?php if (!empty($details)) { 
                             $details_values = base64_encode(serialize($details));?>
                        <div class = "form-group pull-right">
                            <form name="excel_report" id="excel_report" role="form" method="post"  novalidate="novalidate" class="form-horizontal" action="<?php echo base_url(); ?>excel_payment_report">
                            <button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                                <input type = "hidden" name = "details_values"  id = "details_values" value = "<?php echo $details_values;?>" >
                            <button id = "export_excel_submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export excel</button>
                            </form>
                        </div>
                        <div class="row">  
                            <div class = "col-md-12">
                            <div class="table-container table-responsive" id="printableArea">  
                                <?php echo $links; ?> 
                            <table class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style = "text-align:center;">#</th>
                                        <?php if(s('ADMIN_TYPE') == 0){ ?>
                                            <th>Agent Name</th>
                                        <?php }?>
                                        <th>Payment Code</th>
                                        <th>Client Name</th>
                                        <th style = "text-align:center;">Payment Date</th>
                                        <th>Payment Title</th>
                                        <th style="text-align: right">Amount</th>
                                        <th style = "text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;  
                                    $Total_amount = 0;
                                    foreach ($details as $data) { 
                                        $Total_amount = $Total_amount + $data['amount'];?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                                <td><?php if($data['afirstname'] != ''){ echo $data['afirstname'].' '.$data['alastname'];}else {echo 'Admin';}?></td> 
                                            <?php }?>
                                             <td><?php echo $data['payment_code'];?></td>
                                            <td><?php echo $data['first_name'].' '.$data['last_name'];?></td> 
                                            <td style = "text-align:center;"><?php echo date('d-M-Y', strtotime($data['date']));?></td>
                                            <td><?php echo $data['title'];?></td>     
                                            <td style="text-align: right"><?php echo number_format($data['amount']);?></td>
                                            <td style = "text-align:center;">
                                                <a href="javascript: void(0)" class="label label-primary more" data-from="payment" data-id="<?php echo $data['payment_id']; ?>" ><i class="fa fa-list"></i> View More</a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                                <tr>
                                   <?php if(s('ADMIN_TYPE') == 0){ $colspan = 6;?><?php } else { $colspan = 5; }?>
                                    <td colspan = <?php echo $colspan;?>  style = "text-align:right;"><b>Total Amount</b></td>
                                    <td style = "text-align:right;"><b><?php echo number_format($Total_amount);?></b></td>
                                    <td ><b>&nbsp;</b></td>
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

<script type="text/javascript">

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>