<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.html"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Manage Bank Payments</li>
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
                        List Bank Payments details
                        </div>
                        
                        <div class="pull-right">
                            <div class="form-group">
                                <a href = "<?php echo base_url()?>add_bankpayments"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New Bank Payment</button></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <?php if (!empty($details)) { ?>
                            <?php echo $links; ?>
                        <div class="table-container table-responsive">
                            <table class="table table-bordered table-striped table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th style = "text-align:center;">#</th>
                                        <th>Users</th>
                                        <th>Total Payment</th>
                                        <th>Bank Payment</th>
                                        <th>Reason</th>
                                        <th style = "text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;    
                                    foreach ($details as $data) {                                       
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
                                        $usernames = rtrim($names, ","); 
                                         
                                    ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
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