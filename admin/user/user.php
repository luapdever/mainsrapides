<?php


include("../db.php");
include("../functions.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}

if($_SESSION['role'] <= 3) {
    header("location: ../user/user-profile.php");
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
                            <a class="nav-link active" href="user.php">Tous les utilisateurs</a>
                        </li>
                        <li>
                            <a class="nav-link text-dark" href="user-add.php"><i class="icon icon-plus-circle"></i> Ajouter</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-12">
                    
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Liste des donn??es</h4>
                                <h6 class="card-subtitle"></h6>
                                <div class="table-responsive m-t-40">
                                    <table id="user_data" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Photo
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Email
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Prenoms
                                                </th>
                                                                
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Nom
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Role
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
  
  <div id="userModal_view" class="modal fade">
      <div class="modal-dialog">
          <form method="post" id="user_form_view">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title_view"></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">??</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <div id="user_details"></div>
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
      var userdataTable = $('#user_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
              url:"user-fetch.php",
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
          var id_user_view = $(this).attr("id");
          var btn_action_view = 'consulter';
          $.ajax({
              url:"user-action.php",
              method:"POST",
              data:{id_user_view:id_user_view, btn_action_view:btn_action_view},
              dataType:"json",
              success:function(data)
              {
                  $('#userModal_view').modal('show');
                  $('.modal-title_view').text("CONSULTER");
                  $('#user_details').html(data);

              }
          })
      });


      /* Changer statut */
      $(document).on('click', '.changer_statut', function(){
          var id_user = $(this).attr('id');
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
                      url:"user-action.php",
                      method:"POST",
                      data:{id_user:id_user, status:status, btn_action:btn_action},
                      dataType: "JSON",
                      success:function(data)
                      {
                        if(data == "enable") {
                            swal('Effectu??', 'Statut chang?? pour actif', 'success');
                        }
                        if(data == "disable") {
                            swal('Effectu??', 'Statut chang?? pour inactif', 'success');
                        }

                          userdataTable.ajax.reload();
                      }
                  });

              } else {
              }
          });

      });

      //Delete

      $(document).on('click', '.delete', function(){
          var id_user = $(this).attr('id');
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
                      url:"user-action.php",
                      method:"POST",
                      data:{id_user:id_user, status:status, btn_action:btn_action},
                      dataType: "JSON",
                      success:function(data)
                      {
                        if(data == "success") {
                            swal('Effectu??', 'Element supprim??', 'success');
                        }
                        else {
                            swal('Erreur', 'Probleme de suppression', 'error');
                        }

                          userdataTable.ajax.reload();
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