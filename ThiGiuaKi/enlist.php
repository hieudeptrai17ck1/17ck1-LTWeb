<html>
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">;
 <style>   
    form {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            padding: 30px;
            background-color: pink;
            opacity: 0.9;
            box-sizing: border-box;
            box-shadow: 0 15px 25px rgba(0,0,0,.5);
            border-radius: 10px;  
        }
 </style>
</head>
<?php
    $db = new PDO('mysql:host=localhost;dbname=thigk;charset=utf8','root');
?>
<?php if(isset($_POST['fullname'])&&isset($_POST['email'])):?>
<?php
    $fullname=$_POST['fullname'];
    $email=$_POST['email'];

    $success =false;
    function findUserByEmail($email)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM thongtin WHERE email=?");
        $stmt->execute(array($email));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    $user=findUserByEmail($email);
   if(!$user)
   {
       $stmt = $db->prepare("INSERT INTO thongtin(fullname,email) VALUES(?,?)");
       $stmt->execute(array($fullname,$email));
       $newUserId=$db->lastInsertId();
       $_SESSION['userId']=$newUserId;
       $success=true;
   }
?>

<?php if($success): ?>
            <?php header('location: list.php'); ?>
            <a href="list.php">Đi đến trang xem danh sách người đăng ký</a>
<?php else:?>
    <div class="alert alert-denger"role="alert">
            Đăng ký thất bại
    </div>
<?php endif; ?>
<?php else: ?>
<h2 class="a"><center><strong>Đăng Ký tài khoản</strong></center></h2>
    <form action="enlist.php"method ="POST">
        <div class="form-group">
            <label for="fullname">Tên người mua</label>
            <input type="text"class="form-control"id="fullname"name="fullname" placeholder="Họ tên">
        </div>
        <div class="form-group">
            <label for="Sodienthoai">email</label>
            <input type="email"class="form-control"id="email"name="email" placeholder="email">
        </div>
        <button type="submit"class="btn btn-primary">Đăng ký</button>
    </form>
    <?php endif; ?>

</html>