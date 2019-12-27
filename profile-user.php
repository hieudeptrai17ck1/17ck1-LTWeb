<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }
    $userId = $_GET['id'];
    $profile = findUserById($userId);
?>
<?php include 'Header.php';?>

<form class="frm6" >
<h2><a href="index.php">Quay lại</a></h2>
            <div>
                <?php
                     echo '<img  src="data:image/jpeg;base64,'.base64_encode( $profile['avatar'] ).'" width="150px" height="150px" boder:1px solid #ddd; margin-left:20px"/><br>'; 
                     echo'Tên người dùng: '. $profile ['displayName'].'<br>';
                     echo 'Ngày sinh: '. $profile['ngaySinh'].'<br>';
                     echo 'Số điện thoại: '.$profile['phoneNumber'].'<br>';
                ?> 
            </div>
    </form>
<?php include 'Footer.php';?>
