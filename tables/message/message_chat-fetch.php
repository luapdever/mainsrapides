<?php

//category_fetch.php

include('../../database_connection.php');

include('../../AddLogInclude.php');
include('../../scripts_php/fonctions_sql.php');

$output = '';

$prequery  = "
    UPDATE messages SET seen=1 
    WHERE status='enable' AND 
    ((to_user_id=". $_SESSION["id"] ." AND from_user_id=:to_user_id)) 
    ORDER BY created_at DESC
";

$stment = $connect->prepare($prequery);
$stment->execute(array(
    ":to_user_id" => $_POST["with_user_id"]
));

$query  = "
    SELECT * FROM messages 
    WHERE status='enable' AND 
    ((from_user_id=". $_SESSION["id"] ." AND to_user_id=:to_user_id) OR (to_user_id=". $_SESSION["id"] ." AND from_user_id=:to_user_id)) 
    ORDER BY created_at DESC
";

$statement = $connect->prepare($query);
$statement->execute(array(
    ":to_user_id" => $_POST["with_user_id"]
));

$res = $statement->fetchAll();

if(!is_null($res)) {
    $result = $res;

    $i = 0;

    foreach ($result as $key => $message) {
        $from_user = get_user($message["from_user_id"]);

        $output = '
        <div class="chat-message-'. ($from_user["id"]===$_SESSION["id"] ? 'right' : 'left') .' pb-4">
            <div>
                <img src="./'. $from_user["photo"] .'" class="rounded-circle mr-1" alt="User Name" width="40" height="40">
                <div class="text-muted small text-nowrap mt-2">'. format_date($message["created_at"]) .'</div>
            </div>
            <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                <div class="font-weight-bold mb-1">'. ($from_user["id"]===$_SESSION["id"] ? 'Vous' : get_full_name($from_user)) .'</div>
                '. $message["message"] .'
            </div>
        </div>
        ' . $output;

        $i++;
        if($i === 6) {
            break;
        }
    }
} else {
    $output = '<p class="p-3">Aucun message dans ce chat...</p>';
}

echo json_encode($output);

?>