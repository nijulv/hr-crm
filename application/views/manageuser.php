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

            <div class="row" style="padding-bottom:10px;">
                <div class="col-lg-12">
                        <div class="pull-right"><a style="text-decoration: none;padding-right: 20px;" class="btn btn-success" href="<?php echo base_url()?>adduser">Add User</a></div>
                        </div>
           </div>
            <div class="portlet-body">
                <?php if(!empty($results)){
                    $i=1;?>
                <div class="table-container">
                    <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead><tr role="row" class="heading">
                                <th class="no-sort" width="10%">Sl.No</th>
                                <th class="no-sort" width="20%">Name</th>
                                <th class="no-sort" width="20%">Phone</th>
                                <th class="no-sort" width="20%">Email</th>
                                <th class="no-sort" width="10%">Status</th>
                                <th class="no-sort" width="20%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                    <?php foreach($results as $res){?>
                                        <tr role="row" class="heading">
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $res['first_name']?>&nbsp;<?php echo $res['last_name']?></td>
                                            <td><?php echo $res['phone']?></td>
                                            <td><?php echo $res['email']?></td>
                                            <td><?php echo $res['status']?></td>
                                            <td>
                                            <a href="#" class="label label-primary"><i class="fa fa-comment"></i>View</a>
                                            <a href="#" class="label label-default"><span class="fa fa-pencil"></span> Edit</a>
                                            <a href="#" class="label label-danger"><span class="fa fa-trash"></span> Delete</a>
                                        </td>
                                        </tr>
                                <?php $i++; } ?>
                            </tbody>
                    </table>
                </div>
                <?php echo $this->pagination->create_links(); ?>
                <?php } ?>
            </div>
                    
                                    

        </div>	<!--/.main-->