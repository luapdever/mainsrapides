<?php

//category_fetch.php

include('../../database_connection.php');

include('../../AddLogInclude.php');
include('../../scripts_php/fonctions_sql.php');

$output = '';

$data = get("*", "annonces", [
    ["status", "finished"],
    ["user_id", $_POST["user_id"]]
]);

if(!is_null($data)) {
    $result = $data;
    
    foreach ($result as $key => $mission) {
        $output .= '
        <div class="col-lg-4">
            <div class="card_style2">
                <h4 class="card_style2__title">' . $mission["titre"] . '</h4>
                <div class="card_style2__location_type">
                    <p>
                        <span class="lnr lnr-map-marker"></span>' . $mission["place"] . '</p>
                    <span class="type pcolorbg">' . ($mission["creneau"] != null ? $mission["creneau"] : date("d-m-Y",strtotime($mission["date_fixed"]))) . '</span>
                </div>
                <a href="annonce_single.php?id=' . $mission["id"] . '">Voir plus</a>
            </div>
        </div>
        ';
    }
} else {
    $output = '<p>Aucune mission pour le moment...</p>';
}

echo json_encode($output);

?>