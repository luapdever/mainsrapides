<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_sql.php');

$users = get3users();
$annonces = get9annonces();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mainsrapides - Services">
    <meta name="keywords" content="app, app landing, product landing, digital, material, html5">


    <title>Mainsrapides - Home</title>

    <?php include("parts/headmeta.php") ?>

</head>

<body class="preload home3">

    <!--================================
        START MENU AREA
    =================================-->
    <!-- start menu-area -->
    <div class="menu-area">
        
        <?php include("parts/topbar.php") ?>
        <?php include("parts/header.php") ?>

    </div>
    <!-- end /.menu-area -->
    <!--================================
        END MENU AREA
    =================================-->

    <!--================================
        START HERO AREA
    =================================-->

    <section class="hero-area hero--2 bgimage">
        <div class="bg_image_holder">
            <img src="assets/img/home_img.jpg" alt="">
        </div>

        <!-- start hero-content -->
        <div class="hero-content">
            <!-- start .contact_wrapper -->
            <div class="content-wrapper">
                <!-- start .container -->
                <div class="container">
                    <!-- start row -->
                    <div class="row">
                        <!-- start col-md-12 -->
                        <div class="col-md-12">
                            <div class="text-center">
                                <h1 class="text--white display-4 text-bold">
                                    Confiez vos petits travaux de bricolage
                                </h1>
                                <p class="display-4 text--white">
                                    rapidement et en toute sérénité
                                </p>
                                <a href="annonce_add.php" class="btn btn--lg btn--default">Je publie une annonce</a>
                            </div>
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
                    <div class="col-sm-4">
                        <!-- start .search_box -->
                        <div class="search_box">
                            <div class="row">
                                <div class="col-lg-3">
                                    <i class="fa fa-user fa-3x"></i>
                                </div>
                                <div class="col-lg-9">
                                    <h4>200 000 Jobbers</h4>
                                    <small>Particuliers bricoleurs ou professionnels vérifiés</small>
                                </div>
                            </div>
                        </div>
                        <!-- end ./search_box -->
                    </div>
                    <div class="col-sm-4">
                        <!-- start .search_box -->
                        <div class="search_box">
                            <div class="row">
                                <div class="col-lg-3">
                                    <i class="fa fa-clock-o fa-3x"></i>
                                </div>
                                <div class="col-lg-9">
                                    <h4>Réactivité</h4>
                                    <small>Une réponse en moins <br> de 24 h</small>
                                </div>
                            </div>
                        </div>
                        <!-- end ./search_box -->
                    </div>
                    <div class="col-sm-4">
                        <!-- start .search_box -->
                        <div class="search_box">
                            <div class="row">
                                <div class="col-lg-3">
                                    <i class="fa  fa-check-square-o fa-3x"></i>
                                </div>
                                <div class="col-lg-9">
                                    <h4>Assurance</h4>
                                    <small>Vos petits travaux garantis 100% satisfaits ou refaits</small>
                                </div>
                            </div>
                        </div>
                        <!-- end ./search_box -->
                    </div>
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
        START FEATURED PRODUCT AREA
    =================================-->
    <section class="featured-products bgcolor2 section--padding">
        <div class="container">
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <div class="text-center">
                            <h1 class="text-big text-bold text-primary">98%</h1>
                            <p class="h2 text-primary">de clients satisfaits.</p>
                        </div>
                        <div class="col-lg-6 mt-2 progress_wrapper">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 98%;">
                                    <span class="sr-only">98%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="testimonial-slider">
                        <?php foreach($users as $key => $user): ?>
                        <div class="testimonial">
                            <div class="testimonial__about">
                                <div class="avatar v_middle">
                                    <img src=".<?= $user["photo"] ?>" alt="Testimonial Avatar" width="60">
                                </div>
                                <div class="name-designation v_middle">
                                    <h4 class="name"><?= get_full_name($user) ?></h4>
                                </div>
                                <span class="lnr lnr-bubble quote-icon"></span>
                            </div>
                            <div class="testimonial__text">
                                <p><?= $user["avis"] ?></p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- end /.testimonial_slider -->

                    <div class="all-testimonial">
                        <a href="jobbers.php" class="btn btn-md btn--round">Voir les jobbers proches de chez vous</a>
                    </div>
                </div>
            </div>
            <!-- end /.featured__preview-img -->
        </div>
        <!-- end /.featured-product-slider -->
    </section>
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
                            <h2>Annonces</h2>
                        </div>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->

            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-4 -->
                <?php foreach($annonces as $key => $annonce): ?>
                <?php $user = get_user($annonce["user_id"]) ?>
                <div class="col-lg-4 col-md-6">
                    <!-- start .single-product -->
                    <div class="product product--card product--card3">

                        <div class="row">
                            <?php if(!empty($annonce["photo1"])): ?>
                            <div class="col-lg-12">
                                <img src=".<?= $annonce["photo1"] ?>" alt="Image" class="img-responsive img-annonce">
                            </div>
                            <?php endif; ?>
                        </div>


                        <div class="product-desc">
                            <a href="annonce_single.php?id=<?= $annonce["id"] ?>" class="product_title">
                                <h4><?= tinyText($annonce["titre"]) ?></h4>
                            </a>
                            <ul class="titlebtm">
                                <li>
                                    <i class="fa fa-user"></i>
                                    <p>
                                        <a href="profile?id_user=<?= $user["id"] ?>"><?= get_full_name($user) ?></a>
                                    </p>
                                </li>
                                <li class="product_cat">
                                    <a href="#">
                                        <span class="fa fa-map-marker"></span><?= $annonce["place"] ?></a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.product-desc -->

                        <div class="product-purchase">
                            <div class="price_love">
                                <span><?= $annonce["prix_min"] ?>€ - <?= $annonce["prix_max"] ?>€</span>
                                <p>
                                    <span class="fa fa-send-o"></span> <?= count_offres_annonce($annonce["id"]) ?> offres</p>
                            </div>
                            <a href="annonce_single.php?id=<?= $annonce["id"] ?>" class="transparent btn--sm btn--round">Voir</a>
                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                    <!-- end /.single-product -->
                </div>
                <?php endforeach; ?>
                <!-- end /.col-md-4 -->
            </div>

            <!-- start .row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="more-product">
                        <a href="missions.php" class="btn btn--md btn--round">Consulter les missions</a>
                    </div>
                </div>
                <!-- end ./col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>


    <!--================================
        START WHY CHOOSE US AREA
    =================================-->
    <section class="why_choose section--padding">
        <!-- start container -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 section-title">
                    <h1 class="text-center">Sur quel type de projet avez-vous besoin d’aide ?</h1>
                </div>
                <div class="col-lg-12 mt-5 text-center">
                    <hr>
                </div>
            </div>
        </div>
        <!-- end /.container -->
    </section>


    <section class="why_choose">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h1 class="text-bold text-primary">Vos projets se concrétisent en quelques clics</h1>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->


            <!-- start row -->
            <div class="row">
                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .reason -->
                    <div class="feature2">
                        <span class="feature2__count">01</span>
                        <div class="feature2__content">
                            <img src="assets/img/annonce.svg" alt="" height="100" />
                            <h3 class="feature2-title">Publiez votre annonce</h3>
                            <p>Décrivez votre projet et obtenez une estimation du prix de vos petits travaux.</p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .feature2 -->
                    <div class="feature2">
                        <span class="feature2__count">02</span>
                        <div class="feature2__content">
                            <img src="assets/img/select.svg" alt="" height="100" />
                            <h3 class="feature2-title">Prenez la meilleure offre</h3>
                            <p>Discutez avec les jobbers intéressés par votre annonce et sélectionnez la meilleure offre !</p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->

                <!-- start .col-md-4 -->
                <div class="col-lg-4 col-md-6">
                    <!-- start .feature2 -->
                    <div class="feature2">
                        <span class="feature2__count">03</span>
                        <div class="feature2__content">
                            <img src="assets/img/home.svg" alt="" height="100" />
                            <h3 class="feature2-title">Admirez le travail</h3>
                            <p>Votre jobber intervient sur le lieu de votre projet à la date et au prix convenus.</p>
                        </div>
                        <!-- end /.feature2__content -->
                    </div>
                    <!-- end /.feature2 -->
                </div>
                <!-- end /.col-md-4 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    
    
    
    <section class="why_choose section--padding">
        <!-- start container -->
        <div class="container">
            <!-- start row -->
            <div class="row">
                <!-- start col-md-12 -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h1 class="text-bold">
                            Proposez vos services, <span class="highlighted">devenez jobber sur Mainsrapides</span>
                        </h1>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->


            <!-- start row -->
            <div class="row justify-content-center">
                <!-- start .col-md-4 -->
                <div class="col-lg-9 col-md-6">
                    <!-- start .reason -->
                    <div class="feature2">
                        <div class="feature2__content ml-5 text-left">
                            <h4 class="text-bold text-left w-75">
                                Faites comme Arnaud, proposez vos compétences à la communauté Mainsrapides
                            </h4>
                            <ul class="pricing-options mt-5">
                                <li>
                                    <div class="custom-checkbox2">
                                        <input type="checkbox" id="opt1" class="" name="filter_opt" checked readonly />
                                        <label for="opt1">
                                            <span class="circle"></span>Particulier ou professionnel, 
                                            <span class="text-danger text-bold">arrondissez vos fins de mois</span> grâce au jobbing.
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-checkbox2">
                                        <input type="checkbox" id="opt1" class="" name="filter_opt" checked readonly />
                                        <label for="opt1">
                                            <span class="circle"></span>Travaillez en toute sérenité : 
                                            <span class="text-danger text-bold">vos prestations sont assurées !</span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="custom-checkbox2">
                                        <input type="checkbox" id="opt1" class="" name="filter_opt" checked readonly />
                                        <label for="opt1">
                                            <span class="circle"></span>Assurez le paiement de vos missions
                                            <span class="text-danger text-bold">avec le paiement en ligne.</span>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="feature2__content text-left">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="more-product">
                                        <a href="inscription.php" class="btn btn--danger btn--md btn--round">Devenez jobber</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end /.container -->
    </section>



    <section class="overview-area section--padding">
        <div style="background-image: url(images/testibg.jpg); opacity: 1;">
            <div class="container">
                <!-- start row -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <div class="row">

                    <div class="col-lg-4 offset-lg-1 col-md-6 v_middle overview_cont">
                        <div class="overview-icon">
                            <img src="assets/img/img1.jpg" alt="overview icon">
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-lg-5 offset-lg-1 col-md-6 v_middle overview_cont">
                        <h2 class="overview-title">Qu’est-ce que le jobbing ?</h2>
                        <p>
                            Le jobbing est un concept issu de l’économie collaborative, qui favorise la vente de services et l’aide entre particuliers . Les adeptes du jobbing publient des annonces sur le web, à la recherche d’une personne pour les aider, ou consultent les annonces de particuliers pour trouver un job et proposer leurs services. Le jobbing en France concerne tout type d’activité et les offres d’emploi sont nombreuses et rémunérées : cours de bricolage, assistance informatique, aide ménage, jardinage… Trouver une annonce d’un particulier en lien avec ses compétences permet d’arrondir ses fins de mois et de rendre service à proximité de chez soi. Ne choisissez plus entre finance et loisirs, faites-vous plaisir grâce au jobbing !
                        </p>
                    </div>
                    <!-- end /.col-md-5 -->

                    <div class="col-lg-5 offset-lg-1 col-md-6 v_middle overview_cont">
                        <h2 class="overview-title">Mainsrapides, plateforme n°1 du jobbing entre particuliers</h2>
                        <p>
                            En tant que jobber, Mainsrapides vous simplifie la recherche d’annonces grâce à l’envoi d’alertes job dans votre boite mail. Dès qu’une annonce d’un particulier est publiée près de chez vous et en accord avec vos compétences, vous en êtes informé. Remplissez votre profil cv, et consultez les offres d’emploi sur Mainsrapides pour réaliser un job entre particuliers !
                        </p>
                    </div>
                    <!-- end /.col-md-5 -->

                    <div class="col-lg-4 offset-lg-1 col-md-6 v_middle overview_cont">
                        <div class="overview-icon">
                            <img src="assets/img/img2.jpg" alt="overview icon">
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-lg-4 offset-lg-1 col-md-6 v_middle overview_cont">
                        <div class="overview-icon">
                            <img src="assets/img/img3.jpg" alt="overview icon">
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-lg-5 offset-lg-1 col-md-6 v_middle overview_cont">
                        <h2 class="overview-title">Des annonces d’emploi autour de l’habitat</h2>
                        <p>
                            Notre site de jobbing, via les offres d’emploi, permet également de trouver l’aide d’un plombier ou d’un serrurier en urgence : réparer une fuite d’eau, changer un robinet, réparer une serrure, ouvrir une porte claquée… Les jobbers Mainsrapides à la recherche d’un job, trouveront aussi des annonces d’emploi concernant l’informatique, l’électricité, la domotique et l’installation d’objets connectés. De nombreuses opportunités d’emplois à saisir chez notre partenaire vitale assistance - 3iD : Découvrez leurs opportunités d’emplois
                        </p>
                    </div>
                    <!-- end /.col-md-5 -->


                    <div class="col-lg-5 offset-lg-1 col-md-6 v_middle overview_cont">
                        <h2 class="overview-title">Jobbing Mainsrapides : tout à y gagner !</h2>
                        <p>
                            En tant que jobber, Mainsrapides vous simplifie la recherche d’annonces grâce à l’envoi d’alertes job dans votre boite mail. Dès qu’une annonce d’un particulier est publiée près de chez vous et en accord avec vos compétences, vous en êtes informé. Remplissez votre profil cv, et consultez les offres d’emploi sur Mainsrapides pour réaliser un job entre particuliers !
                        </p>
                    </div>
                    <!-- end /.col-md-5 -->

                    <div class="col-lg-4 offset-lg-1 col-md-6 v_middle overview_cont">
                        <div class="overview-icon">
                            <img src="assets/img/img4.jpg" alt="overview icon">
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-lg-4 offset-lg-1 col-md-6 v_middle overview_cont">
                        <div class="overview-icon">
                            <img src="assets/img/img5.jpg" alt="overview icon">
                        </div>
                    </div>
                    <!-- end /.col-md-4 -->

                    <div class="col-lg-5 offset-lg-1 col-md-6 v_middle overview_cont">
                        <h2 class="overview-title"></h2>
                        <p>
                            Activité phare de notre site de jobbing, la pose de sol se décline sous toutes ses formes : pose de lino, pose de parquet, pose de carrelage, pose de moquette.... Avant toute pose de sol, la surface a besoin d’être préparée. Les jobbers Mainsrapides pourront réaliser le ragréage du sol, refaire un joint de carrelage, retirer la moquette existante, poncer le parquet etc. Bien sûr, avec toute pose de sol, des finitions telles que la pose de plinthe ou la vitrification d’un parquet sont à prévoir. Pas d’inquiétude, nos jobbers experts en pose de sol pourront également s’en charger. Publiez votre annonce de particulier et trouvez le poseur de sol qu’il vous faut, en quelques clics.
                        </p>
                    </div>
                    <!-- end /.col-md-5 -->

                </div>
                <!-- end /.row -->
            </div>
        </div>
    </section>

    <h3 class="display-4 text-center">Ils parlent de nous</h3>

    <section class="section--padding">
        <!-- start .container -->
        <div class="container">
            <!-- start .col-md-12 -->
            <div class="col-md-12">
                <div class="row">
                    <div class="col">
                        <img src="./assets/img/partners/partner1.jpg" alt="Partner1" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner2.jpg" alt="Partner2" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner3.jpg" alt="Partner3" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner4.jpg" alt="Partner4" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner5.jpg" alt="Partner5" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner6.jpg" alt="Partner6" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner7.jpg" alt="Partner7" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner8.jpg" alt="Partner8" class="img-responsive">
                    </div>
                    <div class="col">
                        <img src="./assets/img/partners/partner9.jpg" alt="Partner9" class="img-responsive">
                    </div>
                </div>
            </div>
            <!-- end /.col-md-12 -->
        </div>
        <!-- end /.container -->
    </section>
   
    
    <section class="call-to-action bgimage">
        <div class="bg_image_holder">
            <img src="./assets/img/home_img.jpg" alt="">
        </div>
        <div class="container content_above">
            <div class="row">
                <div class="col-md-12">
                    <div class="call-to-wrap">
                        <h1 class="text--white">Prêt pour nous rejoindre!</h1>
                        <h4 class="text--white">Parmi des milliers de jobers.</h4>
                        <a href="inscription.php" class="btn btn--lg btn--round btn--white callto-action-btn">Inscrivez-vous</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================================
        END CALL TO ACTION AREA
    =================================-->

    <!--================================
        START FOOTER AREA
    =================================-->
    
    <?php include("parts/footer.php") ?>
    
    <!--================================
        END FOOTER AREA
    =================================-->

    <!--//////////////////// JS GOES HERE ////////////////-->

    <?php include("parts/js_scripts.php") ?>

</body>

</html>