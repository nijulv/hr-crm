<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard - <span id = "date_range" style = "font-size:30px;font-style: italic;">current year</span></h1>
                    <div class="pull-right">
                        <input type="text" id="dashboard_fromdate" name = "dashboard_fromdate" class = "" value = "<?php echo set_value('dashboard_fromdate');?>" readonly="readonly"  style="background:white;" placeholder = "From date" />
                        <input type="text" id="dashboard_todate" name = "dashboard_todate" class = "" value = "<?php echo set_value('dashboard_todate');?>" readonly="readonly"  style="background:white;" placeholder = "To date" />
                         
                       <button type="button" class="btn btn-success" id = "dashboard_count_search">Go</button>
                    </div>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-orange panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="fa fa-briefcase" aria-hidden="true" style="font-size: 55px;"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large" id = "tot_agents"><?php echo $agent_count;?></div>  
                                <div class="text-muted">Total Agents</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-blue panel-widget ">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">                                
                                <i class="fa fa-trophy" aria-hidden="true" style="font-size: 55px;"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large" id = "tot_clients"><?php echo $users_count;?></div>
                                <div class="text-muted">Total Clients</div>
                            </div>
                        </div>
                    </div>
                </div>                
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-teal panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="fa fa-users" aria-hidden="true" style="font-size: 55px;"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large" id = "tot_prospects"><?php echo $guest_count;?></div>
                                <div class="text-muted">Total Prospects</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-widget" style="background: #51B911 !important; color: #fff !important;">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="fa fa-money" aria-hidden="true" style="font-size: 55px;"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><i class="fa fa-inr" aria-hidden="true"></i> <span id = "tot_payments"><?php if($payment_count){echo number_format($payment_count); }else {echo '0';}?> </span></div>  
                                <div class="text-muted">Total Payments</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Clients and Prospects in last 6 months
                            <div class="pull-right" style="font-size:11px;">
                                <span style="background-color: #30A4FF;padding: 0px 14px;"></span> &nbsp; Clients &nbsp;&nbsp;
                                <span style=" background-color: #B9D1E3;padding: 0px 14px;"></span> &nbsp; Prospects
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-info" id="todo-panel">
                        <div class="panel-heading dark-overlay" >
                            <div class="col-md-6">
                                <span class="pull-left"><i class="fa fa-list-alt" aria-hidden="true" style="font-size: 25px"></i> To-do Notes</span>  
                            </div>
                            <div class="col-md-6">
                                <form>
                                    <input type = "text" id = "todo_search" class = "form-control tododate_search" name = "tododate_search" value = "<?php echo date('Y-m-d'); ?>" readonly="readonly" style="background:white;" >
                                </form>
                            </div>
                            
                        </div>
                        <div class="panel-body scroll" style = "height: 145px;">
                            <ul class="todo-list" id ="todo_list" >
                                <?php if($todo){?>
                                    <?php foreach($todo as $res){
                                        if($res['status'] == 'Completed'){
                                            $label_color = 'label-success';
                                        }
                                        else if($res['status'] == 'Pending'){
                                            $label_color = 'label-danger';
                                        }
                                        else {
                                            $label_color = 'label-warning';
                                        }
                                        ?>
                                    <li class="todo-list-item" id='<?php echo $res['id']; ?>' style = "border-bottom: #F1F4F7 solid 1px;">
                                        <div class="checkbox">
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                            <label for="checkbox"><?php echo $res['todo']; ?>    </label>
                                        </div>
                                        <div class="pull-right action-buttons">
                                            <span class="label <?php echo $label_color; ?>" style="padding: 0.1em 0.4em 0.1em;"> <?php echo $res['status']; ?></span>
                                            <a href="javascript: void(0)" data-id="<?php echo $res['id']; ?>" data-url='edittodo' title="Edit" class="edittodo"><i class="fa fa-pencil" aria-hidden="true"></i></a> &nbsp;
                                            
                                            <a href="javascript: void(0)" data-id="<?php echo $res['id']; ?>" data-url='deletetodo' title="Delete" class="trash deletetodo"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </div>
                                    </li>
                                <?php } } else {?>
                                    <li class="todo-list-item" style = "border-bottom: #F1F4F7 solid 1px;">
                                        <div style = "text-align:center;color:red;font-weight:bold;font-size: 16px;">
                                           Today no notes found. 
                                        </div>    
                                    </li>
                                <?php }?>    
                            </ul>
                        </div>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="todo" name="todo" type="text" class="form-control input-md" placeholder="Type a note here">
                                <span class="input-group-btn">
                                   <button  class="btn btn-primary btn-md" id="btn-todo"  style="height: 44px;">Add Note</button>
                                </span>
                            </div>
                        </div>
                        <div class = "alert alert-danger shedule" style = "display:none;"></div>
                    </div>
                </div>
            </div><!--/.row-->
            
            <!-- Add Note pop up -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">Select date and time</h4>
                        </div>
                        <div class="modal-body">
                            <!--<input id="main_calendar" name="main_calendar" type="date" name="calendar" class="form-control input-md" data-date-format="yyyy-mm-dd" placeholder="Date" readonly>-->

                            <div class='input-group datetimepicker1' id='datetimepicker1'>
                                <input type='text' class="form-control" name="main_calendar" id="main_calendar" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                         </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id ="save" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Note pop up ends -->
            
            <!-- Edit Note pop up -->
                <div id="editModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                 <h4 class="modal-title">Select date and time</h4>
                            </div>
                            <div class="modal-body" id="todocontent">
                                
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Note : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <input id="todoid_edit" name="todoid" type="hidden" class="form-control input-md space" value="">
                                        <input id="todotext_edit" name="todotext" type="text" class="form-control input-md space" value="">
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Date : </b>
                                    </div> 
                                    <div class="col-lg-8 col-sm-8 col-md-8" >
                                        <div class='input-group datetimepicker1' id='datetimepicker1'>
                                            <input type='text' class="form-control" name="popup_calender" id="popup_calender" value=""/>
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom: 15px;">
                                    <div class="col-lg-3 col-sm-3 col-md-3">
                                        <b>Status : </b>
                                    </div>
                                    <div class="col-lg-8 col-sm-8 col-md-8">
                                        <select name = "todostatus_edit" id = "todostatus_edit" class= "form-control">
                                            <option value = "Pending">Pending</option>
                                            <option value = "Partially completed">Partially completed</option>
                                            <option value = "Completed">Completed</option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" id ="updatetodo" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>
             <!-- Edit Note pop up ends -->
             
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Converted Prospects</h4>
                            <div class="easypiechart" id="easypiechart-blue" data-percent= "<?php echo $Converted_Prospects; ?>" >
                                <span class="percent" id = "tot_convert_prospect"><?php echo $Converted_Prospects; ?>%</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>New Clients</h4>
                            <div class="easypiechart" id="easypiechart-orange" data-percent="<?php echo $new_clents_day; ?>" >
                                <span class="percent"><?php echo $new_clents_day; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>New Prospects</h4>  
                            <div class="easypiechart" id="easypiechart-teal" data-percent="<?php echo $new_prospect_day; ?>" >
                                <span class="percent"><?php echo $new_prospect_day; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Active Agents Today</h4>
                            <div class="easypiechart" id="easypiechart-red" data-percent="<?php echo $active_agents_today; ?>" >
                                <span class="percent"><?php echo $active_agents_today; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->


        </div>	<!--/.main-->
 
