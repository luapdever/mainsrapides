<?php

//category_fetch.php


include('../../database_connection.php');

include('../../AddLogInclude.php');
include('../../scripts_php/fonctions_sql.php');



$colonne = array("annonce_id", "somme", "commission", "client", "jobber", "status");

$query = '';

$output = array();

$query .= "
    SELECT * 
    FROM paiements WHERE status='paye' AND user_jobber=" . $_SESSION["id"] .  "
";

if(isset($_POST["search"]["value"]))
{
	$query .= ' AND (';
	$query .= 'somme LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= ') ';
}

// Filtrage dans le tableau
if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$colonne[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id DESC ';
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
	$status = '';
	if($row['status'] == 'en_cours')
	{
		$status = '<center><span class="btn btn--fullwidth btn-success"> En cours </span></center>';
	}
	else
	{
		$status = '<center><span class="btn btn--fullwidth btn-danger"> Payé </span></center>';
	}
	$sub_array = array();
	$sub_array[] = get_annonce($row["annonce_id"])["titre"];
	$sub_array[] = $row['somme'] . " €";
	$sub_array[] = $row['commission'] . " €";
	$sub_array[] = get_full_name(get_user($row["user_client"]));
	$sub_array[] = get_full_name(get_user($row["user_jobber"]));
	$sub_array[] = $status;
	
	
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
	$statement = $connect->prepare("
        SELECT * 
        FROM paiements WHERE status='paye' AND user_jobber=" . $_SESSION["id"] .  "
    ");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>