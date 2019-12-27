<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="edit1.css">
<?php
//ob_start();
require_once 'init.php';
require_once 'Funtion.php';
$IDPost = $_POST['IDPost1'];
$content = $_POST['newContent'];
$UserID = $_POST['userid'];
// var_dump( $IDPost);
// var_dump( $UserID);
$stmt=$db->prepare("INSERT INTO comments (postid,userid,content) VALUES (? , ?,?)");
$stmt->execute(array($IDPost,$UserID,$content));
$id= $db->lastInsertId();
$t = LoadComment($IDPost);
foreach ($t as $row) {
    $us = findUserById($row['userid']);
?>
    <div class="div-show-comment">
        <?php echo' <img class="img-comment" src="data:image/jpeg;base64,'.base64_encode($us['avatar']).'" width="150px" height="150px"> '?>
        <?php echo' <li class="list-group-item list-group-item-primary"><a class="ten-comment" href="#">'.$us['displayName'].'</a> '.$row['content'].'</li> '?>
    </div>

<?php } ?>