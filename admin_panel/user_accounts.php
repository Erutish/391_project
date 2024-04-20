
<?php
    include '../components/connect.php';

    if (isset($_COOKIE['admin_id'])) {
        $admin_id= $_COOKIE["admin_id"]; 
    }else{
        $admin_id='';
        header( "Location:login.php" );
        
    }

    if (isset($_POST['delete'])) {
        $p_id = $_POST['user_id'];
        $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);
    
        $delete_product = $conn->prepare("DELETE FROM `users` WHERE id = ?");
        $delete_product->execute([$p_id]);
    
        $success_msg[] = "user Deleted Successfully!";
    }
    

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com- registered userer page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

</head>
<body>
    <div class="main-container">
         <?php include '../components/admin_header.php'; ?>
         <section class="user-container">
            <div class="heading">
                <h1>registered users</h1>
                <img src="../images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->

            <div class="box-container">
                <?php 
                    $select_users=$conn->prepare ("SELECT * FROM `users` ");
                    $select_users ->execute();
                    if($select_users->rowCount()>0){
                        while($fetch_users=$select_users->fetch(PDO::FETCH_ASSOC)){
                            $user_id=$fetch_users['id'];
                    ?>

                        <div class="box">
                            <img src="../uploaded_files/<?=$fetch_users['image']; ?>">
                            <p>user id: <span><?=$user_id; ?></span></p> 
                            <p>user name: <span><?=$fetch_users['name']; ?></span></p> 
                            <p>user email: <span><?=$fetch_users['email']; ?></span></p> 
                            <p>user number: <span><?=$fetch_users['number']; ?></span></p>
                            <form method="POST">
                                <!-- Add a hidden input field to store the user ID -->
                                <input type="hidden" name="user_id" value="<?=$user_id?>">
                                <div class="flex-btn" style="justify-content: center;">
                                    <button type="submit" name="delete" class="btn" onclick="return confirm('delete this user');">Delete</button>
                                </div>
                            </form>
                        </div>


                    <?php
                            }
                        }else{
                            echo'
                            <div class="empty">
                                <p>no user registered yet!</p>
                            </div>
        
                            
                            ';
                        }
                    ?>
                

            </div>
         </section>

    </div>
    
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="../js/seller_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>