<?php include ('header.php'); ?>

<main>
  <section class="main_img">
    <p class="main_copy">薬剤師による、<br>
      薬剤師のための<br class="sp">転職支援<br>
      <span class="sub_copy">Career change support by <br class="sp">pharmacists for pharmacists</span>
    </p>
  </section>

  <!-- <div class="registration"><a href="" target="_blank">まずは簡単登録</a></div> -->

  <section class="search">
    <ul class="tab">
      <li class="active"><a href="#list"><i class="fa-regular fa-square-check"></i>&nbsp;リストから探す</a></li>
      <li><a href="#googlemap"><i class="fa-solid fa-location-dot"></i>&nbsp;GoogleMAPから探す</a></li>
    </ul>
    <form id="list" class="area is-active" action="/job_list" method="POST">
      <div class="search_inner">
        <ul class="main7">
          <li class="areas">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal1">エリア<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="stations">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal2">沿線・駅<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="job_types">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal3">職種<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="categories">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal4">施設・種別<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="employment_types">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal5">雇用形態/給与<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="traits">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal6">こだわり<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="freeword">
            <h4>フリーワード検索<br class="sp"><span>勤務地、条件など好きな言葉で検索する</span></h4>
            <input type="text" placeholder="例：残業なし" name="freeword">
          </li>
          <li class="number_text">
            <p class="number">該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</p>
          </li>
        </ul>
        <ul class="button_area">
          <li>
            <button type="submit" class="submit">検索する <i class="fa-solid fa-magnifying-glass"></i></button>
          </li>
          <li>
            <!--<button type="button" class="reset">すべてクリア</button>-->
          </li>
        </ul>
      </div>
      <?php include_once APPPATH . 'includes/search_modal.php' ?>
    </form>
  </section>

  <section class="recruitment">
    <h2><span>求人情報</span>Recruitment</h2>
    <h3>新着求人情報</h3>
    <div class="recruitment_slider_wrap">
      <div class="recruitment_slider">
        <?php foreach ($new_jobs as $new_job): ?>
          <div class="slide_item">
            <a href="/jobs/<?= $new_job['id'] ?>"><img src="assets/img/rec_img1.png"></a>
            <div class="category">
              <?php $categories = explode(',', $new_job['category']) ?>
              <?php for ($i = 0; $i < 2; $i++): ?>
                <?php if (!empty($categories[$i])): ?>
                  <span title="<?= $categories[$i] ?>"><?= ellipsize($categories[$i], 8); ?></span>
                <?php endif; ?>
              <?php endfor; ?>
            </div>
            <dl>
              <dt><a href="/jobs/<?= $new_job['id'] ?>"><?= ellipsize($new_job['title'], 43) ?></a></dt>
              <dd><span class="attribute">勤務地</span><?= $new_job['a_pref'] ?><?= $new_job['city'] ?></dd>
              <dd><span class="attribute">給料</span><?= $new_job['salary'] ?></dd>
            </dl>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="picup">
    <div class="picup_wrap">
      <h3>PICK UP 求人特集</h3>
      <ul class="tab">
        <li class="active"><a href="#directly">直接雇用</a></li>
        <li><a href="#temporary">出向・派遣</a></li>
      </ul>
      <div id="directly" class="area2 is-active">
        <div class="temporary_slider_wrap">
          <div class="temporary_slider">
            <?php foreach ($direct as $job): ?>
              <div class="slide_item">
                <a href="/jobs/<?= $job['id'] ?>"><img src="/uploads/top_picture/<?= $job['top_picture'] ?>">
                  <div class="category">
                    <?php $i = 0; ?>
                    <?php foreach (explode(',', $job['category']) as $category): ?>
                      <span><?= ellipsize($category, 3) ?></span>
                      <?php $i++; ?>
                      <?php if ($i == 2)
                        break; ?>
                    <?php endforeach; ?>
                  </div>
                  <dl>
                    <dt><?= ellipsize($job['title'], 25) ?></dt>
                    <dd><span class="attribute">勤務地</span><?= $job['a_pref'] . $job['city'] ?></dd>
                    <dd><span class="attribute">給料</span><?= $job['salary'] ?></dd>
                  </dl>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>

      <div id="temporary" class="area2">
        <div class="temporary_slider_wrap">
          <div class="temporary_slider">
            <?php foreach ($deployment as $job): ?>
              <div class="slide_item">
                <a href="/jobs/<?= $job['id'] ?>"><img src="/uploads/top_picture/<?= $job['top_picture'] ?>">
                  <div class="category">
                    <?php $i = 0; ?>
                    <?php foreach (explode(',', $job['category']) as $category): ?>
                      <span><?= ellipsize($category, 3) ?></span>
                      <?php $i++; ?>
                      <?php if ($i == 2)
                        break; ?>
                    <?php endforeach; ?>
                  </div>
                  <dl>
                    <dt><?= ellipsize($job['title'], 25) ?></dt>
                    <dd><span class="attribute">勤務地</span><?= $job['a_pref'] . $job['city'] ?></dd>
                    <dd><span class="attribute">給料</span><?= $job['salary'] ?></dd>
                  </dl>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!--/area-->
      </div>
      <div class="arrows_area">
        <div class="arrows"></div>
      </div>
    </div>
  </section>

  <section class="aboutus">
    <div class="aboutus_back">
      <div class="aboutus_inner">
        <div class="text">
          <h2><span>事業紹介</span> About Us</h2>
          <p class="lead">企業が本当に必要とする人材<br>
            <span>×</span><br>
            求職者が力を発揮できる会社
          </p>
          <p>表向きの諸条件から発生するマッチングではなく、<br>
            「企業様の理念やビジョン」<br class="sp">「求職者様の人生観や価値観」から<br>
            生まれる本質的なフィッティングの実現を目的とし、<br>
            双方を深く理解した上でご提案を行っています。</p>
        </div>
        <div class="aboutus_img"><img src="assets/img/aboutus_figure.png" alt="事業構成チャート"></div>
        <div><a href="">就業までの流れ</a></div>
      </div>
    </div>
  </section>

  <section class="instagram">
    <div class="instagram_inner">
      <div class="text">
        <h2><span>アイリードを見る</span> Instagram</h2>
        <a href="https://www.instagram.com/ilead.company/" class="pc">VIEW MORE</a>
      </div>
      <div class="insta_list"><img src="assets/img/insta_img.png" alt="インスタ画像" width="638" height="418"></div>
      <a href="https://www.instagram.com/ilead.company/" class="sp">VIEW MORE</a>
    </div>
  </section>

  <section class="news">
    <div class="news_inner">
      <div class="text">
        <h2><span>お知らせ</span> News</h2>
        <a href="/news" class="arrow"></a>
      </div>
      <ul class="news_area">
        <?php foreach ($news as $article): ?>
          <a href="/news/<?= $article['id'] ?>">
            <li><span class="day"><?= substr(str_replace('-', '.', $article['created_at']), 0, 11) ?></span><span
                class="title"><?= ellipsize($article['title'], 40); ?></span>
            </li>
          </a>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
  <script>
    $(window).on('load', function () {
      $('input, select').each(function () {
        $(this).prop('checked', false);
        if ($(this).is('select')) {
          $(this)[0].selectedIndex = 0;
        }
      });
    });
  </script>
</main>
<?php include ('footer.php'); ?>