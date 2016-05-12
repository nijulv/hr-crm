<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Invoice Copy</li>
            </ol>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Invoice Copy</h1>
            </div>
        </div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Invoice copy of <?php echo $name; ?>
                        <div class="pull-right">
                            <form>
                                <div class="form-group">
                                    <button name="print" class="btn btn-default" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print Invoice</button>

                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="col-md-8 col-md-offset-2" id="printableArea">
                            <div class="panel panel-default" style="border: #ccc dashed 2px;">
                                <div class="panel-heading" style="height: 180px;">
                                    <div class="col-md-6">
                                        <h4>HR-CRM</h4>
                                        <h5>Email: <?php echo $admin_email;?><br>Phone: <?php echo $admin_phone;?></h5>
                                    </div>
                                    <div class="col-md-6" style="text-align: right;">
                                        <h2 style="color: #8C1515;">INVOICE</h2>
                                        <h4>Date: <?php echo date('d-M-Y');?></h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <h5 style="line-height: 1.6">
                                        <b>To</b> <br>
                                        <?php echo $name; ?> <br>  
                                        Email: <?php echo $email; ?> <br>
                                        Ph: <?php echo $phone; ?> 
                                    </h5>

                                    <h4>Payment Details</h4><hr>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Contact Number</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $title; ?> </td> 
                                                <td><?php echo $phone; ?></td>
                                                <td><?php echo $amount; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <div class="clearfix"></div>
                                    <center><h3 class="bg-primary" style="padding: 10px;">Have a nice day!</h3></center>

                                    <div class="">
                                        <p>Place: ---------------</p>
                                        <p>Date: ----------------</p>
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