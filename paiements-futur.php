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


    <title>Mainsrapides - Mes paiements</title>

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
                                MES PAIEMENTS EN COURS
                            </h1>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Liste des données</h4>
                                        <h6 class="card-subtitle"></h6>
                                        <div class="table-responsive">
                                            <table id="paiement_data" class="table withdraw__table">
                                                <thead>
                                                    <tr>
                                                        <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                            Mission
                                                        </th>
                                                        <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                            Somme
                                                        </th>
                                                        <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                            Commission
                                                        </th>
                                                        <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                            Client
                                                        </th>
                                                        <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                            Jobber
                                                        </th>
                                                        <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important; text-align: center !important;">
                                                            Statut
                                                        </th>

                                                        <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important; text-align: center !important;">
                                                            Actions
                                                        </th>
                                                    </tr>
                                                </thead>
                                            </table>
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
        /* Affichage de la liste */
        var paiementdataTable = $('#paiement_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"tables/paiement/paiement-futur-fetch.php",
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":[0, 3, 4, 6],
                    "orderable":false,
                },
            ],
            //"bSort" : false,
            "pageLength": 10
        });


        /* Terminer */
        $(document).on('click', '.terminer', function(){
            var id_paiement = $(this).attr('id');
            var status = $(this).data("status");
            var btn_action = 'terminer';

            swal({
                title: 'Terminer',
                text: 'Avez-vous terminé cette mission',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url:"tables/paiement/paiement-action.php",
                        method:"POST",
                        data:{id_paiement:id_paiement, status:status, btn_action:btn_action},
                        dataType: "JSON",
                        success:function(data)
                        {
                            if(data == "terminé") {
                                swal('Effectué', 'Statut changé pour terminé', 'success');
                            }

                            paiementdataTable.ajax.reload();
                        }
                    });

                } else {
                }
            });

        });

        //Delete

        $(document).on('click', '.payer', function(){
            var id_paiement = $(this).attr('id');
            var status = $(this).data("status");
            var btn_action = 'payer';

            swal({
                title: 'SUPPRIMER',
                text: 'Voulez-vous vraiment payer',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url:"tables/paiement/paiement-action.php",
                        method:"POST",
                        data:{id_paiement:id_paiement, status:status, btn_action:btn_action},
                        dataType: "JSON",
                        success:function(data)
                        {
                            if(data == "payé") {
                                swal('Effectué', 'Paiement effectué', 'success');
                            }
                            else {
                                swal('Erreur', 'Probleme de suppression', 'error');
                            }

                            paiementdataTable.ajax.reload();
                        }
                    });

                } else {
                }
            });

        });
    </script>

</body>

</html>