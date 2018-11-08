<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 09/11/2018
 * Time: 4:31
 */

if(empty($_SESSION)){
    header('location: index');
}

require_once ("config.php");

$conf = new config();
$db = $conf->getConnection();

$slug = $_GET['dw'];
$sql = "SELECT wallpaper FROM redirect WHERE slug='$slug' ";

$res = $db->prepare($sql);
$res->execute();
$r = $res->fetch(PDO::FETCH_OBJ);

if(!empty($r)){
    header('Content-type: image/jpeg	');
    header('Content-Disposition: attachment; filename='.$slug.'.jpg');
    ob_clean();
    flush();
    echo $r->wallpaper;
    exit;
}else{
    echo "no file";
    header('location: index');
}