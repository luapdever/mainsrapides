<?php

//culture_fetch.php

include('../db.php');
include('../scripts_php/functions_sql_load.php');



$colonne = array("photo","nom", "espece", "terrain", "quantite_semence", "date_debut", "date_fin", "statut");

$query = '';

$output = array();

$query .= "
    SELECT * 
    FROM culture WHERE deleted=false
";

if(isset($_POST["search"]["value"]))
{
	$query .= ' AND (';
	$query .= 'nom LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR notes LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR quantite_semence LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= ') ';
}

// Filtrage dans le tableau
if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$colonne[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_culture DESC ';
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
	if($row['statut'] == 'Actif')
	{
		$status = '<center><span class="badge badge-success"> Actif </span></center>';
	}
	else
	{
		$status = '<center><span class="badge badge-danger"> Inactif </span></center>';
	}
	$sub_array = array();
	$sub_array[] = '<img class="avatar" src="..' . $row['photo'] . '" alt="image" />';
	$sub_array[] = $row['nom'];
	$sub_array[] = load_name_espece($connect, $row['id_espece']);
	$sub_array[] = load_name_terrain($connect, $row['id_terrain']);
	$sub_array[] = $row['quantite_semence'];
	$sub_array[] = $row['date_debut'];
	$sub_array[] = $row['date_fin'];
	$sub_array[] = $status;
	
			
	// Super Administrateur ==========================================================================================
	if($_SESSION['type_compte'] == 'super_admin')
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id_culture"].'" href="#"> Consulter </a>
        <a class="dropdown-item update" id="'.$row["id_culture"].'" href="culture-edit.php?id='.$row["id_culture"].'"> Modifier </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item changer_statut" id="'.$row["id_culture"].'" href="#" data-status="'.$row["statut"].'"> Changer de statut </a>
		<a class="dropdown-item delete" id="'.$row["id_culture"].'" href="#" data-status="'.$row["statut"].'"> Supprimer </a>
      </div>
    </div>
	
	
	</center>
	';
	}

	// Administrateur ==========================================================================================
	if($_SESSION['type_compte'] == 'admin')
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id_culture"].'" href="#"> Consulter </a>
        <a class="dropdown-item update" id="'.$row["id_culture"].'" href="culture-edit.php?id='.$row["id_culture"].'"> Modifier </a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item changer_statut" id="'.$row["id_culture"].'" href="#" data-status="'.$row["statut"].'"> Changer de statut </a>
		<a class="dropdown-item delete" id="'.$row["id_culture"].'" href="#" data-status="'.$row["statut"].'"> Supprimer </a>
      </div>
    </div>
	
	
	</center>
	';
	}


	// Editeur ==========================================================================================
	if($_SESSION['type_compte'] == 'editeur')
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id_culture"].'" href="#"> Consulter </a>
        <a class="dropdown-item update" id="'.$row["id_culture"].'" href="culture-edit.php?id='.$row["id_culture"].'"> Modifier </a>
      </div>
    </div>
	
	
	</center>
	';
	}


	// Auteur ==========================================================================================
	if($_SESSION['type_compte'] == 'auteur')
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id_culture"].'" href="#"> Consulter </a>
      </div>
    </div>
	
	
	</center>
	';
	}


	// Lecteur ==========================================================================================
	if($_SESSION['type_compte'] == 'lecteur')
	{
	$sub_array[] = '
	<center>
	
	<div class="btn-group">
      <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Actions
      </button>
      <div class="dropdown-menu">
        <a class="dropdown-item view" id="'.$row["id_culture"].'" href="#"> Consulter </a>
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
        FROM culture WHERE deleted=false
    ");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>