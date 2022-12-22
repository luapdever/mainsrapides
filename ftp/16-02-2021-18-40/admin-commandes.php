<?php

include('scripts_php/database_connection.php');

include('scripts_php/fonctions.php');

if(!isset($_SESSION['admin_id_user'])) {
    header('location:admin-connexion.php');
}

$page_name = 'Commandes';

$page_title = 'Commandes';

$commandes_en_attente = 'colorBlue fontBold';

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'parts/headmeta.php';?>

    <title><?php echo $page_name; ?> - 1000fcfa.com</title>

    <?php include 'parts/headlink.php';?>

    <?php include 'parts/headstyle.php';?>

    <link rel="stylesheet" href="js/datatables/datatables.min.css">
    <link rel="stylesheet" href="js/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="js/datatables/Select-1.2.4/css/select.bootstrap4.min.css">


    <style>

        td, th {
            /*border-right-color: #ddd !important;*/
            /*border: 1px solid red !important;*/
            vertical-align: middle !important;
        }

        .table thead > tr > th {
            padding: 15px 0 15px 28px;
        }

        .table thead th {
            /*border: 1px solid #dee2e6;*/
        }

        .table-bordered td, .table-bordered th {
            border: 1px solid #ddd !important;
        }

        .sorting {
            -webkit-border-radius: 0px !important;
            border-radius: 0px !important;
        }

        .table tbody > tr > td {
            padding: 10px 0 10px 28px;
            color: black;
        }

        .swal-button--cancel {
            background-color: #efefef !important;
        }



        .enattente {
            background: #0674ec;
            color: #fff;
            font-size: 12px;
            line-height: 32px;
            padding: 0 20px;
            font-weight: 500;
            display: inline-block;
            border-radius: 200px;
        }


        .encours {
            background: #8B008B;
            color: #fff;
            font-size: 12px;
            line-height: 32px;
            padding: 0 20px;
            font-weight: 500;
            display: inline-block;
            border-radius: 200px;
        }

        .annule {
            background: #ffb6c1;
            color: red;
            font-size: 12px;
            line-height: 32px;
            padding: 0 20px;
            font-weight: 500;
            display: inline-block;
            border-radius: 200px;
        }


        .termine {
            background: #000;
            color: white;
            font-size: 12px;
            line-height: 32px;
            padding: 0 20px;
            font-weight: 500;
            display: inline-block;
            border-radius: 200px;
        }

        .supprime {
            background: #DE3163;
            color: white;
            font-size: 12px;
            line-height: 32px;
            padding: 0 20px;
            font-weight: 500;
            display: inline-block;
            border-radius: 200px;
        }

    </style>
</head>

<body class="preload add-payment-method">

<?php include 'parts/admin_header.php';?>

<?php include 'parts/admin_breadcrumb.php';?>

<!--================================
        START DASHBOARD AREA
=================================-->
<section class="dashboard-area">

    <div class="dashboard_menu_area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="dashboard_menu">
                        <li>
                            <a href="admin-tb.php">
                                <span class="lnr lnr-home"></span>Revenir au Tableau de bord</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard_contents">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">

                    <div class="row">
                        <div id="paiements_data_section" class="col-md-12">
                            <div class="credit_modules">

                                <div class="modules__title">
                                    <h3>Liste des commandes</h3>
                                </div>


                                <div class="modules__content">

                                    <div class="table-responsive">

                                        <table id="commande_data" class="table table-striped table-bordered" cellspacing="0" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Commande</th>
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Date de paiement</th>
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Vendeur</th>
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Acheteur</th>
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Montant</th>
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;" title="Commission de 1000fcfa">Com.</th>
                                                    <!--<th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Montant net</th>-->
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">Statut de la commande</th>
                                                    <th style="background-color: #f9f9f9 !important; color: black !important; font-size: 15px !important; font-weight: bold !important; ">Action</th>
                                                </tr>
                                            </thead>

                                        </table>


                                    </div>

                                </div>
                                <!-- end /.modules__content -->
                            </div>
                        </div>

                    </div>

                </div>

            </div>





        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.dashboard_menu_area -->
</section>
<!--================================
        END DASHBOARD AREA
=================================-->




<?php include 'parts/js_scripts.php';?>

<script src="js/datatables/datatables.min.js"></script>
<script src="js/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="js/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>



<script>

    $(document).ready(function() {

        /* Affichage de la liste des commandes */
        var commandedataTable = $('#commande_data').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "paging": true,
            "info": false,
            "order": [],
            "ajax": {
                url: "scripts_php/admin_fetch_commandes.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [7],
                    "orderable": false
                },
            ],
            //"bSort" : false,
            "pageLength": 10
        });



        /* Activer ou lancer une commande */
        $(document).on('click', '.activate', function(){
            var id_cmde = $(this).attr('id');
            var id_vendeur = $(this).attr("jp");
            var id_acheteur = $(this).attr("jp2");
            var email_vendeur = $(this).attr('jp3');
            var email_acheteur = $(this).attr('jp4');


            swal("Êtes-vous sûr(e) que l'acheteur a payé chez FedaPay ?", {
                buttons: {
                    yes: {
                        text: "Lancer",
                        value: "yes"
                    },
                    no: {
                        text: "Annuler",
                        value: "no"
                    }
                }
            }).then((value) => {
                if (value === "yes") {
                    $.ajax({
                        url:"scripts_php/admin_activate_commande.php",
                        method:"POST",
                        data:{id_cmde:id_cmde, id_vendeur:id_vendeur, email_vendeur:email_vendeur, id_acheteur:id_acheteur, email_acheteur:email_acheteur},
                        dataType:"json",
                        success:function(data)
                        {

                            if(data == "Commande Ok") {

                                swal(
                                    'Commande lancée', 'La commande a bien été lancée.', 'success'
                                ).then(function() {
                                    window.location = "admin-commandes.php";
                                });


                            }
                        }
                    })
                }
                return false;
            });


        });




        /* Supprimer une commande */
        $(document).on('click', '.delete', function(){
            var id_cmde = $(this).attr('id');
            var id_vendeur = $(this).attr("jp");
            var id_acheteur = $(this).attr("jp2");
            var email_vendeur = $(this).attr('jp3');
            var email_acheteur = $(this).attr('jp4');


            swal("Êtes-vous sûr(e) de vouloir supprimer la commande ?", {
                buttons: {
                    yes: {
                        text: "Supprimer",
                        value: "yes"
                    },
                    no: {
                        text: "Annuler",
                        value: "no"
                    }
                }
            }).then((value) => {
                if (value === "yes") {
                    $.ajax({
                        url:"scripts_php/admin_deactivate_commande.php",
                        method:"POST",
                        data:{id_cmde:id_cmde, id_vendeur:id_vendeur, email_vendeur:email_vendeur, id_acheteur:id_acheteur, email_acheteur:email_acheteur},
                        dataType:"json",
                        success:function(data)
                        {

                            if(data == "Commande deleted") {

                                swal(
                                    'Commande supprimé', 'La commande a bien été supprimée.', 'success'
                                ).then(function() {
                                    window.location = "admin-commandes.php";
                                });


                            }
                        }
                    })
                }
                return false;
            });


        });











    });

</script>


</body>