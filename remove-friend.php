<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }

    $userId = $_POST['id'];
    $profile = findUserById($userId);
    removeFriendRequest($currentUser['id'],$profile['id']);
    header('location: profile.php?id='.$_POST['id']); 
