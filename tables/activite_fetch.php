<?php

//category_fetch.php

include('../database_connection.php');

include('../AddLogInclude.php');

$colonne = array("id_activite", "intitule_activite", "statut_activite");

$query = '';

$output = array();

$query .= "SELECT * FROM activite 
WHERE type_service_activite = 'Maintenance' ";

if(isset($_POST["search"]["value"]))
{
	$query .= 'AND (intitule_activite LIKE "%'.$_POST["search"]["value"].'%" ';
	$query .= 'OR statut_activite LIKE "%'.$_POST["search"]["value"].'%" )';
	
}

// Filtrage dans le tableau
if(isset($_POST['order']))
{
	$query .= 'ORDER BY '.$colonne[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
	$query .= 'ORDER BY id_activite DESC ';
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
	if($row['statut_activite'] == 'Actif')
	{
		$status = '<center><span class="label label-success">Actif</span></center>';
	}
	else
	{
		$status = '<center><span class="label label-danger">Inactif</span></center>';
	}
	$sub_array = array();
	$sub_array[] = $row['id_activite'];
	$sub_array[] = $row['intitule_activite'];
	$sub_array[] = $status;
	
	//Administrateur ==========================================================================================
	if($_SESSION['type'] == '1')
	{
	$sub_array[] = '
	<center>
	<div class="btn-group">
		
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Actions <span class="caret"></span>
	  </button>
	  
	  <ul class="dropdown-menu">
	  	<li><a href="#" id="'.$row["id_activite"].'" class="view">Consulter</a></li>
		<li><a href="#" id="'.$row["id_activite"].'" class="update">Modifier</a></li>
		<li role="separator" class="divider"></li>
		<li><a href="#" id="'.$row["id_activite"].'" class="delete" data-status="'.$row["statut_activite"].'">Changer le statut</a></li>
		
	  </ul>
	</div>
	</center>
	';
	}
	
	//Contrôleur ==========================================================================================
	if($_SESSION['type'] == '2')
	{
	$sub_array[] = '
	<center>
	<div class="btn-group">
		
	  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Actions <span class="caret"></span>
	  </button>
	  
	  <ul class="dropdown-menu">
		
		<li><a href="#" id="'.$row["id_activite"].'" class="update">Modifier</a></li>
		
	  </ul>
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
	$statement = $connect->prepare("SELECT * FROM activite 
	WHERE type_service_activite = 'Maintenance'");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>