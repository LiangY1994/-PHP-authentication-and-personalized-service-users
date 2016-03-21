<?php
    require 'bookmark_fns.php';
    html_header('Log In');
    html_siteInfo();
    forget_form(); // enter your username and the system will send you a new password
    html_footer();
?>