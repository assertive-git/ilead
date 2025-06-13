<!doctype html>
<html lang="ja" class="no-js">
<head>
<meta name="robots">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>アイリード</title>
<script type="module">
    document.documentElement.classList.remove('no-js');
    document.documentElement.classList.add('js');
  </script>
<meta name="description" content="ページの説明文">
<meta property="og:title" content="">
<meta property="og:description" content="ページの説明文">
<meta property="og:image" content="https://xxxxxxxxxxx/xxxxx/xxxxx.jpg">
<meta property="og:image:alt" content="">
<meta property="og:locale" content="ja_JP">
<meta property="og:type" content="website">
<meta name="twitter:card" content="summary_large_image">
<meta property="og:url" content="https://xxxxxxxxxxxxxxxxx.co.jp">
<meta name="theme-color" content="#FFFFFF">
<link rel="canonical" href="https://xxxxxxxxxxxxxxxxx.co.jp">
<link rel="icon" href="/public/assets/img/favicon.ico">
<!-- Tailwind CSS -->
<!-- <link rel="stylesheet" href="/public/assets/css/tw.css"> -->

<link rel="stylesheet" href="/public/assets/css/reset.css?v=<?= date('YmdHis') ?>">
<link rel="stylesheet" href="/public/assets/css/style.css?v=<?= date('YmdHis') ?>">

<!--Adobe font 秀英角ゴシック銀-->
<script>
    (function (d) {
      var config = {
        kitId: 'hko0nfl',
        scriptTimeout: 3000,
        async: true
      },
        h = d.documentElement, t = setTimeout(function () { h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive"; }, config.scriptTimeout), tk = d.createElement("script"), f = false, s = d.getElementsByTagName("script")[0], a; h.className += " wf-loading"; tk.src = 'https://use.typekit.net/' + config.kitId + '.js'; tk.async = true; tk.onload = tk.onreadystatechange = function () { a = this.readyState; if (f || a && a != "complete" && a != "loaded") return; f = true; clearTimeout(t); try { Typekit.load(config) } catch (e) { } }; s.parentNode.insertBefore(tk, s)
    })(document);
  </script>

<!--Noto Sans Japanese-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

<!--Poppins-->
<link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
<!-- <script src="https://kit.fontawesome.com/71bbf25188.js" crossorigin="anonymous"></script> -->

<!-- slick slider -->
<link rel="stylesheet" href="/public/assets/css/slick.css">
<link rel="stylesheet" href="/public/assets/css/slick-theme.css">

<!-- JQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-PCFWVKF');</script>
<!-- End Google Tag Manager -->


</head>

<body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PCFWVKF"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<header>
  <div class="header_inner">
    <h1 class="logo">
      <a href="/">
      <img src="/public/assets/img/logo.svg" alt="アイリード" width="176" height="35">
      </a>
    </h1>
    <div class="sp">
      <a href="/favorites" class="consider_list" type="button">★検討中リスト</a>
    </div>
    <nav class="pc pc_nav">
      <ul class="nav_list">
        <li>
          <a class="job_list_reset" href="/job_list?reset=1">求人情報</a>
        </li>
        <li>
          <a href="https://ilead-hr.co.jp/business">事業紹介</a>
        </li>
        <li>
          <a href="/news">お知らせ</a>
        </li>
        <li>
          <a href="https://ilead-hr.co.jp/company">会社概要</a>
        </li>
        <li>
          <a href="https://ilead-hr.co.jp/contact">お問い合わせ</a>
        </li>
        <li>
          <a href="https://www.instagram.com/ilead.company/"><img src="/public/assets/img/insta_icon.png" alt="instaアイコン"
                width="24" height="24" class="insta"></a>
        </li>
        <li>
          <a href="/favorites" class="consider_list" type="button">★検討中リスト</a>
        </li>
      </ul>
    </nav>
    <div class="hamburger-menu sp">
      <input type="checkbox" id="menu-btn-check">
      <label for="menu-btn-check" class="menu-btn"><span></span></label>
      <script>
        $('#menu-btn-check').change(function() {
          // $('.progressbar').css({visibility: $(this).is(':checked') ? 'hidden' : 'visible'})
        })
      </script>
      <!--ここからメニュー-->
      <div class="menu-content">
        <ul class="nav_list">
          <li>
            <a class="job_list_reset" href="/job_list?reset=1">求人情報</a>
          </li>
          <li>
            <a href="https://ilead-hr.co.jp/business">事業紹介</a>
          </li>
          <li>
            <a href="/news">お知らせ</a>
          </li>
          <li>
            <a href="https://ilead-hr.co.jp/company">会社概要</a>
          </li>
          <li>
            <a href="https://ilead-hr.co.jp/contact">お問い合わせ</a>
          </li>
        </ul>
      </div>
      <!--ここまでメニュー-->
    </div>
  </div>
</header>
