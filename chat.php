<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_list.php');
include('scripts_php/fonctions_sql.php');


if(!isset($_SESSION['role']))
{
	header("location: connexion.php");
}

if(!isset($_GET["with"])) {
    header("location: messages.php");
}

$user = get_user($_SESSION["id"]);
$with_user = get_user($_GET["with"]);

if(is_null($user) || is_null($with_user)) {
    header("location: index.php");
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


    <title>Mainsrapides - Ma messagerie</title>

    <link rel="stylesheet" href="assets/plugins/dropify/dist/css/dropify.min.css">
    <?php include("parts/headmeta.php") ?>
    <link rel="stylesheet" href="css/chat.css">

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


    <!--================================
        START AUTHOR AREA
    =================================-->
    
    <section class="dashboard-area">
        <div class="dashboard_contents">
            <div class="container">

                <form id="send_form" class="setting_form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12" >
                            <div class="chat_area cardify">
                                <div class="chat_area--title">
                                    <h3>Message avec
                                        <a href="profile.php?id_user=<?= $with_user["id"] ?>" class="name"><?= get_full_name($with_user) ?></a>
                                    </h3>
                                </div>
                                <!-- end /.chat_area--title -->

                                <div class="chat_area--conversation"> 
                                    <div class="col-12 col-lg-12 col-xl-12">
                                        <div class="position-relative">
                                            <div id="messages_chat" class="chat-messages p-4">
                                                <div class="ml-5 mb-5 text-center">
                                                    <i class="fa fa-spin fa-spinner"></i> En cours de chargement...
                                                </div>
                                                <div style="margin-top: 500px;"></div>
                                            </div>
                                        </div>

                                        <div class="flex-grow-0 py-3 px-4 border-top">
                                            <div class="input-group">
                                                <input type="hidden" name="to_user" value="<?= htmlspecialchars($_GET["with"]) ?>" />
                                                <input type="hidden" name="btn_action" value="Enregistrer" />
                                                <input type="text" name="message" id="message" class="form-control" placeholder="Ecrire un message" autocomplete="off">
                                                <button class="btn btn-primary btn--sm">Envoyer</button>
                                            </div>

                                            <!-- <div class="message_composer">
                                                <div class="attached"></div>
    
                                                <div class="btns">
                                                    <label for="att">
                                                        <input type="file" class="attachment_field" id="att" multiple="">
                                                        <span class="lnr lnr-paperclip"></span>Attachment</label>
                                                </div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                            <!-- end /.chat_area -->
                        </div>
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

            function scrollBottom() {
                let chat = $("#messages_chat")
                chat.scrollTop(100000);
            }

            loadMessages = () => {
                $.ajax({
                    url:'tables/message/message_chat-fetch.php',
                    method: 'POST',
                    data: { "with_user_id": <?= $_GET['with'] ?> },
                    dataType: "json",
                    success: (data) => {
                        $("#messages_chat").html(data);
                    }
                });
            }

            loadMessages();
            scrollBottom();

            setInterval(function() {
                loadMessages();
            }, 3000);

            $(document).on('submit','#send_form', function(event){
                event.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: "tables/message/message-action.php",
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
                            $("#message")[0].value = '';
                            loadMessages();
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