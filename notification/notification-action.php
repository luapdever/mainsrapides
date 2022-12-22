<?php

//category_action.php

include('../AddLogInclude.php');

include('../database_connection.php');
include("../scripts_php/fonctions_sql.php");


if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'seen')
	{
		$data = get("*", "notifications", [
			["id", $_POST["idnoti"]]
		]);

		if(!is_null($data)) {
			$notif = $data[0];
			if($notif["to_user_id"] === $_SESSION["id"]) {
				$res = update("notifications", [
					"seen" => 1
				], [
					["id", $notif["id"]]
				]);
				if($res) {
					echo json_encode($notif["target_link"]);
				} else {
					echo json_encode("");
				}
			} else {
				echo json_encode("");
			}
		} else {
			echo json_encode("");
		}
	}
	    
}

?>