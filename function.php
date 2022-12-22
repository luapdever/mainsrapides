<?php
//function.php

function fill_user($connect){
	$query = "SELECT * FROM user
	ORDER BY id_user ASC ";
	$statement = $connect->prepare($query);
	$statement -> execute();
	$result = $statement->fetchAll();
	return $result;
}
function fill_activite($connect)
{
	$query = "
	SELECT * FROM activite
	WHERE statut_activite = 'Actif'
	AND type_service_activite = 'Maintenance'
	ORDER BY id_activite ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_activite"].'">'.$row["intitule_activite"].'</option>';
	}
	return $output;
}
function fill_activite_hsse($connect)
{
	$query = "
	SELECT * FROM activite
	WHERE statut_activite = 'Actif'
	AND type_service_activite = 'Hsse'
	ORDER BY id_activite ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_activite"].'">'.$row["intitule_activite"].'</option>';
	}
	return $output;
}
function fill_tache_list($connect)
{
	$query = "
	SELECT * FROM tache 
	WHERE statut_tache = 'Actif' 
	AND type_service_tache = 'Maintenance'
	AND periodicite_tache = 'Journalier'
	ORDER BY id_tache ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$id_tache =$row['id_tache'];
		$nom_tache=$row['intitule_tache'];
		$output .= '<option value="'.$id_tache.'">'.$nom_tache.' </option>';
	}
	

	return $output;
}
function fill_tache_hsse_list($connect)
{
	$query = "
	SELECT * FROM tache 
	WHERE statut_tache = 'Actif'
	AND type_service_tache = 'Hsse'
	AND periodicite_tache = 'Journalier'	
	ORDER BY id_tache ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$id_tache =$row['id_tache'];
		$nom_tache=$row['intitule_tache'];
		$output .= '<option value="'.$id_tache.'">'.$nom_tache.' </option>';
	}
	

	return $output;
}

function fill_groupe_user_list_pour_admin($connect)
{
	$query = "
	SELECT * FROM mk_groupe_users
	ORDER BY id_group ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_group"].'">'.$row["lib_group"].'</option>';
	}
	return $output;
}

function fill_groupe_user_list_pour_controleur($connect)
{
	$query = "
	SELECT * FROM mk_groupe_users
	WHERE id_group IN (3, 4)
	ORDER BY id_group ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_group"].'">'.$row["lib_group"].'</option>';
	}
	return $output;
}

function fill_categorie_list($connect)
{
	$query = "
	SELECT * FROM mk_cat
	WHERE statut_cat = 'actif' 
	ORDER BY id_cat DESC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_cat"].'">'.$row["num_ohada_cat"].' '.$row["lib_cat"].'</option>';
	}
	return $output;
}

function fill_marque_list($connect)
{
	$query = "
	SELECT * FROM mk_marque
	WHERE statut_marque = 'actif' 
	ORDER BY lib_marque ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_marque"].'">'.$row["lib_marque"].'</option>';
	}
	return $output;
}

function fill_lieu_list($connect)
{
	$query = "
	SELECT * FROM mk_lieu
	WHERE statut_lieu = 'actif' 
	ORDER BY lib_lieu ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_lieu"].'">'.$row["lib_lieu"].'</option>';
	}
	return $output;
}

function fill_etat_list($connect)
{
	$query = "
	SELECT * FROM mk_etat
	ORDER BY id_etat ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_etat"].'">'.$row["lib_etat"].'</option>';
	}
	return $output;
}

function fill_fseur_list($connect)
{
	$query = "
	SELECT * FROM mk_fseur 
	WHERE statut_fseur = 'actif' 
	ORDER BY id_fseur ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_fseur"].'">'.$row["lib_fseur"].'</option>';
	}
	return $output;
}

function fetch_fseur_details($id_fseur, $connect)
{
	$query = "
	SELECT * FROM mk_fseur 
	WHERE id_fseur = '".$id_fseur."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['lib_fseur'] = $row["lib_fseur"];
		
	}
	return $output;
}

function fill_parent_immo_list($connect)
{
	$query = "
	SELECT * FROM mk_immo
	WHERE statut_immo = 'actif' 
	ORDER BY lib_immo ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_immo"].'">'.$row["lib_immo"].'</option>';
	}
	return $output;
}

function fill_user_save_list($connect)
{
	$query = "
	SELECT * FROM mk_users 
	WHERE nom_user = :nom_user 
	AND prenom_user = :prenom_user 
	";
	$statement = $connect->prepare($query);
	$statement->execute(
		array(
			':nom_user'	=>	$_SESSION["nom_user"],
			':prenom_user'	=>	$_SESSION["prenom_user"]
		)
	);
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["id_user"].'">'.$row["prenom_user"]." ".$row["nom_user"].'</option>';
	}
	return $output;
}

function fill_brand_list($connect, $category_id)
{
	$query = "SELECT * FROM brand 
	WHERE brand_status = 'active' 
	AND category_id = '".$category_id."'
	ORDER BY brand_name ASC";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '<option value="">Select Brand</option>';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["brand_id"].'">'.$row["brand_name"].'</option>';
	}
	return $output;
}

function get_user_name($connect, $user_id)
{
	$query = "
	SELECT user_name FROM user_details WHERE user_id = '".$user_id."'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return $row['user_name'];
	}
}

function fill_product_list($connect)
{
	$query = "
	SELECT * FROM product 
	WHERE product_status = 'active' 
	ORDER BY product_name ASC
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
		$output .= '<option value="'.$row["product_id"].'">'.$row["product_name"].'</option>';
	}
	return $output;
}

function fetch_product_details($product_id, $connect)
{
	$query = "
	SELECT * FROM product 
	WHERE product_id = '".$product_id."'";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		$output['product_name'] = $row["product_name"];
		$output['quantity'] = $row["product_quantity"];
		$output['price'] = $row['product_base_price'];
		$output['tax'] = $row['product_tax'];
	}
	return $output;
}

function available_product_quantity($connect, $product_id)
{
	$product_data = fetch_product_details($product_id, $connect);
	$query = "
	SELECT 	inventory_order_product.quantity FROM inventory_order_product 
	INNER JOIN inventory_order ON inventory_order.inventory_order_id = inventory_order_product.inventory_order_id
	WHERE inventory_order_product.product_id = '".$product_id."' AND
	inventory_order.inventory_order_status = 'active'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total = 0;
	foreach($result as $row)
	{
		$total = $total + $row['quantity'];
	}
	$available_quantity = intval($product_data['quantity']) - intval($total);
	if($available_quantity == 0)
	{
		$update_query = "
		UPDATE product SET 
		product_status = 'inactive' 
		WHERE product_id = '".$product_id."'
		";
		$statement = $connect->prepare($update_query);
		$statement->execute();
	}
	return $available_quantity;
}

function count_total_user_actif($connect)
{
	$query = "
	SELECT * FROM mk_users WHERE statut_user = 'Actif'";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_enregistreur_actif($connect)
{
	$query = "
	SELECT * FROM mk_users 
	WHERE statut_user = 'Actif'
	AND id_group_fk_user = 3
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_administrateur_actif($connect)
{
	$query = "
	SELECT * FROM mk_users 
	WHERE statut_user = 'Actif'
	AND id_group_fk_user = 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_category($connect)
{
	$query = "
	SELECT * FROM mk_cat WHERE statut_cat ='Actif'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_brand($connect)
{
	$query = "
	SELECT * FROM mk_marque WHERE statut_marque = 'Actif'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_immo_recens($connect)
{
	$query = "
	SELECT * FROM mk_immo_recens
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_immo_non_recens($connect)
{
	$query = "
	SELECT *
    FROM mk_immo 
    WHERE statut_immo = 'Actif' 
    AND id_immo NOT IN (SELECT id_immo_recens FROM mk_immo_recens)
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_immo($connect)
{
	$query = "
	SELECT * FROM mk_immo
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_immo_actif($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE statut_immo = 'actif'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_immo_inactif($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE statut_immo = 'inactif'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_immo_use($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function pourc_total_immo_use($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 1
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->rowCount();
	
	$query2 = "
	SELECT * FROM mk_immo
	";
	$statement2 = $connect->prepare($query2);
	$statement2->execute();
	$result2 = $statement2->rowCount();
	
	$pourc = ($result/$result2)*100;
	return $pourc;
}

function count_total_immo_rebus($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 2
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function pourc_total_immo_rebus($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 2
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->rowCount();
	
	$query2 = "
	SELECT * FROM mk_immo
	";
	$statement2 = $connect->prepare($query2);
	$statement2->execute();
	$result2 = $statement2->rowCount();
	
	$pourc = ($result/$result2)*100;
	return $pourc;
}

function count_total_immo_cede($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 3
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function pourc_total_immo_cede($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 3
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->rowCount();
	
	$query2 = "
	SELECT * FROM mk_immo
	";
	$statement2 = $connect->prepare($query2);
	$statement2->execute();
	$result2 = $statement2->rowCount();
	
	$pourc = ($result/$result2)*100;
	return $pourc;
}

function count_total_immo_detruit($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 4
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function pourc_total_immo_detruit($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 4
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->rowCount();
	
	$query2 = "
	SELECT * FROM mk_immo
	";
	$statement2 = $connect->prepare($query2);
	$statement2->execute();
	$result2 = $statement2->rowCount();
	
	$pourc = ($result/$result2)*100;
	return $pourc;
}

function count_total_immo_vole($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 5
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function pourc_total_immo_vole($connect)
{
	$query = "
	SELECT * FROM mk_immo WHERE id_etat_fk_immo = 5
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->rowCount();
	
	$query2 = "
	SELECT * FROM mk_immo
	";
	$statement2 = $connect->prepare($query2);
	$statement2->execute();
	$result2 = $statement2->rowCount();
	
	$pourc = ($result/$result2)*100;
	return $pourc;
}

function count_total_fseur_actif($connect)
{
	$query = "
	SELECT * FROM mk_fseur WHERE statut_fseur = 'actif'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function name_last_fseur_actif($connect)
{
	$query = "
	SELECT lib_fseur
	FROM (
		SELECT id_fseur, lib_fseur 
		FROM mk_fseur 
		WHERE statut_fseur = 'actif'
		ORDER BY id_fseur DESC
		LIMIT 1
	) AS JP
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	
	foreach ($result as $row) {		
		$name = $row["lib_fseur"];
	}
	
	return $name;
}

function count_total_lieu_actif($connect)
{
	$query = "
	SELECT * FROM mk_lieu WHERE statut_lieu = 'actif'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_marque_actif($connect)
{
	$query = "
	SELECT * FROM mk_marque WHERE statut_marque = 'actif'
	";
	$statement = $connect->prepare($query);
	$statement->execute();
	return $statement->rowCount();
}

function count_total_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function count_total_cash_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order 
	WHERE payment_status = 'cash' 
	AND inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function count_total_credit_order_value($connect)
{
	$query = "
	SELECT sum(inventory_order_total) as total_order_value FROM inventory_order WHERE payment_status = 'credit' AND inventory_order_status='active'
	";
	if($_SESSION['type'] == 'user')
	{
		$query .= ' AND user_id = "'.$_SESSION["user_id"].'"';
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	foreach($result as $row)
	{
		return number_format($row['total_order_value'], 2);
	}
}

function get_user_wise_total_order($connect)
{
	$query = '
	SELECT sum(inventory_order.inventory_order_total) as order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "cash" THEN inventory_order.inventory_order_total ELSE 0 END) AS cash_order_total, 
	SUM(CASE WHEN inventory_order.payment_status = "credit" THEN inventory_order.inventory_order_total ELSE 0 END) AS credit_order_total, 
	user_details.user_name 
	FROM inventory_order 
	INNER JOIN user_details ON user_details.user_id = inventory_order.user_id 
	WHERE inventory_order.inventory_order_status = "active" GROUP BY inventory_order.user_id
	';
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '
	<div class="table-responsive">
		<table class="table table-bordered table-striped">
			<tr>
				<th>User Name</th>
				<th>Total Order Value</th>
				<th>Total Cash Order</th>
				<th>Total Credit Order</th>
			</tr>
	';

	$total_order = 0;
	$total_cash_order = 0;
	$total_credit_order = 0;
	foreach($result as $row)
	{
		$output .= '
		<tr>
			<td>'.$row['user_name'].'</td>
			<td align="right">$ '.$row["order_total"].'</td>
			<td align="right">$ '.$row["cash_order_total"].'</td>
			<td align="right">$ '.$row["credit_order_total"].'</td>
		</tr>
		';

		$total_order = $total_order + $row["order_total"];
		$total_cash_order = $total_cash_order + $row["cash_order_total"];
		$total_credit_order = $total_credit_order + $row["credit_order_total"];
	}
	$output .= '
	<tr>
		<td align="right"><b>Total</b></td>
		<td align="right"><b>$ '.$total_order.'</b></td>
		<td align="right"><b>$ '.$total_cash_order.'</b></td>
		<td align="right"><b>$ '.$total_credit_order.'</b></td>
	</tr></table></div>
	';
	return $output;
}

?>