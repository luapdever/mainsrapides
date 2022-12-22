<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_sql.php');
include('scripts_php/fonctions.php');

if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
}

$user = get_user($_SESSION["id"]);
$badge = get_badge_user($user["id"]);

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


    <title>Mainsrapides - Badge Identité</title>

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

    <section class="dashboard-area">
        <div class="container">
            <div class="row">
                <?php include("parts/menu_sidebar.php") ?>
                
                <div class="col-lg-9">
            
                    <div class="mt-5">
                        <div class="section-title">
                            <h1>
                                Badge Identité
                            </h1>
                            <?php if(is_null($badge)): ?>
                            <span class="text-muted">
                                Faites-nous parvenir votre pièce d'identité pour des échanges en toute confiance avec les membres 
                                de la communauté Mainsrapides (passeport ou carte d'identité valide).
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="">
                            <div class="row" id="badge_identity">
                                <?php if(is_null($badge)): ?>
                                <form id="badge_add" enctype="multipart/form-data" class="col-lg-12">
                                    <div class="upload_modules module--upload">

                                        <div class="modules__content">
                                            <div class="form-group col-lg">
                                                <label for="country">Pays de la pièce</label>
                                                <div class="select-wrap select-wrap2">
                                                    <select name="country" id="country" class="text_field">
                                                        <option value="">Pays</option>
                                                        <?= fill_country_list() ?>
                                                    </select>
                                                    <span class="lnr lnr-chevron-down"></span>
                                                </div>
                                            </div>

                                            <input type="hidden" name="badge_choice" id="badge_choice">

                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="badge_choice">
                                                    <a href="#carte" aria-controls="carte" role="tab" data-toggle="tab" aria-expanded="false" aria-selected="false">
                                                        Carte d'identité
                                                    </a>
                                                </li>
                                                <li class="badge_choice">
                                                    <a href="#passeport" aria-controls="passeport" role="tab" data-toggle="tab" aria-expanded="false" class="" aria-selected="false">
                                                        Passeport
                                                    </a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mb-5">
                                                <div role="tabpanel" class="fade tab-pane product-tab" id="carte">
                                                    <div class="tab-content-wrapper">
                                                        <h3 class="mb-3">Photos de la carte</h3>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-6">
                                                                    <label for="recto">Recto</label>
                                                                    <input type="file" name="recto" id="recto" class="dropify-fr" />
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <label for="recto">Verso</label>
                                                                    <input type="file" name="verso" id="verso" class="dropify-fr" />
                                                                </div>
                                                            </div>
                                                            <!-- end /.upload_wrapper -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="fade tab-pane product-tab" id="passeport">
                                                    <div class="tab-content-wrapper">
                                                        <h3 class="mb-3">Photo du passeport</h3>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-12 col-lg-6">
                                                                    <label for="recto2">Recto</label>
                                                                    <input type="file" name="recto2" id="recto2" class="dropify-fr" />
                                                                </div>
                                                            </div>
                                                            <!-- end /.upload_wrapper -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div role="tabpanel" class="fade tab-pane product-tab" id="weeks">
                                                    <input type="hidden" name="weeks" value="2 semaines" />
                                                </div>
                                                <div role="tabpanel" class="fade tab-pane product-tab" id="months">
                                                    <input type="hidden" name="months" value="1 mois" />
                                                </div>
                                                <!-- end /.tab-content -->
                                            </div>

                                            <div class="form-group">
                                                <div class="date_area">
                                                    <div class="input_with_icon">
                                                        <input type="text" name="date_expired" class="dattaPikkara" placeholder="Date précise">
                                                        <span class="lnr lnr-calendar-full"></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <!-- submit button -->
                                    <input type="hidden" name="btn_action" value="save_badge" />
                                    <button type="submit" class="btn btn--round btn--fullwidth btn--lg mb-5">Enregistrer</button>
                                </form>
                                <?php else: ?>
                                    <div class="col-lg-8 mt-5">
                                        <div class="item-preview">
                                            <div class="row">
                                                <?php if(!empty($badge["recto"])): ?>
                                                <div class="col-lg-4">
                                                    <img src=".<?= $badge["recto"] ?>" alt="Image" class="img-responsive">
                                                </div>
                                                <?php endif; ?>
                                                <?php if(!empty($badge["verso"])): ?>
                                                <div class="col-lg-4">
                                                    <img src=".<?= $badge["verso"] ?>" alt="Image" class="img-responsive">
                                                </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="card-title">
                                                <h2>
                                                    Type : <span class="text-primary"><?= $badge["type"] ?></span>
                                                </h2>
                                            </div>
                                            <div class="card-body">
                                                <h3 class="text-primary">Pays</h3>
                                                <p><?= $badge["country"] ?></p>
                                                <strong class="text-muted">Expire le 
                                                    <span class="text-danger">
                                                        <?= date("d-m-Y", strtotime($badge["date_expired"])) ?>
                                                    </span>
                                                </strong>
                                            </div>
                                        </div>
                                        <!-- end /.item-preview-->

                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
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
            $('.badge_choice').on('click', function() {
                $('#badge_choice').val($(this).children('a').attr('aria-controls'));
            });

            $(document).on('submit','#badge_add', function(event){
                event.preventDefault();
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
                                "Votre badge a été enregistré.",
                                'success'
                            ).then(() => {
                                window.location.reload();
                            })
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
    </script>

</body>

</html>