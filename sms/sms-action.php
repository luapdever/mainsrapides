<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('../database_connection.php');
include('../scripts_php/fonctions_sql.php');
include('init.php');

if(isset($_POST["btn_action"])) {
    $action = $_POST["btn_action"];
    if($action === "verify_num") {
        $user = get_user($_SESSION["id"]);
        $code = !is_null($user["telephone"]) ? confirm_number($user) : null;

        if(!is_null($code)) {
            $res = update("users", [
                "code" => $code
            ], [
                ["id", $user["id"]]
            ]);

            if($res) {
                echo json_encode("success");
            } else {
                echo json_encode("failed");
            }
        } else {
            echo json_encode("code null");
        }
    }


    if($action === "confirm_code") {
        $user = get_user($_SESSION["id"]);

        if($_POST["code"] === $user["code"]) {
            $res1 = update("users", [
                "code" => null,
                "num_confirmed_at" => date("Y-m-d H:i")
            ], [
                ["id", $user["id"]]
            ]);

            if($res1) {
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