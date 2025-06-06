﻿<?php include(APPPATH . 'includes/japan_regions.php'); ?>
<?php include(APPPATH . 'includes/japan_areas.php'); ?>
<div class="modals">

  <!-- modal1 -->
  <div id="modal1" class="modal">
    <div class="modal-content">
      <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
      <div class="modal_container">
        <h4>エリアを選ぶ</h4>
        <div class="region">
          <div class="wrap">
            <?php foreach ($japan_regions as $key => $japan_region): ?>
                      <input type="checkbox" name="region_areas[]" value="<?= $japan_region['name'] ?>">
                      <input type="radio" id="region_area_<?= $key ?>" class="region_area" name="region_area"
                        value="<?= $japan_region['name'] ?>" <?= $region_area == $japan_region['name'] ? 'checked' : '' ?>>
                      <label for="region_area_<?= $key ?>"><?= $japan_region['name'] ?></label>
            <?php endforeach; ?>
          </div>

        </div>
        <div class="prefectures">
          <div class="wrap">
            <?php foreach ($japan_regions as $key => $japan_region): ?>
                      <div class="prefectures_group" style="<?= $region_area == $japan_region['name'] ? 'display:flex' : '' ?>">
                        <?php foreach ($japan_region['prefectures'] as $key2 => $pref): ?>
                                  <input type="checkbox" name="prefectures_areas[]" value="<?= $pref ?>">
                                  <input class="prefectures_area" id="prefectures_area_<?= $key ?>_<?= $key2 ?>" type="radio"
                                    value="<?= $pref ?>" <?= $prefectures_area == $pref ? 'checked' : '' ?> name="prefectures_area">
                                  <label region_id="<?= $japan_region['name'] ?>" for="prefectures_area_<?= $key ?>_<?= $key2 ?>"><?= $pref ?></label>
                        <?php endforeach; ?>
                      </div>
            <?php endforeach; ?>
          </div>

        </div>
        <div class="search_inner2 area-box hide" style="<?= empty($prefectures_area) ? 'display:block' : '' ?>">
          <div class="choice"></div>
        </div>
        <?php $i = 1; ?>
        <?php foreach ($japan_areas as $region => $japan_area): ?>
            <?php foreach ($japan_area as $pref_key => $japan_pref): ?>
                      <div class="search_inner2 area-box hide" style="<?= $prefectures_area == $pref_key ? 'display:block' : '' ?>">
                        <div class="choice">
                          <input type="checkbox" class="areas_all" id="areas_all_<?= $i ?>" name="areas[]" value="all_<?= $i ?>"
                            <?= in_array('all_' . $i, $areas) ? 'checked' : ''; ?>>
                          <label for="areas_all_<?= $i ?>">すべて</label>
                          <?php $j = 1; ?>
                          <?php foreach ($japan_pref as $japan_city): ?>
                            <input region_id="<?= $region ?>" pref_key="<?= $pref_key ?>" type="checkbox" id="areas_<?= $i ?>_<?= $j ?>" class="areas" name="areas[]"
                              value="<?= $pref_key ?><?= $japan_city ?>" <?= in_array($pref_key . $japan_city, $areas) ? 'checked' : ''; ?>>
                            <label for="areas_<?= $i ?>_<?= $j ?>"><?= $japan_city ?></label>
                            <?php $j++; ?>
                          <?php endforeach; ?>
                          <?php $i++; ?>
                        </div>
                      </div>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <ul class="button_area">
          <li class="applicable">該当件数<span class="big total_jobs">
            <?= $total_jobs ?>
            </span>件</li>
          <li>
            <button type="button" class="submit reflect">選択した内容を反映する</button>
          </li>
          <li>
            <button type="button" class="reset">クリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- modal2 -->
  <div id="modal2" class="modal">
    <div class="modal-content">
      <div class="modal-top"><span class="modal-close"><i class="fa-solid fa-xmark"></i></span></div>
      <div class="modal_container">
        <h4>沿線・駅を選ぶ</h4>
        <div class="region">
          <div class="wrap">
            <?php foreach ($japan_regions as $key => $japan_region): ?>
                      <input type="checkbox" name="region_lines_stations_cb" value="<?= $japan_region['name'] ?>">
                      <input type="radio" id="region_lines_stations_<?= $key ?>" class="region_lines_stations"
                        name="region_lines_stations" value="<?= $japan_region['name'] ?>">
                      <label for="region_lines_stations_<?= $key ?>"><?= $japan_region['name'] ?></label>
            <?php endforeach; ?>
          </div>
        </div>
        <div class="prefectures">
          <div class="wrap">
            <?php foreach ($japan_regions as $key => $japan_region): ?>
                      <div class="prefectures_group"
                        style="<?= $region_lines_stations == $japan_region['name'] ? 'display:flex' : '' ?>">
                        <?php foreach ($japan_region['prefectures'] as $key2 => $pref): ?>
                                  <input type="checkbox" name="prefectures_lines_stations_cb" value="<?= $pref ?>">
                                  <input class="prefectures_lines_stations" id="prefectures_lines_stations_<?= $key ?>_<?= $key2 ?>"
                                    type="radio" value="<?= $pref ?>"
                                    name="prefectures_lines_stations">
                                  <label region_id="<?= $japan_region['name'] ?>" for="prefectures_lines_stations_<?= $key ?>_<?= $key2 ?>"><?= $pref ?></label>
                        <?php endforeach; ?>
                      </div>
          <?php endforeach; ?>
          </div>
          
        </div>
        <div class="choice2">
          <div class="route">
            <h5>路線を選択</h5>
            <div class="choice_inner">
              <p line_pref_title="" class="choice_ttl"><span class="choice_ttl_pref"></span></p>
              <ul class="scroll_inner">
                <?php foreach ($lines as $line): ?>
                    <?php if ($line != $line['line']): ?>
                      <li style="display: none" class="to_pref" line_pref="<?= $line['pref'] ?>"><input style="display: none" type="checkbox" class="line_name_cb"><label><input class="line" line_cd="<?= $line['line_cd'] ?>" pref_cd="<?= $line['pref_cd'] ?>" style="display: none" type="radio" name="line"><div class="line_name"><?= $line['line'] ?></div></label></li>
                    <?php endif; ?>
              <?php endforeach; ?>
              </ul>
            </div>
          </div>

          <div class="station">
            <h5>駅を選択</h5>
            <div class="choice_inner">
              <p class="choice_ttl"><span class="choice_ttl_line"></span></p>
              <ul class="scroll_inner">
                
              </ul>
            </div>
            <!-- STATIONS -->
            <div id="stations">
            </div>
          </div>
        </div>

        <ul class="button_area">
          <li class="applicable">該当件数<span class="big total_jobs">
            <?= $total_jobs ?>
            </span>件</li>
          <li>
            <button type="button" class="submit reflect">選択した内容を反映する</button>
          </li>
          <li>
            <button type="button" class="reset">クリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- modal3 -->
  <div id="modal3" class="modal">
    <div class="modal-content">
      <div class="modal-top"><span class="modal-close"><i class="fa-solid fa-xmark"></i></span></div>
      <div class="modal_container">
        <h4>職種を選ぶ</h4>
        <div class="search_inner2">
          <div class="choice">
            <input type="checkbox" id="occupation1" name="job_types[]" <?= in_array('薬剤師', $job_types) ? 'checked' : '' ?> value="薬剤師">
            <label for="occupation1">薬剤師</label>
            <input type="checkbox" id="occupation2" name="job_types[]" <?= in_array('看護師', $job_types) ? 'checked' : '' ?> value="看護師">
            <label for="occupation2">看護師</label>
            <input type="checkbox" id="occupation3" name="job_types[]" <?= in_array('獣医師', $job_types) ? 'checked' : '' ?> value="獣医師">
            <label for="occupation3">獣医師</label>
            <input type="checkbox" id="occupation4" name="job_types[]" <?= in_array('事務（病院、薬局）', $job_types) ? 'checked' : '' ?> value="事務（病院、薬局）">
            <label for="occupation4">事務（病院、薬局）</label>
            <input type="checkbox" id="occupation5" name="job_types[]" <?= in_array('作業療法士・理学療法士・言語聴覚士', $job_types) ? 'checked' : '' ?> value="作業療法士・理学療法士・言語聴覚士">
            <label for="occupation5">作業療法士<br>理学療法士<br>言語聴覚士</label>
            <input type="checkbox" id="occupation6" name="job_types[]" <?= in_array('その他', $job_types) ? 'checked' : '' ?> value="その他">
            <label for="occupation6">その他</label>
          </div>
        </div>
        <ul class="button_area">
          <li class="applicable">該当件数<span class="big total_jobs">
            <?= $total_jobs ?>
            </span>件</li>
          <li>
            <button type="button" class="submit reflect">選択した内容を反映する</button>
          </li>
          <li>
            <button type="button" class="reset">クリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- modal4 -->
  <div id="modal4" class="modal">
    <div class="modal-content">
      <div class="modal-top"><span class="modal-close"><i class="fa-solid fa-xmark"></i></span></div>
      <div class="modal_container">
        <h4>施設・種別を選ぶ</h4>
        <div class="search_inner2">
          <div class="choice">
            <input type="checkbox" id="facility1" name="categories[]" <?= !is_array($categories) && strpos($categories, '調剤薬局') !== FALSE ? 'checked' : '' ?> value="調剤薬局">
            <label for="facility1">調剤薬局</label>
            <input type="checkbox" id="facility2" name="categories[]" <?= !is_array($categories) && strpos($categories, '病院') !== FALSE ? 'checked' : '' ?> value="病院">
            <label for="facility2">病院</label>
            <input type="checkbox" id="facility3" name="categories[]" <?= !is_array($categories) && strpos($categories, 'クリニック') !== FALSE ? 'checked' : '' ?> value="クリニック">
            <label for="facility3">クリニック</label>
            <input type="checkbox" id="facility4" name="categories[]" <?= !is_array($categories) && strpos($categories, '企業') !== FALSE ? 'checked' : '' ?> value="企業">
            <label for="facility4">企業</label>
            <input type="checkbox" id="facility5" name="categories[]" <?= !is_array($categories) && strpos($categories, 'ドラッグストア（調剤併設）') !== FALSE ? 'checked' : '' ?> value="ドラッグストア（調剤併設）">
            <label for="facility5">ドラッグストア（調剤併設）</label>
            <input type="checkbox" id="facility6" name="categories[]" <?= !is_array($categories) && strpos($categories, '福祉施設') !== FALSE ? 'checked' : '' ?> value="福祉施設">
            <label for="facility6">福祉施設</label>
            <input type="checkbox" id="facility7" name="categories[]" <?= !is_array($categories) && strpos($categories, '訪問看護ステーション') !== FALSE ? 'checked' : '' ?> value="訪問看護ステーション">
            <label for="facility7">訪問看護ステーション</label>
            <input type="checkbox" id="facility8" name="categories[]" <?= !is_array($categories) && strpos($categories, '美容クリニック') !== FALSE ? 'checked' : '' ?> value="美容クリニック">
            <label for="facility8">美容クリニック</label>
            <input type="checkbox" id="facility9" name="categories[]" <?= !is_array($categories) && strpos($categories, '動物病院') !== FALSE ? 'checked' : '' ?> value="動物病院">
            <label for="facility9">動物病院</label>
            <input type="checkbox" id="facility10" name="categories[]" <?= !is_array($categories) && strpos($categories, 'その他') !== FALSE ? 'checked' : '' ?> value="その他">
            <label for="facility10">その他</label>
          </div>
        </div>

        <ul class="button_area">
          <li class="applicable">該当件数<span class="big total_jobs">
            <?= $total_jobs ?>
            </span>件</li>
          <li>
            <button type="button" class="submit reflect">選択した内容を反映する</button>
          </li>
          <li>
            <button type="button" class="reset">クリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- modal5 -->
  <div id="modal5" class="modal">
    <div class="modal-content">
      <div class="modal-top"><span class="modal-close"><i class="fa-solid fa-xmark"></i></span></div>
      <div class="modal_container">
        <h4>雇用形態 / 給与を選ぶ</h4>
        <div class="search_inner2">
          <h5>雇用形態</h5>
          <div class="choice">
            <input type="checkbox" id="status1" name="employment_types[]" <?= in_array('正社員', $employment_types) ? 'checked' : '' ?> value="正社員">
            <label for="status1">正社員</label>
            <input type="checkbox" id="status2" name="employment_types[]" <?= in_array('契約社員', $employment_types) ? 'checked' : '' ?> value="契約社員">
            <label for="status2">契約社員</label>
            <input type="checkbox" id="status3" name="employment_types[]" <?= in_array('パート', $employment_types) ? 'checked' : '' ?> value="パート">
            <label for="status3">パート</label>
            <input type="checkbox" id="status4" name="employment_types[]" <?= in_array('派遣・在籍出向', $employment_types) ? 'checked' : '' ?> value="派遣・在籍出向">
            <label for="status4">派遣・在籍出向</label>
          </div>
          <h5 class="salary_ttl">給与</h5>
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
          <li class="applicable">該当件数<span class="big total_jobs">
            <?= $total_jobs ?>
            </span>件</li>
          <li>
            <button type="button" class="submit reflect">選択した内容を反映する</button>
          </li>
          <li>
            <button type="button" class="reset">クリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <!-- modal6 -->
  <div id="modal6" class="modal">
    <div class="modal-content">
      <div class="modal-top"><span class="modal-close"><i class="fa-solid fa-xmark"></i></span></div>
      <div class="modal_container">
        <h4>こだわりを選ぶ</h4>
        <div class="search_inner2">
          <div class="choice">
            <input type="checkbox" id="commitment1" name="traits[]" <?= !is_array($traits) && strpos($traits, '高収入') !== FALSE ? 'checked' : '' ?> value="高収入">
            <label for="commitment1">高収入</label>
            <input type="checkbox" id="commitment2" name="traits[]" <?= !is_array($traits) && strpos($traits, '土日休み') !== FALSE ? 'checked' : '' ?> value="土日休み">
            <label for="commitment2">土日休み</label>
            <input type="checkbox" id="commitment3" name="traits[]" <?= !is_array($traits) && strpos($traits, '～18時の職場') !== FALSE ? 'checked' : '' ?> value="～18時の職場">
            <label for="commitment3">～18時の職場</label>
            <input type="checkbox" id="commitment4" name="traits[]" <?= !is_array($traits) && strpos($traits, '～19時の職場') !== FALSE ? 'checked' : '' ?> value="～19時の職場">
            <label for="commitment4">～19時の職場</label>
            <input type="checkbox" id="commitment5" name="traits[]" <?= !is_array($traits) && strpos($traits, '駅チカ') !== FALSE ? 'checked' : '' ?> value="駅チカ">
            <label for="commitment5">駅チカ</label>
            <input type="checkbox" id="commitment6" name="traits[]" <?= !is_array($traits) && strpos($traits, '住居付き') !== FALSE ? 'checked' : '' ?> value="住居付き">
            <label for="commitment6">住居付き</label>
          </div>
        </div>
        <ul class="button_area">
          <li class="applicable">該当件数<span class="big total_jobs">
            <?= $total_jobs ?>
            </span>件</li>
          <li>
            <button type="button" class="submit reflect">選択した内容を反映する</button>
          </li>
          <li>
            <button type="button" class="reset">クリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>

</div>
