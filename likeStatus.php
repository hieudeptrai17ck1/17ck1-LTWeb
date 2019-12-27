<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }
    $id=$_GET['id'];
// lấy thoog tin bảng post
    $id_post=getStatus($id);
    $postId = $id_post['id'];
    $userId = $id_post['userId'];
    $userCur = $currentUser['id'];
    //chèn dữ liệu bảng like
    upLike($id,$userId);
    //lấy thông tin bảng like
    $id_like = getLike($id);
    $idLike_port = $id_like['postId'];
    $idLike_user = $id_like['userId'];
    $likeFill=$id_like['likeFill'];
    $tinhTrang = $id_like['tinhTrang'];
    header('location: index.php');  

    $temp = 'Dislike';
   if($idLike_user == $userCur)
   {
       if($tinhTrang=='Like')
       {
           $likeFill =$likeFill+1;
           $tinhTrang = 'Dislike';
           changeLike($idLike_port,$idLike_user,$likeFill,$tinhTrang);
       }
       else
       {
            if($tinhTrang=='Dislike')
            {
                $likeFill =$likeFill-1;
                $tinhTrang = 'Like';
                changeLike($idLike_port,$idLike_user,$likeFill,$tinhTrang);
            }
       }
   }
   else
   {
        if($temp=='Dislike')
        {
            $likeFill =$likeFill+1;
            $tinhTrang = 'Like';
            $temp='Dislike';
            changeLike($idLike_port,$idLike_user,$likeFill,$tinhTrang);
        }
        else
        {
            if($temp=='Dislike')
            {
                $likeFill =$likeFill-1;
                $tinhTrang = 'Dislike';
                $temp='Like';
                changeLike($idLike_port,$idLike_user,$likeFill,$tinhTrang);
            }
            else
            {
                $temp=='Like';
                $likeFill =$likeFill+1;
                $tinhTrang = 'Dislike';
                $temp='Like';
                changeLike($idLike_port,$idLike_user,$likeFill,$tinhTrang);
            }
        }     
   }
  

    
    


    //lấy id người đang đăng nhập
    
   
   

