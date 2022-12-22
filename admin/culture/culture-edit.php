<?php

//culture_action.php

include('../db.php');
include('../scripts_php/fonctions_sql.php');
include('../scripts_php/fonctions_list.php');

include("../functions.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}

if(!in_array($_SESSION['type_compte'], ['super_admin', 'admin', 'editeur'])) {
    header("location: ../tb/tb.php");
}

if(!isset($_GET['id'])) {
    header("location: culture.php");
}

$title = "culture";
$pageTitle = "Modifier une culture";


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
                                <h4 class="m-b-0 text-white">Modifier</h4>
                            </div>
                            <div class="card-body">
                                <form id="culture_form_modif">
                                    <div class="form-body">
                                        <h3 class="card-title">Caracteristiques</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nom</label>
                                                    <input type="text" name="nom_modif" id="nom_modif" class="form-control" placeholder="Nom" required>
                                                    <small class="form-control-feedback"> </small> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Espèce</label>
                                                    <select name="id_espece_modif" id="id_espece_modif" class="form-control custom-select" data-placeholder="Selectionner une espèce" tabindex="1">
                                                        <option value="">Selectionner une espèce</option>
                                                        <?php echo fill_type_espece_list($connect); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Terrain</label>
                                                    <select name="id_terrain_modif" id="id_terrain_modif" class="form-control custom-select" data-placeholder="Selectionner un terrain" tabindex="1">
                                                        <option value="">Selectionner un terrain</option>
                                                        <?php echo fill_type_terrain_list($connect); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Quantité de semence</label>
                                                    <input type="text" name="quantite_semence_modif" id="quantite_semence_modif" class="form-control" placeholder="Quantité de semence" min="1" required>
                                                    <small class="form-control-feedback"> </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Date de debut</label>
                                                    <input type="date" class="form-control" name="date_debut_modif" id="date_debut_modif" placeholder="jj/mm/aaaa">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Date de fin prévue</label>
                                                    <input type="date" class="form-control" name="date_fin_modif" id="date_fin_modif" placeholder="jj/mm/aaaa">
                                                </div>
                                            </div>
                                        </div>

                                        <h3 class="box-title m-t-40">Détails</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <label>Notes</label><br />
                                                        <textarea name="notes_modif" id="notes_modif" class="form-control" cols="30" rows="9" placeholder="Notes"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="id_culture_modif" id="id_culture_modif" value="<?php echo htmlspecialchars($_GET['id']) ?>">
                                        <input type="hidden" name="btn_action_modif" id="btn_action_modif" value="Modifier">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Modifier</button>
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

  <script type="text/javascript">

  /* fetch single */
          $(document).ready(function() {
              var id_culture_modif = <?php echo htmlspecialchars($_GET['id']) ?>;
              var btn_action_modif = 'fetch_single';
              $.ajax({
                  url:"culture-action.php",
                  method:"POST",
                  data:{id_culture_modif:id_culture_modif, btn_action_modif:btn_action_modif},
                  dataType:"json",
                  success:function(data)
                  {
                      console.log(data.nom);
                      $('#nom_modif').val(data.nom);
                      $('#quantite_semence_modif').val(data.quantite_semence);
                      $('#id_espece_modif').val(data.id_espece);
                      $('#date_debut_modif').val(data.date_debut);
                      $('#date_fin_modif').val(data.date_fin);
                      $('#id_terrain_modif').val(data.id_terrain);
                      $('#notes_modif').val(data.notes);
                      $('.modal-title_modif').text("MODIFIER");
                      $('.save-edit-bouton_modif').text("MODIFIER");
                      $('#id_culture_modif').val(id_culture_modif);
                      $('#btn_action_modif').val("Modifier");

                  }
              })
          });


      /* Modifier Submit */

          $(document).on('submit','#culture_form_modif', function(event){
              event.preventDefault();
              var form_data = $(this).serialize();
              $.ajax({
                  url:"culture-action.php",
                  method:"POST",
                  data:form_data,
                  dataType:"json",
                  success:function(data)
                  {
                      if(data == "Culture existante") {
                          $('#cultureModal_modif').modal('hide');
                          swal('Erreur',
                           'Le nom de cette culture existe déjà',
                           'error');
                      }


                      if(data == "Modifié") {
                        $('#cultureModal_modif').modal('hide');
                        swal('Effectué',
                          'Les modifications ont été enregistrées avec succès',
                          'success');
                        window.location = "culture.php";
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