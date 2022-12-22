<?php


include('../database_connection.php');

include('../AddLogInclude.php');
include('../scripts_php/fonctions_sql.php');


try {
    $query = "
    UPDATE annonces SET status='disable' 
    WHERE status='enable' AND expired_at <= CURDATE() AND expired_at != '0000-00-00 00:00:00'
    ";

    $stment = $connect->query($query);

    echo json_encode("success");
} catch (Exception $e) {
    echo json_encode("failed");
}


?>