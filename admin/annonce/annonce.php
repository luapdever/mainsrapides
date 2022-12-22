<?php


include("../db.php");
include("../functions.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}

if($_SESSION['role'] <= 3) {
    header("location: ../annonce/annonce-profile.php");
}

$title = "Utilisateur";
$pageTitle = "Tous les utilisateurs";


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
                            <a class="nav-link active" href="annonce.php">Tous les utilisateurs</a>
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
                                    <table id="annonce_data" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Photo 1
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Titre
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Lieu
                                                </th>
                                                                
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Prix Min
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Prix Max
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
  
  <div id="annonceModal_view" class="modal fade">
      <div class="modal-dialog">
          <form method="post" id="annonce_form_view">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title_view"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <div id="annonce_details"></div>
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
      var annoncedataTable = $('#annonce_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
              url:"annonce-fetch.php",
              type:"POST"
          },
          "columnDefs":[
              {
                  "targets":[6],
                  "orderable":false,
              },
          ],
          //"bSort" : false,
          "pageLength": 10
      });


      /* Consulter */

      $(document).on('click', '.view', function(){
          var id_annonce_view = $(this).attr("id");
          var btn_action_view = 'consulter';
          $.ajax({
              url:"annonce-action.php",
              method:"POST",
              data:{id_annonce_view:id_annonce_view, btn_action_view:btn_action_view},
              dataType:"json",
              success:function(data)
              {
                  $('#annonceModal_view').modal('show');
                  $('.modal-title_view').text("CONSULTER");
                  $('#annonce_details').html(data);

              }
          })
      });


      /* Changer statut */
      $(document).on('click', '.changer_statut', function(){
          var id_annonce = $(this).attr('id');
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
                      url:"annonce-action.php",
                      method:"POST",
                      data:{id_annonce:id_annonce, status:status, btn_action:btn_action},
                      dataType: "JSON",
                      success:function(data)
                      {
                        if(data == "enable") {
                            swal('Effectué', 'Statut changé pour actif', 'success');
                        }
                        if(data == "disable") {
                            swal('Effectué', 'Statut changé pour inactif', 'success');
                        }

                          annoncedataTable.ajax.reload();
                      }
                  });

              } else {
              }
          });

      });

      //Delete

      $(document).on('click', '.delete', function(){
          var id_annonce = $(this).attr('id');
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
                      url:"annonce-action.php",
                      method:"POST",
                      data:{id_annonce:id_annonce, status:status, btn_action:btn_action},
                      dataType: "JSON",
                      success:function(data)
                      {
                        if(data == "success") {
                            swal('Effectué', 'Element supprimé', 'success');
                        }
                        else {
                            swal('Erreur', 'Probleme de suppression', 'error');
                        }

                          annoncedataTable.ajax.reload();
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