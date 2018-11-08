<?php

require_once('url_generator.php');
require_once('config.php');

$link = new shortener();
$code = $_GET["c"];
$url = $link->getUrlFromDb($code);

if(empty($url)){
    echo "<div style='position: relative; top: 40%; text-align: center; width: 100%;'>LINK NOT FOUND!!</div>";
    echo "<div style='position: relative; top: 40%; text-align: center; width: 100%;'>LINK NOT FOUND!!</div>";
    echo "<div style='position: relative; top: 40%; text-align: center; width: 100%;'>LINK NOT FOUND!!</div>";
    header('refresh: 3; url=index.php');
}else{
    $conf = new config();
    $conf->view('redirect', $url);
}

