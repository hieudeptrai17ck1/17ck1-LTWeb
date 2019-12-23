
<?php
     ob_start();
    require_once 'init.php';  
   
//xử lí logi ở đây
?>
<?php include 'Header.php';?>
    <h1>Kích hoạt tài khoản</h1>
<?php if(isset($_GET['code'])): ?>
<?php

   $code=$_GET['code'];
    $success =false;
    $success=activateUser($code);

?>

<?php if($success): ?>
   <?php header('location: login.php'); ?>
<?php else:?>
    <div class="alert alert-denger" role="alert">
            kích  hoạt tài khoản thất bại
    </div>
<?php endif; ?>
<?php else: ?>
    <form method ="GET">     
        <div class="form-group">
            <label for="code">Mã kích hoạt</label>
            <input type="text"class="form-control"id="code"name="code"placeholder="mã kích hoạt">
        </div>
        <button type="submit"class="btn btn-primary">kích hoạt tài khoản</button>
    </form>
    <?php endif; ?>
<?php include 'Footer.php';?>