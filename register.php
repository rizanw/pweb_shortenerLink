<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 05/11/2018
 * Time: 18:08
 */

require_once('config.php');
require_once('auth.php');

$conf = new config();
$conf->view('register');

$auth = new auth();
$auth->register();