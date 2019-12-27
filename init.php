<?php
session_start();
require_once ('./vendor/autoload.php');
require_once ('Funtion.php');

$currentUser =null;

$db = new PDO('mysql:host=localhost;dbname=aa;charset=utf8','root');

if(isset($_SESSION['userID']))
{
    $currentUser =findUserById($_SESSION['userID']);
}

