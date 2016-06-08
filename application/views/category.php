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
                                
                            </div>
                           </div>
                        </div>
                    </div>
                    </div>
                    <div class="panel-body">
                        <?php  echo form_open("", array("class" => "form_category")); ?>
                        <div class="row">
                            <div class="col-md-4">
                                <input type = "text" id = "category_name" name = "category_name" class = "form-control"  placeholder="Category Name" value = "<?php echo set_value('category_name'); ?>"><div class="validation_msg"></div>  
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-info savecategory">Save</button>
                            </div>
                        </div> 
                        <input type = "hidden" name = "category_id" id = "category_id" value = "">
                        <?php echo form_close();?>
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
                                        foreach ($details as $data) { ?>
                                            <tr>
                                                <td style = "text-align:center;"><?php echo $i++; ?></td>
                                                <td><?php echo $data['category_name'];?></td>
                                                <td style = "text-align:center;">
                                                    <a title="Modify"href="javascript: void(0)" data-name="<?php echo $data['category_name']?>" data-id="<?php echo $data['category_id']?>" class="label label-default edit_caterory"><span class="fa fa-pencil"></span>  Edit</a>
                                                    <a  title="Delete" id="delete" class="label label-danger delete" data-id="<?php echo $data['category_id']?>" data-url="deletecategory"><span class="fa fa-trash"></span>  Delete</a>
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