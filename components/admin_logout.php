<?php
    include "connect.php";

    setcookie('admin_id','',time() -1, '/');
    header( 'Location: ../admin_panel/login.php' ) ;
?>