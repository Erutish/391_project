
<?php
    include 'components/connect.php';
    if(isset($_COOKIE['user_id'])){
        $user_id=$_COOKIE['user_id']; 
    }else{
        $user_id="";
    }

    if (isset($_POST['submit'])) {

        $email= $_POST["email"];
        $email= filter_var($email, FILTER_SANITIZE_STRING); 

        $pass=sha1($_POST["pass"]);   //encrypt password using
        $pass= filter_var($pass, FILTER_SANITIZE_STRING); 


        $select_user=$conn->prepare("SELECT * FROM `users` WHERE email= ? AND password=?");
        $select_user->execute([$email, $pass]);
        $row=$select_user->fetch(PDO::FETCH_ASSOC);

        if($select_user->rowCount() >0){
            setcookie('user_id',$row['id'],time()+60*60*24*30,"/");
            header('location:index.php');
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
    <title>Acio.com-user login page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>login</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>login</span>
        </div>
    </div>
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



    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>