<?php

function insert1($table,$col1,$data1) {
    $conx = new PDO('mysql:host=localhost;dbname=landyao', 'root', ''/*,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]*/);
    $conx->exec('SET NAMES utf8');

    $query = "
      INSERT INTO $table ($col1) 
      VALUES (:data1)
    ";

    $statement = $conx->prepare($query);
    $statement->execute(
        array(
            ':data1' =>   $data1
        )
    );
    $result = $statement->fetchAll();
    $check_insert1 = '';
    if(isset($result))
    {
        $check_insert1 = 'good';
    }else {
        $check_insert1 = 'bad';
    }
}

function update1($table,$colcond,$datacond,$col1,$data1) {
    $conx = new PDO('mysql:host=localhost;dbname=landyao', 'root', ''/*,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]*/);
    $conx->exec('SET NAMES utf8');

    $query = "
      UPDATE $table set $col1 = :data1 
      WHERE $colcond = :datacond
    ";

    $statement = $conx->prepare($query);
    $statement->execute(
        array(
            ':data1'    =>   $data1,
            ':datacond' =>   $datacond
        )
    );
    $result = $statement->fetchAll();
    $check_update1 = '';
    if(isset($result))
    {
        $check_update1 = 'good';
    }else {
        $check_update1 = 'bad';
    }
}

function insert2($table,$col1,$data1,$col2,$data2) {
    $conx = new PDO('mysql:host=localhost;dbname=landyao', 'root', ''/*,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]*/);
    $conx->exec('SET NAMES utf8');

    $query = "
      INSERT INTO $table ($col1,$col2) 
      VALUES (:data1,:data2)
    ";

    $statement = $conx->prepare($query);
    $statement->execute(
        array(
            ':data1' =>   $data1,
            ':data2' =>   $data2
        )
    );
    $result = $statement->fetchAll();
    $check_insert2 = '';
    if(isset($result))
    {
        $check_insert2 = 'good';
    }else {
        $check_insert2 = 'bad';
    }
}

function update2($table,$colcond,$datacond,$col1,$data1,$col2,$data2) {
    $conx = new PDO('mysql:host=localhost;dbname=landyao', 'root', ''/*,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]*/);
    $conx->exec('SET NAMES utf8');

    $query = "
      UPDATE $table set $col1 = :data1, $col2 = :data2 
      WHERE $colcond = :datacond
    ";

    $statement = $conx->prepare($query);
    $statement->execute(
        array(
            ':data1'    =>   $data1,
            ':data2'    =>   $data2,
            ':datacond' =>   $datacond
        )
    );
    $result = $statement->fetchAll();
    $check_update2 = '';
    if(isset($result))
    {
        $check_update2 = 'good';
    }else {
        $check_update2 = 'bad';
    }
}

function insert3($table,$col1,$data1,$col2,$data2,$col3,$data3) {
    $conx = new PDO('mysql:host=localhost;dbname=landyao', 'root', ''/*,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]*/);
    $conx->exec('SET NAMES utf8');

    $query = "
      INSERT INTO $table ($col1,$col2,$col3) 
      VALUES (:data1,:data2,:data3)
    ";

    $statement = $conx->prepare($query);
    $statement->execute(
        array(
            ':data1' =>   $data1,
            ':data2' =>   $data2,
            ':data3' =>   $data3
        )
    );
    $result = $statement->fetchAll();
    $check_insert3 = '';
    if(isset($result))
    {
        $check_insert3 = 'good';
    }else {
        $check_insert3 = 'bad';
    }
}

function update3($table,$colcond,$datacond,$col1,$data1,$col2,$data2,$col3,$data3) {
    $conx = new PDO('mysql:host=localhost;dbname=landyao', 'root', ''/*,[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]*/);
    $conx->exec('SET NAMES utf8');

    $query = "
      UPDATE $table set $col1 = :data1, $col2 = :data2, $col3 = :data3
      WHERE $colcond = :datacond
    ";

    $statement = $conx->prepare($query);
    $statement->execute(
        array(
            ':data1'    =>   $data1,
            ':data2'    =>   $data2,
            ':data3'    =>   $data3,
            ':datacond' =>   $datacond
        )
    );
    $result = $statement->fetchAll();
    $check_update3 = '';
    if(isset($result))
    {
        $check_update3 = 'good';
    }else {
        $check_update3 = 'bad';
    }
}

?>