<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id= $_COOKIE["user_id"]; 
    }else{
        $user_id='';
        
    }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com about-us page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>
    <?php include 'components/user_header.php'; ?>

    <div class="banner" style="background-image:url('images/e_camera\ -\ Copy.jpg')">
        <div class="detail">
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ut, veniam! Sunt quam ratione culpa cupiditate, earum quas neque <br>quaerat assumenda impedit 
            explicabo dolorem repellat et illum, voluptas est facere esse!</p>
            <span><a href="index.php">Home</a><i class="fa-solid fa-angle-right"></i>about us</span>
        </div>
    </div>
    <div class="chef">
        <div class="box-container">
            <div class="box">
                <div class="heading">
                    <span>Erutish</span>
                    <h1>ID:23241131</h1>
                    <img src="images/separator-img.png">
                </div>
                <p>e-commerce niye peragraph</p>
                <div class="flex-btn">
                    <a href="menu.php" class="btn">explore our TechItems</a>
                    <a href="index.php" class="btn">visit our shop</a>
                </div>
            </div>
            <div class="box">
                <img src="images/era.JPG" class="img">
            </div>
        </div>
    </div>
    <div class="story">
        <div class="heading">
            <h1>Our story</h1>
            <img src="images/separator-img.png">
        </div>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, tempore, mollitia placeat eos <br>
        odit autem debitis in consectetur, dolore dignissimos itaque sunt ducimus cupiditate? Consectetur,<br>
        ea. Odio voluptate accusantium sint.</p>
        <a href="menu.php" class="btn">our services</a>   
    </div>

    <div class="standers">
        <div class="detail">
            <div class="heading">
                <h1>our standerts</h1>
                <img src="images/separator-img.png">
            </div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem ab minima </p>
            <i class="fa-solid fa-heart"></i>
            <p>voluptatem aspernatur aliquam nemo dolorum, laborum vel corporis, molestiae</p>
            <i class="fa-solid fa-heart"></i>
            <p>voluptatem aspernatur aliquam nemo dolorum, laborum vel corporis, molestiae </p>
            <i class="fa-solid fa-heart"></i>
            <p>voluptatem aspernatur aliquam nemo dolorum, laborum vel corporis, molestiae </p>
            <i class="fa-solid fa-heart"></i>
            <p>voluptatem aspernatur aliquam nemo dolorum, laborum vel corporis, molestiae</p>
            <i class="fa-solid fa-heart"></i>
        </div>
    </div>

    






    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>