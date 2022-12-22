<?php

//subcategorie_action.php

include('../db.php');
include('../scripts_php/fonctions_sql.php');
include('../scripts_php/fonctions.php');


if(isset($_POST['btn_action']))
{
    // AJOUTER
    if($_POST['btn_action'] == 'AJOUTER')
    {

        // Vérifier si l'subcategorie existe déjà dans la base
        $travaux = get("*", "travaux", [
            ["label", $_POST["label"]]
        ]);

        $count = !is_null($travaux) ? count($travaux) : 0;
        if($count > 0)
        {
            echo json_encode('travail existant');
        }else
        {

            $photo = saveImage($_FILES["photo"], "travail", "travail")["url"];

            $res = insert("travaux", [
                "label" => $_POST["label"],
                "subcategorie_id" => $_POST["subcategorie"],
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

        $res1 = update("travaux", [
            "status" => $status,

        ], [
            ["id", $_POST["id_travail"]]
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

        $res1 = update("travaux", [
            "status" => $status,
            "deleted_at" => date("Y-m-d H:i")

        ], [
            ["id", $_POST["id_travail"]]
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

        $travail = verify_work($_POST["id_travail_view"]);

        $result = !is_null($travail) ? array($travail) : array();

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
                <td> Label </td>
                <td>' . $row["label"] . '</td>
			</tr>
			<tr>
                <td> Categorie </td>
                <td>' . verify_subcategory($row["subcategorie_id"])["label"] . '</td>
			</tr>
			<tr>
                <td> Statut </td>
				<td>' . $status . '</td>
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

        $travail = verify_work($_POST["id_travail_modif"]);
        
        if(!is_null($travail)) {
            $travail["subcategorie"] = verify_subcategory($travail["subcategorie_id"])["label"];
        }

        $output = !is_null($travail) ? $travail : array();

        echo json_encode($output);

    }


    // Modifier
    if($_POST['btn_action_modif'] == 'Modifier')
    {
        // Vérifier si l'subcategorie existe déjà dans la base
        $query0 = "
    	SELECT * 
        FROM ( 
            SELECT * 
        	FROM travaux 
        	WHERE id <> :id  
        ) AS JP 
        WHERE label = :label
    	";
        $statement0 = $connect->prepare($query0);
        $statement0->execute(
            array(
                ':id'	    =>	$_POST["id_travail_modif"],
                ':label'	    =>	$_POST["label_modif"]
            )
        );
        $count = $statement0->rowCount();


        if($count > 0)
        {
            echo json_encode('travail existant');
        }else
        {

            $travail = verify_work($_POST["id_travail_modif"]);

            $res2 = update("travaux", [
                'label' =>$_POST["label_modif"],
                'subcategorie_id' =>$_POST["subcategorie_modif"],
                'updated_at' => date("Y-m-d H:i"),
            ], [
                ["id", $_POST["id_travail_modif"]]
            ]);

            if($res2) {
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