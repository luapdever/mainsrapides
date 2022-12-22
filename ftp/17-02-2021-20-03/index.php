<?php

include('scripts_php/database_connection.php');

include('scripts_php/fonctions.php');

$page_name = 'Bienvenue sur 1000fcfa.com';

/* Service à trouver */
if(isset($_POST['service_a_trouver'])){
    header('location:recherche.php?tag='.$_POST['service_a_trouver']);
}


$id_user = 0;
if (isset($_SESSION['id_user'])) {
    $id_user = $_SESSION['id_user'];
}


?>


<!DOCTYPE html>
<html lang="fr">

<head>

    <?php include 'parts/headmeta.php';?>

    <title><?php echo $page_name; ?></title>

    <?php include 'parts/headlink.php';?>

    <?php include 'parts/headstyle.php';?>

    <script>

    </script>

    <style>

        /*
        .product--card{
        .product-desc{
            height: 122px !important;
        }
        */




    </style>
</head>

<body class="preload home1 mutlti-vendor">

    <?php include 'parts/header.php';?>

    <!--================================
    START HERO AREA
=================================-->
    <section class="hero-area bgimage">
        <div class="bg_image_holder">
            <img src="images/diapo.jpg" alt="background-image">
        </div>
        <!-- start hero-content -->
        <div class="hero-content content_above">
            <!-- start .contact_wrapper -->
            <div class="content-wrapper">
                <!-- start .container -->
                <div class="container">
                    <!-- start row -->
                    <div class="row">
                        <!-- start col-md-12 -->
                        <div class="col-md-12">
                            <div class="hero__content__title">
                                <h1>
                                    <span class="light">Trouvez ici les meilleurs</span>
                                    <span class="bold">Microservices pour votre Business</span>
                                </h1>
                                <p class="tagline">1.000fcfa.com est la première plateforme digitale des microservices de qualité à moins de 2€</p>
                            </div>

                            <!-- start .hero__btn-area-->
                            <!--
                            <div class="hero__btn-area">
                                <a href="all-products.html" class="btn btn--round btn--lg">View All Products</a>
                                <a href="all-products.html" class="btn btn--round btn--lg">Popular Products</a>
                            </div>
                            -->
                            <!-- end .hero__btn-area-->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </div>
                <!-- end /.container -->
            </div>
            <!-- end .contact_wrapper -->
        </div>
        <!-- end hero-content -->

        <!--start search-area -->
        <div class="search-area">
            <!-- start .container -->
            <div class="container">
                <!-- start .container -->
                <div class="row">
                    <!-- start .col-sm-12 -->
                    <div class="col-sm-12">
                        <!-- start .search_box -->
                        <div class="search_box">

                            <form action="" method="post">
                                <input name="service_a_trouver" type="text" class="text_field" placeholder="Vous recherchez un microservice ?" required>
                                <!--
                                <div class="search__select select-wrap">
                                    <select name="category" class="select--field" id="blah">
                                        <option value="">All Categories</option>
                                        <option value="">PSD</option>
                                        <option value="">HTML</option>
                                        <option value="">WordPress</option>
                                        <option value="">All Categories</option>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                                -->
                                <button type="submit" class="search-btn btn--lg">Trouver</button>
                            </form>

                        </div>
                        <!-- end ./search_box -->
                    </div>
                    <!-- end /.col-sm-12 -->
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!--start /.search-area -->
    </section>
    <!--================================
    END HERO AREA
=================================-->

    <!--================================
    START FEATURE AREA
=================================-->
    <section class="features section--padding">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <!-- start search-area -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature">
                        <div class="feature__img">
                            <img src="images/commandez.png" alt="feature">
                        </div>
                        <div class="feature__title">
                            <h3>Commandez</h3>
                        </div>

                        <div class="feature__desc">
                            <p>le microservice de votre choix à l'un de nos vendeurs</p>
                        </div>

                    </div>
                    <!-- end /.feature -->
                </div>
                <!-- end /.col-lg-4 col-md-6 -->

                <!-- start search-area -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature">
                        <div class="feature__img">
                            <img src="images/chat.PNG" alt="feature">
                        </div>
                        <div class="feature__title">
                            <h3>Echangez</h3>
                        </div>

                        <div class="feature__desc">
                            <p>par chat sur la plate-forme jusqu'à la livraison en toute sécurité.</p>
                        </div>

                    </div>
                    <!-- end /.feature -->
                </div>
                <!-- end /.col-lg-4 col-md-6 -->

                <!-- start search-area -->
                <div class="col-lg-4 col-md-6">
                    <div class="feature">
                        <div class="feature__img">
                            <img src="images/main.png" alt="feature">
                        </div>
                        <div class="feature__title">
                            <h3>Payez</h3>
                        </div>

                        <div class="feature__desc">
                            <p>uniquement lorsque vous validez la livraison des services commandés</p>
                        </div>

                    </div>
                    <!-- end /.feature -->
                </div>
                <!-- end /.col-lg-4 col-md-6 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
    END FEATURE AREA
=================================-->


    <!--================================
    START FEATURED PRODUCT AREA
=================================-->

    <!--
    <section class="featured-products bgcolor  section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-title-area ">
                        <div class="product__title">
                            <h2>Microservices sponsorisés</h2>
                        </div>

                        <div class="product__slider-nav rounded">
                            <span class="lnr lnr-chevron-left nav_left"></span>
                            <span class="lnr lnr-chevron-right nav_right"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <div class="container">
            <div class="row">
                <div class="col-md-12 no0-padding">
                    <div class="featured-product-slider prod-slider1">
                        <div class="featured__single-slider">
                            <div class="featured__preview-img">
                                <img src="images/featprod.jpg" alt="Featured products">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                            </div>

                            <div class="featured__product-description">
                                <div class="product-desc desc--featured">
                                    <a href="single-product.html" class="product_title">
                                        <h4>Rida - vCard, Portfolio / Resume Template</h4>
                                    </a>
                                    <ul class="titlebtm">
                                        <li>
                                            <img class="auth-img" src="images/auth.jpg" alt="author image">
                                            <p>
                                                <a href="#">AazzTech</a>
                                            </p>
                                        </li>
                                        <li class="product_cat">
                                            <a href="#">
                                                <span class="lnr lnr-book"></span> WordPress</a>
                                        </li>
                                    </ul>

                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                        mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra,
                                        justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</p>
                                </div>

                                <div class="product_data">
                                    <div class="tags tags--round">
                                        <ul>
                                            <li>
                                                <a href="#">website</a>
                                            </li>
                                            <li>
                                                <a href="#">plugin</a>
                                            </li>
                                            <li>
                                                <a href="#">landing page</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-purchase featured--product-purchase">
                                        <div class="price_love">
                                            <span>$10 - $50</span>
                                            <p>
                                                <span class="lnr lnr-heart"></span> 90</p>
                                        </div>
                                        <div class="sell">
                                            <p>
                                                <span class="lnr lnr-cart"></span>
                                                <span>16</span>
                                            </p>
                                        </div>

                                        <div class="rating product--rating">
                                            <ul>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="featured__single-slider">
                            <div class="featured__preview-img">
                                <img src="images/featprod.jpg" alt="Featured products">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                            </div>

                            <div class="featured__product-description">
                                <div class="product-desc desc--featured">
                                    <a href="single-product.html" class="product_title">
                                        <h4>One Page Resume Template</h4>
                                    </a>
                                    <ul class="titlebtm">
                                        <li>
                                            <img class="auth-img" src="images/auth.jpg" alt="author image">
                                            <p>
                                                <a href="#">AazzTech</a>
                                            </p>
                                        </li>
                                        <li class="product_cat">
                                            <a href="#">
                                                <span class="lnr lnr-book"></span> WordPress</a>
                                        </li>
                                    </ul>

                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                        mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra,
                                        justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</p>
                                </div>

                                <div class="product_data">
                                    <div class="tags tags--round">
                                        <ul>
                                            <li>
                                                <a href="#">website</a>
                                            </li>
                                            <li>
                                                <a href="#">plugin</a>
                                            </li>
                                            <li>
                                                <a href="#">landing page</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-purchase featured--product-purchase">
                                        <div class="price_love">
                                            <span>$10 - $50</span>
                                            <p>
                                                <span class="lnr lnr-heart"></span> 90</p>
                                        </div>
                                        <div class="sell">
                                            <p>
                                                <span class="lnr lnr-cart"></span>
                                                <span>16</span>
                                            </p>
                                        </div>

                                        <div class="rating product--rating">
                                            <ul>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="featured__single-slider">
                            <div class="featured__preview-img">
                                <img src="images/featprod.jpg" alt="Featured products">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                            </div>

                            <div class="featured__product-description">
                                <div class="product-desc desc--featured">
                                    <a href="single-product.html" class="product_title">
                                        <h4>AppsPress App Landing</h4>
                                    </a>
                                    <ul class="titlebtm">
                                        <li>
                                            <img class="auth-img" src="images/auth.jpg" alt="author image">
                                            <p>
                                                <a href="#">AazzTech</a>
                                            </p>
                                        </li>
                                        <li class="product_cat">
                                            <a href="#">
                                                <span class="lnr lnr-book"></span> WordPress</a>
                                        </li>
                                    </ul>

                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                        mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra,
                                        justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</p>
                                </div>

                                <div class="product_data">
                                    <div class="tags tags--round">
                                        <ul>
                                            <li>
                                                <a href="#">website</a>
                                            </li>
                                            <li>
                                                <a href="#">plugin</a>
                                            </li>
                                            <li>
                                                <a href="#">landing page</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-purchase featured--product-purchase">
                                        <div class="price_love">
                                            <span>$10 - $50</span>
                                            <p>
                                                <span class="lnr lnr-heart"></span> 90</p>
                                        </div>
                                        <div class="sell">
                                            <p>
                                                <span class="lnr lnr-cart"></span>
                                                <span>16</span>
                                            </p>
                                        </div>

                                        <div class="rating product--rating">
                                            <ul>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="featured__single-slider">
                            <div class="featured__preview-img">
                                <img src="images/featprod.jpg" alt="Featured products">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                            </div>

                            <div class="featured__product-description">
                                <div class="product-desc desc--featured">
                                    <a href="single-product.html" class="product_title">
                                        <h4>1000F - Digital Marketplace</h4>
                                    </a>
                                    <ul class="titlebtm">
                                        <li>
                                            <img class="auth-img" src="images/auth.jpg" alt="author image">
                                            <p>
                                                <a href="#">AazzTech</a>
                                            </p>
                                        </li>
                                        <li class="product_cat">
                                            <a href="#">
                                                <span class="lnr lnr-book"></span> WordPress</a>
                                        </li>
                                    </ul>

                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                        mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra,
                                        justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</p>
                                </div>

                                <div class="product_data">
                                    <div class="tags tags--round">
                                        <ul>
                                            <li>
                                                <a href="#">website</a>
                                            </li>
                                            <li>
                                                <a href="#">plugin</a>
                                            </li>
                                            <li>
                                                <a href="#">landing page</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-purchase featured--product-purchase">
                                        <div class="price_love">
                                            <span>$10 - $50</span>
                                            <p>
                                                <span class="lnr lnr-heart"></span> 90</p>
                                        </div>
                                        <div class="sell">
                                            <p>
                                                <span class="lnr lnr-cart"></span>
                                                <span>16</span>
                                            </p>
                                        </div>

                                        <div class="rating product--rating">
                                            <ul>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="featured__single-slider">
                            <div class="featured__preview-img">
                                <img src="images/featprod.jpg" alt="Featured products">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                            </div>

                            <div class="featured__product-description">
                                <div class="product-desc desc--featured">
                                    <a href="single-product.html" class="product_title">
                                        <h4>1000F - Digital Marketplace</h4>
                                    </a>
                                    <ul class="titlebtm">
                                        <li>
                                            <img class="auth-img" src="images/auth.jpg" alt="author image">
                                            <p>
                                                <a href="#">AazzTech</a>
                                            </p>
                                        </li>
                                        <li class="product_cat">
                                            <a href="#">
                                                <span class="lnr lnr-book"></span> WordPress</a>
                                        </li>
                                    </ul>

                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                        mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra,
                                        justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</p>
                                </div>

                                <div class="product_data">
                                    <div class="tags tags--round">
                                        <ul>
                                            <li>
                                                <a href="#">website</a>
                                            </li>
                                            <li>
                                                <a href="#">plugin</a>
                                            </li>
                                            <li>
                                                <a href="#">landing page</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-purchase featured--product-purchase">
                                        <div class="price_love">
                                            <span>$10 - $50</span>
                                            <p>
                                                <span class="lnr lnr-heart"></span> 90</p>
                                        </div>
                                        <div class="sell">
                                            <p>
                                                <span class="lnr lnr-cart"></span>
                                                <span>16</span>
                                            </p>
                                        </div>

                                        <div class="rating product--rating">
                                            <ul>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="featured__single-slider">
                            <div class="featured__preview-img">
                                <img src="images/featprod.jpg" alt="Featured products">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                            </div>

                            <div class="featured__product-description">
                                <div class="product-desc desc--featured">
                                    <a href="single-product.html" class="product_title">
                                        <h4>1000F - Digital Marketplace</h4>
                                    </a>
                                    <ul class="titlebtm">
                                        <li>
                                            <img class="auth-img" src="images/auth.jpg" alt="author image">
                                            <p>
                                                <a href="#">AazzTech</a>
                                            </p>
                                        </li>
                                        <li class="product_cat">
                                            <a href="#">
                                                <span class="lnr lnr-book"></span> WordPress</a>
                                        </li>
                                    </ul>

                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the
                                        mattis, leo quam aliquet congue placerat mi id nisi interdum mollis. Praesent pharetra,
                                        justo ut scelerisque the mattis, leo quam aliquet congue justo ut scelerisque.</p>
                                </div>

                                <div class="product_data">
                                    <div class="tags tags--round">
                                        <ul>
                                            <li>
                                                <a href="#">website</a>
                                            </li>
                                            <li>
                                                <a href="#">plugin</a>
                                            </li>
                                            <li>
                                                <a href="#">landing page</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product-purchase featured--product-purchase">
                                        <div class="price_love">
                                            <span>$10 - $50</span>
                                            <p>
                                                <span class="lnr lnr-heart"></span> 90</p>
                                        </div>
                                        <div class="sell">
                                            <p>
                                                <span class="lnr lnr-cart"></span>
                                                <span>16</span>
                                            </p>
                                        </div>

                                        <div class="rating product--rating">
                                            <ul>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                                <li>
                                                    <span class="fa fa-star"></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->

    <!--================================
    END FEATURED PRODUCT AREA
=================================-->


    <!--================================
    START PRODUCTS AREA
=================================-->
    <section class="products section--padding">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="product-title-area">
                        <div class="product__title">
                            <h2>Microservices à la Une</h2>
                        </div>

                        <!--
                        <div class="filter__menu">
                            <p>Filter by:</p>
                            <div class="filter__menu_icon">
                                <a href="#" id="drop1" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img class="svg" src="images/svg/menu.svg" alt="menu icon">
                                </a>

                                <ul class="filter_dropdown dropdown-menu" aria-labelledby="drop1">
                                    <li>
                                        <a href="#">Trending items</a>
                                    </li>
                                    <li>
                                        <a href="#">Best seller</a>
                                    </li>
                                    <li>
                                        <a href="#">Best rating</a>
                                    </li>
                                    <li>
                                        <a href="#">Low price</a>
                                    </li>
                                    <li>
                                        <a href="#">High price</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        -->
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->

            <!-- start row -->
            <div class="row">
                <!-- start .col-md-12 -->
                <!--
                <div class="col-md-12">
                    <div class="sorting">
                        <ul>
                            <li>
                                <a href="#">Plugins</a>
                            </li>
                            <li>
                                <a href="#">WordPress</a>
                            </li>
                            <li>
                                <a href="#">Site Template</a>
                            </li>
                            <li>
                                <a href="#">PSD Template</a>
                            </li>
                            <li>
                                <a href="#">Joomla</a>
                            </li>
                            <li>
                                <a href="#">User Interface</a>
                            </li>
                            <li>
                                <a href="#">Landing Page</a>
                            </li>
                            <li>
                                <a href="#">Software</a>
                            </li>
                        </ul>
                    </div>
                </div>
                -->
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->

            <!-- start .row -->
            <div class="row services">


                <!--
                <div class="col-lg-4 col-md-6">
                    <div class="product product--card">

                        <div class="product__thumbnail">
                            <img src="images/p6.jpg" alt="Product Image">
                            <div class="prod_btn">
                                <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                            </div>
                        </div>

                        <div class="product-desc">
                            <a href="single-product.html" class="product_title">
                                <h4>Visibility Manager Subscriptions</h4>
                            </a>
                            <ul class="titlebtm">
                                <li>
                                    <img class="auth-img" src="images/auth3.jpg" alt="author image">
                                    <p>
                                        <a href="#">AazzTech</a>
                                    </p>
                                </li>
                                <li class="product_cat">
                                    <a href="#">
                                        <span class="lnr lnr-book"></span>WordPress</a>
                                </li>
                            </ul>

                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet congue.</p>
                        </div>

                        <div class="product-purchase">
                            <div class="price_love">
                                <span>Free</span>
                                <p>
                                    <span class="lnr lnr-heart"></span> 24</p>
                            </div>
                            <div class="rating product--rating">
                                <ul>
                                    <li>
                                        <span class="fa fa-star"></span>
                                    </li>
                                    <li>
                                        <span class="fa fa-star"></span>
                                    </li>
                                    <li>
                                        <span class="fa fa-star"></span>
                                    </li>
                                    <li>
                                        <span class="fa fa-star"></span>
                                    </li>
                                    <li>
                                        <span class="fa fa-star-half-o"></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="sell">
                                <p>
                                    <span class="lnr lnr-cart"></span>
                                    <span>27</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                -->


            </div>
            <!-- end /.row -->

            <!-- start .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="more-product">
                        <a href="liste-microservices.php" id="bouton_tous_microservices" class="btn btn--round btn--md" style="text-transform: none; background: #0674ec;">Voir tous les microservices</a>
                        <!--<a href="all-products.html" class="btn btn--lg btn--round">Tous les microservices</a>-->
                    </div>
                </div>
                <!-- end ./col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
    END PRODUCTS AREA
=================================-->








    <!--================================
    START FOLLOWERS FEED AREA
=================================-->


    <!--
    <section class="followers-feed section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-title-area">
                        <div class="product__title">
                            <h2>Microservices de vendeurs vérifiés</h2>
                        </div>

                        <div class="product__slider-nav follow_feed_nav rounded">
                            <span class="lnr lnr-chevron-left nav_left"></span>
                            <span class="lnr lnr-chevron-right nav_right"></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="product_slider services_verifies-lol">




                        <div class="product product--card">

                            <div class="product__thumbnail">
                                <img src="images/p4.jpg" alt="Product Image">
                                <div class="prod_btn">
                                    <a href="single-product.html" class="transparent btn--sm btn--round">More Info</a>
                                    <a href="single-product.html" class="transparent btn--sm btn--round">Live Demo</a>
                                </div>
                            </div>

                            <div class="product-desc">
                                <a href="#" class="product_title">
                                    <h4>Ajax Live Search</h4>
                                </a>
                                <ul class="titlebtm">
                                    <li>
                                        <img class="auth-img" src="images/auth.jpg" alt="author image">
                                        <p>
                                            <a href="#">AazzTech</a>
                                        </p>
                                    </li>
                                    <li class="product_cat">
                                        <a href="#">
                                            <span class="lnr lnr-book"></span>Plugin</a>
                                    </li>
                                </ul>

                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet congue.</p>
                            </div>

                            <div class="product-purchase">
                                <div class="price_love">
                                    <span>$10 - $50</span>
                                    <p>
                                        <span class="lnr lnr-heart"></span> 90</p>
                                </div>
                                <div class="sell">
                                    <p>
                                        <span class="lnr lnr-cart"></span>
                                        <span>16</span>
                                    </p>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </section>
    -->


    <!--================================
    END FOLLOWERS FEED AREA
=================================-->









    <!--================================
    START COUNTER UP AREA
=================================-->
    <!--
    <section class="counter-up-area bgimage">
        <div class="bg_image_holder">
            <img src="images/countbg.jpg" alt="">
        </div>

        <div class="container content_above">

            <div class="col-md-12">
                <div class="counter-up">
                    <div class="counter mcolor2">
                        <span class="lnr lnr-briefcase"></span>
                        <span class="count">38,436</span>
                        <p>items for sale</p>
                    </div>
                    <div class="counter mcolor3">
                        <span class="lnr lnr-cloud-download"></span>
                        <span class="count">38,436</span>
                        <p>total Sales</p>
                    </div>
                    <div class="counter mcolor1">
                        <span class="lnr lnr-smile"></span>
                        <span class="count">38,436</span>
                        <p>appy customers</p>
                    </div>
                    <div class="counter mcolor4">
                        <span class="lnr lnr-users"></span>
                        <span class="count">38,436</span>
                        <p>members</p>
                    </div>
                </div>
            </div>

        </div>

    </section>
    -->
    <!--================================
    END COUNTER UP AREA
=================================-->


    <!--
    <section class="why_choose section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>Why Choose
                            <span class="highlighted">1000F</span>
                        </h1>
                        <p>Laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats. Lid
                            est laborum dolo rumes fugats untras.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature2">
                        <span class="feature2__count">01</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-license pcolor"></span>
                            <h3 class="feature2-title">One Time Payment</h3>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature2">
                        <span class="feature2__count">02</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-magic-wand scolor"></span>
                            <h3 class="feature2-title">Quality Products</h3>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature2">
                        <span class="feature2__count">03</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-lock mcolor1"></span>
                            <h3 class="feature2-title">100% Secure Paymentt</h3>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature2">
                        <span class="feature2__count">04</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-chart-bars mcolor2"></span>
                            <h3 class="feature2-title">Well Organized Code</h3>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>

                </div>


                <div class="col-lg-4 col-md-6">
                    <div class="feature2">
                        <span class="feature2__count">05</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-leaf mcolor3"></span>
                            <h3 class="feature2-title">Life Time Free Update</h3>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature2">
                        <span class="feature2__count">06</span>
                        <div class="feature2__content">
                            <span class="lnr lnr-phone mcolor4"></span>
                            <h3 class="feature2-title">Fast and Friendly Support</h3>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet diam congue is laoreet elit metus.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
    <!--================================
=================================-->

    <!--================================
    START SELL BUY
=================================-->
    <section class="proposal-area">

        <!-- start container-fluid -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 no-padding">
                    <div class="proposal proposal--left bgimage">
                        <div class="bg_image_holder">
                            <img src="images/bbg.png" alt="prop image">
                        </div>
                        <div class="content_above">
                            <div class="proposal__icon ">
                                <img src="images/buy.png" alt="Buy icon">
                            </div>
                            <div class="proposal__content ">
                                <h1 class="text--white">Vendez sur 1000fcfa.com</h1>
                                <!--
                                <p class="text--white">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diamcongue is laoreet elit metus.</p>
                                -->
                            </div>
                            <a href="inscription.php" class="btn btn--round btn--md btn--white">Devenir vendeur</a>
                        </div>
                    </div>
                    <!-- end /.proposal -->
                </div>

                <div class="col-md-6 no-padding">
                    <div class="proposal proposal--right">
                        <div class="bg_image_holder">
                            <img src="images/sbg.png" alt="this is magic">
                        </div>
                        <div class="content_above">
                            <div class="proposal__icon">
                                <img src="images/sell.png" alt="Sell icon">
                            </div>
                            <div class="proposal__content ">
                                <h1 class="text--white">Achetez sur 1000fcfa.com</h1>
                                <!--
                                <p class="text--white">Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diamcongue is laoreet elit metus.</p>
                                -->
                            </div>
                            <a href="liste-microservices.php" class="btn btn--round btn--md btn--white">Parcourir les microservices</a>
                        </div>
                    </div>
                    <!-- end /.proposal -->
                </div>
            </div>
        </div>
        <!-- start container-fluid -->
    </section>
    <!--================================
    END SELL BUY
=================================-->

    <!--================================
    START TESTIMONIAL
=================================-->
    <!--
    <section class="testimonial-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>Our Clients
                            <span class="highlighted">Feedback</span>
                        </h1>
                        <p>Laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats. Lid
                            est laborum dolo rumes fugats untras.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial-slider">
                        <div class="testimonial">
                            <div class="testimonial__about">
                                <div class="avatar v_middle">
                                    <img src="images/test1.jpg" alt="Testimonial Avatar">
                                </div>
                                <div class="name-designation v_middle">
                                    <h4 class="name">Tubeda Pagla</h4>
                                    <span class="desig">Product Designer</span>
                                </div>
                                <span class="lnr lnr-bubble quote-icon"></span>
                            </div>
                            <div class="testimonial__text">
                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diam congue is the laoreet elit metus. Nunc placerat mi is id nisi interdum
                                    is mollis. Praesent the pharetra, justo ut scelerisque.</p>
                            </div>
                        </div>

                        <div class="testimonial">
                            <div class="testimonial__about">
                                <div class="avatar v_middle">
                                    <img src="images/test2.jpg" alt="Testimonial Avatar">
                                </div>
                                <div class="name-designation v_middle">
                                    <h4 class="name">Tarashi Hamada</h4>
                                    <span class="desig">Quality Ninja</span>
                                </div>
                                <span class="lnr lnr-bubble quote-icon"></span>
                            </div>
                            <div class="testimonial__text">
                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diam congue is the laoreet elit metus. Nunc placerat mi is id nisi interdum
                                    is mollis. Praesent the pharetra, justo ut scelerisque.</p>
                            </div>
                        </div>

                        <div class="testimonial">
                            <div class="testimonial__about">
                                <div class="avatar v_middle">
                                    <img src="images/test1.jpg" alt="Testimonial Avatar">
                                </div>
                                <div class="name-designation v_middle">
                                    <h4 class="name">Tubeda Pagla</h4>
                                    <span class="desig">Product Designer</span>
                                </div>
                                <span class="lnr lnr-bubble quote-icon"></span>
                            </div>
                            <div class="testimonial__text">
                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diam congue is the laoreet elit metus. Nunc placerat mi is id nisi interdum
                                    is mollis. Praesent the pharetra, justo ut scelerisque.</p>
                            </div>
                        </div>

                        <div class="testimonial">
                            <div class="testimonial__about">
                                <div class="avatar v_middle">
                                    <img src="images/test2.jpg" alt="Testimonial Avatar">
                                </div>
                                <div class="name-designation v_middle">
                                    <h4 class="name">Tarashi Hamada</h4>
                                    <span class="desig">Quality Ninja</span>
                                </div>
                                <span class="lnr lnr-bubble quote-icon"></span>
                            </div>
                            <div class="testimonial__text">
                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                    leo quam aliquet diam congue is the laoreet elit metus. Nunc placerat mi is id nisi interdum
                                    is mollis. Praesent the pharetra, justo ut scelerisque.</p>
                            </div>
                        </div>
                    </div>

                    <div class="all-testimonial">
                        <a href="testimonial.html" class="btn btn--lg btn--round">View All Reviews</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
    <!--================================
    END TESTIMONIAL
=================================-->

    <!--================================
    START LATEST NEWS
=================================-->
    <!--
    <section class="latest-news section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title">
                        <h1>Latest
                            <span class="highlighted">News</span>
                        </h1>
                        <p>Laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats. Lid
                            est laborum dolo rumes fugats untras.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="news">
                        <div class="news__thumbnail">
                            <img src="images/news1.png" alt="News Thumbnail">
                        </div>
                        <div class="news__content">
                            <a href="#" class="news-title">
                                <h4>Web Design Trends in 2019</h4>
                            </a>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <div class="news__meta">
                            <div class="date">
                                <span class="lnr lnr-clock"></span>
                                <p>24 Feb 2019</p>
                            </div>

                            <div class="other">
                                <ul>
                                    <li>
                                        <span class="lnr lnr-bubble"></span>
                                        <span>45</span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-eye"></span>
                                        <span>345</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="news">
                        <div class="news__thumbnail">
                            <img src="images/news2.png" alt="News Thumbnail">
                        </div>
                        <div class="news__content">
                            <a href="#" class="news-title">
                                <h4>The best advices to start your own project</h4>
                            </a>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <div class="news__meta">
                            <div class="date">
                                <span class="lnr lnr-clock"></span>
                                <p>15 Mar 2019</p>
                            </div>

                            <div class="other">
                                <ul>
                                    <li>
                                        <span class="lnr lnr-bubble"></span>
                                        <span>45</span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-eye"></span>
                                        <span>345</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="news">
                        <div class="news__thumbnail">
                            <img src="images/news1.png" alt="News Thumbnail">
                        </div>
                        <div class="news__content">
                            <a href="#" class="news-title">
                                <h4>Best Tomato Sauce in town</h4>
                            </a>
                            <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut scelerisque the mattis,
                                leo quam aliquet congue.</p>
                        </div>
                        <div class="news__meta">
                            <div class="date">
                                <span class="lnr lnr-clock"></span>
                                <p>20 Dec 2016</p>
                            </div>

                            <div class="other">
                                <ul>
                                    <li>
                                        <span class="lnr lnr-bubble"></span>
                                        <span>45</span>
                                    </li>
                                    <li>
                                        <span class="lnr lnr-eye"></span>
                                        <span>345</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    -->
    <!--================================
    END LATEST NEWS
=================================-->

    <!--================================
    START SPECIAL FEATURES AREA
=================================-->
    <section class="special-feature-area">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="special-feature feature--1">
                        <img src="images/spf1.png" alt="Special Feature image">
                        <h3 class="special__feature-title">Retirez vos gains en
                            <span class="highlight">24 heures</span>
                        </h3>
                    </div>
                </div>
                <!-- end /.col-md-6 -->
                <div class="col-md-6">
                    <div class="special-feature feature--2">
                        <img src="images/spf2.png" alt="Special Feature image">
                        <h3 class="special__feature-title">Des conseillers à disposition
                            <span class="highlight">24h/24</span>
                        </h3>
                    </div>
                </div>
                <!-- end /.col-md-6 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
    END SPECIAL FEATURES AREA
=================================-->

    <!--================================
    START CALL TO ACTION AREA
=================================-->
    <section class="call-to-action bgimage">
        <div class="bg_image_holder">
            <img src="images/bg-ft.jpg" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-wrap">
                        <h1 class="text--white">Rejoignez maintenant 1000fcfa.com</h1>
                        <!--<h4 class="text--white">Over 25,000 designers and developers trust the 1000F.</h4>-->
                        <a href="inscription.php" class="btn btn--lg btn--round btn--white callto-action-btn">S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================================
    END CALL TO ACTION AREA
=================================-->

    <?php include 'parts/footer.php';?>

    <?php include 'parts/js_scripts.php';?> <?php include 'parts/notifications_dropdown.php';?> <?php if( (isset($_SESSION['id_user'])) && ($_SESSION['type'] == 3) ) { include 'parts/sms_acheteur_header.php'; } ?> <?php if( (isset($_SESSION['id_user'])) && ($_SESSION['type'] == 4) ) { include 'parts/sms_vendeur_header.php'; } ?>


    <script type="text/javascript">

        $(document).ready(function() {


            function load_services(view = '') {
                $.ajax({
                    url: "scripts_php/service_accueil.php",
                    method: "POST",
                    data: {view: view},
                    dataType: "json",
                    success: function (data) {
                        $('.services').html(data);
                    }
                });

            }

            load_services();


            function load_services_verif(view = '') {
                $.ajax({
                    url: "scripts_php/service_verif_accueil.php",
                    method: "POST",
                    data: {view: view},
                    dataType: "json",
                    success: function (data) {
                        $('.services_verifies').html(data);
                    }
                });

            }

            load_services_verif();




            var iduser = <?php echo $id_user; ?>

            /* Quand on clique sur le bouton Favoris */
            $(document).on('click', '.favoris', function(event){
                event.preventDefault();
                if (iduser == 0) {
                    //swal('Connectez-vous d\'abord', 'pour ajouter ce microservice aux favoris', 'info');

                    swal("Vous devez vous connecter pour ajouter ce microservice à vos favoris.", {
                        buttons: {
                            yes: {
                                text: "Se connecter",
                                value: "yes"
                            },
                            no: {
                                text: "Fermer",
                                value: "no"
                            }
                        }
                    }).then((value) => {
                        if (value === "yes") {
                            window.location = "connexion.php";
                        }
                        return false;
                    });

                }else {

                    var id_users_fk_service = $(this).attr("jp");

                    if(id_users_fk_service == iduser) {
                        swal('Attention', 'Vous ne pouvez pas ajouter votre propre microservice à vos favoris.', 'error');
                    }else {
                        var id_service = $(this).attr("id");
                        $.ajax({
                            url: "scripts_php/add_favori.php",
                            method: "POST",
                            data: {id_service:id_service},
                            dataType:"json",
                            success: function (data) {

                                if(data == "Favori déjà présent") {
                                    swal('Ce microservice', 'fait déjà partie de vos favoris.', 'info');
                                }

                                if(data == "Favori ajouté") {
                                    swal('Effectué', 'Le microservice a été ajouté à vos favoris', 'success');
                                }

                            }
                        });
                    }
                }


            });




            /* NOTIFICATIONS */

            /*
            function load_unseen_notification(view = '') {
                $.ajax({
                    url: "scripts_php/notif_fetch.php",
                    method: "POST",
                    data: {view: view},
                    dataType: "json",
                    success: function (data) {
                        $('.notifs').html(data.notification);
                        if (data.unseen_notification > 0) {
                            $('#notif_bulle').addClass('notification_count noti count');
                            $('#notif_bulle').html(data.unseen_notification);
                        }
                    }
                });
            }

            function clic_notification(clic, id) {

                var clic_notif = clic;
                var id_notif = id;

                $.ajax({
                    url: "scripts_php/notif_clic.php",
                    method: "POST",
                    data: {clic_notif:clic_notif, id_notif:id_notif},
                    dataType: "json",
                    success: function (data) {

                    }
                });
            }

            function note(a,b) {
                var x = a;
                var y = b;

                $.ajax({
                    url: "scripts_php/notif_clic.php",
                    method: "POST",
                    data: {clic_notif:x, comment_id:y},
                    dataType: "json",
                    success: function (data) {

                    }
                });
            }

            function markall(c) {
                var z = c;

                $.ajax({
                    url: "scripts_php/notif_mark.php",
                    method: "POST",
                    data: {mark_notif:z},
                    dataType: "json",
                    success: function (data) {

                        if(data == "good") {
                            swal(
                                'Effectué', 'Toutes les notifications ont été marquées commme lues.', 'success'
                            ).then(function() {
                                //Recharger la page en cours
                                location.reload();
                            });
                        }
                    }
                });
            }

            // Clic sur une des notifications
            $(document).on('click', '.voir-notif', function(){
                //$("a.voir-notif").on("click", function(){
                var comment_id = $(this).attr('id');
                note(1,comment_id);
            });



            load_unseen_notification();


            // Clic sur Marquer tout comme lu (notifs)
            //$(document).on('click', '.mark-all-notif', function(){
            $("a.mark-all-notif").on("click", function(){
                markall(1);
            });


            setInterval(function(){
                load_unseen_notification();
            }, 5000);

            */


            /* FIN NOTIFICATIONS */


        });

    </script>


</body>

<?php include 'parts/newsletter.php';?></html>