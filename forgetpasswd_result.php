<?php
    require 'bookmark_fns.php';
    $username = $_POST['username'];
    $db = db_connect();
    $query = "select * from users where name='".$username."'";
    $result = $db->query($query);
    if($result->num_rows == 0){
        echo "<h2>Invalid username. Please try again.</h2>";
        exit;
    }
    else{
        $row = $result->fetch_object();
        $email = $row->email;
        $from = "Server of PHP Bookmarks \r\n";
        $mesg = "Your password is ".$row->password.
                ". For safety reasons, we recommend you to change it ASAP.\r\n";
        if(mail($email, "PHPBookmarks log in information", $from, $mesg)){
            echo "<h2>Your Password has already been sent to your email address</h2>";
        }
        else{
            throw new Exception ("Could not send email.");
        }
    }

