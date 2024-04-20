<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id= $_COOKIE["admin_id"]; 
} else {
    $admin_id='';
    header("Location: login.php");
    exit(); // Terminate script execution after redirection
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $user_id = $_POST['user_id'];

    if ($action == 'delete') {
        $delete_user = $conn->prepare("DELETE FROM `sellers` WHERE id = ?");
        $delete_user->execute([$user_id]);
        $success_msg[] = "Seller Deleted Successfully!";
    } elseif ($action == 'accept') {
        $update_status = $conn->prepare("UPDATE `sellers` SET status = 'accepted' WHERE id = ?");
        $update_status->execute([$user_id]);
        $success_msg[] = "Seller Accepted Successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com- seller request page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

    <style>
        .flex-btn {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <?php include '../components/admin_header.php'; ?>
        <section class="user-container">
            <div class="heading">
                <h1> Sellers Requests</h1>
                <img src="../images/separator-img.png">
            </div>

            <div class="box-container">
                <?php 
                    $select_sellers = $conn->prepare("SELECT * FROM `sellers` WHERE status='pending'");
                    $select_sellers->execute();

                    if ($select_sellers->rowCount() > 0) {
                        while ($fetch_sellers = $select_sellers->fetch(PDO::FETCH_ASSOC)) {
                            $user_id = $fetch_sellers['id'];
                ?>

                <div class="box">
                    <img src="../uploaded_files/<?=$fetch_sellers['image']; ?>">
                    <p>User ID: <span><?=$user_id; ?></span></p> 
                    <p>User Name: <span><?=$fetch_sellers['name']; ?></span></p> 
                    <p>User Email: <span><?=$fetch_sellers['email']; ?></span></p> 
                    <p>User Number: <span><?=$fetch_sellers['number']; ?></span></p>
                    <p>User Status: <span><?=$fetch_sellers['status']; ?></span></p>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?=$user_id?>">
                        <input type="hidden" name="action" value="delete">
                        <div class="flex-btn">
                            <button type="submit" class="btn" onclick="return confirm('Delete this seller?');">Delete</button>
                        </div>
                    </form>
                    <form method="POST">
                        <input type="hidden" name="user_id" value="<?=$user_id?>">
                        <input type="hidden" name="action" value="accept">
                        <div class="flex-btn">
                            <button type="submit" class="btn" onclick="return confirm('Accept this seller?');">Accept</button>
                        </div>
                    </form>
                </div>

                <?php
                        }
                    } else {
                        echo '<div class="empty"><p>No seller requests pending!</p></div>';
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
