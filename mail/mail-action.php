<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../database_connection.php');
include('../scripts_php/fonctions_sql.php');
include('init.php');

if(isset($_POST["btn_action"])) {
    $action = $_POST["btn_action"];
    if($action === "verify") {
        $user = get_user($_SESSION["id"]);
        $token = confirm_email($user);

        if(!is_null($token)) {
            $res = update("users", [
                "token" => $token
            ], [
                ["id", $user["id"]]
            ]);

            if($res) {
                echo json_encode("success");
            } else {
                echo json_encode("failed");
            }
        }
    }   
}

?>