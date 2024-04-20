<?php
$db_name='mysql:host=localhost;dbname=ecommerce_db';
$username = 'root';
$user_password = '';

$conn = new PDO($db_name, $username, $user_password);   //creating a connection object by passing host

if ($conn){
    echo" Connected to the database successfully";  //display
}

function unique_id(){
    $chars= "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charLenght =strlen($chars);
    $randomString ="";
     for ($i = 0; $i < 20 ; $i++) {
         $randomString .= $chars[mt_rand(0,$charLenght-1)];
     }
     return $randomString;
}
?>