<?php
//logout.php
include('AddLogInclude.php');

session_start();

// Log
switch ($_SESSION['role']) {

	case 1:
		addlog("Log-02", "Déconnexion réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Client");
		break;
	case 2:
		addlog("Log-02", "Déconnexion réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Jobber");
		break;
	case 3:
		addlog("Log-02", "Déconnexion réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Editeur");
		break;
	case 4:
		addlog("Log-02", "Déconnexion réussie", $_SESSION["prenom"]." ".$_SESSION["nom"]." - Aministrateur");
		break;
}

session_destroy();

header("location: index.php");

?>