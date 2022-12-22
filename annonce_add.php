<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_list.php');
include("scripts_php/fonctions_sql.php");


if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
}

if(isset($_GET['work_id'])) {
    $work = verify_work($_GET['work_id']);
}

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


    <title>Mainsrapides - Publier une annonce</title>
    
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

                <?php if(!isset($_GET['work_id'])): ?>

                <div class="col-lg-12">
                    <div class="shortcode_module_title mt-5">
                        <div class="dashboard__title">
                            <h3>Publier une annonce</h3>
                            <span class="text-primary">Choisissez une categorie</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="shortcode_modules" id="all_work">
                        <div class="pt-5 text-center">
                            <i class="fa fa-spin fa-spinner"></i> En cours de chargement...
                        </div>
                        <div style="height: 400px;"></div>
                    </div>
                </div>

                <?php elseif(isset($_GET['work_id']) && !is_null($work)): ?>

                <div class="col-lg-12">
                    <div class="shortcode_module_title mt-5">
                        <div class="dashboard__title">
                            <h3>Publier une annonce (<?= $work['label'] ?>)</h3>
                            <span class="text-primary">Decrivez votre annonce</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <form id="annonce_add" enctype="multipart/form-data">
                        <div class="upload_modules">
                            <div class="modules__title">
                                <h3>Annonce Nom &amp; Description</h3>
                            </div>
                            <!-- end /.module_title -->

                            <div class="modules__content">
                                <input type="hidden" name="travail_id" value="<?= $work['id'] ?>" />

                                <div class="form-group">
                                    <label for="titre">Donnez un nom à votre article<br>
                                        <span>(Max 100 characters)</span>
                                    </label>
                                    <input type="text" name="titre" id="titre" class="text_field" placeholder="Titre de votre annonce...">
                                </div>

                                <div class="form-group no-margin">
                                    <label for="description">Description</label>
                                    <textarea name="description" id="description" class="text_field" placeholder="Description de votre annonce..."></textarea>
                                </div>
                            </div>
                            <!-- end /.modules__content -->
                        </div>
                        <!-- end /.upload_modules -->

                        <div class="upload_modules module--upload">
                            <div class="modules__title">
                                <h3>Informations pratiques</h3>
                            </div>
                            <!-- end /.module_title -->

                            <div class="modules__content">
                                <input type="hidden" name="date_choice" id="date_choice">

                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="date_choice">
                                        <a href="#date_fixed" aria-controls="date_fixed" role="tab" data-toggle="tab" aria-expanded="false" aria-selected="false">
                                            Date précise
                                        </a>
                                    </li>
                                    <li class="date_choice">
                                        <a href="#creneau" aria-controls="creneau" role="tab" data-toggle="tab" aria-expanded="false" class="" aria-selected="false">
                                            Créneau horaire
                                        </a>
                                    </li>
                                    <li class="date_choice">
                                        <a href="#weeks" aria-controls="weeks" role="tab" data-toggle="tab" aria-expanded="false" class="" aria-selected="false">
                                            2 semaines
                                        </a>
                                    </li>
                                    <li class="date_choice">
                                        <a href="#months" aria-controls="months" role="tab" data-toggle="tab" aria-expanded="false" class="" aria-selected="false">
                                            1 mois
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content mb-5">
                                    <div role="tabpanel" class="fade tab-pane product-tab" id="date_fixed">
                                        <div class="tab-content-wrapper">
                                            <div class="form-group">
                                                <div class="date_area">
                                                    <div class="input_with_icon">
                                                        <input type="text" name="date_fixed" class="dattaPikkara" placeholder="Date précise">
                                                        <span class="lnr lnr-calendar-full"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="fade tab-pane product-tab" id="creneau">
                                        <div class="tab-content-wrapper">
                                            <div class="row">
                                                <div class="form-group radio-group">
                                                    <p class="label">Choisissez votre créneau</p>
                                                    <div class="custom-checkbox2">
                                                        <input type="checkbox" id="h12" class="" name="creneau[]" value="Entre 7h et 12h" />
                                                        <label for="h12">
                                                            <span class="circle"></span>Entre 7h et 12h
                                                        </label>
                                                    </div>
                                                    <div class="custom-checkbox2">
                                                        <input type="checkbox" id="h14" class="" name="creneau[]" value="Entre 12h et 14h" />
                                                        <label for="h14">
                                                            <span class="circle"></span>Entre 12h et 14h
                                                        </label>
                                                    </div>
                                                    <div class="custom-checkbox2">
                                                        <input type="checkbox" id="h18" class="" name="creneau[]" value="Entre 14h et 18h" />
                                                        <label for="h18">
                                                            <span class="circle"></span>Entre 14h et 18h
                                                        </label>
                                                    </div>
                                                    <div class="custom-checkbox2">
                                                        <input type="checkbox" id="h22" class="" name="creneau[]" value="Entre 18h et 22h" />
                                                        <label for="h22">
                                                            <span class="circle"></span>Entre 18h et 22h
                                                        </label>
                                                    </div>
                                                </div>
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

                                <h3 class="mb-3">Ajouter des photos</h3>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-12 col-lg-3">
                                            <input type="file" name="photo1" id="photo1" class="dropify-fr" />
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <input type="file" name="photo2" id="photo2" class="dropify-fr" />
                                        </div>
                                        <div class="col-12 col-lg-3">
                                            <input type="file" name="photo3" id="photo3" class="dropify-fr" />
                                        </div>
                                    </div>
                                    <!-- end /.upload_wrapper -->
                                </div>

                                <div class="form-group">
                                    <label for="place">Indiquer le lieu d'indication</label>
                                    <div class="select-wrap select-wrap2">
                                        <select name="place" id="place" class="text_field">
                                            <option value="">Lieu</option>
                                            <?= fill_adresses_list($connect) ?>
                                        </select>
                                        <span class="lnr lnr-chevron-down"></span>
                                    </div>
                                </div>
                                <!-- end /.form-group -->
                            </div>
                            <!-- end /.upload_modules -->
                        </div>
                        <!-- end /.upload_modules -->

                        <div class="upload_modules with--addons">
                            <div class="modules__title">
                                <h3>Budget</h3>
                            </div>
                            <!-- end /.module_title -->

                            <div class="modules__content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prix_min">Prix Min</label>
                                            <div class="input-group">
                                                <input type="number" name="prix_min" id="prix_min" class="text_field" placeholder="Minimum" min="0">
                                                <span class="input-group-addon">€</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="prix_max">Prix Max</label>
                                            <div class="input-group">
                                                <input type="number" name="prix_max" id="prix_max" class="text_field" placeholder="Maximum" min="0">
                                                <span class="input-group-addon">€</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <!-- end /.row -->

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="telephone">Telephone</label>
                                            <div class="input-group">
                                                <input type="tel" name="telephone" id="telephone" class="text_field" placeholder="Votre numero de telephone" value="<?= $_SESSION['telephone'] ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end /.row -->
                            </div>
                            <!-- end /.modules__content -->
                        </div>
                        <!-- end /.upload_modules -->

                        <!-- submit button -->
                        <input type="hidden" name="btn_action" value="Enregistrer" />
                        <button type="submit" class="btn btn--round btn--fullwidth btn--lg mb-5">Publier</button>
                    </form>
                </div>

                <div class="col-lg-4 col-md-5">
                    <aside class="sidebar upload_sidebar">
                        <div class="sidebar-card">
                            <div class="card-title">
                                <h3>Quick Upload Rules</h3>
                            </div>

                            <div class="card_content">
                                <div class="card_info">
                                    <h4>Image Upload</h4>
                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent there pharetra, justo ut sceleris
                                        que the mattis interdum.</p>
                                </div>

                                <div class="card_info">
                                    <h4>File Upload</h4>
                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent there pharetra, justo ut sceleris
                                        que the mattis interdum.</p>
                                </div>

                                <div class="card_info">
                                    <h4>Vector Upload</h4>
                                    <p>Nunc placerat mi id nisi interdum mollis. Praesent there pharetra, justo ut sceleris
                                        que the mattis interdum.</p>
                                </div>
                            </div>
                        </div>
                        <!-- end /.sidebar-card -->

                        <div class="sidebar-card">
                            <div class="card-title">
                                <h3>Trouble Uploading?</h3>
                            </div>

                            <div class="card_content">
                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut sceler isque the
                                    mattis, leo quam aliquet congue.</p>
                                <ul>
                                    <li>Consectetur elit, sed do eiusmod the labore et dolore magna.</li>
                                    <li>Consectetur elit, sed do eiusmod the labore et dolore magna.</li>
                                    <li>Consectetur elit, sed do eiusmod the labore et dolore magna.</li>
                                    <li>Consectetur elit, sed do eiusmod the</li>
                                </ul>
                            </div>
                        </div>
                        <!-- end /.sidebar-card -->

                        <div class="sidebar-card">
                            <div class="card-title">
                                <h3>More Upload Info</h3>
                            </div>

                            <div class="card_content">
                                <p>Nunc placerat mi id nisi interdum mollis. Praesent pharetra, justo ut sceler isque the
                                    mattis, leo quam aliquet congue.</p>
                                <ul>
                                    <li>Consectetur elit, sed do eiusmod the labore et dolore magna.</li>
                                    <li>Consectetur elit, sed do eiusmod the labore et dolore magna.</li>
                                    <li>Consectetur elit, sed do eiusmod the labore et dolore magna.</li>
                                    <li>Consectetur elit, sed do eiusmod the</li>
                                </ul>
                            </div>
                        </div>
                        <!-- end /.sidebar-card -->
                    </aside>
                    <!-- end /.sidebar -->
                </div>

                <?php endif; ?>

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

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "tables/all_work.php",
                type: "POST",
                enctype: 'multipart/form-data',
                processData: false,
                contentType: false,
                cache: false,
                dataType: "json",
                success: function(data)
                {
                    $('#all_work').html(data);
                }
            })

            $('.date_choice').on('click', function() {
                $('#date_choice').val($(this).children('a').attr('aria-controls'));
            });
        });
    </script>

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
        $(document).on('submit','#annonce_add', function(event){
            event.preventDefault();
            var form_data = new FormData(this);
            $.ajax({
                url: "tables/annonce/annonce-action.php",
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
                            "L'annonce de la maintenance a bien été ajoutée.",
                            'success'
                        ).then(() => {
                            window.location = "annonces_list.php";
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
    </script>

</body>

</html>