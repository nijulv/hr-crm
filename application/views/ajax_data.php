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
                <td>Status: </td> <?php if($result['status'] == '1') { $status = 'Active';} else { $status = 'Deactive';}?>
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
                    <td>Status: </td> <?php if($result['status'] == '1') { $status = 'User';} else { $status = 'Client';}?>
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
    <?php } ?>


