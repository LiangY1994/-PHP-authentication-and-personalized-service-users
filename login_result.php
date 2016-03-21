<?php
    session_start();
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];
    require 'bookmark_fns.php';
    $db = db_connect();
    if(!$db)
        exit;
    $query = "select * from users where name='".$username."' and password='".$userpassword."'";
    $result = $db->query($query);
    if($result->num_rows == 0){
        html_header('Log In');
        html_siteInfo();
        echo "Username and password do not match. Please try again.<br />";
        login_form();
        html_footer();
    }
    else{
        $_SESSION['valid_name'] = $username;
        require 'bookmark_fns.php';
        html_header('Log In');
        html_siteInfo();
        echo "Log in succeed.<br />";
        echo "<a href='member.php'>Click Here To Main Page</a>";
        html_footer();
    }
?>