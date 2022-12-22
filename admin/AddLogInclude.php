<?php
function addlog($CodeEvent, $MessageEvent, $PseudoUtilisateur){
    include('database_connection.php');

    $varLogDate = gmdate("Y-m-d");
    $varLogHeure = gmdate("H:i:s"); //strftime("%H:%M:%S");
    $varCodeEvent = $CodeEvent;
    $varLogMessage = $MessageEvent;
    $varLogPseudo = $PseudoUtilisateur;
    $varLogIP = getenv("REMOTE_ADDR");


    $query_Clients = "INSERT INTO addlog_table(`CodeEvenement`,`MessageEvenement`,`DateEvenement`,`HeureEvenement`,`PseudoUtilisateur`,`AdresseIP`) VALUES ('". $CodeEvent . "','" . $varLogMessage . "','" . $varLogDate . "','" . $varLogHeure ."','". $varLogPseudo . "','" . $varLogIP . "')";
            
    $statement = $connect->prepare($query_Clients);
    $statement->execute();

}
?>
