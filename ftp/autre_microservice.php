<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 11/11/2020
 * Time: 00:47
 */

include('database_connection.php');

if(isset($_POST['view'])){

    /* Comme on a besoin des autres microservices, on doit écarter le microservice actuel : id_service <> :id_service  */
    $query = "
    SELECT * FROM service 
    INNER JOIN users ON service.id_users_fk_service = users.id_user 
    WHERE statut_service = :statut_service 
    AND id_users_fk_service = :id_users_fk_service 
    AND id_service <> :id_service 
    ORDER BY id_service DESC
    ";

    $statement = $connect->prepare($query);
    $statement->execute(
        array(
            ':statut_service'        =>	'Actif',
            ':id_users_fk_service'   =>	$_POST["id_vendeur"],
            ':id_service'            =>	$_POST["id_service"]
        )
    );
    $result = $statement->fetchAll();

    $output = '';

    foreach($result as $row)
    {

        $verif = '';
        if ($row['verif_vendeur_user'] == 'Vérifié'){
            $verif = '<span class="fa fa-check-circle" style="color: #26DE1A;" title="Vendeur vérifié"></span>';
        }

        $avatar_du_vendeur = '';
        if ($row['avatar_user'] == '') {
            $avatar_du_vendeur = 'avatar-vendeur.png';
        }else {
            $avatar_du_vendeur = $row['avatar_user'];
        }

        $output .= '
        <div class="col-lg-4">
            <div class="product product--card">

                <div class="product__thumbnail">
                    <img src="uploads/'.$row["image_un_service"].'" alt="Image principale" style="height: 230px;">
                    <div class="prod_btn">
                        <a href="microservice.php?msv='. $row['id_service'] .'" class="transparent btn--sm btn--round">En savoir plus</a>
                        <a href="#" class="transparent btn--sm btn--round favoris" id="'.$row["id_service"].'" jp="'.$row["id_users_fk_service"].'">Favori</a>
                    </div>
                </div>

                <div class="product-desc" style="height: 160px !important;">
                    <a href="microservice.php?msv='. $row['id_service'] .'" class="product_title">
                        <h4 style="line-height: 35px; margin-top: -8px; text-transform: none;">Je vais '.substr($row["nom_service"].' pour 1.000 FCFA',0, 50).'</h4>
                    </a>
                    <ul class="titlebtm">
                        <li>
                            <img class="auth-img" src="avatars/'. $avatar_du_vendeur .'" alt="author image" width="30">
                            <p>
                                <a href="vendeur-profil.php?vd='. $row['id_user'] .'">'.$row["pseudo_user"].' </a>'.$verif.'
                                
                            </p>
                        </li>
                    </ul>

                </div>

                <div class="product-purchase" style="padding: 20px 25px;">

                    <a class="btn btn--round btn-sm" href="microservice.php?msv='. $row['id_service'] .'" id="'.$row["id_service"].'" style="width: 100%;">Commander</a>


                </div>
            </div>
        </div>
        ';
    }


    echo json_encode($output);

}