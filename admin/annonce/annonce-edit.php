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

if(!isset($_GET['id'])) {
    header("location: user.php");
}

if($_SESSION['id'] == $_GET['id']) {
    $title = "Profil";
    $pageTitle = "Modifier votre profil";
} else {
    $title = "Utilisateur";
    $pageTitle = "Modifier un utilisateur";
}


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
                                <h4 class="m-b-0 text-white">Modifier</h4>
                            </div>
                            <div class="card-body">
                                <form id="user_form_modif">
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
                                                        <input type="text" name="nom_modif" id="nom_modif" class="form-control" placeholder="Nom" required>
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
                                                        <input type="text" name="prenom_modif" id="prenom_modif" class="form-control" placeholder="Prenoms" required>
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
                                                        <input type="email" name="email_modif" id="email_modif" class="form-control" placeholder="Email" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Role</label>
                                                    <select name="role_modif" id="role_modif" class="form-control custom-select" data-placeholder="Selectionner un type de compte" tabindex="1">
                                                        <option id="role" value="">Selectionner un type de compte</option>
                                                        <?= fill_roles_list() ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code Postal</label>
                                                    <input type="text" name="code_postal_modif" id="code_postal_modif" class="form-control" placeholder="Code Postal" required>
                                                    <small class="form-control-feedback"> </small>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Telephone</label>
                                                    <input type="tel" name="telephone_modif" id="telephone_modif" class="form-control" placeholder="Telephone" required>
                                                    <small class="form-control-feedback"> </small> 
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-3">
                                                <button class="btn btn-danger change_mdp">Changer votre mot de passe</button>
                                                <button class="btn btn-danger hide_mdp">Ne pas changer votre mot de passe</button>
                                            </div>

                                            <div class="col-md-4 mdp">
                                                <div class="form-group">
                                                    <label class="control-label">Ancien Mot de passe</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-lock"></i>
                                                        </div>
                                                        <input type="password" name="mdp" id="mdp" class="form-control" placeholder="Ancien Mot de passe" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mdp_modif">
                                                <div class="form-group">
                                                    <label class="control-label">Mot de passe</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-lock"></i>
                                                        </div>
                                                        <input type="password" name="mdp_modif" id="mdp_modif" class="form-control" placeholder="Mot de passe" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mdp_conf_modif">
                                                <div class="form-group">
                                                    <label class="control-label">Confirmer Mot de passe</label>
                                                    <div class="input-group">
                                                        <div class="input-group-addon">
                                                            <i class="ti-lock"></i>
                                                        </div>
                                                        <input type="password" name="mdp_conf_modif" id="mdp_conf_modif" class="form-control" placeholder="Confirmer Mot de passe" required>
                                                        <small class="form-control-feedback"> </small> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <input type="hidden" name="id_user_modif" id="id_user_modif" value="<?php echo htmlspecialchars($_GET['id']) ?>">
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


<script src="../scripts_js/user_form.js"></script>

  <script type="text/javascript">

  /* fetch single */
          $(document).ready(function() {
              var id_user_modif = <?php echo htmlspecialchars($_GET['id']) ?>;
              var btn_action_modif = 'fetch_single';
              $.ajax({
                  url:"user-action.php",
                  method:"POST",
                  data:{id_user_modif:id_user_modif, btn_action_modif:btn_action_modif},
                  dataType:"json",
                  success:function(data)
                  {
                      console.log(data.nom);
                      $('#email_modif').val(data.email);
                      $('#prenom_modif').val(data.prenom);
                      $('#nom_modif').val(data.nom);
                      $('#code_postal_modif').val(data.code_postal);
                      $('#telephone_modif').val(data.telephone);
                      $('#role').val(data.role_id);
                      $('#role').text(data.role);
                      $('.modal-title_modif').text("MODIFIER");
                      $('.save-edit-bouton_modif').text("MODIFIER");
                      $('#id_user_modif').val(id_user_modif);
                      $('#btn_action_modif').val("Modifier");

                  }
              })
          });


      /* Modifier Submit */

          $(document).on('submit','#user_form_modif', function(event){
              event.preventDefault();
              var form_data = $(this).serialize();
              $.ajax({
                  url:"user-action.php",
                  method:"POST",
                  data:form_data,
                  dataType:"json",
                  success:function(data)
                  {
                      if(data == "user existant") {
                          $('#userModal_modif').modal('hide');
                          swal('Erreur',
                           'L\'email de cet utilisateur existe déjà',
                           'error');
                      }

                      if(data == "Mot de passe incorrect") {
                        swal('Erreur',
                           'Le mot de passe entré est incorrect',
                           'error');
                      }

                      if(data == "Mots de passes differents") {
                        swal('Erreur',
                           'Les mots de passe entrés sont differents',
                           'error');
                      }


                      if(data == "Modifié") {
                        $('#userModal_modif').modal('hide');
                        swal('Effectué',
                          'Les modifications ont été enregistrées avec succès',
                          'success'
                        ).then(() => {
                            window.location = "user.php";
                        });
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