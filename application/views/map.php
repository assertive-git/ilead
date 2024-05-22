<?php include ('header.php'); ?>

<main id="map">

  <!--<div class="registration"><a href="" target="_blank">まずは簡単登録</a></div>-->

  <section class="search_area">
    <div class="search_inner">
      <ul>
        <li class="workarea"><a href=""> エリアを選ぶ<span class="plus">+</span> </a></li>
        <li class="station"><a href=""> 沿線・駅を選ぶ<span class="plus">+</span> </a></li>
        <li class="facility"><a href=""> 施設・種別を選ぶ<span class="plus">+</span> </a></li>
        <li class="form"><a href=""> 雇用形態/給与を選ぶ<span class="plus">+</span> </a> </li>
        <li><a href="">こだわり<span class="plus">+</span> </a></li>
        <li class="freeword">
          <form method="POST" action="/map?s=freeword"><input name="freeword" value="<?= set_value('freeword') ?>"
              type="text" placeholder="フリーワード"><input type="submit" value="&#xf002"></form>
        </li>
      </ul>
      <div class="button_area">
        <button type="reset" class="reset">すべてクリア</button>
      </div>
    </div>
  </section>

  <section class="side_list">
    <div class="menu-trigger active" href=""> <span><img src="assets/img/map_arrow_open.png"></span></div>
    <script>
      $('.menu-trigger').click(function () {
        var img = $(this).children('span').children('img');

        if ($(this).hasClass('active')) {
          img.attr('src', 'assets/img/map_arrow_open.png');
        } else {
          img.attr('src', 'assets/img/map_arrow_close.png');
        }
      })
    </script>
    <div class="list open">
      <p>検索結果一覧　全<span class="number"><?= count($jobs) ?></span>件</p>
      <?php $job_ids = []; ?>
      <?php foreach ($jobs as $job): ?>
        <?php $job_ids[] = $job['id']; ?>
        <ul class="list_inner">
          <li>
            <!-- <a href=""> -->
            <div class="list_item" job-link="/jobs/<?= $job['id'] ?>">
              <div class="info">
                <h5><?= ellipsize($job['title'], 18) ?></h5>
                <img src="/uploads/top_picture/<?= $job['top_picture'] ?>" width="100" height="81">
                <div class="info_inner">
                  <?php if (!empty($job['category'])): ?>
                    <?php $i = 0 ?>
                    <div class="category">
                      <?php foreach (explode(',', $job['category']) as $category): ?>
                        <span><?= ellipsize($category, 3) ?></span>
                        <?php $i++; ?>
                        <?php if ($i == 2)
                          break ?>
                      <?php endforeach ?>
                    </div>
                  <?php endif; ?>
                  <ul>
                    <li><span class="attribute">勤務地</span><?= $job['city'] ?></li>
                    <?php $job['min_salary'] = number_format($job['min_salary']); ?>
                    <?php $job['max_salary'] = number_format($job['max_salary']); ?>
                    <?php $job['min_salary'] = substr_count($job['min_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['min_salary']) / 10000)) . '万' : $job['min_salary']; ?>
                    <?php $job['max_salary'] = substr_count($job['max_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['max_salary']) / 10000)) . '万' : $job['max_salary']; ?>
                    <?php if (!empty($job['max_salary'])): ?>
                      <li><span class="attribute">給料</span>【<?= $job['salary_type'] ?>】<?= $job['min_salary'] ?>～<?= $job['max_salary'] ?>円</li>
                    <?php else: ?>
                      <li><span class="attribute">給料</span>【<?= $job['salary_type'] ?>】<?= $job['min_salary'] ?>円</li>
                    <?php endif; ?>
                    <li><input id="map_address" type="hidden" value="<?= $job['map_address'] ?>"></li>
                    <li><input id="lat" type="hidden" value="<?= $job['lat'] ?>"></li>
                    <li><input id="lng" type="hidden" value="<?= $job['lng'] ?>"></li>
                  </ul>
                </div>
              </div>
              <div class="arrow"><i class="fa-solid fa-angle-right"></i></div>
            </div>
            <!-- </a> -->
          </li>
        </ul>
      <?php endforeach; ?>
    </div>
  </section>


  <section class="map">
    <div id="_map" class="google_map"></div>
    <script>
      function initMap() {

        var map = new google.maps.Map(document.getElementById("_map"));

        $.ajax({
          type: "POST",
          url: '/get_jobs_by_ids',
          data: {
            job_ids: [<?= implode(',', $job_ids) ?>]
          },
          dataType: 'json',
          success: function (data) {

            var bounds = new google.maps.LatLngBounds();

            for (i = 0; i < data.jobs.length; i++) {

              var marker = new google.maps.Marker({
                position: { lat: parseFloat(data.jobs[i].lat), lng: parseFloat(data.jobs[i].lng) },
                title: data.jobs[i].title,
              });

              marker.setMap(map);
              bounds.extend(marker.getPosition());
            }
            map.fitBounds(bounds);


            if (map.getZoom() > 17) {
              map.setZoom(17);
            }
          },
        });


        $('.list_item').click(function () {

          if (!$('.list_item.active').is($(this))) {
            $('.list_item.active').removeClass('active');
          }

          if ($(this).hasClass('active')) {
            window.location.href = $(this).attr('job-link');
            return;
          } else {
            $(this).addClass('active');
          }

          var lat = parseFloat($(this).find('#lat').val());
          var lng = parseFloat($(this).find('#lng').val());

          var title = $(this).find('#map_address').val();

          map.setCenter({ lat: lat, lng: lng });
        });
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmVMSJ-FB7idtnAQajLhCIo2SV7VZd7uw&callback=initMap">
    </script>
  </section>







</main>


<?php include ('footer.php'); ?>