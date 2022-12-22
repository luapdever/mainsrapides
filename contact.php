<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_list.php');
include('scripts_php/fonctions_sql.php');


$annonces = get_annonces();


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


    <title>Mainsrapides - Mes informations</title>

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
                                <a href="#">Contactez-nous</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">Contact</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
   

    <section class="contact-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-map-marker"></span>
                                <h4 class="tiles__title">Adresse de l'entreprise</h4>
                                <div class="tiles__content">
                                    <p>202 New Hampshire Avenue , Northwest #100, New York-2573</p>
                                </div>
                            </div>
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-phone"></span>
                                <h4 class="tiles__title">Numéro de téléphone</h4>
                                <div class="tiles__content">
                                    <p>1-800-643-4500</p>
                                    <p>1-800-643-4500</p>
                                </div>
                            </div>
                            <!-- end /.contact_tile -->
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <span class="tiles__icon lnr lnr-inbox"></span>
                                <h4 class="tiles__title">Email</h4>
                                <div class="tiles__content">
                                    <p>support@aazztech.com</p>
                                    <p>support@aazztech.com</p>
                                </div>
                            </div>
                            <!-- end /.contact_tile -->
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-md-12">
                            <div class="contact_form cardify">
                                <div class="contact_form__title">
                                    <h3>Laissez votre message</h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="contact_form--wrapper">
                                            <form action="#" id="contact_send">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="prenom" id="prenom" placeholder="Prénom" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" name="email" id="email" placeholder="Email" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="nom" id="nom" placeholder="Nom" required />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="tel" name="telephone" id="telephone" placeholder="Téléphone" required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <textarea cols="30" rows="10" name="message" id="message" placeholder="Votre message" required></textarea>

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
            $(document).on('submit','#contact_send', function(event){
                event.preventDefault();
                var form_data = new FormData(this);
                $.ajax({
                    url: "contact/contact-action.php",
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
                                "Votre message a été bien envoyé.",
                                'success'
                            ).then(() => {
                                window.location = "index.php";
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