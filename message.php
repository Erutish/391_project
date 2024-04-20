
<?php
    include 'components/connect.php';

    if(isset($_COOKIE['user_id'])){
        $user_id=$_COOKIE['user_id']; 
    }else{
        $user_id="location:login.php";
    }


    if (isset($_POST['delete_msg'])){

        $delete_id=$_POST['delete_id'];
        $delete_id=filter_var($delete_id,FILTER_SANITIZE_STRING);

        $verify_delete=$conn->prepare("SELECT * FROM `message` WHERE id=?" );
        $verify_delete->execute([$delete_id]);
        
        if($verify_delete->rowCount()>0){
            $delete_msg=$conn->prepare("DELETE FROM `message` WHERE id=?" );
            $delete_msg->execute([$delete_id]);
            $success_msg[]='Message deleted successfully!';
        }else{
            $warning_msg[]='This Message already deleted!';
        }

    }

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-user message page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <div class="banner">
        <div class="detail">
            <h1>Comments</h1>
            <p>Lorem ips aspernatur! Commodi, velit cum. Sed accusamus,<br> voluptates possimus ullam temporibus molestias adipisci tempora!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>comments</span>
        </div>
    </div>

    <section class="message-container">
            <div class="heading">
                <h1>Unread message</h1>
                <img src="images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->

            <div class="box-container">
                <?php 
                    

                    $select_message=$conn->prepare ("SELECT * FROM `message` ");
                    $select_message ->execute();
                    if($select_message->rowCount()>0){
                        while($fetch_message=$select_message->fetch(PDO::FETCH_ASSOC)){

                   
                ?>
                <div class="box">
                    <h3 class="name">Admin</h3>
                    <h4 ><?=$fetch_message['subject']; ?></h4>
                    <p><?=$fetch_message['message']; ?></p>
                    <form action="" method="post">
                        <input type="hidden" name="delete_id" value="<?=$fetch_message['id']?>"/>
                        <input type="submit" name="delete_msg" value="delete message" class="btn" onclick="return confirm('delete this message')">

                    </form>
                </div>
                <?php
                        }
                    }else{
                        echo'
                        <div class="empty">
                            <p>no unread message yet!</p>
                        </div>
    
                        
                        ';
                    }
                ?>
                

            </div>
         </section>

    </div>
    
    



    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>