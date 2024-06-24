<?php include ('header.php'); ?>

<main id="map">

  <input id="block-01" type="checkbox" class="toggle">
  <label class="menu_accordion sp" for="block-01">検索条件を変更する</label>

  <!--<div class="registration"><a href="" target="_blank">まずは簡単登録</a></div>-->

  <section class="search_area">
    <form id="list" class="area is-active" action="/map" method="POST">
      <div class="search_inner map_in">
        <ul>
          <li class="areas"><button type="button" data-modal="modal1" class="modal-toggle">エリアを選ぶ<span
                class="plus">+</span></button>
          </li>
          <li class="stations"><button type="button" data-modal="modal2" class="modal-toggle">沿線・駅を選ぶ<span
                class="plus">+</span></button></li>
          <li class="categories"><button type="button" data-modal="modal4" class="modal-toggle">施設・種別を選ぶ<span
                class="plus">+</span></button></li>
          <li class="employment_types"><button type="button" data-modal="modal5" class="modal-toggle">雇用形態/給与を選ぶ<span
                class="plus">+</span></button></li>
          <li class="traits"><button type="button" data-modal="modal6" class="modal-toggle">こだわり<span
                class="plus">+</span></button>
          </li>
          <li class="freeword">
            <input name="freeword" type="text" placeholder="フリーワード">
            <input type="submit" value="&#xf002">
          </li>
        </ul>
        <div class="button_area">
          <!-- <button type="reset" class="reset">すべてクリア</button> -->
        </div>
      </div>
      <?php include APPPATH . 'includes/search_modal.php' ?>
    </form>
  </section>

  <section class="side_list">
    <div class="menu-trigger active"> <span><img src="/assets/img/map_arrow_open.png"></span></div>
    <script>
      $('.menu-trigger').click(function () {
        var img = $(this).children('span').children('img');

        if ($(this).hasClass('active')) {
          img.attr('src', '/assets/img/map_arrow_close.png');
        } else {
          img.attr('src', '/assets/img/map_arrow_open.png');
        }
      })
    </script>
    <div id="list" class="list open">
      <p>検索結果一覧　全<span class="number"><?= $total_jobs ?></span>件</p>
      <?php $job_ids = []; ?>
      <?php foreach ($jobs as $job): ?>
        <?php $job_ids[] = $job['id']; ?>
        <ul class="list_inner">
          <li>
            <!-- <a href=""> -->
            <div id="<?= $job['id'] ?>" class="list_item id" job-link="/jobs/<?= $job['id'] ?>">
              <div class="info">
                <h5 class="title"><?= $job['title'] ?></h5>
                <img class="top-picture" src="/uploads/top_picture/<?= $job['top_picture'] ?>" width="100" height="81">
                <div class="info_inner">
                  <?php if (!empty($job['category'])): ?>
                    <?php $i = 0 ?>
                    <div class="category">
                      <?php foreach (explode(',', $job['category']) as $category): ?>
                        <span><?= $category ?></span>
                        <?php $i++; ?>
                        <?php if ($i == 2)
                          break ?>
                      <?php endforeach ?>
                    </div>
                  <?php endif; ?>
                  <ul>
                    <li><span class="attribute">勤務地</span><span class="city"><?= $job['city'] ?></span></li>
                    <li>
                      <span class="attribute">給料</span>
                      <span class="salary"><?= $job['salary'] ?></span>
                    </li>
                    <li><input class="map_address" type="hidden" value="<?= $job['map_address'] ?>"></li>
                    <li><input class="lat" type="hidden" value="<?= $job['lat'] ?>"></li>
                    <li><input class="lng" type="hidden" value="<?= $job['lng'] ?>"></li>
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

              if (!data.jobs[i].lat || !data.jobs[i].lng) continue;

              var marker = new google.maps.Marker({
                position: { lat: parseFloat(data.jobs[i].lat), lng: parseFloat(data.jobs[i].lng) },
                title: data.jobs[i].title,
                job_id: data.jobs[i].id
              });

              google.maps.event.addListener(marker, "click", function (event) {
                var job_id = this.job_id;

                if (!$('#' + job_id).hasClass('active')) {
                  $('#' + job_id).click();


                  $('#' + job_id)[0].scrollIntoView({
                    behavior: 'auto',
                    block: 'center',
                    inline: 'center'
                  });

                }
              });

              marker.setMap(map);
              bounds.extend(marker.getPosition());
            }

            if (bounds) {
              map.fitBounds(bounds);
            }


            if (map.getZoom() > 17) {
              map.setZoom(17);
            }
          },
        });


        $('body').on('click', '.list_item', function () {

          if (!$('.list_item.active').is($(this))) {
            $('.list_item.active').removeClass('active');
          }

          if ($(this).hasClass('active')) {
            window.location.href = $(this).attr('job-link');
            return;
          } else {
            $(this).addClass('active');
          }

          var lat = parseFloat($(this).find('.lat').val());
          var lng = parseFloat($(this).find('.lng').val());

          var title = $(this).find('.map_address').val();

          map.setCenter({ lat: lat, lng: lng });
        });
      }

    </script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmVMSJ-FB7idtnAQajLhCIo2SV7VZd7uw&callback=initMap"></script>
    <script>

      // var offset = 0;
      // var total = $('#list .number').text();

      // $('div[id="list"]').on('scroll', function (e) {

      //   var list = $(this);

      //   console.log(list.scrollTop() + list.innerHeight());
      //   console.log(list[0].scrollHeight);

      //   if (list.scrollTop() + list.innerHeight() >= list[0].scrollHeight - 1) {

      //     offset += 20;

      //     $.ajax({
      //       type: "POST",
      //       url: '/map',
      //       data: {
      //         offset: offset
      //       },
      //       beforeSend: function () {
      //         if(offset)
      //         $('.map_loader').addClass('show');
      //       },
      //       dataType: 'json',
      //       success: function (data) {

      //         $('.map_loader').removeClass('show');

      //         if (data) {
      //           for (var i = 0; i < data.length; i++) {

      //             var clone = $('.list_inner').eq(0).clone();
      //             clone.find('.id').attr('id', data[i].id).attr('job-link', '/jobs/' + data[i].id).removeClass('active');
      //             clone.find('.title').text(data[i].title);
      //             clone.find('.top-picture').text(data[i].top_picture);
      //             clone.find('.category').children('span').remove();

      //             if (data[i].category) {
      //               var category = data[i].category.split(',');
      //               for (var j = 0; j < category.length; j++) {
      //                 clone.find('.category').append('<span>' + category[j] + '</span>');

      //                 if (j == 1) {
      //                   break;
      //                 }
      //               }
      //             }

      //             clone.find('.city').text(data[i].city);
      //             clone.find('.salary').text(data[i].salary);

      //             list.append(clone);
      //           }
      //         }
      //       }
      //     });
      //   }
      // });
    </script>
  </section>
</main>


<?php include ('footer.php'); ?>
