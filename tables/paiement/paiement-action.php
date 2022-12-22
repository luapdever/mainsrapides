<?php

//subcategorie_action.php

include('../../database_connection.php');

include('../../AddLogInclude.php');
include('../../scripts_php/fonctions_sql.php');

if(isset($_POST['btn_action']))
{

    // terminer 
    if($_POST['btn_action'] == 'terminer')
    {

        $res1 = update("paiements", [
            "status" => "terminer",

        ], [
            ["id", $_POST["id_paiement"]]
        ]);

        if($res1) {
            $status = "terminé";
            echo json_encode($status);
        } else {
            echo json_encode("failed");
        }

    }


    // payer 
    if($_POST['btn_action'] == 'payer')
    {

        $res1 = update("paiements", [
            "status" => "paye",

        ], [
            ["id", $_POST["id_paiement"]]
        ]);

        if($res1) {
            $status = "payé";
            echo json_encode($status);
        } else {
            echo json_encode("failed");
        }

    }

    //delete
    if($_POST['btn_action'] == 'delete')
    {

        $status = 'deleted';

        $res1 = update("paiements", [
            "status" => $status,
            "deleted_at" => date("Y-m-d H:i")

        ], [
            ["id", $_POST["id_paiement"]]
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

 

?>