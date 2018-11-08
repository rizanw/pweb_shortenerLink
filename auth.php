<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 06/11/2018
 * Time: 20:56
 */

require_once('config.php');

class auth{
    private $conn;
    function __construct(){
        $conf = new config();
        $this->conn = $conf->getConnection();
    }

    public function login(){
        if (isset($_POST['login'])) {
            if (empty($_POST['email']) || empty($_POST['pass'])) {

                header("location: login");
            }else{
                $username=$_POST['email'];
                $password=$_POST['pass'];

                $db = $this->conn;
                $sql = "SELECT * FROM user WHERE email='$username' AND pass='$password'";
                $res = $db->prepare($sql);
                $res->execute();
                $row = $res->rowCount();

                if($row == 1){
                    $_SESSION['login_user']=$username;
                    $this->sessionKeeper();
                    header("location: index");
                }else{
                    header("location: login");
                }
            }
        }
    }

    public function register(){
        if(isset( $_POST['register'])){
            $email = $_POST['email'];
            $name = $_POST['name'];
            $pass = $_POST['pass'];

            $db = $this->conn;
            $sql = "INSERT INTO user(name, email, pass) VALUES('$name', '$email', '$pass')";
            $db->exec($sql);
            header("location: index");
        }
    }

    public function logout(){
        if(session_destroy()){
            header("Location: index");
        }
    }

    function sessionKeeper(){
        $userCheck = $_SESSION['login_user'];
        $db = $this->conn;

        $sql = "SELECT * FROM user WHERE email='$userCheck'";
        $res = $db->prepare($sql);
        $res->execute();
        $row = $res->fetchAll();

        foreach ($row as $a){
            $id = $a['id'];
            $name = $a['name'];
        }

        $_SESSION['name_user'] = $name;
        $_SESSION['id_user'] = $id;
    }
}