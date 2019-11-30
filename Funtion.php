
<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
    
    require_once 'init.php';
    function sum($a,$b)
    {
        $c=$a+$b;
        return $c;
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

    function updateUserProfile($id,$displayName)
    {
        global $db;
        $stmt =$db->prepare("UPDATE users SET displayName=? WHERE id=?");
        $stmt->execute(array($displayName,$id));
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
       $id =sendEmail($email,$displayName,'kích hoạt tài khoản',"mã kích hoạt tài khoản của bạn là <a href=\"http://localhost:8080/PhanTrang/activate.php?code=$code\">http://localhost:8080/PhanTrang/activate.php?code=$code</a>");
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
