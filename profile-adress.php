<?php

include('database_connection.php');

include('AddLogInclude.php');
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


    <title>Mainsrapides - Mes coordonnées</title>

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
            
                    <div class="row mt-5 ml-5">
                        <div class="col-lg-12 card">
                            <div class="card-body">
                                <h3>
                                    Email - 
                                    <?= is_null($user["email_confirmed_at"]) ? '<strong class="text-danger">Non confirmé</strong>' : '<strong class="text-success">Confirmé</strong>' ?>
                                </h3>
                                <div class="row">
                                    <form action="#">
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <input type="text" name="email" id="email" class="text_field" value="<?= $user["email"] ?>" readonly=""<?= is_null($user["email_confirmed_at"]) ? "readonly" : "" ?> />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="hidden" name="btn_action" value="update" />
                                            <div class="dashboard_setting_btn">
                                                <?php if(is_null($user["email_confirmed_at"])): ?>
                                                    <button id="verify" type="button" class="btn btn--round btn--md">Verifier l'email</button>
                                                <?php else: ?>
                                                    <button type="submit" class="btn btn--round btn--md">Modifier</button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 card">
                            <div class="card-body">
                                <h3>
                                    Telephone - 
                                    <?= is_null($user["num_confirmed_at"]) ? '<strong class="text-danger">Non confirmé</strong>' : '<strong class="text-success">Confirmé</strong>' ?>
                                </h3>
                                <div class="row">
                                    <form action="#">
                                        <div class="col-12 mt-3">
                                            <div class="form-group">
                                                <input type="tel" name="telephone" id="telephone" class="text_field" value="<?= $user["telephone"] ?>" readonly=""<?= is_null($user["num_confirmed_at"]) ? "readonly" : "" ?> />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <input type="hidden" name="btn_action" value="update" />
                                            <div class="dashboard_setting_btn">
                                                <?php if(is_null($user["num_confirmed_at"])): ?>
                                                    <button id="verify_num" type="button" class="btn btn--round btn--md">Verifier le numéro</button>
                                                <?php else: ?>
                                                    <button type="submit" class="btn btn--round btn--md">Modifier</button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
    <script>
        $(document).ready(function() {
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

            $(document).on("click", "#verify", function() {
                $.ajax({
                    url: "mail/mail-action.php",
                    type: "POST",
                    data: {
                        "btn_action": "verify"
                    },
                    dataType: "json",
                    success: function(data)
                    {
                        if(data === "success") {
                            swal(
                                "Email confirmation",
                                "Un mail vous a été envoyé, consulter.",
                                "success"
                            );
                        }
                    }
                }); 
            });

            $(document).on("click", "#verify_num", function() {
                $.ajax({
                    url: "sms/sms-action.php",
                    type: "POST",
                    data: {
                        "btn_action": "verify_num"
                    },
                    dataType: "json",
                    success: function(data)
                    {
                        if(data === "success") {
                            swal({
                                title: "Code Confirmation",
                                text: "Un SMS vous sera envoyé dans les minutes qui suivent, consulter et entrer le code ou réessayer  la confirmation: ",
                                content: "input",
                                button: {
                                    text: "Envoyer",
                                    closeModal: false,
                                },
                            }).then((code) => {
                                $.ajax({
                                    url: "sms/sms-action.php",
                                    type: "POST",
                                    data: {
                                        "btn_action": "confirm_code",
                                        "code": code
                                    },
                                    dataType: "json",
                                    success: (data) => {
                                        if(data === "success") {
                                            swal(
                                                'Numéro confirmé',
                                                'Votre numéro de téléphone a été confirmé avec succès.',
                                                'success'
                                            ).then(() => {
                                                window.location.reload();
                                            });
                                        } else {
                                            swal.stopLoading();
                                            swal(
                                                'Code invalide',
                                                'Votre code est invalide',
                                                'error'
                                            );
                                        }
                                    }
                                })
                            });
                        }
                    }
                }); 
            });
        });
    </script>

</body>

</html>