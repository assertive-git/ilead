<?php include (APPPATH . 'includes/japan_regions.php'); ?>
<div class="modals">

    <!-- modal1 -->
    <div id="modal1" class="modal">
        <div class="modal-content">
            <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
            <div class="modal_container">
                <h4>エリアを選ぶ</h4>
                <div class="region">
                    <?php foreach ($japan_regions as $japan_region_key => $japan_region): ?>
                        <input type="radio" id="region_area_<?= $japan_region_key ?>" region_id="<?= $japan_region_key ?>"
                            name="region_area">
                        <label for="region_area_<?= $japan_region_key ?>"><?= $japan_region['name'] ?></label>
                    <?php endforeach; ?>
                </div>
                <div class="prefectures">
                    <?php foreach ($japan_regions as $japan_region_key => $japan_region): ?>
                        <?php foreach ($japan_region['prefectures'] as $pref_id => $prefecture): ?>
                            <div class="prefectures_group" pref_id="<?= $pref_id ?>" region_id="<?= $japan_region_key ?>">
                                <input class="prefectures_area" id="prefectures_area_<?= $pref_id ?>" type="radio"
                                    name="prefectures_area_region_<?= $japan_region_key ?>">
                                <label for="prefectures_area_<?= $pref_id ?>"><?= $prefecture ?></label>
                            </div>
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
                        <input class="region_route" type="radio" region_id="<?= $japan_region_key ?>"
                            id="region_<?= $japan_region_key ?>" region_id="<?= $japan_region_key ?>" name="region_route">
                        <label for="region_<?= $japan_region_key ?>"><?= $japan_region['name'] ?></label>
                    <?php endforeach; ?>
                </div>
                <div class="prefectures">
                    <?php foreach ($japan_regions as $japan_region_key => $japan_region): ?>
                        <?php foreach ($japan_region['prefectures'] as $pref_id => $prefecture): ?>
                            <div class="prefectures_group" pref_id="<?= $pref_id ?>" region_id="<?= $japan_region_key ?>">
                                <input class="prefectures_route" type="radio" id="prefectures_route_<?= $pref_id ?>"
                                    name="prefectures_route_<?= $japan_region_key ?>">
                                <label for="prefectures_route_<?= $pref_id ?>"><?= $prefecture ?></label>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                </div>
                <div class="choice2 first">

                    <div class="route">
                        <h5>路線を選択</h5>
                        <div class="choice_inner">
                            <p class="choice_ttl"><span class="choice_ttl_pref"></span></p>
                            <ul class="scroll_inner"></ul>
                        </div>
                    </div>

                    <div class="station">
                        <h5>駅を選択</h5>
                        <div class="choice_inner">
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

</div>