<?php

//category_fetch.php

include('../database_connection.php');

include('../AddLogInclude.php');
include('../scripts_php/fonctions_sql.php');

$output = '';

$res = get("*", "notifications", [
    ["status", "enable"],
    ["to_user_id", $_POST["user_id"]],
    ["seen", 0]
]);

$count = !is_null($res) ? count($res) : 0;

$output = ($count!=0) ? '<span class="notification_count noti">'. $count .'</span>' : '';

echo json_encode($output);

?>