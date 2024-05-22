<?php include ('header.php'); ?>

<main id="job_single">

  <!--<div class="registration"><a href="" target="_blank">まずは簡単登録</a></div>-->

  <!-- <section class="search_area">
    <div class="search_inner">
      <ul>
        <li class="workarea"><a href=""> エリアを選ぶ<span class="plus">+</span> </a></li>
        <li class="station"><a href=""> 沿線・駅を選ぶ<span class="plus">+</span> </a></li>
        <li class="facility"><a href=""> 施設・種別を選ぶ<span class="plus">+</span> </a></li>
        <li class="form"><a href=""> 雇用形態/給与を選ぶ<span class="plus">+</span> </a> </li>
        <li><a href="">こだわり<span class="plus">+</span> </a></li>
        <li class="freeword">
          <form>
            <input type="text" placeholder="フリーワード">
            <input type="submit" value="&#xf002">
          </form>
        </li>
      </ul>
      <div class="button_area">
        <button type="reset" class="reset">すべてクリア</button>
      </div>
    </div>
  </section> -->
  <section class="search_result">
    <button href="" id="return" class="arrow_before">一覧へ戻る</button>
  </section>
  <section class="job_result">
    <div class="job_result_inner">
      <div class="job_result_wrap">
        <div class="inner">
          <?php if (!empty($job['category'])): ?>
            <div class="category">
              <?php foreach (explode(',', $job['category']) as $category): ?>
                <span><?= $category ?></span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <p><?= ellipsize($job['title'], 43) ?></p>
          <img src="/assets/img/result_img.png" width="260" height="180">
          <div class="table_area">
            <table>
              <tr>
                <th cl ass="attribute">給料</th>
                <td>
                  <?= $job['salary_type'] ?>
                  <?php $job['min_salary'] = number_format($job['min_salary']); ?>
                  <?php $job['max_salary'] = number_format($job['max_salary']); ?>
                  <?php $job['min_salary'] = substr_count($job['min_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['min_salary']) / 10000)) . '万' : $job['min_salary']; ?>
                  <?php $job['max_salary'] = substr_count($job['max_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['max_salary']) / 10000)) . '万' : $job['max_salary']; ?>
                  ¥<?= $job['min_salary'] ?><?php if (!empty($job['max_salary'])): ?>～<?= $job['max_salary'] ?>
                  <?php endif; ?>
                </td>
              </tr>
              <tr>
                <th class="attribute">勤務地</th>
                <td><?= $job['a_pref'] ?><?= $job['city'] ?></td>
              </tr>
              <tr>
                <th class="attribute">最寄り駅</th>
                <td>
                  <?php foreach ($job['jobs_stations'] as $job_station): ?>
                    <?= $job_station['line'] ?>   <?= str_replace('駅', '', $job_station['station']) ?>駅
                    徒歩<?= $job_station['walking_distance'] ?>分<br />
                  <?php endforeach; ?>
                </td>
              </tr>
              <tr>
                <th class="attribute">業務内容</th>
                <td><?= $job['business_content'] ?></td>
              </tr>
            </table>
            <small><?= str_replace(',', ' / ', $job['traits']) ?></small>
          </div>

          <dl class="job_detail">
            <dt>【仕事内容】</dt>
            <dd><?= $job['body'] ?></dd>
          </dl>
          <img src="/assets/img/detail_img.png" width="336" height="207" class="detail_img">
          <table class="company_detail">
            <tr>
              <th cl ass="attribute">会社名または店舗名</th>
              <td><?= $job['company_or_store_name'] ?></td>
            </tr>
            <tr>
              <th class="attribute">雇用形態</th>
              <td><?= $job['employment_type'] ?></td>
            </tr>
            <tr>
              <th class="attribute">給与</th>
              <td>
                <?php if (empty($job['max_salary'])): ?>
                  <?= $job['salary_type'] ?> ¥<?= $job['min_salary'] ?>
                <?php else: ?>
                  <?= $job['salary_type'] ?> ¥<?= $job['min_salary'] ?>～<?= $job['max_salary'] ?>
                <?php endif; ?>
              </td>
            </tr>
            <tr>
              <th class="attribute">職種名</th>
              <td><?= $job['job_type'] ?></td>
            </tr>
            <tr>
              <th class="attribute">住所</th>
              <td><?= $job['a_pref'] ?><?= $job['city'] ?><?= $job['address'] ?></td>
            </tr>
            <tr>
              <th class="attribute">最寄り駅</th>
              <td>
                <?php foreach ($job['jobs_stations'] as $job_station): ?>
                  <?= $job_station['line'] ?>   <?= str_replace('駅', '', $job_station['station']) ?>駅
                  徒歩<?= $job_station['walking_distance'] ?>分<br />
                <?php endforeach; ?>
              </td>
            </tr>
            <tr>
              <?php foreach ($job['custom_fields'] as $custom_field): ?>
                <th class="attribute"><?= $custom_field['title'] ?></th>
                <td><?= nl2br($custom_field['detail']) ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
          <ul class="button_area">
            <li>
              <button class="favorite_btn<?= in_array($job['id'], $favorites) ? ' favorite_btn--remove' : '' ?>"
                status="<?= !in_array($job['id'], $favorites) ? 0 : 1 ?>" job-id="<?= $job['id'] ?>">★
                <?= in_array($job['id'], $favorites) ? '検討中リストから削除する' : '検討中リストに追加する' ?></button>
            </li>
            <li><a href="/jobs/<?= $job['id'] ?>/entry">応募する</a></li>
          </ul>
          <script src="/assets/js/favorite_btn.js"></script>
        </div>
      </div>
    </div>
  </section>
  <!-- <section class="recommendation">
    <h3>おすすめの求人</h3>
    <div class="recruitment_slider_wrap">
      <div class="recruitment_slider">
        <div class="slide_item"> <img src="/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
      </div>
    </div>
  </section> -->
</main>

<?php include ('footer.php'); ?>