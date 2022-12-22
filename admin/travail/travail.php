<?php


include("../db.php");
include("../scripts_php/fonctions_sql.php");
include("../functions.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}


$title = "Travaux";
$pageTitle = "Tous les travaux";


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
                            <a class="nav-link active" href="travail.php">Tous les travaux</a>
                        </li>
                        <li>
                            <a class="nav-link text-dark" id="add_button" href="#"><i class="icon icon-plus-circle"></i> Ajouter</a>
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
                                    <table id="travail_data" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Photo
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Label
                                                </th>
                                                <th class="border-top" style="background-color: #f1f1f1 !important; color: black !important; font-size: 15px !important; font-weight: bold !important;">
                                                    Sous Catégorie
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

  <!-- Consulter Modal -->
  
    <div id="travailModal_view" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="travail_form_view">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title_view"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div id="travail_details"></div>
                    </div>

                </div>
            </form>
        </div>
    </div>


    <div id="travail_addModal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="travail_add" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-12 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <label for="photo">Photo</label>
                                        <input type="file" name="photo" id="photo" class="dropify-fr" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="label" class="control-label">Label</label>
                            <input type="text" name="label" class="form-control" id="label">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Catégorie</label>
                            <select name="subcategorie" id="subcategorie" class="form-control custom-select" data-placeholder="Selectionner une catégorie" tabindex="1">
                                <option value="">Selectionner une catégorie</option>
                                <?= fill_subcategories_list() ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="btn_action" id="btn_action" value="AJOUTER">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Enregistrer</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    
    
    <div id="travail_updateModal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="travail_update" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modifier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label for="label_modif" class="control-label">Label</label>
                            <input type="text" name="label_modif" class="form-control" id="label_modif">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Sous-Catégorie</label>
                            <select name="subcategorie_modif" id="subcategorie_modif" class="form-control custom-select" data-placeholder="Selectionner une sous-catégorie" tabindex="1">
                                <option id="subcategorie_row" value="">Selectionner une sous-catégorie</option>
                                <?= fill_subcategories_list() ?>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="id_travail_modif" id="id_travail_modif" value="">
                        <input type="hidden" name="btn_action_modif" id="btn_action_modif" value="AJOUTER">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-danger waves-effect waves-light">Modifier</button>
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


    <script src="../assets/plugins/dropify/dist/js/dropify.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
            messages: {
                default: 'Glissez-déposez un fichier ici ou cliquez',
                replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                remove: 'Supprimer',
                error: 'Désolé, le fichier trop volumineux'
            }
        });

        // Used events
        var drEvent = $('#input-file-events').dropify();

        drEvent.on('dropify.beforeClear', function(event, element) {
            return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        });

        drEvent.on('dropify.afterClear', function(event, element) {
            alert('File deleted');
        });

        drEvent.on('dropify.errors', function(event, element) {
            console.log('Has Errors');
        });

        var drDestroy = $('#input-file-to-destroy').dropify();
        drDestroy = drDestroy.data('dropify')
        $('#toggleDropify').on('click', function(e) {
            e.preventDefault();
            if (drDestroy.isDropified()) {
                drDestroy.destroy();
            } else {
                drDestroy.init();
            }
        })
    });
    </script>


<script type="text/javascript">

      /* Affichage de la liste */
      var travaildataTable = $('#travail_data').DataTable({
          "processing":true,
          "serverSide":true,
          "order":[],
          "ajax":{
              url:"travail-fetch.php",
              type:"POST"
          },
          "columnDefs":[
              {
                  "targets":[3],
                  "orderable":false,
              },
          ],
          //"bSort" : false,
          "pageLength": 10
      });


      /* Consulter */

        $(document).on('click', '.view', function(){
            var id_travail_view = $(this).attr("id");
            var btn_action_view = 'consulter';
            $.ajax({
                url:"travail-action.php",
                method:"POST",
                data:{id_travail_view:id_travail_view, btn_action_view:btn_action_view},
                dataType:"json",
                success:function(data)
                {
                    $('#travailModal_view').modal('show');
                    $('.modal-title_view').text("CONSULTER");
                    $('#travail_details').html(data);

                }
            })
        });


        $(document).on('click', '#add_button', function(e){
            e.preventDefault();
            $('#travail_addModal').modal('show');
        });


        $(document).on('submit','#travail_add', function(event){
              event.preventDefault();
              var form_data = new FormData(this);
              $.ajax({
                url:"travail-action.php",
                type:"POST",
                enctype: 'multipart/form-data',
                data:form_data,
                processData: false,
                contentType: false,
                cache: false,
                dataType:"json",
                success:function(data)
                {
                    if(data == "travail existant") {
                    $('#travail_add')[0].reset();
                    swal('Erreur',
                        'Le travail existe déjà',
                        'error');
                    }

                    if(data == "success") {
                    swal('Effectué',
                        'Le travail a été enregistré avec succès',
                        'success'
                    ).then(() => {
                        travaildataTable.ajax.reload();
                        $('#travail_addModal').modal('hide');
                    });
                    }

                    if(data == "Formulaire invalide") {
                        swal('Erreur', data, 'error');
                    }

                    if(data == "Erreur enregistrement image") {
                    $('#userModal_modif').modal('hide');
                    swal('Error',
                        data,
                        'error');
                    }

                    if(data == "Extension non valide ou image trop volumineuse") {
                    $('#userModal_modif').modal('hide');
                    swal('Error',
                        data,
                        'error');
                    }

                    if(data == "Erreur Telechargement") {
                    $('#userModal_modif').modal('hide');
                    swal('Error',
                        data,
                        'error');
                    }

                    if(data == "Image non soumise") {
                    $('#userModal_modif').modal('hide');
                    swal('Error',
                        data,
                        'error');
                    }

                  }
              })
        });
    

        /* Update */
        $(document).on("click", ".update", function(e) {
            e.preventDefault();
            $('#travail_updateModal').modal('show');

            var id_travail_modif = $(this).attr('id');
            var btn_action_modif = 'fetch_single';
            $.ajax({
                url:"travail-action.php",
                method:"POST",
                data:{id_travail_modif:id_travail_modif, btn_action_modif:btn_action_modif},
                dataType:"json",
                success:function(data)
                {
                    console.log(data.nom);
                    $('#label_modif').val(data.label);
                    $('#subcategorie_row').val(data.subcategorie_id);
                    $('#subcategorie_row').text(data.subcategorie);
                    $('#id_travail_modif').val(id_travail_modif);
                    $('#btn_action_modif').val("Modifier");

                }
            })
        });

        $(document).on('submit','#travail_update', function(event){
            event.preventDefault();
            var form_data = $(this).serialize();
            $.ajax({
                url:"travail-action.php",
                method:"POST",
                data:form_data,
                dataType:"json",
                success:function(data)
                {
                    if(data == "travail existant") {
                        $('#travail_updateModal').modal('hide');
                        swal(
                            'Erreur',
                            'Le travail existe déjà',
                            'error'
                        );
                    }

                    if(data == "Modifié") {
                        $('#travail_updateModal').modal('hide');
                        swal('Effectué',
                            'Les modifications ont été enregistrées avec succès',
                            'success'
                        ).then(() => {
                            travaildataTable.ajax.reload();
                            $('#travail_updateModal').modal('hide');
                        });
                    }

                }
            })
        });


        /* Changer statut */
        $(document).on('click', '.changer_statut', function(){
            var id_travail = $(this).attr('id');
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
                        url:"travail-action.php",
                        method:"POST",
                        data:{id_travail:id_travail, status:status, btn_action:btn_action},
                        dataType: "JSON",
                        success:function(data)
                        {
                            if(data == "enable") {
                                swal('Effectué', 'Statut changé pour actif', 'success');
                            }
                            if(data == "disable") {
                                swal('Effectué', 'Statut changé pour inactif', 'success');
                            }

                            travaildataTable.ajax.reload();
                        }
                    });

                } else {
                }
            });

        });

        //Delete

        $(document).on('click', '.delete', function(){
            var id_travail = $(this).attr('id');
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
                        url:"travail-action.php",
                        method:"POST",
                        data:{id_travail:id_travail, status:status, btn_action:btn_action},
                        dataType: "JSON",
                        success:function(data)
                        {
                            if(data == "success") {
                                swal('Effectué', 'Element supprimé', 'success');
                            }
                            else {
                                swal('Erreur', 'Probleme de suppression', 'error');
                            }

                            travaildataTable.ajax.reload();
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