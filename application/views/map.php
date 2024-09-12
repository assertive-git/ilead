<?php include ('header.php'); ?>

<main id="map">

  <input id="block-01" type="checkbox" class="toggle">
  <label class="menu_accordion sp" for="block-01">検索条件を変更する</label>

  <section class="search_area">
    <form id="list" class="area is-active" action="/map" method="POST">
      <div class="search_inner map_in">
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
            <input name="freeword" type="text" placeholder="フリーワード">
            <input type="submit" value="&#xf002">
          </li>
          <li class="search-submit">
            <input type="submit" value="検索する &#xf002">
          </li>
        </ul>
        <div class="button_area">
          <!-- <button type="reset" class="reset">すべてクリア</button> -->
        </div>
      </div>
      <?php include APPPATH . 'includes/search_modal.php' ?>
    </form>
  </section>


  <section class="map">
    <div id="_map" class="google_map"></div>
    <div class="menu-trigger active"> <span><img src="/assets/img/map_arrow_close.png"></span></div>
    <section class="side_list">
      <div id="list_" class="list open">
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
                  <div class="info-tbl">
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
                        <!-- <li><span class="attribute">勤務地</span><span class="city"><?= $job['city'] ?></span></li> -->
                        <li><span class="attribute">雇用形態</span><span class="city"><?= $job['job_type'] ?></span></li>
                        <li>
                          <span class="attribute">給与</span>
                          <span class="salary"><?= $job['salary'] ?></span>
                        </li>
                        <li><input class="map_address" type="hidden" value="<?= $job['map_address'] ?>"></li>
                        <li><input class="lat" type="hidden" value="<?= $job['lat'] ?>"></li>
                        <li><input class="lng" type="hidden" value="<?= $job['lng'] ?>"></li>
                      </ul>
                    </div>
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

    <script>

      function initMap() {

        var map = new google.maps.Map(document.getElementById("_map"), { gestureHandling: "greedy"});

        var markers = [];

        var bounds;

        $.ajax({
          type: "POST",
          url: '/get_jobs_by_ids',
          data: {
            job_ids: [<?= implode(',', $job_ids) ?>]
          },
          dataType: 'json',
          success: function (data) {

            bounds = new google.maps.LatLngBounds();

            for (i = 0; i < data.jobs.length; i++) {

              if (!data.jobs[i].lat || !data.jobs[i].lng) continue;

              var marker = new google.maps.Marker({
                position: { lat: parseFloat(data.jobs[i].lat), lng: parseFloat(data.jobs[i].lng) },
                title: data.jobs[i].title,
                job_id: data.jobs[i].id,
                icon: {
                  url: '/assets/img/map/marker-red.png'
                }
              });

              google.maps.event.addListener(marker, "click", function (event) {
                var job_id = this.job_id;

                if (!$('#' + job_id).hasClass('active')) {

                  $('#' + job_id).click();
                  
                  var $parentDiv = $('#list_');
                  var $targetDiv = $('#' + job_id);

                  // Parent's height and current scroll position
                  var parentHeight = $parentDiv.height();
                  var parentScrollTop = $parentDiv.scrollTop();

                  // Target element's position within the parent
                  var targetOffset = $targetDiv.position().top;
                  var targetHeight = $targetDiv.outerHeight();

                  // Calculate the scroll position to center the target div, considering current scrollTop
                  var scrollPosition = parentScrollTop + targetOffset - (parentHeight / 2) + (targetHeight / 2);

                  $parentDiv.animate({
                      scrollTop: scrollPosition
                  }, 600);
                }
              });

              marker.setMap(map);

              markers.push(marker);

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

        var last_job_id = 0;

        $('body').on('click', '.list_item', function () {
          
          if($(window).width() < 768) {
            $('#_map').css({height: '50%'});

            // if($('.menu-trigger').hasClass('active')) {
            //   $('.menu-trigger img').attr('src', 'assets/img/map_arrow_open.png');
            //   $('.list').removeClass('open');
            // }
          }

          $('.menu-trigger').addClass('active');
          $('.menu-trigger img').attr('src', 'assets/img/map_arrow_close.png');

          $('.list').addClass('open');

          if(last_job_id) {
              for (var i = 0; i < markers.length; i++) {
                if(last_job_id == markers[i].job_id) {
                  markers[i].setAnimation(null);
                  markers[i].setIcon({url: '/assets/img/map/marker-red.png'});
                  break;
                }
            }
          }

          var job_id = $(this).attr('id');
          
          for (var i = 0; i < markers.length; i++) {
            if(job_id == markers[i].job_id) {
              markers[i].setAnimation(google.maps.Animation.BOUNCE);
              markers[i].setIcon({url: '/assets/img/map/marker-yellow.png'});
              last_job_id = job_id;
              break;
            }
          }

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


          map.setCenter({ lat: lat, lng: lng });

        });

        var areas = [];
        var _areas = $('input[name="areas[]"]:checked');
        $(_areas).each(function (i, el) {
          areas.push($(_areas[i]).val());
        });

        var stations = [];
        var _stations = $('input[name="stations[]"]:checked');
        $(_stations).each(function (i, el) {
          stations.push($(_stations[i]).val());
        });

        var categories = [];
        var _categories = $('input[name="categories[]"]:checked');
        $(_categories).each(function (i, el) {
          categories.push($(_categories[i]).val());
        });

        var job_types = [];
        var _job_types = $('input[name="job_types[]"]:checked');
        $(_job_types).each(function (i, el) {
          job_types.push($(_job_types[i]).val());
        });

        var employment_types = [];
        var _employment_types = $('input[name="employment_types[]"]:checked');
        $(_employment_types).each(function (i, el) {
          employment_types.push($(_employment_types[i]).val());
        });

        var yearly = $('select[name="salary[yearly]"]').val();
        var hourly = $('select[name="salary[hourly]"]').val();

        var traits = [];
        var _traits = $('input[name="traits[]"]:checked');
        $(_traits).each(function (i, el) {
          traits.push($(_traits[i]).val());
        });

        var freeword = $('input[name="freeword"]').val();

        var offset = 0;


        $('div[id="list_"]').on('scroll', function (e) {

          var list = $(this);

          if (list.scrollTop() + list.innerHeight() >= list[0].scrollHeight - 1) {

            offset += 50;

            $.ajax({
              type: "POST",
              url: '/map',
              data: {
                areas: areas,
                stations: stations,
                salary: {
                  yearly: yearly,
                  hourly: hourly,
                },
                categories: categories,
                job_types: job_types,
                employment_types: employment_types,
                traits: traits,
                freeword: freeword,
                offset: offset,
                ajax: 1,
              },
              dataType: 'json',
              success: function (data) {

                if (data.jobs.length != 0) {

                  for (var i = 0; i < data.jobs.length; i++) {

                    var clone = $('.list_inner').eq(0).clone();
                    clone.find('.id').attr('id', data.jobs[i].id).attr('job-link', '/jobs/' + data.jobs[i].id).removeClass('active');
                    clone.find('.title').text(data.jobs[i].title);
                    clone.find('.top-picture').text(data.jobs[i].top_picture);
                    clone.find('.category').children('span').remove();

                    if (data.jobs[i].category) {
                      var category = data.jobs[i].category.split(',');
                      for (var j = 0; j < category.length; j++) {
                        clone.find('.category').append('<span>' + category[j] + '</span>');

                        if (j == 1) {
                          break;
                        }
                      }
                    }

                    clone.find('.city').text(data.jobs[i].city);
                    clone.find('.salary').text(data.jobs[i].salary);

                    list.append(clone);

                    if (!data.jobs[i].lat || !data.jobs[i].lng) continue;


                    var marker = new google.maps.Marker({
                      position: { lat: parseFloat(data.jobs[i].lat), lng: parseFloat(data.jobs[i].lng) },
                      title: data.jobs[i].title,
                      job_id: data.jobs[i].id,
                      icon: {
                        url: '/assets/img/map/marker-red.png'
                      }
                    });


                    google.maps.event.addListener(marker, "click", function (event) {

                      var job_id = this.job_id;

                      if (!$('#' + job_id).hasClass('active')) {
                        $('#' + job_id).click();

                        var $parentDiv = $('#list_');
                        var $targetDiv = $('#' + job_id);

                        // Parent's height and current scroll position
                        var parentHeight = $parentDiv.height();
                        var parentScrollTop = $parentDiv.scrollTop();

                        // Target element's position within the parent
                        var targetOffset = $targetDiv.position().top;
                        var targetHeight = $targetDiv.outerHeight();

                        // Calculate the scroll position to center the target div, considering current scrollTop
                        var scrollPosition = parentScrollTop + targetOffset - (parentHeight / 2) + (targetHeight / 2);

                        $parentDiv.animate({
                            scrollTop: scrollPosition
                        }, 600);
                      }
                    });

                    marker.setMap(map);

                    markers.push(marker);
                  }
                }
              }
            });
          }
        });

        $('.menu-trigger').appendTo('#_map');

      }

    </script>

    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmVMSJ-FB7idtnAQajLhCIo2SV7VZd7uw&callback=initMap"></script>
  </section>
</main>


<div class="pc"><?php include ('footer.php'); ?></div>