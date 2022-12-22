<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 27/10/2020
 * Time: 09:41
 */

include('database_connection.php');

//include('../AddLogInclude.php');

$colonne = array("nom_cmde", "date_en_cours_cmde", "id_users_vendeur_fk_cmde", "id_users_acheteur_fk_cmde", "prix_total_cmde", "commission_cmde", "statut_vente_cmde");

$query = '';

$output = array();

$query .= "
    SELECT id_cmde, nom_cmde, pseudo_user, email_user, date_en_cours_cmde, prix_total_cmde, commission_cmde, prix_net_cmde, id_users_acheteur_fk_cmde, id_users_vendeur_fk_cmde, statut_vente_cmde 
    FROM cmde 
	INNER JOIN users u on cmde.id_users_acheteur_fk_cmde = u.id_user 
";

if(isset($_POST["search"]["value"]))
{
    $query .= 'WHERE nom_cmde LIKE "%'.$_POST["search"]["value"].'%" ';

}

// Filtrage dans le tableau
if(isset($_POST['order']))
{
    $query .= 'ORDER BY '.$colonne[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= 'ORDER BY date_en_cours_cmde DESC ';
}

if($_POST['length'] != -1)
{
    $query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();

foreach($result as $row)
{

    // Détermination du pseudo du vendeur (le pseudo est déjà récupéré dans la requete d'en haut (INNER JOIN) )
    $pseudo_vendeur = '';
    $email_vendeur = '';
    $query0 = "
    SELECT pseudo_user, email_user 
    FROM users 
    WHERE id_user = :id_user 
    ";
    $statement0 = $connect -> prepare($query0);
    $statement0 -> execute(array(
        ":id_user" => $row['id_users_vendeur_fk_cmde']
    ));
    $result0 = $statement0 -> fetchAll();
    foreach($result0 as $row0)
    {
        $pseudo_vendeur = $row0['pseudo_user'];
        $email_vendeur = $row0['email_user'];
    }


    // Configuration du statut
    $statut = '';
    if ($row['statut_vente_cmde'] == 'En attente') {
        $statut = '<span class="enattente">En attente</span>';
    }

    if ($row['statut_vente_cmde'] == 'En cours') {
        $statut = '<span class="encours">En cours</span>';
    }

    if ($row['statut_vente_cmde'] == 'Annulé') {
        $statut = '<span class="annule">Annulé</span>';
    }

    if ($row['statut_vente_cmde'] == 'Terminé') {
        $statut = '<span class="termine">Terminé</span>';
    }


    if ($row['statut_vente_cmde'] == 'Supprimé') {
        $statut = '<span class="supprime">Supprimé</span>';
    }


    $commission = '';
    if ($row['commission_cmde'] == 25) {
        $commission = '25%';
    }
    if ($row['commission_cmde'] == 250) {
        $commission = '250';
    }

    $sub_array = array();
    $sub_array[] = 'Le vendeur va '.$row['nom_cmde'];
    $sub_array[] = date("d-m-Y", strtotime($row["date_en_cours_cmde"]));
    $sub_array[] = $pseudo_vendeur;
    $sub_array[] = $row['pseudo_user'];
    $sub_array[] = $row['prix_total_cmde'];
    $sub_array[] = $commission;
    //$sub_array[] = $row['prix_net_cmde'];
    $sub_array[] = $statut;


    if ($row['statut_vente_cmde'] == 'En attente') {
        $sub_array[] = '
            <div class="btn-group">
              <button type="button" class="btn btn--round btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Action
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item activate" href="#" id="'.$row["id_cmde"].'" jp="'.$row["id_users_vendeur_fk_cmde"].'" jp2="'.$row["id_users_acheteur_fk_cmde"].'" jp3="'.$email_vendeur.'" jp4="'.$row["email_user"].'">Lancer la commande</a>
                <a class="dropdown-item delete" href="#" id="'.$row["id_cmde"].'" jp="'.$row["id_users_vendeur_fk_cmde"].'" jp2="'.$row["id_users_acheteur_fk_cmde"].'" jp3="'.$email_vendeur.'" jp4="'.$row["email_user"].'">Supprimer</a>
              </div>
            </div>
        ';
    }

    if ($row['statut_vente_cmde'] == 'En cours') {
        $sub_array[] = '-';
    }

    if ($row['statut_vente_cmde'] == 'Annulé') {
        $sub_array[] = '-';
    }

    if ($row['statut_vente_cmde'] == 'Terminé') {
        $sub_array[] = '-';
    }

    if ($row['statut_vente_cmde'] == 'Supprimé') {
        $sub_array[] = '-';
    }

    $data[] = $sub_array;
}

$output = array(
    "draw"			=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  $filtered_rows,
    "recordsFiltered" 	=> 	get_total_all_records($connect),
    "data"				=>	$data
);

function get_total_all_records($connect)
{

    $query = "
    SELECT id_cmde, nom_cmde, pseudo_user, email_user, date_en_cours_cmde, prix_total_cmde, commission_cmde, prix_net_cmde, id_users_acheteur_fk_cmde, id_users_vendeur_fk_cmde, statut_vente_cmde 
    FROM cmde 
	INNER JOIN users u on cmde.id_users_acheteur_fk_cmde = u.id_user 
    ";

    $statement = $connect->prepare($query);
    $statement->execute();

    return $statement->rowCount();
}

echo json_encode($output);

?>