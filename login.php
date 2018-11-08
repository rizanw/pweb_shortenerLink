<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 05/11/2018
 * Time: 18:00
 */

require_once('config.php');
require_once('auth.php');

$conf = new config();
$conf->view('login');
$auth = new auth();

if(isset($_POST['login'])){
    $auth->login();
}