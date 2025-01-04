在这篇文章中，我将分享如何实现一个简单的域名停靠页面，并通过邮件发送功能来接收用户的询价信息。这个项目主要由两个文件组成：`index.php`和`submit.php`。下面，我将逐步介绍这两个文件的功能和实现细节。
## 实现域名停靠页面
首先，我需要一个简单而美观的网页来展示域名的出售信息，并提供一个表单供用户填写他们的报价和联系方式。这个页面的实现主要在`index.php`中完成。
在`index.php`中，我使用了`Bootstrap 4`来快速构建响应式布局，并引入了`Font Awesome`图标库来美化表单输入框。页面的核心部分是一个表单，用户可以在这里输入他们的报价、联系方式以及留言信息。
![123.png](https://www.1042.net/usr/uploads/2025/01/3427635394.png)
```html
// 省略的代码...
<body>
<iframe id="background-iframe" src="beij/beij.html" frameborder="0" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; overflow: hidden;"></iframe>

<div class="poetry-section" id="poetrySection">
  <form action="submit.php" method="post" class="p-5">
    <input type="hidden" name="domain" value="<?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?>">
    <h2 class="mb-3"><?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?></h2>
    <p class="mb-4">当前访问域名正在出售中，可以通过下方留言与我取得联系。</p>
    <?php if (isset($_GET['status'])): ?>
      <div class="alert alert-<?php echo $_GET['status'] == 'success' ? 'success' : 'danger'; ?>" role="alert">
        <?php echo $_GET['status'] == 'success' ? '邮件已发送成功！' : '邮件发送失败，请重试。'; ?>
      </div>
    <?php endif; ?>
    <div class="form-row">
      <div class="form-group col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-yen-sign"></i></span>
          </div>
          <input type="number" class="form-control" id="quote" name="quote" required placeholder="报价" style="background-color: rgba(255, 255, 255, 0.6);" min="0">
        </div>
      </div>
      <div class="form-group col-md-6">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <input type="text" class="form-control" id="contact" name="contact" required placeholder="联系方式" style="background-color: rgba(255, 255, 255, 0.6);" pattern="^(\d{11}|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$" title="请输入11位手机号或有效的邮箱地址">
        </div>
      </div>
    </div>
    <div class="form-group">
      <textarea class="form-control" id="message" name="message" rows="3" placeholder="留言" style="background-color: rgba(255, 255, 255, 0.6);"></textarea>
    </div>
    <button type="submit" class="btn btn-primary btn-block">提交</button>
  </form>
</div>
// 省略的代码...
```
### 实现邮件发送功能
在`submit.php`中，我使用了`PHPMailer`库来处理邮件发送。我需要引入PHPMailer的相关文件，然后根据用户提交的数据构建邮件内容并发送。
```php
// 省略的代码...
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $domain = htmlspecialchars($_POST['domain']);
    $quote = htmlspecialchars($_POST['quote']);
    $contact = htmlspecialchars($_POST['contact']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // 服务器设置
        $mail->isSMTP();
        $mail->Host = 'smtp.163.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'xxxxx@163.com';
        $mail->Password = 'xxxxx';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
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
```
通过这两个文件的配合，我实现了一个简单的域名停靠页面，用户可以通过填写表单来发送询价信息，而我则可以通过邮件接收到这些信息。这种实现方式不仅简单易用，而且可以根据需要进行扩展和定制。希望这篇文章能为你提供一些有用的参考！
