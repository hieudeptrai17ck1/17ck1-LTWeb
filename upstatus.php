<?php
require_once 'init.php';
if(!$currentUser){
    header('Location: index.php');
    exit();
}

$createdAt=$_POST['createdAt'];
$content=$_POST['content'];
$contentIMG=$_POST['contentIMG'];
$success =true;

if(isset($_FILES['contentIMG']) && $_FILES['contentIMG']['name'])
{
    $success =false;
    $file =$_FILES['contentIMG'];
    $fileName=$file['name'];
    $fileSize=$file['size'];
    $fileTemp=$file['tmp_name'];
    $newImage=resizeImage($fileTemp,480,480);
    ob_start();
    imagejpeg($newImage);
    $contentIMG=ob_get_contents();
    ob_end_clean();
    $success =true; 
}
if ($content == "" && is_uploaded_file($_FILES['contentIMG']['tmp_name']))
{
    upstatus($currentUser['id'],$content,$contentIMG,0,0);
}
else
{
    //lưu trữ dữ liệu vào db khi có ảnh
    if (is_uploaded_file($_FILES['contentIMG']['tmp_name']))
    {
        upstatus($currentUser['id'],$content,$contentIMG,0,0); 
    }
    else  //lưu trữ dữ liệu vào db khi không có ảnh
    {
      upstatus1($currentUser['id'],$content,0,0); 
    }     
}
//like

 header('Location: index.php'); 
 ?>