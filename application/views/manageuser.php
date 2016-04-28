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
                    <div class="pull-right text-center"><a style="text-decoration: none;padding-top: 10px;" class="btn btn-primary" href="<?php echo base_url()?>adduser"><i class="fa fa-plus"></i> Add New User</a></div>
                </div>
           </div>
            <div class="portlet-body">
                <?php if(!empty($results)){
                    $i=1;?>
                <div class="panel-body">
                <div class="table-container table-responsive">
                    <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead><tr role="row" class="heading">
                                <th class="no-sort" width="5%" style = "text-align:center;">Sl.No</th>
                                <th class="no-sort" width="20%">Name</th>
                                <th class="no-sort" width="20%">Phone</th>
                                <th class="no-sort" width="25%">Email</th>
                                <th class="no-sort" width="10%" style = "text-align:center;">Status</th>
                                <th class="no-sort" width="20%" style = "text-align:center;">Action</th>
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
                                            <td style = "text-align:center;"><?php echo $i;?></td>
                                            <td><?php echo $res['first_name']?>&nbsp;<?php echo $res['last_name']?></td>
                                            <td><?php echo $res['phone']?></td>
                                            <td><?php echo $res['email']?></td>
                                            <td style = "text-align:center;color:<?php echo  $color;?>"><?php echo $status;?></td>
                                            <td style = "text-align:center;">
                                                <a href="<?php echo base_url() ?>viewuser/<?php echo $res['user_id']?>" class="label label-primary"><i class="fa fa-list"></i>View</a>
                                                <a href="<?php echo base_url() ?>edituser/<?php echo $res['user_id']?>" class="label label-default edit" id="edit"><span class="fa fa-pencil"></span> Edit</a>
                                                <a id="delete" class="label label-danger delete" data-id="<?php echo $res['user_id']?>" data-url="deleteuser"><span class="fa fa-trash"></span> Delete</a>
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

        
 
