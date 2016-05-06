<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Payment Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Payment Report</h1>
            </div>
        </div>
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("",array("id" => "payment_report"));?>
                        
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type = "text" name = "search_user" class = "form-control" placeholder="Name,Email,Phone" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                            <div class="col-md-3">
                                <select name = "status_search" class = "form-control">
                                    <option value = "" <?php echo  set_select('status_search', ''); ?>>Status</option>
                                    <option value = "1" <?php echo  set_select('status_search', '1'); ?>>Active</option>
                                    <option value = "2" <?php echo  set_select('status_search', '2'); ?>>Deactive</option>
                                </select> 
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search');?>" id = "fromdate_search" name = "fromdate_search" class = "form-control" placeholder = "From date">
                            </div>
                            <div class="col-md-3">
                                <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search');?>" id = "todate_search" name = "todate_search" class = "form-control" placeholder = "To date">
                            </div>  
                        </div> 
                        &nbsp;<br/>
                        <button type="submit" class="btn btn-info" style = " margin-left: 43%;" >Search</button><br>
                         <?php echo form_close(); ?>
                        <br>
                        <?php if (!empty($details)) { ?>
                        <div class="row">  
                            <div class="table-container table-responsive">  
                                <?php echo $links; ?> 
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
                                    foreach ($details as $data) { ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <td><?php echo $data['first_name'].' '.$data['last_name'];?></td> 
                                            <td><?php echo $data['title'];?></td>
                                            <td><?php echo $data['amount'];?></td>
                                            <td><?php echo $data['phone'];?></td>
                                            <td style = "text-align:center;">
                                                <a href="javascript: void(0)" class="label label-primary more" data-from="payment" data-id="<?php echo $data['payment_id']; ?>" ><i class="fa fa-list"></i>View More</a>
                                            </td>
                                        </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                             <?php echo $links; ?> 
                            </div>
                        </div>
                        <?php } else {
                            echo '<div class="alert alert-warning">Sorry! There is no details available now.</div>';
                        } ?>
                    </div>
                </div>
            </div>
    </div>