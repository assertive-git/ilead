<?php include('header.php'); ?>

<main id="job_list">

  <input id="block-01" type="checkbox" class="toggle">
  <label class="menu_accordion sp" for="block-01">検索条件を変更する</label>

  <!--<div class="registration"><a href="" target="_blank">まずは簡単登録</a></div>-->

  <section class="search_area">
    <form class="search_form" action="/job_list" method="POST">
      <div class="search_inner">
        <ul>
          <li class="areas"><button type="button" data-modal="modal1" class="modal-toggle">エリアを選ぶ<span
                class="plus <?= !empty($areas) ? 'active' : '' ?>">+</span></button>
          </li>
          <li class="stations"><button type="button" data-modal="modal2" class="modal-toggle">沿線・駅を選ぶ<span
                class="plus <?= !empty($stations) ? 'active' : '' ?>">+</span></button></li>
          <li class="job_types"><button type="button" data-modal="modal3" class="modal-toggle">職種を選ぶ<span
                class="plus <?= !empty($job_types) ? 'active' : '' ?>">+</span></button></li>
          <li class="categories"><button type="button" data-modal="modal4" class="modal-toggle">施設・種別を選ぶ<span
                class="plus <?= !empty($categories) ? 'active' : '' ?>">+</span></button></li>
          <li class="employment_types"><button type="button" data-modal="modal5" class="modal-toggle">雇用形態/給与を選ぶ<span
                class="plus <?= !empty($employment_types) ? 'active' : '' ?>">+</span></button></li>
          <li class="traits"><button type="button" data-modal="modal6" class="modal-toggle">こだわり<span
                class="plus <?= !empty($traits) ? 'active' : '' ?>">+</span></button>
          </li>
          <li class="freeword">
            <input type="text" placeholder="フリーワード" name="freeword" value="<?= $freeword ?>">
            <input type="submit" value="&#xf002">
          </li>
          <li class="search-submit">
            <input type="submit" value="検索する &#xf002">
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
                  <div class="list_img"><img src="/public/uploads/top_picture/<?= $job['top_picture'] ?>"></div>
                </div>

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
          <script src="/public/assets/js/favorite_btn.js"></script>
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
<?php include('footer.php'); ?>