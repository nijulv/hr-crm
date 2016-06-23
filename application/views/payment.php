<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active">Collection</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Collection</h1>
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
            }
        ?>
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
                        List Clients and their collections
                        </div>
                        
                        <div class="pull-right">
                            <div class="form-group">
                                <?php if (s('ADMIN_TYPE') == 1) { ?><a href = "<?php echo base_url()?>add_payments"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New</button></a><?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body"> 
                        <?php echo form_open("",array("id" => "form_report"));?>
                        <div class="row">
                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                <div class="col-md-2">
                                    <input type = "text" name = "search_name_agent" id = "search_name_agent" class="form-control" placeholder="Agent name" value = "<?php echo set_value('search_name_agent'); ?>">
                                    <div class = "suggesstion-box-agent"></div>
                                </div>
                            <?php }?>
                            <div class="col-md-2">
                                <input type = "text" name = "search_name" id = "search_user" class="form-control" placeholder="Client/Prospect name" value = "<?php echo set_value('search_name'); ?>">
                                 <div class = "suggesstion-box"></div>
                            </div>
                            <div class="col-md-2"> 
                                 <input type = "text" name = "search_user" class = "form-control"  placeholder="Title or Amount" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                            <div class="col-md-2"> 
                                <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search', date('Y-m-01'));?>" id = "fromdate_search" readonly="readonly"  style="background:white;" name = "fromdate_search" placeholder = "From date">
                            </div>
                            <div class="col-md-2"> 
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search',date('Y-m-d'));?>" id = "todate_search" readonly="readonly" style="background:white;"  name = "todate_search" placeholder = "To date">
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
                                        <?php if(s('ADMIN_TYPE') == 0){ ?>
                                            <th>Agent Name</th>
                                        <?php }?>
                                        <th> Client Name</th>
                                        <th>Payment Code</th>
                                        <th>Payment Title</th>
                                        <th style = "text-align:center;">Payment Date</th>
                                        <th style = "text-align:right;">Amount</th>
                                        <th style = "text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;  
                                    $Total_amount = 0;
                                    foreach ($details as $data) {
                                        $Total_amount = $Total_amount + $data['amount'];
                                        ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <?php if(s('ADMIN_TYPE') == 0){ ?>
                                                <td><?php if($data['afirstname'] != ''){echo $data['afirstname'].' '.$data['alastname'];} else {echo 'Admin';}?></td> 
                                            <?php }?>
                                            <td><?php echo $data['first_name'].' '.$data['last_name'];?></td> 
                                            <td><?php echo $data['payment_code'];?></td>
                                            <td><?php echo $data['title'];?></td> 
                                            <td style = "text-align:center;"><?php echo date('d-M-Y', strtotime($data['date']));?></td>
                                            <td  style = "text-align:right;"><?php echo number_format($data['amount']);?></td>
                                            <td style = "text-align:center;">
                                                <a href="javascript: void(0)" data-id="<?php echo $data['payment_id']?>" class="label label-success generate_invoice"><i class="fa fa-file-text-o" aria-hidden="true"></i> Invoice</a>
                                                <!--<a href="<?php echo base_url(); ?>edit_payments/<?php echo $data['payment_id'] ?>" class="label label-default"><span class="fa fa-pencil"></span> Edit</a>
                                                <a id="delete" class="label label-danger delete" data-id="<?php echo $data['payment_id']?>" data-url="deletepayments"><span class="fa fa-trash"></span> Delete</a> -->
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
                        <?php } else {
                            echo '<div class="nodata">No records found.</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>