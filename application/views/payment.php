<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="index.html"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                <li class="active">Manage Payments</li>
            </ol>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Manage Payments</h1>
            </div>
        </div><!--/.row-->

        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        List Clients and their Payments
                        
                        <div class="pull-right">
                            <div class="form-group">
                                <button class="btn btn-primary"><i class="fa fa-comment"></i> Add New Payment</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="exampleInputName2">Select Client &nbsp;&nbsp;&nbsp;</label>
                                <select name="" class="form-control" style="width: 280px;">
                                    <option value = "">Select Client</option>
                                    <?php if($users){
                                        foreach ($users as $user) { ?>
                                    <option value = "<?php echo $user['user_id']?>"><?php echo $user['first_name'].' '.$user['last_name']?></option>
                                        <?php }}?>
                                </select>
                            </div>
                            &nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                        <br>
                        <table class="table table-bordered table-striped table-hover table-responsive">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client ID</th>
                                    <th>Name</th>
                                    <th>Email ID</th>
                                    <th>Contact Number</th>
                                    <th>Payment History</th>

                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>C9090</td>
                                    <td>Allen John</td>
                                    <td>allenjohn@ymail.com</td>
                                    <td>+65 60413685</td>
                                    <td>
                                        <a href="payment-add.html" class="label label-primary"><span class="fa fa-plus"></span> Add</a>
                                        <a href="payment-list.html" class="label label-info"><span class="fa fa-list"></span> Summary</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>C9091</td>
                                    <td>Brian</td>
                                    <td>brian222@ymail.com</td>
                                    <td>+65 60413995</td>
                                    <td>
                                        <a href="payment-add.html" class="label label-primary"><span class="fa fa-plus"></span> Add</a>
                                        <a href="payment-list.html" class="label label-info"><span class="fa fa-list"></span> Summary</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>C9093</td>
                                    <td>Max</td>
                                    <td>maxx00@ymail.com</td>
                                    <td>+65 60400685</td>
                                    <td>
                                        <a href="payment-add.html" class="label label-primary"><span class="fa fa-plus"></span> Add</a>
                                        <a href="payment-list.html" class="label label-info"><span class="fa fa-list"></span> Summary</a>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination pagination-sm pull-right">
                                <li>
                                    <a href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                <li><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li>
                                    <a href="#" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
    </div>