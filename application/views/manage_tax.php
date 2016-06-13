<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active">Tax</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Tax</h1>
            </div>
        </div><!--/.row-->
        <div class="err_msg" style="display:none;"></div> 
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
                                    <a href = "javascript: void(0)" class = "addnewtax"><button class="btn btn-primary"><i class="fa fa-plus"></i> Add New</button></a>
                                </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row" style = "display:none;" id = "adddiv">
                            <?php  echo form_open("", array("class" => "form_tax")); ?>
                            <div class="col-md-4">
                                <input type = "text" id = "tax_name" name = "tax_name" class = "form-control"  placeholder="Tax Name" value = "<?php echo set_value('tax_name'); ?>"><div class="validation_msg"></div>  
                            </div>
                            <div class="col-md-4">
                                <input type = "text" id = "tax_percentage" name = "tax_percentage" class = "form-control"  placeholder="Value" value = "<?php echo set_value('tax_percentage'); ?>"><div class="validation_msg"></div>  
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info savetax">Save</button>
                            </div>
                            <input type = "hidden" name = "tax_id" id = "tax_id" value = "">
                            <?php echo form_close();?>
                        </div> 
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
                                            <th>Name</th>
                                            <th>Value</th>
                                            <th style = "text-align:center;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i++;  
                                        foreach ($details as $data) { ?>
                                            <tr>
                                                <td style = "text-align:center;"><?php echo $i++; ?></td>
                                                <td><?php echo $data['tax_name'];?></td>
                                                <td><?php echo $data['tax_percentage'];?></td>
                                                <td style = "text-align:center;">
                                                    <a title="Modify"href="javascript: void(0)" data-value="<?php echo $data['tax_percentage']?>" data-name="<?php echo $data['tax_name']?>" data-id="<?php echo $data['id']?>" class="label label-default edit_tax"><span class="fa fa-pencil"></span>  Edit</a>
                                                    <a  title="Delete" id="delete" class="label label-danger delete" data-id="<?php echo $data['id']?>" data-url="deletetax"><span class="fa fa-trash"></span>  Delete</a>
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