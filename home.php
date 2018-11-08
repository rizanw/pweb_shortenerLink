
<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 05/11/2018
 * Time: 18:29
 */

if(empty($_SESSION)){
    header('location: index');
}

require_once('config.php');
require_once('url_generator.php');

$conf = new config();
$conf->view('home');


$link = new shortener();
if(isset($_POST['regis_link'])){
    $link->regisLink();
}

if(isset($_GET['deleteid'])){
    $link->deleteLink();
}

if(isset($_GET['dw'])){
    $link->download($_GET['dw']);
}
