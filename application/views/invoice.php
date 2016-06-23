<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() ?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
            <li class="active">Bill</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bill Copy</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Bill copy of <b><?php echo $name; ?></b>
                    <div class="pull-right">
                        <form>
                            <div class="form-group">
                                <button type="reset" id="btnCancel_payment" class="btn btn-default">Back</button>
                                <button name="print" class="btn btn-info" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                //p($taxes);
                $total_tax = 0;
                foreach ($taxes as $tax) {
                    $tax_amt = ($amount * $tax['tax_percentage']) / 100;
                    $tax_name = $tax['tax_name'];
                    $tax_data[$tax_name] = $tax_amt;
                    $total_tax += $tax_amt;
                }
                //p($tax_data);
                ?>
                <div class="panel-body">
                    <div class="col-md-8 col-md-offset-2" id="printableArea">
                        <div class="panel panel-default" style="border: #ccc dashed 2px; background: #f1f1f1;" >
                            <div class="panel-heading" style="height: 150px;">
                                <div class="col-md-6">
                                    <img src = "<?php echo assets_url()?>images/bill/<?php echo $logo?>" width="40%">
                                    <h4><?php echo $company_name;?></h4>
                                    <h5>
                                        Email: <?php echo $company_email; ?><br>
                                        Phone: <?php echo $company_phone; ?>
                                    </h5>
                                </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <h2 style="color: #8C1515;"> Receipt </h2>
                                    <h4>Date: <?php echo $paid_date; ?></h4>                                
                                    <h4 style="color:red;"><?php echo $bill_number;?></h4>
                                </div>
                            </div>
                            <div class="panel-body">
                                <h5 style="line-height: 1.6">
                                    <b>To</b> <br>
                                    <?php echo $name; ?> <br>  
                                    Email: <?php echo $email; ?> <br>
                                    Ph: <?php echo $phone; ?> 
                                </h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="4" style="text-align:center;"><h4><b>Payment Details</b></h4></th>
                                        </tr>
                                        <tr>
                                            <th>Payment Code</th>
                                            <th>Paid date</th>
                                            <th>Title</th>                                        
                                            <th style = "text-align:right;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $payment_code; ?> </td> 
                                            <td><?php echo $paid_date; ?> </td> 
                                            <td><?php echo $title; ?> </td>                                                 
                                            <td style = "text-align:right;"><?php echo number_format($amount - $total_tax); ?></td>
                                        </tr>
                                        <?php
                                        foreach ($tax_data as $tax_d => $value) {
                                            ?>
                                            <tr>
                                                <td></td> 
                                                <td></td> 
                                                <td><?php echo $tax_d; ?> </td>                                                 
                                                <td style = "text-align:right;"><?php echo $value; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>                                        
                                            <th style = "text-align:right;"><?php echo number_format($amount);  ?>/-</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="clearfix"></div> <br/><br/><br/>
                                
                                <div class="pull-right">
                                    <p>Sign/Seal: ---------------</p> 
                                </div> <br>
                                <div class="col-md-12">
                                    <?php echo $footer_content;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/.row-->	
</div><!--/.main-->


<script type="text/javascript">

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>