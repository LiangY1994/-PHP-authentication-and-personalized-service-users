<?php
    $username = $_POST['username'];
    $userpassword = $_POST['userpassword'];
    $userpassword2 = $_POST['userpassword2'];
    $useremail = $_POST['useremail'];
    if($userpassword !== $userpassword2){
        require 'bookmark_fns.php';
        html_header('Register');
        html_siteInfo();
        echo "<h2 id='confirmerror'>Confirm-Password is not correct.Please try again.</h2>";
        register_form();
        html_footer();
    }
    else{
        session_start();
        require 'bookmark_fns.php';
        html_header('Register');
        html_siteInfo();
        $db = db_connect();
        if($db === FALSE){
            exit;
        }
        $query1 = "select * from users where name='".$username."'";
        $result1 = $db->query($query1);
        if($result1->num_rows > 0){
            echo "<h2 id='confirmerror'>Username already exites.Please try another one.</h2>";
            register_form();
            html_footer();
        }
        else{
            $query2 = "insert into users values('".$username."','"
                .$userpassword."','".$useremail."')";
            $result = $db->query($query2);
            if(!$result){
                echo "Register failed<br />";
                exit;
            }
            $_SESSION['valid_name'] = $username;
            echo "Register succeed<br />";
            echo "<a href='member.php'>Main Page</a>";
            html_footer();
        }
    }
?>

