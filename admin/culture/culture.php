<?php

session_start();
include("../functions.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}
$title = "Culture";
$pageTitle = "Toutes les cultures";


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

                <div class="row">
                    <ul class="nav">
                        <li>
                            <a class="nav-link active" href="culture.php">Toutes les cultures</a>
                        </li>
                        <li>
                            <a class="nav-link text-dark" href="culture-add.php"><i class="icon icon-plus-circle"></i> Ajouter</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-12">
                    
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Liste des données</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive m-t-40">
                                    <table id="culture_data" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Photo
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Nom
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Espèce
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Terrain
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Quantité de semence
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Date de début
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Date de fin prévue
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

  <!-- Consulter Modal -->
  
  <div id="cultureModal_view" class="modal fade">
      <div class="modal-dialog">
          <form method="post" id="culture_form_view">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title_view"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <div id="culture_details"></div>
                  </div>

              </div>
          </form>
      </div>
  </div>


</div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
    <?php include('../parts/include_js.php'); ?>


<script type="text/javascript">

      /* Affichage de la liste */
      var culturedataTable = $('#culture_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
              url:"culture-fetch.php",
              type:"POST"
          },
          "columnDefs":[
              {
                  "targets":[8], //Specifie l'index de la colonne qu'on ne veut pas trier
                  "orderable":false,
              },
          ],
          //"bSort" : false,
          "pageLength": 10
      });


      /* Consulter */

      $(document).on('click', '.view', function(){
          var id_culture_view = $(this).attr("id");
          var btn_action_view = 'consulter';
          $.ajax({
              url:"culture-action.php",
              method:"POST",
              data:{id_culture_view:id_culture_view, btn_action_view:btn_action_view},
              dataType:"json",
              success:function(data)
              {
                  $('#cultureModal_view').modal('show');
                  $('.modal-title_view').text("CONSULTER");
                  $('#culture_details').html(data);

              }
          })
      });


      /* Changer statut */
      $(document).on('click', '.changer_statut', function(){
          var id_culture = $(this).attr('id');
          var status = $(this).data("status");
          var btn_action = 'changer_statut';

          swal({
              title: 'CHANGER STATUT',
              text: 'Voulez-vous changer le statut de cet element',
              icon: 'warning',
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {

                  $.ajax({
                      url:"culture-action.php",
                      method:"POST",
                      data:{id_culture:id_culture, status:status, btn_action:btn_action},
                      dataType: "JSON",
                      success:function(data)
                      {
                        if(data == "Actif") {
                            swal('Effectué', 'Statut changé pour actif', 'success');
                        }
                        if(data == "Inactif") {
                            swal('Effectué', 'Statut changé pour inactif', 'success');
                        }

                          culturedataTable.ajax.reload();
                      }
                  });

              } else {
              }
          });

      });

      //Delete

      $(document).on('click', '.delete', function(){
          var id_culture = $(this).attr('id');
          var status = $(this).data("status");
          var btn_action = 'delete';

          swal({
              title: 'SUPPRIMER',
              text: 'Voulez-vous vraiment supprimer cet element',
              icon: 'warning',
              buttons: true,
              dangerMode: true,
          })
          .then((willDelete) => {
              if (willDelete) {

                  $.ajax({
                      url:"culture-action.php",
                      method:"POST",
                      data:{id_culture:id_culture, status:status, btn_action:btn_action},
                      dataType: "JSON",
                      success:function(data)
                      {
                        if(data == "Supprime") {
                            swal('Effectué', 'Element supprimé', 'success');
                        }
                        else {
                            swal('Erreur', 'Probleme de suppression', 'error');
                        }

                          culturedataTable.ajax.reload();
                      }
                  });

              } else {
              }
          });

      });


  </script>


</body>
</html>

</body>
</html>