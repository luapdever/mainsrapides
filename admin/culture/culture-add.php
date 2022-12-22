<?php

include('../db.php');
include("../functions.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}

if($_SESSION['type_compte'] == 'lecteur') {
    header("location: culture.php");
    exit();
}

$title = "Culture";
$pageTitle = "Ajouter une culture";

include('../scripts_php/fonctions_list.php');


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
                            <a class="nav-link text-dark" href="culture.php">Toutes les cultures</a>
                        </li>
                        <li>
                            <a class="nav-link active" href="culture-add.php"><i class="icon icon-plus-circle"></i> Ajouter</a>
                        </li>
                    </ul>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Nouvelle culture</h4>
                            </div>
                            <div class="card-body">
                                <form id="culture_add">
                                    <div class="form-body">
                                        <h3 class="card-title">Caracteristiques</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nom</label>
                                                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
                                                    <small class="form-control-feedback"> </small> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Espèce</label>
                                                    <select name="id_espece" id="id_espece" class="form-control custom-select" data-placeholder="Selectionner une espèce" tabindex="1">
                                                        <option value="">Selectionner une espèce</option>
                                                        <?php echo fill_type_espece_list($connect); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Terrain</label>
                                                    <select name="id_terrain" id="id_terrain" class="form-control custom-select" data-placeholder="Selectionner un terrain" tabindex="1">
                                                        <option value="">Selectionner un terrain</option>
                                                        <?php echo fill_type_terrain_list($connect); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Quantité de semence</label>
                                                    <input type="text" name="quantite_semence" id="quantite_semence" class="form-control" placeholder="Quantité de semence" min="1" required>
                                                    <small class="form-control-feedback"> </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Date de debut</label>
                                                    <input type="date" class="form-control" name="date_debut" id="date_debut" placeholder="jj/mm/aaaa">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Date de fin prévue</label>
                                                    <input type="date" class="form-control" name="date_fin" id="date_fin" placeholder="jj/mm/aaaa">
                                                </div>
                                            </div>
                                        </div>

                                        <h3 class="box-title m-t-40">Détails</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Photo</h4>
                                                        <label for="photo">Photo de la culture</label>
                                                        <input type="file" name="photo" id="photo" class="dropify-fr" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label>Notes</label><br />
                                                        <textarea name="notes" id="notes" class="form-control" cols="30" rows="9" placeholder="Notes"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="btn_action" id="btn_action" value="AJOUTER">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Enregistrer</button>
                                        <button type="reset" class="btn btn-inverse">Reinitialiser</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    
    <?php include('../parts/include_js.php'); ?>

    <!-- jQuery file upload -->
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


<script>

/* Enregistrer */

        $(document).on('submit','#culture_add', function(event){
              event.preventDefault();
              var form_data = new FormData(this);
              $.ajax({
                url:"culture-action.php",
                type:"POST",
                enctype: 'multipart/form-data',
                data:form_data,
                processData: false,
                contentType: false,
                cache: false,
                dataType:"json",
                success:function(data)
                {
                      if(data == "Culture existante") {
                        $('#culture_add')[0].reset();
                        swal('Erreur',
                           'Le nom de cette culture existe déjà',
                           'error');
                      }


                      if(data == "Success") {
                        swal('Effectué',
                          'La culture a été enregistrée avec succès',
                          'success');
                          window.location = "culture.php";
                      }

                      if(data == "Formulaire invalide") {
                          swal('Erreur', data, 'error');
                      }

                      if(data == "Erreur enregistrement image") {
                        $('#cultureModal_modif').modal('hide');
                        swal('Error',
                          data,
                          'error');
                      }

                      if(data == "Extension non valide ou image trop volumineuse") {
                        $('#cultureModal_modif').modal('hide');
                        swal('Error',
                          data,
                          'error');
                      }

                      if(data == "Erreur Telechargement") {
                        $('#cultureModal_modif').modal('hide');
                        swal('Error',
                          data,
                          'error');
                      }

                      if(data == "Image non soumise") {
                        $('#cultureModal_modif').modal('hide');
                        swal('Error',
                          data,
                          'error');
                      }

                  }
              })
        });

</script>

</body>
</html>

</body>
</html>