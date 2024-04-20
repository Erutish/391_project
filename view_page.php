
<?php
    include 'components/connect.php';
    if(isset($_COOKIE['user_id'])){
        $user_id=$_COOKIE['user_id']; 
    }else{
        $user_id="";
    }

   $pid=$_GET['pid'];
   include 'components/add_wishlist.php';
   include 'components/add_cart.php';

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com- product detail page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Product detail </h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>product detail</span>
        </div>
    </div>
   
    <section class="view_page">
        <div class="heading">
            <h1>product detail</h1>
            <img src="images/separator-img.png">
        </div>
        <?php 
            if(isset($_GET['pid'])){
                $pid=$_GET['pid'];
                $select_products=$conn->prepare("SELECT * FROM `products` WHERE id=?");
                $select_products->execute([$pid]);
            
            if ($select_products->rowCount()>0){
                while($fetch_products=$select_products->fetch(PDO::FETCH_ASSOC)) {


        ?>
        <form action="" method="post" class="box">
            <div class="img-box">
                <img src="uploaded_files/<?= $fetch_products['image'];?>">
            </div>
            <div class="detail">
                <?php if($fetch_products['stock']>5){ ?>
                    <span class="stock" style="color:green;">In stock</span>
                <?php }elseif ($fetch_products['stock']==0){?>
                    <span class="stock" style="color:red;">out of stock</span>
                <?php }else{ ?>
                    <span class="stock" style="color:red;">Hurry,only <?=$fetch_products['stock']?> left in stock</span>
                <?php }?>
                <p class="price"><?= $fetch_products['price'];?>/-</p>
                <div class="name"><?= $fetch_products['name'];?></div>
                <p class="product-detail"><?= $fetch_products['product_details'];?>/-</p>
                <input type="hidden" name="product_id" value="<?=$fetch_products['id'];?>">
                <div class="button">
                    <button type="submit" name="add_to_cart" class="btn">add to cart<i class="fa-solid fa-cart-shopping"></i></button>
                    <button type="submit" name="add_to_wishlist" class="btn">add to wishlist<i class="fa-regular fa-heart"></i></button>
                    <input type="hidden" name="qty" value="1" min="0" class="quantity">
                    <?php if($fetch_products['swap']=="enable"){ ?>
                        <a href="swap.php?pid=<?= $fetch_products['id'];?>"  class="btn">swap <i class="fa-solid fa-shuffle"></i></a>
                    <?php }?>
                </div>
            </div>
        </form>

        <?php
                    }

                }
            }
        ?>

    </section>
    <div class="products">
        <div class="heading">
            <h1>similar products</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <img src="images/separator-img.png">
        </div>
        <?php include 'components/shop.php'; ?>
    </div>











    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>