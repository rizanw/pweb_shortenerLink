<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 05/11/2018
 * Time: 0:12
 */


require_once ('config.php');
require_once ('url_generator.php');

$conf = new config();
$link = new shortener();

if(isset($_SESSION['login_user'])){
    header("location: home");
}else{
    if(isset($_POST['unregis_url'])){
        $link->unregisLink();
    }

    //Default tampilan view
    $conf->view('index');
}

?>