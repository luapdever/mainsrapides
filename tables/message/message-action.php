<?php

//category_action.php

include('../../AddLogInclude.php');

include('../../database_connection.php');
include("../../scripts_php/fonctions_sql.php");

// echo json_encode(array(
// 	"post" => $_POST,
// 	"files" => $_FILES
// ));

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Enregistrer')
	{
		
    	if(!isset($_POST["message"]))
    	{
    		echo json_encode('Le message est vide.');
    	}else
    	{
			// if(isset($_FILES["attach"])) {
			// 	$attach = saveImage($_FILES["attach"], "message", "message")["url"];
			// }
  
			$rslt = insert("messages", [
				'message' => $_POST["message"],
				'to_user_id' => intval($_POST["to_user"]),
				'from_user_id' => intval($_SESSION["id"]),
			]);

    		if($rslt)
    		{
    			echo json_encode("success");
    		} else {
				echo json_encode("failed");
			}
    		
    	}
		
		
	}

	if($_POST['btn_action'] == 'message_details')
	{
   
		$query = "
		SELECT * 
		FROM message
		WHERE message.id_message = '".$_POST["id_message"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '
		<div class="table-responsive">
			<table class="table table-boredered">
		';
		
		$nom_message = "";
		
		foreach($result as $row)
		{
			$status = '';
			if($row['statut_message'] == 'Actif')
			{
				$status = '<span class="titre titre-success">Actif</span>';
			}
			else
			{
				$status = '<span class="titre titre-danger">Inactif</span>';
			}
			
			// Pour le journal d'événements
			$nom_message = $row["titre"];
			
			$output .= '
			<tr>
				<td>Intitulé de l\'message</td>
				<td>'.$row["titre"].'</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>'.$row["desc_message"].'</td>
			</tr>
			<tr>
				<td>Enregistrée par</td>
				<td></td>
			</tr>
			<tr>
				<td>Date d\'enregistrement</td>
				<td>'.date('d-m-Y H:i:s',strtotime($row["date_create_message"])).'</td>
			</tr>
			<tr>
				<td>Date de dernière modification</td>
				<td>'.date('d-m-Y H:i:s',strtotime($row["date_modif_message"])).'</td>
			</tr>
			<tr>
				<td>Statut</td>
				<td>'.$status.'</td>
			</tr>
			';
		}
		
		// Log
    	//switch ($_SESSION['type']) {
    	
    	// 	case 1:
    	// 		addlog("Con-13", "Consultation des détails de l\'message : ".$nom_message, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
    	// 		break;
    	// 	case 2:
    	// 		addlog("Con-13", "Consultation des détails de l\'message : ".$nom_message, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
    	// 		break;
    	// 	case 3:
    	// 		addlog("Con-13", "Consultation des détails de l\'message : ".$nom_message, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
    	// 		break;
    	// 	case 4:
    	// 		addlog("Con-13", "Consultation des détails de l\'message : ".$nom_message, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
    	// 		break;
    	// }
		
		
		
		$output .= '
			</table>
		</div>
		';
		echo $output;
	}	
		
	
	if($_POST['btn_action'] == 'fetch_single')
	{
		
		$query = "SELECT * FROM message WHERE id_message = :id_message";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id_message'	=>	$_POST["id_message"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['titre'] = $row['titre'];
			$output['desc_message'] = $row['desc_message'];
		}
		
		echo json_encode($output);
		
	}

	if($_POST['btn_action'] == 'Modifier')
	{
	    
	    //Mode demo
	    //echo 'La fonctionnalité (Modifier une catégorie) est désactivée en mode Demo.';
	    
	    
	    // Vérifier si la catégorie existe déjà dans la base
    	$query0 = "
        SELECT * 
        FROM ( 
            SELECT * 
        	FROM message
        	WHERE id_message <> :id_message  
        ) AS JP 
        WHERE titre = :titre 
    	";
    	$statement0 = $connect->prepare($query0);
    	$statement0->execute(
    		array(
    		        ':id_message'	        =>	$_POST["id_message"],
    				':titre'	        =>	$_POST["titre"]
    			)
    	);
    	$count = $statement0->rowCount();
    	if($count > 0)
    	{
    		echo 'Cette message existe déjà dans la liste.';
    	}else
    	{
  
    		$query = "
    		UPDATE message set titre = :titre, desc_message = :desc_message, date_modif_message = :date_modif  
    		WHERE id_message = :id_message
    		";
    		$statement = $connect->prepare($query);
    		$statement->execute(
    			array(
    				':titre'	=>	$_POST["titre"],
    				':desc_message'	=>	$_POST["desc_message"],
    				':id_message'		=>	$_POST["id_message"],
                    ':date_modif'      => date("Y-m-d H:i:s")
    			)
    		);
    		$result = $statement->fetchAll();
    		if(isset($result))
    		{
    			echo 'L\'message de la maintenance a bien été modifiée';
    		}
    		
    		
    		// Log
        	// switch ($_SESSION['type']) {
        	
        	// 	case 1:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
        	// 		break;
        	// 	case 2:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
        	// 		break;
        	// 	case 3:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
        	// 		break;
        	// 	case 4:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
        	// 		break;
        	// }
		    
    	}
	    
	}
	
	if($_POST['btn_action'] == 'delete')
	{
	    
	    //Mode demo
	    //echo 'La fonctionnalité (Changer le statut d\'une catégorie) est désactivée en mode Demo.';
	    
	    
		$status = 'Actif';
		if($_POST['status'] == 'Actif')
		{
			$status = 'Inactif';	
		}
		$query = "
		UPDATE message
		SET statut_message = :statut_message 
		WHERE id_message = :id_message
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':statut_message'	=>	$status,
				':id_message'		=>	$_POST["id_message"]
			)
		);
		$result = $statement->fetchAll();
		if(isset($result))
		{
			echo 'Le statut de l\'ativité est : ' . $status;
		}
		
		
		// Log
		// On a besoin du nom de la cat
		$query00 = "
		SELECT titre
		FROM message 
		WHERE id_message = '".$_POST["id_message"]."'
		";
		$statement00 = $connect->prepare($query00);
		$statement00->execute();
		$result00 = $statement00->fetchAll();
		
		$name_cat = "";
		
		foreach($result00 as $row00)
		{
		    $name_cat = $row00["titre"];
		}
		
    	// switch ($_SESSION['type']) {
    	
    	// 	case 1:
    	// 		addlog("Chg-20", "Changement du statut de l'message : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
    	// 		break;
    	// 	case 2:
    	// 		addlog("Chg-20", "Changement du statut de l'message : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
    	// 		break;
    	// 	case 3:
    	// 		addlog("Chg-20", "Changement du statut de l'actvité : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
    	// 		break;
    	// 	case 4:
    	// 		addlog("Chg-20", "Changement du statut de l'actvité : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
    	// 		break;
    	// }
		
		
		
	}
}

?>