<?php

include('../../database_connection.php');

include('../../AddLogInclude.php');
include("../../scripts_php/fonctions.php");
include("../../scripts_php/fonctions_sql.php");

include("../../notification/init.php");

function get_offres_annonces($annonce_id) {
    $annonce = get_annonce($annonce_id);
    $output = '';

    $data = get("*", "offre_annonce", [
        ["status", "enable"],
        ["annonce_id", $annonce_id]
    ], ["created_at" => "DESC"]);
    
    if(!is_null($data)) {
        $result = $data;

        foreach ($result as $key => $offre) {
            $btn_accepted = '';
            if($_SESSION["id"] === get_annonce($annonce_id)["user_id"] && $annonce["status"] === "enable") {
                $btn_accepted = '
                    <a href="accepter_offre.php?id_offre=' . $offre["id"] . '" class="accept-offre text-danger" offre-id="' . $offre["id"] . '" annonce-id="' . $annonce_id . '">Accepter</a>
                ';
            } elseif($offre["accepted"]) {
                $btn_accepted = '
                    <strong class="accept-offre text-success">Acceptée</strong>
                ';
            }

            $output .= '
            <div class="col-lg-4">
                <div class="card_style2">
                    <h4 class="card_style2__title">' . $offre["prix"] . ' €</h4>
                    <div class="card_style2__location_type">
                        <p>
                        <span class="type pcolorbg">De ' . get_full_name(get_user($offre["user_id"])) . '</span>
                    </div>
                    ' . $btn_accepted . '
                </div>
            </div>
            ';
        }
    } else {
        $output = "<p>Aucune offre pour le moment...</p>";
    }

    return $output;
    
}

if(isset($_POST["btn_action"])) {
    $action = $_POST["btn_action"];
    if($action === "Postuler") {
        if(isset($_POST["prix"])) {
            $ance = get_annonce($_POST["annonce_id"]);
            $postulant = get_user($_SESSION["id"]);
            $res = insert("offre_annonce", [
                "annonce_id" => $_POST["annonce_id"],
                "user_id" => $_SESSION["id"],
                "prix" => $_POST["prix"]
            ]);

            if($res) {
                send_notification(
                    $ance["user_id"],
                    get_full_name($postulant), 
                    "a fait une offre pour l'annonce " . $ance["titre"],
                    $GLOBALS["app_url"] . "/annonce_single.php?id=" . $ance["id"]
                );
                echo json_encode(get_offres_annonces($_POST["annonce_id"]));
            } else {
                echo json_encode("failed");
            }
        }
    }


    if($action === "Accepter") {
        $offre = get_offre($_POST["offre_id"]);
        $res1 = update("offre_annonce", [
            "accepted" => 1
        ], [
            ["id", $_POST["offre_id"]]
        ]);
        
        $res2 = update("annonces", [
            "status" => "on_way"
        ], [
            ["id", $_POST["annonce_id"]]
        ]);

        $res3 = insert("paiements", [
            "somme" => $offre["prix"],
            "commission" => 7,
            "offre_id" => $offre["id"],
            "annonce_id" => $_POST["annonce_id"],
            "user_client" => $_SESSION["id"],
            "user_jobber" => $offre["user_id"],
            "status" => "en_cours"
        ]);

        if($res1 && $res2 && $res3) {
            echo json_encode("success");
        } else {
            echo json_encode("failed");
        }
    }


    if($action === "Charger") {
        echo json_encode(get_offres_annonces($_POST["annonce_id"]));
    }
}


?>