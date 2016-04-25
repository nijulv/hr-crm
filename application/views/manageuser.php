<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Manage User</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Manage User</h1>
                </div>
            </div><!--/.row-->
            <?php if ( f('success_message') != '' ) :?>
            <div class="text-center">                                        
                <div class="alert alert-success">
                    <?php echo f('success_message');?>
                </div>                                        
            </div>
            <?php endif;?>
            <div class="panel panel-default">
            <div class="row" style="padding:10px;">
                <div class="col-lg-12" a style="padding-top: 10px;">
                    <div class="pull-right text-center"><a style="text-decoration: none;padding-top: 10px;" class="btn btn-success" href="<?php echo base_url()?>adduser">Add User</a></div>
                </div>
           </div>
            <div class="portlet-body">
                <?php if(!empty($results)){
                    $i=1;?>
                <div class="panel-body">
                <div class="table-container table-responsive">
                    <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead><tr role="row" class="heading">
                                <th class="no-sort" width="5%">Sl.No</th>
                                <th class="no-sort" width="20%">Name</th>
                                <th class="no-sort" width="20%">Phone</th>
                                <th class="no-sort" width="25%">Email</th>
                                <th class="no-sort" width="10%">Status</th>
                                <th class="no-sort" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($results as $res){?>
                                        <?php if($res['status']==0){
                                            $status="Guest";
                                            $color = 'blue';
                                        }
                                        if($res['status']==1){
                                            $status="User";
                                             $color = 'green';
                                        }
                                        if($res['status']==2){
                                        $status="Deleted";
                                        }?>
                                        <tr role="row" class="heading">
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $res['first_name']?>&nbsp;<?php echo $res['last_name']?></td>
                                            <td><?php echo $res['phone']?></td>
                                            <td><?php echo $res['email']?></td>
                                            <td style = "color:<?php echo  $color;?>"><?php echo $status;?></td>
                                            <td>
                                            <a href="<?php echo base_url() ?>viewuser/<?php echo $res['user_id']?>" class="label label-primary"><i class="fa fa-comment"></i>View</a>
                                            <a href="<?php echo base_url() ?>edituser/<?php echo $res['user_id']?>" class="label label-default"><span class="fa fa-pencil"></span> Edit</a>
                                            <a onclick="return confirm('Are you sure you want to delete this User details?');" href="<?php echo base_url() ?>deleteuser/<?php echo $res['user_id']?>" class="label label-danger"><span class="fa fa-trash"></span> Delete</a>
                                        </td>
                                        </tr>
                                <?php $i++; } ?>
                            </tbody>
                    </table>
                </div>
                </div>
                <?php echo $this->pagination->create_links(); ?>
                <?php }
                else {
                        echo '<div class="alert alert-warning">Sorry! There is no details available now.</div>';
                     } ?>
            </div>
            </div>      
                                    

        </div>	<!--/.main-->