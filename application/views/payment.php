<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.html"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Manage Payments</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Payments</h1>
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
                        <div class="col-sm-8 col-lg-8 col-md-8 hidden-xs">
                        List Clients and their Payments
                        </div>
                        
                        <div class="pull-right">
                            <div class="form-group">
                                <a href = "<?php echo base_url()?>add_payments"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Payment</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open("",array("id" => "payment"));?>
                            <div class="form-group">
                                <label for="exampleInputName2">Select Client &nbsp;&nbsp;&nbsp;</label>
                                <select name="search_user" class="form-control" style="width: 280px;">
                                    <option value = "">Select Client</option>
                                    <?php if($users){
                                        foreach ($users as $user) { ?>
                                    <option value = "<?php echo $user['user_id']?>" ><?php echo $user['first_name'].' '.$user['last_name']?></option>
                                        <?php }}?>
                                </select>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-info">Search</button><br>
                        <?php form_close(); ?>
                        <br>
                        <?php if (!empty($details)) { ?>
                            <?php echo $links; ?>
                        <div class="table-container table-responsive">
                            <table class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style = "text-align:center;">#</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Amount</th>
                                        <th>Contact Number</th>
                                        <th style = "text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;  
                                    foreach ($details as $data) {   
                                        ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <td><?php echo $data['first_name'].' '.$data['last_name'];?></td> 
                                            <td><?php echo $data['title'];?></td>
                                            <td><?php echo $data['amount'];?></td>
                                            <td><?php echo $data['phone'];?></td> 
                                            <td style = "text-align:center;">
                                                <a href="<?php echo base_url(); ?>edit_payments/<?php echo $data['payment_id'] ?>" class="label label-default"><span class="fa fa-pencil"></span> Edit</a>
                                                <a id="delete" class="label label-danger delete" data-id="<?php echo $data['payment_id']?>" data-url="deletepayments"><span class="fa fa-trash"></span> Delete</a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <?php } else {
                            echo '<div class="alert alert-warning">Sorry! There is no details available now.</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>