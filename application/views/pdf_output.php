<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
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
                </div>
                <?php
                $total_tax = 0;
                foreach ($taxes as $tax) {
                    $tax_amt = ($amount * $tax['tax_percentage']) / 100;
                    $tax_name = $tax['tax_name'];
                    $tax_data[$tax_name] = $tax_amt;
                    $total_tax += $tax_amt;
                }
                ?>
                <div class="panel-body">
                    <div class="col-md-8 col-md-offset-2" id="printableArea">
                        <div class="panel panel-default" >
                            <div class="panel-heading" style="height: 150px;">
                                <table class="table" width = "100%">
                                    <tr>
                                        <td>
                                            <div class="col-md-6">
                                                <img src = "<?php echo assets_url()?>images/bill/<?php echo $logo?>" width="40%">
                                                <h4><?php echo $company_name;?></h4>
                                                <h5>
                                                    Email: <?php echo $company_email; ?><br>
                                                    Phone: <?php echo $company_phone; ?>
                                                </h5>
                                            </div>
                                        </td>
                                        <td style="text-align:right;">
                                            <div class="col-md-6" style="text-align: right;">
                                                <h2 style="color: #8C1515;"> Receipt </h2>
                                                <h4>Date: <?php echo $paid_date; ?></h4>                                
                                                <h4 style="color:red;"><?php echo $bill_number;?></h4>
                                            </div> 
                                        </td>
                                    </tr>
                                </table><br><br>
                                <table>
                                    <tr>
                                        <td>
                                            <h5 style="line-height: 1.6">
                                                <b>To</b> <br>
                                                <?php echo $name; ?> <br>  
                                                Email: <?php echo $email; ?> <br>
                                                Ph: <?php echo $phone; ?> 
                                            </h5>
                                        </td>    
                                    </tr>
                                </table>
                            </div>
                            <div class="panel-body">
                                <h4><b><u>Payment Details</u></b></h4>
                                <table class="table" width = "100%" style="background: #f1f1f1;border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th  style = "text-align:left;border: 1px solid black;">Payment Code</th>
                                            <th  style = "text-align:left;border: 1px solid black;">Paid date</th>
                                            <th  style = "text-align:left;border: 1px solid black;">Title</th>                                        
                                            <th style = "text-align:right;border: 1px solid black;">Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid black;"><?php echo $payment_code; ?> </td> 
                                            <td style="border: 1px solid black;"><?php echo $paid_date; ?> </td> 
                                            <td style="border: 1px solid black;"><?php echo $title; ?> </td>                                                 
                                            <td style = "text-align:right;border: 1px solid black;"><?php echo number_format($amount - $total_tax); ?></td>
                                        </tr>
                                        <?php
                                        foreach ($tax_data as $tax_d => $value) {
                                            ?>
                                            <tr>
                                                <td style="border: 1px solid black;"></td> 
                                                <td style="border: 1px solid black;"></td> 
                                                <td style="border: 1px solid black;"><?php echo $tax_d; ?> </td>                                                 
                                                <td style = "text-align:right;border: 1px solid black;"><?php echo $value; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        <tr>
                                            <th></th>
                                            <th></th>
                                            <th style = "text-align:left;">Total</th>                                        
                                            <th style = "text-align:right;"><?php echo number_format($amount);  ?>/-</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="clearfix"></div> <br/><br/><br/>
                                
                                <div class="pull-right" style = "text-align:right;">
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
    </div>
</div>