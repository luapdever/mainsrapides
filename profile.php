<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_sql.php');
include('scripts_php/fonctions.php');

$user = null;
if(isset($_GET["id_user"])) {
    $user = get_user($_GET["id_user"]);
} elseif(isset($_SESSION["id"])) {
    $user = get_user($_SESSION["id"]);
}

if(is_null($user)) {
    header("location: index.php");
}

$categories = all_categorie($connect);
$i = 1;
$j = 1;


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


    <title>Mainsrapides - <?= ($_SESSION["id"] == $user["id"]) ? "Profil" : "Info utilisateur" ?></title>

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
                                <a href="#"><?= ($_SESSION["id"] == $user["id"]) ? "Profil" : "Info utilisateur" ?></a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title"><?= get_full_name($user) ?></h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
        START AUTHOR AREA
    =================================-->
    <section class="author-profile-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <aside class="sidebar sidebar_author">
                        <div class="author-card sidebar-card">
                            <div class="author-infos">
                                <div class="author_avatar">
                                    <?php if(is_null($user["photo"])): ?>
                                        <img src="images/author-avatar.jpg" alt="Presenting the author avatar :D">
                                    <?php else: ?>
                                        <img src=".<?= $user["photo"] ?>" alt="Presenting the author avatar :D">
                                    <?php endif; ?>
                                </div>

                                <div class="author">
                                    <h4><?= get_full_name($user) ?></h4>
                                    <p>Inscris le: <?= date("d/m/Y", strtotime($user["created_at"])) ?></p>
                                </div>
                                <!-- end /.author -->

                                <hr>

                                <div class="social social--color--filled">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-facebook"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-twitter"></span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <span class="fa fa-dribbble"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- end /.social -->

                                <div class="author-btn">
                                    <a href="#" class="btn btn--md btn--round">Follow</a>
                                </div>
                                <!-- end /.author-btn -->
                            </div>
                            <!-- end /.author-infos -->


                        </div>
                        <!-- end /.author-card -->
                        <!-- end /.author-card -->

                        <?php if($user["id"] != $_SESSION["id"]): ?>
                        <div class="sidebar-card message-card">
                            <div class="card-title">
                                <h4>Ecrire à <?= get_full_name($user) ?></h4>
                            </div>
                            
                            
                            <div class="message-form">
                                <form id="send_form" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <textarea name="message" id="message" class="text_field" id="author-message" placeholder="Votre message..."></textarea>
                                    </div>

                                    <div class="msg_submit">
                                        <input type="hidden" name="to_user" value="<?= htmlspecialchars($user["id"]) ?>" />
                                        <input type="hidden" name="btn_action" value="Enregistrer" />
                                        <button type="submit" class="btn btn--md btn--round">Envoyer</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end /.message-form -->
                        </div>
                        <?php endif; ?>
                    </aside>
                </div>
                <!-- end /.sidebar -->

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <div class="author-info mcolorbg4">
                                <p>Total Annonce</p>
                                <h3><?= count_annonces($user["id"]) ?></h3>
                            </div>
                        </div>
                        <!-- end /.col-md-4 -->

                        <div class="col-md-4 col-sm-4">
                            <div class="author-info pcolorbg">
                                <p>Missions accomplies</p>
                                <h3><?= count_missions_finished($user["id"]) ?></h3>
                            </div>
                        </div>
                        <!-- end /.col-md-4 -->

                        <div class="col-md-4 col-sm-4">
                            <div class="author-info scolorbg">
                                <p>Total Ratings</p>
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
                                    <span class="rating__count">(26)</span>
                                </div>
                            </div>
                        </div>
                        <!-- end /.col-md-4 -->

                        <div class="col-md-12 col-sm-12">

                            <div class="author_module about_author">
                                <h2>About
                                    <span><?= get_full_name($user) ?></span>
                                </h2>
                                <p><?= !is_null($user["bio"]) ? $user["bio"] : "Aucune description..." ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- end /.row -->

                    <div class="sidebar-card freelance-status">
                        <div class="card-body">
                            <h2>Annonces</h2>
                        </div>
                    </div>

                    <div class="row" id="annonces_list">
                        <div class="ml-5 mb-5 text-center">
                            <i class="fa fa-spin fa-spinner"></i> En cours de chargement...
                        </div>
                    </div>


                    <div class="sidebar-card freelance-status">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="shortcode_modules">
                                    <div class="tab tab4">
                                        <div class="item-navigation">
                                            <ul class="nav nav-tabs nav--tabs2">
                                                <?php foreach ($categories as $key => $categorie) : ?>
                                                <li>
                                                    <a href="#cat<?= $categorie["id"] ?>" class="<?= $i++ === 1 ? 'active' : '' ?>" aria-controls="tc5" role="tab" data-toggle="tab">
                                                        <small><?= $categorie["label"] ?></small>
                                                    </a>
                                                </li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                        <!-- end /.item-navigation -->

                                        <div class="tab-content">
                                            <?php foreach ($categories as $key => $categorie) : ?>
                                            <div class="tab-pane fade product-tab <?= $j++ === 1 ? 'show active' : '' ?>" id="cat<?= $categorie["id"] ?>">
                                                <div class="ml-4">
                                                    <h3 class="mb-3"><?= $categorie["label"] ?></h3>

                                                    <div class="panel-group accordion" role="tablist" id="accordion">
                                                        <?php foreach ($categorie["subcategories"] as $key => $subcategorie) : ?>
                                                        <div class="panel accordion__single" id="panel-<?= $subcategorie["id"] ?>">
                                                            <div class="single_acco_title">
                                                                <h4>
                                                                    <a data-toggle="collapse" href="#sub<?= $subcategorie["id"] ?>" class="collapsed" aria-expanded="false" data-target="#sub<?= $subcategorie["id"] ?>" aria-controls="sub<?= $subcategorie["id"] ?>">
                                                                        <span><?= $subcategorie["label"] ?></span>
                                                                        <i class="lnr lnr-chevron-down indicator"></i>
                                                                    </a>
                                                                </h4>
                                                            </div>

                                                            <?php $k=0; ?>
                                                            <div id="sub<?= $subcategorie["id"] ?>" class="panel-collapse collapse" aria-labelledby="panel-<?= $subcategorie["id"] ?>" data-parent="#accordion">
                                                            <?php foreach ($subcategorie["travaux"] as $key => $travail) : ?>
                                                                <?php if(search_skill($travail["id"], $user)) : ?>
                                                                <?php $k++; ?>
                                                                    <div class="panel-body">
                                                                        <div class="custom-checkbox2">
                                                                            <label for="tra<?= $travail["id"] ?>">
                                                                                <span class="circle"></span><?= $travail["label"] ?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                <?php endforeach; ?>
                                                                <?php if($k === 0): ?>
                                                                    <div class="p-5">
                                                                        <p>Pas de compétences dans cette catégories.</p>
                                                                    </div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                            <!-- end /.tab-content -->
                                        </div>
                                        <!-- end /.tab-content -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mb-5">
                                <input type="hidden" name="btn_action" value="save_skills" />
                                <div class="dashboard_setting_btn">
                                    <button type="submit" class="btn btn--round btn--md">Enregistrer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- end /.col-md-8 -->

            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
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

    <script>
        $(document).ready(function() {
            $.ajax({
                url:'tables/annonce/annonce_fetch.php',
                method: 'POST',
                data: { "user_id": <?= $user['id'] ?> },
                dataType: "json",
                success: (data) => {
                    $("#annonces_list").html(data);
                }
            });


            $(document).on('submit','#send_form', function(event){
                event.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: "tables/message/message-action.php",
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
                            $("#message")[0].value = '';
                            swal(
                                'Message',
                                'Votre message a été envoyé.',
                                'success'
                            );
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