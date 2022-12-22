<?php

//category_action.php

include('../../AddLogInclude.php');

include('../../database_connection.php');
include("../../scripts_php/fonctions_sql.php");
include("../../scripts_php/fonctions.php");

// echo json_encode(array(
// 	"post" => $_POST,
// 	"files" => $_FILES
// ));

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'Enregistrer')
	{
	    
	    //Mode demo
	    //echo 'La fonctionnalité (Ajouter une catégorie) est désactivée en mode Demo.';
	    
	    
	    // Vérifier si la catégorie existe déjà dans la base
    	$data = get("*", "annonces", [
			["titre", $_POST["titre"]]
		]);
		
    	if(!is_null($data))
    	{
    		echo json_encode('Cette annonce existe déjà dans la liste.');
    	}else
    	{
			$creneau = null;
			$date_fixed = null;
			if(isset($_FILES["photo1"])) {
				$photo1 = saveImage($_FILES["photo1"], "annonce", "annonce")["url"];
			}
			if(isset($_FILES["photo2"])) {
				$photo2 = saveImage($_FILES["photo2"], "annonce", "annonce")["url"];
			}
			if(isset($_FILES["photo3"])) {
				$photo3 = saveImage($_FILES["photo3"], "annonce", "annonce")["url"];
			}

			if($_POST["date_choice"] === "date_fixed") {
				$date_fixed = strtotime($_POST["date_fixed"]);
				$expired_at = strtotime($_POST["date_fixed"] . " 00:00");
			} elseif($_POST["date_choice"] === "creneau") {
				if(isset($_POST["creneau"])) {
					$creneau = implode(", ", $_POST["creneau"]);
					$expire = date_add(date_create(), date_interval_create_from_date_string("1 day"));
					$expired_at = strtotime($expire->format("Y-m-d H:i:s"));
				}
			} elseif($_POST["date_choice"] === "weeks") {
				$creneau = "2 semaines";
				$expire = date_add(date_create(), date_interval_create_from_date_string("2 weeks"));
				$expired_at = strtotime($expire->format("Y-m-d H:i:s"));
			} elseif($_POST["date_choice"] === "months") {
				$creneau = "1 mois";
				$expire = date_add(date_create(), date_interval_create_from_date_string("1 month"));
				$expired_at = strtotime($expire->format("Y-m-d H:i:s"));
			}
  
			$rslt = insert("annonces", [
				'titre'	=>	$_POST["titre"],
				'description' => $_POST["description"],
				'creneau' => $creneau,
				'date_fixed' => !is_null($date_fixed) ? date("Y-m-d", $date_fixed) : null,
				'photo1' => $photo1,
				'photo2' => $photo2,
				'photo3' => $photo3,
				'place' => $_POST["place"],
				'prix_min' => $_POST["prix_min"],
				'prix_max' => $_POST["prix_max"],
				'expired_at' => date("Y-m-d H:i:s", $expired_at),
				'telephone' => $_POST["telephone"],
				'user_id' => $_SESSION["id"],
				'travail_id' => $_POST["travail_id"]
			]);

    		if($rslt)
    		{
    			echo json_encode("success");
    		} else {
				echo json_encode("failed");
			}
    		
    		
    		// Log
        	// switch ($_SESSION['type']) {
        	
        	// 	case 1:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle annonce : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
        	// 		break;
        	// 	case 2:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle annonce : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
        	// 		break;
        	// 	case 3:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle annonce : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
        	// 		break;
        	// 	case 4:
        	// 		addlog("Enr-20", "Enregistrement d\'une nouvelle annonce : ".$_POST['titre'], $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
        	// 		break;
        	// }
		    
    	}
		
		
	}

	if($_POST['btn_action'] == 'annonce_details')
	{
   
		$query = "
		SELECT * 
		FROM annonce
		WHERE annonce.id_annonce = '".$_POST["id_annonce"]."'
		";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		$output = '
		<div class="table-responsive">
			<table class="table table-boredered">
		';
		
		$nom_annonce = "";
		
		foreach($result as $row)
		{
			$status = '';
			if($row['statut_annonce'] == 'Actif')
			{
				$status = '<span class="titre titre-success">Actif</span>';
			}
			else
			{
				$status = '<span class="titre titre-danger">Inactif</span>';
			}
			
			// Pour le journal d'événements
			$nom_annonce = $row["titre"];
			
			$output .= '
			<tr>
				<td>Intitulé de l\'annonce</td>
				<td>'.$row["titre"].'</td>
			</tr>
			<tr>
				<td>Description</td>
				<td>'.$row["desc_annonce"].'</td>
			</tr>
			<tr>
				<td>Enregistrée par</td>
				<td></td>
			</tr>
			<tr>
				<td>Date d\'enregistrement</td>
				<td>'.date('d-m-Y H:i:s',strtotime($row["date_create_annonce"])).'</td>
			</tr>
			<tr>
				<td>Date de dernière modification</td>
				<td>'.date('d-m-Y H:i:s',strtotime($row["date_modif_annonce"])).'</td>
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
    	// 		addlog("Con-13", "Consultation des détails de l\'annonce : ".$nom_annonce, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
    	// 		break;
    	// 	case 2:
    	// 		addlog("Con-13", "Consultation des détails de l\'annonce : ".$nom_annonce, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
    	// 		break;
    	// 	case 3:
    	// 		addlog("Con-13", "Consultation des détails de l\'annonce : ".$nom_annonce, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Enregistreur");
    	// 		break;
    	// 	case 4:
    	// 		addlog("Con-13", "Consultation des détails de l\'annonce : ".$nom_annonce, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Recenseur");
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
		
		$query = "SELECT * FROM annonce WHERE id_annonce = :id_annonce";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':id_annonce'	=>	$_POST["id_annonce"]
			)
		);
		$result = $statement->fetchAll();
		foreach($result as $row)
		{
			$output['titre'] = $row['titre'];
			$output['desc_annonce'] = $row['desc_annonce'];
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
        	FROM annonce
        	WHERE id_annonce <> :id_annonce  
        ) AS JP 
        WHERE titre = :titre 
    	";
    	$statement0 = $connect->prepare($query0);
    	$statement0->execute(
    		array(
    		        ':id_annonce'	        =>	$_POST["id_annonce"],
    				':titre'	        =>	$_POST["titre"]
    			)
    	);
    	$count = $statement0->rowCount();
    	if($count > 0)
    	{
    		echo 'Cette annonce existe déjà dans la liste.';
    	}else
    	{
  
    		$query = "
    		UPDATE annonce set titre = :titre, desc_annonce = :desc_annonce, date_modif_annonce = :date_modif  
    		WHERE id_annonce = :id_annonce
    		";
    		$statement = $connect->prepare($query);
    		$statement->execute(
    			array(
    				':titre'	=>	$_POST["titre"],
    				':desc_annonce'	=>	$_POST["desc_annonce"],
    				':id_annonce'		=>	$_POST["id_annonce"],
                    ':date_modif'      => date("Y-m-d H:i:s")
    			)
    		);
    		$result = $statement->fetchAll();
    		if(isset($result))
    		{
    			echo 'L\'annonce de la maintenance a bien été modifiée';
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
		UPDATE annonce
		SET statut_annonce = :statut_annonce 
		WHERE id_annonce = :id_annonce
		";
		$statement = $connect->prepare($query);
		$statement->execute(
			array(
				':statut_annonce'	=>	$status,
				':id_annonce'		=>	$_POST["id_annonce"]
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
		FROM annonce 
		WHERE id_annonce = '".$_POST["id_annonce"]."'
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
    	// 		addlog("Chg-20", "Changement du statut de l'annonce : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Administrateur");
    	// 		break;
    	// 	case 2:
    	// 		addlog("Chg-20", "Changement du statut de l'annonce : ".$name_cat.". Statut réglé sur : ".$status, $_SESSION["prenom_user"]." ".$_SESSION["nom_user"]." - Contrôleur");
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