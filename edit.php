<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 06/11/2018
 * Time: 19:45
 */

if(empty($_SESSION)){
    header('location: index');
}

require_once('config.php');
require_once('url_generator.php');

$link = new shortener();
if(isset($_POST['edit_url'])){
    $link->editLink();
}

$conf = new config();
$conn = $conf->getConnection();
$id = $_GET['id'];
$slct = $conn->prepare("SELECT * FROM redirect WHERE slug='$id'");
$slct->execute();
$row = $slct->fetchAll(PDO::FETCH_OBJ);

$conf->view('edit', $row);
