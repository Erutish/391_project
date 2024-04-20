
<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id= $_COOKIE["seller_id"]; 
}else{
    $seller_id='';
    header( "Location:login.php" );
       
    }

    $seller_product=$conn->prepare("SELECT * FROM `products` WHERE seller_id = ?");
    $seller_product->execute([$seller_id]);
    $total_products= $seller_product->rowCount();

    $seller_orders=$conn->prepare("SELECT * FROM `orders` WHERE seller_id = ?");
    $seller_orders->execute([$seller_id]);
    $total_orders= $seller_orders->rowCount();



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-seller profile page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

</head>
<body>
    <div class="main-container">
         <?php include '../components/seller_header.php'; ?>
         <section class="seller-profile">
            <div class="heading">
                <h1>Profile details</h1>
                <img src="../images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->
            <div class="details">
                <div class="seller">
                    <img src="../uploaded_files/<?=$fetch_profile['image']?>" >
                    <h3 class="name"><?=$fetch_profile['name']?></h3>
                    <span>seller</span>
                    <a href="update.php" class="btn">update profile</a>
                </div>

                <div class="flex">
                    <div class="box">
                        <span><?=$total_products; ?>"</span>
                        <p>total products</p>
                        <a href="view_product.php" class="btn">view_products</a>
                    </div>

                    <div class="box">
                        <span><?=$total_orders; ?>"</span>
                        <p>total orders placed</p>
                        <a href="seller_order.php" class="btn">view_orders</a>
                    </div>
                </div>
            </div>

           
         </section>

    </div>
    
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="../js/seller_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>