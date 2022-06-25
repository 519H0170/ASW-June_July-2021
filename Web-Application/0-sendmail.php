
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
function sendActivationEmail($email, $token)
{

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'hungmafia96@gmail.com';             //SMTP username

        // password hoặc app password Google nếu bật 2 bước
        $mail->Password   = 'zdpxwwnoxjflfrgk';                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('hungmafia96@gmail.com', 'Admin web ban hang');
        $mail->addAddress($email, 'Người nhận');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Xác minh tài khoản của bạn';
        $mail->Body    = "<a href='http://localhost:8080/reg_author.php?email=$email&token=$token'><button> Xác minh tài khoản </button></a>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function sendResetEmail($email, $token)
{

    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'hungmafia96@gmail.com';             //SMTP username

        // password hoặc app password Google nếu bật 2 bước
        $mail->Password   = 'zdpxwwnoxjflfrgk';                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('hungmafia96@gmail.com', 'Admin web ban hang');
        $mail->addAddress($email, 'Người nhận');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Khôi phục mật khẩu';
        $mail->Body    = "<a href='http://localhost:8080/passwordreset.php?email=" . md5($email) . "&token=$token'><button> Khôi phục mật khẩu </button></a>";
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

function activeAccount($email, $token)
{
    $username = "root"; // Khai báo username
    $password = "";      // Khai báo password
    $server   = "localhost";   // Khai báo server
    $dbname   = "simulatestore";      // Khai báo database
    $conn = mysqli_connect($server, $username, $password, $dbname);
    $deltoken = "DELETE FROM regaccount where username='$email' and token='$token'";
    $result = mysqli_query($conn, $deltoken);
    $activeuser = "UPDATE account SET `Activate` = 'active' where user='$email'";
    $result = mysqli_query($conn, $activeuser);
    // $conn = open_database();
    // $stm = $conn->prepare($sql);
    // $stm->bind_param('ss', $email, $token);

    // if (!$stm->execute()) {
    //     return array('code' => 1, 'error' => 'Can not execute command');
    // }

    // $result = $stm->get_result();
    // if ($result->num_rows == 0) {
    //     return array('code' => 2, 'error' => 'Email address or token not found');
    // }

    // FOUND
    // $sql = "update account set activated =1, activate_token = '' where email = ?";
    // $stm = $conn->prepare($sql);
    // $stm->bind_param('s', $email);
    // if (!$stm->execute()) {
    //     return array('code' => 1, 'error' => 'Cannot execute command');
    // }

    // return array('code' => 0, 'message' => 'Account activated');
}

// function reset_password($email)
// {
//     if (!is_email_exists($email)) {
//         return array('code' => 1, 'error' => 'Email does not exist');
//     }
//     $token = md5($email . '+' . random_int(1000, 2000));
//     $sql = 'update reset_token set token = ? where email = ?';

//     $conn = open_database();
//     $stm = $conn->prepare($sql);
//     $stm->bind_param('ss', $token, $email);

//     if (!$stm->execute()) {
//         return array('code' => 2, 'error' => 'Can not execute command');
//     }

//     if ($stm->affected_rows == 0) {
//         // CHUA CO DONG NAO CUA EMAIL NAY, TA SE THEM VAO DONG MOI  
//         $exp = time() + 3600 * 24;

//         $sql = 'insert into reset_token values (?,?,?)';
//         $stm->prepare($sql);
//         $stm->bind_param('ssi', $email, $token, $exp);

//         if (!$stm->execute()) {
//             return array('code' => 1, 'error' => 'Can not execute command');
//         }

//         //Chèn thành công hoặc update thành công token của dòng đã có
//         // bây giờ gửi email tới user để họ reset password
//         $success = sendResetEmail($email, $token);
//         return array('code' => 0, 'success' => $success);
//     }
// }
?>
