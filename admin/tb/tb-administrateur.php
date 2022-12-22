<?php

include('../db.php');
include("../functions.php");
include('../scripts_php/fonctions_sql.php');

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}

if($_SESSION["role"] != 5) {
    header("location: tb.php");
    exit();
}

$title = "Tableau de Bord";
$pageTitle = "Tableau de Bord - Admin";

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include('../parts/head.php'); ?>
</head>

<body class="fix-header fix-sidebar card-no-border">

    
    <?php include('../parts/loader.php'); ?>


    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <?php include('../parts/navbar.php'); ?>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        
        <?php include('../parts/sidebar-left.php'); ?>

        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                
                <?php include('../parts/header.php'); ?>

                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Annonces</h3>
                                    <?php
                                        $annonces = count_row("annonces");
                                    ?>
                                    <h5><?php echo $annonces['total']; ?></h5>
                                    <p><strong><?php echo $annonces['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $annonces['total7']*100/$annonces['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $annonces['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $annonces['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Book Photo</h3>
                                    <?php
                                        $book_photo = count_row("book_photo");
                                    ?>
                                    <h5><?php echo $book_photo['total']; ?></h5>
                                    <p><strong><?php echo $book_photo['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $book_photo['total7']*100/$book_photo['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $book_photo['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $book_photo['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Offres d'annonces</h3>
                                    <?php
                                        $offre_annonce = count_row("offre_annonce");
                                    ?>
                                    <h5><?php echo $offre_annonce['total']; ?></h5>
                                    <p><strong><?php echo $offre_annonce['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $offre_annonce['total7']*100/$offre_annonce['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $offre_annonce['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $offre_annonce['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-group">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Utilisateurs</h3>
                                    <?php
                                        $users = count_row("users");
                                    ?>
                                    <h5><?php echo $users['total']; ?></h5>
                                    <p><strong><?php echo $users['total7']; ?></strong> - cette semaine</p>
                                </div>
                                <div class="col-12">
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $users['total7']*100/$users['total']; ?>%; height: 6px;" aria-valuenow="<?php echo $users['total7']; ?>"
                                     aria-valuemin="0" aria-valuemax="<?php echo $users['total']; ?>"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
  
    <script src="../assets/js/app.js"></script>

    <?php include('../parts/include_js.php'); ?>

</body>

</html>
