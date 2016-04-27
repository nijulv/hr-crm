
<?php


if (isset($_POST['submit'])) {
    $name = $_POST['username'];
    $pass = $_POST['password'];
    $email = $_POST['email'];
    $phone1 = $_POST['phone'];
    $phone = preg_replace("/[^0-9]/", "", $phone1);
    //-------------------------- sendy api integration start --------------------------//
    $your_installation_url = 'http://sendy.soundfan.com/';
    $list = 'UhKvdG8t3xQIjJ9i8Zw10Q';
    $success_url = 'http://onebigpot.com/index.php?register=success';
    $fail_url = 'http://onebigpot.com/index.php?register=error';
    $boolean = 'true';

    $postdata = http_build_query(
            array(
                'name' => $name,
                'email' => $email,
                'Phone' => $phone,
                'list' => $list,
                'boolean' => 'true'
            )
    );

    $opts = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
    $context = stream_context_create($opts);
    $result = file_get_contents($your_installation_url . '/subscribe', false, $context);

    //-------------------------- sendy api integration end--------------------------//
    $check = "SELECT email FROM `users` where email = '" . $email . "'";
    $error = mysql_query($check);
    if (mysql_num_rows($error) > 0) {
        $copy = $email . " is already registered.";
    } else {





        $sql = "INSERT INTO users(username, password, email, phone, image, oldtwno, ac_type_id) VALUES ('" . mysql_real_escape_string($name) . "','" . md5($pass) . "','" . mysql_real_escape_string($email) . "','" . mysql_real_escape_string($phone) . "','default.png','+13232104660', 1)";
        $qq = mysql_query($sql);
        if ($qq) {
            $okreport = 'Thank You For Registration.';

            if (isset($_POST['submit'])) {
                $name = $_POST['username'];
                $pass = $_POST['password'];
                $email = $_POST['email'];
                $phone1 = $_POST['phone'];
                $phone = preg_replace("/[^0-9]/", "", $phone1);

                $check = "SELECT email FROM `users` where email = '" . $email . "'";
                $error = mysql_query($check);
                if (mysql_num_rows($error) > 0) {
                    $copy = $email . " is already registered.";
                } else {
                    //-------------------------- sendy api integration start --------------------------//
                    $your_installation_url = 'http://sendy.soundfan.com/';
                    $list = 'UhKvdG8t3xQIjJ9i8Zw10Q';
                    $success_url = 'http://onebigpot.com/indextest.php?register=success';
                    $fail_url = 'http://onebigpot.com/indextest.php?register=error';
                    $boolean = 'true';

                    $postdata = http_build_query(
                            array(
                                'name' => $name,
                                'email' => $email,
                                'Phone' => $phone,
                                'list' => $list,
                                'boolean' => 'true'
                            )
                    );
                    $opts = array('http' => array('method' => 'POST', 'header' => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
                    $context = stream_context_create($opts);
                    $result = file_get_contents($your_installation_url . '/subscribe', false, $context);

                    //-------------------------- sendy api integration end--------------------------//
                    $sql = "INSERT INTO users(username, password, email, phone, image, oldtwno, ac_type_id) VALUES ('" . mysql_real_escape_string($name) . "','" . md5($pass) . "','" . mysql_real_escape_string($email) . "','" . mysql_real_escape_string($phone) . "','default.png','+13232104660', 1)";
                    $qq = mysql_query($sql);
                    if ($qq) {
                        $okreport = 'Thank You For Registration.';

                        //Send Email

                        /* $to = $email;
                          $subject = "Thanks Mail";
                          $txt = "Dear ".$name.",<br>Thanks for Registering with us. <br> Here are your login details: <b> Name <b>::".$name."<br><b> Email Id <b>::".$email."<br><b> Phone Number <b>::".$phone."<br>Thanks <br> <b>Admin<br>ONEBIGPOT</b>";
                          $headers = "From: admin@gmail.com";
                          $headers = "MIME-Version: 1.0" . "\r\n";
                          $headers.= "Content-type: text/html; charset= iso-8859-1\n";
                          mail($to,$subject,$txt,$headers); */
                    }


                    $query = "SELECT * FROM users where email = '" . mysql_real_escape_string($_POST['email']) . "' AND password = '" . md5($_POST['password']) . "' or phone = '" . mysql_real_escape_string($_POST['email']) . "' AND password = '" . md5($_POST['password']) . "'";
                    $result = mysql_query($query);
                    if (mysql_num_rows($result) > 0) {
                        $row = mysql_fetch_assoc($result);
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['userId'] = $row['id'];
                        $_SESSION['ac_type_id'] = $row['ac_type_id'];
                        header("Location: keyword.php");
                    } else {
                        header("Location: login.php");
                    }
                }
            }

            //Send Email

            /* $to = $email;
              $subject = "Thanks Mail";
              $txt = "Dear ".$name.",<br>Thanks for Registering with us. <br> Here are your login details: <b> Name <b>::".$name."<br><b> Email Id <b>::".$email."<br><b> Phone Number <b>::".$phone."<br>Thanks <br> <b>Admin<br>ONEBIGPOT</b>";
              $headers = "From: admin@gmail.com";
              $headers = "MIME-Version: 1.0" . "\r\n";
              $headers.= "Content-type: text/html; charset= iso-8859-1\n";
              mail($to,$subject,$txt,$headers); */
        }


        $query = "SELECT * FROM users where email = '" . mysql_real_escape_string($_POST['email']) . "' AND password = '" . md5($_POST['password']) . "' or phone = '" . mysql_real_escape_string($_POST['email']) . "' AND password = '" . md5($_POST['password']) . "'";
        $result = mysql_query($query);
        if (mysql_num_rows($result) > 0) {
            $row = mysql_fetch_assoc($result);
            $_SESSION['email'] = $row['email'];
            $_SESSION['userId'] = $row['id'];
            $_SESSION['ac_type_id'] = $row['ac_type_id'];
            header("Location: keyword.php");
        } else {
            header("Location: login.php");
        }
    }
}
?>
