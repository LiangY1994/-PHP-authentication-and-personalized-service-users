<?php
    require 'bookmark_fns.php';
    session_start();
    html_header('Main Page');
    html_siteInfo();
    if(!$_SESSION['valid_name']){ // not define $_SESSION means not logged in
        echo "<h2>You are not logged in.</h2>";
        echo "<a href='login.php'>Click here to log in.</a><br />";
    }
    else{
        html_mainpage();
        $db = db_connect();
        $query = "select * from bookmark where name='".$_SESSION['valid_name']."'";
        $result = $db->query($query);
        echo "<br/><h2>Your Book Marks</h2>";
        echo "<ul id='bookmark'><br/>";
        while($row = $result->fetch_object()){
            $url = explode('.', $row->bm_url);
            $last = count($url);
            echo "<li><a href='http://$url[1].$url[2]'>$row->bm_url</a></li><br/>";
        }
        echo "</ul><br/>";
    }
    html_footer();