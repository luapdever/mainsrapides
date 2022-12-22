<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_list.php');
include('scripts_php/fonctions_sql.php');
include('scripts_php/fonctions.php');


$annonces = get_annonces();

if(isset($_GET["categorie"]) || isset($_GET["order"]) || isset($_GET["prix"])) {
    $annonces = filtered_annonces($_GET);
}


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Frixbiz - Services">
    <meta name="keywords" content="app, app landing, product landing, digital, material, html5">


    <title>Mainsrapides - Mes informations</title>

    <link rel="stylesheet" href="assets/plugins/dropify/dist/css/dropify.min.css">
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

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="index.php">Accueil</a>
                            </li>
                            <li class="active">
                                <a href="#">Consulter les missions</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Missions</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
   
    <form action="missions.php" method="get">
        <div class="filter-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="filter-bar">
    
                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <select name="categorie">
                                        <option value="">Toutes les catégories</option>
                                        <?php foreach(all_categorie() as $key => $categorie): ?>
                                            <option value="<?= $categorie["id"] ?>" <?= isset($_GET["categorie"]) && $_GET["categorie"] === $categorie["id"] ? "selected" : "" ?>>
                                                <?= $categorie["label"] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                            </div>
                            
                            
                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <select name="order">
                                        <option value="">Trier par : </option>
                                        <option value="titre#ASC" <?= isset($_GET["order"]) && $_GET["order"] === "titre#ASC" ? "selected" : "" ?>>
                                            Trier par : Titre croissant
                                        </option>
                                        <option value="titre#DESC" <?= isset($_GET["order"]) && $_GET["order"] === "titre#DESC" ? "selected" : "" ?>>
                                            Trier par : Titre decroissant
                                        </option>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                            </div>
    
    
                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <select name="prix">
                                        <option value="">Prix</option>
                                        <option value="ASC" <?= isset($_GET["prix"]) && $_GET["prix"] === "ASC" ? "selected" : "" ?>>
                                            Prix : Ordre croissant
                                        </option>
                                        <option value="DESC" <?= isset($_GET["prix"]) && $_GET["prix"] === "DESC" ? "selected" : "" ?>>
                                            Prix : Ordre decroissant
                                        </option>
                                    </select>
                                    <span class="lnr lnr-chevron-down"></span>
                                </div>
                            </div>
                            <!-- end /.filter__option -->
    
                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <button type="submit" class="btn btn--fullwidth btn--default">OK</button>
                                </div>
                            </div>                        
                        </div>
                        <!-- end /.filter-bar -->
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end filter-bar -->
            </div>
        </div>
    </form>

    
    <section class="dashboard-area">
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <!-- start .col-md-4 -->
                    <div class="col-md-12">
                        <!-- start .single-product -->
                        <?php foreach($annonces as $key => $annonce): ?>
                        <?php $user = get_user($annonce["user_id"]) ?>
                        <div class="product product--list">
                            <div class="product__thumbnail">
                                <img src=".<?= $annonce["photo1"] ?>" alt="Product Image" class="img-mission" />
                                <div class="prod_btn">
                                    <div class="prod_btn__wrap">
                                        <a href="annonce_single.php?id=<?= $annonce["id"] ?>" class="transparent btn--sm btn--round">Voir plus</a>
                                    </div>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product__details pt-5">
                                <div class="product-desc">
                                    <a href="#" class="product_title">
                                        <h4><?= tinyText($annonce["titre"]) ?></h4>
                                    </a>
                                    <p><?= smallDescription($annonce["description"]) ?></p>
                                </div>
                                <!-- end /.product-desc -->

                                <div class="product-meta">
                                    <div class="author">
                                        <img class="auth-img" src=".<?= $user["photo"] ?>" alt="author image">
                                        <p>
                                            <a href="profile.php?id_user=<?= $user["id"] ?>"><?= get_full_name($user) ?></a>
                                        </p>
                                    </div>

                                    <div class="love-comments">
                                        <p>
                                            <span class="fa fa-send-o"></span> <?= count_offres_annonce($annonce["id"]) ?> offres
                                        </p>
                                    </div>

                                    <div class="rating product--rating">
                                        <i class="fa fa-calendar"></i>
                                        <span class="rating__count">
                                            <?= !is_null($annonce["date_fixed"]) ? date("d-m-Y", strtotime($annonce["date_fixed"])) : $annonce["creneau"] ?>
                                        </span>
                                    </div>
                                </div>
                                <!-- end product-meta -->

                                <div class="product-purchase">
                                    <div class="price_love">
                                        <span><?= $annonce["prix_min"] ?>€ - <?= $annonce["prix_max"] ?>€</span>
                                    </div>
                                    <div class="sell">
                                        <p>
                                            <span class="fa fa-map-marker"></span>
                                            <span><?= $annonce["place"] ?></span>
                                        </p>
                                    </div>
                                </div>
                                <!-- end /.product-purchase -->
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <!-- end /.col-md-4 -->
                </div>
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
    </section>

    <!--================================
        START FOOTER AREA
    =================================-->
    
    <?php include("parts/footer.php") ?>
    
    <!--================================
        END FOOTER AREA
    =================================-->

    <!--//////////////////// JS GOES HERE ////////////////-->

    <?php include("parts/js_scripts.php") ?>

    <script src="assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>
    <script>
        $(document).ready(function() {
            $(document).on('submit','#update_form', function(event){
                event.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: "tables/profile/profile-action.php",
                    type: "POST",
                    enctype: 'multipart/form-data',
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    success: function(data)
                    {
                        if(data === "success") {
                            swal(
                                'Succès',
                                "Vos données ont été mises à jour.",
                                'success'
                            ).then(() => {
                                window.location = "profile.php";
                            })
                        } else {
                            swal(
                                'Erreur',
                                data,
                                'error'
                            )
                        }
                    }
                })
            });
        });
    </script>

</body>

</html>