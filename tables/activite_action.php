<?php

//category_action.php

include('../AddLogInclude.php');

include('../database_connection.php');

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Enregistrer')
	{
	    
	    //Mode demo
	    //echo 'La fonctionnalité (Ajouter une catégorie) est désactivée en mode Demo.';
	    
	    
	    // Vérifier si la catégorie existe déjà dans la base
    	$query0 = "
    	SELECT * FROM activite
		WHERE intitule_activite = :int_activite 
    	";
    	$statement0 = $connect->prepare($query0);
    	$statement0->execute(
    		array(
    				':int_activite'	        =>	$_POST["intitule_activite"]
    			)
    	);
    	$count = $statement0->rowCount();
    	if($count > 0)
    	{
    		echo 'Cette activité existe déjà dans la liste.';
    	}else
    	{
  
    		$query = "
    		INSERT INTO activite (intitule_activite, desc_activite, date_create_activite, date_modif_activite, type_service_activite)
    		VALUES (:int_activite, :desc_activite, :date_create, :date_modif, :type)
    		";
    		$statement = $connect->prepare($query);
    		$statement->execute(
    			array(
    				':int_activite'	=>	$_POST["intitule_activite"],
                    ':desc_activite' => $_POST["desc_activite"],
					':type'			 =>'Maintenance',
					':date_create' => date("Y-m-d H:i:s"),
					':date_modif' => date("Y-m-d H:i:s")
    			)
    		);
    		$result = $statement->fetchAll();
    		if(isset($result))
    		{
    			echo "L'activité de la maintenance a bien été ajoutée.";
    		}
    		
    		
    		// Log
        	// switch ($_SESSION['type']) {
        	
        	// 	case 1:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle activité : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
        	// 		break;
        	// 	case 2:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle activité : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
        	// 		break;
        	// 	case 3:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle activité : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
        	// 		break;
        	// 	case 4:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle activité : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
        	// 		break;
        	// }
		    
    	}
		
		
	}

	if($_POST['btn_action'] == 'activite_details')
	{
   
		$query = "
		SELECT * 
		FROM activite
		WHERE activite.id_activite = '".$_POST["id_activite"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '
		<div class="table-responsive">
			<table class="table table-boredered">
		';
		
		$nom_activite = "";
		
		foreach($result as $row)
		{
			$status = '';
			if($row['statut_activite'] == 'Actif')
			{
				$status = '<span class="label label-success">Actif</span>';
			}
			else
			{
				$status = '<span class="label label-danger">Inactif</span>';
			}
			
			// Pour le journal d'événements
			$nom_activite = $row["intitule_activite"];
			
			$output .= '
			<tr>
				<td>Intitulé de l\'activité</td>
				<td>'.$row["intitule_activite"].'</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>'.$row["desc_activite"].'</td>
			</tr>
			<tr>
				<td>Enregistrée par</td>
				<td></td>
			</tr>
			<tr>
				<td>Date d\'enregistrement</td>
				<td>'.date('d-m-Y H:i:s',strtotime($row["date_create_activite"])).'</td>
			</tr>
			<tr>
				<td>Date de dernière modification</td>
				<td>'.date('d-m-Y H:i:s',strtotime($row["date_modif_activite"])).'</td>
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
    	// 		addlog("Con-13", "Consultation des détails de l\'activité : ".$nom_activite, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
    	// 		break;
    	// 	case 2:
    	// 		addlog("Con-13", "Consultation des détails de l\'activité : ".$nom_activite, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
    	// 		break;
    	// 	case 3:
    	// 		addlog("Con-13", "Consultation des détails de l\'activité : ".$nom_activite, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
    	// 		break;
    	// 	case 4:
    	// 		addlog("Con-13", "Consultation des détails de l\'activité : ".$nom_activite, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
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
		
		$query = "SELECT * FROM activite WHERE id_activite = :id_activite";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id_activite'	=>	$_POST["id_activite"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['intitule_activite'] = $row['intitule_activite'];
			$output['desc_activite'] = $row['desc_activite'];
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
        	FROM activite
        	WHERE id_activite <> :id_activite  
        ) AS JP 
        WHERE intitule_activite = :int_activite 
    	";
    	$statement0 = $connect->prepare($query0);
    	$statement0->execute(
    		array(
    		        ':id_activite'	        =>	$_POST["id_activite"],
    				':int_activite'	        =>	$_POST["intitule_activite"]
    			)
    	);
    	$count = $statement0->rowCount();
    	if($count > 0)
    	{
    		echo 'Cette activité existe déjà dans la liste.';
    	}else
    	{
  
    		$query = "
    		UPDATE activite set intitule_activite = :int_activite, desc_activite = :desc_activite, date_modif_activite = :date_modif  
    		WHERE id_activite = :id_activite
    		";
    		$statement = $connect->prepare($query);
    		$statement->execute(
    			array(
    				':int_activite'	=>	$_POST["intitule_activite"],
    				':desc_activite'	=>	$_POST["desc_activite"],
    				':id_activite'		=>	$_POST["id_activite"],
                    ':date_modif'      => date("Y-m-d H:i:s")
    			)
    		);
    		$result = $statement->fetchAll();
    		if(isset($result))
    		{
    			echo 'L\'activité de la maintenance a bien été modifiée';
    		}
    		
    		
    		// Log
        	// switch ($_SESSION['type']) {
        	
        	// 	case 1:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
        	// 		break;
        	// 	case 2:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
        	// 		break;
        	// 	case 3:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
        	// 		break;
        	// 	case 4:
        	// 		addlog("Mod-20", "Modification des détails de la catégorie : ".$_POST['intitule_activite'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
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
		UPDATE activite
		SET statut_activite = :statut_activite 
		WHERE id_activite = :id_activite
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':statut_activite'	=>	$status,
				':id_activite'		=>	$_POST["id_activite"]
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
		SELECT intitule_activite
		FROM activite 
		WHERE id_activite = '".$_POST["id_activite"]."'
		";
		$statement00 = $connect->prepare($query00);
		$statement00->execute();
		$result00 = $statement00->fetchAll();
		
		$name_cat = "";
		
		foreach($result00 as $row00)
		{
		    $name_cat = $row00["intitule_activite"];
		}
		
    	// switch ($_SESSION['type']) {
    	
    	// 	case 1:
    	// 		addlog("Chg-20", "Changement du statut de l'activité : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
    	// 		break;
    	// 	case 2:
    	// 		addlog("Chg-20", "Changement du statut de l'activité : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
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