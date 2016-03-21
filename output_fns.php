    <?php

function html_header($title){ // function to display the header
    // create a html header
    ?>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type="text/css" href="style/main.css" />
    </head>
    <body>
        <img src="image/bookmark.gif" id="bookmarkgif" />
        <h2 id="header">PHP BookMarks</h2>
        <hr />
    <?php
}
function html_siteInfo(){ // function to display some site information
    ?>
        <ul id="siteInfo">
            <li>Store your bookmarks with us?</li>
            <li>Want some recommendations?</li>
            <li>Just join us!</li>
        </ul>
    <?php
}
function html_mainpage(){ // function to create the navigation
    ?>
        <ul class="navga">
            <li><a href='member.php'>Home</a></li>
            <li><a href='addbm.php'>Add Bookmarks</a></li>
            <li><a href='deletebm.php'>Delete Bookmarks</a></li>
            <li><a href='changepassword.php'>Change Password</a></li>
            <li><a href='recommend.php'>Recommend BM To Me</a></li>
            <li><a href='logout.php'>Log Out</a></li>
        </ul>
    <?php
    echo "<br/>";
}
function login_form(){ // function to create a log in form
    ?>
        <form method="post" action="login_result.php" class="color">
            <p>Log In Here</p>
            Username: <input type="text" required="required" name="username" /><br />
            Password: <input type="password" required="required" name="userpassword" /><br />
            <input type="submit" name="submit" value="Log In" /><br />
        </form>
        <a href="register.php">Not a member?</a>
        <a href="forgetpasswd.php">Forget your password?</a>
    <?php
}
function register_form(){ // function to create a register form
    ?>
        <h2>Register Info</h2>
        <form method="post" action="register_result.php" class="color">
            Username: <input type="text" required="required" name="username" /><br />
            Password: <input type="password" required="required" name="userpassword" /><br />
            Confirm-Password: <input type="password" required="required" name="userpassword2" /><br />
            Email: <input type="email" required="required" name="useremail" /><br />
            <input type="submit" name="submit" value="Submit" /><br />
        </form>
    <?php
}
function forget_form(){ // function to create a form to send the user his/her password
    ?>
        <h2>Forget Password</h2>
        <form method="post" action="forgetpasswd_result.php">
            <h3>Please enter your username. </h3>
            <input type="text" required="required" name="username" />
            <input type="submit" value="Reset Password" />
        </form>
    <?php
}
function changepwd_form(){ // // function to create a form for the user to reset his/her password
    ?>
        <h2>Forget Password</h2>
        <form method="post" action="changepassword_result.php">
            <h3>Please enter your username. </h3>
            <input type="text" required="required" name="username" />
            <h3>Please enter your origin password. </h3>
            <input type="password" required="required" name='userpassword' />
            <h3>Please enter your new password. </h3>
            <input type="password" required="required" name='newpasswd' />
            <input type="submit" value="Reset Password" />
        </form>
    <?php
}
function addbookmarks(){ // function to add a bookmark
    ?>
        <h2>Add Book Marks</h2>
        <form method="post" action="addbm_result.php">
            <h3>Please enter your new bookmark. </h3>
            <input type="text" required="required" name='bookmark' />
            <input type="submit" value="Submit" />
        </form>
    <?php
}
function deletebookmark(){ // function to delete a bookmark
    ?>
        <h2>Delete Book Marks</h2>
        <form method="post" action="deletebm_result.php">
            <h3>Please enter the url of bookmark. </h3>
            <input type="text" required="required" name='bookmark' />
            <input type="submit" value="Submit" />
        </form>
    <?php
}
function display_urls($urls, $ulid){ // function to display urls
    $num_display = 3; // you can define the number of urls recommended
    $num = $num_display <= count($urls) ? $num_display:count($urls); 
    echo "<ul id='$ulid'><br/>";
    for($i=0; $i<$num; $i++){
            $url = explode('.', $urls[$i]);
            echo "<li><a href='http://$url[1].$url[2]'>$urls[$i]</a></li><br/>";
    }
    echo "</ul><br/>";
}
function recommend_urls($valid_user){ // return an array of url from another user
    require 'bookmark_fns.php';
    $db = db_connect();
    $query = "select bm_url from bookmark where 
                    name in 
                        (select distinct(b2.name)
                        from bookmark b1, bookmark b2
                        where b1.name='".$valid_user."'
                        and b1.name != b2.name
                        and b1.bm_URL = b2.bm_URL)
                    and bm_URL not in
                        (select bm_URL from bookmark
			where name='".$valid_user."')";
    if(!($result = $db->query($query))){
        return NULL;
    }
    $urls = array();
    for($i=0; $row=$result->fetch_object(); $i++){
        $urls[$i] = $row->bm_url;
    }
    return $urls;
}
function mostpopular_urls(){ // return an ordered array of url, url[0] is the most popular one
                             // here I use QuickSort to sort the array
    require 'bookmark_fns.php';
    $db = db_connect();
    $query = "select * from bm_popularity";
    $result = $db->query($query);
    $urls = array();
    $popularities = array();
    for($i=0; $row=$result->fetch_object(); $i++){
        $urls[$i] = $row->bm_url;
        $popularities[$i] = $row->popularity;
    }
    $n = count($urls) - 1;
    quicksort($urls, $popularities, 0, $n);
    return $urls;
}
function quicksort(&$urls, &$popularities, $low, $high){
    $key = $popularities[$low];
    $url_key = $urls[$low];
    $begin = $low;
    $end = $high;
    while($begin != $end){
        while($popularities[$end] <= $key && $begin < $end){
            $end--;
        }
        $urls[$begin] = $urls[$end];
        $popularities[$begin] = $popularities[$end];
        while ($popularities[$begin] >= $key && $begin < $end){
            $begin++;
        }
        $popularities[$end] = $popularities[$begin];
        $urls[$end] = $urls[$begin];
    }
    $popularities[$begin] = $key;
    $urls[$begin] = $url_key;
    if($low < ($begin-1)){
        quicksort ($urls, $popularities, $low, $begin-1);
    }
    if(($end+1) < $high){
        quicksort ($urls, $popularities, $end+1, $high);
    }
}
function html_footer(){ // create an html footer
    ?>
    </body>
    </html>
    <?php
}