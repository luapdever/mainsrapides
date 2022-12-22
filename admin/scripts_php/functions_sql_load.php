<?php

function load_name_espece($connect, $id_espece) {
    $query = "
	SELECT nom FROM espece 
	WHERE id_espece=:id_espece AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_espece' => $id_espece));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_terrain($connect, $id_terrain) {
    $query = "
	SELECT nom FROM terrain 
	WHERE id_terrain=:id_terrain AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_terrain' => $id_terrain));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_magasin($connect, $id_magasin) {
    $query = "
	SELECT nom FROM magasin 
	WHERE id_magasin=:id_magasin AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_magasin' => $id_magasin));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_maladie($connect, $id_maladie) {
    $query = "
	SELECT nom FROM maladie 
	WHERE id_maladie=:id_maladie AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_maladie' => $id_maladie));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_culture($connect, $id_culture) {
    $query = "
	SELECT nom FROM culture 
	WHERE id_culture=:id_culture AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_culture' => $id_culture));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_personnel($connect, $id_personnel) {
    $query = "
	SELECT prenom, nom FROM personnel 
	WHERE id_personnel=:id_personnel AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_personnel' => $id_personnel));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["prenom"]. ' ' . $row['nom'] . '</strong>';
    }
    return $output;
}

function load_name_intrant($connect, $id_intrant) {
    $query = "
	SELECT nom FROM intrant 
	WHERE id_intrant=:id_intrant AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_intrant' => $id_intrant));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_equipement($connect, $id_equipement) {
    $query = "
	SELECT nom FROM equipement 
	WHERE id_equipement=:id_equipement AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_equipement' => $id_equipement));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_vaccin($connect, $id_vaccin) {
    $query = "
	SELECT nom FROM vaccin 
	WHERE id_vaccin=:id_vaccin AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_vaccin' => $id_vaccin));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

function load_name_pesticide($connect, $id_pesticide) {
    $query = "
	SELECT nom FROM pesticide 
	WHERE id_pesticide=:id_pesticide AND statut = 'Actif' 
	";
    $statement = $connect->prepare($query);
    $statement->execute(array(':id_pesticide' => $id_pesticide));
    $result = $statement->fetchAll();
    $output = '';
    foreach($result as $row)
    {
        $output .= '<strong>' . $row["nom"] . '</strong>';
    }
    return $output;
}

?>