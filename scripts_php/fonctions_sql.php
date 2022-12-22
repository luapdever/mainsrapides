<?php

function update(String $table, array $data, ?array $condition = []) {
    $val = array();
    $query = "
      UPDATE $table SET
    ";

    if (count($data) > 0) {
        foreach ($data as $col => $value) {
            $query .= " $col = :$col,";
            $val[":$col"] = $value;
        }
        $query = substr($query, 0, -1);

        if(isset($condition) && count($condition) > 0) {
            $query .= " WHERE";
            foreach ($condition as $key => $cond) {
                $query .= " " . $cond[0] . (count($cond) > 2 ? $cond[1] : "=") . ":" . $cond[0] . " AND";
                $val[":" . $cond[0]] = count($cond) > 2 ? $cond[2] : $cond[1];
            }
            $query = substr($query, 0, -3);
        }

        try {
            $statement = $GLOBALS["connect"]->prepare($query);
            $result = $statement->execute($val);

            return !empty($result) ? true : false;
        } catch (Exception $e) {
            return false;
        }

    } else {
        return null;
    }
}

function insert(String $table, array $data) {
    $preVal = "";
    $val = array();
    $query = "
      INSERT INTO $table(
    ";

    if (count($data) > 0) {
        foreach ($data as $col => $value) {
            $query .= " $col,";
            $preVal .= ":$col,";
            $val[":$col"] = $value;
        }
        $query = substr($query, 0, -1) . ") VALUES (" . substr($preVal, 0, -1) . ")";

        try {
            $statement = $GLOBALS["connect"]->prepare($query);
            $result = $statement->execute($val);

            return !empty($result) ? true : false;
        } catch (Exception $e) {
            return null;
        }

    } else {
        return null;
    }
}

function get(String $cols = "*", String $table, ?array $condition = [], ?array $order = [], ?array $innerJoin = []) {
    $val = array();
    $query = "
      SELECT
    ";

    if (!empty($cols)) {
        $query .= " $cols FROM $table";

        if(isset($innerJoin) && count($innerJoin) > 0) {
            foreach ($innerJoin as $table_name => $onCond) {
                $query .= " INNER JOIN $table_name ON $onCond";
            }
            $query = substr($query, 0, -1);
        }

        if(isset($condition) && count($condition) > 0) {
            $query .= " WHERE";
            foreach ($condition as $key1 => $cond) {
                $query .= " " . $cond[0] . (count($cond) > 2 ? $cond[1] : "=") . ":" . $cond[0] . " AND";
                $val[":" . $cond[0]] = count($cond) > 2 ? $cond[2] : $cond[1];
            }
            $query = substr($query, 0, -3);
        }

        if(isset($order) && count($order) > 0) {
            $query .= " ORDER BY";
            foreach ($order as $key2 => $type) {
                $query .= " $key2 $type,";
            }
            $query = substr($query, 0, -1);
        }

        try {
            $statement = $GLOBALS["connect"]->prepare($query);
            $result = $statement->execute($val);

            return $statement->rowCount() > 0 ? $statement->fetchAll() : null;
        } catch (Exception $e) {
            return null;
        }

    } else {
        return null;
    }
}

function delete(String $table, array $condition) {
    $val = array();
    $query = "
      DELETE FROM $table
    ";

    if (count($condition) > 0) {
        
        if(isset($condition) && count($condition) > 0) {
            $query .= " WHERE";
            foreach ($condition as $key1 => $cond) {
                $query .= " " . $cond[0] . (count($cond) > 2 ? $cond[1] : "=") . ":" . $cond[0] . " AND";
                $val[":" . $cond[0]] = count($cond) > 2 ? $cond[2] : $cond[1];
            }
            $query = substr($query, 0, -3);
        }

        try {
            $statement = $GLOBALS["connect"]->prepare($query);
            $result = $statement->execute($val);

            return !empty($result) ? true : false;
        } catch (Exception $e) {
            return null;
        }

    } else {
        return null;
    }
}



function get_role($id) {
    $data = get("*", "roles", [
        ["id", $id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data[0] : null;

}

function get_user($id) {
    $data = get("*", "users", [
        ["id", $id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data[0] : null;

}

function get3users() {
    $users = get("*", "users", [
        ["status", "enable"]
    ]);
    
    $output = array();
    $i = 0;

    foreach ($users as $key => $user) {
        array_push($output, $user);
        $i++;
        if($i === 3) {
            break;
        }
    }

    return $output;
}


function get9annonces() {
    $annonces = get("*", "annonces", [
        ["status", "enable"]
    ], [
        "id" => "DESC"
    ]);
    
    $output = array();
    $i = 0;

    foreach ($annonces as $key => $annonce) {
        array_push($output, $annonce);
        $i++;
        if($i === 9) {
            break;
        }
    }

    return $output;
}


function get_annonces() {
    $annonces = get("*", "annonces", [
        ["status", "enable"]
    ], [
        "id" => "DESC"
    ]);
    
    $output = array();
    $i = 0;

    foreach ($annonces as $key => $annonce) {
        array_push($output, $annonce);
        $i++;
        if($i === 12) {
            break;
        }
    }

    return $output;
}

function get_full_name($user) {
    return $user["prenom"] . ' ' . $user["nom"];
}

function get_badge_user($user_id) {
    $data = get("*", "badge_identity", [
        ["user_id", $user_id]
    ]);

    return !is_null($data) ? $data[0] : null;

}

function get_annonce($id)
{
    $data = get("*", "annonces", [
        ["id", $id],
        ["status", "<>", "deleted"]
    ]);

    return !is_null($data) ? $data[0] : null;
}

function get_offre($id)
{
    $data = get("*", "offre_annonce", [
        ["id", $id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data[0] : null;
}

function get_paiement($id)
{
    $data = get("*", "paiements", [
        ["id", $id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data[0] : null;
}

function verify_work($work_id) {
    $data = get("*", "travaux", [
        ["id", $work_id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data[0] : null;

}

function verify_category($category_id) {
    $data = get("*", "categories", [
        ["id", $category_id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data[0] : null;

}

function verify_subcategory($subcategory_id) {
    $data = get("*", "subcategories", [
        ["id", $subcategory_id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data[0] : null;

}

function all_work($subcategorie_id) {
    $data = get("*", "travaux", [
        ["subcategorie_id", $subcategorie_id],
        ["status", "enable"]
    ]);

    return !is_null($data) ? $data : [];

}
function all_subcategorie($categorie_id) {
    $output = array();

    $data = get("*", "subcategories", [
        ["categorie_id", $categorie_id],
        ["status", "enable"]
    ]);

    $result = !is_null($data) ? $data : [];
    foreach ($result as $key => $subcategorie) {
        array_push($output, [
            "id" => $subcategorie["id"],
            "photo" => $subcategorie["photo"],
            "label" => $subcategorie["label"],
            "travaux" => all_work($subcategorie["id"])
        ]);
    }

    return $output;

}
function all_categorie() {
    $output = array();

    $data = get("*", "categories", [
        ["status", "enable"]
    ]);
    
    $result = !is_null($data) ? $data : [];

    foreach ($result as $key => $categorie) {
        array_push($output, [
            "id" => $categorie["id"],
            "label" => $categorie["label"],
            "subcategories" => all_subcategorie($categorie["id"])
        ]);
    }

    return $output;    

}


function count_annonces($user_id) {
    $data = get("*", "annonces", [
        ["user_id", $user_id]
    ]);

    return !is_null($data) ? count($data) : 0;
}

function count_offres_annonce($annonce_id) {
    $data = get("*", "offre_annonce", [
        ["annonce_id", $annonce_id]
    ]);

    return !is_null($data) ? count($data) : 0;
}

function count_missions_on_way($user_id) {
    $data = get("*", "annonces", [
        ["status", "on_way"],
        ["user_id", $user_id]
    ]);
    
    return !is_null($data) ? count($data) : 0;
}


function count_offres($user_id) {
    $data = get("*", "offre_annonce", [
        ["user_id", $user_id]
    ]);

    return !is_null($data) ? count($data) : 0;
}

function count_offres_on_way($user_id) {
    $data = get("*", "offre_annonce", [
        ["status", "enable"],
        ["accepted", 1],
        ["user_id", $user_id]
    ]);
    
    return !is_null($data) ? count($data) : 0;
}

function count_missions_finished($user_id) {
    $data = get("*", "annonces", [
        ["status", "finished"],
        ["user_id", $user_id]
    ]);
    
    return !is_null($data) ? count($data) : 0;
}





function fill_adresses_list()
{
    $data = get("*", "adresses", [
        ["status", "enable"]
    ], [
        "label" => "ASC"
    ]);
    
    $result = $data;
    $output = '';
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["label"].'">'.$row["label"].'</option>';
    }
    return $output;
}

function fill_categories_list()
{
    $data = get("*", "categories", [
        ["status", "enable"]
    ], [
        "label" => "ASC"
    ]);
    
    $result = $data;
    $output = '';
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["id"].'">'.$row["label"].'</option>';
    }
    return $output;
}


function fill_roles_list()
{
    $data = get("*", "roles", [
        ["status", "enable"]
    ]);
    
    $result = $data;
    $output = '';
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["id"].'">'.$row["label"].'</option>';
    }
    return $output;
}
function fill_subcategories_list()
{
    $data = get("*", "subcategories", [
        ["status", "enable"]
    ]);
    
    $result = $data;
    $output = '';
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["id"].'">'.$row["label"].'</option>';
    }
    return $output;
}
function fill_travaux_list()
{
    $data = get("*", "travaux", [
        ["status", "enable"]
    ]);
    
    $result = $data;
    $output = '';
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["id"].'">'.$row["label"].'</option>';
    }
    return $output;
}


function count_row($table)
{
    $output = array();

    $data = get("id", "$table", [
        ["status", "<>", "deleted"]
    ]);

    $total = !is_null($data) ? count($data) : 0;

    $query = $GLOBALS["connect"]->prepare("
        SELECT id, created_at
        FROM $table
        WHERE status<>'deleted' AND created_at >= DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 7 DAY)
    ");
	$query->execute();

    $total7 = $query->rowCount();

    $output = array(
        'total' => $total,
        'total7' => $total7,
    );

	return $output;
}


?>


