<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 5/8/2018
 * Time: 12:20
 */

session_start();
require "Users.php";
$User = new Users();
if(isset($_SESSION['email']) and isset($_SESSION['pwd'])){
    if ($User->LoginUser($_SESSION['email'], $_SESSION['pwd']) == true) {
        if($User->GetUserRole($_SESSION['email'], $_SESSION['pwd']) == "admin"){
            echo"Welcome to the admin page " . $_SESSION['email'] . "<br>";
            echo"Your role is " . $_SESSION['role'] . "<br>";
            echo"<a href=\"logout.php\">Logout</a>";
        }else{
            echo"You do not have privileges for this page";
        }
    }else{
        ?> <script>window.location.replace("index.php");</script> <?php
    }
}else{
    ?> <script>window.location.replace("index.php");</script> <?php
}