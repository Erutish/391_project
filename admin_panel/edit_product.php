
<?php
include '../components/connect.php';

if (isset($_COOKIE['admin_id'])) {
    $admin_id= $_COOKIE["admin_id"]; 
}else{
    $admin_id='';
    header( "Location:login.php" );
       
    }

    if(isset($_POST['update'])){

        $product_id=$_POST['product_id'];
        $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);

        $name=$_POST['name'];
        $name=filter_var($name,FILTER_SANITIZE_STRING);

        $price=$_POST['price'];
        $price=filter_var($price,FILTER_SANITIZE_STRING);

        $description=$_POST['description'];
        $description=filter_var($description,FILTER_SANITIZE_STRING);

        $stock=$_POST['stock'];
        $stock=filter_var($stock,FILTER_SANITIZE_STRING);

        $status =$_POST['status'];
        $status=filter_var($status,FILTER_SANITIZE_STRING);

        $swap=$_POST[ 'swap'];
        $swap=filter_var($swap,FILTER_SANITIZE_STRING);

        $update_product=$conn->prepare("UPDATE `products` SET name= ?, price = ?, product_details= ?, stock=?, status= ?, swap= ? WHERE id=?  " );
        $update_product->execute([$name,$price,$description,$stock,$status,$swap,$product_id]);

        $success_msg[]="product updated";

        $old_image=$_POST['old_image'];
        $image=$_FILES['image']['name'];

        $image_size=$_FILES['image']['size'];
        $image_tmp_name=$_FILES['image']['tmp_name'];
        $image_folder= "../uploaded_files/".$image;

        $select_image=$conn->prepare("SELECT * FROM `products` WHERE image = ?  " );
        $select_image->execute([$image,]);

        if (!empty($image)){
            if($image_size>2000000000){
                $warning_msg[]='image size is too large!';
            }elseif($select_image->rowCount()>0 AND $image!=""){
                $warning_msg[]='please rename your image';
            }else{
                $update_image=$conn->prepare('UPDATE `products` SET image =? WHERE id=?'  );
                $update_image->execute([$image,$product_id]);
                move_uploaded_file($image_tmp_name,$image_folder);
                if ($old_image != $image AND $old_image!="") {
                    unlink("../uploaded_files/".$old_image);
                }
                $success_msg[]='image updated successfully';
            }
        }
    }

    //delete image
    if (isset($_POST['delete_image'])){
        $empty_image='';
        $product_id=$_POST['product_id'];
        $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);

        $delete_image=$conn->prepare("SELECT * FROM `products` WHERE id=?" );
        $delete_image->execute([$product_id]);
        $fetch_delete_image=$delete_image->fetch(PDO::FETCH_ASSOC);

        if($fetch_delete_image['image']!=''){
            unlink("../uploaded_files/".$fetch_delete_image['image']);
        }
        $unset_image=$conn->prepare("UPDATE `products` SET image=? WHERE id=?");
        $unset_image->execute([$empty_image,$product_id]);
        $success_msg[]='image deleted successfully';


    }


    //delete product
    if (isset($_POST['delete_product'])){
        $product_id=$_POST['product_id'];
        $product_id=filter_var($product_id,FILTER_SANITIZE_STRING);

        $delete_image=$conn->prepare("SELECT * FROM `products` WHERE id=?" );
        $delete_image->execute([$product_id]);
        $fetch_delete_image=$delete_image->fetch(PDO::FETCH_ASSOC);

        if($fetch_delete_image['image']!=''){
            unlink("../uploaded_files/".$fetch_delete_image['image']);
        }
        $delete_product=$conn->prepare("DELETE FROM `products` WHERE id=?");
        $delete_product->execute([$product_id]);
        $success_msg[]='product deleted successfully!';
        header( "Location: view_product.php" ) ; 
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
         <?php include '../components/admin_header.php'; ?>
         <section class="post-editor">
            <div class="heading">
                <h1>edit product</h1>
                <img src="../images/separator-img.png">
            </div>

            <!-- admin approve na korle pending dekhabe -->
            <div class="box-container">
                <?php
                $product_id = $_GET['id'];
                $select_product=$conn->prepare("SELECT * FROM `products` WHERE  id =? ");
                $select_product->execute([$product_id]);
                if($select_product->rowCount()>0){
                    while($fetch_product=$select_product->fetch(PDO::FETCH_ASSOC)){

                ?>
                <div class="form-container">
                    <form action="" method="POST" enctype="multipart/form-data" class="register">
                        <input type="hidden" name="old_image" value="<?=$fetch_product['image'];?>"/>
                        <input type="hidden" name="product_id" value="<?=$fetch_product['id'];?>"/>

                        <div class="input-field">
                            <p>product status<span>*</span></p>
                            <select name="status" class="box">
                                <option value="active" <?= $fetch_product['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= $fetch_product['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                            </select>
                        </div>

                        <div class="input-field">
                            <p>product name<span>*</span></p>
                            <input type="text" name="name" value="<?=$fetch_product['name'];?>" class="box">  
                        </div>

                        <div class="input-field">
                            <p>product price<span>*</span></p>
                            <input type="text" name="price" value="<?=$fetch_product['price'];?>" class="box">  
                        </div>

                        <div class="input-field">
                            <p>product description<span>*</span></p>
                            <textarea name="description" class="box"> value="<?=$fetch_product['product_details'];?>"</textarea>
                        </div>

                        <div class="input-field">
                            <p>product stock<span>*</span></p>
                            <input type="number" name="stock" value="<?=$fetch_product['stock'];?>" class="box" min="0" max="999999" maxlength="10">  
                        </div>

                        <div class="input-field">
                            <p>swap option<span>*</span></p>
                            <select name="swap" class="box">
                                <option value="enable" <?= $fetch_product['swap'] == 'enable' ? 'selected' : '' ?>>Enable</option>
                                <option value="disable" <?= $fetch_product['swap'] == 'disable' ? 'selected' : '' ?>>Disable</option>
                            </select>

                        </div>

                        <div class="input-field">
                            <p>product image<span>*</span></p>
                            <input type="file" name="image" accept="image/*" class="box">  
                            <?php
                            if ($fetch_product["image"] != "") {?>
                            <img src="../uploaded_files/<?=$fetch_product['image'];?>" class="image">
                            <div class="flex-btn">
                                <button type="submit" name="delete_image" class="btn" value="delete image">delete</button>
                                <a href="view_product.php" class="btn" >go back </a>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="flex-btn">
                            <input type="submit" name="update" value="update product" class="btn">
                            <input type="submit" name="delete_product" value="delete product" class="btn">
                        </div>
                    </form>
                </div>

                <?php 
                        }
                    }else{
                        echo'
                        <div class="empty">
                            <p>no products added yet!<br><br><a href="add_product.php" class="btn" style="margin-top:1.5rem;">add products</a></p>
                        </div>
                        ';
                    
                ?>
                <br><br>
                <div class="flex-btn">
                    <a href="view_product.php" class="btn">view product</a>
                    <a href="add_product.php" class="btn">add product</a>
                </div>
                <?php } ?>
            </div>
         </section>
    </div>
    
    



    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="../js/seller_script.js"></script>
    <?php include '../components/alert.php'; ?>
</body>
</html>