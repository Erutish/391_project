
<?php
    include 'components/connect.php';
    if(isset($_COOKIE['user_id'])){
        $user_id=$_COOKIE['user_id']; 
    }else{
        $user_id="";
    }

    if(isset($_POST["send_message"])) {
        if($user_id !=''){
            
            $id= unique_id();
            $name= $_POST["name"];
            $name=filter_var($name,FILTER_SANITIZE_STRING);

            $email =$_POST["email"];
            $email=filter_var($email,FILTER_SANITIZE_STRING);

            $subject =$_POST["subject"];
            $subject=filter_var($subject,FILTER_SANITIZE_STRING);

            $message =$_POST["message"];
            $message=filter_var($message,FILTER_SANITIZE_STRING);

            $verify_message = $conn->prepare("SELECT * FROM `message` WHERE user_id=? AND name=? AND email=? AND subject=? AND message=?");
            $verify_message->execute([$user_id, $name, $email, $subject, $message]);


            if($verify_message->rowCount()>0){
                $warning_msg[]='message alredy exist';
                
            } else{
                $insert_message=$conn->prepare("INSERT INTO `message`(id,user_id,name,email,subject,message) VALUES(?,?,?,?,?,?)");
                $insert_message->execute([$id,$user_id,$name,$email, $subject, $message]);

                $success_msg[]='Message sent successfully!';
            }
        }else{
           $warning_msg[]='You must login to send a message!';  


        }
    }




?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-contact-us page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>contact-us </h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>contact-us </span>
        </div>
    </div>
    <div class="services">
        <div class="heading">
            <h1>our services</h1>
            <p>Just A Few Click To Make The Resservation Online For Saving Your Time And Money</p>
            <img src="images/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="images/0.png">
                <div>
                    <h1>free shipping fast</h1>
                    <p>Lorem ipsum dolor sit amet consector adipiscing elit.</p>
                </div>
            </div>

            <div class="box">
                <img src="images/1.png">
                <div>
                    <h1>money back $ gurantee</h1>
                    <p>Lorem ipsum dolor sit amet consector adipiscing elit.</p>
                </div>
            </div>

            <div class="box">
                <img src="images/2.png">
                <div>
                    <h1>online support 24/7</h1>
                    <p>Lorem ipsum dolor sit amet consector adipiscing elit.</p>
                </div>
            </div>
        </div>
    </div>
    <div class="form-container">
        <div class="heading">
            <h1>drop us a comment</h1>
            <p>Just A Few Click To Make The Resservation Online For Saving Your Time And Money</p>
            <img src="images/separator-img.png">
        </div>
        <form action="" method="post" class="register">
            <div class="input-field">
                <label>name<sup>*</sup></label>
                <input type="text" name="name" required placeholder="enter your name" class="box">
            </div>

            <div class="input-field">
                <label>email<sup>*</sup></label>
                <input type="email" name="email" required placeholder="enter your email" class="box">
            </div>

            <div class="input-field">
                <label>subject<sup>*</sup></label>
                <input type="text" name="subject" required placeholder="reason....." class="box">
            </div>

            <div class="input-field">
                <label>comment<sup>*</sup></label>
                <textarea name="message" cols="30" rows="10" required placeholder="write here..." class="box"></textarea>
            </div>

            <button type="submit" name="send_message" class="btn">send message</button>
        </form>
    </div>
    <div class="address">
        <div class="heading">
            <h1>our contact details</h1>
            <p>Just A Few Click To Make The Resservation Online For Saving Your Time And Money</p>
            <img src="images/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <i class="fa-solid fa-location-dot"></i>
                <div>
                    <h4>address</h4>
                    <p>295/A1 Talioffice Road<br>West Dhanmondi,Dhaka</p>
                </div>
            </div>

            <div class="box">
                <i class="fa-solid fa-phone"></i>
                <div>
                    <h4>phone number</h4>
                    <p>01611456785</p>
                    <p>07811456785</p>
                </div>
            </div>

            <div class="box">
                <i class="fa-solid fa-envelope"></i>
                <div>
                    <h4>email</h4>
                    <p>rowshonera@gmail.com</p>
                    <p>rowshon.ara.chowdhury@g.bracu.ac.bd</p>
                </div>
            </div>

            
        </div>
    </div>


    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>