<?php

include('database_connection.php');

include('AddLogInclude.php');
include("scripts_php/fonctions_sql.php");
include("scripts_php/fonctions.php");

if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
}

if(isset($_GET["id_offre"])) {
    $frais_service = 7;
    $offre = get_offre($_GET["id_offre"]);
    $annonce = get_annonce($offre["annonce_id"]);

    if($annonce == null || $annonce["status"] != "enable") {
        header("location: index.php");
    }

    $user_offre = get_user($offre["user_id"]);

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
                <div class="col-lg-12 mt-5">
                    <div class="">
                        <div class="modules__content">
                            <div class="withdraw_module withdraw_history">
                                <div class="withdraw_table_header">
                                    <h3>Withdrawal History</h3>
                                </div>
                                <div class="table-responsive">
                                    <table class="table withdraw__table">
                                        <tbody>
                                            <tr>
                                                <td>Titre de l'annonce</td>
                                                <td class="text-bold"><?= htmlspecialchars($annonce["titre"]) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Prix de l'offre</td>
                                                <td class="text-bold"><?= htmlspecialchars($offre["prix"]) ?> €</td>
                                            </tr>
                                            <tr>
                                                <td>Jobber</td>
                                                <td class="text-bold"><?= htmlspecialchars(get_full_name($user_offre)) ?></td>
                                            </tr>
                                            <tr>
                                                <td>Frais de service</td>
                                                <td class="text-bold"><?= htmlspecialchars($frais_service) ?> €</td>
                                            </tr>
                                            <tr>
                                                <td>Délai du service</td>
                                                <td class="text-bold">Au plus un jour.</td>
                                            </tr>
                                            <tr>
                                                <td class="text-bold"><h2>Total</h2></td>
                                                <td><h2 class="text-bold text-primary"><?= htmlspecialchars($offre["prix"] + $frais_service) ?> €</h2></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="shortcode_modules">
                        <div class="modules__title">
                            <h3>Informations</h3>
                        </div>
                        <div class="modules__content typog">
                            <p>
                                Avant d'accepter une offre d'un jobber, vous devez payé la somme du travail sur l'annonce. Cette somme n'est pas directement pour le jobber 
                                mais sera perçue par <strong>MAINSRAPIDES</strong> qui servira d'intermédiaire une fois la mission terminée. <br><br>
                                Un <strong>frais de service de 7 €</strong> sera appliqué.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 mb-5">
                    <div class="dashboard_setting_btn">
                        <button type="submit" id="accepter_offre" class="btn btn--round btn--md">Payer et Accepter l'offre</button>
                    </div>
                </div>
            </div>
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

            $(document).on("click", "#accepter_offre", function() {
                swal({
                    title: 'ACCEPTER UNE OFFRE',
                    text: 'Voulez-vous accepter cette offre ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "tables/annonce/annonce-offres.php",
                            type: "POST",
                            data: {
                                "btn_action": "Accepter",
                                "annonce_id": <?= $annonce["id"] ?>,
                                "offre_id": <?= $offre["id"] ?>
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if(data === "success") {
                                    swal(
                                        "Mission attribué",
                                        "Une mission vient d'être en cours",
                                        "success"
                                    ).then(() => {
                                        window.location = "annonces.php";
                                    });
                                }
                            }
                        }); 

                    } else {
                    }
                });
            });
        });
    </script>

</body>

</html>