<!-- form postデータ取得 -->
<?php
$last_name = isset($_POST["last_name"]) ? $_POST["last_name"] : "";
$first_name = isset($_POST["first_name"]) ? $_POST["first_name"] : "";
$last_name_kana = isset($_POST["last_name_kana"]) ? $_POST["last_name_kana"] : "";
$first_name_kana = isset($_POST["first_name_kana"]) ? $_POST["first_name_kana"] : "";
$b_year = isset($_POST["b_year"]) ? $_POST["b_year"] : "";
$b_month = isset($_POST["b_month"]) ? $_POST["b_month"] : "";
$b_day = isset($_POST["b_day"]) ? $_POST["b_day"] : "";
$age = isset($_POST["age"]) ? $_POST["age"] : "";
$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
$email = isset($_POST["email"]) ? $_POST["email"] : "";
$prefecture = isset($_POST["prefecture"]) ? $_POST["prefecture"] : "";
$address1 = isset($_POST["address1"]) ? $_POST["address1"] : "";
$address2 = isset($_POST["address2"]) ? $_POST["address2"] : "";
$zip1 = isset($_POST["zip1"]) ? $_POST["zip1"] : "";
$zip2 = isset($_POST["zip2"]) ? $_POST["zip2"] : "";
$hope = isset($_POST["hope"]) ? $_POST["hope"] : "";
$interview_date = isset($_POST["interview_date"]) ? $_POST["interview_date"] : "";
$method = isset($_POST["method"]) ? $_POST["method"] : "";
?>

<!DOCTYPE html>
<html>

<head>

  <!-- Google Tag Manager -->
  <script>
    (function (w, d, s, l, i) {
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
  <link
    href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="css/slick.css">
  <link rel="stylesheet" href="css/slick-theme.css">
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/slick.min.js"></script>
  <script src="js/main.js"></script>
</head>

<body>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFPL7WLK" height="0" width="0"
      style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <div class="wrap">
    <div id="form" class="contact_form">
      <form name="inquiry" class="form" action="/jobs/<?= $id ?>/confirm" method="post" id="formInquiry">
        <div class="contact_h">送信内容のご確認</div>
        <p> 以下の内容で送信します。よろしいですか？ </p>
        <div class="form_cont">
          <dl>
            <dt>氏名</dt>
            <dd> <?php echo htmlspecialchars($last_name . $first_name, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>フリガナ<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($last_name_kana . $first_name_kana, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>生年月日<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($b_year . '年' . $b_month . '月' . $b_day . '日', ENT_QUOTES, 'UTF-8'); ?>
            </dd>
          </dl>
          <dl>
            <dt>年齢<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?>様 </dd>
          </dl>
          <dl>
            <dt>電話番号<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($tel, ENT_QUOTES, 'UTF-8'); ?></dd>
          </dl>
          <dl>
            <dt>メールアドレス<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>おすまいの地域<span>必須</span></dt>
            <dd>
              <?php echo htmlspecialchars('〒' . $zip1 . '-' . $zip2 . ' ' . $prefecture . $address1 . $address2, ENT_QUOTES, 'UTF-8'); ?>
            </dd>
          </dl>
          <dl>
            <dt>面接希望</dt>
            <dd> <?php echo htmlspecialchars($hope, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>面接希望日</dt>
            <dd> <?php echo htmlspecialchars($interview_date, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>面接方法</dt>
            <dd> <?php echo htmlspecialchars($method, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <div class="form_btn">
            <ul class="button_list">
              <li>
                <input type="button" value="修正する" class="btn btn_submit_back" onClick="history.back()">
              </li>
              <li>
                <input type="submit" value="送信する" class="btn btn_submit_send">
              </li>
            </ul>

            <!-- データ送信 -->
            <input type="hidden" name="last_name" value="<?php echo $last_name ?>" />
            <input type="hidden" name="first_name" value="<?php echo $first_name ?>" />
            <input type="hidden" name="last_name_kana" value="<?php echo $last_name_kana ?>" />
            <input type="hidden" name="first_name_kana" value="<?php echo $first_name_kana ?>" />
            <input type="hidden" name="b_year" value="<?php echo $b_year ?>" />
            <input type="hidden" name="b_month" value="<?php echo $b_month ?>" />
            <input type="hidden" name="b_day" value="<?php echo $b_day ?>" />
            <input type="hidden" name="age" value="<?php echo $age ?>" />
            <input type="hidden" name="tel" value="<?php echo $tel ?>" />
            <input type="hidden" name="email" value="<?php echo $email ?>" />
            <input type="hidden" name="prefecture" value="<?php echo $prefecture ?>" />
            <input type="hidden" name="zip1" value="<?php echo $zip1 ?>" />
            <input type="hidden" name="zip2" value="<?php echo $zip2 ?>" />
            <input type="hidden" name="address1" value="<?php echo $address1 ?>" />
            <input type="hidden" name="address2" value="<?php echo $address2 ?>" />
            <input type="hidden" name="hope" value="<?php echo $hope ?>" />
            <input type="hidden" name="interview_date" value="<?php echo $interview_date ?>" />
            <input type="hidden" name="method" value="<?php echo $method ?>" />

            <input type="hidden" name="action" value="1">
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