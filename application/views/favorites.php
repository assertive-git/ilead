<?php include ('header.php'); ?>
<main id="mypage">
  <!-- <div class="registration pc"><a href="form" target="_blank">まずは簡単登録</a></div> -->
  <section class="search_result">
    <p>★検討中リスト一覧　全<span class="number"><?= count($jobs) ?></span>件</p>
  </section>
  <section class="job_result">
    <div class="job_result_inner">
      <button type="button" class="reset" id="clear">☆検討中リストから全て削除する</button>
      <script>
        $('#clear').click(function () {
          if (confirm('検討中リストから全て削除しますか？')) {
            $.ajax({
              type: "POST",
              url: '/favorites/clear',
              success: function () {
                location.reload();
              },
            });
          }
        });
      </script>
      <div class="pagination">
        <div class="page">
          <?= $this->pagination->create_links(); ?>
        </div>
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
              <div class="table_area">
                <table>
                  <tr>
                    <th class="attribute">給料</th>
                    <td><?= $job['salary'] ?></td>
                  </tr>
                  <tr>
                    <th class="attribute">勤務地</th>
                    <td><?= $job['a_pref'] ?><?= $job['city'] ?><?= $job['address'] ?></td>
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
                  <tr>
                    <th class="attribute">必要資格</th>
                    <td><?= $job['has_requirement'] ?></td>
                  </tr>
                </table>
                <small><?= str_replace(',', ' / ', $job['traits']) ?></small>
              </div>
              <img src="/uploads/top_picture/<?= $job['top_picture'] ?>" width="260" height="180">
              <ul class="button_area">
                <li>
                  <button class="favorite_btn favorite_btn--remove" job-id="<?= $job['id'] ?>">★ 検討中リストから削除する</button>
                </li>
                <li><a href="/jobs/<?= $job['id'] ?>">詳細を見る</a></li>
              </ul>
            </div>
          </div>
        <?php endforeach; ?>
        <script src="/assets/js/favorite_btn.js"></script>
      <?php endif; ?>

      <div class="pagination">
        <div class="page">
          <?= $this->pagination->create_links(); ?>
        </div>
      </div>
    </div>
  </section>
</main>
<?php include ('footer.php'); ?>