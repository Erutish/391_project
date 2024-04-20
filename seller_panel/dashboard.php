
<?php
include '../components/connect.php';

if (isset($_COOKIE['seller_id'])) {
    $seller_id= $_COOKIE["seller_id"]; 
}else{
    $seller_id='';
    header( "Location:login.php" );
       
    }

$select_seller_status = $conn->prepare("SELECT status FROM `sellers` WHERE id = ?");
$select_seller_status->execute([$seller_id]);
$seller_status = $select_seller_status->fetchColumn();

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-seller dashboard page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

</head>
<body>
    <div class="main-container">
         <?php include '../components/seller_header.php'; ?>
         <section class="dashboard">
            <div class="heading">
                <h1>dashboard</h1>
                <img src="../images/separator-img.png">
            </div>



            <?php if ($seller_status == 'pending'): ?>
                <div class="pending-message" style="font-size: 2rem; text-align:center; margin-top:10%;">
                    <br>
                    <br>
                    <p>Your account is pending approval from the admin.<br> Please wait for admin approval.</p>
                </div>
            <?php elseif ($seller_status == 'accepted'): ?>

            <!-- admin approve na korle pending dekhabe -->

                <div class="box-container">
                    <div class="box">
                        <h3>welcome</h3>
                        <p><?=$fetch_profile['name']; ?></p>
                        <a href="update.php" class="btn">update profile</a>
                    </div>

                    

                    <div class="box">
                        <?php
                        $select_products=$conn->prepare("SELECT * FROM `products`WHERE seller_id=?");
                        $select_products->execute([$seller_id]);
                        $number_of_products=$select_products->rowCount();
                        ?>
                        <h3><?= $number_of_products; ?></h3>
                        <p>products added</p>
                        <a href="add_product.php" class="btn">add product</a>
                    </div>

                    <div class="box">
                        <?php
                        $select_active_products=$conn->prepare("SELECT * FROM `products`WHERE seller_id=? AND status=?");
                        $select_active_products->execute([$seller_id,'active']);
                        $number_of_active_products=$select_active_products->rowCount();
                        ?>
                        <h3><?= $number_of_active_products; ?></h3>
                        <p>total active products</p>
                        <a href="active.php" class="btn">view active product</a>
                    </div>

                    <div class="box">
                        <?php
                        $select_deactive_products=$conn->prepare("SELECT * FROM `products`WHERE seller_id=? AND status=?");
                        $select_deactive_products->execute([$seller_id,'inactive']);
                        $number_of_deactive_products=$select_deactive_products->rowCount();
                        ?>
                        <h3><?= $number_of_deactive_products; ?></h3>
                        <p>total inactive products</p>
                        <a href="inactive.php" class="btn">view inactive product</a>
                    </div>

                    

                    <div class="box">
                        <?php
                        $select_orders=$conn->prepare("SELECT * FROM `orders` WHERE seller_id=?");
                        $select_orders->execute([$seller_id]);
                        $number_of_orders=$select_orders->rowCount();
                        ?>
                        <h3><?= $number_of_orders; ?></h3>
                        <p>total orders placed</p>
                        <a href="seller_order.php" class="btn">total orders</a>
                    </div>

                    <div class="box">
                        <?php
                        $select_confirm_orders=$conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND status=?");
                        $select_confirm_orders->execute([$seller_id,'in progress']);
                        $number_of_confirm_orders=$select_confirm_orders->rowCount();
                        ?>
                        <h3><?= $number_of_confirm_orders; ?></h3>
                        <p>total confirm orders</p>
                        <a href="confirm_order.php" class="btn">confirm orders</a>
                    </div>

                    <div class="box">
                        <?php
                        $select_confirm_orders=$conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND transaction_type=?");
                        $select_confirm_orders->execute([$seller_id,'swap']);
                        $number_of_confirm_orders=$select_confirm_orders->rowCount();
                        ?>
                        <h3><?= $number_of_confirm_orders; ?></h3>
                        <p>total swap orders</p>
                        <a href="swap_order.php" class="btn">swap orders</a>
                    </div>

                    <div class="box">
                        <?php
                        $select_canceled_orders=$conn->prepare("SELECT * FROM `orders` WHERE seller_id=? AND status =?");
                        $select_canceled_orders->execute([$seller_id,'cancled']);
                        $number_of_canceled_orders=$select_canceled_orders->rowCount();
                        ?>
                        <h3><?= $number_of_canceled_orders; ?></h3>
                        <p>total cancled orders</p>
                        <a href="cancel_order.php" class="btn">cancled orders</a>
                    </div>

                </div>
            <?php endif; ?>
         </section>

    </div>
    
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="../js/seller_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>