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
                                MES PAIEMENTS RECUS
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
                url:"tables/paiement/paiement-recu-fetch.php",
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":[0, 3, 4],
                    "orderable":false,
                },
            ],
            //"bSort" : false,
            "pageLength": 10
        });


        /* Consulter */

        $(document).on('click', '.view', function(){
            var id_paiement_view = $(this).attr("id");
            var btn_action_view = 'consulter';
            $.ajax({
                url:"paiement-action.php",
                method:"POST",
                data:{id_paiement_view:id_paiement_view, btn_action_view:btn_action_view},
                dataType:"json",
                success:function(data)
                {
                    $('#paiementModal_view').modal('show');
                    $('.modal-title_view').text("CONSULTER");
                    $('#paiement_details').html(data);

                }
            })
        });
    </script>

</body>

</html>