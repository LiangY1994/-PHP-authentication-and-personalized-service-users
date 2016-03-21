<?php
    require 'bookmark_fns.php';
    session_start();
    html_header('Main Page');
    html_siteInfo();
    html_mainpage();
    echo '<br />';
    if(!$_SESSION['valid_name']){ // not define $_SESSION means not logged in
        echo "<h2>You are not logged in.</h2>";
        echo "<a href='login.php'>Click here to log in.</a><br />";
    }
    else{
        deletebookmark();
    }
    html_footer();