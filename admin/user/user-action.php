<?php

//user_action.php

include('../db.php');
include('../scripts_php/fonctions_sql.php');
include('../scripts_php/fonctions.php');


if(isset($_POST['btn_action']))
{
    // AJOUTER
    if($_POST['btn_action'] == 'AJOUTER')
    {

        // Vérifier si l'user existe déjà dans la base
        $users = get("*", "users", [
            ["email", $_POST["email"]]
        ]);

        $count = !is_null($users) ? count($users) : 0;
        if($count > 0)
        {
            echo json_encode('user existant');
        }else
        {

            if($_POST['mdp'] != $_POST['mdp_conf']) {
                echo json_encode('Mots de passes differents');
                exit();
            }

            $photo = saveImage($_FILES["photo"], "user", "user")["url"];

            $mdp = password_hash($_POST['mdp'], PASSWORD_BCRYPT);

            $res = insert("users", [
                "email" => $_POST["email"],
                "prenom" => $_POST["prenom"],
                "nom" => $_POST["nom"],
                "role_id" => $_POST["role"],
                "code_postal" => $_POST["code_postal"],
                "telephone" => $_POST["telephone"],
                "mdp" => $mdp,
                "photo" => $photo
            ]);

            if($res) {
                echo json_encode('success');
            } else {
                echo json_encode("failed");
            }


           /* // Log
            switch ($_SESSION['type_compte']) {
                case 1:
                    addlog("Enr-01-boisson", $_POST["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                    break;
                case 2:
                    addlog("Enr-02-boisson", $_POST["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                    break;
                case 3:
                    addlog("Enr-03-boisson", $_POST["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                    break;
                case 4:
                    addlog("Enr-04-boisson", $_POST["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                    break;
            } */

        }

    }

    // changer_statut 
    if($_POST['btn_action'] == 'changer_statut')
    {

        $status = 'enable';
        if($_POST['status'] == 'enable')
        {
            $status = 'disable';
        }

        $res1 = update("users", [
            "status" => $status,

        ], [
            ["id", $_POST["id_user"]]
        ]);

        if($res1) {
            echo json_encode($status);
        } else {
            echo json_encode("failed");
        }


    
    /*
        switch ($_SESSION['type_compte']) {

            case 1:
                addlog("Chg-01-boisson", $lib_boisson. "," .$status, $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
            case 2:
                addlog("Chg-02-boisson", $lib_boisson. "," .$status, $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
        }*/



    }

    //delete
    if($_POST['btn_action'] == 'delete')
    {

        $status = 'deleted';

        $res1 = update("users", [
            "status" => $status,
            "deleted_at" => date("Y-m-d H:i")

        ], [
            ["id", $_POST["id_user"]]
        ]);

        if($res1) {
            echo json_encode("success");
        } else {
            echo json_encode("failed");
        }


    
    /*
        switch ($_SESSION['type_compte']) {

            case 1:
                addlog("Chg-01-boisson", $lib_boisson. "," .$status, $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
            case 2:
                addlog("Chg-02-boisson", $lib_boisson. "," .$status, $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
        }*/



    }
}


// Consulter

if(isset($_POST['btn_action_view'])) {

    if ($_POST['btn_action_view'] == 'consulter') {

        $user = get_user($_POST["id_user_view"]);

        $result = !is_null($user) ? array($user) : array();

        $output = '
		<div class="table-responsive">
			<table class="table table-boredered">
		';



        foreach ($result as $row) {
            // echo json_encode($row);
            $status = '';
            if ($row['status'] == 'enable') {
                $status = '<span class="badge badge-success"> Actif </span>';
            } else {
                $status = '<span class="badge badge-danger"> Inactif </span>';
            }


            $output .= '
            <tr>
                <td> Image </td>
                <td><img class="img-fluid" src="' . $GLOBALS["app_url"] . $row['photo'] .  '" alt="Image" /></td>
            </tr>
			<tr>
                <td> Email </td>
                <td>' . $row["email"] . '</td>
			</tr>
			<tr>
                <td> Prenoms </td>
				<td>' . $row["prenom"] . '</td>
			</tr>
			<tr>
                <td> Nom </td>
				<td>' . $row["nom"] . '</td>
			</tr>
			<tr>
                <td> Type de compte </td>
				<td><strong class="badge badge-primary">' . get_role($row["role_id"])["label"] . '</strong></td>
			</tr>
            <tr>
                <td> Code postal </td>
				<td>' . $row["code_postal"] . '</td>
			</tr>
            <tr>
                <td> Telephone </td>
				<td>' . (!is_null($row["telephone"]) ? $row["telephone"] : 'Pas de téléphone') . '</td>
			</tr>
			<tr>
                <td> Statut </td>
				<td>' . $status . '</td>
			</tr>
            <tr>
                <td> Bio </td>
				<td>' . $row['bio'] . '</td>
			</tr>
            <tr>
                <td>Date de creation</td>
                <td>' . date("d-m-Y H:i", strtotime($row['created_at'])) .'</td>
            </tr>
			';

        }

        $output .= '
			</table>
		</div>
		';
        echo json_encode($output);


/*
        switch ($_SESSION['type_compte']) {

            case 1:
                addlog("Info-01-boisson", $row["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
            case 2:
                addlog("Info-02-boisson", $row["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
            case 3:
                addlog("Info-03-boisson", $row["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
            case 4:
                addlog("Info-04-boisson", $row["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
            case 5:
                addlog("Info-05-boisson", $row["lib_boisson"], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                break;
        }

*/


    }

}


if(isset($_POST['btn_action_modif']))
{

    // fetch single
    if($_POST['btn_action_modif'] == 'fetch_single')
    {

        $user = get_user($_POST["id_user_modif"]);
        
        if(!is_null($user)) {
            $user["role"] = get_role($user["role_id"])["label"];
        }
        
        $output = !is_null($user) ? $user : array();

        echo json_encode($output);

    }


    // Modifier
    if($_POST['btn_action_modif'] == 'Modifier')
    {
        // Vérifier si l'user existe déjà dans la base
        $query0 = "
    	SELECT * 
        FROM ( 
            SELECT * 
        	FROM users 
        	WHERE id <> :id  
        ) AS JP 
        WHERE email = :email
    	";
        $statement0 = $connect->prepare($query0);
        $statement0->execute(
            array(
                ':id'	    =>	$_POST["id_user_modif"],
                ':email'	    =>	$_POST["email_modif"]
            )
        );
        $count = $statement0->rowCount();


        if($count > 0)
        {
            echo json_encode('user existant');
        }else
        {

            if(!empty($_POST['mdp']) && password_verify($_POST['mdp'], $_SESSION['mdp'])) {
                if($_POST['mdp_modif'] != $_POST['mdp_conf_modif']) {
                    echo json_encode('Mots de passes differents');
                    exit();
                }
            }
            elseif (!empty($_POST['mdp']) && !password_verify($_POST['mdp'], $_SESSION['mdp'])) {
                echo json_encode('Mot de passe incorrect');
                exit();
            }

            $user = get_user($_POST["id_user_modif"]);
            $role = !is_null($_POST["role_modif"]) ? $_POST["role_modif"] : $user["role_id"];
            $mdp_modif = isset($_POST['mdp_modif']) ? password_hash($_POST['mdp_modif'], PASSWORD_BCRYPT) : $user['mdp'];

            $res2 = update("users", [
                'email' =>$_POST["email_modif"],
                'prenom' =>$_POST["prenom_modif"],
                'nom' =>$_POST["nom_modif"],
                'role_id' => $role,
                'code_postal' =>$_POST["code_postal_modif"],
                'telephone' =>$_POST["telephone_modif"],
                'mdp' => $mdp_modif,
                'updated_at' => date("Y-m-d H:i"),
            ], [
                ["id", $_POST["id_user_modif"]]
            ]);

            if($res2) {
                if($_SESSION['id'] == $_POST['id_user_modif']) {
                    $_SESSION['role'] = $_POST['role_modif'];
                    $_SESSION['email'] = $_POST['email_modif'];
                    $_SESSION['code_postal'] = $_POST['code_postal_modif'];
    
                    $_SESSION['nom'] = $_POST['nom_modif'];
                    $_SESSION['prenom'] = $_POST['prenom_modif'];
                    $_SESSION['telephone'] = $_POST['telephone_modif'];
                }

                echo json_encode('Modifié');
            } else {
                echo json_encode("failed");
            }

/*
            // Log
            switch ($_SESSION['type_compte']) {

                case 1:
                    addlog("Modif-01-boisson", $_POST['lib_boisson'], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                    break;
                case 2:
                    addlog("Modif-02-boisson", $_POST['lib_boisson'], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                    break;
                case 3:
                    addlog("Modif-03-boisson", $_POST['lib_boisson'], $_SESSION["prenom_personne"]." ".$_SESSION["nom_personne"]);
                    break;
            }
*/

        }
   } 
} 




?>