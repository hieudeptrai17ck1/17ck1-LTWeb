
<?php
     ob_start();
    require_once 'init.php';  
   
//xử lí logi ở đây
?>
<?php include 'Header.php';?>
<br><br>
    <h1>Đăng nhập</h1>
<?php if(isset($_POST['email'])&&isset($_POST['password'])): ?>
<?php
   $email=$_POST['email'];
   $password=$_POST['password'];
   $success =false;
    $user=findUserByEmail($email);
   if($user && $user['status']==1&&  password_verify($password,$user['password']))
   {
        $_SESSION['userID']=$user['id'];
       $success =true;  
   }
?>

<?php if($success): ?>
   <?php 
   header('location: index.php'); 
   ?>
<?php else:?>
    <div class="alert alert-denger" role="alert">
            Đăng nhập thất bạ
    </div>
<?php endif; ?>
<?php else: ?>
    <form class="frm1" action="login.php"method ="POST">
        <div class="form-group">
            <input type="email"class="form-control"id="email"name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password"class="form-control"id="password"name="password"placeholder="Mật khẩu">
        </div>
        <button type="submit"class="btn btn-primary">Đăng nhập</button>
    </form>
    <?php endif; ?>
<?php include 'Footer.php';?>