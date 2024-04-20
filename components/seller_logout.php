<?php
    include "connect.php";

    setcookie('seller_id','',time() -1, '/');
    header( 'Location: ../seller_panel/login.php' ) ;
?>