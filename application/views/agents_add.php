<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
            <div class="row">
                <ol class="breadcrumb">
                    <li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
                    <li class="active">Add Agent</li>
                </ol>
            </div><!--/.row-->

            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add Agent</h1>
                </div>
            </div><!--/.row-->
            <?php
                    $error = f('error_message') ? f('error_message') : validation_errors();
                    if(!empty($error)){
                        echo '<div class="text-center">                                        
                                <div class="alert alert-danger">
                                '.$error.'
                                </div>                                        
                             </div>';
                    }
                ?>
                <?php if ( f('success_message') != '' ) :?>
                    <div class="text-center">                                        
                        <div class="alert alert-success">
                            <?php echo f('success_message');?>
                        </div>                                        
                    </div>
                <?php endif;?>
             <?php echo form_open(base_url() . "add_agents",array("id" => "agents"));?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Agent code <small class="text-muted"></small></label>
                                        <input type="text" name="agent_code" class="form-control" placeholder="Agent Code" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" name="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <div class="form-group">
                                        <label>First name</label>
                                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Last name</label>
                                        <input type="text" name="last_name" class="form-control" placeholder="Last Name">
                                    </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control" placeholder="Email" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Address <small class="text-muted"></small></label>
                                        <textarea class="form-control" name="address" style="height: 150px !important;"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Pincode</label>
                                        <input type="text" name="pincode" class="form-control" placeholder="Pin code">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Add Agents">
                                    </div>
                                 <?php echo form_close();?> 
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/.row-->	
        </div><!--/.main-->