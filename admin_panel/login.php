
<?php
include '../components/connect.php';

if (isset($_POST['submit'])) {

    $email= $_POST["email"];
    $email= filter_var($email, FILTER_SANITIZE_STRING); 

    $pass=sha1($_POST["pass"]);   //encrypt password using
    $pass= filter_var($pass, FILTER_SANITIZE_STRING); 


    $select_admin=$conn->prepare("SELECT * FROM admin WHERE email= ? AND password=?");
    $select_admin->execute([$email, $pass]);
    $row=$select_admin->fetch(PDO::FETCH_ASSOC);

    if($select_admin->rowCount() >0){
        setcookie('admin_id',$row['id'],time()+60*60*24*30,"/");
        header('location:dashboard.php');
        }else{
            $warning_msg[]='incorrect email or password';
        }
       
    }





?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-admin registeration page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"  />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="login">
            <h3>login now</h3>

            <div class="input-field">
                <p>Your Email <span>*</span></p>
                <input type="email" name="email" placeholder="Enter Your Email"maxlenght="50" required class="box"/>
            </div>
            <div class="input-field">
                <p>Your Password <span>*</span></p>
                <input type="password" name="pass" placeholder="Enter Your Password"maxlenght="50" required class="box"/>
            </div>
            <p class="link">do not have an account? <a href="register.php">register now</a></p>
            <input type="submit" name="submit"value="login-now" class="btn" />  
        </form>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>