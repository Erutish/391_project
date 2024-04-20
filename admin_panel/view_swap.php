
<?php
include '../components/connect.php';

if (!isset($_COOKIE['admin_id'])) {
    header("Location: login.php");
    exit();
}

$admin_id = $_COOKIE["admin_id"];

if (!isset($_GET['order_id'])) {
    header("Location:dashboard.php"); // Redirect to dashboard if order ID is not provided
    exit();
}

$order_id = $_GET['order_id']; // Retrieve the order ID from the URL

// Fetch swap details based on the provided order ID
$select_swap = $conn->prepare("SELECT * FROM `swap` WHERE product_id IN (SELECT product_id FROM `orders` WHERE id = ?)");
$select_swap->execute([$order_id]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com - View Swaps</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <!-- Include your CSS and JS files -->
</head>

<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="read-container">
            <div class="heading">
                <h1>Swap Details</h1>
                <img src="../images/separator-img.png" alt="Separator Image">
            </div>
            <div class="box-container">
                <?php
                if ($select_swap->rowCount() > 0) {
                    while ($fetch_swap = $select_swap->fetch(PDO::FETCH_ASSOC)) {
                        // Fetch additional information from the product table using user_product_id
                        $user_product_id = $fetch_swap['user_product_id'];
                        $select_product_info = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                        $select_product_info->execute([$user_product_id]);
                        $product_info = $select_product_info->fetch(PDO::FETCH_ASSOC);
                ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="product_id" value="<?= $product_info['id']; ?>" />
                            <div class="status" style="color: <?php
                                                                if ($product_info['status'] == 'active') {
                                                                    echo 'green';
                                                                } else {
                                                                    echo 'coral';
                                                                } ?>"><?= $product_info['status']; ?>
                            </div>
                            <?php

                            if ($product_info['image'] != '') { ?>
                                <img src="../uploaded_files/<?= $product_info['image']; ?>" alt="Product Image" class="image" />
                            <?php } ?>
                            <div class="price">$<?= $product_info['price']; ?>/-</div>
                            <div class="title"><?= $product_info['name']; ?></div>
                            <div class="content"><?= $product_info['product_details']; ?></div>

                            <div class="flex-btn">
                              
                                <a href="sawp_order.php?post_id=<?= $product_info['id']; ?>" class="btn">go back</a>
                            </div>



                        </form>
                <?php
                    }
                } else {
                    echo '
                    <div class="empty">
                        <p>no products added yet!<br><br><a href="add_product.php" class="btn" style="margin-top:1.5rem;">add products</a></p>
                    </div>
                        
                        ';
                }
                ?>
            </div>
        </section>
    </div>
    <!-- Include your JavaScript files -->
</body>

</html>
