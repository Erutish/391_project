
<?php
    include '../components/connect.php';

    if (isset($_COOKIE['seller_id'])) {
        $seller_id= $_COOKIE["seller_id"]; 
    }else{
        $seller_id='';
        header( "Location:login.php" );
        
    }

    if(isset($_POST['publish'])){

        $id =unique_id();

        $name=$_POST['name'];
        $name=filter_var($name,FILTER_SANITIZE_STRING);

        $price=$_POST['price'];
        $price=filter_var($price,FILTER_SANITIZE_STRING);

        $description=$_POST['description'];
        $description=filter_var($description,FILTER_SANITIZE_STRING);

        $stock=$_POST['stock'];
        $stock=filter_var($stock,FILTER_SANITIZE_STRING);
        $status ='active';

        $swap=$_POST[ 'swap'];
        $swap=filter_var($swap,FILTER_SANITIZE_STRING);


        $image=$_FILES['image']['name'];
        $image=filter_var($image,FILTER_SANITIZE_STRING);
        $image_size=$_FILES['image']['size'];
        $image_tmp_name=$_FILES['image']['tmp_name'];
        $image_folder= "../uploaded_files/".$image;

        $select_image=$conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id=? " );
        $select_image->execute([$image,$seller_id]);

        if (isset($image)){
            if($select_image->rowCount()>0){
                $warning_msg[]='image name repeated!';
            }elseif($image_size>2000000){
                $warning_msg[]='image size is too large!';
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
            }
        }else{
            $image='';

        }
        if($select_image->rowCount()>0 AND $image != ''){
            $warning_msg[]='please remane your image';
        }else{
            $insert_product=$conn->prepare("INSERT INTO `products`(id,seller_id,name,price,image,stock,product_details,status,swap) VALUES(?,?,?,?,?,?,?,?,?)");
            $insert_product->execute([$id,$seller_id,$name,$price,$image,$stock,$description,$status,$swap]);
            $success_msg[]='product inserted successfully';
        }

    }



    // draft

    if(isset($_POST['draft'])){

        $id =unique_id();

        $name=$_POST['name'];
        $name=filter_var($name,FILTER_SANITIZE_STRING);

        $price=$_POST['price'];
        $price=filter_var($price,FILTER_SANITIZE_STRING);

        $description=$_POST['description'];
        $description=filter_var($description,FILTER_SANITIZE_STRING);

        $stock=$_POST['stock'];
        $stock=filter_var($stock,FILTER_SANITIZE_STRING);
        $status ='inactive';

        $swap=$_POST[ 'swap'];
        $swap=filter_var($swap,FILTER_SANITIZE_STRING);


        $image=$_FILES['image']['name'];
        $image=filter_var($image,FILTER_SANITIZE_STRING);
        $image_size=$_FILES['image']['size'];
        $image_tmp_name=$_FILES['image']['tmp_name'];
        $image_folder= "../uploaded_files/".$image;

        $select_image=$conn->prepare("SELECT * FROM `products` WHERE image = ? AND seller_id=? " );
        $select_image->execute([$image,$seller_id]);

        if (isset($image)){
            if($select_image->rowCount()>0){
                $warning_msg[]='image name repeated!';
            }elseif($image_size>2000000){
                $warning_msg[]='image size is too large!';
            }else{
                move_uploaded_file($image_tmp_name,$image_folder);
            }
        }else{
            $image='';

        }
        if($select_image->rowCount()>0 AND $image != ''){
            $warning_msg[]='please remane your image';
        }else{
            $insert_product=$conn->prepare("INSERT INTO `products`(id,seller_id,name,price,image,stock,product_details,status,swap) VALUES(?,?,?,?,?,?,?,?,?)");
            $insert_product->execute([$id,$seller_id,$name,$price,$image,$stock,$description,$status,$swap]);
            $success_msg[]='product saved as draft successfully';
        }

    }


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acio.com-seller dashboard page</title>
    <link rel="stylesheet" type="text/css" href="../css/seller_style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>

</head>
<body>
    <div class="main-container">
         <?php include '../components/seller_header.php'; ?>
         <section class="post-editor">
            <div class="heading">
                <h1>add product</h1>
                <img src="../images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->
            <div class="form-container">
                <form action="" method="POST" enctype="multipart/form-data" class="register">
                    <div class="input-field">
                        <p>product name <span>*</span></p>
                        <input type="text" name="name" maxlength="100" placeholder="add product name" required class="box"/>
                    </div>

                    <div class="input-field">
                        <p>product price <span>*</span></p>
                        <input type="number" name="price" maxlength="100" placeholder="add product price" required class="box"/>
                    </div>

                    <div class="input-field">
                        <p>product detail <span>*</span></p>
                        <textarea name="description" maxlength="1000" placeholder="add product details" required class="box"></textarea>
                    </div>

                    <div class="input-field">
                        <p>product stock <span>*</span></p>
                        <input type="number" name="stock" maxlength="10" min="0" max="999999" placeholder="add product stock" required class="box"/>
                    </div>

                    <div class="input-field">
                        <p>product image <span>*</span></p>
                        <input type="file" name="image" accept="image/*" required class="box"/>
                    </div>

                    <div class="input-field">
                        <p>swap option <span>*</span></p>
                        <select name="swap" required class="box">
                            <option name="swap" value="enable">enable</option>
                            <option name="swap" value="disable">disable</option>
                        </select>
                    </div>

                    <div class="flex-btn">
                        <input type="submit" name="publish" value="add product" class="btn">
                        <input type="submit" name="draft" value="save as draft" class="btn">
                    </div>

            </div>



         </section>

    </div>
    
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="../js/seller_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>