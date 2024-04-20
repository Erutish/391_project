
<?php
include 'components/connect.php';
if(isset($_COOKIE['user_id'])){
    $user_id=$_COOKIE['user_id']; 
}else{
    $user_id="1";
}

if (isset($_POST['submit'])) {
    $id = unique_id();
    $name=$_POST["name"];
    $name= filter_var($name, FILTER_SANITIZE_STRING);  //filtering number and special characters from name

    $email= $_POST["email"];
    $email= filter_var($email, FILTER_SANITIZE_STRING); 

    $number= $_POST["number"];
    $number= filter_var($number, FILTER_SANITIZE_NUMBER_INT); 

    $pass=sha1($_POST["pass"]);   //encrypt password using
    $pass= filter_var($pass, FILTER_SANITIZE_STRING); 

    $cpass=sha1($_POST["cpass"]);   //encrypt password using
    $cpass= filter_var($cpass, FILTER_SANITIZE_STRING);  

    $image= $_FILES[ "image" ]['name'] ;
    $image= filter_var($image,FILTER_SANITIZE_STRING);
    $ext= pathinfo($image, PATHINFO_EXTENSION);  //getting the extension of file
    $rename= uniqid().'.'.$ext;  //creating a new name for image
    $image_size=$_FILES[ "image" ]["size"];
    $image_tmp_name= $_FILES[ "image" ]["tmp_name"];
    $image_folder= "uploaded_files/".$rename;

    $select_seller=$conn->prepare("SELECT * FROM `users` WHERE email= ?");
    $select_seller->execute([$email]);

    if($select_seller->rowCount() >0){
        $warning_msg[]='email already exist!';
    }else{
        if($pass !=$cpass){
            $warning_msg[]='confirm password not match with password!';
        }else{
            $insert_seller=$conn->prepare("INSERT INTO `users`(id,name,number,email,password,image) VALUES(?,?,?,?,?,?)");
            $insert_seller->execute([$id,$name,$number,$email,$cpass,$rename]);
            move_uploaded_file($image_tmp_name ,$image_folder);
            $success_msg[]='new user registered! please login now';
        }
    }


}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-user register page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>register</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>register</span>
        </div>
    </div>
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data" class="register">
            <h3>register now</h3>
            <div class="flex">
                <div class="col">
                    <div class="input-field">
                        <p>Your Name <span>*</span></p>
                        <input type="text" name="name" placeholder="Enter Your Name"maxlenght="50" required class="box"/>
                    </div>
                    <div class="input-field">
                        <p>Your Email <span>*</span></p>
                        <input type="email" name="email" placeholder="Enter Your Email"maxlenght="50" required class="box"/>
                    </div>
                    <div class="input-field">
                        <p>Your Phone Number <span>*</span></p>
                        <input type="number" name="number" placeholder="Enter Your Email"maxlenght="11" required class="box"/>
                    </div>
                </div>
                <div class="col">
                   <div class="input-field">
                        <p>Your Password <span>*</span></p>
                        <input type="password" name="pass" placeholder="Enter Your Password"maxlenght="50" required class="box"/>
                    </div>
                    <div class="input-field">
                        <p>Confirm Your Password <span>*</span></p>
                        <input type="password" name="cpass" placeholder="Confirm Your Password"maxlenght="50" required class="box"/>
                    </div>
                    
                </div>    
            </div>
            <div class="input-field">
                    <p>Your Profile<span>*</span></p>
                    <input type="file" name="image" accept="image/*" required class="box"/>
            </div>
            <p class="link">already have an account? <a href="login.php">login now</a></p>
            <input type="submit" name="submit"value="register-now" class="btn" />  
        </form>
    </div>


    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>