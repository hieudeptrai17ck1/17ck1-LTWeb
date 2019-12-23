<?php
session_start();
require_once ('./vendor/autoload.php');
require_once ('Funtion.php');

<<<<<<< HEAD
=======
$page=detecPage();
>>>>>>> ca52af01ebf3fcb8ac6bcad79331e6c6bfae5831
$currentUser =null;

$db = new PDO('mysql:host=localhost;dbname=demo1;charset=utf8','root');

if(isset($_SESSION['userID']))
{
    $currentUser =findUserById($_SESSION['userID']);
}

