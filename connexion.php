<?php

include('database_connection.php');

include('AddLogInclude.php');
include('scripts_php/fonctions_sql.php');

if(isset($_SESSION['role']))
{
	header("location: tableau-de-bord.php");
}

$message = '';

if(isset($_POST["login"]))
{
    $data = get("*", "users", [
        ["email", $_POST["email"]]
    ]);
	
	$count = !is_null($data) ? count($data) : 0;
	if($count > 0)
	{
		$result = $data;
		foreach($result as $row)
		{
			if($row['status'] == 'enable')
			{
				if(password_verify($_POST["mdp"], $row["mdp"]))
				{
				
					$_SESSION['email'] = $row['email'];
					$_SESSION['role'] = $row['role_id'];
					$_SESSION['id'] = $row['id'];
					$_SESSION['nom'] = $row['nom'];
					$_SESSION['prenom'] = $row['prenom'];
					$_SESSION['telephone'] = $row['telephone'];
					$_SESSION['photo'] = $row['photo'];
					header("location: tableau-de-bord.php");
					
					// Log
                	switch ($_SESSION['role']) {
                	
                		case 1:
                			addlog("Log-01", "Connexion à l’application réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Client");
                			break;
                		case 2:
                			addlog("Log-01", "Connexion à l’application réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Jobber");
                			break;
                		case 3:
                			addlog("Log-01", "Connexion à l’application réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Editeur");
                			break;
                		case 4:
                			addlog("Log-01", "Connexion à l’application réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Administrateur");
                			break;
                	}
				
				    
				}
				else
				{
					$message = "Mot de passe erroné";
					
					// Log
            		addlog("Err-01", "Saisie de mot de passe erroné lors de la connexion au compte de : ".$row["prenom"]." ".$row["nom"], "-");
	
				}
			}
			else
			{
				$message = "Votre compte a été désactivé. Contactez l'administrateur";
				
				// Log
        		addlog("Err-03", "Tentative de connexion au compte désactivé de  : ".$row["prenom"]." ".$row["nom"], "-");
	
			}
		}
	}
	else
	{
		
		$message = "Email non valide";
		
		// Log
		addlog("Err-02", "Saisie d’email ou Pseudo invalide lors de la connexion", "-");
	
	}
}




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


    <title>Mainsrapides - Connexion</title>

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

<body class="preload login-page">
    <!--================================
            START LOGIN AREA
    =================================-->
    <section class="login_area section--padding2">
        <div class="container">
            <div class="text-center mb-5">
                <img src="./assets/img/logo.jpeg" alt="" class="img-responsive" width="300" />
            </div>

            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <form method="POST">
                        <div class="cardify login">
                            <div class="login--header">
                                <h3>Bonjour ! Heureux de vous revoir</h3>
                                <p>Veuillez renseigner votre email et mot de passe ci-dessous</p>
                                <center>
                                    <div style="color: red; font-size: 15px !important; font-weight:bold; margin-top: 30px !important;">
                                        <?php echo $message; ?>
                                    </div>
                                </center>
                            </div>


                            <div class="login--form">
                                <div class="form-group">
                                    <label for="email">Email ou Pseudonyme ou Téléphone</label>
                                    <input id="email" name="email" type="email" class="text_field" placeholder="Saisissez votre email..." required>
                                </div>

                                <div class="form-group">
                                    <label for="mdp">Mot de passe</label>
                                    <input id="mdp" name="mdp" type="password" autocomplete="new-password" class="text_field" placeholder="Saisissez votre mot de passe..." required>
                                </div>

                                <div class="form-group">
                                    <div class="custom_checkbox">
                                        <input type="checkbox" name="rememberme" value="1" id="ch2">
                                        <label for="ch2">
                                            <span class="shadow_checkbox"></span>
                                            <span class="label_text">Se souvenir de moi</span>
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" name="login" class="btn btn--md btn--round" id="login" name="login">Connexion</button>

                                <div class="login_assist">
                                    <p class="recover">
                                        <a href="mot-de-passe-perdu.php">Mot de passe oublié ?</a>
                                    <p class="signup">Pas de compte ?
                                        <a href="inscription.php">Inscrivez-vous</a></p>
                                </div>
                            </div>

                        </div>

                    </form>




                    <!--<button class="btn btn--md btn--round login2" id="login2" name="login2">Connexion</button>-->

                    <!--
                    <p>Click the button to display an alert box.</p>
                    <button class="btn btn--md btn--round login2" id="loginx" name="loginx">Connexion</button><br><br>
                    -->


                </div>
                <!-- end .col-md-6 -->
            </div>
            <!-- end .row -->
        </div>
        <!-- end .container -->
    </section>
    <!--================================
            END LOGIN AREA
    =================================-->

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
    <!-- inject:js -->
    <script src="js/vendor/jquery/jquery-1.12.3.js"></script>
    <script src="js/vendor/jquery/popper.min.js"></script>
    <script src="js/vendor/jquery/uikit.min.js"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <!-- endinject -->
</body>

</html>


