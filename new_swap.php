<?php 
include 'components/connect.php';

// Check if user is logged in and is a registered seller
if(!isset($_COOKIE['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_COOKIE['user_id'];

$select_email = $conn->prepare("SELECT email FROM users WHERE id = ?");
$select_email->execute([$user_id]);

$user_email = $select_email->fetchColumn();

if (!$user_email) {
    exit("User email not found.");
    
}

$seller_check = $conn->prepare("SELECT * FROM sellers WHERE email = ?");
$seller_check->execute([$user_email]);

if ($seller_check->rowCount() == 0) {
    $warning_msg[]="You need to register as a seller first to swap products.";
    header("Location: seller_panel/register.php");
}

$seller_info = $seller_check->fetch(PDO::FETCH_ASSOC);
$seller_id = $seller_info['id'];
$seller_name = $seller_info['name'];

//user product
$select_user_product = $conn->prepare("SELECT * FROM products WHERE seller_id = ?");
$select_user_product->execute([$seller_id]);
if ($select_user_product->rowCount() == 0) {
    // Handle case where product is not found
    exit("Product not found.");
}
$user_product = $select_user_product->fetch(PDO::FETCH_ASSOC);
$user_product = $user_product['id'];

/////////////////////////////////////////
// Retrieve product ID and seller ID from URL parameters
if(isset($_GET['pid'])) {
    $product_id = $_GET['pid'];
} else {
    // Handle case where product ID is not provided
    exit("Product ID not provided.");
}

// Fetch product details based on product ID
$select_product = $conn->prepare("SELECT * FROM products WHERE id = ?");
$select_product->execute([$product_id]);

if ($select_product->rowCount() == 0) {
    // Handle case where product is not found
    exit("Product not found.");
}

$product_details = $select_product->fetch(PDO::FETCH_ASSOC);
$product_seller_id= $product_details['id'];
$product_seller= $product_details['seller_id'];
$product_name = $product_details['name'];
$product_price = $product_details['price'];

// Handle form submission
if(isset($_POST['swap'])) {
    // Insert swap details into swap table
    $user_product_id = $user_product; // Product ID of the user initiating the swap
    $user_id = $user_id; // Seller ID of the user initiating the swap
    $name = $product_name;
    $number = $seller_info['number'];
    $email = $user_email;
    $product_id = $product_seller_id; // Product ID of the product being swapped
    $price = $product_price;
    $qty = 1; // Assuming quantity is always 1 for swapping
    $dates = date('Y-m-d');
    $status = 'in progress';
    $payment_status = 'pending';

    // Generate a unique ID for the swap
    $swap_id = uniqid();

    // Insert swap details into the swap table
    $insert_swap = $conn->prepare("INSERT INTO swap (id, user_id, seller_id, name, number, email, user_product_id, product_id, price, qty, dates, status, payment_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert_swap->execute([$swap_id, $user_id, $product_seller, $name, $number, $email, $user_product_id, $product_id, $price, $qty, $dates, $status, $payment_status]);


    //Insert Order
    $insert_order = $conn->prepare("INSERT INTO orders (id, user_id, seller_id, name, number, email, address,address_type,method, product_id, price, qty, dates, transaction_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)");
    $insert_order->execute([$swap_id, $user_id, $product_seller, $seller_name, $number, $email, 'swap','home','only swap', $product_id, $price, 1, $dates, 'swap']);
    // Redirect user to a confirmation page or perform any other necessary action
    header("Location: order.php?swap_id=$swap_id");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-swap page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>swap your product</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>swap your product</span>
        </div>
    </div>
    <<section class="show-post">
        <div class="heading">
            <h1>your product</h1>
            <img src="images/separator-img.png">
        </div>

        <!-- admin approve na korle pending dekhabe -->
        <div class="box-container">
            <?php
            $select_products=$conn->prepare("SELECT * FROM `products` WHERE seller_id=? AND status='active' AND swap='enable' ");
            $select_products->execute([$seller_id]);
            if($select_products->rowCount()>0){
                while($fetch_products=$select_products->fetch(PDO::FETCH_ASSOC)){
            ?>
                <form action="" method="POST" class="box">
                    <input type="hidden" name="product_id" value="<?=$fetch_products['id'];?>"/>
                    <?php if($fetch_products['image']!=''){?>
                        <img src="uploaded_files/<?= $fetch_products['image'];?>" alt="Product Image" class="image"/>
                    <?php } ?>
                    <div class="status" style="color: <?php 
                        if($fetch_products['status'] =='active'){ echo 'green'; } else { echo 'red'; } ?>"><?= $fetch_products['status'];?>
                    </div>
                    <div class="price">$<?=$fetch_products['price'];?>/-</div>
                    <div class="content">
                        <img src="images/shape-19.png" class="shap">
                        <div class="title"><?=$fetch_products['name'];?></div>
                        <div class="flex-btn">
                            <button type="submit" name="swap" class="btn">Swap</button>
                        </div>
                    </div>
                </form>
            <?php 
                }
            }else{
                echo'
                <div class="empty">
                    <p>no products added yet!<br><br></p>
                </div>';
            }
            ?>
        </div>
    </section>

    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>
