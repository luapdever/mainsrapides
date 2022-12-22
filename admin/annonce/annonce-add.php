<?php


include("../db.php");
include("../functions.php");
include("../scripts_php/fonctions_sql.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}

if($_SESSION['role'] <= 3) {
    header("location: ../user/user-profile.php");
}

$title = "Utilisateur";
$pageTitle = "Ajouter un utilisateur";


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
                            <a class="nav-link text-dark" href="user.php">Tous les utilisateurs</a>
                        </li>
                        <li>
                            <a class="nav-link active" href="user-add.php"><i class="icon icon-plus-circle"></i> Ajouter</a>
                        </li>
                    </ul>
                </div>


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-outline-info">
                            <div class="card-header">
                                <h4 class="m-b-0 text-white">Nouvel utilisateur</h4>
                            </div>
                            <div class="card-body">
                                <form id="user_add">
                                    <div class="form-body">
                                        <h3 class="card-title">Caracteristiques</h3>
                                        <hr>
                                        <div class="row p-t-20">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Nom de l'utilisateur</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-user"></i>
                                                        </div>
                                                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Nom" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Prenoms de l'utilisateur</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-user"></i>
                                                        </div>
                                                        <input type="text" name="prenom" id="prenom" class="form-control" placeholder="Prenoms" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Email de l'utilisateur</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-email"></i>
                                                        </div>
                                                        <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Role</label>
                                                    <select name="role" id="role" class="form-control custom-select" data-placeholder="Selectionner un type de compte" tabindex="1">
                                                        <option value="">Selectionner un role</option>
                                                        <?= fill_roles_list() ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code postal</label>
                                                    <input type="text" name="code_postal" id="code_postal" class="form-control" placeholder="Code Postal" required>
                                                    <small class="form-control-feedback"> </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Telephone</label>
                                                    <input type="tel" name="telephone" id="telephone" class="form-control" placeholder="Telephone" required>
                                                    <small class="form-control-feedback"> </small> 
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Mot de passe</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-lock"></i>
                                                        </div>
                                                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Mot de passe" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Confirmer Mot de passe</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-lock"></i>
                                                        </div>
                                                        <input type="password" name="mdp_conf" id="mdp_conf" class="form-control" placeholder="Confirmer Mot de passe" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <h3 class="box-title m-t-40">Détails</h3>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h4 class="card-title">Photo</h4>
                                                        <label for="photo">Photo</label>
                                                        <input type="file" name="photo" id="photo" class="dropify-fr" />
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

          $(document).on('submit','#user_add', function(event){
              event.preventDefault();
              var form_data = new FormData(this);
              $.ajax({
                url:"user-action.php",
                type:"POST",
                enctype: 'multipart/form-data',
                data:form_data,
                processData: false,
                contentType: false,
                cache: false,
                dataType:"json",
                success:function(data)
                {
                      if(data == "user existant") {
                        $('#user_add')[0].reset();
                        swal('Erreur',
                           'L\'email de cet utilisateur existe déjà',
                           'error');
                      }

                      if(data == "Mots de passes differents") {
                        swal('Erreur',
                           'Les mots de passe entrés sont differents',
                           'error');
                      }


                      if(data == "success") {
                        swal('Effectué',
                          'L\'user a été enregistré avec succès',
                          'success'
                        ).then(() => {
                            window.location = "user.php";
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

</script>

</body>
</html>

</body>
</html>