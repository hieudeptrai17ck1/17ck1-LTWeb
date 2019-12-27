<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();     
    }
    $fullSelect =SelectFriendById($currentUser['id']);//từ mình
?>
 <?php include 'Header.php';?>
 <form style="margin-left:600px;background-color: aquamarine" >
    <h5 style="margin-top:100px" >
        <?php
            echo '<center>Thông báo</center>';
            foreach($fullSelect as $row)
            {
                $NameuserSend=findUserById($row['userId1']);
                echo '<h6>Bạn có  yêu cầu kết bạn từ <a href="profile.php?id='.$row['userId1'].'">'.$NameuserSend['displayName'].'</a> </h4>';
            }          
        ?>
    </h5>
 </form>

<div style="margin-top:100px">
    <h3>Danh sách bạn bè</h3>
    <?php
        foreach($fullSelect as $row1)
        {
            $isfollowing=getFriendship($currentUser['id'],$row1['userId1']);
            $isfollower=getFriendship($row1['userId1'],$currentUser['id']);
            $NameuserSend1=findUserById($row1['userId1']);
            //nếu là bạn bè
            if( $isfollowing&&$isfollower)   
            {
                echo '<img  src="data:image/jpeg;base64,'.base64_encode( $NameuserSend1['avatar'] ).'" width="100px" height="100px" style="border-radius:250px;boder:1px solid #ddd; margin-left:20px"/><a href="profile.php?id='.$row1['userId1'].'">'.$NameuserSend1['displayName'].'</a>';
            }    
        }
    ?>
</div>
<?php include 'Footer.php';?>


