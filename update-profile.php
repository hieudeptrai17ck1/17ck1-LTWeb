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
<br><br><br><br><br>
    <h1>Cập nhật thông tin cá nhân</h1>
<?php if(isset($_POST['displayName'])&& isset($_POST['phoneNumber'])): ?>
<?php
    $displayName=$_POST['displayName'];
    $phoneNumber=$_POST['phoneNumber'];
    $avatar =$currentUser['avatar'];
    $success =true;
     if(isset($_FILES['avatar']) && $_FILES['avatar']['name'])
        {
                $success =false;
                $file =$_FILES['avatar'];
                $fileName=$file['name'];
                $fileSize=$file['size'];
                $fileTemp=$file['tmp_name'];
                $newImage=resizeImage($fileTemp,480,480);
                ob_start();
                imagejpeg($newImage);
                $avatar=ob_get_contents();
                ob_end_clean();
                $success =true;
        }
    updateUserProfile($currentUser['id'],$displayName,$phoneNumber,$avatar);   
?>

<?php if($success): ?>
   <?php header('location: index.php'); ?>
<?php else:?>
    <div class="alert alert-denger"role="alert">
            Cập nhật thông tin thất bại
    </div>
<?php endif; ?>
<?php else: ?>
    <form class="frm4" action="update-profile.php"method ="POST"enctype="multipart/form-data">
        <div class="form-group">
            <label for="displayName">Họ tên</label>
            <input type="text"class="form-control"id="displayName"name="displayName" value="<?php echo $currentUser['displayName'];?>">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Số điện thoại</label>
            <input type="text"class="form-control"id="phoneNumber"name="phoneNumber" value="<?php echo $currentUser['phoneNumber'];?>">
        </div>
        <div class="form-group">
            <label for="Ngaysinh">Ngày sinh</label>
            <input type="date"class="form-control"id="Ngaysinh"name="Ngaysinh">
        </div>
        <div class="form-group">
            <label for="Gioitinh">Giới tính</label><br>
            <input type="radio" name="Gioitinh" value="male" checked> Male<br>
            <input type="radio" name="Gioitinh" value="female"> Female<br>
        </div>
        <div class="form-group">
            <label for="Diachi">Địa chỉ</label>
            <input type="text"class="form-control"id="Diachi"name="Diachi" placeholder="Địa chỉ">
        </div>
        <div class="form-group">
            <label for="exampleFormControlFile1">Ảnh đại diện</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar">
        </div>
        <button type="submit"class="btn btn-primary">Cập nhật thông tin cá nhân</button>
    </form>
    <?php endif; ?>
<!-- Bổ sung thoogn tin cá nhân -->
<?php include 'Footer.php';?>



