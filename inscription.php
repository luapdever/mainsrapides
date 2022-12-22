<?php

include('database_connection.php');

include('AddLogInclude.php');

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Mainsrapides - Services">
    <meta name="keywords" content="app, app landing, product landing, digital, material, html5">


    <title>Mainsrapides - Inscription</title>

    <!-- inject:css -->
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fontello.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/lnr-icon.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/slick.css">
    <link rel="stylesheet" href="css/trumbowyg.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- endinject -->

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
</head>

<body class="preload signup-page">

    <!--================================
            START SIGNUP AREA
    =================================-->
    <section class="signup_area section--padding2">
        <div class="container">
            <div class="text-center mb-5">
                <img src="./assets/img/logo.jpeg" alt="" class="img-responsive" width="300" />
            </div>
            
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <form method="POST" id="form_inscription">
                        <div class="cardify signup_form">
                            <div class="login--header">
                                <h3>Créer un compte</h3>
                                <p>Veuillez remplir les champs ci-dessous avec les informations appropriées. Seul votre pseudo sera visible par les autres utilisateurs.
                                </p>
                            </div>
                            <!-- end .login_header -->

                            <div class="login--form">

                                <div class="row">

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="nom">Nom<sup>*</sup></label>
                                        <input id="nom" name="nom" type="text" class="text_field" required>
                                    </div>

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="prenom">Prénom(s)<sup>*</sup></label>
                                        <input id="prenom" name="prenom" type="text" class="text_field" required>
                                    </div>

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="code_postal">Code Postal<sup>*</sup></label>
                                        <input id="code_postal" name="code_postal" type="text" class="text_field" data-toggle="tooltip" data-placement="left" title="Code postal de votre environnement." placeholder="Code Postal" maxlength="20" required>
                                    </div>

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="email">Email<sup>*</sup></label>
                                        <input id="email" name="email" type="email" class="text_field" required>
                                    </div>

                                    <!--
                                    <div class="form-group col-12 col-lg-6">
                                        <label for="password">Mot de passe</label>
                                        <input id="" name="" type="password" class="text_field pwstrength" data-indicator="pwindicator" required>
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>

                                    </div>
                                    -->

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="mdp">Mot de passe<sup>*</sup></label>
                                        <input id="mdp" name="mdp" type="password" class="text_field" required>

                                    </div>

                                    <div class="form-group col-12 col-lg-6">
                                        <label for="mdp_bis">Confirmer le mot de passe<sup>*</sup></label>
                                        <input id="mdp_bis" name="mdp_bis" type="password" class="text_field" required>
                                    </div>

                                    <div class="form-group col-12 col-lg-12" style="margin-top: 20px; margin-bottom: 0px;">
                                        <label for="">Votre profil</label>
                                    </div>

                                    <div class="form-group col-12 col-lg-4">
                                        <label class="custom-switch mt-2">
                                            <input type="radio" name="profil" class="custom-switch-input" value="client" checked>
                                            <span class="custom-switch-indicator"></span>
                                            <span style="margin-left: 11px; color: black;">Je suis un client</span>
                                        </label>
                                    </div>

                                    <div class="form-group col-12 col-lg-4">
                                        <label class="custom-switch mt-2">
                                            <input type="radio" name="profil" class="custom-switch-input" value="jobber">
                                            <span class="custom-switch-indicator"></span>
                                            <span style="margin-left: 11px; color: black;">Je suis un jobber</span>
                                        </label>
                                    </div>

                                    <!--
                                    <div class="form-group col-12 col-lg-4">
                                        <label class="custom-switch mt-2">
                                            <input type="radio" name="profil" class="custom-switch-input" value="acheteur-vendeur">
                                            <span class="custom-switch-indicator"></span>
                                            <span style="margin-left: 11px; color: black;">Les deux</span>
                                        </label>
                                    </div>
                                    -->


                                    <div class="form-group col-12 col-lg-12">
                                        <div class="custom_checkbox">
                                            <input type="checkbox" name="conditions" value="coche" id="ch2">
                                            <label for="ch2">
                                                <span class="shadow_checkbox"></span>
                                                <!--<span class="label_text" style="color: black;">J’ai lu et j’accepte les <a href="#" data-target="#conditionsModal" data-toggle="modal"><b>conditions générales d’utilisation</b></a>.</span>-->
                                                <span class="label_text" style="color: black;">J’ai lu et j’accepte les <a href="conds.pdf" target="_blank"><b>conditions générales d’utilisation</b></a>.</span>
                                            </label>
                                        </div>
                                    </div>


                                    <div class="form-group col-12 col-lg-6">
                                        <button id="inscription" name="inscription" class="btn btn--md btn--round register_btn" type="submit">S'inscrire</button>
                                    </div>



                                </div>

                                <div class="" style="text-align: right;">
                                    Vous avez déjà un compte ?
                                        <a href="connexion.php">Connectez-vous</a>
                                </div>


                            </div>
                            <!-- end .login--form -->
                        </div>
                        <!-- end .cardify -->
                    </form>
                </div>

                <!-- end .col-md-6 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </section>
    <!--================================
            END SIGNUP AREA
    =================================-->



    <!-- ========= Modal Conditions générales ======== -->

    <div class="modal fade rating_modal" id="conditionsModal" tabindex="-1" role="dialog" aria-labelledby="rating_modal">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <div class="logo" style="margin-bottom: 20px;">
                            <img src="images/logo-1000-2.png" alt="logo image" class="img-fluid">
                    </div>

                    <h4>Conditions générales d'utilisation</h4>
                    <p>Mises à jour le <span class="colorBlue">14 Octobre 2020</span></p>
                </div>
                <!-- end /.modal-header -->

                <div class="modal-body">
                    <section class="term_condition_area">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="cardify term_modules">
                                        <div class="term">
                                            <div class="term__title">
                                                <h4>1. Dispositions générales</h4>
                                            </div>
                                            <p style="text-align: justify;">
                                                1.1. Le site web 1000fcfa.com (ci-après dénommé – Site) vous fournit les services (ci-après – Services) pour un usage non commercial en conformité avec les présentes Conditions. L’utilisation commerciale du site (y compris la gestion des campagnes publicitaires) est régie par d’autres accords conclus directement avec les bénéficiaires de ces services.
                                            </p>

                                            <p style="text-align: justify;">
                                                1.2. Votre visite du Site, de même que l’utilisation de l’information qui y est affichée, signifie votre acceptation des présentes Conditions. Vous ne pouvez pas utiliser les Services si vous n’avez pas accepté les Conditions.
                                            </p>

                                            <p style="text-align: justify;">
                                                1.3. Vous ne pouvez pas utiliser les Services si cela est interdit par la législation du pays dans lequel vous résidez, ou à partir du territoire par l’entremise duquel vous accédez à l’utilisation des Services.
                                            </p>

                                            <p style="text-align: justify;">
                                                1.4. 1000fcfa.com peut modifier périodiquement les présentes Conditions sans aucun préavis. Si vous continuez à utiliser les Services après la modification des Conditions, cela est considéré comme votre acceptation de la nouvelle version des Conditions.
                                            </p>
                                        </div>
                                        <!-- end /.term -->

                                        <div class="term">
                                            <div class="term__title">
                                                <h4>2. Exclusion de garantie</h4>
                                            </div>
                                            <p style="text-align: justify;">Vous comprenez et acceptez que les informations sur le Site sont fournies « en l’état », sans garantie d’authenticité. Vous utilisez le Site à vos risques et périls. Le Site n’assume aucune responsabilité pour les conséquences de votre utilisation de l’information affichée sur le site.</p>
                                        </div>
                                    </div>
                                    <!-- end /.term_modules -->
                                </div>
                                <!-- end /.col-md-12 -->
                            </div>
                            <!-- end /.row -->
                        </div>
                        <!-- end /.container -->
                    </section>
                    <!-- end /.form -->
                </div>
                <!-- end /.modal-body -->
            </div>
        </div>
    </div>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/vendor/jquery/jquery-1.12.3.js"></script>
    <script src="js/vendor/jquery/popper.min.js"></script>
    <script src="js/vendor/jquery/uikit.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/sweetalert/sweetalert.min.js"></script>
    
    <script>
    
        $(document).ready(function() {
            $(document).on('submit','#form_inscription', function(event){
                event.preventDefault();
    
                if($('#mdp').val() != $('#mdp_bis').val())
                {
                    swal('Erreur', 'Les mots de passe ne correspondent pas', 'error');
    
                } else if($('input[name=conditions]').prop('checked') == false){
    
                    swal('Erreur', 'Vous devez accepter les conditions d\'utilisation', 'warning');
    
                } else{
    
                    var form_data = $(this).serialize();
                    $.ajax({
                        url:'scripts_php/script_inscription.php',
                        method:'POST',
                        data:form_data,
                        dataType:"json",
                        success:function(data) {
                            //swal.close();
                            //console.log(data);
                            //alert(data);
    
                            if(data === "Inscription faite") {
                                swal(
                                    'Inscription réussie', 'Connectez-vous à présent à votre compte.', 'success'
                                ).then(function() {
                                    window.location = "connexion.php";
                                });
                            }
    
                            if(data == "Email pris") {
                                swal('Erreur', 'Votre email est déjà pris par un autre utilisateur.', 'error');
                            }
                        }
                    });
    
                }
            });
    
    
    
    
        });
    
    </script>
        
</body>

</html>