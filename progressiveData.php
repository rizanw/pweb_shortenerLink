<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 09/11/2018
 * Time: 1:17
 */

if(empty($_SESSION)){
    header('location: index');
}

require_once ('config.php');

$conf = new config();
$conn = $conf->getConnection();
$userid = $_SESSION['id_user'];

$sql = "SELECT * FROM redirect WHERE createdby='$userid'";
$res = $conn->prepare($sql);
$res->execute();
$row = $res->fetchAll(PDO::FETCH_OBJ);

$data = array();
//print_r($row);

foreach ($row as $key){
    $data[] = array(
        'id' => $key->id,
        'name' => $key->name,
        'slug' => $key->slug,
        'url' => $key->url,
        'createdat' => $key->createdat
    );
}

echo (json_encode($data));


