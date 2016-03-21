<?php
    require 'bookmark_fns.php';
    session_start();
    html_header('Change Password');
    html_siteInfo();
    html_mainpage();
    echo "<br />";
    if(!$_SESSION['valid_name']){
        echo "<h2>You are not logged in.</h2>";
        echo "<a href='login.php'>Click here to log in.</a><br />";
    }
    else{
        changepwd_form();
    }
    html_footer();