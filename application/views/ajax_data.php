<?php
// more details
if ($from == "agent") { ?>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <td>Name: </td>
                <td><?php echo $result['first_name'] . ' ' . $result['last_name']; ?></td>
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
        </table>
    </div>

    <?php } ?>