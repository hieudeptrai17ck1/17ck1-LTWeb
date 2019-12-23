<?php
    ob_start();
    require_once 'init.php';  
    if(!$currentUser)
    {
        header('location: index.php');
        exit();
    }
    $id=$_GET['id'];
    $postId=getStatus($id);
    echo var_dump($postId); 
    $fillLike = $postId['fillLike'];
    $countLike = $postId['countLike'];
    $idUser = $postId['userId'];

    //lấy id người đang đăng nhập
    $userId = $currentUser['id'];
   
    header('location: index.php'); 

    if($idUser==$userId)
    {
        if($fillLike==0)
        {       
            $count = $countLike+1;
            $fillLike=1;
            $cc=likeStatus($id,$count,$fillLike);
            return $cc;
        }
        else
        {
            
            if($countLike>0)
            {
                $count = $countLike-1;
                $fillLike=0;
                $cc=likeStatus($id,$count,$fillLike);
                return $cc;
            }
            else
            {
                if($countLike==0)
                {
                    $count = $countLike;
                    $fillLike=0;
                    $cc=likeStatus($id,$count,$fillLike);
                    return $cc;
                }
            }
        }
    }
    else
    {
        
        if($fillLike==1)
         {  
            
            $count = $countLike+1;
            $fillLike=0;
            $cc=likeStatus($id,$count,$fillLike);
            return $cc;
        }
        else
        {
            if($fillLike==0)
            {
                if($countLike>0)
                {
                    $count = $countLike-1;
                    $fillLike=1;
                    $cc=likeStatus($id,$count,$fillLike);
                    return $cc;
                }
                else
                {
                    if($countLike==0)
                    $count = $countLike;
                    $fillLike=1;
                    $cc=likeStatus($id,$count,$fillLike);
                    return $cc;
                }
               
            }
            else
            {
                if($fillLike==1)
                {
                    if($countLike>0)
                    {
                        $count = $countLike-1;
                        $fillLike=0;
                        $cc=likeStatus($id,$count,$fillLike);
                        return $cc;
                    }
                    else
                    {
                        if($countLike==0)
                        {
                            $count = $countLike;
                            $fillLike=0;
                            $cc=likeStatus($id,$count,$fillLike);
                            return $cc;
                        }
                    }
                 
                }  
            }
           
        }
    }


   

 
    
 
