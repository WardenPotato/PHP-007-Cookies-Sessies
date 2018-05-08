<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 12:14
 */
session_start();
require "Users.php";
$User = new Users();
if(isset($_SESSION['email']) and isset($_SESSION['pwd'])){
    if ($User->LoginUser($_SESSION['email'], $_SESSION['pwd']) == true) {
        echo"Welcome " . $_SESSION['email'] . "<br>";
        echo"Your role is " . $_SESSION['role'] . "<br>";
        echo"<a href='admin.php'> Admin </a>";
        echo"<a href=\"logout.php\">Logout</a>";
    }else{
        ?> <script>window.location.replace("index.php");</script> <?php
    }
}else{
    ?> <script>window.location.replace("index.php");</script> <?php
}