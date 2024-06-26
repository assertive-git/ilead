<?php
session_start();
if ( !isset( $_SESSION[ 'complete' ] ) ) {
  header( "Location: ./#form" );
  exit;
} else {
  session_destroy();
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-TFPL7WLK');</script>
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
<link rel=”icon” href=“img/favicon.ico”>
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
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TFPL7WLK"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    
<div class="wrap">
  <div id="form" class="contact_form">
    <div class="contact_h">送信完了</div>
    <p> この度はご登録いただき、<br class="sp">
      誠にありがとうございます。<br>
      <br>
      ご入力いただきましたメールアドレス宛に、<br>
      登録受付完了メールを<br class="sp">
      お送りさせていただいております。<br>
      <br>
      ご確認の程、よろしくお願い致します。<br>
    </p>
    <p class="top_button"><a href="./">トップへ戻る</a></p>
  </div>
</div>
<footer>
  <p><a href="#"><img src="img/nippon_logo.png"></a></p>
  <p class="caption">Copyright©にっぽん直売所 Inc.</p>
</footer>
<!--footer-->

</body>
</html>