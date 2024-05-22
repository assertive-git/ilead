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



<?php include ('header.php'); ?>

<main id="form">
  <!--▼▼▼form▼▼▼-->
  <section>
    <h2>簡単登録</h2>
    <div class="progressbar">
      <div class="item active">STEP.1 ご入力</div>
      <div class="item">STEP.2 ご確認</div>
      <div class="item">STEP.3 完了</div>
    </div>
    <form name="inquiry" action="/jobs/<?= $id ?>/confirm" method="post" id="formInquiry">
      <dl>
        <dt>氏名<span>必須</span></dt>
        <dd>
          <label for="sei">姓
            <input id="sei" type="text" name="last_name" placeholder="例）山本"
              value="<?php echo htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8'); ?>" style="width:30%;" required>
          </label>
          <label for="mei"> 名
            <input id="mei" type="text" name="first_name" placeholder="例）太郎"
              value="<?php echo htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8'); ?>" style="width:30%;" required>
          </label>
        </dd>
      </dl>
      <dl>
        <dt>フリガナ<span>必須</span></dt>
        <dd>
          <label for="kana_sei">セイ
            <input id="kana_sei" type="text" name="last_name_kana" placeholder="例）ヤマモト"
              value="<?php echo htmlspecialchars($last_name_kana, ENT_QUOTES, 'UTF-8'); ?>" style="width:30%;" required>
          </label>
          <label for="kana_mei"> メイ
            <input id="kana_mei" type="text" name="first_name_kana" placeholder="例）タロウ"
              value="<?php echo htmlspecialchars($first_name_kana, ENT_QUOTES, 'UTF-8'); ?>" style="width:30%;"
              required>
          </label>
        </dd>
      </dl>
      <dl>
        <dt>生年月日<span>必須</span></dt>
        <dd>
          <input type="text" name="b_year" class="birthday-year" style="width: 85px">
          年
          <input type="text" name="b_month" class="birthday-month" style="width: 85px">
          月
          <input type="text" name="b_day" class="birthday-day" style="width: 85px">
          日
        </dd>
      </dl>
      <dl>
        <dt>年齢<span>必須</span></dt>
        <dd>
          <input type="text" id="age" name="age" type="text" style="width: 85px">
        </dd>
      </dl>
      <dl>
        <dt>電話番号<span>必須</span></dt>
        <dd>
          <div>
            <input type="text" name="tel" placeholder="00000000000"
              value="<?php echo htmlspecialchars($tel, ENT_QUOTES, 'UTF-8'); ?>" required>
          </div>
        </dd>
      </dl>
      <dl class="clearfix">
        <dt>メールアドレス<span>必須</span></dt>
        <dd>
          <input type="email" name="email" placeholder="例）example@xxxx.com"
            value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" class="width-long" style="width:50%;"
            required>
        </dd>
      </dl>
      <dl>
        <dt>お住まいの地域<span>必須</span></dt>
        <div class="address">
          <dd style="display: flex; align-items: center; gap: 4px;">〒
            <input name="zip1" maxlength="3" style="width:50%;">
            -
            <input name="zip2" maxlength="4" style="width:50%;">
          </dd>
          <dd>
            <select name="prefecture" class="todofuken" required>
              <option value="">都道府県を選択</option>
              <?php foreach ($prefectures as $prefecture): ?>
                <option value="<?= $prefecture ?>">
                  <?= $prefecture ?>
                </option>
              <?php endforeach; ?>
            </select>
          </dd>
          <dd>
            <input type="text" name="address1" style="width:100%;">
          </dd>
          <dd>
            <input type="text" name="address2" style="width:100%;">
          </dd>
        </div>
      </dl>
      <dl>
        <dt>面接希望</dt>
        <dd>
          <label for="yes">
            <input id="yes" type="radio" name="hope" value="する" checked>
            する　</label>
          <label for="no">
            <input id="no" type="radio" name="hope" value="しない">
            しない </label>
        </dd>
      </dl>
      <dl>
        <dt>面接希望日</dt>
        <dd>
          <input type="date" name="interview_date">
        </dd>
      </dl>
      <dl>
        <dt>面接方法</dt>
        <dd>
          <div>
            <select name="method">
              <option value="method1">面接方法1</option>
              <option value="method2">面接方法2</option>
            </select>
          </div>
        </dd>
      </dl>
      <p class="privacy">個人情報の取り扱いに関しては、<a href="">プライバシーポリシー</a>をご確認の上、同意をいただける場合は<br class="pc">
        「入力内容確認」ボタンをクリックしてお進みください。</p>
      <div class="form_btn">
        <input type="submit" value="同意して確認画面" class="btn btn_submit_form">
      </div>
    </form>
  </section>
  <!--▲▲▲form▲▲▲-->
</main>
<?php include ('footer.php'); ?>