<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_list.php');
include('scripts_php/fonctions_sql.php');


if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
}

$user = get_user($_SESSION["id"]);



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


    <title>Mainsrapides - Mon mot de passe</title>

    <link rel="stylesheet" href="assets/plugins/dropify/dist/css/dropify.min.css">
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

    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="index.php">Accueil</a>
                            </li>
                            <li class="active">
                                <a href="#"><?= get_full_name($user) ?></a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Mon mot de passe</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
        START AUTHOR AREA
    =================================-->
    
    <section class="dashboard-area">
        <div class="dashboard_contents">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="dashboard_title_area">
                            <div class="dashboard__title">
                                <h3>Changer votre mot de passe</h3>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <form id="update_mdp" class="setting_form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="information_module">

                                <div class="information__set toggle_module collapse show" id="collapse2">
                                    <div class="information_wrapper form--fields">
                                        <div class="form-group">
                                            <label for="old_mdp">Mot de passe actuel
                                                <sup>*</sup>
                                            </label>
                                            <input type="password" id="old_mdp" name="old_mdp" class="text_field" placeholder="Actuel mot de passe" />
                                        </div>

                                        <div class="form-group">
                                            <label for="mdp">Nouveau mot de passe
                                                <sup>*</sup>
                                            </label>
                                            <input type="password" id="mdp" name="mdp" class="text_field" placeholder="Nouveau" />
                                        </div>

                                        <div class="form-group">
                                            <label for="mdp_bis">Confirmer mot de passe
                                                <sup>*</sup>
                                            </label>
                                            <input type="password" id="mdp_bis" name="mdp_bis" class="text_field" placeholder="Confirmer" />
                                        </div>
                                    </div>
                                    <!-- end /.information_wrapper -->
                                </div>
                                <!-- end /.information__set -->
                            </div>
                            <!-- end /.information_module -->

                        </div>
                        <!-- end /.col-md-6 -->

                        <div class="col-md-12">
                            <input type="hidden" name="btn_action" value="change_mdp" />
                            <div class="dashboard_setting_btn">
                                <button type="submit" class="btn btn--round btn--md">Changer</button>
                            </div>
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </form>
                <!-- end /form -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.dashboard_menu_area -->
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

    <script src="assets/plugins/dropify/dist/js/dropify.min.js"></script>
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
        $(document).ready(function() {
            $(document).on('submit','#update_mdp', function(event){
                event.preventDefault();
                if($("#mdp").val != $("#mdp_bis").val) {
                    swal(
                        'Erreur',
                        'Les mots de passe ne sont pas les mêmes.'
                    );
                } else {
                }
                swal({
                    title: 'Mot de passe',
                    text: 'Voulez-vous vraiment changer votre mot de passe ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                }).then(() => {
                    var form_data = new FormData(this);
                    $.ajax({
                        url: "tables/profile/profile-action.php",
                        type: "POST",
                        enctype: 'multipart/form-data',
                        data: form_data,
                        processData: false,
                        contentType: false,
                        cache: false,
                        dataType: "json",
                        success: function(data)
                        {
                            if(data === "success") {
                                swal(
                                    'Succès',
                                    "Votre mot de passe a été changé.",
                                    'success'
                                ).then(() => {
                                    window.location = "profile.php";
                                })
                            } else if(data === "failed"){
                                swal(
                                    'Error',
                                    "L'ancien mot de passe est incorrect.",
                                    'error'
                                )
                            } else {
                                swal(
                                    'Erreur',
                                    data,
                                    'error'
                                )
                            }
                        }
                    })
                });
            });
        });
    </script>

</body>

</html>