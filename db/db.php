<?php
$db = new PDO('mysql:host=localhost;dbname=demo1;charset=utf8','root');
// truy vấn dữ liệu
// $stmt =$db->query("SELECT * FROM users");
// while($row =$stmt->Fetch(PDO::FETCH_ASSOC)){
//     echo $row['email'].':'.$row['displayName'];
// }
//chèn dữ liệu
// $displayName =$_GET['displayName'];
// $email =$_GET['email'];
// $password=$_GET['password'];
// $result =$db->exec("INSERT INTO users(displayName,email,password) VALUES('$displayName','$email','$password')");
// //lấy id mớ nhất
// $insertId= $db->lastInsertId();

// echo $insertId;

$password =123456;
$hashPassword=password_hash($password,PASSWORD_DEFAULT);
echo $hashPassword;
//
<?php if($currentUser): ?>
<p>Chào mừng <?php echo $currentUser['displayName']; ?> đã trỡ lại</p>
 <?php foreach($posts as $post): ?> 
<p><img src="avarta/<?php echo $post['userId']; ?>.jpg"></p>
<p><?php echo $post['displayName']; ?></p>
<p><?php echo $post['content']; ?></p>
<p><?php echo $post['createAt']; ?></p> 

 <div class="card" style="width: 18rem;">
  <img class="card-img-top" src="..." alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">Card title</h5>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="btn btn-primary">Go somewhere</a>
  </div>
</div> 