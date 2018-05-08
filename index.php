<?php
session_start();
require "Users.php";
$User = new Users();
$domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false;

if(isset($_POST["submitButton"])){
    $email = $_POST["InputEmail1"];
    $password = $_POST["InputPassword"];
    //$db = new DatabaseOperations();
    if (isset($_POST["InputCheck"]) and $User->LoginUser($email, $password) == true) {
        $_SESSION['email'] = $email;
        $_SESSION['pwd'] = $password;
        setcookie('login_email', $email, time()+60*60*24*365, '/', $domain, false);
        setcookie('login_password', $password, time()+60*60*24*365, '/', $domain, false);
        header("Location: home.php");
    }elseif($User->LoginUser($email, $password) == true){
        $_SESSION['email'] = $email;
        $_SESSION['pwd'] = $password;
        header("Location: home.php");
    }
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="css/index.css" type="text/css">
        <title>Login</title>
    </head>
    <body>
    <div id="wrapper">
        <div id="content" class="border border-secondary rounded">
            <form method="post">
                <div class="form-group">
                    <label for="InputEmail">Email address</label>
                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="InputEmail1">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="InputPassword1">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="InputPassword">
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="Check1" name="InputCheck">
                    <label class="form-check-label" for="Check1">Remember me</label>
                </div>
                <button type="submit" class="btn btn-primary" name="submitButton">Submit</button>
            </form>

        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    </body>
    </html>
<?php

if(isset($_SESSION['email']) and isset($_SESSION['pwd'])){

    //$db = new DatabaseOperations();
    if ($User->LoginUser($_SESSION['email'], $_SESSION['pwd']) == true) {
        header("Location: home.php");
        //echo"Session check triggered";
    }else{
        echo"Session detection triggered without right login";
    }
}
if(isset($_COOKIE['login_email']) and isset($_COOKIE['login_password'])){
    if ($User->LoginUser($_COOKIE['login_email'], $_COOKIE['login_password']) == true) {
        $_SESSION['email'] = $_COOKIE['login_email'];
        $_SESSION['pwd'] = $_COOKIE['login_password'];
        ?> <script>window.location.replace("home.php");</script> <?php
        //echo"Session cookie check triggered";
    }else{
        echo"Session cookie detection triggered without right login";
    }
}