<?php

//culture_action.php

include('../db.php');
include('../scripts_php/fonctions_sql.php');
include('../scripts_php/functions_sql_load.php');


if(isset($_POST['btn_action']))
{
    // AJOUTER
    if($_POST['btn_action'] == 'AJOUTER')
    {

        // Vérifier si la boisson existe déjà dans la base
        $query0 = "
    	SELECT * FROM culture 
		WHERE nom = :nom 
    	";
        $statement0 = $connect->prepare($query0);
        $statement0->execute(
            array(
                ':nom'	=>	$_POST["nom"]
            )
        );
        $count = $statement0->rowCount();
        if($count > 0)
        {
            echo json_encode('Culture existante');
        }else
        {

            $correctExt = array('jpg' , 'jpeg' , 'png', 'JPG', 'JPEG', 'PNG');
            $maxsize = 8*1048576;
            $nameImage = '/assets/img/uploads/culture/' .  $_POST['nom'] . md5(uniqid(rand(), true)) . '.';

            if(isset($_FILES['photo'])) {
                if($_FILES['photo']['error'] != UPLOAD_ERR_NO_FILE) {
                    
                    $info_file = pathinfo($_FILES['photo']['name']);

                    if(in_array($info_file['extension'], $correctExt) && $maxsize>=$_FILES['photo']['size']) {

                        $nameImage = $nameImage . $info_file['extension'];
                        $answer = move_uploaded_file($_FILES['photo']['tmp_name'], ".." . $nameImage);

                        if($answer) {


                            $query_insert0 = "
                                INSERT INTO culture(nom, quantite_semence, date_debut, date_fin, id_espece, id_terrain, notes, photo, date_create, created_by)
                                VALUES(:nom, :quantite_semence, :date_debut, :date_fin, :id_espece, :id_terrain, :notes, :photo, :date_create, :auteur)
                            ";
                            $statement0 = $connect->prepare($query_insert0);
                            $statement0->execute(
                                array(
                                    ':nom'	=>	$_POST["nom"],
                                    ':quantite_semence' => $_POST['quantite_semence'],
                                    ':date_debut' => $_POST['date_debut'],
                                    ':date_fin' => $_POST['date_fin'],
                                    ':id_espece' => $_POST['id_espece'],
                                    ':id_terrain' => $_POST['id_terrain'],
                                    ':notes' => $_POST['notes'],
                                    ':photo' => $nameImage,
                                    ':date_create' => date("Y-m-d"),
                                    ':auteur' => $_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']
                                )
                            );
                            
                            echo json_encode('Success');


                        } else {
                            echo json_encode("Erreur enregistrement image");
                        }
                    } else {

                        echo json_encode("Extension non valide ou image trop volumineuse");
                    }
                } else {
                    echo json_encode("Erreur Telechargement");
                }
            } else {
                echo json_encode("Image non soumise");
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

        $status = 'Actif';
        if($_POST['status'] == 'Actif')
        {
            $status = 'Inactif';
        }

        update3('culture',
            'id_culture',$_POST["id_culture"],
            'statut',$status,
            'date_update', date("Y-m-d"),
            'updated_by', $_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']
        );

        echo json_encode($status);

        // Log
        // On a besoin du nom de la boisson
        $query00 = "
		SELECT nom 
		FROM culture 
		WHERE id_culture = '".$_POST["id_culture"]."'
		";
        $statement00 = $connect->prepare($query00);
        $statement00->execute();
        $result00 = $statement00->fetchAll();

        $nom = "";

        foreach($result00 as $row00)
        {
            $nom = $row00["nom"];
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

        $status = 'Actif';
        if($_POST['status'] == 'Actif')
        {
            $status = 'Inactif';
        }

        update4('culture',
            'id_culture',$_POST["id_culture"],
            'statut',$status,
            'date_del', date("Y-m-d"),
            'deleted', 1,
            'deleted_by', $_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']
        );

        echo json_encode("Supprime");

        // Log
        // On a besoin du nom de la boisson
        $query00 = "
		SELECT nom 
		FROM culture 
		WHERE id_culture = '".$_POST["id_culture"]."'
		";
        $statement00 = $connect->prepare($query00);
        $statement00->execute();
        $result00 = $statement00->fetchAll();

        $nom = "";

        foreach($result00 as $row00)
        {
            $nom = $row00["nom"];
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

        $query = "SELECT * FROM culture WHERE id_culture = :id_culture";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':id_culture' => $_POST["id_culture_view"]
            )
        );
        $result = $statement->fetchAll();

        $output = '
		<div class="table-responsive">
			<table class="table table-boredered">
		';



        foreach ($result as $row) {
            // echo json_encode($row);
            $status = '';
            if ($row['statut'] == 'Actif') {
                $status = '<span class="badge badge-success"> Actif </span>';
            } else {
                $status = '<span class="badge badge-danger"> Inactif </span>';
            }


            $output .= '
            <tr>
                <td> Image </td>
                <td><img class="img-fluid" src="..' . $row['photo'] .  '" alt="Image" /></td>
            </tr>
			<tr>
                <td> Nom </td>
                <td>' . $row["nom"] . '</td>
			</tr>
			<tr>
                <td> Espèce </td>
				<td>' . load_name_espece($connect, $row["id_espece"]) . '</td>
			</tr>
            <tr>
                <td> Terrain </td>
				<td>' . load_name_terrain($connect, $row["id_terrain"]) . '</td>
			</tr>
            <tr>
                <td> Quantité de semence </td>
				<td>' . $row["quantite_semence"] . '</td>
			</tr>
            <tr>
                <td> Date de début </td>
				<td>' . date("d-m-Y", strtotime($row["date_debut"])) . '</td>
			</tr>
            <tr>
                <td> Date de fin d\'élevage prévu </td>
				<td>' . date("d-m-Y", strtotime($row["date_fin"])) . '</td>
			</tr>
			<tr>
                <td> Statut </td>
				<td>' . $status . '</td>
			</tr>
            <tr>
                <td> Notes </td>
				<td>' . $row['notes'] . '</td>
			</tr>
            <tr>
                <td>Date de creation</td>
                <td>' . $row['date_create'] .'</td>
            </tr>
            <tr>
                <td>Créé par</td>
                <td>' . $row['created_by'] .'</td>
            </tr>
            <tr>
                <td>Date de dernière modification</td>
                <td>' . $row['date_update'] .'</td>
            </tr>
            <tr>
                <td>Modifié par</td>
                <td>' . $row['updated_by'] .'</td>
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

        $query = "SELECT * FROM culture WHERE id_culture = :id_culture";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
                ':id_culture'	=>	$_POST["id_culture_modif"]
            )
        );
        $result = $statement->fetchAll();

        $nom = '';
        $id_espece = '';
        $id_terrain = '';
        $quantite_semence = '';
        $date_debut = '';
        $date_fin = '';
        $photo= '';
        $notes = '';

        foreach($result as $row)
        {
            $nom = $row['nom'];
            $id_espece = $row['id_espece'];
            $id_terrain = $row['id_terrain'];
            $quantite_semence = $row['quantite_semence'];
            $date_debut = $row['date_debut'];
            $date_fin = $row['date_fin'];
            $photo = $row['photo'];
            $notes = $row['notes'];
        }

        $output = array(
            'nom' => $nom,
            'id_espece' => $id_espece,
            'id_terrain' => $id_terrain,
            'quantite_semence' => $quantite_semence,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin,
            'photo' => $photo,
            'notes' => $notes
        );

        echo json_encode($output);

    }


    // Modifier
    if($_POST['btn_action_modif'] == 'Modifier')
    {
        // Vérifier si l'culture existe déjà dans la base
        $query0 = "
    	SELECT * 
        FROM ( 
            SELECT * 
        	FROM culture 
        	WHERE id_culture <> :id_culture  
        ) AS JP 
        WHERE nom = :nom
    	";
        $statement0 = $connect->prepare($query0);
        $statement0->execute(
            array(
                ':id_culture'	    =>	$_POST["id_culture_modif"],
                ':nom'	    =>	$_POST["nom_modif"]
            )
        );
        $count = $statement0->rowCount();


        if($count > 0)
        {
            echo json_encode('Culture existante');
        }else
        {
            update9('culture',
                'id_culture', $_POST["id_culture_modif"],
                'nom',$_POST["nom_modif"],
                'id_espece',$_POST["id_espece_modif"],
                'id_terrain',$_POST["id_terrain_modif"],
                'quantite_semence',$_POST["quantite_semence_modif"],
                'date_debut',$_POST["date_debut_modif"],
                'date_fin',$_POST["date_fin_modif"],
                'notes',$_POST["notes_modif"],
                'date_update', date("Y-m-d"),
                'updated_by', $_SESSION['prenom_user'] . ' ' . $_SESSION['nom_user']
            );

            echo json_encode('Modifié');
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