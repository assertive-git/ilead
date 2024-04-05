<!-- form postデータ取得 -->
<?php
session_start();
$_SESSION['index'] = "";
$companyname = isset($_POST["companyname"]) ? $_POST["companyname"] : "";
$name = isset($_POST["name"]) ? $_POST["name"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
$prefecture = isset($_POST["prefecture"]) ? $_POST["prefecture"] : "";
$url = isset($_POST["url"]) ? $_POST["url"] : "";
$store_an = isset($_POST["store_an"]) ? $_POST["store_an"] : "";
$role = isset($_POST["role"]) ? $_POST["role"] : "";
?>
<?php
if (!isset($_SESSION['index'])) {
  header("Location: ./#form");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-TFPL7WLK');
  </script>
  <!-- End Google Tag Manager -->


  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>にっぽん直売所｜生産者直売のれん会｜お土産食品・お菓子の仕入れサイト</title>
  <script type="module">
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');
  </script>
  <meta name="description" content="ページの説明文">
  <meta property="og:title" content="にっぽん直売所｜生産者直売のれん会｜お土産食品・お菓子の仕入れサイト">
  <meta property="og:description" content="ページの説明文">
  <meta property="og:image" content="https://pd.noren-kai.com/lp1/img/og_img.jpg">
  <meta property="og:image:alt" content="にっぽん直売所｜生産者直売のれん会｜お土産食品・お菓子の仕入れサイト">
  <meta property="og:locale" content="ja_JP">
  <meta property="og:type" content="website">
  <meta name="twitter:card" content="summary_large_image">
  <meta property="og:url" content="https://pd.noren-kai.com/lp1/">
  <meta name="theme-color" content="#FF00FF">
  <link rel="canonical" href="https://pd.noren-kai.com/lp1/">
  <link rel="icon" href="img/favicon.ico">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/reset.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme.css">
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/main.js"></script>
</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFPL7WLK" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="wrap">
    <div id="form" class="contact_form">
      <form name="inquiry" class="form" action="sendmail.php" method="post" id="formInquiry">
        <div class="contact_h">送信内容のご確認</div>
        <p> 以下の内容で送信します。よろしいですか？ </p>
        <div class="form_cont">
          <dl>
            <dt>会社名<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($companyname, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>実店舗の有無<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($store_an, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>役職</dt>
            <dd> <?php echo htmlspecialchars($role, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>担当者名<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>様 </dd>
          </dl>
          <dl>
            <dt>メールアドレス<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>電話番号<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($tel, ENT_QUOTES, 'UTF-8'); ?><br>
            </dd>
          </dl>
          <dl>
            <dt>都道府県<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($prefecture, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>会社URL</dt>
            <dd> <?php echo htmlspecialchars($url, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <div class="form_btn">
            <ul class="button_list">
              <li>
                <input type="button" value="修正する" class="btn btn_submit_back" onClick="inquiry.action='./#formInquiry'; inquiry.submit();">
              </li>
              <li>
                <input type="submit" value="送信する" class="btn btn_submit_send">
              </li>
            </ul>

            <!-- データ送信 -->
            <input type="hidden" name="companyname" value="<?php echo $companyname ?>" />
            <input type="hidden" name="name" value="<?php echo $name ?>" />
            <input type="hidden" name="email" value="<?php echo $email ?>" />
            <input type="hidden" name="tel" value="<?php echo $tel ?>" />
            <input type="hidden" name="prefecture" value="<?php echo $prefecture ?>" />
            <input type="hidden" name="url" value="<?php echo $url ?>" />
            <input type="hidden" name="store_an" value="<?php echo $store_an ?>" />
            <input type="hidden" name="role" value="<?php echo $role ?>" />
          </div>
        </div>
      </form>
    </div>
  </div>
  <footer>
    <p><a href="#"><img src="img/nippon_logo.png"></a></p>
    <p class="caption">Copyright©にっぽん直売所 Inc.</p>
  </footer>
  <!--footer-->

</body>

</html>