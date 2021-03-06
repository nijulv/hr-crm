<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                <li class="active">Agent Report</li>
            </ol>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Agent Report</h1>
            </div>
        </div>
        <div class="row">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo form_open("",array("id" => "form_report"));?>
                        
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type = "text" name = "search_user" class = "form-control" placeholder="Name or Email" value = "<?php echo set_value('search_user'); ?>">
                            </div>
                            <div class="col-md-3">
                                <select name = "status_search" class = "form-control">
                                    <option value = "" <?php echo  set_select('status_search', ''); ?>>Status</option>
                                    <option value = "1" <?php echo  set_select('status_search', '1'); ?>>Active</option>
                                    <option value = "2" <?php echo  set_select('status_search', '2'); ?>>Inactive</option>
                                </select> 
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('fromdate_search');?>" id = "fromdate_search" readonly="readonly"  style="background:white;" name = "fromdate_search" placeholder = "From date">
                            </div>
                            <div class="col-md-3">
                                <input type = "text" class = "form-control" value = "<?php echo set_value('todate_search');?>" id = "todate_search" readonly="readonly" style="background:white;"  name = "todate_search" placeholder = "To date">
                            </div>  
                        </div> &nbsp;
                        <div class="col-md-12">
                            <div class="col-md-3">
                                <input type = "text" name = "search_code" class = "form-control" placeholder="Code Number" value = "<?php echo set_value('search_code'); ?>">
                            </div>
                            <div class="col-md-3">
                               <?php if(!empty($state_details)){?>
                                <select name="state" id="state" class="form-control" >
                                    <option value="">Select State</option>
                                  <?php foreach($state_details as $res){?> 
                                    <option <?php echo  set_select('state',$res['id'], False); ?> value="<?php echo $res['id']; ?>"><?php echo $res['name']; ?></option>
                                  <?php } ?>
                                </select>
                               <?php }?>
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('search_district');?>" id = "search_district" name = "search_district" placeholder = "District">
                                 <div class = "suggesstion-box"></div>
                            </div>
                            <div class="col-md-3">
                                 <input type = "text" class = "form-control" value = "<?php echo set_value('search_city');?>" id = "search_city" name = "search_city"  placeholder = "City">
                            </div>  &nbsp;
                        </div> <br/>
                        <button type="submit" class="btn btn-info" style = " margin-left: 43%;" >Search</button>
                        <button type="button" class="btn btn-default reportclear" style = "" >Clear</button><br>
                         <?php echo form_close(); ?>
                        <br>
                        <?php if (!empty($details)) { 
                            $details_values = base64_encode(serialize($details));?>
                        <div class = "form-group pull-right">
                            <form name="excel_agent_report" id="excel_agent_report" role="form" method="post"  novalidate="novalidate" class="form-horizontal" action="<?php echo base_url(); ?>excel_agent_report">
                            <button class="btn btn-primary" onclick="printDiv('printableArea')"><i class="fa fa-print"></i> Print</button>
                                <input type = "hidden" name = "details_values"  id = "details_values" value = "<?php echo $details_values;?>" >
                            <button id = "export_excel_submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i> Export excel</button>
                            </form>
                        </div>
                        <div class="row">  
                            <div class = "col-md-12">
                                <div class="table-container table-responsive" id="printableArea">  
                                    <?php echo $links; ?> 
                                    <table class="table table-bordered table-striped table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th style = "text-align:center;">#</th>
                                                <th style = "text-align:center;">Agent Code</th>
                                                <th>Name</th>
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
                                                    $status = '<b>Active</b>';
                                                    $color = 'green';
                                                }
                                                else {
                                                    $status = 'Inactive';
                                                    $color = 'red';
                                                }
                                                ?>
                                                <tr>
                                                    <td style = "text-align:center;"><?php echo $i++; ?></td>
                                                    <td style = "text-align:center;"><?php echo $data['agent_code'];?></td>
                                                    <td><?php echo $data['first_name'].' '.$data['last_name'];?></td> 
                                                    <td><?php echo $data['phone'];?></td>
                                                    <td><?php echo $data['state'];?></td>
                                                    <td><?php echo $data['districts'];?></td>
                                                    <td><?php echo $data['city'];?></td>
                                                    <td style = "text-align:center;"><?php echo $status;?></td>
                                                    <td style = "text-align:center;">
                                                        <a href="javascript: void(0)" class="label label-primary more" data-from="agent" data-id="<?php echo $data['agent_id']; ?>" ><i class="fa fa-list"></i> View More</a>
                                                        <a href="javascript: void(0)" class="label label-warning viewuserlist" data-from="agentuserlist" data-id="<?php echo $data['agent_id']; ?>" data-name="<?php echo $data['first_name'].' '.$data['last_name']; ?>" ><i class="fa fa-list"></i> User list</a>
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

<script type="text/javascript">

    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
    
</script>