<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }
//xử lí logi ở đây
?>

<?php include 'Header.php';?>
<br><br>
    <h1>Đổi mật khẩu</h1>
<?php if(isset($_POST['currentpassword'])&&isset($_POST['password'])): ?>
<?php

   $password=$_POST['password'];
   $currentpassword=$_POST['currentpassword'];
   $hashPassword = password_hash($password,PASSWORD_DEFAULT);

   $success =false;
    if(password_verify($currentpassword,$currentUser['password']))
    {
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        UpdateUserPassword($currentUser['id'],$password);
        $success =true;
    }
?>

<?php if($success): ?>
   <?php header('location: index.php'); ?>
<?php else:?>
    <div class="alert alert-denger"role="alert">
            Đổi mật khẩu thất bại
    </div>
<?php endif; ?>
<?php else: ?>
    <form class="frm1" action="chang-password.php"method ="POST">
    <div class="form-group">
            <label for="currentpassword">Mật khẩu hiện tại</label>
            <input type="password"class="form-control"id="currentpassword"name="currentpassword"placeholder="Mật khẩu hiện tại">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu mới</label>
            <input type="password"class="form-control"id="password"name="password"placeholder="Mật khẩu mới">
        </div>
        <button type="submit"class="btn btn-primary">Đổi mật khẩu</button>
    </form>
    <?php endif; ?>
<?php include 'Footer.php';?>