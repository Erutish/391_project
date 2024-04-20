<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id = $_COOKIE["admin_id"];
} else {
    $admin_id = '';
    header("Location:login.php");
}

$get_id = $_GET['post_id'];

//delete product

if (isset($_POST['delete'])) {
    $p_id = $_POST['product_id'];
    $p_id = filter_var(($p_id), FILTER_SANITIZE_STRING);

    $delete_image = $conn->prepare("DELETE FROM `products` WHERE id = ? ");
    $delete_image->execute([$p_id]);

    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_delete_image[''] != '') {
        unlink('../uploaded_files/' . $fetch_delete_image['image']);
    }
    $delete_product = $conn->prepare("DELETE FROM `products` WHERE id=? ");
    $delete_product->execute([$p_id]);
    header("location:view_product.php");

    
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-seller show Product page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

</head>

<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="read-post">
            <div class="heading">
                <h1>product details</h1>
                <img src="../images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->
            <div class="box-container">
                <?php
                $select_product = $conn->prepare("SELECT * FROM `products` WHERE id =? ");
                $select_product->execute([$get_id]);

                if ($select_product->rowCount() > 0) {
                    while ($fetch_product = $select_product->fetch(PDO::FETCH_ASSOC)) {

                ?>
                        <form action="" method="post" class="box">
                            <input type="hidden" name="product_id" value="<?= $fetch_product['id']; ?>" />
                            <div class="status" style="color: <?php
                                                                if ($fetch_product['status'] == 'active') {
                                                                    echo 'green';
                                                                } else {
                                                                    echo 'coral';
                                                                } ?>"><?= $fetch_product['status']; ?>
                            </div>
                            <?php

                            if ($fetch_product['image'] != '') { ?>
                                <img src="../uploaded_files/<?= $fetch_product['image']; ?>" alt="Product Image" class="image" />
                            <?php } ?>
                            <div class="price">$<?= $fetch_product['price']; ?>/-</div>
                            <div class="title"><?= $fetch_product['name']; ?></div>
                            <div class="content"><?= $fetch_product['product_details']; ?></div>

                            <div class="flex-btn">
                                <a href="edit_product.php?id=<?= $fetch_product['id']; ?>" class="btn">edit</a>
                                <button type="submit" name="delete" class="btn" onclick="return confirm('delete this product');">delete</button>
                                <a href="view_product.php?post_id=<?= $fetch_product['id']; ?>" class="btn">go back</a>
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






    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="../js/seller_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>

</html>