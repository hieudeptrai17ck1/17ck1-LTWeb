<?php
 ob_start(); 
 require_once 'init.php';

 unset($_SESSION['userID']);
 header('location: index.php');
