<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }

    $userId = $_GET['id'];
    $profile = findUserById($userId);
    $isfollowing=getFriendship($currentUser['id'],$userId);
    $isfollower=getFriendship($userId,$currentUser['id']);
?>

<?php include 'Header.php';?>
<br><br><br><br><br>

    <h1>
        <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode( $profile['avatar'] ).'" width="150px" height="150px" style="border-radius:250px;boder:1px solid #ddd; margin-left:20px"/>'; echo $profile ['displayName'];  ?>
        <?php if($isfollowing && $isfollower): ?>
            <h2 style="color:blue; margin-top:-700px;margin-left:390px">Bạn bè</h2>
                <form  method="POST" action="remove-friend.php">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit"class="btn btn-primary">Xóa bạn</button>
                </form>
        <?php else: ?>
            <?php if($isfollowing && !$isfollower): ?>
                <form method="POST" action="remove-friend.php">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit"class="btn btn-primary">Xóa yêu cầu kết bạn</button>
                </form>
        <?php endif;?>
            <?php if(!$isfollowing && $isfollower): ?>
                <form method="POST" action="remove-friend.php">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit"class="btn btn-primary">Hủy yêu cầu kết bạn</button>
                </form>
                <form method="POST" action="add-friend.php">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit"class="btn btn-primary">Đồng ý kết bạn</button>
                </form>
            <?php endif;?>
            <?php if(!$isfollowing && !$isfollower): ?>
                <form method="POST" action="add-friend.php">
                    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                    <button type="submit"class="btn btn-primary">Gửi yêu cầu kết bạn</button>
                </form>
            <?php endif;?>
        <?php endif;?>
    </h1>
<?php include 'Footer.php';?>
