<?php include ('header.php'); ?>
<?php include (APPPATH . 'libraries/japan_regions.php'); ?>

<main>
  <section class="main_img">
    <p class="main_copy">薬剤師による、<br>
      薬剤師のための<br class="sp">転職支援<br>
      <span class="sub_copy">Career change support by <br class="sp">pharmacists for pharmacists</span>
    </p>
  </section>

  <!-- <div class="registration"><a href="" target="_blank">まずは簡単登録</a></div> -->

  <section class="search">
    <ul class="tab">
      <li class="active"><a href="#list"><i class="fa-regular fa-square-check"></i>&nbsp;リストから探す</a></li>
      <li><a href="#googlemap"><i class="fa-solid fa-location-dot"></i>&nbsp;GoogleMAPから探す</a></li>
    </ul>
    <form id="list" class="area is-active" action="/job_list" method="POST">
      <div class="search_inner">
        <ul class="main7">
          <li class="areas">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal1">エリア<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="stations">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal2">沿線・駅<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="job_types">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal3">職種<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="categories">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal4">施設・種別<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="employment_types">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal5">雇用形態/給与<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="traits">
            <button type="button" type="button" class="modal-toggle btn-example"
              data-modal="modal6">こだわり<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
          <li class="freeword">
            <h4>フリーワード検索<span>勤務地、条件など好きな言葉で検索する</span></h4>
            <input type="text" placeholder="例：残業なし" name="freeword">
          </li>
          <li class="number_text">
            <p class="number">該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</p>
          </li>
        </ul>
        <ul class="button_area">
          <li>
            <button type="submit" class="submit">検索する <i class="fa-solid fa-magnifying-glass"></i></button>
          </li>
          <li>
            <button type="button" class="reset">すべてクリア</button>
          </li>
        </ul>
      </div>

      <!-- modal1 -->
      <div id="modal1" class="modal">
        <div class="modal-content">
          <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
          <div class="modal_container">
            <h4>エリアを選ぶ</h4>
            <div class="region">
              <?php foreach ($japan_regions as $japan_region_key => $japan_region): ?>
                <input type="radio" id="region_area_<?= $japan_region_key ?>" name="region_area"
                  <?= $japan_region['name'] == '近畿' ? 'checked' : '' ?>>
                <label for="region_area_<?= $japan_region_key ?>"><?= $japan_region['name'] ?></label>
              <?php endforeach; ?>
            </div>
            <div class="prefectures">
              <?php foreach ($japan_regions as $japan_region_key => $japan_region): ?>
                <?php foreach ($japan_region['prefectures'] as $pref_id => $prefecture): ?>
                  <?php if ($japan_region['name'] == '近畿'): ?>
                    <input type="radio" id="prefectures_area_<?= $pref_id ?>" value="<?= $pref_id ?>" name="prefecture_area">
                    <label class="prefecture_area" region_id="<?= $japan_region_key ?>"
                      for="prefectures_area_<?= $pref_id ?>"><?= $prefecture ?></label>
                  <?php else: ?>
                    <input type="radio" id="prefectures_area_<?= $pref_id ?>" value="<?= $pref_id ?>" name="prefecture_area">
                    <label class="prefecture_area" region_id="<?= $japan_region_key ?>" style="display: none"
                      for="prefectures_area_<?= $pref_id ?>"><?= $prefecture ?></label>
                    <?php ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </div>
            <div class="search_inner">
              <div class="choice"></div>
            </div>
            <ul class="button_area">
              <li>該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</li>
              <li>
                <button type="button" class="submit reflect">選択した内容を反映する</button>
              </li>
              <li>
                <button type="button" class="reset">すべてクリア</button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- modal2 -->
      <div id="modal2" class="modal">
        <div class="modal-content">
          <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
          <div class="modal_container">
            <h4>沿線・駅を選ぶ</h4>
            <div class="region">
              <?php foreach ($japan_regions as $japan_region_key => $japan_region): ?>
                <input class="region_route" type="radio" id="region_<?= $japan_region_key ?>" name="region_route">
                <label for="region_<?= $japan_region_key ?>"><?= $japan_region['name'] ?></label>
              <?php endforeach; ?>
            </div>
            <div class="prefectures">
              <?php foreach ($japan_regions as $japan_region_key => $japan_region): ?>
                <?php foreach ($japan_region['prefectures'] as $pref_id => $prefecture): ?>
                  <?php if ($japan_region['name'] == '近畿'): ?>
                    <input type="radio" id="prefecture_route_<?= $pref_id ?>" value="<?= $pref_id ?>" name="prefecture_route">
                    <label class="prefecture_route" region_id="<?= $japan_region_key ?>"
                      for="prefecture_route_<?= $pref_id ?>"><?= $prefecture ?></label>
                  <?php else: ?>
                    <input type="radio" id="prefecture_route_<?= $pref_id ?>" value="<?= $pref_id ?>" name="prefecture_route">
                    <label class="prefecture_route" region_id="<?= $japan_region_key ?>"
                      for="prefecture_route_<?= $pref_id ?>" style="display: none"><?= $prefecture ?></label>
                  <?php endif; ?>
                <?php endforeach; ?>
              <?php endforeach; ?>
            </div>
            <div class="choice2">

              <div class="route">
                <h5>路線を選択</h5>
                <div class="choice_inner" style="visibility: hidden">
                  <p class="choice_ttl"><span class="choice_ttl_pref"></span></p>
                  <ul class="scroll_inner"></ul>
                </div>
              </div>

              <div class="station">
                <h5>駅を選択</h5>
                <div class="choice_inner" style="visibility: hidden">
                  <p class="choice_ttl"><span class="choice_ttl_line"></span></p>
                  <ul class="scroll_inner"></ul>
                </div>
              </div>

            </div>
            <ul class="button_area">
              <li>該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</li>
              <li>
                <button type="button" class="submit reflect">選択した内容を反映する</button>
              </li>
              <li>
                <button type="button" class="reset">すべてクリア</button>
              </li>
            </ul>
          </div>
        </div>

        <script>

          var lines = [];
          var pref_cd = 26;
          var stations = [];
          var lines_and_stations = [];
          var scroll_inner = $('#modal2 .route .scroll_inner');
          var scroll_inner2 = $('#modal2 .station .scroll_inner');

          $.ajax({
            type: "POST",
            url: '/get_lines_and_stations',
            dataType: 'json',
            success: function (data) {
              lines = data.lines;
              stations = data.stations;

              $(stations).each(function (i, x) {

                var pref_cd = parseInt(x.pref_cd) - 1;

                var line = lines.filter(e => e.line_cd === x.line_cd)[0];

                if (lines_and_stations[pref_cd] === undefined) {
                  lines_and_stations[pref_cd] = {
                    lines: [{ line_name: line.line_name, stations: [x.station_name] }]
                  };
                } else {
                  var line_found = false;

                  $(lines_and_stations[pref_cd].lines).each(function (i, el) {
                    if (el.line_name == line.line_name) {
                      lines_and_stations[pref_cd].lines[i].stations.push(x.station_name);
                      line_found = true;
                      return false;
                    }
                  });

                  if (!line_found) {
                    lines_and_stations[pref_cd].lines.push({
                      line_name: line.line_name,
                      stations: [x.station_name]
                    })
                  }
                }
              });

              // var html = '';

              // for (i = 0; i < lines_and_stations[pref_cd].lines.length; i++) {
              //   html += '<li><input id="line000' + (i + 1) + '" type="radio" style="display: none" value="' + lines_and_stations[pref_cd].lines[i].line_name + '" name="line"><label for="line000' + (i + 1) + '">' + lines_and_stations[pref_cd].lines[i].line_name + '</label></li>';
              // }

              // $('#region_5').prop('checked', true);
              // $('input[id="prefecture_route_27"]').prop('checked', true);

              // scroll_inner.append(html);

              // // 路線
              // $('.route .scroll_inner li').eq(4).children('input').prop('checked', true);
              // $('.route .scroll_inner li').eq(4).children('input').change();

              $('input').prop('checked', false);
            },
          });

          $('#modal1 .region input[name="region_area"]').change(function () {

            var region_id = $(this).attr('id').replace('region_area_', '');

            $('.prefecture_area').css({ display: 'none' });
            $('.prefecture_area[region_id="' + region_id + '"]').removeAttr('style');

            $('#modal1 .prefectures input[name="prefecture_area"]').prop('checked', false);

            $('#modal1 .search_inner').css({ visibility: 'hidden' });
          });

          $('#modal1 .prefectures input[name="prefecture_area"]').change(function () {
            var pref = $(this).next().text();
            setAreas(pref);
          });

          function setAreas(pref) {
            var choice = $('#modal1 .search_inner .choice');

            $.ajax({
              dataType: 'jsonp',
              url: 'https://geoapi.heartrails.com/api/json?method=getCities&prefecture=' + pref,
              success: function (results) {

                var html = '<input type="checkbox" id="municipalities_all" name="areas[]" value="すべて"><label for="municipalities_all">すべて</label>';

                $(results.response.location).each(function (i, el) {
                  var city = results.response.location[i].city;
                  html += '<input type="checkbox" id="municipalities' + (i + 1) + '" name="areas[]" value="' + city + '"><label for="municipalities' + (i + 1) + '">' + city + '</label>';
                });

                html += '<input type="hidden" name="pref" value="' + pref + '">';

                choice.children().remove();
                choice.append(html);
                $('#modal1 .search_inner').removeAttr('style');
              },
              error: function (err) {
                console.log(err);
              }
            });
          }

          // setAreas('大阪府');

          $('#modal2 .region input[name="region_route"]').change(function () {

            var region_id = $(this).attr('id').replace('region_', '');
            $('.prefecture_route').css({ display: 'none' });
            $('.prefecture_route[region_id="' + region_id + '"]').removeAttr('style');

            $('#modal2 .prefectures input[name="prefecture_route"]').prop('checked', false);
            $('.route .choice_inner').css({ visibility: 'hidden' });
            $('.station .choice_inner').css({ visibility: 'hidden' });
          });

          $('#modal2 .prefectures input[name="prefecture_route"]').change(function () {

            $('.station .choice_inner').css({ visibility: 'hidden' });

            var pref = $(this).next().text();
            pref_cd = parseInt($(this).val()) - 1;
            var scroll_inner = $('#modal2 .route .scroll_inner');

            $('#modal2 .route .choice_ttl_pref').text(pref);

            var html = '';
            var html2 = '';

            lines = lines_and_stations[pref_cd].lines;

            for (i = 0; i < lines.length; i++) {
              html += '<li><input id="line000' + (i + 1) + '" type="radio" style="display: none" value="' + lines[i].line_name + '" name="line"><label for="line000' + (i + 1) + '">' + lines[i].line_name + '<label></li>';

              for (j = 0; j < lines[i].stations.length; j++) {
                html2 += '<li>' + lines[i].stations[j] + '</li>';
              }
            }

            scroll_inner.children().remove();
            scroll_inner.append(html);
            $('.route .choice_inner').css({ visibility: 'visible' });
          });

          $('body').on('change', '#modal2 .route input[name="line"]', function () {

            $('#modal2 .route .scroll_inner li.active').removeClass('active').removeAttr('style');

            if ($(this).is(':checked')) {
              $(this).parent().addClass('active').css({ backgroundColor: '#65b9e7', color: '#fff' });
            }


            var line = $(this).parent().text();
            var stations = null;

            lines = lines_and_stations[pref_cd].lines;

            $('.choice_ttl_line').text(line);

            scroll_inner2.children().remove();
            scroll_inner2.append('<li><input type="checkbox" id="station0001"><label for="station0001"><i class="fa-solid fa-circle-check"></i>' + line + '駅のすべて' + '</label></li>');

            $(lines).each(function (i, el) {
              if (lines[i].line_name == line) {
                stations = lines[i].stations;
                return false;
              }
            });

            $(stations).each(function (i, el) {
              scroll_inner2.append('<li><input type="checkbox" id="station000' + (i + 2) + '" name="stations[]" value="' + stations[i] + '"><label for="station000' + (i + 2) + '"><i class="fa-solid fa-circle-check"></i>' + stations[i] + '</label></li>');
            });

            $('.station .choice_inner').css({ visibility: 'visible' });
          });

          $('body').on('change', '#station0001', function () {
            $('input[name="stations[]"]').prop('checked', $(this).is(':checked'));
          });

          $('body').on('change', '#municipalities_all', function () {
            $('input[name="areas[]"]').prop('checked', $(this).is(':checked'));
          });
        </script>
      </div>

      <!-- modal3 -->
      <div id="modal3" class="modal">
        <div class="modal-content">
          <div class="modal-top"> <span class="modal-close">×</span> </div>
          <div class="modal_container">
            <h4>職種を選ぶ</h4>
            <div class="search_inner">
              <div class="choice">
                <input type="checkbox" id="occupation1" name="job_types[]" value="薬剤師">
                <label for="occupation1">薬剤師</label>
                <input type="checkbox" id="occupation2" name="job_types[]" value="看護師">
                <label for="occupation2">看護師</label>
                <input type="checkbox" id="occupation3" name="job_types[]" value="獣医師">
                <label for="occupation3">獣医師</label>
                <input type="checkbox" id="occupation4" name="job_types[]" value="事務（病院、薬局）">
                <label for="occupation4">事務（病院、薬局）</label>
                <input type="checkbox" id="occupation5" name="job_types[]" value="作業療法士・理学療法士・言語聴覚士">
                <label for="occupation5">作業療法士・<br>理学療法士・<br>言語聴覚士</label>
                <input type="checkbox" id="occupation6" name="job_types[]" value="その他">
                <label for="occupation6">その他</label>
              </div>
            </div>
            <ul class="button_area">
              <li>該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</li>
              <li>
                <button type="button" class="submit reflect">選択した内容を反映する</button>
              </li>
              <li>
                <button type="button" class="reset">すべてクリア</button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- modal4 -->
      <div id="modal4" class="modal">
        <div class="modal-content">
          <div class="modal-top"> <span class="modal-close">×</span> </div>
          <div class="modal_container">
            <h4>施設・種別を選ぶ</h4>
            <div class="search_inner">
              <div class="choice">
                <input type="checkbox" id="facility1" name="categories[]" value="調剤薬局">
                <label for="facility1">調剤薬局</label>
                <input type="checkbox" id="facility2" name="categories[]" value="病院">
                <label for="facility2">病院</label>
                <input type="checkbox" id="facility3" name="categories[]" value="クリニック">
                <label for="facility3">クリニック</label>
                <input type="checkbox" id="facility4" name="categories[]" value="企業">
                <label for="facility4">企業</label>
                <input type="checkbox" id="facility5" name="categories[]" value="ドラッグストア（調剤併設）">
                <label for="facility5">ドラッグストア（調剤併設）</label>
                <input type="checkbox" id="facility6" name="categories[]" value="福祉施設">
                <label for="facility6">福祉施設</label>
                <input type="checkbox" id="facility7" name="categories[]" value="訪問看護ステーション">
                <label for="facility7">訪問看護ステーション</label>
                <input type="checkbox" id="facility8" name="categories[]" value="美容クリニック">
                <label for="facility8">美容クリニック</label>
                <input type="checkbox" id="facility9" name="categories[]" value="動物病院">
                <label for="facility9">動物病院</label>
                <input type="checkbox" id="facility10" name="categories[]" value="その他">
                <label for="facility10">その他</label>
              </div>
            </div>

            <ul class="button_area">
              <li>該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</li>
              <li>
                <button type="submit" class="submit">選択した内容を反映する</button>
              </li>
              <li>
                <button type="button" class="reset">すべてクリア</button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- modal5 -->
      <div id="modal5" class="modal">
        <div class="modal-content">
          <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
          <div class="modal_container">
            <h4>雇用形態 / 給与を選ぶ</h4>
            <div class="search_inner">
              <h5>雇用形態</h5>
              <div class="choice">
                <input type="checkbox" id="status1" name="employment_types[]" value="正社員">
                <label for="status1">正社員</label>
                <input type="checkbox" id="status2" name="employment_types[]" value="契約社員">
                <label for="status2">契約社員</label>
                <input type="checkbox" id="status3" name="employment_types[]" value="パート">
                <label for="status3">パート</label>
                <input type="checkbox" id="status4" name="employment_types[]" value="派遣・在籍出向">
                <label for="status4">派遣・在籍出向</label>
              </div>
              <h5>給与</h5>
              <ul class="salary">
                <li>年収
                  <select name="salary[yearly]">
                    <option value="">指定なし</option>
                    <option value="2000000">200</option>
                    <option value="2500000">250</option>
                    <option value="3000000">300</option>
                    <option value="4000000">400</option>
                    <option value="4500000">450</option>
                    <option value="5000000">500</option>
                    <option value="5500000">550</option>
                    <option value="6000000">600</option>
                  </select>
                  万円以上
                </li>
                <li>時給
                  <select name="salary[hourly]">
                    <option value="">指定なし</option>
                    <option value="1000">1,000</option>
                    <option value="1500">1,500</option>
                    <option value="2000">2,000</option>
                    <option value="2500">2,500</option>
                    <option value="3000">3,000</option>
                    <option value="3500">3,500</option>
                    <option value="4000">4,000</option>
                  </select>
                  円以上
                </li>
              </ul>
            </div>
            <ul class="button_area">
              <li>該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</li>
              <li>
                <button type="button" class="submit reflect">選択した内容を反映する</button>
              </li>
              <li>
                <button type="button" class="reset">すべてクリア</button>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- modal6 -->
      <div id="modal6" class="modal">
        <div class="modal-content">
          <div class="modal-top"> <span class="modal-close">×</span> </div>
          <div class="modal_container">
            <h4>こだわりを選ぶ</h4>
            <div class="search_inner">
              <div class="choice">
                <input type="checkbox" id="commitment1" name="traits[]" value="高収入">
                <label for="commitment1">高収入</label>
                <input type="checkbox" id="commitment2" name="traits[]" value="土日のみ">
                <label for="commitment2">土日のみ</label>
                <input type="checkbox" id="commitment3" name="traits[]" value="～18時の職場">
                <label for="commitment3">～18時の職場</label>
                <input type="checkbox" id="commitment4" name="traits[]" value="～19時の職場">
                <label for="commitment4">～19時の職場</label>
                <input type="checkbox" id="commitment5" name="traits[]" value="駅チカ">
                <label for="commitment5">駅チカ</label>
                <input type="checkbox" id="commitment6" name="traits[]" value="住居付き">
                <label for="commitment6">住居付き</label>
              </div>
            </div>
            <ul class="button_area">
              <li>該当件数<span class="big total_jobs"><?= $total_jobs ?></span>件</li>
              <li>
                <button type="button" class="submit reflect">選択した内容を反映する</button>
              </li>
              <li>
                <button type="button" class="reset">すべてクリア</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <script>
        $('.reflect').click(function () {
          $('.modal').hide();
          set_pluses();
        });
      </script>

      <script>

        $('body').on('change', '.modal input, .modal select', function () {

          var pref = $('input[name="pref"]').val();
          var line = $('input[name="line"]:checked').val();

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

          console.log(categories);

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

          $.ajax({
            type: "POST",
            url: '/total_jobs',
            dataType: 'json',
            data: {
              pref: pref,
              line: line,
              areas: areas,
              stations: stations,
              salary: {
                yearly: yearly,
                hourly: hourly,
              },
              categories: categories,
              job_types: job_types,
              employment_types: employment_types,
              traits: traits
            },
            success: function (data) {
                $('.big').text(data.total_jobs);
            }
          });
        });
      </script>
    </form>
  </section>

  <section class="recruitment">
    <h2><span>求人情報</span>Recruitment</h2>
    <h3>新着求人情報</h3>
    <div class="recruitment_slider_wrap">
      <div class="recruitment_slider">
        <?php foreach ($new_jobs as $new_job): ?>
          <div class="slide_item">
            <a href="/jobs/<?= $new_job['id'] ?>"><img src="assets/img/rec_img1.png"></a>
            <div class="category">
              <?php $categories = explode(',', $new_job['category']) ?>
              <?php for ($i = 0; $i < 2; $i++): ?>
                <?php if (!empty($categories[$i])): ?>
                  <span title="<?= $categories[$i] ?>"><?= ellipsize($categories[$i], 8); ?></span>
                <?php endif; ?>
              <?php endfor; ?>
            </div>
            <dl>
              <dt><a href="/jobs/<?= $new_job['id'] ?>"><?= ellipsize($new_job['title'], 43) ?></a></dt>
              <dd><span class="attribute">勤務地</span><?= $new_job['a_pref'] ?><?= $new_job['city'] ?></dd>
              <?php $new_job['min_salary'] = number_format($new_job['min_salary']); ?>
              <?php $new_job['max_salary'] = number_format($new_job['max_salary']); ?>
              <?php $new_job['min_salary'] = substr_count($new_job['min_salary'], '0') >= 6 ? (intval(str_replace(',', '', $new_job['min_salary']) / 10000)) . '万' : $new_job['min_salary']; ?>
              <?php $new_job['max_salary'] = substr_count($new_job['max_salary'], '0') >= 6 ? (intval(str_replace(',', '', $new_job['max_salary']) / 10000)) . '万' : $new_job['max_salary']; ?>
              <?php if (!empty($new_job['max_salary'])): ?>
                <dd><span class="attribute">給料</span>¥<?= $new_job['min_salary'] ?>～<?= $new_job['max_salary'] ?></dd>
              <?php else: ?>
                <dd><span class="attribute">給料</span>¥<?= $new_job['min_salary'] ?></dd>
              <?php endif; ?>
            </dl>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>





  <section class="picup">
    <div class="picup_wrap">
      <h3>PICK UP 求人特集</h3>
      <ul class="tab">
        <li class="active"><a href="#directly">直接雇用</a></li>
        <li><a href="#temporary">出向・派遣</a></li>
      </ul>
      <div id="directly" class="area2 is-active">
        <div class="temporary_slider_wrap">
          <div class="temporary_slider">
            <?php foreach ($direct as $job): ?>
              <div class="slide_item">
                <a href="/jobs/<?= $job['id'] ?>"><img src="/uploads/top_picture/<?= $job['top_picture'] ?>">
                  <div class="category">
                    <?php $i = 0; ?>
                    <?php foreach (explode(',', $job['category']) as $category): ?>
                      <span><?= ellipsize($category, 3) ?></span>
                      <?php $i++; ?>
                      <?php if ($i == 2)
                        break; ?>
                    <?php endforeach; ?>
                  </div>
                  <dl>
                    <dt><?= ellipsize($job['title'], 25) ?></dt>
                    <dd><span class="attribute">勤務地</span><?= $job['a_pref'] . $job['city'] ?></dd>
                    <?php $job['min_salary'] = number_format($job['min_salary']); ?>
                    <?php $job['max_salary'] = number_format($job['max_salary']); ?>
                    <?php $job['min_salary'] = substr_count($job['min_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['min_salary']) / 10000)) . '万' : $job['min_salary']; ?>
                    <?php $job['max_salary'] = substr_count($job['max_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['max_salary']) / 10000)) . '万' : $job['max_salary']; ?>
                    <dd><span class="attribute">給料</span>【<?= $job['salary_type'] ?>】<?= $job['min_salary'] ?>円</dd>
                  </dl>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>


      <div id="temporary" class="area2">
        <div class="temporary_slider_wrap">
          <div class="temporary_slider">
            <?php foreach ($direct as $job): ?>
              <div class="slide_item">
                <a href="/jobs/<?= $job['id'] ?>"><img src="/uploads/top_picture/<?= $job['top_picture'] ?>">
                  <div class="category">
                    <?php $i = 0; ?>
                    <?php foreach (explode(',', $job['category']) as $category): ?>
                      <span><?= ellipsize($category, 3) ?></span>
                      <?php $i++; ?>
                      <?php if ($i == 2)
                        break; ?>
                    <?php endforeach; ?>
                  </div>
                  <dl>
                    <dt><?= ellipsize($job['title'], 25) ?></dt>
                    <dd><span class="attribute">勤務地</span><?= $job['a_pref'] . $job['city'] ?></dd>
                    <?php $job['min_salary'] = number_format($job['min_salary']); ?>
                    <?php $job['max_salary'] = number_format($job['max_salary']); ?>
                    <?php $job['min_salary'] = substr_count($job['min_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['min_salary']) / 10000)) . '万' : $job['min_salary']; ?>
                    <?php $job['max_salary'] = substr_count($job['max_salary'], '0') >= 6 ? (intval(str_replace(',', '', $job['max_salary']) / 10000)) . '万' : $job['max_salary']; ?>
                    <dd><span class="attribute">給料</span>【<?= $job['salary_type'] ?>】<?= $job['min_salary'] ?>円</dd>
                  </dl>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!--/area-->
      </div>
      <div class="arrows_area">
        <div class="arrows"></div>
      </div>
    </div>


  </section>






  <section class="aboutus">
    <div class="aboutus_back">
      <div class="aboutus_inner">
        <div class="text">
          <h2><span>事業紹介</span> About Us</h2>
          <p class="lead">企業が本当に必要とする人材<br>
            <span>×</span><br>
            求職者が力を発揮できる会社
          </p>
          <p>表向きの諸条件から発生するマッチングではなく、<br>
            「企業様の理念やビジョン」<br class="sp">「求職者様の人生観や価値観」から<br>
            生まれる本質的なフィッティングの実現を目的とし、<br>
            双方を深く理解した上でご提案を行っています。</p>

        </div>
        <img src="assets/img/aboutus_figure.png" alt="事業構成チャート" width="527" height="518">
        <div><a href="">就業までの流れ</a></div>
      </div>

    </div>
  </section>
  <section class="instagram">
    <div class="instagram_inner">
      <div class="text">
        <h2><span>アイリードを見る</span> Instagram</h2>
        <a href="https://www.instagram.com/ilead.company/" class="pc">VIEW MORE</a>
      </div>
      <div class="insta_list"><img src="assets/img/insta_img.png" alt="インスタ画像" width="638" height="418"></div>
      <a href="https://www.instagram.com/ilead.company/" class="sp">VIEW MORE</a>
    </div>
  </section>
  <section class="news">
    <div class="news_inner">
      <div class="text">
        <h2><span>お知らせ</span> News</h2>
        <a href="/news" class="arrow"></a>
      </div>
      <ul class="news_area">
        <?php foreach ($news as $article): ?>
          <a href="/news/<?= $article['id'] ?>">
            <li><span class="day"><?= substr(str_replace('-', '.', $article['created_at']), 0, 11) ?></span><span
                class="title"><?= ellipsize($article['title'], 40); ?></span>
            </li>
          </a>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>
</main>


<?php include ('footer.php'); ?>