<?php

include('scripts_php/database_connection.php');

include('scripts_php/fonctions.php');


$page_name = 'Contact';

$page_title = 'Nous contacter';


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include 'parts/headmeta.php';?>

    <title><?php echo $page_name; ?> - 1000fcfa.com</title>

    <?php include 'parts/headlink.php';?>

    <?php include 'parts/headstyle.php';?>

    <style>

    </style>
</head>

<body class="preload contact-page">

    <?php include 'parts/header.php';?>

    <?php include 'parts/breadcrumb.php';?>

    <!--================================
        START AFFILIATE AREA
    =================================-->
    <section class="contact-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- start col-md-12 -->
                        <div class="col-md-12">
                            <div class="section-title">
                                <h1>En quoi pouvons-nous vous
                                    <span class="highlighted">aider ?</span>
                                </h1>
                                <!--
                                <p>Laborum dolo rumes fugats untras. Etharums ser quidem rerum facilis dolores nemis omnis fugats.
                                    Lid est laborum dolo rumes fugats untras.</p>
                                -->
                            </div>
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-map-marker"></span>
                                <h4 class="tiles__title">Situation géographique</h4>
                                <div class="tiles__content">
                                    <p>Tanto (Akpakpa)<br> Cotonou - République du Bénin</p>
                                </div>
                            </div>
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-phone"></span>
                                <h4 class="tiles__title">Contacts téléphoniques</h4>
                                <div class="tiles__content">
                                    <p>+(229) 96349143</p>
                                    <p>+(229) 60584212</p>
                                </div>
                            </div>
                            <!-- end /.contact_tile -->
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-inbox"></span>
                                <h4 class="tiles__title">Adresses électroniques</h4>
                                <div class="tiles__content">
                                    <p>contact@1000fcfa.com</p>
                                    <p>info@1000fcfa.com</p>
                                </div>
                            </div>
                            <!-- end /.contact_tile -->
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-md-12">
                            <div class="contact_form cardify">
                                <div class="contact_form__title">
                                    <h3>Laissez-nous un message</h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="contact_form--wrapper">
                                            <form method="post" id="contact_form">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input name="nom_prenom" type="text" style="color: black;" placeholder="Nom et Prénom*" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input name="telephone" type="text" style="color: black;" placeholder="Téléphone*" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input name="objet" type="text" style="color: black;" placeholder="Objet*" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input name="email" type="email" style="color: black;" placeholder="Email*" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <textarea name="message" cols="30" rows="10" style="color: black;" placeholder="Votre message ici*" required></textarea>

                                                <div class="sub_btn">
                                                    <button type="submit" class="btn btn--round btn--default">Envoyer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- end /.col-md-8 -->
                                </div>
                                <!-- end /.row -->
                            </div>
                            <!-- end /.contact_form -->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
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


    <?php include 'parts/footer.php';?>

    <?php include 'parts/js_scripts.php';?> <?php include 'parts/notifications_dropdown.php';?> <?php if( (isset($_SESSION['id_user'])) && ($_SESSION['type'] == 3) ) { include 'parts/sms_acheteur_header.php'; } ?> <?php if( (isset($_SESSION['id_user'])) && ($_SESSION['type'] == 4) ) { include 'parts/sms_vendeur_header.php'; } ?>


    <script>


        $(document).ready(function() {

            $(document).on('submit','#contact_form', function(event){
                event.preventDefault();

                var form_data = $(this).serialize();
                $.ajax({
                    url:'scripts_php/script_contact.php',
                    method:'POST',
                    data:form_data,
                    dataType:"json",
                    success:function(data) {

                        if(data == "Message Ok") {

                            swal(
                                'Envoyé', 'Votre message a bien été envoyé. Merci.', 'success'
                            ).then(function() {
                                window.location = "contact.php";
                            });
                        }
                    }
                });


            });

        });


    </script>

</body>

<?php include 'parts/newsletter.php';?></html>