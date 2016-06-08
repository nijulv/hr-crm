<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active">Business Category</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Business Category</h1>
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
                <div class="panel panel-default">
                    <div class="row">
                    <div class="panel-heading" style="padding-bottom: 10px;">
                       <div class="col-sm-8 col-lg-8 col-md-8 hidden-xs" style = "display:none;">
                        List  details
                       </div>
                        <div class="pull-right">
                           <div class="col-sm-4 col-lg-4 col-md-4" >
                            <div class="form-group">
                                <a href = "<?php echo base_url()?>add_agents"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New </button></a>
                            </div>
                           </div>
                        </div>
                    </div>
                    </div>
                    <div class="panel-body">
                        <?php echo form_open("",array("id" => "form_report"));?>
                        <div class="row">
                            <div class="col-md-4">
                                <input type = "text" name = "search_user" class = "form-control"  placeholder="Name" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                           
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info">Search</button>
                            </div>
                        </div> 
                        <?php form_close(); ?>
                        <br>
                        <?php if (!empty($details)) { ?>
                        <div class="row">
                            <div class = "col-md-12">
                                <div class="table-container table-responsive">
                                    <?php echo $links; ?>
                                <table class="table table-bordered table-striped table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th style = "text-align:center;">#</th>
                                            <th>Category Name</th>
                                            <th style = "text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i++;  
                                        foreach ($details as $data) { 
                                            if($data['status'] == 1){
                                                $status = 'Active';
                                                $changestatus='Inactivate';

                                                $style = 'label label-warning';
                                                $color = 'green';
                                            }
                                            else {
                                                $status = 'Inactive';
                                                $changestatus='Activate';

                                                $style = 'label label-success';
                                                $color = 'red';
                                            } ?>
                                            <tr>
                                                <td style = "text-align:center;"><?php echo $i++; ?></td>
                                                <td><span class="label label-default">Code: <?php echo $data['agent_code'];?> </span>&nbsp;&nbsp; <?php echo $data['first_name'].' '.$data['last_name'];?></td> 
                                                <td><?php echo $data['phone'];?></td>
                                                <td><?php echo $data['state'];?></td>
                                                <td><?php echo $data['district'];?></td>
                                                <td><?php echo $data['city'];?></td>
                                                <td style = "text-align:center;color:<?php echo  $color;?>"><?php echo $status;?></td>
                                                <td style = "text-align:center;">
                                                    <a title="Modify status"  id="status" class="<?php echo $style?> status" data-id="<?php echo $data['agent_id']?>" data-url="changestatus"  data-status="<?php echo $changestatus ?>"><?php echo $changestatus ?></a>
                                                    <a title="Modify"href="<?php echo base_url(); ?>edit_agents/<?php echo $data['agent_id'] ?>" class="label label-default"><span class="fa fa-pencil"></span>  Edit</a>
                                                    <a  title="Delete" id="delete" class="label label-danger delete" data-id="<?php echo $data['agent_id']?>" data-url="deleteagent"><span class="fa fa-trash"></span>  Delete</a>
                                                </td>
                                            </tr>
                                        <?php }?>
                                    </tbody>
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