<?php

include('../db.php');
include("../functions.php");

if(connected()) {
    header("location: ../tb/tb.php");
    exit();
}

include('../scripts_php/fonctions_sql.php');


$user = get("*", "users", [
    ["email", $_POST["email"]],
    ["role_id", ">", 2]
]);


$message = '';
$count = !is_null($user) ? count($user) : 0;
if($count > 0)
{
    $result = $user;

    foreach($result as $row)
    {
        if($row['status'] == 'enable')
        {
            $mdp = $row['mdp'];
            if(password_verify($_POST["mdp"], $mdp))
            {

                $_SESSION['role'] = $row['role_id'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['code_postal'] = $row['code_postal'];

                $_SESSION['prenom'] = $row['prenom'];
                $_SESSION['nom'] = $row['nom'];
                $_SESSION['telephone'] = $row['telephone'];
                $_SESSION['photo'] = $row['photo'];
                $_SESSION['status'] = $row['status'];

                $message = "Paramètres corrects";
/*
                // Log
                switch ($_SESSION['role']) {

                    case 1:
                        addlog("Connex-01", "", $_SESSION["prenom"]." ".$_SESSION["nom"]);
                        break;
                    case 2:
                        addlog("Connex-02", "", $_SESSION["prenom"]." ".$_SESSION["nom"]);
                        break;
                    case 3:
                        addlog("Connex-03", "", $_SESSION["prenom"]." ".$_SESSION["nom"]);
                        break;
                    case 4:
                        addlog("Connex-04", "", $_SESSION["prenom"]." ".$_SESSION["nom"]);
                        break;
                    case 5:
                        addlog("Connex-05", "", $_SESSION["prenom"]." ".$_SESSION["nom"]);
                        break;
                }
*/

            }
            else
            {
                $message = "Mot de passe erroné";

                // Log
                //addlog("ErrConnex-01", $row["prenom_personne"]." ".$row["nom_personne"], "-");

            }
        }
    
        else
        {
            $message = "Compte désactivé";

            // Log
            //addlog("ErrConnex-03", $row["prenom_personne"]." ".$row["nom_personne"], "-");

        }
    }
}
else
{
    $message = "Email non valide";
}


echo json_encode($message);

?>