



<header>
    <div class="logo">
        <img src="../images/logo.png" width="130px">
    </div>
    <div class="right">
        <div class="fa-solid fa-user" id="user-btn"></div>
        <div class="toggle-btn"><i class="fa-solid fa-bars"></i></div>
    </div>
    <div class="profile-detail">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM sellers WHERE id=?");
        $select_profile->execute([$seller_id]);

        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
            <div class="profile">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" alt="logo" width="100" />
                <p><?= $fetch_profile["name"]; ?></p>
                <div class="flex-btn">
                    <a href="profile.php" class="btn">profile</a>
                    <a href="../components/seller_logout.php" onclick="return confirm('logout from this website?')" class="btn">Log out</a>
                </div>
            </div>
        <?php } ?>
    </div>
</header>

<div class="sidebar-container">
    <div class="sidebar">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM sellers WHERE id=?");
        $select_profile->execute([$seller_id]);

        if ($select_profile->rowCount() > 0) {
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
            <div class="profile">
                <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" class="logo-img" width="100" />
                <p><?= $fetch_profile["name"]; ?></p>
            </div>
        <?php } ?>
        <h4>menu</h4>
        <div class="navbar">
            <ul>
                <li><a href="dashboard.php"><i class="fa-solid fa-house"></i>Dashboard</a></li>
                <li><a href="add_product.php"><i class="fa-solid fa-bag-shopping"></i>add products</a></li>
                <li><a href="view_product.php"><i class="fa-solid fa-folder-minus"></i></i></i>view product</a></li>
     
                <li><a href="../components/seller_logout.php" onclick="return confirm('logout from this website');"><i class="fa-solid fa-right-from-bracket"></i></i>logout</a></li>
            </ul>
        </div>
        <h4>find us</h4>
        <div class="social-links">
        <a href="https://www.facebook.com/profile.php?id=100008139584079" target="_blank"><i class="fa-brands fa-facebook"></i></a>
        <a href="" target="_blank"><i class="fa-brands fa-twitter"></i></a>
        <a href="" target="_blank"><i class="fa-brands fa-linkedin"></i></a>
        <a href="https://github.com/Erutish?tab=projects" target="_blank"><i class="fa-brands fa-github"></i></a>
        <a href="" target="_blank"><i class="fa-brands fa-pinterest"></i></a>
        </div>
    </div>
</div>