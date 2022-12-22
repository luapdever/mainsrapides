<?php


include("../db.php");
include("../functions.php");
include("../scripts_php/fonctions_sql.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
}


$title = "Profil";
$pageTitle = "Votre profil";


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
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="..<?php echo htmlspecialchars($_SESSION['photo']); ?>" width="200" />
                                    <h4 class="card-title m-t-10"><?php echo htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?></h4>
                                    <h6 class="card-subtitle">Un <?php echo htmlspecialchars(get_role($_SESSION['role'])["label"]); ?> du site</h6>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Adresse Email </small>
                                <h6><?php echo htmlspecialchars($_SESSION['email']); ?></h6>
                                <br />
                                <small class="text-muted">Reseau social</small>
                                <br/>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs profile-tab" role="tablist">
                                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#profile" role="tab">Profil</a> </li>
                                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Modifier votre profil</a> </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!--second tab-->
                                <div class="tab-pane active" id="profile" role="tabpanel">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-xs-6 b-r"> <strong>Prenoms</strong>
                                                <br>
                                                <p class="text-muted"><?php echo htmlspecialchars($_SESSION['prenom']); ?></p>
                                            </div>
                                            <div class="col-md-6 col-xs-6 b-r"> <strong>Nom</strong>
                                                <br>
                                                <p class="text-muted"><?php echo htmlspecialchars($_SESSION['nom']); ?></p>
                                            </div>
                                            <div class="col-md-6 col-xs-6 b-r"> <strong>Email</strong>
                                                <br>
                                                <p class="text-muted"><?php echo htmlspecialchars($_SESSION['email']); ?></p>
                                            </div>
                                            <div class="col-md-6 col-xs-6 b-r"> <strong>Rôle</strong>
                                                <br>
                                                <p class="text-muted">
                                                    <span class="badge badge-primary"><?php echo htmlspecialchars(get_role($_SESSION['role'])["label"]); ?></span>
                                                </p>
                                            </div>
                                            <div class="col-md-6 col-xs-6 b-r"> <strong>Code postal</strong>
                                                <br>
                                                <p class="text-muted"><?php echo htmlspecialchars($_SESSION['code_postal']); ?></p>
                                            </div>
                                            <div class="col-md-6 col-xs-6 b-r"> <strong>Telephone</strong>
                                                <br>
                                                <p class="text-muted"><?php echo htmlspecialchars($_SESSION['telephone']); ?></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4 class="font-medium m-t-30">Niveau d'accès au site</h4>
                                        <hr>
                                        <?php if($_SESSION['role'] == 6): ?>
                                            <h5 class="m-t-30"><?php echo htmlspecialchars(get_role($_SESSION['role'])["label"]); ?> <span class="pull-right">100%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                        <?php elseif($_SESSION['role'] == 5): ?>
                                            <h5 class="m-t-30"><?php echo htmlspecialchars(get_role($_SESSION['role'])["label"]); ?> <span class="pull-right">80%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width:80%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                        <?php elseif($_SESSION['role'] == 4): ?>
                                            <h5 class="m-t-30"><?php echo htmlspecialchars(get_role($_SESSION['role'])["label"]); ?> <span class="pull-right">75%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width:75%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                        <?php elseif($_SESSION['role'] == 3): ?>
                                            <h5 class="m-t-30"><?php echo htmlspecialchars(get_role($_SESSION['role'])["label"]); ?> <span class="pull-right">30%</span></h5>
                                            <div class="progress">
                                                <div class="progress-bar bg-info" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width:30%; height:6px;"> <span class="sr-only">50% Complete</span> </div>
                                            </div>
                                        <?php endif; ?>
                                        <hr>
                                    </div>
                                </div>
                                <div class="tab-pane" id="settings" role="tabpanel">
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
                                                    <input type="hidden" name="role_modif" value="<?php echo htmlspecialchars($_SESSION['role']); ?>" />
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Code postal</label>
                                                            <input type="text" name="code_postal_modif" id="code_postal_modif" class="form-control" placeholder="Adresse" required>
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
                                                                <input type="password" name="mdp_modif" id="mdp_modif" class="form-control" placeholder="Ancien Mot de passe" required>
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
                                                <input type="hidden" name="id_user_modif" id="id_user_modif" value="<?php echo htmlspecialchars($_SESSION['id']) ?>">
                                                <input type="hidden" name="btn_action_modif" id="btn_action_modif" value="Modifier">
                                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Modifier</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->



            </div>


        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
    
    </div>

    
    <?php include('../parts/include_js.php'); ?>

    <script src="../scripts_js/user_form.js"></script>

<script type="text/javascript">

  /* fetch single */
          $(document).ready(function() {
              var id_user_modif = <?php echo htmlspecialchars($_SESSION['id']) ?>;
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
                      $('#role_modif').val(data.role);
                      $('#code_postal_modif').val(data.code_postal);
                      $('#telephone_modif').val(data.telephone);
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
                            window.location = "user-profile.php";
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