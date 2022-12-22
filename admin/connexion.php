<?php
//connexion.php


include('db.php');
include("functions.php");


if(connected())
{
    header("location:tb/tb.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Connexion</title>
    <!-- Bootstrap Core CSS -->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="assets/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    
    <?php include('parts/loader.php'); ?>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="login-register login-sidebar"  style="background-image:url(assets/images/background/login-register.jpg);">
  <div class="login-box card">
    <div class="card-body">
      <form class="form-horizontal form-material" id="form_login">
        <a href="javascript:void(0)" class="text-center db"><img src="./assets/img/logo.jpeg" alt="Home" width="150" /></a>  
        
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input class="form-control" type="email" name="email" id="email" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input class="form-control" type="password" name="mdp" id="mdp" required="" placeholder="Mot de passe">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Connexion</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="assets/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="assets/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="assets/js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--Custom JavaScript -->
    <script src="assets/js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="assets/plugins/styleswitcher/jQuery.style.switcher.js"></script>
    <script src="assets/modules/sweetalert/sweetalert.min.js"></script>


</body>

</body>



<script>
    $(document).ready(function() {

        $(document).on('submit','#form_login', function(event){
            event.preventDefault();

            var form_data = $(this).serialize();
            
            $.ajax({
                url:'scripts_php/script_connexion.php',
                method:'POST',
                data:form_data,
                dataType: 'json',
                success: function(data) {
                    if(data == "Paramètres corrects") {
                        window.location="tb/tb.php";
                    }

                    if(data == "Email non valide") {
                        swal('Erreur Connexion', data, 'error');
                    }

                    if(data == "Mot de passe erroné") {
                        swal('Erreur Connexion', data, 'error');
                    }

                    if(data == "Compte désactivé") {
                        swal('Erreur Connexion', 'Compte inactif', 'error');
                    }
                }
            });


        });

    });

</script>

</body>
</html>
