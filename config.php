<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 05/11/2018
 * Time: 0:12
 */

class config{

    function getConnection(){
        $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "pweb";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo " Error nih : " . $e->getMessage();
        }
    }

    function view($content, $data = NULL){
        if($content == 'redirect'){
            include('view/redirect.view.php');
        }else{
            include('view/layout/header.php');
            include('view/layout/nav.php');
            if ($content == 'index') {
                include('view/index.view.php');
            } elseif ($content == 'home') {
                include('view/home.view.php');
            } elseif ($content == 'login') {
                include('view/login.view.php');
            } elseif ($content == 'register') {
                include('view/register.view.php');
            } elseif ($content == 'edit') {
                foreach ($data as $key) {
                    $id = $key->id;
                    $title = $key->name;
                    $slug = $key->slug;
                    $url = $key->url;
                }
                include('view/edit.view.php');
            } else {
                echo "404";
            }
            include('view/layout/footer.php');
        }
    }
}