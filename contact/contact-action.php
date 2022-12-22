<?php

include('../AddLogInclude.php');

include('../database_connection.php');
include("../scripts_php/fonctions_sql.php");
include("../scripts_php/fonctions.php");
include("../mail/init.php");


if(isset($_POST["prenom"], $_POST["nom"], $_POST["email"], $_POST["email"], $_POST["message"])) {
    $message = '
    <h2>Message de : <span style="color: blue; font-weight: bold;">' . $_POST["prenom"] . ' ' . $_POST["nom"] . '</span></h2>
    <small>' . $_POST["email"] . '</small> <br />
    `` ' . $_POST["message"] . '  ``
    ';

    $res = send_mail("contact@mainsrapides.com", $_POST["email"], "[MainsRapides] Contact", $message);

    if($res) {
        echo json_encode("success");
    } else {
        echo json_encode("Echec d'envoi de mail");
    }

} else {
    echo json_encode("Vous n'avez pas rempli tous les champs");
}


?>