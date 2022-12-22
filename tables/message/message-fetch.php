<?php

//category_fetch.php

include('../../database_connection.php');

include('../../AddLogInclude.php');
include('../../scripts_php/fonctions_sql.php');

$output = '';

$res = get("*", "messages", [
    ["status", "enable"],
    ["to_user_id", $_POST["user_id"]],
    ["seen", 0]
], [
    "created_at" => "DESC"
]);

if(!is_null($res)) {
    $result = $res;

    $i = 0;

    foreach ($result as $key => $message) {
        $from_user = get_user($message["from_user_id"]);

        $seen = !$message["seen"] ? '<span class="lnr lnr-envelope"></span>' : '';
        $output .= '
        <a href="chat.php?with='. $message["from_user_id"] .'" class="message recent">
            <div class="message__actions_avatar">
                <div class="avatar">
                    <img src="./'. $from_user["photo"] .'" alt="">
                </div>
            </div>
            <!-- end /.actions -->

            <div class="message_data">
                <div class="name_time">
                    <div class="name">
                        <p>'. get_full_name($from_user) .'</p>
                        '. $seen .'
                    </div>

                    <span class="ml-5 time">'. format_date($message["created_at"]) .'</span>
                    <p>'. smallDescription($message["message"]) .'</p>
                </div>
            </div>
            <!-- end /.message_data -->
        </a>
        ';

        $i++;
        if($i === 6) {
            break;
        }
    }
} else {
    $output = '<p class="p-3">Aucun message pour le moment...</p>';
}

echo json_encode($output);

?>