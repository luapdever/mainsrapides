<?php

include("../db.php");
include("../functions.php");
include("../scripts_php/fonctions_sql.php");

if(!connected()) {
    header("location: ../connexion.php");
    exit();
} else {
    $role = get_role($_SESSION["role"]);
    header("location: tb-" . $role["label"] . ".php");
}

?>
