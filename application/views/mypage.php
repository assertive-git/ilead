<?php include ('header.php'); ?>
<main id="mypage">
  <!-- <div class="registration pc"><a href="form" target="_blank">まずは簡単登録</a></div> -->
  <section class="search_result">
    <p>★検討中リスト一覧　全<span class="number"><?= count($jobs) ?></span>件</p>
  </section>
  <section class="job_result">
    <div class="job_result_inner">
      <button type="reset" class="reset">☆検討中リストから全て削除する</button>
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
              <p>店舗責任者候補を募集！薬剤師として成長したい方歓迎！</p>
              < class="table_area">
                <table>
                  <tr>
                    <th class="attribute">給料</th>
                    <td>年収　350万円～450万円</td>
                  </tr>
                  <tr>
                    <th class="attribute">勤務地</th>
                    <td>大阪府大阪市中央区</td>
                  </tr>
                  <tr>
                    <th class="attribute">最寄り駅</th>
                    <td>大阪メトロ谷町線 谷町九丁目駅 徒歩4分</td>
                  </tr>
                  <tr>
                    <th class="attribute">業務内容</th>
                    <td>調剤／監査／服薬指導</td>
                  </tr>
                </table>
                <small>未経験者OK / 高収入 / 土日祝日休み</small>
              </>
              <img src="/uploads/top_picture/<?= $job['top_picture'] ?>" width="260" height="180">
              <ul class="button_area">
                <li>
                  <button>★ 検討中リストから削除する</button>
                </li>
                <li><a href="/jobs/<?= $job['id'] ?>">詳細を見る</a></li>
              </ul>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>


      <p class="number2">新着求人：<span class="big">0</span>件（1～10件）</p>
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
    </div>
  </section>
</main>
<?php include ('footer.php'); ?>