<?php

include('../../database_connection.php');

include('../../AddLogInclude.php');
include("../../scripts_php/fonctions.php");
include("../../scripts_php/fonctions_sql.php");

function get_book_photo() {
    $output = '';

    $data = get("*", "book_photo", [
        ["status", "enable"],
        ["user_id", $_SESSION["id"]]
    ], ["created_at" => "DESC"]);
    
    if(!is_null($data)) {
        $result = $data;

        foreach ($result as $key => $book) {
            $categorie = verify_category($book["categorie_id"]);
            $output .= '
            <div class="col-lg-4 col-md-6">
                <div class="product product--card product--card-small">

                    <div class="product__thumbnail">
                        <img src=".'. $book["photo"] . '" alt="Product Image">
                    </div>

                    <div class="product-desc">
                        <h2>'. $categorie["label"] . '</h2>
                        <p class="mt-3 mb-3">'. $book["description"] . '</p>
                        <a href="#' . $book["id"] . '" class="delete-book text-danger" book-id="' . $book["id"] . '">Supprimer</a>
                    </div>
                </div>
            </div>
            ';
        }
    } else {
        $output = '<p class="ml-5">Aucune photo ajoutée pour le moment...</p>';
    }

    return $output;
    
}

if(isset($_POST["btn_action"])) {
    $action = $_POST["btn_action"];
    if($action === "ajouter") {
        if(isset($_FILES["photo"])) {
            $photo = saveImage($_FILES["photo"], "book", "user/book")["url"];
            $res = insert("book_photo", [
                "photo" => $photo,
                "description" => $_POST["description"],
                "categorie_id" => $_POST["categorie_id"],
                "user_id" => $_SESSION["id"],
            ]);

            if($res) {
                echo json_encode(get_book_photo());
            } else {
                echo json_encode("failed");
            }
        }
    }


    if($action === "supprimer") {
        $data = get("*", "book_photo", [
            ["id", $_POST["book_id"]]
        ])[0];

        $res2 = deleteFile("../../" . $data["photo"]);
        if($res2) {
            $res1 = delete("book_photo", [
                ["id", $_POST["book_id"]]
            ]);
    
            if($res1) {
                echo json_encode(get_book_photo());
            } else {
                echo json_encode("failed");
            }
        } else {
            echo json_encode("failed");
        }
    }


    if($action === "Charger") {
        echo json_encode(get_book_photo($_SESSION["id"]));
    }
}


?>