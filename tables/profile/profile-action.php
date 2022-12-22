<?php

//category_action.php

include('../../AddLogInclude.php');

include('../../database_connection.php');
include("../../scripts_php/fonctions_sql.php");
include("../../scripts_php/fonctions.php");
include("../../mail/init.php");

// echo json_encode(array(
// 	"post" => $_POST,
// 	"files" => $_FILES
// ));

if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'update')
	{
		$data = get("*", "users", [
			["email", $_POST["email"]]
		]);

		$user = get_user($_SESSION["id"]);
	    
    	$bill_info = get("*", "biling_info", [
			["user_id", $_SESSION["id"]]
		]);
		
    	if(empty($_POST["email"]))
    	{
    		echo json_encode('Vous devez entrer un email.');
    	} elseif(!is_null($data) && $user["email"] != $_SESSION["email"]){
			echo json_encode('Ce email est déjà pris.');
		} else
    	{

			if(isset($_FILES["photo"])) {
				$photo = saveImage($_FILES["photo"], "user", "user")["url"];
			}

			if($_POST["news"] && $_POST["news"] === "on") {
				$news = 1;
			} else {
				$news = 0;
			}
			
			if($_POST["plans"] && $_POST["plans"] === "on") {
				$plans = 1;
			} else {
				$plans = 0;
			}

			$alertes = $_POST["alertes"];

			$res1 = update("users", [
				"photo" => !empty($photo) ? $photo : $user["photo"],
				"prenom" => !empty($_POST["prenom"]) ? $_POST["prenom"] : $user["prenom"],
				"nom" => !empty($_POST["nom"]) ? $_POST["nom"] : $user["nom"],
				"email" => !empty($_POST["email"]) ? $_POST["email"] : $user["email"],
				"telephone" => !empty($_POST["telephone"]) ? $_POST["telephone"] : $user["telephone"],
				"code_postal" => !empty($_POST["code_postal"]) ? $_POST["code_postal"] : $user["code_postal"],
				"adresse" => !empty($_POST["adresse"]) ? $_POST["adresse"] : $user["adresse"],
				"ville" => !empty($_POST["ville"]) ? $_POST["ville"] : $user["ville"],
				"sexe" => !empty($_POST["sexe"]) ? $_POST["sexe"] : $user["sexe"],
				"bio" => !empty($_POST["bio"]) ? $_POST["bio"] : $user["bio"],
				"news" => $news,
				"plans" => $plans,
				"alertes" => $alertes,
			], [
				["id", $_SESSION["id"]]
			]);

			if(is_null($bill_info)) {
				$res2 = insert("biling_info", [
					"first_name" => !empty($_POST["first_name"]) ? $_POST["first_name"] : '',
					"last_name" => !empty($_POST["last_name"]) ? $_POST["last_name"] : '',
					"entreprise_name" => !empty($_POST["entreprise_name"]) ? $_POST["entreprise_name"] : '',
					"email_bill" => !empty($_POST["email_bill"]) ? $_POST["email_bill"] : '',
					"city" => !empty($_POST["city"]) ? $_POST["city"] : '',
					"adress1" => !empty($_POST["adress1"]) ? $_POST["adress1"] : '',
					"adress2" => !empty($_POST["adress2"]) ? $_POST["adress2"] : '',
					"country" => !empty($_POST["country"]) ? $_POST["country"] : '',
					"code_postal" => !empty($_POST["code_postal"]) ? $_POST["code_postal"] : '',
					"user_id" => $_SESSION["id"]
				]);
			} else {
				$res2 = update("biling_info", [
					"first_name" => !empty($_POST["first_name"]) ? $_POST["first_name"] : '',
					"last_name" => !empty($_POST["last_name"]) ? $_POST["last_name"] : '',
					"entreprise_name" => !empty($_POST["entreprise_name"]) ? $_POST["entreprise_name"] : '',
					"email_bill" => !empty($_POST["email_bill"]) ? $_POST["email_bill"] : '',
					"city" => !empty($_POST["city"]) ? $_POST["city"] : '',
					"adress1" => !empty($_POST["adress1"]) ? $_POST["adress1"] : '',
					"adress2" => !empty($_POST["adress2"]) ? $_POST["adress2"] : '',
					"country" => !empty($_POST["country"]) ? $_POST["country"] : '',
					"code_postal" => !empty($_POST["code_postal"]) ? $_POST["code_postal"] : '',
				], [
					["user_id", $_SESSION["id"]]
				]);
			}

    		if($res1)
    		{
    			echo json_encode("success");
    		} else {
				echo json_encode("failed");
			}
		    
    	}
	}

	if($_POST['btn_action'] == 'save_badge') {
		$badge = get_badge_user($_SESSION["id"]);

		if(is_null($badge)) {
			if($_POST["badge_choice"] === "carte") {
				if(isset($_FILES["recto"]) && isset($_FILES["verso"])) {
					$recto = saveImage($_FILES["recto"], "carte_identity", "user/badge")["url"];
					$verso = saveImage($_FILES["verso"], "carte_identity", "user/badge")["url"];
				}
			} elseif($_POST["badge_choice"] === "passeport") {
				$recto = saveImage($_FILES["recto2"], "carte_identity", "user/badge")["url"];
			} else {
				echo json_encode("failed");
			}

			$date_expired = date("Y-m-d", strtotime($_POST["date_expired"]));

			$res3 = insert("badge_identity", [
				"type" => $_POST["badge_choice"],
				"recto" => $recto,
				"verso" => $verso,
				"country" => $_POST["country"],
				"date_expired" => $date_expired,
				"user_id" => $_SESSION["id"]
			]);

			if($res3) {
				echo json_encode("success");
			} else {
				echo json_encode("failed");
			}
		} else {
			echo json_encode("failed");
		}
	}

	if($_POST['btn_action'] == 'change_mdp') {
		$user = get_user($_SESSION["id"]);

		if(password_verify($_POST["old_mdp"], $user["mdp"])) {
			$res4 = update("users", [
				"mdp" => password_hash($_POST["mdp"], PASSWORD_BCRYPT)
			], [
				["id", $user["id"]]
			]);

			if($res4) {
				$message = '
					' . get_full_name($user) . ', votre mot de passe a été changé.
				';
				send_mail("contact@mainsrapides.com", $user["email"], "Changement de mot de passe", $message);

				echo json_encode("success");
			} else {
				echo json_encode("failed");
			}
		} else {
			echo json_encode("wrong");
		}
	}
	
	
	if($_POST['btn_action'] == 'save_skills') {
		$user = get_user($_SESSION["id"]);

		if(isset($_POST["skills"])) {
			$skills = save_skills($_POST["skills"]);

			$res4 = update("users", [
				"skills" => $skills
			], [
				["id", $user["id"]]
			]);

			if($res4) {
				$message = '
					' . get_full_name($user) . ', vous avez défini de nouvelles compétences.
				';
				send_mail("contact@mainsrapides.com", $user["email"], "Mains Rapides - Compétences", $message);

				echo json_encode("success");
			} else {
				echo json_encode("failed");
			}
			
		} else {
			echo json_encode("failed");
		}
	}
			
		
}

?>