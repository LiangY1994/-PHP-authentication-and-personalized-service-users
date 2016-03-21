<?php
    session_start();
    require 'bookmark_fns.php';
    $bookmark = $_POST['bookmark'];
    $db = db_connect();
    $query = "delete from bookmark where bm_url='".$bookmark
            ."' and name='".$_SESSION['valid_name']."'";
    $result = $db->query($query);
    if(!$result){ // if not succeed
        html_header('Delete BM');
        html_siteInfo();
        html_mainpage();
        echo "<h2 id='confirmerror'>Could not delete bookmark to database</h2>";
        exit;
    }
    else{ // if succeed
        html_header('Delete BM');
        html_siteInfo();
        html_mainpage();
        echo "<br/><h2>Delete bookmark succeed.</h2>";
        echo "<a href='member.php'>Click Here To Main Page</a>";
        html_footer();
    }
    // in the database $popularity - 1
    $query2 = "select popularity from bm_popularity where bm_url='".$bookmark."'";
    $db->query("update bm_popularity set popularity=(popularity-1) where bm_url='"
                .$bookmark."'");