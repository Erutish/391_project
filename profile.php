
<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id=$_COOKIE['user_id']; 
    }else{
        $user_id="location:login.php";
    }
    $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $select_profile->execute([$user_id]);
    $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);

    // Check if profile is fetched successfully
    if(!$fetch_profile) {
        echo "Failed to fetch user profile";
        exit();
    }

    $select_orders=$conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
    $select_orders->execute([$user_id]);
    $total_orders= $select_orders->rowCount();

    $select_message=$conn->prepare("SELECT * FROM `message` WHERE user_id = ?");
    $select_message->execute([$user_id]);
    $total_message= $select_message->rowCount();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-user profile page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>profile</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>profile</span>
        </div>
    </div>

    <section class="profile">
            <div class="heading">
                <h1>Profile details</h1>
                <img src="images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->
            <div class="details">
                <div class="user">
                    <img src="uploaded_files/<?=$fetch_profile['image']?>" >
                    <h3 class="name"><?=$fetch_profile['name']?></h3>
                    <span>user</span>
                    <br>
                    <br>
                    <a href="update.php" class="btn">update profile</a>
                </div>

                <div class="box-container">
                    <div class="box">
                        <div class="flex">
                            <i class="fa-solid fa-folder-minus"></i>
                            <h3><?=$total_orders; ?> order placed</h3> 
                        </div>
                        <br>
                        <a href="order.php" class="btn">view orders</a>
                    </div>

                    <div class="box">
                        <div class="flex">
                            <i class="fa-solid fa-message"></i>
                            <h3><?=$total_message; ?>comments</h3> 
                            
 
                        </div>
                        <br>
                        <a href="message.php" class="btn">view comments</a>
                    </div>
                </div>
            </div>

           
         </section>
    



    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>