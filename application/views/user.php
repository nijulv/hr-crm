<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Marshall Leadership Consulting</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/datepicker3.css" rel="stylesheet">
        <!--<link href="css/styles.css" rel="stylesheet">-->
        <link href="css/bootstrap-table.css" rel="stylesheet">
        <link href="css/marshall.css" rel="stylesheet">
        <!-- Font-awesome  -->
        <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
        <link href="css/bootstrap-datetimepicker.css" rel="stylesheet" type="text/css">
        <!--Icons-->
        <script src="js/lumino.glyphs.js"></script>
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"></a>
                    <ul class="user-menu">
                        <li class="dropdown pull-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>Welcome Marshall <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
                                <li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li>
                                <li><a href="#"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div><!-- /.container-fluid -->
        </nav>

        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
            <div class="logo" align="center">
                <img src="images/logo_small2.png" class="img-responsive">
            </div>

            <ul class="nav menu"> 
                <li><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
                <li class="active"><a href="schedule.html"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Manage Schedule</a></li>
                <li><a href="clients.html"><svg class="glyph stroked male user "><use xlink:href="#stroked-male-user"/></svg> Manage Clients</a></li>
                <li><a href="manage-payment.html"><svg class="glyph stroked tag"><use xlink:href="#stroked-tag"/></svg> Manage Payments</a></li>
                <li><a href="manage-invoice.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Manage Invoices</a></li>
                <li><a href="ehr.html"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Manage EHR </a></li>
                <li role="presentation" class="divider"></li>
                <li><a href="index.html"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
            </ul>

        </div><!--/.sidebar-->

        <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="index.html"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Scheduler</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Scheduler</h1>
                </div>
            </div><!--/.row-->


            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            My Calender
                            <button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal"> <i class="fa fa-calendar"></i> Create New Appointment</button>
                        </div>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <iframe src="https://www.google.com/calendar/embed?mode=WEEK&height=600&wkst=1&bgcolor=%23FFFFFF&color=%232952A3&ctz=America%2FToronto" style=" border-width:0 " width="100%" height="600" frameborder="0" scrolling="no"></iframe>
                            </div>

                        </div>
                    </div>

                </div>
            </div><!--/.row-->	



        </div><!--/.main-->

        <script src="js/jquery-1.11.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/chart.min.js"></script>
        <script src="js/chart-data.js"></script>
        <script src="js/easypiechart.js"></script>
        <script src="js/easypiechart-data.js"></script>
        <script src="js/bootstrap-datepicker.js"></script>
        <script src="js/bootstrap-table.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>
        <script src="js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
                $('#datetimepicker4').datetimepicker();
                $('#datetimepicker2').datetimepicker({
                    viewMode: 'years'
                });
                $('#datetimepicker3').datetimepicker({
                    viewMode: 'years',
                    format: 'MM/YYYY'
                });
            });

            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>

    </body>

</html>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Create New Appointment</h4>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Select Client</label>
                        <select class="form-control">
                            <option value="">Allen John</option>
                            <option value="">Brian</option>
                            <option value="">Max</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>From</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>To</label>
                        <div class='input-group date' id='datetimepicker4'>
                            <input type='text' class="form-control" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Create</button>
            </div>
        </div>
    </div>
</div>