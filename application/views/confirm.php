<?php
//都道府県の配列
$prefectures = array(
  '北海道',
  '青森県',
  '岩手県',
  '宮城県',
  '秋田県',
  '山形県',
  '福島県',
  '茨城県',
  '栃木県',
  '群馬県',
  '埼玉県',
  '千葉県',
  '東京都',
  '神奈川県',
  '新潟県',
  '富山県',
  '石川県',
  '福井県',
  '山梨県',
  '長野県',
  '岐阜県',
  '静岡県',
  '愛知県',
  '三重県',
  '滋賀県',
  '京都府',
  '大阪府',
  '兵庫県',
  '奈良県',
  '和歌山県',
  '鳥取県',
  '島根県',
  '岡山県',
  '広島県',
  '山口県',
  '徳島県',
  '香川県',
  '愛媛県',
  '高知県',
  '福岡県',
  '佐賀県',
  '長崎県',
  '熊本県',
  '大分県',
  '宮崎県',
  '鹿児島県',
  '沖縄県'
);
?>
<!-- form postデータ取得 -->
<?php
$title = isset($_POST["title"]) ? $_POST["title"] : "";
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
$zip1 = isset($_POST["zip1"]) ? $_POST["zip1"] : "";
$zip2 = isset($_POST["zip2"]) ? $_POST["zip2"] : "";
$address1 = isset($_POST["address1"]) ? $_POST["address1"] : "";
$address2 = isset($_POST["address2"]) ? $_POST["address2"] : "";
$hope = isset($_POST["hope"]) ? $_POST["hope"] : "";
$interview_date = isset($_POST["interview_date"]) ? $_POST["interview_date"] : "";
$method = isset($_POST["method"]) ? $_POST["method"] : "";

?>

<?php include('header.php'); ?>

<div id="form" class="confirm">
  <?php if (!empty($job_id)): ?>
    <form name="inquiry" class="form" action="/jobs/entry/<?= $job_id ?>/confirm" method="post" id="formInquiry">
    <?php else: ?>
      <form name="inquiry" class="form" action="/jobs/entry/confirm" method="post" id="formInquiry">
      <?php endif; ?>
      <div class="contact_h">送信内容のご確認</div>
      <p> 以下の内容で送信します。よろしいですか？ </p>
      <div class="progressbar">
        <div class="item">STEP.1 ご入力</div>
        <div class="item active">STEP.2 ご確認</div>
        <div class="item">STEP.3 完了</div>
      </div>
      <div class="form_cont">
        <?php if (!empty($title)): ?>
          <dl>
            <dt>タイトル<span>必須</span></dt>
            <dd> <?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
        <?php endif; ?>
        <dl>
          <dt>氏名<span>必須</span></dt>
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
          <dd> <?php echo htmlspecialchars($age, ENT_QUOTES, 'UTF-8'); ?>歳 </dd>
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
          <dt>面談希望</dt>
          <dd> <?php echo htmlspecialchars($hope, ENT_QUOTES, 'UTF-8'); ?> </dd>
        </dl>
        <?php if ($hope == "する"): ?>
          <dl>
            <dt>面談希望日</dt>
            <dd> <?php echo htmlspecialchars($interview_date, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
          <dl>
            <dt>面談方法</dt>
            <dd> <?php echo htmlspecialchars($method, ENT_QUOTES, 'UTF-8'); ?> </dd>
          </dl>
        <?php endif; ?>
        <div class="form_btn">
          <input type="button" value="修正する" class="btn btn_submit_back" onClick="history.back()">
          <input type="submit" value="送信する" class="btn btn_submit_send">


          <!-- データ送信 -->
          <input type="hidden" name="title" value="<?php echo $title ?>" />
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

<?php include('footer.php'); ?>