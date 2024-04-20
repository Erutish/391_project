
<?php
    include 'components/connect.php';
    if(isset($_COOKIE['user_id'])){
        $user_id=$_COOKIE['user_id']; 
    }else{
        $user_id="location:login.php";
    }

    include 'components/add_cart.php';

    //update qty incart
    if (isset($_POST["update_cart"])) {
        $cart_id=$_POST['cart_id'];
        $cart_id=filter_var($cart_id, FILTER_SANITIZE_STRING);

        $qty=$_POST['qty'];
        $qty=filter_var($qty, FILTER_SANITIZE_STRING);

        $update_qty=$conn->prepare("UPDATE `cart`SET qty=?  WHERE id=?");
        $update_qty->execute([$qty,$cart_id]);

        $success_msg[]='cart quantity updated successfully';
    }


    //remove product from wishlist
    if (isset($_POST["delete_item"])){
        $cart_id=$_POST['cart_id'];
        $cart_id=filter_var($cart_id, FILTER_SANITIZE_STRING);

        $verify_delete=$conn->prepare("SELECT * FROM `cart` WHERE id=?");
        $verify_delete->execute([$cart_id]);

        if ($verify_delete->rowCount()>0){
            $delete_cart_id=$conn->prepare("DELETE FROM `cart` WHERE id=?");
            $delete_cart_id->execute([$cart_id]);
            $success_msg[]= "Item removed successfully.";
            
        } else {
            $warning_msg[] = "This item already deleted from your cart.";

            }
    }

    //empty cart

    if (isset($_POST["empty_cart"])){

        $verify_empty=$conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
        $verify_empty->execute([$user_id]);

        if ($verify_empty->rowCount()>0){
            $delete_cart_id=$conn->prepare("DELETE FROM `cart` WHERE user_id=?");
            $delete_cart_id->execute([$user_id]);
            $success_msg[]= "empty cart  successfully.";
            
        } else {
            $warning_msg[] = "your cart is already empty.";

            }
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-my cart page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>my cart</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>my cart</span>
        </div>
    </div>
    <div class="products">
        <div class="heading">
            <h1>my cart</h1>
            <img src="images/separator-img.png">
        </div>
        <div class="box-container">
            <?php
                $grand_total =0;

                $select_cart=$conn->prepare("SELECT * FROM `cart` WHERE user_id=?");
                $select_cart->execute([$user_id]);

                if($select_cart->rowCount() > 0){
                    while ($fetch_cart=$select_cart->fetch(PDO::FETCH_ASSOC)) { 
                        $select_products=$conn->prepare("SELECT * FROM `products` WHERE id=?");
                        $select_products->execute([$fetch_cart['product_id']]);

                        if($select_products->rowCount()>0){
                            $fetch_products=$select_products->fetch(PDO::FETCH_ASSOC);
            ?>
            <form action="" method="POST" class="box <?php if($fetch_products['stock']==0){echo"disabled";}?>">
                <input type="hidden" name="cart_id" value="<?=$fetch_cart['id'];?>">
                <img src="uploaded_files/<?= $fetch_products['image'];?>" alt="Product Image" class="image"/>
                <?php if($fetch_products['stock']>5){ ?>
                    <span class="stock" style="color:white;">In stock</span>
                <?php }elseif ($fetch_products['stock']==0){?>
                    <span class="stock" style="color:red;">out of stock</span>
                <?php }else{ ?>
                    <span class="stock" style="color:red;">Hurry,only <?=$fetch_products['stock']?> left in stock</span>
                <?php }?>

                <div class="content">
                    <img src="images/shape-19.png" class="shap">
                    <h3 class="name"><?= $fetch_products['name'];?></h3>
                    <div class="flex-btn">
                            <p class="price">price $<?= $fetch_products['price'];?>/-</p>
                            <input type="number" name="qty" required min="1" value="1" max="99" maxlength="2" class=" box qty">
                            <button type ="submit" name="update_cart" class="fa-solid fa-pen-to-square box" style="width:48%"></button>
                    </div>
                    
                    <div class="flex-btn"> 
                        <p class="sub-total">sub total:<span>$<?=$sub_total=($fetch_cart['qty']*$fetch_cart['price']); ?></span></p>
                        <button type="submit" name="delete_item" class="btn" onclick="return confirm('remove form cart');">delete</button>
                    </div>


                </div>
            </form>
            <?php
                        $grand_total+=$sub_total;
                        }else{
                            echo "
                                <div class=empty>
                                  <p>No Products found</p>
                                </div>
                            ";
                        }
                    }
                }else{
                    echo "
                        <div class=empty>
                          <p>No Products added yet</p>
                        </div>
                    ";
                }
            ?>
        </div>
        <?php if($grand_total!=0) { ?>
            <div class="cart-total">
                <p>total amount payable:<span>$ <?=$grand_total;?>/-</span></p>
                <div class="button">
                    <form action="" method="post">
                        <button type="submit" name="empty_cart" class="btn" onclick="return confirm('are you sure to empty your cart');">Empty Cart</button>
                        <a href="checkout.php?g_id=<?= $fetch_products['id'];?>" class="btn">checkout</a>
                    </form>
                </div>
            </div>
        <?php  } ?>
    </div>

    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>