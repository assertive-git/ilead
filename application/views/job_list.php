﻿<?php include('header.php'); ?>

<main id="job_list">
  <div class="fixed_btn_list">
    <div class="registration"><a href="/jobs/entry">まずは簡単登録</a></div>
    <div class="tel"><a href="tel:06-6210-4371">お電話はこちら</a></div>
  </div>

  <input id="block-01" type="checkbox" class="toggle">
  <label class="menu_accordion sp" for="block-01">検索条件を変更する</label>

  <!--<div class="registration"><a href="" target="_blank">まずは簡単登録</a></div>-->

  <section class="search_area">
    <form class="search_form" action="/job_list" method="POST">
      <div class="search_inner">
        <ul>
          <li class="areas_h <?= !empty($areas) ? 'active' : '' ?>"><button type="button" data-modal="modal1" class="modal-toggle">エリアを選ぶ<span
                class="plus not-active">+</span><i class="fa-solid fa-circle-check plus active"></i></button>
          </li>
          <li class="stations_h <?= !empty($stations) ? 'active' : '' ?>"><button type="button" data-modal="modal2" class="modal-toggle">沿線・駅を選ぶ<span
                class="plus not-active">+</span><i class="fa-solid fa-circle-check plus active"></i></button></li>
            <li class="job_types <?= !empty($job_types) ? 'active' : '' ?>"><button type="button" data-modal="modal3" class="modal-toggle">職種を選ぶ<span
                class="plus not-active">+</span><i class="fa-solid fa-circle-check plus active"></i></button></li>
          <li class="categories <?= !empty($categories) ? 'active' : '' ?>"><button type="button" data-modal="modal4" class="modal-toggle">施設・種別を選ぶ<span
                class="plus not-active">+</span><i class="fa-solid fa-circle-check plus active"></i></button></li>
          <li class="employment_types <?= !empty($employment_types) ? 'active' : '' ?>"><button type="button" data-modal="modal5" class="modal-toggle">雇用形態/給与を選ぶ<span
                class="plus not-active">+</span><i class="fa-solid fa-circle-check plus active"></i></button></li>
          <li class="traits <?= !empty($traits) ? 'active' : '' ?>"><button type="button" data-modal="modal6" class="modal-toggle">こだわり<span
                class="plus not-active">+</span><i class="fa-solid fa-circle-check plus active"></i></button>
          </li>
          <li class="freeword">
            <input type="text" placeholder="フリーワード" name="freeword" value="<?= $freeword ?>">
            <input type="button" class="submit_t" value="&#xf002">
          </li>
          <li class="search-submit">
            <input type="button" class="submit_t" value="検索する &#xf002">
          </li>
        </ul>

      </div>
      <?php include APPPATH . 'includes/search_modal.php' ?>
    </form>

  </section>

  <section class="search_result">
    <p>検索結果一覧　全<span class="number"><?= $total_jobs ?></span>件</p>
  </section>
  <section class="job_result">
    <div class="pagination">
      <div class="page">
        <?= $this->pagination->create_links(); ?>
      </div>
    </div>
    <div class="job_result_inner">
      <p class="number">新着求人：<span class="big"><?= $total_jobs ?></span>件
        <?php if ($total_jobs > 10): ?>
                （<?= $current_index_start ?>～<?= $current_index_end ?>件）
        <?php endif; ?>
      </p>
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
                                    <td><?= $job['pref'] ?><?= $job['city'] ?><?= $job['address'] ?></td>
                                  </tr>
                                  <tr>
                                    <th class="attribute">最寄り駅</th>
                                    <td><?= $job['jobs_stations'] ?></td>
                                  </tr>
                                  <?php if (!empty($job['closest_bus_stop'])): ?>
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
                                <button class="favorite_btn<?= in_array($job['id'], $favorites) ? ' favorite_btn--remove' : '' ?>"
                                  status="<?= !in_array($job['id'], $favorites) ? 0 : 1 ?>" job-id="<?= $job['id'] ?>">★
                                  <?= in_array($job['id'], $favorites) ? '検討中リストから削除する' : '検討中リストに追加する' ?></button>
                              </li>
                              <li><a href="/jobs/<?= $job['id'] ?>" target="_blank" rel="opener">詳細を見る</a></li>
                            </ul>
                          </div>
                        </div>
                <?php endforeach; ?>
                <script src="/public/assets/js/favorite_btn.js?v=<?= date('YmdHis') ?>"></script>
        <?php endif; ?>
      </div>
      <p class="number2">新着求人：<span class="big"><?= $total_jobs ?></span>件
        <?php if ($total_jobs > 10): ?>
                （<?= $current_index_start ?>～<?= $current_index_end ?>件）
        <?php endif; ?>
      </p>
    </div>
    <div class="pagination">
      <div class="page">
        <?= $this->pagination->create_links(); ?>
      </div>
    </div>
  </section>
</main>
<script>
  if (window.history.replaceState) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
<?php include('footer.php'); ?>