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

if(is_null($user)) {
    header("location: index.php");
}

$data = get("*", "biling_info", [
    ["user_id", $user["id"]]
]);

if(!is_null($data)) {
    $bill_info = $data[0];
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


    <title>Mainsrapides - Mes informations</title>

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
                    <h1 class="page-title">Mes informations</h1>
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
                                <h3>Mes informations</h3>
                            </div>
                        </div>
                    </div>
                    <!-- end /.col-md-12 -->
                </div>
                <!-- end /.row -->

                <form id="update_form" class="setting_form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="information_module">
                                <a class="toggle_title" href="#collapse2" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Information personnelle
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set toggle_module collapse show" id="collapse2">
                                    <div class="information_wrapper form--fields">
                                        <div class="form-group">
                                            <label for="prenom">Prénoms
                                                <sup>*</sup>
                                            </label>
                                            <input type="text" id="prenom" name="prenom" class="text_field" placeholder="First Name" value="<?= $user["prenom"] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="nom">Nom
                                                <sup>*</sup>
                                            </label>
                                            <input type="text" id="nom" name="nom" class="text_field" placeholder="Last Name" value="<?= $user["nom"] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="email">Email
                                                <sup>*</sup>
                                            </label>
                                            <input type="email" id="email" name="email" class="text_field" placeholder="Email address" value="<?= $user["email"] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="telephone">Telephone</label>
                                            <input type="tel" id="telephone" name="telephone" class="text_field" placeholder="Telephone Number" value="<?= $user["telephone"] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="code_postal">Code postal 
                                                <sup>*</sup>
                                            </label>
                                            <input type="text" id="code_postal" name="code_postal" class="text_field" placeholder="Code postal" value="<?= $user["code_postal"] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="adresse">Adresse</label>
                                            <input type="text" id="adresse" name="adresse" class="text_field" placeholder="Adresse" value="<?= $user["adresse"] ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="place">Ville</label>
                                            <div class="select-wrap select-wrap2">
                                                <select name="place" id="place" class="text_field">
                                                    <?php if(!is_null($user["ville"])): ?>
                                                    <option value="<?= $user["ville"] ?>"><?= $user["ville"] ?></option>
                                                    <?php endif; ?>
                                                    <option value="">Choisir une ville</option>
                                                    <?= fill_adresses_list($connect) ?>
                                                </select>
                                                <span class="lnr lnr-chevron-down"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="sexe">Sexe</label>
                                            <div class="select-wrap select-wrap2">
                                                <select name="sexe" id="sexe" class="text_field">
                                                    <?php if(!is_null($user["sexe"])): ?>
                                                    <option value="<?= $user["sexe"] ?>"><?= $user["sexe"] ?></option>
                                                    <?php endif; ?>
                                                    <option value="">Votre sexe</option>
                                                    <option value="Masculin">Masculin</option>
                                                    <option value="Feminin">Feminin</option>
                                                </select>
                                                <span class="lnr lnr-chevron-down"></span>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="bio">A propos</label>
                                            <textarea name="bio" id="bio" class="text_field" placeholder="Une description de vous"><?= $user["bio"] ?></textarea>
                                        </div>
                                    </div>
                                    <!-- end /.information_wrapper -->
                                </div>
                                <!-- end /.information__set -->
                            </div>
                            <!-- end /.information_module -->

                        </div>
                        <!-- end /.col-md-6 -->

                        <div class="col-lg-6">
                            <div class="information_module">
                                <a class="toggle_title" href="#collapse3" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Profil Image
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set toggle_module collapse" id="collapse3">
                                    <div class="information_wrapper">
                                        <div class="profile_images">
                                            <div class="profile_image_area">
                                                <?php if(is_null($user["photo"])): ?>
                                                    <img src="images/authplc.png" alt="Author profile area">
                                                <?php else: ?>
                                                    <img src=".<?= $user["photo"] ?>" alt="Presenting the author avatar :D">
                                                <?php endif; ?>
                                                
                                                <div class="img_info">
                                                    <p class="bold">Profil Image</p>
                                                    <p class="subtitle">JPG, GIF ou PNG</p>
                                                </div>
    
                                            </div>
                                        </div>
                                        <div class="form-group mt-5">
                                            <div class="col-12">
                                                <input type="file" name="photo" id="photo" class="dropify-fr" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="information_module">
                                <a class="toggle_title" href="#collapse4" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Email Settings
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set mail_setting toggle_module collapse" id="collapse4">
                                    <div class="information_wrapper">
                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="news" class="" name="news" checked="<?= $user["news"] ? "checked" : "" ?>">
                                            <label for="news">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Newsletter</span>
                                                <span class="desc">Je souhaite recevoir la newsletter</span>
                                            </label>
                                        </div>
                                        <!-- end /.custom-radio -->

                                        <div class="custom_checkbox">
                                            <input type="checkbox" id="plans" class="" name="plans" checked="<?= $user["plans"] ? "checked" : "" ?>">
                                            <label for="plans">
                                                <span class="shadow_checkbox"></span>
                                                <span class="radio_title">Bon plans</span>
                                                <span class="desc">Je souhaite recevoir les bons plans des partenaires mainsrapides</span>
                                            </label>
                                        </div>
                                        <!-- end /.custom_checkbox -->

                                        <h3 class="mt-3 mt-4">Les alertes jobs</h3>
                                        <p>Je souhaite recevoir : </p>

                                        <div class="custom_radio">
                                            <input type="radio" id="opt1" class="" name="alertes" value="chaque" checked="<?= $user["alertes"] === "chaque" ? "checked" : "" ?>">
                                            <label for="opt1">
                                                <span class="circle"></span>A chaque annonce intéressante
                                            </label>
                                        </div>
                                        <!-- end /.custom_radio -->

                                        <div class="custom_radio">
                                            <input type="radio" id="opt2" class="" name="alertes" value="jour" checked="<?= $user["alertes"] === "jour" ? "checked" : "" ?>">
                                            <label for="opt2">
                                                <span class="circle"></span>Un récapitulatif une fois par jour
                                            </label>
                                        </div>
                                        <!-- end /.custom_radio -->

                                        <div class="custom_radio">
                                            <input type="radio" id="opt3" class="" name="alertes" value="jamais" checked="<?= $user["alertes"] === "jamais" ? "checked" : "" ?>">
                                            <label for="opt3">
                                                <span class="circle"></span>Jamais
                                            </label>
                                        </div>
                                        <!-- end /.custom_radio -->

                                    </div>
                                    <!-- end /.information_wrapper -->
                                </div>
                                <!-- end /.information_module -->
                            </div>

                            <div class="information_module">
                                <a class="toggle_title" href="#collapse1" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                    <h4>Biling Information
                                        <span class="lnr lnr-chevron-down"></span>
                                    </h4>
                                </a>

                                <div class="information__set toggle_module collapse" id="collapse1">
                                    <div class="information_wrapper form--fields">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name">Prénom
                                                        <sup>*</sup>
                                                    </label>
                                                    <input type="text" id="first_name" name="first_name" class="text_field" placeholder="First Name" value="<?= isset($bill_info) ? $bill_info["first_name"]: '' ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name">Nom
                                                        <sup>*</sup>
                                                    </label>
                                                    <input type="text" id="last_name" name="last_name" class="text_field" placeholder="last name" value="<?= isset($bill_info) ? $bill_info["last_name"]: '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end /.row -->

                                        <div class="form-group">
                                            <label for="entreprise_name">Nom de l'entreprise
                                                <sup>*</sup>
                                            </label>
                                            <input type="text" id="entreprise_name" name="entreprise_name" class="text_field" placeholder="AazzTech" value="<?= isset($bill_info) ? $bill_info["entreprise_name"]: '' ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="email_bill">Adresse Email
                                                <sup>*</sup>
                                            </label>
                                            <input type="email" id="email_bill" name="email_bill" class="text_field" placeholder="Email address" value="<?= isset($bill_info) ? $bill_info["email_bill"]: '' ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="city">Ville
                                                <sup>*</sup>
                                            </label>
                                            <div class="select-wrap select-wrap2">
                                                <select name="city" id="city" class="text_field">
                                                    <?php if(isset($bill_info) && !empty($bill_info["city"])): ?>
                                                    <option value="<?= $bill_info["city"] ?>"><?= $bill_info["city"] ?></option>
                                                    <?php endif; ?>
                                                    <?= fill_adresses_list($connect) ?>
                                                </select>
                                                <span class="lnr lnr-chevron-down"></span>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label for="adress1">Adresse Line 1</label>
                                            <input type="text" id="adress1" name="adress1" class="text_field" placeholder="Address line one" value="<?= isset($bill_info) ? $bill_info["adress1"]: '' ?>">
                                        </div>

                                        <div class="form-group">
                                            <label for="adress2">Adresse Line 2</label>
                                            <input type="text" id="adress2" name="adress2" class="text_field" placeholder="Address line two" value="<?= isset($bill_info) ? $bill_info["adress2"]: '' ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="country">Pays
                                                        <sup>*</sup>
                                                    </label>
                                                    <div class="select-wrap select-wrap2">
                                                        <select name="country" id="country" class="text_field">
                                                            <?php if(isset($bill_info) && !empty($bill_info["country"])): ?>
                                                            <option value="<?= $bill_info["country"] ?>"><?= $bill_info["country"] ?></option>
                                                            <?php endif; ?>
                                                            <option value="">Select one</option>
                                                            <option value="Benin">Benin</option>
                                                            <option value="sydney">Sydney</option>
                                                            <option value="newyork">New York</option>
                                                            <option value="london">London</option>
                                                            <option value="mexico">New Mexico</option>
                                                        </select>
                                                        <span class="lnr lnr-chevron-down"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="zipcode">Postal Code
                                                        <sup>*</sup>
                                                    </label>
                                                    <input type="text" id="zipcode" name="zipcode" class="text_field" placeholder="Postal code" value="<?= isset($bill_info) ? $bill_info["code_postal"]: '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end /.information__set -->
                            </div>
                            <!-- end /.information_module -->
                        </div>
                        <!-- end /.col-md-6 -->

                        <div class="col-md-12">
                            <input type="hidden" name="btn_action" value="update" />
                            <div class="dashboard_setting_btn">
                                <button type="submit" class="btn btn--round btn--md">Enregistrer les changements</button>
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
            $(document).on('submit','#update_form', function(event){
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
                                "Vos données ont été mises à jour.",
                                'success'
                            ).then(() => {
                                window.location = "profile.php";
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