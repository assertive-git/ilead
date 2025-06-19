<?php include('header.php'); ?>
<main id="job_single">
  <!-- <div class="registration"><a href="/job_list">まずは簡単登録</a></div> -->

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
        <button type="reset" class="reset">クリア</button>
      </div>
    </div>
  </section> -->
  <div class="fixed_btn_list">
    <div class="registration sp"><a style="background-color: #ff8900" href="/jobs/entry/<?= $job['id'] ?>">応募する</a></div>
    <div class="registration pc"><a href="/jobs/entry/<?= $job['id'] ?>">まずは簡単登録</a></div>
    <div class="tel"><a href="tel:06-6210-4371">お電話はこちら</a></div>
  </div>
  <section class="search_result">
    <?php if (!empty($_GET['favorites'])): ?>
      <a href="javascript:void(0);">
        <button id="return" class="arrow_before favorites">検討中リストへ戻る</button>
      </a>
    <?php else: ?>
      <a href="javascript:void(0);">
        <button id="return" class="arrow_before">
          一覧へ戻る
        </button>
      </a>
    <?php endif; ?>
  </section>
  <section class="job_result">
    <div class="job_result_inner">
      <div class="job_result_wrap">
        <div class="inner">
          <?php if (!empty($job['category'])): ?>
            <div class="category">
              <?php foreach (explode(',', $job['category']) as $category): ?>
                <span>
                  <?= $category ?>
                </span>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
          <p class="result_title">
            <?= $job['title'] ?>
          </p>
          <div class="result_tbl">
            <?php if (file_exists('./public/uploads/top_picture/' . $job['top_picture'])): ?>
              <div class="result_img1"><img src="/public/uploads/top_picture/<?= $job['top_picture'] ?>"></div>
            <?php else: ?>
              <div class="result_img1"><img src="/public/assets/img/dummy.jpg"></div>
            <?php endif; ?>
            <div class="table_area">
              <table>
                <tr>
                  <th cl ass="attribute">給与</th>
                  <td><?= $job['salary'] ?>円</td>
                </tr>
                <tr>
                  <th class="attribute">勤務地</th>
                  <td><?= $job['a_pref'] ?>
                    <?= $job['city'] ?>
                  </td>
                </tr>
                <tr>
                  <th class="attribute">最寄り駅</th>
                  <td>
                    <?php foreach ($job['jobs_stations'] as $job_station): ?>
                      <?= $job_station['line'] ?>
                      <?= str_replace('駅', '', $job_station['station']) ?>駅
                      徒歩<?= $job_station['walking_distance'] ?>分<br />
                    <?php endforeach; ?>
                  </td>
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
              <small>
                <?= str_replace(',', ' / ', $job['traits']) ?>
              </small>
            </div>
          </div>

          <div class="job_detail">
            <!-- <dt>【仕事内容】</dt> -->
            <div>
              <?= $job['body'] ?>
            </div>
          </div>
          <!-- <img src="/public/assets/img/detail_img.png" width="336" height="207" class="detail_img"> -->
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
              <td><?= $job['salary'] ?>円</td>
            </tr>
            <tr>
              <th class="attribute">職種名</th>
              <td><?= $job['job_type'] ?></td>
            </tr>
            <tr>
              <th class="attribute">住所</th>
              <td><?= $job['a_pref'] ?>
                <?= $job['city'] ?>
                <?= $job['address'] ?>
              </td>
            </tr>
            <?php if (!empty($job['closest_bus_stop'])): ?>
              <tr>
                <th class="attribute">バス停</th>
                <td><?= $job['closest_bus_stop'] ?></td>
              </tr>
            <?php endif; ?>
            <?php foreach ($job['custom_fields'] as $custom_field): ?>
              <tr>
                <th class="attribute"><?= $custom_field['title'] ?></th>
                <td><?= nl2br($custom_field['detail']) ?></td>
              </tr>
            <?php endforeach; ?>
          </table>
          <ul class="button_area">
            <li>
              <button class="favorite_btn<?= in_array($job['id'], $favorites) ? ' favorite_btn--remove' : '' ?>"
                status="<?= !in_array($job['id'], $favorites) ? 0 : 1 ?>" job-id="<?= $job['id'] ?>">★
                <?= in_array($job['id'], $favorites) ? '検討中リストから削除する' : '検討中リストに追加する' ?>
              </button>
            </li>
            <li>
              <a href="/jobs/entry/<?= $job['id'] ?>">応募する</a>
            </li>
          </ul>
          <script src="/public/assets/js/favorite_btn.js?v=<?= date('YmdHis') ?>"></script>
        </div>
      </div>
    </div>
  </section>
  <!-- <section class="recommendation">
    <h3>おすすめの求人</h3>
    <div class="recruitment_slider_wrap">
      <div class="recruitment_slider">
        <div class="slide_item"> <img src="/public/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給与</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/public/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給与</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/public/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給与</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/public/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給与</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/public/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給与</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="/public/assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給与</span>【時給】1,400円</dd>
          </dl>
        </div>
      </div>
    </div>
  </section> -->

  <?php if ($job['gfj']): ?>
    <script type="application/ld+json">
        {
          "@context": "http://schema.org/",
          "@type": "JobPosting",
          "title": "<?= $job['title'] ?>",
          "description": "<?= str_replace(['"', "\\"], ["", ""], strip_tags($job['body'], '<br>')) ?>",
          "identifier": {
            "@type": "PropertyValue",
            "name": "",
            "value": "MC-022"
          },
          "hiringOrganization": {
            "@type": "Organization",
            "name": "株式会社アイリード",
            "sameAs": "<?= base_url() ?>",
            "logo": "/public/uploads/top_picture/<?= $job['top_picture'] ?>"
          },
          "employmentType": "<?= $job['employment_type'] ?>",
          "workHours": "<?= $job['gfj_working_hours'] ?>",
          "datePosted": "<?= $job['gfj_listing_start_date'] ?>",
          "validThrough": "<?= date('Y-m-d', strtotime(date("Y-m-d", time()) . " + 365 day")) ?>",
          "jobLocation": {
            "@type": "Place",
            "address": {
              "@type": "PostalAddress",
              "streetAddress": "<?= $job['address'] ?>",
              "addressLocality": "<?= $job['city'] ?>",
              "addressRegion": "<?= $job['a_pref'] ?>",
              "postalCode": "0000000",
              "addressCountry": "JA"
            }
          },
          "baseSalary": {
            "@type": "MonetaryAmount",
            "currency": "JPY",
            "value": {
              "@type": "QuantitativeValue",
              "minValue": "<?= $job['min_salary'] ?>",
              "maxValue": "<?= $job['max_salary'] ?>",
              "unitText": "<?= $job['gfj_employment_type'] ?>"
            }
          }
        }
      </script>
  <?php endif; ?>

  <script>
    $('#return').click(function() {

      function isLineApp() {
          return /Line/i.test(navigator.userAgent);
      }

      if(isLineApp) {
        location.href = '/job_list'
      } else if (window.opener) {
            window.opener.focus();  // Focus the opener tab
            window.close();         // Close the current tab
      } else {
          location.href = '/job_list'
      }
    });
  </script>
</main>
<?php include('footer.php'); ?>