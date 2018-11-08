
<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 05/11/2018
 * Time: 0:12
 */

require_once('config.php');

class shortener{
    private $conn;

    function __construct(){
        $conf = new config();
        $this->conn = $conf->getConnection();
    }

    public function unregisLink(){
        if(isset($_POST['unregis_url']) && $_POST['url_value'] != NULL) {;
            $date = date('Y-m-d H:i:s');
            $url=$_POST["url_value"];
            $slug=substr(md5($url.mt_rand()),0,4);

            $str = file_get_contents($url);
            if(strlen($str)>0) {
                $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
                preg_match("/\<title\>(.*)\<\/title\>/i", $str, $title); // ignore case
            }

            $db = $this->conn;
            try{
                $sql = "INSERT INTO redirect(name, slug, url, createdat) VALUE ('$title[1]','$slug', '$url', '$date')";
                $db->exec($sql);

                $cookie_name = "alert";
                $cookie_value = $slug;
                setcookie($cookie_name, $cookie_value, time() + (5), "/");

                header('location: index');
            }catch (PDOException $e){
                echo "Error : " . $e->getMessage();
            }
        }
    }

    public function regisLink(){
        if(isset($_POST['regis_link'])) {
            $db = $this->conn;

            $userid = $_SESSION['id_user'];
            $date = date('Y-m-d H:i:s');
            $url=$_POST["url_value"];
            $slug=substr(md5($url.mt_rand()),0,4);

            $str = file_get_contents($url);
            if(strlen($str)>0) {
                $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
                preg_match("/\<title\>(.*)\<\/title\>/i", $str, $title); // ignore case
            }

            try{
                $sql = "INSERT INTO redirect(name, slug, url, createdat, createdby) VALUE ('$title[1]','$slug', '$url', '$date', '$userid')";
                $db->exec($sql);

                header('location: index');
            }catch (PDOException $e){
                echo "Error : " . $e->getMessage();
            }
        }
    }

    public function deleteLink(){
        if(isset($_GET['deleteid'])){
            $db = $this->conn;
            $idurl = $_GET['deleteid'];

            $sql = "DELETE FROM redirect WHERE  id='$idurl'";
            $db->exec($sql);

            header('location: index');
        }
    }

    public function editLink(){
        if (isset($_POST['edit_url'])){
            $db = $this->conn;

            $id = $_POST['id'];
            $title = $_POST['url_title'];
            $url = $_POST['url_value'];
            $slug = $_POST['url_short'];
            $slugChecker = $_GET['id'];

            /*
             *
             check slug
            $sql = "SELECT * FROM redirect WHERE slug='$slug'";
            $check = $db->prepare($sql);
            $check->execute();
            $r = $check->rowCount();
            */

            if($_FILES['wallpaper']['error'] == 0){
                $check = getimagesize($_FILES["wallpaper"]["tmp_name"]);
            }

            if($check !== false) {
                $blob = file_get_contents($_FILES['wallpaper']['tmp_name']);
                echo "File is an image - " . $check["mime"] . ".";
            } else {
                echo "File is not an image.";
            }

            $sql = "UPDATE redirect SET name=:title, url=:url, slug=:slug, wallpaper=:wallpaper WHERE id=$id";

            $res = $db->prepare($sql);
            $res->bindParam('title', $title);
            $res->bindParam('url', $url);
            $res->bindParam('slug', $slug);
            $res->bindParam('wallpaper', $blob, PDO::PARAM_LOB);
            $res->execute();

            header("Location: index.php");
        }

    }

    function getUrlFromDb($code) {
        $db = $this->conn;

        $sql = "SELECT * FROM redirect WHERE slug = :short_code";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('short_code',$code);
        $stmt->execute();

        $result = $stmt->fetch();
        return $result;
    }

    public function download($pict){
        $db = $this->conn;

        $slug = $pict;
        $sql = "SELECT wallpaper FROM redirect WHERE slug='$slug' ";

        $res = $db->prepare($sql);
        $res->execute();
        $r = $res->fetch(PDO::FETCH_OBJ);

        if(!empty($r)){
            header('Content-type: image/jpeg	');
            header('Content-Disposition: attachment; filename='.$slug.'.jpg');
            header('expires:0');
            ob_clean();
            flush();
            echo $r->wallpaper;
            exit;
        }else{
            echo "error";
            header('location: index.php');
        }
    }
}