<?php


include('database_connection.php');

include('AddLogInclude.php');
include("scripts_php/fonctions_sql.php");


if(isset($_GET["id"]) && isset($_GET["token"])) {
    $user = get_user($_GET["id"]);

    if(!is_null($user)) {
        if($_GET["token"] === $user["token"]) {
            $res1 = update("users", [
                "token" => null,
                "email_confirmed_at" => date("Y-m-d H:i")
            ], [
                ["id", $user["id"]]
            ]);

            if($res1) {

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Frixbiz - Services">
    <meta name="keywords" content="app, app landing, product landing, digital, material, html5">


    <title>Mainsrapides - Email Confirmation</title>

    <?php include("parts/headmeta.php") ?>

</head>

<body class="preload home3">

    <?php include("parts/js_scripts.php") ?>
    <script>
        swal(
            'Email confirmé',
            'Votre email a été confirmé avec succès.',
            'success'
        ).then(() => {
            window.location = "profile-adress.php";
        })
    </script>

</body>
</html>

<?php

            }
        }
    } else {
        header("location: index.php");
    }
}


?>

