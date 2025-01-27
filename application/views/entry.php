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
<?php include('header.php'); ?>
<main id="form">
  <!--▼▼▼form▼▼▼-->
  <h2>簡単登録</h2>
  <div class="progressbar">
    <div class="item active">STEP.1 ご入力</div>
    <div class="item">STEP.2 ご確認</div>
    <div class="item">STEP.3 完了</div>
  </div>
  <?php if(!empty($job_id)): ?>
    <form class="h-adr" name="inquiry" action="/jobs/entry/<?= $job_id ?>/confirm" method="post" id="formInquiry">
  <?php else: ?>
    <form class="h-adr" name="inquiry" action="/jobs/entry/confirm" method="post" id="formInquiry">
    <?php endif; ?>
    <span class="p-country-name" style="display:none;">Japan</span>
    <?php if(!empty($title)): ?>
    <dl>
      <dt>タイトル</dt>
      <dd class="title">
        <label>
          <span><?= $title ?></span>
          <input type="hidden" name="title" value="<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>">
        </label>
      </dd>
    </dl>
    <?php endif; ?>
    <dl>
      <dt>氏名<span>必須</span></dt>
      <dd class="name">
        <label for="sei">姓
          <input id="sei" type="text" name="last_name" placeholder="例）山本"
            value="<?php echo htmlspecialchars($last_name, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>
        <label for="mei">&emsp;名
          <input id="mei" type="text" name="first_name" placeholder="例）太郎"
            value="<?php echo htmlspecialchars($first_name, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>
      </dd>
    </dl>
    <dl>
      <dt>フリガナ<span>必須</span></dt>
      <dd class="kana">
        <label for="kana_sei">セイ
          <input id="kana_sei" type="text" name="last_name_kana" placeholder="例）ヤマモト"
            value="<?php echo htmlspecialchars($last_name_kana, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>
        <label for="kana_mei">&emsp;メイ
          <input id="kana_mei" type="text" name="first_name_kana" placeholder="例）タロウ"
            value="<?php echo htmlspecialchars($first_name_kana, ENT_QUOTES, 'UTF-8'); ?>" required>
        </label>
      </dd>
    </dl>
    <dl>
      <dt>生年月日<span>必須</span></dt>
      <dd class="birthday">
        <input type="text" name="b_year" class="birthday-year" placeholder="1990" required>
        年&emsp;
        <input type="text" name="b_month" class="birthday-month" placeholder="01" required>
        月&emsp;
        <input type="text" name="b_day" class="birthday-day" placeholder="01" required>
        日
      </dd>
    </dl>
    <dl>
      <dt>年齢<span>必須</span></dt>
      <dd>
        <input type="text" id="age" name="age" type="text" style="width: 85px" required>
        歳
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
      <dd class="mail_add">
        <input type="email" name="email" placeholder="例）example@xxxx.com"
          value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>" class="width-long" required>
      </dd>
    </dl>
    <dl>
      <dt>お住まいの地域<span>必須</span></dt>
      <div class="address">
        <dd class="zip">〒
          <input name="zip1" maxlength="3" placeholder="000" class="p-postal-code" required>
          -
          <input name="zip2" maxlength="4" placeholder="0000" class="p-postal-code" required>
        </dd>
        <dd>
          <select name="prefecture" class="todofuken p-region" required>
            <option value="">都道府県を選択</option>
            <?php foreach ($prefectures as $prefecture): ?>
              <option value="<?= $prefecture ?>">
                <?= $prefecture ?>
              </option>
            <?php endforeach; ?>
          </select>
        </dd>
        <dd>
          <input type="text" name="address1" placeholder="市区町村" class="p-locality p-street-address" style="width:100%;" required>
        </dd>
        <dd>
          <input type="text" name="address2" placeholder="番地　建物名・部屋番号" style="width:100%;" required>
        </dd>
      </div>
    </dl>
    <dl>
      <dt>面談希望<span>必須</span></dt>
      <dd>
        <label for="yes">
          <input id="yes" type="radio" name="hope" value="する" class="js-check" onclick="formSwitch()" checked>
          する　</label>
        <label for="no">
          <input id="no" type="radio" name="hope" value="しない" class="js-check" onclick="formSwitch()">
          しない </label>
      </dd>
    </dl>
    <div id="sample">
      <dl>
        <dt>面談希望日</dt>
        <dd>
          <input type="date" value="<?php echo date('Y-m-d'); ?>" name="interview_date">
        </dd>
      </dl>
      <dl>
        <dt>面談方法</dt>
        <dd>
          <div>
            <select name="method">
              <option value="対面">対面</option>
              <option value="WEB">WEB</option>
              <option value="どちらでも可">どちらでも可</option>
            </select>
          </div>
        </dd>
      </dl>
    </div>
    <div class="privasy_content">
      <h5>プライバシーポリシー</h5>
      <h6>個人情報の収集について</h6>
      <p>・当サイトのご利用に際し、よりよいサービスのご提供を続けるために、個人情報を収集することがございます。</p>
      <p>・収集する個人情報の範囲は、収集の目的を達成するための必要最低限とし、取り扱いにあたっては、個人情報保護に関する関係法令、および社内諸規定などを遵守します。</p>
      <h6>個人情報の管理・保護について</h6>
      <p>・当社が収集したご利用者様の個人情報については、適切な管理を行い、紛失・破壊・改ざん・不正アクセス・漏洩などの防止に努めます。</p>
      <p>・取得したご利用者様の個人情報について、ご利用者様の同意なく開示することはございません。</p>
      <p>・また、当社サイトへのアクセスにより、ほかのご利用者様が個人情報を閲覧されることはございません。</p>
      <h6>個人情報の利用について</h6>
      <p>・ご利用者様の個人情報は、以下の目的で利用いたします。</p>
      <p>・ご利用者様にサービスや商品の情報を的確にお伝えするため</p>
      <p>・ご利用者様がサービスをご利用になる際の身分証明のため</p>
      <p>・より満足していただけるサイトへと改善するため</p>
      <p>・必要に応じてご利用者様に連絡を行うため</p>
    </div>
    <p class="privacy">個人情報の取り扱いに関しては、上記のプライバシーポリシーをご確認の上、同意をいただける場合は<br class="pc">「同意して確認画面」ボタンをクリックしてお進みください。</p>
    <div class="form_btn">
      <input type="submit" value="同意して確認画面" class="btn btn_submit_form">
    </div>
  </form>
  <!--▲▲▲form▲▲▲-->
</main>
<script>
  var selecterBox = document.getElementById('sample');

  function formSwitch() {
    check = document.getElementsByClassName('js-check')
    if (check[1].checked) {
      selecterBox.style.display = "none";

    } else if (check[0].checked) {
      selecterBox.style.display = "block";

    } else {
      selecterBox.style.display = "none";
    }
  }
  window.addEventListener('load', formSwitch());

  function entryChange2() {
    if (document.getElementById('changeSelect')) {
      id = document.getElementById('changeSelect').value;
    }
  }
</script>
<script src="https://yubinbango.github.io/yubinbango/yubinbango.js"></script>

<?php include('footer.php'); ?>