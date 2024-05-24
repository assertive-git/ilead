<?php include ('header.php'); ?>

<main>

  <!--<div class="registration"><a href="" target="_blank">まずは簡単登録</a></div>-->

  <section class="search_area">
    <div class="search_inner">
      <ul>
        <li class="workarea">エリアを選ぶ<span class="plus">+</span></li>
        <li class="station">沿線・駅を選ぶ<span class="plus">+</span></li>
        <li class="facility">施設・種別を選ぶ<span class="plus">+</span></li>
        <li class="form">雇用形態/給与を選ぶ<span class="plus">+</span> </li>
        <li class="traits">こだわり<span class="plus">+</span></li>
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
  </section>
  <?php include APPPATH . 'includes/search_modal.php' ?>
  <section class="search_result">
    <p>検索結果一覧　全<span class="number"><?= count($jobs) ?></span>件</p>
  </section>
  <section class="job_result">
    <div class="pagination">
      <button class="arrow_before"></button>
      <div class="page">
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button>4</button>
      </div>
      <button class="arrow_next"></button>
    </div>
    <div class="job_result_inner">
      <p class="number">新着求人：<span class="big"><?= count($jobs) ?></span>件（1～10件）</p>
      <!-- <ul class="tab">
        <li><a href="#new_arrival">新着順</a></li>
        <li><a href="#annual_income">年収順</a></li>
        <li><a href="#hourly_wage">時給順</a></li>
      </ul> -->
      <div id="new_arrival" class="area">
        <?php if (!empty($jobs)): ?>
          <?php foreach ($jobs as $job): ?>
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
                <div class="table_area">
                  <table>
                    <tr>
                      <th class="attribute">給料</th>
                      <?php $job['min_salary'] = number_format($job['min_salary']); ?>
                      <?php $job['max_salary'] = number_format($job['max_salary']); ?>
                      <?php $job['min_salary'] = substr_count($job['min_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['min_salary']) / 10000)) . '万' : $job['min_salary']; ?>
                      <?php $job['max_salary'] = substr_count($job['max_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['max_salary']) / 10000)) . '万' : $job['max_salary']; ?>
                      <?php if (!empty($job['max_salary'])): ?>
                        <td>¥<?= $job['min_salary'] ?>～<?= $job['max_salary'] ?></td>
                      <?php else: ?>
                        <td>¥<?= $job['min_salary'] ?></td>
                      <?php endif; ?>
                    </tr>
                    <tr>
                      <th class="attribute">勤務地</th>
                      <td><?= $job['pref'] ?><?= $job['city'] ?><?= $job['address'] ?></td>
                    </tr>
                    <tr>
                      <th class="attribute">最寄り駅</th>
                      <td>
                        <?= $job['jobs_stations'] ?>
                      </td>
                    </tr>
                    <tr>
                      <th class="attribute">業務内容</th>
                      <td><?= $job['business_content'] ?></td>
                    </tr>
                  </table>
                  <small><?= str_replace(',', ' / ', $job['traits']) ?></small>
                </div>
                <img src="/uploads/top_picture/<?= $job['top_picture'] ?>" width="260" height="180">
                <ul class="button_area">
                  <li>
                    <button class="favorite_btn<?= in_array($job['id'], $favorites) ? ' favorite_btn--remove' : '' ?>"
                      status="<?= !in_array($job['id'], $favorites) ? 0 : 1 ?>" job-id="<?= $job['id'] ?>">★
                      <?= in_array($job['id'], $favorites) ? '検討中リストから削除する' : '検討中リストに追加する' ?></button>
                  </li>
                  <li><a href="/jobs/<?= $job['id'] ?>">詳細を見る</a></li>
                </ul>
              </div>
            </div>
          <?php endforeach; ?>
          <script src="/assets/js/favorite_btn.js"></script>
        <?php endif; ?>
      </div>
      <p class="number2">新着求人：<span class="big">0</span>件（1～10件）</p>
    </div>
    <div class="pagination">
      <button class="arrow_before"></button>
      <div class="page">
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button>4</button>
      </div>
      <button class="arrow_next"></button>
    </div>
  </section>
</main>
<?php include ('footer.php'); ?>