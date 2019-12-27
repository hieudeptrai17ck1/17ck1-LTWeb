<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }

    $id=$_GET['id'];
    $postId=getStatus($id);
    removeStatus($postId['id']);
    header('location: index.php'); 
