<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_SERVER['HTTP_HOST']); ?> - 域名停靠</title>
    <!-- 引入 Bootstrap 4 CSS -->
    <link rel="stylesheet" href="//cdn.staticfile.net/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <!-- 引入 Font Awesome 图标库 -->
    <link rel="stylesheet" href="//cdn.staticfile.net/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #ffffff;
            background-size: cover;
            background-position: center;
            color: #333;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .poetry-section {
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
            position: relative;
            z-index: 2;
            width: 90%;
            max-width: 600px;
            background-color: rgba(255, 255, 255, 0.6);
            border-radius: 8px;
        }
    </style>
</head>
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

<script src="//cdn.staticfile.net/jquery/3.5.1/jquery.min.js"></script>
<script src="//cdn.staticfile.net/popper.js/2.9.3/umd/popper.min.js"></script>
<script src="//cdn.staticfile.net/twitter-bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
