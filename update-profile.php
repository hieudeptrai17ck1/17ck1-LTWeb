<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }
    $userId = $currentUser['id'];
    $profile = findUserById($userId);
?>

<?php include 'Header.php';?>
<br><br><br><br><br>
<?php if(isset($_POST['displayName'])&& isset($_POST['phoneNumber'])): ?>
<?php
    $displayName=$_POST['displayName'];
    $ngaySinh = $_POST['ngaySinh'];
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
    updateUserProfile($currentUser['id'],$displayName,$ngaySinh,$phoneNumber,$avatar);   
?>

<?php if($success): ?>
   <?php header('location: update-profile.php'); ?>
<?php else:?>
    <div class="alert alert-denger"role="alert">
            Cập nhật thông tin thất bại
    </div>
<?php endif; ?>
<?php else: ?>
<!-- thông tin cá nhân -->
    <form class="frm6" >
    <!-- <center><h2>Thông tin cá nhân</h2></center> -->
            <div>
                <?php
                     //echo '<img  src="data:image/jpeg;base64,'.base64_encode( $profile['avatar'] ).'" width="150px" height="150px" boder:1px solid #ddd; margin-left:20px"/><br>'; 
                     echo'Tên người dùng: '. $profile ['displayName'].'<br>';
                     echo 'Ngày sinh: '. $profile['ngaySinh'].'<br>';
                     echo 'Số điện thoại: '.$profile['phoneNumber'].'<br>';
                ?> 
            </div>
    </form>
    <!-- cập nhập thông tin form -->
    <form class="frm5" action="update-profile.php"method ="POST"enctype="multipart/form-data">
        <center><h2>Cập nhật</h2></center>
        <div class="form-group">
            <label for="displayName">Họ tên</label>
            <input type="text"class="form-control"id="displayName"name="displayName" value="<?php echo $currentUser['displayName'];?>">
        </div>
        <div class="form-group">
            <label for="phoneNumber">Số điện thoại</label>
            <input type="text"class="form-control"id="phoneNumber"name="phoneNumber" value="<?php echo $currentUser['phoneNumber'];?>">
        </div>
        <div class="form-group">
            <label for="ngaySinh">Ngày sinh</label>
            <input type="date"class="form-control"id="ngaySinh"name="ngaySinh"value="<?php echo $currentUser['ngaySinh'];?>">
        </div>
        <!-- <div class="form-group">
            <label for="Gioitinh">Giới tính</label><br>
            <input type="radio" name="Gioitinh" checked> Male<br>
            <input type="radio" name="Gioitinh" > Female<br>
        </div> -->
        <div class="form-group">
            <label for="exampleFormControlFile1">Ảnh đại diện</label>
            <input type="file" class="form-control-file" id="avatar" name="avatar">
        </div>
        <button type="submit"class="btn btn-primary">Cập nhật thông tin cá nhân</button>
    </form>
    <?php endif; ?>
<!-- Bổ sung thoogn tin cá nhân -->
<?php include 'Footer.php';?>

