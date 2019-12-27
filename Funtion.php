
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
    require './vendor/autoload.php';
    require_once 'init.php';
    function sum($a,$b)
    {
        $c=$a+$b;
        return $c;
    }
    function CountLike($idPost)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM likes WHERE postid=?");
        $stmt->execute(array($idPost));
        return $stmt -> fetchALL(PDO::FETCH_ASSOC);
    }
    function CheckLike($idPost,$userID)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM likes WHERE userid =? AND postid=?");
        $stmt->execute(array($userID,$idPost));
        return $stmt -> fetchALL(PDO::FETCH_ASSOC);
    }
    function LoadComment($idPost)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM comments WHERE postid=?");
        $stmt->execute(array($idPost));
        return $stmt -> fetchALL(PDO::FETCH_ASSOC);
    }
    function SelectFriendById($userId2)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM freindship where userId2=?");
        $stmt->execute(array($userId2));
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function detecPage()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $parts =explode('/',$uri);
        $fileName = $parts[2];
        $parts = explode('.',$fileName);
        $page =$parts[0];
        return $page;
    }
    //tim user
    function findUserByEmail($email)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM users WHERE email=?");
        $stmt->execute(array($email));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function findUserById($id)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM users WHERE id=?");
        $stmt->execute(array($id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function updateUserProfile($id,$displayName,$ngaySinh,$phoneNumber,$avatar)
    {
        global $db;
        $stmt =$db->prepare("UPDATE users SET displayName=?,ngaySinh=?,phoneNumber =?,avatar=? WHERE id=? ");
        $stmt->execute(array($displayName,$ngaySinh,$phoneNumber,$avatar,$id));
    }
     
    function UpdateUserPassword($id, $password){
        global $db;
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $stmt=$db->prepare("UPDATE users SET password= ? WHERE id= ?");
        return $stmt->execute(array($hashPassword,$id));
    }
    


    function createUser($displayName,$email,$password){
        global $db;
        $hashPassword = password_hash($password,PASSWORD_DEFAULT);
        $code =generateRandomString(16);
        $stmt=$db->prepare("INSERT INTO users (displayName,email,password,status,code) VALUES (? , ?, ?,?,?)");
        $stmt->execute(array($displayName,$email,$hashPassword,0,$code));
       $id= $db->lastInsertId();
       $id =sendEmail($email,$displayName,'kích hoạt tài khoản',"mã kích hoạt tài khoản của bạn là <a href=\"http://localhost:81/PhanTrang/activate.php?code=$code\">http://localhost:8080/PhanTrang/activate.php?code=$code</a>");
       return $id;
    }

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function activateUser($code)
    {
        global $db;
        $stmt =$db->prepare("SELECT * FROM users WHERE code=? AND status=?");
        $stmt->execute(array($code,0));
        $user= $stmt->fetch(PDO::FETCH_ASSOC);
        if($user && $user['code']==$code)
        {
            $stmt=$db->prepare("UPDATE users SET code= ?, status=? WHERE id= ?");
            $stmt->execute(array('',1,$user['id']));
            return true;
        }
        return false;
    }

    function sendEmail($to,$name,$subject,$content)
    {
                $mail = new PHPMailer(true);

                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();  
                $mail->CharSet='UTF-8';                                          // Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'ltweb12201@gmail.com';                     // SMTP username
                $mail->Password   = '123456Aa@';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
                $mail->Port       = 587;                                    // TCP port to connect to

                //Recipients
                $mail->setFrom('ltweb12201@gmail.com', 'hieu dep trai');
                $mail->addAddress($to, $name);     // Add a recipient


                // Content
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $content;
                //$mail->AltBody = $content;

                $mail->send();
 
    }
 function resizeImage($filename, $max_width, $max_height)
{
  list($orig_width, $orig_height) = getimagesize($filename);

  $width = $orig_width;
  $height = $orig_height;

  # taller
  if ($height > $max_height) {
      $width = ($max_height / $height) * $width;
      $height = $max_height;
  }

  # wider
  if ($width > $max_width) {
      $height = ($max_width / $width) * $height;
      $width = $max_width;
  }

  $image_p = imagecreatetruecolor($width, $height);

  $image = imagecreatefromjpeg($filename);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

  return $image_p;
}
 function  getNewfeeds(){
    global $db;
    $stmt=$db->query("SELECT u.displayName,u.avatar,p.*FROM users AS u JOIN posts as p on u.id= p.userId");//ORDER BY p.createdAt DESC  JOIN likes as l on l.postId = p.id  
    $stmt->execute(array());
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
//status
function upstatus($userId,$content,$contentIMG,$countLike,$fillLike){
    global $db;
    $stmt=$db->prepare("INSERT INTO posts (content,contentIMG,countLike,fillLike,userId) VALUES (? , ?, ?,?,?)");
    $stmt->execute(array($content,$contentIMG,0,0,$userId));
   return $db->lastInsertId();
}

function upstatus1($userId,$content,$countLike,$fillLike){
    global $db;
    $stmt=$db->prepare("INSERT INTO posts (content,userId,countLike,fillLike) VALUES (? , ?,?,?)");
    $stmt->execute(array($content,$userId,0,0));
   return $db->lastInsertId();
}

function removeStatus($id)
{
    global $db;
    $stmt=$db->prepare("DELETE from  posts where id=?");
    $stmt->execute(array($id));
}

function getStatus($id)
{
    global $db;
    $stmt =$db->prepare("SELECT * FROM posts WHERE id=? ");
    $stmt->execute(array($id));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function likeStatus($id,$countLike,$fillLike)
{
    global $db;
    $stmt=$db->prepare("UPDATE posts SET countLike= ?, fillLike =? WHERE id= ?");
    $stmt->execute(array($countLike,$fillLike,$id));
}
//like
function upLike($postId,$userId)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO likes (postId,userId) value(?,?)");
    $stmt->execute(array($postId,$userId));
    return $db->lastInsertId();
}

function changeLike($postId,$userId,$likeFill,$tinhTrang)
{
    global $db;
    $stmt=$db->prepare("UPDATE likes SET likeFill= ?, tinhTrang =? WHERE postId= ? and userId=?");
    $stmt->execute(array($likeFill,$tinhTrang,$postId,$userId));
}

function getLike($portId)
{
    global $db;
    $stmt =$db->prepare("SELECT * FROM likes WHERE postId=? ");
    $stmt->execute(array($portId));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
//like



//status

//friend
function sendFriendRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("INSERT INTO freindship (userId1,userId2) value(?,?) ");
    $stmt->execute(array($userId1,$userId2));
}

function getFriendship($userId1,$userId2)
{
    global $db;
    $stmt =$db->prepare("SELECT * FROM freindship WHERE userId1=? AND userId2=?  ");
    $stmt->execute(array($userId1,$userId2));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function removeFriendRequest($userId1,$userId2)
{
    global $db;
    $stmt=$db->prepare("DELETE from  freindship where (userId1=? AND userId2=?) or(userId2=? AND userId1=?)");
    $stmt->execute(array($userId1,$userId2,$userId1,$userId2));
}
//friend


function findUserByName($displayName)
{
    global $db;
    $stmt =$db->prepare("SELECT * FROM users WHERE displayName=?");
    $stmt->execute(array($displayName));
    return $stmt->fetch(PDO::FETCH_ASSOC);
}