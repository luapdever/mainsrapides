<?php

include('database_connection.php');

include('AddLogInclude.php');
include("scripts_php/fonctions_sql.php");
include("scripts_php/fonctions.php");

if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
}

if(isset($_GET["id"])) {
    $annonce = get_annonce($_GET["id"]);
    if($annonce == null || ($annonce["status"] != "enable" && $annonce["user_id"] !== $_SESSION["id"])) {
        header("location: index.php");
    }
} else {
    header("location: index.php");
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


    <title>Mainsrapides - Tableau de bord</title>

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

    <section class="dashboard-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mt-5">
                    <div class="item-preview">
                        <div class="row">
                            <?php if(!empty($annonce["photo1"])): ?>
                            <div class="col-lg-4">
                                <img src=".<?= $annonce["photo1"] ?>" alt="Image" class="img-responsive">
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($annonce["photo2"])): ?>
                            <div class="col-lg-4">
                                <img src=".<?= $annonce["photo2"] ?>" alt="Image" class="img-responsive">
                            </div>
                            <?php endif; ?>
                            <?php if(!empty($annonce["photo3"])): ?>
                            <div class="col-lg-4">
                                <img src=".<?= $annonce["photo3"] ?>" alt="Image" class="img-responsive">
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="card-title">
                            <h2><?= $annonce["titre"] ?></h2>
                        </div>
                        <div class="card-body">
                            <h3 class="text-primary">Description</h3>
                            <p><?= $annonce["description"] ?></p>
                            <div class="row">
                                <div class="col-lg-12">
                                    <strong class="text-<?= $annonce["status"] === 'enable' ? 'success' : 'danger' ?>">
                                    <?= status_annonce($annonce["status"]) ?>
                                </strong>
                                </div>
                            </div>
                            <span class="text-muted">Publié le <?= date("d-m-Y H:i:s", strtotime($annonce["created_at"])) ?></span>
                            <?php if($annonce["status"] === "on_way"): ?>
                                <p class="mt-3">
                                    <span class="text-muted">Une mission est en cours et pris en charge par le jobber que vous avez accepté.</span><br /><br />
                                    <button class="btn btn--sm" id="finish_tbn">Marquer la fin de la mission</button>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <!-- end /.item-preview-->

                </div>
                <!-- end /.col-md-8 -->

                <div class="col-lg-4 mt-5">
                    <aside class="sidebar sidebar--single-product">
                        <div class="sidebar-card card-pricing">
                            <div class="price">
                                <h1>
                                    <?= $annonce["prix_min"] ?><sup>€</sup> -
                                    <?= $annonce["prix_max"] ?><sup>€</sup></h1>
                            </div>
                            <?php if(!is_null($annonce["creneau"]) && $creneau = explode(", ", $annonce["creneau"])): ?>
                            <ul class="pricing-options">
                                <?php foreach ($creneau as $key => $value): ?>
                                <li>
                                    <div class="custom-radio">
                                        <label>
                                            <span class="circle"></span><?= $value ?>
                                        </label>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php else: ?>
                            <div class="section-title">
                                <h3 class="text-primary">
                                    <?= date("d-m-Y", strtotime($annonce["date_fixed"])) ?>
                                </h3>
                            </div>
                            <?php endif; ?>
                            <!-- end /.pricing-options -->
                            
                            <?php if($_SESSION["id"] != $annonce["user_id"]): ?>
                            <div class="purchase-button">
                                <a href="#" class="btn btn--md btn--round" data-target="#postuler" data-toggle="modal">Postuler</a>
                            </div>
                            <?php endif; ?>
                            <!-- end /.purchase-button -->
                        </div>
                        <!-- end /.sidebar--card -->
                    </aside>
                    <!-- end /.aside -->
                </div>
                <!-- end /.col-md-4 -->
            </div>
            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="shortcode_module_title">
                        <div class="dashboard__title">
                            <h3 class="text-primary">Offres</h3>
                        </div>
                    </div>
                    <div class="col-lg-12" >
                        <div class="row" id="offres_list">
                            <div class="ml-5 mb-5 text-center">
                                <i class="fa fa-spin fa-spinner"></i> En cours de chargement...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>

    <div class="modal fade rating_modal" id="postuler" tabindex="-1" role="dialog" aria-labelledby="rating_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h3 class="modal-title" id="rating_modal">Votre prix</h3>
                </div>
                <!-- end /.modal-header -->

                <div class="modal-body">
                    <form id="postuler_form">
                        <input type="hidden" name="annonce_id" value="<?= $annonce["id"] ?>" />
                        <div class="col-12 mb-5">
                            <label for="prix">Prix</label>
                            <input type="number" name="prix" id="prix" class="" placeholder="Entrer votre prix..." value="<?= $annonce["prix_min"] ?>" min="<?= $annonce["prix_min"] ?>" required />
                        </div>
                        <input type="hidden" name="btn_action" value="Postuler" />
                        <button id="submit_btn" type="submit" class="btn btn--round btn--default">Envoyer</button>
                    </form>
                    <!-- end /.form -->
                </div>
                <!-- end /.modal-body -->
            </div>
        </div>
    </div>

    <!--================================
        START FOOTER AREA
    =================================-->
    
    <?php include("parts/footer.php") ?>
    
    <!--================================
        END FOOTER AREA
    =================================-->

    <!--//////////////////// JS GOES HERE ////////////////-->

    <?php include("parts/js_scripts.php") ?>

    <script>
        $(document).ready(function() {

            $.ajax({
                url: "tables/annonce/annonce-offres.php",
                type: "POST",
                data: { "btn_action": "Charger", "annonce_id": <?= $annonce["id"] ?> },
                dataType: "json",
                success: function(data)
                {
                    $("#offres_list").html(data);
                }
            });

            $(document).on("submit", "#postuler_form", function() {
                event.preventDefault();
                var form_data = new FormData(this);
                let last_content = $("#postuler_form #submit_btn").html();
                $("#postuler_form #submit_btn").html("...");
                $.ajax({
                    url: "tables/annonce/annonce-offres.php",
                    type: "POST",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    success: function(data)
                    {
                        $("#postuler").modal("hide");
                        swal(
                            'success',
                            "Votre offre a été pris en compte.",
                            'success'
                        );
                        $("#offres_list").html(data);
                        $("#postuler_form #submit_btn").html(last_content);
                    }
                });
            });

        });
    </script>

</body>

</html>