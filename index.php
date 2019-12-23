<?php   
    
    require_once 'init.php';   
    $posts =getNewfeeds();
    $setid=$currentUser;
?>
 <?php include 'Header.php';?>
 <br>
    <?php  if ($currentUser): ?>     
                <form class="frm"  action="upstatus.php" method="POST" enctype= "multipart/form-data" >
                        <label for="content"><strong>Nội dung</strong></label>
                        <textarea class="form-control" name="content" id="content" rows="3"placeholder="Bạn đang nghĩ gì?"></textarea>		
                        <input  type="file"  id="contentIMG" name="contentIMG">
                   
                    <button type="submit" name ="btn" class="btn btn-primary">Đăng</button>
                </form>
        <br><br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br>       

<div class="row">
<?php foreach ($posts as $post):?>
    <div style="" class="col-sm-12">
        <div  class="card" >  
            <div class="card-body">
            <h5 class="card-title">
            <table><td><?php
                echo ' <img style="border-radius:100px;boder:1px solid #ddd"  src="data:image/jpeg;base64,'.base64_encode( $post['avatar'] ).'" height="50px" width="50px"/>';                
            ?></td>   <td> <?php echo $post['displayName'];?></h5><br>
            <small> Đăng lúc: <?php echo $post['createdAt'];?> </small></td>  <td style="marrgin-left:200px">
            <?php
                if($setid['id']==$post['userId']) 
                {
                    $id_xoa= $post['id'];
                    echo' <a class="xoa"  href="removeStatus.php?id='.$id_xoa.'" >Xoa Bai viet</a>  </td></table>';    
                }
                else
                {
                    echo' <a class="xoa"  href="index.php" >Xoa Bai viet</a>  </td></table>';  
                }
                  
            ?> 
            </p>
            <?php if($post['contentIMG']!= null && $post['content']!= null ): ?>
            <p class="card-text">
                <?php echo $post['content'];?><br>
            </p>
            <p class="card-text">
                <?php echo ' <img style="boder:1px solid #ddd"  src="data:image/jpeg;base64,'.base64_encode($post['contentIMG']).'" height="200px" width="200px"/>';?>
            </p>
            <?php else: ?>
                <?php if($post['content']!= null && $post['contentIMG']== null ): ?>
                    <p class="card-text">
                        <?php echo $post['content'];?><br>
                    </p>          
                <?php else: ?>
                    <p class="card-text">
                    <?php echo ' <img style="boder:1px solid #ddd"  src="data:image/jpeg;base64,'.base64_encode($post['contentIMG']).'" height="200px" width="200px"/>';?>
                </p>
                <?php endif; ?>          
            <?php endif; ?>
                <?php
                    // $id_like = $post['id'];
                    // echo $post['likeFill'].'<a class="like"  href="likeStatus.php?id='.$id_like.'">'.$post['tinhTrang'].'</a>';
                        if($post['userId']==$setid['id'])
                        {
                            if($post['fillLike']==0)
                            {
                                $id_like = $post['id'];
                                echo $post['countLike'].' <a class="like"  href="like.php?id='.$id_like.'">Like</a>';
                            }
                            else
                            {
                                if($post['fillLike']==1)
                                {
                                    $id_like = $post['id'];
                                    echo $post['countLike'].' <a class="like"  href="like.php?id='.$id_like.'">Dislike</a>';
                                }
                            }
                        }
                        else
                        {
                            if($post['fillLike']==1)
                            {
                                $id_like = $post['id'];
                                echo $post['countLike'].' <a class="like"  href="like.php?id='.$id_like.'">Dislike</a>';
                            }
                            else
                            {
                                if($post['fillLike']==0)
                                {
                                    $id_like = $post['id'];
                                    echo $post['countLike'].' <a class="like"  href="like.php?id='.$id_like.'">Like</a>';
                                }
                            }
                        }
                ?>
            </div>
        </div>
        <br>
    </div>
<?php endforeach ?>
</div>
<?php endif?>
<br>
<?php include 'Footer.php';?>

