<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_sql.php');
include('scripts_php/fonctions.php');

if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
}

$user = get_user($_SESSION["id"]);
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


    <title>Mainsrapides - Mes compétences</title>

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
                <?php include("parts/menu_sidebar.php") ?>
                
                <div class="col-lg-9">
            
                    <div class="mt-5">
                        <div class="section-title">
                            <h4>Mes compétences</h4>
                            <div>
                                Sélectionnez les catégories pour lequelles vous êtes compétents afin de les mettre en avant sur votre profil, et de revoir une alerte lorsque de nouvelles missions sont proposées.
                            </div>
                        </div>
                        <form id="save_skills">
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
    
                                                                <div id="sub<?= $subcategorie["id"] ?>" class="panel-collapse collapse" aria-labelledby="panel-<?= $subcategorie["id"] ?>" data-parent="#accordion">
                                                                <?php foreach ($subcategorie["travaux"] as $key => $travail) : ?>
                                                                    <div class="panel-body">
                                                                        <div class="custom-checkbox2">
                                                                            <input type="checkbox" id="tra<?= $travail["id"] ?>" class="" name="skills[]" value="<?= $travail["id"] ?>" <?= search_skill($travail["id"], $user) ? 'checked' : '' ?> />
                                                                            <label for="tra<?= $travail["id"] ?>">
                                                                                <span class="circle"></span><?= $travail["label"] ?>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
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
                        </form>
                    </div>
            
                </div>
            </div>
        </div>
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
            $(document).on('submit','#save_skills', function(event){
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
                                "Vos compétences ont été mises à jour.",
                                'success'
                            )
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