<?php
/**
 * Created by PhpStorm.
 * User: Rzkan
 * Date: 06/11/2018
 * Time: 15:16
 */

if( isset($_SESSION['login_user'])){
    echo
    '<nav class="navbar" id="topNavbar">
        <a href="http://'. $_SERVER['HTTP_HOST'] .'" class="active">Home</a>
        <div class="topnav-right">
            <a href="#"></a>
            <a href="logout">Logout</a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="navbar()">
            &#8801;
        </a>
     </nav>';
}else{
    echo
    '<nav class="navbar" id="topNavbar">
        <a href="http://'. $_SERVER['HTTP_HOST'] .'" class="active">Home</a>
        <div class="topnav-right">
            <a href="#"></a>
            <a href="login">Masuk</a>
            <a href="register">Daftar</a>
        </div>
        <a href="javascript:void(0);" class="icon" onclick="navbar()">
            &#8801;
        </a>
    </nav>';
}