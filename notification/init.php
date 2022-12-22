<?php

function send_notification(int $to_user_id, String $title, String $message, String $target_link) {
    $to_user = get_user($to_user_id);

    if(!is_null($to_user)) {
        $res = insert("notifications", [
            "to_user_id" => $to_user_id,
            "title" => $title,
            "message" => $message,
            "target_link" => $target_link
        ]);

        if($res) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

?>