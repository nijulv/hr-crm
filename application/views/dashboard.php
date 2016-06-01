<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="<?php echo base_url()?>dashboard"><i class="fa fa-home" aria-hidden="true" style="font-size: 20px;"></i></a></li>
                    <li class="active">Dashboard</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
            </div><!--/.row-->

            <div class="row">
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-blue panel-widget ">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="fa fa-calendar" aria-hidden="true" style="font-size: 55px;"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><?php echo $users_count;?></div>
                                <div class="text-muted">Total Users</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-orange panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="fa fa-yelp" aria-hidden="true" style="font-size: 55px;"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><?php echo $agent_count;?></div>  
                                <div class="text-muted">Total Agents</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-3">
                    <div class="panel panel-teal panel-widget">
                        <div class="row no-padding">
                            <div class="col-sm-3 col-lg-5 widget-left">
                                <i class="fa fa-user" aria-hidden="true" style="font-size: 55px;"></i>
                            </div>
                            <div class="col-sm-9 col-lg-7 widget-right">
                                <div class="large"><?php echo $guest_count;?></div>
                                <div class="text-muted">Total Guests</div>
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
                                <div class="large"><?php if($payment_count){echo '$ '.number_format($payment_count); }else {echo '$ 0';}?></div>  
                                <div class="text-muted">Payments</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">Appointments in last 6 months</div>
                        <div class="panel-body">
                            <div class="canvas-wrapper">
                                <canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-info" id="todo-panel">
                        <div class="panel-heading dark-overlay">
                            <i class="fa fa-list-alt" aria-hidden="true" style="font-size: 25px"></i> To-do List (Today's Appointments)
                        </div>
                        <?php if($todo){?>
                        <div class="panel-body scroll">
                            <ul class="todo-list">
                                <?php foreach($todo as $res){?>
                                <li class="todo-list-item" id='<?php echo $res['id']; ?>'>
                                    <div class="checkbox">
                                        <input type="checkbox" id="checkbox">
                                        <label for="checkbox"><?php echo $res['todo']; ?></label>
                                    </div>
                                    <div class="pull-right action-buttons">
                                        <a data-id="<?php echo $res['id']; ?>" data-url='edittodo' title="Edit" class="edittodo"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                        <!-- <a href="#" class="flag"><i class="fa fa-flag-o" aria-hidden="true"></a> -->
                                        <a data-id="<?php echo $res['id']; ?>" data-url='deletetodo' title="Delete" class="trash deletetodo"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                    </div>
                                </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <?php } ?>
                        <div class="panel-footer">
                            <div class="input-group">
                                <input id="todo" name="todo" type="text" class="form-control input-md" placeholder="Add new schedule">
                                <span class="input-group-btn">
                                   <button  class="btn btn-primary btn-md" id="btn-todo"  style="height: 44px;">Add</button>
                                </span>
                            </div>
                        </div>
                        <div class = "alert shedule" style = "display:none;background-color:#CC0921;color:#fff;"></div>
                    </div>
                </div>
            </div><!--/.row-->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">To do</h4>
                        </div>
                        <div class="modal-body">

                            <input id="main_calendar" name="main_calendar" type="date" name="calendar" class="form-control input-md" data-date-format="yyyy-mm-dd" placeholder="Date" readonly>
                           
                         </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id ="save" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                             <h4 class="modal-title">To do</h4>
                        </div>
                        <div class="modal-body" id="todocontent">
                            
                         </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id ="updatetodo" data-dismiss="modal">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Finished Appointments</h4>
                            <div class="easypiechart" id="easypiechart-blue" data-percent="80" ><span class="percent">80</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Positive Feedback</h4>
                            <div class="easypiechart" id="easypiechart-orange" data-percent="99" ><span class="percent">99</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>New Clients/Day</h4>
                            <div class="easypiechart" id="easypiechart-teal" data-percent="10" ><span class="percent">10</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6 col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-body easypiechart-panel">
                            <h4>Visitors/Day</h4>
                            <div class="easypiechart" id="easypiechart-red" data-percent="27" ><span class="percent">27</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->


        </div>	<!--/.main-->
 
