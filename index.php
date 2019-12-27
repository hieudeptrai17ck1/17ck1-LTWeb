<?php

require_once 'init.php';
$posts = getNewfeeds();
$setid = $currentUser;
?>
<?php include 'Header.php'; ?>
<br>
<?php if ($currentUser) : ?>
    <form class="frm" action="upstatus.php" method="POST" enctype="multipart/form-data">
        <label for="content"><strong>Nội dung</strong></label>
        <textarea class="form-control" name="content" id="content" rows="3" placeholder="Bạn đang nghĩ gì?"></textarea>
        <input type="file" id="contentIMG" name="contentIMG">

        <button type="submit" name="btn" class="btn btn-primary">Đăng</button>
    </form>
    <br><br><br><br><br><br><br><br><br><br><br><br> <br><br><br><br>

    <div class="row">
        <?php $dem = 0?>
        <?php foreach ($posts as $post) : ?>
            <?php $dem++ ?>
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <table>
                                <td><?php
                                    echo ' <img style="border-radius:100px;boder:1px solid #ddd"  src="data:image/jpeg;base64,' . base64_encode($post['avatar']) . '" height="50px" width="50px"/>';
                                    ?></td>
                                <td> <?php echo '<a href="profile-user.php?id='.$post['userId'].'">'.$post['displayName'].'</a>';?>
                        </h5><br>
                        <small> Đăng lúc: <?php echo $post['createdAt']; ?> </small></td>
                        <td style="margin-left:200px">
                            <?php
                            if ($setid['id'] == $post['userId']) {
                                $id_xoa = $post['id'];
                                echo ' <a class="xoa"  href="removeStatus.php?id=' . $id_xoa . '" >Xoa Bai viet</a>  </td></table>';
                            } else {
                                echo ' <a class="xoa"  href="index.php" >Xoa Bai viet</a>  </td></table>';
                            }

                            ?>
                            </p>
                            <?php if ($post['contentIMG'] != null && $post['content'] != null) : ?>
                                <p class="card-text">
                                    <?php echo $post['content']; ?><br>
                                </p>
                                <p class="card-text">
                                    <?php echo '<img style="boder:1px solid #ddd"  src="data:image/jpeg;base64,' . base64_encode($post['contentIMG']) . '" height="200px" width="200px"/>'; ?>
                                </p>
                            <?php else : ?>
                                <?php if ($post['content'] != null && $post['contentIMG'] == null) : ?>
                                    <p class="card-text">
                                        <?php echo $post['content']; ?><br>
                                    </p>
                                <?php else : ?>
                                    <p class="card-text">
                                        <?php echo ' <img style="boder:1px solid #ddd"  src="data:image/jpeg;base64,' . base64_encode($post['contentIMG']) . '" height="200px" width="200px"/>'; ?>
                                    </p>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php
                            $id_like = $post['id'];
                            $like = count(CheckLike($id_like, $_SESSION['userID']));
                            if ($like > 0) {
                                echo '<div><img class="imgLike" src="image/facebook-reaction-buttons-png.png" alt=""> <h3 class="countLike" id ="slLike' . $dem . '">' . count(CountLike($id_like)) . ' </h3> <hr class = "hr1"></div>';
                                echo '<div class ="divLike">
                                        <button class="aaaa1" name ="' . 'li' . $id_like . $_SESSION['userID'] . $dem . '0' . count(CountLike($id_like)) . '" id="btnLike">Like<i style = "color :#0CA9FF;" id="IconLike' . $dem . '" class="fa fa-thumbs-up"></i> </button>
                                        <button class="cl-cm" name ="' .  $id_like . $_SESSION['userID'] . $dem . '" id="btnComment">Comment<i style = "color : aqua;" id="IconLike' . $dem . '" class="fa fa-comment"></i> </button>
                                      </div>';
                            } else {
                                echo '<div><img class="imgLike" src="image/facebook-reaction-buttons-png.png" alt=""> <h3 class="countLike" id ="slLike' . $dem . '">' . count(CountLike($id_like)) . ' </h3> <hr class = "hr1"></div>';
                                echo '<div class ="divLike">
                                        <button class="aaaa1" name ="' . 'li' . $id_like . $_SESSION['userID'] . $dem . '1' . count(CountLike($id_like)) . '" id="btnLike">Like<i style = "color :aqua;" id="IconLike' . $dem . '" class="fa fa-thumbs-up"></i> </button>
                                        <button class="cl-cm" name ="' .  $id_like . $_SESSION['userID'] . $dem . '" id="btnComment">Comment<i style = "color : aqua;" id="IconLike' . $dem . '" class="fa fa-comment"></i> </button>
                                      </div>';
                            }
                            ?>
                            <hr class="hr-comment">
                            <div>
                                <div id="div-comment<?php echo $dem ?>" class="div-comment1" class="input-group flex-nowrap">
                                </div>
                                <div class="div-us-comment">
                                    <?php $us = findUserById($currentUser['id']) ?>
                                    <?php echo' <img class="img-comment" src="data:image/jpeg;base64,'.base64_encode($us['avatar']).'" width="150px" height="150px"> '?>
                                    <input name="text-comment" id="ip-comment<?php echo $dem ?>" type="text" class="form-control" placeholder="Comment..." aria-label="Username" aria-describedby="addon-wrapping">
                                    <button id="btn-comment" class="BTN-comment" name="<?php echo $id_like . $_SESSION['userID'] . $dem ?>">Comment</button>
                                </div>
                            </div>
                            <?php
                            ?>
                    </div>
                </div>
                <br>
            </div>
        <?php endforeach ?>
    </div>
<?php endif ?>
<br>
<?php include 'Footer.php'; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    //jQuery
    $(document).ready(function() {
        var commentCount = 2;
        var tem2 = 0;
        var tem1 = '3';
        var nLike = 0;

        $(".BTN-comment").click(function() {
            var temp = $(this).attr("name");
            var idpost = temp.slice(0, 3);
            var us = temp.slice(3, 5);
            var stt = temp.slice(5, temp.length);
            var t2 = $("#ip-comment"+stt).val();
            console.log(temp);
            console.log(idpost, us, stt,t2);
            $("#ip-comment"+stt).val('');
            $("#div-comment" + stt).load("add-comment.php", {
                IDPost1: idpost,
                newContent :t2,
                userid: us
            });
        });

        $(".aaaa1").click(function() {
            var temp = $(this).attr("name");
            var ktBTN = temp.slice(0, 2);
            var idpost = temp.slice(2, temp.length - 5);
            var us = temp.slice(temp.length - 5, temp.length - 3);
            var stt = temp.slice(temp.length - 3, temp.length - 2);
            var tinhtrang = temp.slice(temp.length - 2, temp.length - 1);
            nLike = parseInt(temp.slice(temp.length - 1, temp.length))
            var ct = -1;
            if ($("#IconLike" + stt).css('color') == 'rgb(12, 169, 255)') {
                if (tinhtrang == 0) {
                    nLike--;

                    $("#slLike" + stt).text(nLike);

                } else {
                    $("#slLike" + stt).text(nLike);
                }
                $("#IconLike" + stt).css('color', 'aqua');
                ct = 0;

            } else {
                if (tinhtrang == 0) {
                    $("#slLike" + stt).text(nLike);
                } else {
                    nLike++;
                    $("#slLike" + stt).text(nLike);
                }
                $("#IconLike" + stt).css('color', '#0CA9FF');
                ct = 1;
            }
            $("#aaaa").load("like1.php", {
                IDPost1: idpost,
                CongTru: ct,
                userid: us
            });

        });
        $(".cl-cm").click(function() {
            var temp = $(this).attr("name");
            var idpost = temp.slice(0, 3);
            var us = temp.slice(3, 5);
            var stt = temp.slice(5, temp.length);
            console.log(idpost, us, stt);
            $("#div-comment" + stt).load("load-comment.php", {
                IDPost1: idpost,
                userid: us
            });
            $("#div-comment" + stt).show();


        });


        // if (tinhtrang=='1' || tem1=='1') {
        //     tem1=0;
        //     $("#IconLike"+stt).css("color", "#0CA9FF");
        //     if(tem2!=0)
        //     {
        //         $("#slLike"+stt).text(nLike);
        //     }
        //    else
        //    {
        //        nLike++;
        //        $("#slLike"+stt).text(nLike);
        //        tem2=1;
        //    }

        // } else {
        //     $("#IconLike"+stt).css("color", "aqua");
        //     if(tem2!=0)
        //     {
        //         nLike--;
        //         $("#slLike"+stt).text(nLike);
        //     }
        //    else
        //    {
        //        nLike--;
        //        $("#slLike"+stt).text(nLike);
        //        tem2=1;
        //    }
        //     tem1='1';
        // }



        // commentCount = commentCount + 2;
        // $("#comments").load("load-comments.php", {
        //     commentNewCount: commentCount
        // });
        // $("#comments").load("test/funtion.php");
    });
</script>