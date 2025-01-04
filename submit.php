<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $domain = htmlspecialchars($_POST['domain']);
    $quote = htmlspecialchars($_POST['quote']);
    $contact = htmlspecialchars($_POST['contact']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // 服务器设置
        $mail->isSMTP();
        // smtp服务器
        $mail->Host = 'smtp.163.com';
        $mail->SMTPAuth = true;
        // smtp账户
        $mail->Username = 'xxxxx@163.com';
        // smtp密码
        $mail->Password = 'xxxxx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        // smtp端口
        $mail->Port = 25;

        // 发件人账户
        $mail->setFrom('xxxxx@163.com', $domain);
        // 收件人邮箱
        $mail->addAddress('xxxxx@qq.com', 'Recipient Name');

        // 内容
        $mail->isHTML(true);
        $mail->Subject = "$domain - 询价";
        $mail->Body    = "域名: $domain<br>报价: $quote<br>联系方式: $contact<br>留言: $message";

        $mail->send();
        header("Location: index.php?status=success");
    } catch (Exception $e) {
        header("Location: index.php?status=error");
    }
} else {
    echo "无效的请求方法。";
}
?> 