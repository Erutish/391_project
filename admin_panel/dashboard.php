
<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id= $_COOKIE["admin_id"]; 
}else{
    $admin_id='';
    header( "Location:login.php" );
       
    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-admin dashboard page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

</head>
<body>
    <div class="main-container">
         <?php include '../components/admin_header.php'; ?>
         <section class="dashboard">
            <div class="heading">
                <h1>dashboard</h1>
                <img src="../images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->

            <div class="box-container">
                <div class="box">
                    <h3>welcome</h3>
                    <p><?=$fetch_profile['name']; ?></p>
                    <a href="update.php" class="btn">update profile</a>
                </div>

                <div class="box">
                    <?php
                    $select_message=$conn->prepare("SELECT * FROM `message`");
                    $select_message->execute();
                    $number_of_msg=$select_message->rowCount();
                    ?>
                    <h3><?= $number_of_msg; ?></h3>
                    <p>unread message</p>
                    <a href="seller_message.php" class="btn">see message</a>
                </div>

                <div class="box">
                    <?php
                    $select_products=$conn->prepare("SELECT * FROM `sellers` WHERE status='pending'");
                    $select_products->execute();
                    $number_of_products=$select_products->rowCount();
                    ?>
                    <h3><?= $number_of_products; ?></h3>
                    <p>seller requests</p>
                    <a href="add_product.php" class="btn">seller_requests</a>
                </div>

                <div class="box">
                    <?php
                    $select_active_products=$conn->prepare("SELECT * FROM `products`WHERE status=?");
                    $select_active_products->execute(['active']);
                    $number_of_active_products=$select_active_products->rowCount();
                    ?>
                    <h3><?= $number_of_active_products; ?></h3>
                    <p>total active products</p>
                    <a href="active.php" class="btn">view active product</a>
                </div>

                <div class="box">
                    <?php
                    $select_deactive_products=$conn->prepare("SELECT * FROM `products` WHERE status=?");
                    $select_deactive_products->execute(['inactive']);
                    $number_of_deactive_products=$select_deactive_products->rowCount();
                    ?>
                    <h3><?= $number_of_deactive_products; ?></h3>
                    <p>total inactive products</p>
                    <a href="inactive.php" class="btn">view inactive product</a>
                </div>

                <div class="box">
                    <?php
                    $select_users=$conn->prepare("SELECT * FROM `users`");
                    $select_users->execute();
                    $number_of_users=$select_users->rowCount();
                    ?>
                    <h3><?= $number_of_users; ?></h3>
                    <p>users account</p>
                    <a href="user_accounts.php" class="btn">see users</a>
                </div>

                <div class="box">
                    <?php
                    $select_sellers=$conn->prepare("SELECT * FROM `sellers`");
                    $select_sellers->execute();
                    $number_of_sellers=$select_sellers->rowCount();
                    ?>
                    <h3><?= $number_of_sellers; ?></h3>
                    <p>sellers account</p>
                    <a href="seller_accounts.php" class="btn">see sellers</a>
                </div>

                <div class="box">
                    <?php
                    $select_orders=$conn->prepare("SELECT * FROM `orders`");
                    $select_orders->execute();
                    $number_of_orders=$select_orders->rowCount();
                    ?>
                    <h3><?= $number_of_orders; ?></h3>
                    <p>total orders placed</p>
                    <a href="seller_order.php" class="btn">total orders</a>
                </div>

                <div class="box">
                    <?php
                    $select_confirm_orders=$conn->prepare("SELECT * FROM `orders` WHERE  status=?");
                    $select_confirm_orders->execute(['in progress']);
                    $number_of_confirm_orders=$select_confirm_orders->rowCount();
                    ?>
                    <h3><?= $number_of_confirm_orders; ?></h3>
                    <p>total confirm orders</p>
                    <a href="confirm_order.php" class="btn">confirm orders</a>
                </div>

                <div class="box">
                    <?php
                    $select_confirm_orders=$conn->prepare("SELECT * FROM `orders` WHERE transaction_type=?");
                    $select_confirm_orders->execute(['swap']);
                    $number_of_confirm_orders=$select_confirm_orders->rowCount();
                    ?>
                    <h3><?= $number_of_confirm_orders; ?></h3>
                    <p>total swap orders</p>
                    <a href="swap_order.php" class="btn">swap orders</a>
                </div>

                <div class="box">
                    <?php
                    $select_canceled_orders=$conn->prepare("SELECT * FROM `orders` WHERE status =?");
                    $select_canceled_orders->execute(['cancled']);
                    $number_of_canceled_orders=$select_canceled_orders->rowCount();
                    ?>
                    <h3><?= $number_of_canceled_orders; ?></h3>
                    <p>total cancled orders</p>
                    <a href="cancel_order.php" class="btn">cancled orders</a>
                </div>

            </div>
         </section>

    </div>
    
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="../js/seller_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>