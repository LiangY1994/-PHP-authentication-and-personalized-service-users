<?php
    require 'bookmark_fns.php';
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];
    $db = db_connect();
    $query1 = "select * from users where name='".$username
            ."' and password='".$userpassword."'";
    $result1 = $db->query($query1);
    if($result1->num_rows > 0){ // username and password match
        $newpasswd = $_POST['newpasswd'];
        $query2 = "update users set password='".$newpasswd."' where name='".$username."'";
        $result2 = $db->query($query2);
        if(!$result2){
            echo "<h2>Error in changing password, please try again</h2>";
            echo "<a href='changepassword.php'>Click here to retry.</a><br />";
        }
        echo "<h2>Succeed in changing.</h2>";
        unset($_SESSION['valid_name']);
        echo "<a href='login.php'>Click here to the log in page.</a><br />";
    }
    else{ // username and password do not match
        html_header('Change Password');
        html_siteInfo();
        html_mainpage();
        echo "<h2>Username and password do not match, please try again</h2>";
        echo "<a href='changepassword.php'>Click here to retry.</a><br />";
    }
