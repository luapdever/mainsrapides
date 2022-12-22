<?php

//category_fetch.php

include('../database_connection.php');

include('../AddLogInclude.php');
include('../scripts_php/fonctions_sql.php');

$output = '';

$res = get("*", "notifications", [
    ["status", "enable"],
    ["seen", 0],
    ["to_user_id", $_POST["user_id"]]
], [
    "created_at" => "DESC"
]);

if(!is_null($res)) {
    $result = $res;

    $i = 0;

    foreach ($result as $key => $notification) {
        $output .= '
        <div class="notification seen_notif" idnoti="'. $notification["id"] .'">
            <a href="'. $notification["target_link"] .'" class="notification__info">
                <div class="info_avatar">
                    <i class="ml-3 mt-2 fa fa-bell"></i>
                </div>
                <div class="info">
                    <p>
                        <span>'. $notification["title"] .'</span> '. $notification["message"] .'
                    </p>
                    <p class="ml-5 time">'. format_date($notification["created_at"]) .'</p>
                </div>
            </a>

            <div class="notification__icons ">
                <span class="fa fa-circle text-success noti_icon"></span>
            </div>
        </div>
        ';

        $i++;
        if($i === 6) {
            break;
        }
    }
} else {
    $output = '<p class="p-3">Aucune notification pour le moment...</p>';
}

echo json_encode($output);

?>