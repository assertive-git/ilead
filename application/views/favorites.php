<?php include ('header.php'); ?>
<main id="mypage">
  <!-- <div class="registration pc"><a href="/job_list">まずは簡単登録</a></div> -->
  <section class="search_result">
    <p>★検討中リスト　全<span class="number"><?= $total_jobs ?></span>件</p>
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
              <p class="result_title"><?= ellipsize($job['title'], 43) ?></p>

              <div class="result_tbl">
                <div class="table_area">
                  <table>
                    <tr>
                      <th class="attribute">給与</th>
                      <td><?= $job['salary'] ?>円</td>
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
                    <?php if(!empty($job['closest_bus_stop'])): ?>
                    <tr>
                      <th class="attribute">バス停</th>
                      <td><?= $job['closest_bus_stop'] ?></td>
                    </tr>
                    <?php endif; ?>
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
                <?php if (file_exists('./public/uploads/top_picture/' . $job['top_picture'])): ?>
                  <div class="list_img"><img src="/public/uploads/top_picture/<?= $job['top_picture'] ?>"></div>
                <?php else: ?>
                  <div class="list_img"><img src="/public/assets/img/dummy.jpg"></div>
                <?php endif; ?>
              </div>
              
              <ul class="button_area">
                <li>
                  <button class="favorite_btn favorite_btn--remove" job-id="<?= $job['id'] ?>">★ 検討中リストから削除する</button>
                </li>
                <li><a href="/jobs/<?= $job['id'] ?>?favorites=1" target="_blank" rel="opener">詳細を見る</a></li>
              </ul>
            </div>
          </div>
        <?php endforeach; ?>
        <script src="/public/assets/js/favorite_btn.js?v=<?= date('YmdHis') ?>"></script>
      <?php endif; ?>


      <p class="number2">検討中求人：<span class="big"><?= $total_jobs ?></span>件
        <?php if ($total_jobs > 10): ?>
          （<?= $current_index_start ?>～<?= $current_index_end ?>件）
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