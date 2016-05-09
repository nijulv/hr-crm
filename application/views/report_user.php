<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Users/Clients Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Users/Clients Report</h1>
            </div>
        </div>
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("",array("id" => "client_report"));?>
                        
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type = "text" name = "search_user" class = "form-control" placeholder="Name,Email,Phone" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                            <div class="col-md-3">
                                <select name = "status_search" class = "form-control">
                                    <option value = "" <?php echo  set_select('status_search', ''); ?>>All</option>
                                    <option value = "1" <?php echo  set_select('status_search', '1'); ?>>User</option>
                                    <option value = "0" <?php echo  set_select('status_search', '0'); ?>>Client</option>
                                </select> 
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search');?>" id = "fromdate_search" name = "fromdate_search" class = "form-control" placeholder = "From date">
                            </div>
                            <div class="col-md-3">
                                <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search');?>" id = "todate_search" name = "todate_search" class = "form-control" placeholder = "To date">
                            </div>  
                        </div>    &nbsp;
                        <div class="col-md-12"  style = "display:none;">
                            <div class="col-md-3">
                               <?php if(!empty($state_details)){?>
                                <select name="state" id="state" class="form-control" >
                                    <option value="">Select</option>
                                  <?php foreach($state_details as $res){?> 
                                    <option <?php echo  set_select('state',$res['id'], False); ?> value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                                  <?php } ?>
                                </select>
                               <?php }?>
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('search_district');?>" id = "search_district" name = "search_district" class = "form-control" placeholder = "District">
                                 <div class = "suggesstion-box"></div>
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('search_district');?>" id = "fromdate_searcha" name = "search_district" class = "form-control" placeholder = "">
                                 
                            </div>
                            <div class="col-md-3">
                                <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search');?>" id = "todate_search" name = "todate_search" class = "form-control" placeholder = "To date">
                            </div>   &nbsp;
                        </div> <br/>
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
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>State</th>
                                        <th>District</th>
                                        <th>City</th>
                                        <th style = "text-align:center;">Status</th>
                                        <th style = "text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $i++;  
                                    foreach ($details as $data) { 
                                        if($data['status'] == 1){
                                            $status = 'User';
                                            $color = 'green';
                                        }
                                        else {
                                            $status = 'Client';
                                            $color = '#5AC0DD';
                                        }
                                        ?>
                                        <tr>
                                            <td style = "text-align:center;"><?php echo $i++; ?></td>
                                            <td><?php echo $data['first_name'].' '.$data['last_name'];?></td> 
                                            <td><?php echo $data['email'];?></td>
                                            <td><?php echo $data['phone'];?></td>
                                            <td><?php echo $data['state'];?></td>
                                            <td><?php echo $data['districts'];?></td>
                                            <td><?php echo $data['city'];?></td>
                                            <td style = "text-align:center;"><?php echo $status;?></td>
                                            <td style = "text-align:center;">
                                                <a href="javascript: void(0)" class="label label-primary more" data-from="user" data-id="<?php echo $data['user_id']; ?>" ><i class="fa fa-list"></i>View More</a>
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