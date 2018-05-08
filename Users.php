<?php
/**
 * Created by PhpStorm.
 * User: Warden Potato
 * Date: 4/24/2018
 * Time: 11:23
 */
require_once "Settings.php";
class Users extends Settings
{
    public $pdo;
    private $userdata;
    public function __construct()
    {
        if(session_status() === PHP_SESSION_NONE)session_start();
        $dsn = "mysql:host=$this->dbhost;dbname=$this->dbname;charset=$this->dbcharset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => true,
        ];
        $this->pdo = new PDO($dsn, $this->dbuser, $this->dbpass, $opt);
    }

    public function RegisterUser($email, $password){
        if ($this->LoginUser($email, $password) == false) {
            $stmt = $this->pdo->prepare("INSERT INTO login (email, password) VALUES(:email,:password)");
            return $stmt->execute(['email' => $email, 'password' => $password]) ? true : false;
        }
    }

    public function LoginUser($email, $password){
        $stmt = $this->pdo->prepare("SELECT idlogin, email, role FROM login WHERE email = :email AND password = :password");
        $stmt->execute(['email' => $email, 'password' => $password]);
        $_SESSION['role'] = $stmt->fetch(PDO::FETCH_ASSOC)["role"];
        return $stmt->rowCount() == 1 ? true : false;
    }
    public function GetUserID($email, $password){
        $stmt = $this->pdo->prepare("SELECT idlogin FROM login WHERE email = :email AND password = :password");
        return $stmt->execute(['email' => $email, 'password' => $password]) ? $stmt->fetch(PDO::FETCH_ASSOC)["idlogin"] : false;
    }
    public function GetUserRole($email, $password){
        $stmt = $this->pdo->prepare("SELECT role FROM login WHERE email = :email AND password = :password");
        return $stmt->execute(['email' => $email, 'password' => $password]) ? $stmt->fetch(PDO::FETCH_ASSOC)["role"] : false;
    }
}