<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_sql.php');

if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
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
                <?php include("parts/menu_sidebar.php") ?>
                
                <div class="col-lg-9">
            
                    <div class="mt-5">
                        <div class="section-title">
                            <h1>
                                LES MISSIONS TERMINEES
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <?php include("./parts/annonce_mission.php") ?>
                            </div>
                            <div class="col-lg-4 offset-lg-2">
                                <div class="btn btn--round btn--lg mb-5">Mes paiements</div>
                            </div>
                        </div>
                        <div class="mt-5">
                            <div class="row" id="mission_list">
                                <div class="ml-5 mb-5 text-center">
                                    <i class="fa fa-spin fa-spinner"></i> En cours de chargement...
                                </div>
                            </div>
                        </div>
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
            $.ajax({
                url:'tables/mission/mission_finished_fetch.php',
                method: 'POST',
                data: { "user_id": <?= $_SESSION['id'] ?> },
                dataType: "json",
                success: (data) => {
                    $("#mission_list").html(data);
                }
            })
        });
    </script>

</body>

</html>