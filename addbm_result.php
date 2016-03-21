<?php
    session_start();
    require 'bookmark_fns.php';
    $bookmark = $_POST['bookmark'];
    $db = db_connect();
    $query = "insert into bookmark(name,bm_url) values  "
            ."('".$_SESSION['valid_name']."','".$bookmark."')";
    $result = $db->query($query);
    if(!$result){
        echo 'Could not add bookmark to database<br/>';
        exit;
    }
    else{
        require 'bookmark_fns.php';
        html_header('Add BM');
        html_siteInfo();
        html_mainpage();
        echo "<br/><h2>Add bookmark succeed.</h2>";
        echo "<a href='member.php'>Click Here To Main Page</a>";
        html_footer();
    }
    $query2 = "select popularity from bm_popularity where bm_url='".$bookmark."'";
    $popularity = $db->query($query2);
    if($popularity->num_rows == 0){ // first time someone add this bookmark
        $db->query("insert into bm_popularity(bm_url,popularity) values('"
                .$bookmark."','1')");
    }
    else{ // if not
        $db->query("update bm_popularity set popularity=(popularity+1) where bm_url='"
                .$bookmark."'");
    }