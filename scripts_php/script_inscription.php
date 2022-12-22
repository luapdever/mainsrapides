<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 14/10/2020
 * Time: 14:32
 */

include('../database_connection.php');
include('../AddLogInclude.php');

include('../scripts_php/fonctions_sql.php');

// Vérifier si l'user existe déjà dans la base

// Check de l'email

$data1 = get("*", "users", [
    ["email", $_POST["email"]]
]);

$count0 = !is_null($data1) ? count($data1) : 0;


if($count0 > 0) {
    echo json_encode('Email pris');
} else{

    $mdp_hash = password_hash($_POST["mdp"], PASSWORD_BCRYPT);

    /* Profil acheteur, vendeur */
    $role = 0;
    switch ($_POST['profil']) {

        case 'client':
            $role = 1;
            break;

        case 'jobber':
            $role = 2;
            break;
    }


    /*
    $_SESSION['role'] = $role;
    $_SESSION['pseudo'] = $_POST["pseudo"];
    $_SESSION['nom'] = $_POST["nom"];
    $_SESSION['prenom'] = $_POST["prenom"];
    $_SESSION['email'] = $_POST["email"];
    */

    insert("users", [
        'email' => $_POST["email"],
        'nom' => $_POST["nom"],
        'prenom' => $_POST["prenom"],
        'code_postal' => $_POST['code_postal'],
        'mdp' => $mdp_hash,
        'status' => 'enable',
        'role_id' => $role
    ]);

    echo json_encode('Inscription faite');


    switch ($role) {

        case 1:
            addlog("Enr-20", "Enregistrement d\'une nouvelle classe : " . $_POST['nom'], $_POST["prenom"] . " " . $_POST["nom"] . " - Client");
            break;
        case 2:
            addlog("Enr-20", "Enregistrement d\'une nouvelle classe : " . $_POST['nom'], $_POST["prenom"] . " " . $_POST["nom"] . " - Jobber");
            break;
        case 3:
            addlog("Enr-20", "Enregistrement d\'une nouvelle classe : " . $_POST['nom'], $_POST["prenom"] . " " . $_POST["nom"] . " - Editeur");
            break;
        case 4:
            addlog("Enr-20", "Enregistrement d\'une nouvelle classe : " . $_POST['nom'], $_POST["prenom"] . " " . $_POST["nom"] . " - Administrateur");
            break;
    }
    

}
