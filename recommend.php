<?php
    require 'bookmark_fns.php';
    session_start();
    html_header('Main Page');
    html_siteInfo();
    html_mainpage();
    echo '<br />';
    if(!$_SESSION['valid_name']){
        echo "<h2>You are not logged in.</h2>";
        echo "<a href='login.php'>Click here to log in.</a><br />";
    }
    else{
        $recommend_urls = recommend_urls($_SESSION['valid_name']);
        if(count($recommend_urls) > 0){
            echo "<h2>Recommendation from others are as follows:</h2>";
            display_urls($recommend_urls, 'popular');
        }
        $popular_urls = mostpopular_urls();
        if(count($popular_urls) > 0){
            echo "<h2>The most 3 popular bookmarks are as follows:</h2>";
            display_urls($popular_urls, 'popular');
        }
        html_footer();
    }