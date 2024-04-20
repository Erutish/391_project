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
    <title>Acio.com-home page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet"/>
</head>
<body>

    <?php include 'components/user_header.php'; ?>
    <!--sider section start-->
    <div class="slider-container">
        <div class="slider">
            <div class="slideBox active">
                <div class="textBox">
                    <h1>Crafting Perfection: <br> Unveiling Our Premier Devices </h1>
                    <a href="menu.php" class="btn">Shop Now</a>
                </div>
                <div class="imgBox">
                    <img src="images/slider.jpg" alt="slider" />
                </div>
            </div>
            <div class="slideBox">
                <div class="textBox">
                    <h1>Excellence Redefined <br> Embracing the Best in Technology</h1>
                    <a href="menu.php" class="btn">Shop Now</a>
                </div>
                <div class="imgBox">
                    <img src="images/slider0.jpg" alt="slider" />
                </div>
            </div>
        </div>
        <ul class="controls">
            <li onclick="nextSlide();" class="next"><i class="fa-solid fa-angles-right"></i></li>
            <li onclick="prevSlide();" class="prev"><i class="fa-solid fa-angles-left"></i></li>

        </ul>
    </div>


    <!--sider section end-->
    <!--service section start-->
    <div class="service">
        <div class="box-container">
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="images/services.png" class="img1" />
                        <img src="images/services (1).png" class="img2" />
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="images/services (5).png" class="img1" />
                        <img src="images/services (6).png" class="img2" />
                    </div>
                </div>
                <div class="detail">
                    <h4>payment</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="images/services (2).png" class="img1" />
                        <img src="images/services (3).png" class="img2" />
                    </div>
                </div>
                <div class="detail">
                    <h4>support</h4>
                    <span>24*7 hours</span>
                </div>
            </div>
            <!-- service item box -->
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="images/services (7).png" class="img1" />
                        <img src="images/services (8).png" class="img2" />
                    </div>
                </div>
                <div class="detail">
                    <h4>gift services</h4>
                    <span>support gift service</span>
                </div>
            </div>
            <!-- service item box -->
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="images/service.png" class="img1" />
                        <img src="images/service (1).png" class="img2" />
                    </div>
                </div>
                <div class="detail">
                    <h4>returns</h4>
                    <span>24*7 free</span>
                </div>
            </div>
            <!-- service item box -->
            <!-- service item box -->
            <div class="box">
                <div class="icon">
                    <div class="icon-box">
                        <img src="images/services.png" class="img1" />
                        <img src="images/services (1).png" class="img2" />
                    </div>
                </div>
                <div class="detail">
                    <h4>delivery</h4>
                    <span>100% secure</span>
                </div>
            </div>
            <!-- service item box -->
        </div>
    </div>
    <!--service section end-->

    <!--catagories section start-->
    <div class="categories">
        <div class="heading">
            <h1>catagories features</h1>
            <img src="images/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="images/laptop.jpg">
                <a href="menu.php" class="btn">laptops</a>
            </div>
        
            <div class="box">
                <img src="images/tablet.jpg">
                <a href="menu.php" class="btn">tablets</a>
            </div>
        

            <div class="box">
                <img src="images/camera.jpg">
                <a href="menu.php" class="btn">camera</a>
            </div>

            <div class="box">
                <img src="images/watch1.jpg">
                <a href="menu.php" class="btn">smart watch</a>
            </div>

            <div class="box">
                <img src="images/keuboard.jpg">
                <a href="menu.php" class="btn">keyboard</a>
            </div>

            <div class="box">
                <img src="images/head9.jpg">
                <a href="menu.php" class="btn">headphones</a>
            </div>

            <div class="box">
                <img src="images/phone.jpg">
                <a href="menu.php" class="btn">phone</a>
            </div>

            <div class="box">
                <img src="images/gpu.jpg">
                <a href="menu.php" class="btn">gpu</a>
            </div>

            <div class="box">
                <img src="images/gaming.jpg">
                <a href="menu.php" class="btn">gaming</a>
            </div>

        </div>
    </div>
    <!--catagories section end-->
    <!--item section start-->
    <img src="images/sale1.jpg" class="menu-banner">
    
    <div class="taste">
        <div class="heading">
            <h1>BIG OFFER</h1>
            <h1>buy any @ get one smartwatch free</h1>
            <img src="images/separator-img.png">
        </div>
        <div class="box-container">
            <div class="box">
                <img src="images/sale_processor.jpg">
                <div class="detail">
                    <h2>Asus ROG Strix B550 Gaming WiFi AMD AM4</h2>
                    <h1>ATX Processor</h1>
                </div>
            </div>

            <div class="box">
                <img src="images/sale_camera.jpg">
                <div class="detail">
                    <h2> NIKKOR 18-140mm f/3.5-5.6G ED VR Lens, Black</h2>
                    <h1>DSLR Camera</h1>
                </div>
            </div>

            <div class="box">
                <img src="images/sale_laptop.jpg">
                <div class="detail">
                    <h2> Slim Laptop | 15.6" FHD Display | Intel Celeron N4500 Processor</h2>
                    <h1>Acer Aspire 1 </h1>
                </div>
            </div>

        </div>
    </div>
    <!--item section end-->
    <!--container section start-->
    <div class="ice-container">
        <div class="overlay"></div>
        <div class="detail">
            <h1> Fill your bucket with <br>joy and gadgets</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
            <br>Amet culpa ea voluptatum sit distinctio, exercitationem 
            animi repudiandae aut <br>ex suscipit repellat ipsum? Eius a 
            esse error. Vero perferendis soluta numquam.</p>
            <a href="menu.php" class="btn">shop now</a>
            
        </div>
    </div>

    <!--container section end-->

    <!--taste2 section start-->
    <div class="taste2" style="background-color:E3FEF7 ;">
        <div class="t-banner" >
            <div class="overlay"></div>
            <div class="detail">
                <h1>Find your Elevating Expectations </h1>
                <p>Discover Excellence: Unveiling the Finest Devices</p>
                <a href="menu.php" class="btn">shop now</a>
            </div>
        </div>
        <div class="box-container" style="background-color:E3FEF7 ;" >
            <div class="box">
                <div class="box-overlay"></div>
                <img src="images/e_laptop.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>laptop</h1>
                    <p>Find your Elevating Expectations</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div>
                
            </div>
            <div class="box">
                <div class="box-overlay"></div>
                <img src="images/e_head.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>headset</h1>
                    <p>Find your Elevating Expectations</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div> 
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="images/e_camera.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>camera</h1>
                    <p>Find your Elevating Expectations</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div> 
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="images/e_phone.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>phone</h1>
                    <p>Find your Elevating Expectations</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div> 
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="images/e_keyboard.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>Keyboard</h1>
                    <p>Find your Elevating Expectations</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div> 
            </div>

            <div class="box">
                <div class="box-overlay"></div>
                <img src="images/e_gaming.jpg">
                <div class="box-details fadeIn-bottom">
                    <h1>Gaming console</h1>
                    <p>Find your Elevating Expectations</p>
                    <a href="menu.php" class="btn">explore more</a>
                </div> 
            </div>
        </div>

    </div>
    <!--taste2 section end-->

    <!--flavour section start-->
    <div class="flavour">
        <div class="box-container">
            <img src="images/pexels-max-fischer-5868272.jpg">
            <div class="detail">
                <h1>Hot Deals! Sale Up To <span>20% off</span></h1>
                <p>expired</p>
                <a href="menu.php" class="btn">shop now</a>
        </div>
    </div>

    <!--flavour section end-->
    <!--usages section start-->
    <div class="usages">
        <div class="heading">
            <h1>how it works</h1>
            <img src="images/separator-img.png">
        </div>
        <div class="row">
            <div class="box-container" style="background-color:E3FEF7 ;">
                <div class="box">
                    <img src="images/process2 (3).jpg"> 
                    <div class="detail">
                        <h3>Get your  product in one step:</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Molestiae aperiam, quis minima enim eos et maxime cupiditate
                        soluta asperiores error impedit exercitationem tempora? Quos
                        dolores vitae doloremque. Doloribus, dignissimos officia!</p>
                    </div>
                </div>

                <div class="box">
                    <img src="images/process2 (1).jpg"> 
                    <div class="detail">
                        <h3>Get your  product in one step:</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Molestiae aperiam, quis minima enim eos et maxime cupiditate
                        soluta asperiores error impedit exercitationem tempora? Quos
                        dolores vitae doloremque. Doloribus, dignissimos officia!</p>
                    </div>
                </div>

                <div class="box">
                    <img src="images/process2 (4).jpg"> 
                    <div class="detail">
                        <h3>Get your  product in one step:</h3>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Molestiae aperiam, quis minima enim eos et maxime cupiditate
                        soluta asperiores error impedit exercitationem tempora? Quos
                        dolores vitae doloremque. Doloribus, dignissimos officia!</p>
                    </div>
                </div>
            </div>
            <!-- <img src="images/bg2.jpg" class="divider"> -->
        </div>
    </div>
    <!--usages section end-->

    <?php include 'components/footer.php'; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" ></script>
    <script src="js/user_script.js"></script>
    <?php include 'components/alert.php'; ?>
</body>
</html>