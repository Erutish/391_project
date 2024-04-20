<?php
    include "connect.php";

    setcookie('user_id','',time() -1, '/');
    header( 'Location:../index.php' ) ;
?>