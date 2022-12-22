<?php

//category_fetch.php

include('../../database_connection.php');

include('../../AddLogInclude.php');
include('../../scripts_php/fonctions_sql.php');

$output = '';

$res = get("*", "annonces", [
    ["user_id", $_POST["user_id"]],
    ["status", "<>", "deleted"]
]);

if(!is_null($res)) {
    $result = $res;

    foreach ($result as $key => $annonce) {
        $output .= '
        <div class="col-lg-4">
            <div class="card_style2">
                <h4 class="card_style2__title">' . $annonce["titre"] . '</h4>
                <div class="card_style2__location_type">
                    <p>
                        <span class="lnr lnr-map-marker"></span>' . $annonce["place"] . '</p>
                    <span class="type pcolorbg">' . ($annonce["creneau"] != null ? $annonce["creneau"] : date("d-m-Y",strtotime($annonce["date_fixed"]))) . '</span>
                </div>
                <a href="annonce_single.php?id=' . $annonce["id"] . '">Voir plus</a>
            </div>
        </div>
        ';
    }
} else {
    $output = '<p>Aucune mission pour le moment...</p>';
}

echo json_encode($output);

?>