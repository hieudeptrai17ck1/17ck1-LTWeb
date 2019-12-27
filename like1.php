<?php
    //ob_start();
    require_once 'init.php';  
    // if(!$currentUser)
    // {
    //     header('location: index.php');
    //     exit();
    // }
  //  header('location: index.php'); 
    $IDPost =$_POST['IDPost1'];
    $ct =$_POST['CongTru'];
    $UserID = $_POST['userid'];
    global $db;
    if($ct==1)
    {
        $stmt=$db->prepare("INSERT INTO likes (postid,userid) VALUES (? , ?)");
        $stmt->execute(array($IDPost,$UserID));
        $id= $db->lastInsertId();
    }
    else
    {
        
        $stmt=$db->prepare("DELETE FROM likes WHERE postid=? AND userid=?");
        $stmt->execute(array($IDPost,$UserID));
       // $stmt = $this->$db->prepare($sql)
       // $id= $stmt->execute();
    }
  

    // $id=$_GET['id'];
    // $postId=getStatus($id);
    // echo var_dump($postId); 
    // $fillLike = $postId['fillLike'];
    // $countLike = $postId['countLike'];
    // $idUser = $postId['userId'];

    // //lấy id người đang đăng nhập
    // $userId = $currentUser['id'];
   
   

    // if($idUser==$userId)
    // {
    //     if($fillLike==0)
    //     {       
    //         $count = $countLike+1;
    //         $fillLike=1;
    //         $cc=likeStatus($id,$count,$fillLike);
    //         return $cc;
    //     }
    //     else
    //     {
            
    //         if($countLike>0)
    //         {
    //             $count = $countLike-1;
    //             $fillLike=0;
    //             $cc=likeStatus($id,$count,$fillLike);
    //             return $cc;
    //         }
    //         else
    //         {
    //             if($countLike==0)
    //             {
    //                 $count = $countLike;
    //                 $fillLike=0;
    //                 $cc=likeStatus($id,$count,$fillLike);
    //                 return $cc;
    //             }
    //         }
    //     }
    // }
    // else
    // {
        
    //     if($fillLike==1)
    //      {  
            
    //         $count = $countLike+1;
    //         $fillLike=0;
    //         $cc=likeStatus($id,$count,$fillLike);
    //         return $cc;
    //     }
    //     else
    //     {
    //         if($fillLike==0)
    //         {
    //             if($countLike>0)
    //             {
    //                 $count = $countLike-1;
    //                 $fillLike=1;
    //                 $cc=likeStatus($id,$count,$fillLike);
    //                 return $cc;
    //             }
    //             else
    //             {
    //                 if($countLike==0)
    //                 $count = $countLike;
    //                 $fillLike=1;
    //                 $cc=likeStatus($id,$count,$fillLike);
    //                 return $cc;
    //             }
               
    //         }
    //         else
    //         {
    //             if($fillLike==1)
    //             {
    //                 if($countLike>0)
    //                 {
    //                     $count = $countLike-1;
    //                     $fillLike=0;
    //                     $cc=likeStatus($id,$count,$fillLike);
    //                     return $cc;
    //                 }
    //                 else
    //                 {
    //                     if($countLike==0)
    //                     {
    //                         $count = $countLike;
    //                         $fillLike=0;
    //                         $cc=likeStatus($id,$count,$fillLike);
    //                         return $cc;
    //                     }
    //                 }
                 
    //             }  
    //         }
           
    //     }
    //}


   

 
    
 
