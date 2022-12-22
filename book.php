<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_sql.php');

if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
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


    <title>Mainsrapides - Book photo</title>

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
                                BOOK PHOTO
                            </h1>
                        </div>
                        <div class="mt-1">
                            <div class="row" id="book_photo">
                                <div class="ml-5 text-center">
                                    <i class="fa fa-spin fa-spinner"></i> En cours de chargement...
                                </div>
                            </div>
                            <div class="mt-3 mb-5">
                                <div class="dashboard_setting_btn">
                                    <a href="#" class="btn btn--md btn--round" data-target="#book" data-toggle="modal">Ajouter une photo</a>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade rating_modal" id="book" tabindex="-1" role="dialog" aria-labelledby="rating_modal" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h3 class="modal-title" id="rating_modal">Votre prix</h3>
                </div>
                <!-- end /.modal-header -->

                <div class="modal-body">
                    <form id="book_form" enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="col-12">
                                <input type="file" name="photo" id="photo" class="dropify-fr" />
                            </div>
                        </div>
                        <label for="categorie_id">Catégorie</label>
                        <div class="select-wrap select-wrap2">
                            <select name="categorie_id" id="categorie_id" class="">
                                <?= fill_categories_list() ?>
                            </select>
                            <span class="lnr lnr-chevron-down"></span>
                        </div>
                        <div class="form-group">
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="text_field" placeholder="Description"></textarea>
                        </div>
                        <input type="hidden" name="btn_action" value="ajouter" />
                        <button id="submit_btn" type="submit" class="btn btn--round btn--default">Ajouter</button>
                    </form>
                    <!-- end /.form -->
                </div>
                <!-- end /.modal-body -->
            </div>
        </div>
    </div>

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
            $.ajax({
                url: "tables/book/book-action.php",
                type: "POST",
                data: { "btn_action": "Charger" },
                dataType: "json",
                success: function(data)
                {
                    $("#book_photo").html(data);
                }
            });

            $(document).on("submit", "#book_form", function() {
                event.preventDefault();
                var form_data = new FormData(this);
                let last_content = $("#book_form #submit_btn").html();
                $("#book_form #submit_btn").html("...");
                $.ajax({
                    url: "tables/book/book-action.php",
                    type: "POST",
                    data: form_data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    dataType: "json",
                    success: function(data)
                    {
                        $("#book").modal("hide");
                        swal(
                            'success',
                            "Votre photo a été ajoutée.",
                            'success'
                        );
                        $("#book_photo").html(data);
                        $("#book_form #submit_btn").html(last_content);
                    }
                });
            });

            $(document).on("click", ".delete-book", function() {
                swal({
                    title: 'Supprimer une photo',
                    text: 'Voulez-vous supprimer cette photo ?',
                    icon: 'warning',
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {

                        $.ajax({
                            url: "tables/book/book-action.php",
                            type: "POST",
                            data: {
                                "btn_action": "supprimer",
                                "book_id": $(this).attr("book-id")
                            },
                            dataType: "json",
                            success: function(data)
                            {
                                if(data != "failed") {
                                    swal(
                                        "Photo supprimée",
                                        "La photo n'est plus",
                                        "success"
                                    ).then(() => {
                                        $("#book_photo").html(data);
                                    });
                                }
                            }
                        }); 

                    } else {
                    }
                });
            });
        });
    </script>

</body>

</html>