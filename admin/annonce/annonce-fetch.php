<?php

//category_fetch.php

include('../db.php');
include('../scripts_php/fonctions_sql.php');



$colonne = array("photo1","titre", "place","prix_min", "prix_max", "status");

$query = '';

$output = array();

$query .= "
    SELECT * 
    FROM annonces WHERE status<>'deleted'
";

if(isset($_POST["search"]["value"]))
{
	$query .= ' AND (';
	$query .= 'titre LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR telephone LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR place LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR prix_min LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR prix_max LIKE "%'.$_POST["search"]["value"].'%" ';
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
	if($row['status'] == 'enable')
	{
		$status = '<center><span class="badge badge-success"> Actif </span></center>';
	}
	else
	{
		$status = '<center><span class="badge badge-danger"> Inactif </span></center>';
	}
	$sub_array = array();
	$sub_array[] = '<img class="avatar" src="'. $GLOBALS["app_url"] . $row['photo1'] . '" alt="image" />';
	$sub_array[] = $row['titre'];
	$sub_array[] = $row['place'];
	$sub_array[] = $row['prix_min'];
    $sub_array[] = $row['prix_max'];
	$sub_array[] = $status;
	
			
	// Super Administrateur ==========================================================================================
	if($_SESSION['role'] == 6)
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id"].'" href="#"> Consulter </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item changer_statut" id="'.$row["id"].'" href="#" data-status="'.$row["status"].'"> Changer de statut </a>
		<a class="dropdown-item delete" id="'.$row["id"].'" href="#" data-status="'.$row["status"].'"> Supprimer </a>
      </div>
    </div>
	
	
	</center>
	';
	}

	// Administrateur ==========================================================================================
	if($_SESSION['role'] == 5)
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id"].'" href="#"> Consulter </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item changer_statut" id="'.$row["id"].'" href="#" data-status="'.$row["status"].'"> Changer de statut </a>
		<a class="dropdown-item delete" id="'.$row["id"].'" href="#" data-status="'.$row["status"].'"> Supprimer </a>
      </div>
    </div>
	
	
	</center>
	';
	}


	// Editeur ==========================================================================================
	if($_SESSION['role'] == 4)
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id"].'" href="#"> Consulter </a>
      </div>
    </div>
	
	
	</center>
	';
	}


	// Auteur ==========================================================================================
	if($_SESSION['role'] == 3)
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id"].'" href="#"> Consulter </a>
      </div>
    </div>
	
	
	</center>
	';
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
	$statement = $connect->prepare("
        SELECT * 
        FROM annonces WHERE status<>'deleted'
    ");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>