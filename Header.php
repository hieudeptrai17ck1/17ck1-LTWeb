<?php
    require_once 'init.php';
    require_once 'Funtion.php';

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="edit.css">;    
    <title>Hiếu đẹp trai nha</title>
  </head>
  <body>
  <div  style="background-color:rgb(204, 255, 255)" class="container">
        <div class="list1" style="background-image: url('http://thuthuatphanmem.vn/uploads/2018/04/01/anh-bia-facebook-co-chu-hay-5_034932363.png');max-height:290px;"> 
                <br><br><br><br><br><br><br><br><br><br>
            <table>
                <tr>
                    <td>
                        <?php if($currentUser): ?>
                            <?php
                            $id=$_SESSION['userID'];
                            $user =findUserById($id);  
                            echo ' <img  src="data:image/jpeg;base64,'.base64_encode( $user['avatar'] ).'" width="150px" height="150px" style="border-radius:250px;boder:1px solid #ddd; margin-left:20px"/>';
                            ?> 
                        <?php endif; ?>
                    </td>
                    <td>
                        <font style="color:black;font-weight:bold;font-size:30px;margin-left:10px"><?php echo $currentUser ? ''. $currentUser['displayName'] . '': '' ?></font>
                    </td>
                </tr>
            </table>
<!-- menu -->
<?php if($currentUser): ?>
                <nav style=" margin-top:-100px;margin-left:500px " class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="index.php"><strong>Trang cá nhân</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <?php if($currentUser): ?>
                        <li class="nav-item <?php echo $page=='sum'?'active':'' ?>">
                            <a class="nav-link" href="Banbe.php">Bạn bè</a>
                        </li>
                    <?php endif;?>          
                    <?php if(!$currentUser): ?>
                    <li class="nav-item <?php echo $page=='Register'?'active':'' ?>">
                            <a class="nav-link" href="Register.php">Đăng ký</a>
                        </li>
                        <li class="nav-item <?php echo $page=='login'?'active':'' ?>">
                            <a class="nav-link" href="login.php">Đăng nhập</a>
                        </li>
                    <?php else:?>
                        <li class="nav-item <?php echo $page=='update-profile'?'active':'' ?>">
                            <a class="nav-link" href="update-profile.php">Cá nhân</a>
                        </li>
                        <li class="nav-item <?php echo $page=='logout'?'active':'' ?>">
                            <a class="nav-link" href="logout.php">Đăng xuất </a>
                        </li>
                        <li class="nav-item <?php echo $page=='chang-password'?'active':'' ?>">
                            <a class="nav-link" href="chang-password.php">Đổi mật khẩu </a>
                        </li>
                    <?php endif;?>  
                    <?php endif; ?> 
                </div>
            </nav>
            
  
            <?php if(!$currentUser): ?>
                <nav style=" margin-top:4px;" class="navbar navbar-expand-lg navbar-light">
                <a class="navbar-brand" href="index.php"><strong>Home</strong></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">       
                    <li class="nav-item <?php echo $page=='Register'?'active':'' ?>">
                            <a class="nav-link" href="Register.php">Đăng ký</a>
                        </li>
                        <li class="nav-item <?php echo $page=='login'?'active':'' ?>">
                            <a class="nav-link" href="login.php">Đăng nhập</a>
                        </li>
                    <?php endif; ?>
                </div>
            </nav>
            
    
  