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
                            <h4>BIENVENUE DANS LA COMMUNAUTÉ 
                                <span class="text-primary text-bold">MAINSRAPIDES.COM</span>
                            </h4>
                            <div>
                                Nous sommes ravis que vous nous ayez rejoint !
                                <br>
                                Commencez dès maintenant à vivre la Mainsrapides Expérience.
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <h4 class="text-primary mb-4">Mes annonces</h4>
                                <div class="dashboard_module recent_buyers">
                                    <div class="card-body">
                                        <p class="text-muted">
                                            Vous n'avez pas encore publié d'annonce. Et si vous profitiez des compétences des jobbers?
                                        </p>
                                        <h6 class="mt-5">Le jobbing avec Mainsrapides c'est :</h6>
                                        <div class="dashboard__content">
                                            <ul>
                                                <li>
                                                    <div class="single_buyer">
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
                                                </li>

                                                <li>
                                                    <div class="single_buyer">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <i class="fa fa-clock-o fa-3x"></i>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h4>200 000 Jobbers</h4>
                                                                <small>Particuliers bricoleurs ou professionnels vérifiés</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="single_buyer">
                                                        <div class="row">
                                                            <div class="col-lg-3">
                                                                <i class="fa  fa-check-square-o fa-3x"></i>
                                                            </div>
                                                            <div class="col-lg-9">
                                                                <h4>200 000 Jobbers</h4>
                                                                <small>Particuliers bricoleurs ou professionnels vérifiés</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <h4 class="text-primary mb-4">Mes missions</h4>
                                <div class="dashboard_module recent_buyers">
                                    <div class="card-body">
                                        <div class="dashboard__content">
                                            <ul>
                                                <li>
                                                    <a class="text-dark" href="profile-info.php">
                                                        <div class="row">
                                                            <div class="col-lg-10 text-center">
                                                                <i class="fa fa-info fa-2x"></i>
                                                                <p class="text-muted">Renseigner vos informations générales</p>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <i class="fa fa-chevron-right fa-2x pt-3"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="text-dark" href="book.php">
                                                        <div class="row">
                                                            <div class="col-lg-10 text-center">
                                                                <i class="fa fa-image fa-2x"></i>
                                                                <p class="text-muted">Ajouter des photos à votre book</p>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <i class="fa fa-chevron-right fa-2x pt-3"></i>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="text-dark" href="profile-skills.php">
                                                        <div class="row">
                                                            <div class="col-lg-10 text-center">
                                                                <i class="fa fa-male fa-2x"></i>
                                                                <p class="text-muted">Selectionner vos compétences</p>
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <i class="fa fa-chevron-right fa-2x pt-3"></i>
                                                            </div>
                                                        </div>
                                                    </a>
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
                data: { "user_id": <?= $_SESSION['id'] ?> },
                dataType: "json",
                success: (data) => {
                    let annonces = data;
                }
            })
        });
    </script>

</body>

</html>