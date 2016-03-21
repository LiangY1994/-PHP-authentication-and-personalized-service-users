<?php
    require 'bookmark_fns.php';
    session_start();
    html_header('Main Page');
    html_siteInfo();
    if(!$_SESSION['valid_name']){
        echo "<h2>You are not logged in.</h2>";
        echo "<a href='login.php'>Click here to log in.</a><br />";
    }
    else{
        unset($_SESSION['valid_name']);
        $result = session_destroy();
        if($result){
            echo "<h2>You are logged out.</h2>";
            echo "<a href='login.php'>Click here to log in.</a><br />";
        }
        else{
            echo "<h2>You can not log out.</h2>";
            echo "<a href='member.php'>Click here to the main page.</a><br />";
        }
    }
    html_footer();

