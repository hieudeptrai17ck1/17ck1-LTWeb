<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }
?>

<?php include 'Header.php';?>
    <h1>Cập nhật thông tin cá nhân</h1>
<?php if(isset($_POST['displayName'])): ?>
<?php

   $displayName=$_POST['displayName'];
   $success =false;
   if($displayName !='')
   {
        updateUserProfile($currentUser['id'],$displayName);
        $success =true;
   }
?>

<?php if($success): ?>
   <?php header('location: index.php'); ?>
<?php else:?>
    <div class="alert alert-denger"role="alert">
            Cập nhật thông tin thất bại
    </div>
<?php endif; ?>
<?php else: ?>
    <form action="update-profile.php"method ="POST">
        <div class="form-group">
            <label for="displayName">Họ tên</label>
            <input type="text"class="form-control"id="displayName"name="displayName"placeholder="Họ tên" value="<?php echo $currentUser['displayName'];?>">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Ảnh đại diện</label>
            <input type="file" class="form-control-file" id="avarta" name="avarta">
        </div>
        <button type="submit"class="btn btn-primary">Cập nhật thông tin cá nhân</button>
    </form>
    <?php endif; ?>
<?php include 'Footer.php';?>