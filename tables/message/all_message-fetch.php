<?php

//category_fetch.php


include('../../database_connection.php');

include('../../AddLogInclude.php');
include('../../scripts_php/fonctions_sql.php');



$colonne = array("photo", "from_user_id", "message", "created_at");

$query = '';

$output = array();

$query .= "
    SELECT * FROM messages 
	WHERE status='enable' AND seen=0 AND to_user_id=". $_SESSION["id"] ." 
	GROUP BY from_user_id 
";

if(isset($_POST["search"]["value"]))
{
	$query .= ' AND (';
	$query .= 'from_user_id LIKE "%'.$_POST["search"]["value"].'%" ';
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
	$from_user = get_user($row["from_user_id"]);

	
	$sub_array = array();
	$sub_array[] = '<img class="avatar img-thumbnail" src="./'. $from_user['photo'] . '" alt="image" width="50" />';;
	$sub_array[] = get_full_name($from_user);
	$sub_array[] = tinyText($row["message"]);
	$sub_array[] = format_date($row["created_at"]);
	
	
	if(isset($_SESSION['role']))
	{
		$sub_array[] = '
		<center>
		
		<div class="btn-group">
		<button class="btn btn-light btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Actions
		</button>
		<div class="dropdown-menu">
			<a class="dropdown-item view" id="'.$row["id"].'" href="chat.php?with='.$row["from_user_id"].'"><i class="fa fa-eye"></i> Voir </a>
			<div class="dropdown-divider"></div>
		</div>
		</div>
		
		
		</center>
		';
	}


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
        FROM paiements WHERE status='en_cours' AND user_jobber=" . $_SESSION["id"] .  "
    ");
	$statement->execute();
	return $statement->rowCount();
}

echo json_encode($output);

?>