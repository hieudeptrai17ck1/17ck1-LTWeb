<?php
     ob_start(); 
    require_once 'init.php';
    
//xử lí logi ở đây
?>

<?php include 'Header.php';?>
    <h1>Đăng Ký</h1>
<?php if(isset($_POST['displayName'])&&isset($_POST['email'])&&isset($_POST['password'])): ?>
<?php
    $displayName=$_POST['displayName'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $hashPassword = password_hash($password,PASSWORD_DEFAULT);

    $success =false;
    $user=findUserByEmail($email);
   if(!$user)
   {
       $newUserId=createUser($displayName, $email, $password);
       $_SESSION['userId'] =$newUserId;
       $success =true;
   }
?>

<?php if($success): ?>
    <div class="alert alert-success"role="alert">
            vui lòng kiểm tra email để kích hoạt tài khoản!
    </div>
<?php else:?>
    <div class="alert alert-denger"role="alert">
            Đăng ký thất bại
    </div>
<?php endif; ?>
<?php else: ?>
    <form action="Register.php"method ="POST">
        <div class="form-group">
            <label for="displayName">Tên người dùng</label>
            <input type="text"class="form-control"id="displayName"name="displayName" placeholder="Họ tên">
        </div>
        <div class="form-group">
            <label for="email">email</label>
            <input type="email"class="form-control"id="email"name="email" placeholder="email">
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password"class="form-control"id="password"name="password"placeholder="Mật khẩu">
        </div>
        <button type="submit"class="btn btn-primary">Đăng ký</button>
    </form>
    <?php endif; ?>
<?php include 'Footer.php';?>