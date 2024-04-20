
<?php
    include 'components/connect.php';
    if(isset($_COOKIE['user_id'])){
        $user_id=$_COOKIE['user_id']; 
    }else{
        $user_id="";
    }
 
    if(isset($_GET['order_id'])){
        $get_id=$_GET['order_id']; 
    }else{
        $get_id="";
        header( "Location: order.php" );
    }
    
    if(isset($_GET['product_id'])){
        $product_id=$_GET['product_id']; 
    }else{
        $pruduct_id="";
        header( "Location: order.php" );
    }
    
    if (isset($_POST["cancle"])){
        

        $update_order=$conn->prepare("UPDATE `orders` SET status=? WHERE id=?");
        $update_order->execute(['cancled',$get_id]);

    }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-order details page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>order details</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>order details</span>
        </div>
    </div>

    <div class="orders-detail">
        <div class="heading">
            <h1>my order detail</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <img src="images/separator-img.png">
        </div>
        <div class="box-container">
            <?php 
                $grand_total=0;
                $select_order=$conn->prepare ("SELECT * FROM `orders` WHERE product_id=? LIMIT 1");
                $select_order ->execute([$product_id]);

                if($select_order->rowCount()>0){
                    while($fetch_order=$select_order->fetch(PDO::FETCH_ASSOC)){
            
                        $select_product=$conn->prepare ("SELECT * FROM `products` WHERE id=? LIMIT 1  ");
                        $select_product ->execute([$fetch_order['product_id']]);

                        if($select_product->rowCount()>0){
                            while($fetch_product=$select_product->fetch(PDO::FETCH_ASSOC)){
                                $sub_total = ($fetch_order['price']*$fetch_order['qty']);
                                $grand_total+=$sub_total;

            ?>
            <div class="box">
                <div class="col">
                    <p class="title">
                        <i class="fa-solid fa-calendar-days"></i><?= $fetch_order['dates']; ?>
                    </p>
                    <img src="uploaded_files/<?= $fetch_product['image']; ?>" class="image">
                    <p class="price">$<?= $fetch_product['name']; ?>/-</p>
                    <h3 class="name"><?= $fetch_product['name']; ?></h3>
                    <p class="grand-total">total amount payable:<span>$ <?=$grand_total;?>/-</span></p>
                </div>
                <div class="col">
                    <p class="title">billing Address</p>
                    <p class="user"><i class="fa-regular fa-user"></i><?= $fetch_order['name']; ?></</p>
                    <p class="user"><i class="fa-solid fa-phone"></i><?= $fetch_order['number']; ?></</p>
                    <p class="user"><i class="fa-regular fa-envelope"></i><?= $fetch_order['email']; ?></</p>
                    <p class="user"><i class="fa-solid fa-location-pin"></i><?= $fetch_order['address']; ?></</p>
                    <p class="status" style="color: <?php 
                    if($fetch_order['status'] =='delivered'){ echo 'green'; } elseif($fetch_order['status']=='cancled') 
                    { echo 'red'; }else{echo "orange";} ?>"><?= $fetch_order['status'];?></p>
                    <?php if($fetch_order[ 'status' ]==='cancled'){?>
                        <a href="checkout.php?get_id=<?= $fetch_product['id']; ?>" class="btn" style="line-height:3;"> order again</a>
                        <?php }else{ ?>
                            <form action="" method="post">
                                <button type="submit" name="cancle" class="btn" onclick="return confirm('do you want to cancle this product');"> cancle</button>
                            </form>
                        <?php } ?>
                </div>
            </div>

            <?php
                            }
                        }
                    }
                }else{
                    echo "
                        <p class=empty>
                          No order atake placed yet
                        </p>
                    ";
                }
            ?>
        </div>
    </div>
   



    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>