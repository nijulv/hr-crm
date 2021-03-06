<?php
// more details
if ($from == "agent") { ?>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <td style="border-top: 1px solid #FFF ! important;">Name: </td>
                <td style="border-top: 1px solid #FFF ! important;"><?php echo $result['first_name'] . ' ' . $result['last_name']; ?></td>
            </tr>
            <tr>
                <td>Email: </td>
                <td><?php echo $result['email']; ?></td>
            </tr>
            <tr>
                <td>Phone Number: </td>
                <td><?php echo $result['phone']; ?></td>
            </tr>
            <tr>
                <td>Agent Code: </td>
                <td><?php echo $result['agent_code']; ?></td>
            </tr>
            <tr>
                <td>Username: </td>
                <td><?php echo $result['username']; ?></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><?php echo $result['password']; ?></td>
            </tr>
            <tr>
                <td>State: </td>
                <td><?php echo $result['state']; ?></td>
            </tr>
            <tr>
                <td>District: </td>
                <td><?php echo $result['districts']; ?></td>
            </tr>
            <tr>
                <td>City: </td>
                <td><?php echo $result['city']; ?></td>
            </tr>
            <tr>
                <td>Address: </td>
                <td><?php echo $result['address']; ?></td>
            </tr>
            <tr>
                <td>Pincode: </td>
                <td><?php echo $result['pincode']; ?></td>
            </tr>
            <tr>
                <td>Status: </td> <?php if($result['status'] == '1') { $status = 'Active';} else { $status = 'Inactive';}?>
                <td><?php echo $status; ?></td>
            </tr>
            <tr style="border-bottom: 1px solid #FFF ! important;">
                <td>Created Date: </td>
                <?php if($result['date'] == '0000-00-00'){
                    $date = '';
                }
                else {
                    $date = date('d-M-Y', strtotime($result['date']));
                }
                ?>
                <td><?php echo $date;?></td>
            </tr>
        </table>
    </div>

    <?php } else if ($from == "payment") { ?>
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <td colspan="2" style="border-top: 1px solid #FFF ! important;"><b>User Details</b></td>
                </tr>
                <tr>
                    <td>Name: </td>
                    <td><?php echo $result['first_name'] . ' ' . $result['last_name']; ?></td>
                </tr>
                <tr>
                    <td>Contact Number: </td>
                    <td><?php echo $result['phone']; ?></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?php echo $result['email']; ?></td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td><?php echo $result['state']; ?></td>
                </tr>
                <tr>
                    <td>District: </td>
                    <td><?php echo $result['districts']; ?></td>
                </tr>
                <tr>
                    <td>City: </td>
                    <td><?php echo $result['city']; ?></td>
                </tr>
                <tr>
                    <td>Pin code: </td>
                    <td><?php echo $result['pincode']; ?></td>
                </tr>
                <tr>
                    <td>Address: </td>
                    <td><?php echo $result['address']; ?></td>
                </tr>
                <tr>
                    <td>Quality Rating: </td>
                    <td><?php echo $result['star_rate'].' Star'; ?></td>
                </tr>
                <tr>
                    <td>Business Category: </td>
                    <td><?php echo $result['category_name']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" ><b>Payment Details</b></td>
                </tr>
                <tr>
                    <td>Title: </td>
                    <td><?php echo $result['title']; ?></td>
                </tr>
                <tr>
                    <td>Amount: </td>
                    <td><?php echo $result['amount']; ?></td>
                </tr>
                <tr>
                    <td>Description: </td>
                    <td><?php echo $result['comments']; ?></td>
                </tr>
                <tr style="border-bottom: 1px solid #FFF ! important;">
                    <td>Date: </td>
                    <?php if($result['date'] == '0000-00-00'){
                        $date = '';
                    }
                    else {
                        $date = date('d-M-Y', strtotime($result['date']));
                    }
                    ?>
                    <td ><?php echo $date;?></td>
                </tr>
            </table>
        </div>
    <?php } else if ($from == "bank_payment") { ?>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <td style="border-top: 1px solid #FFF ! important;">Payment Code: </td>
                        <td style="border-top: 1px solid #FFF ! important;"><?php echo $result['bank_payment_code']; ?></td>
                    </tr>
                    <tr>
                        <td>Amount To Bank: </td>
                        <td><?php echo number_format($result['bank_payment']); ?></td>
                    </tr>
                    <tr>
                        <td>Comments: </td>
                        <td><?php echo $result['reason']; ?></td>
                    </tr>
                    <tr>
                        <td>Admin Status: </td> <?php if($result['agree_status'] == '0') { $status = 'Pending for admin approval';} else if($result['agree_status'] == '2') { $status = 'Admin not received';} else { $status = 'Admin Received';}?>
                        <td><?php echo $status; ?></td>
                    </tr>
                    <tr>
                        <td>Admin Comments: </td> 
                        <td><?php echo $result['admin_comments']; ?></td>
                    </tr>
                    <tr style="border-bottom: 1px solid #FFF ! important;">
                        <td>Payment Date: </td>
                        <?php if($result['date'] == '0000-00-00'){
                            $date = '';
                        }
                        else {
                            $date = date('d-M-Y', strtotime($result['date']));
                        }
                        ?>
                        <td><?php echo $date;?></td>
                    </tr>
                </table>
            </div>
    <?php } else if ($from == "user") {?>
            <div class="table-responsive">
            <table class="table">
                <tr>
                    <td style="border-top: 1px solid #FFF ! important;">Name: </td>
                    <td style="border-top: 1px solid #FFF ! important;"><?php echo $result['first_name'] . ' ' . $result['last_name']; ?></td>
                </tr>
                <tr>
                    <td>Phone Number: </td>
                    <td><?php echo $result['phone']; ?></td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td><?php echo $result['email']; ?></td>
                </tr>
                <tr>
                    <td>State: </td>
                    <td><?php echo $result['state']; ?></td>
                </tr>
                <tr>
                    <td>District: </td>
                    <td><?php echo $result['districts']; ?></td>
                </tr>
                <tr>
                    <td>City: </td>
                    <td><?php echo $result['city']; ?></td>
                </tr>
                <tr>
                    <td>Address: </td>
                    <td><?php echo $result['address']; ?></td>
                </tr>
                <tr>
                    <td>Pin code: </td>
                    <td><?php echo $result['pincode']; ?></td>
                </tr>
                <tr>
                    <td>Quality Rating: </td>
                    <td><?php echo $result['star_rate'].' Star'; ?></td>
                </tr>
                <tr>
                    <td>Business Category: </td>
                    <td><?php echo $result['category_name']; ?></td>
                </tr>
                <?php if($result['attachments'] != '') {?>
                    <tr>
                        <td>Attachment 1: </td>
                        <td><?php echo $result['attachments']; ?></td>
                    </tr>
                <?php }
                if($result['attachments2'] != '') {?>
                    <tr>
                        <td>Attachment 2: </td>
                        <td><?php echo $result['attachments2']; ?></td>
                    </tr>
                <?php }
                if($result['attachments3'] != '') {?>
                    <tr>
                        <td>Attachment 3: </td>
                        <td><?php echo $result['attachments3']; ?></td>
                    </tr>
                <?php }?>
                <tr>
                    <td>Status: </td> <?php if($result['status'] == '1') { $status = 'Client';} else { $status = 'Prospect';}?>
                    <td><?php echo $status; ?></td>
                </tr>
                <tr>
                    <td>comments: </td>
                    <td><?php echo $result['comments']; ?></td>
                </tr>
                <tr style="border-bottom: 1px solid #FFF ! important;">
                    <td>Created Date: </td>
                    <?php if($result['date'] == '0000-00-00'){
                        $date = '';
                    }
                    else {
                        $date = date('d-M-Y', strtotime($result['date']));
                    }
                    ?>
                    <td><?php echo $date;?></td>
                </tr>
            </table>
        </div>
     <?php } else if ($from == "agentuserlist") {?>
            <div class="table-responsive">
                <table class="table">
                    <?php if ($details) { ?>
                                <tr>
                                    <td style="border-top: 1px solid #FFF ! important;"><b>Name</b></td>
                                    <td style="border-top: 1px solid #FFF ! important;"><b>Email</b></td>
                                    <td style="border-top: 1px solid #FFF ! important;"><b>Phone</b></td>
                                </tr>
                            <?php foreach ($details as $qa) {?>
                                <tr style="border-bottom: 1px solid #FFF ! important;">
                                        <td><?php echo $qa['first_name'].' '.$qa['last_name']; ?></td>
                                        <td><?php echo $qa['email']; ?></td>
                                        <td><?php echo $qa['phone']; ?></td>
                                <?php } ?>
                                </tr>         
                    <?php } else { ?>  
                        <tr style="border-bottom: 1px solid #FFF ! important;"><td colspan="3" style="border-top: 1px solid #FFF ! important;"><b>No user details found</b></td></tr>  
                    <?php } ?>
                </table>
            </div>

    <?php }  if ($from == 'disagree_payment') { ?>
    <div class="table-responsive">
        <table class="table" >
            <?php echo form_open("web/disagree_payment", array("id" => "disagree_payment")); ?>
            <tr>
                <td> 
                    <div class="form-group">
                        <label for="reason" class="control-label">Reason</label>
                        <div class="input-icon right">
                            <textarea row = "15" cols = "5" name = "reason" id = "reason"  class = "form-control"></textarea>  
                        </div>
                    </div>  
                </td>
            </tr>
            <tr>
                <td> 
                    <input type = "hidden" name = "id" id = "id" value = "<?php echo $id; ?>">
                    <button id="disagree_paymentsubmitbtn" class="btn btn-success disagree_paymentsubmit" type="button">Submit</button>
                </td>
            </tr>
            <?php echo form_close(); ?>
        </table>
    </div>
<?php }  ?>


