<?php

include APPPATH . 'includes/japan_regions.php';

$id = !empty($id) ? $id : '';
$business_content = !empty($business_content) ? $business_content : '';
$title = !empty($title) ? $title : '';
$body = !empty($body) ? $body : '';
$tantosha = !empty($tantosha) ? $tantosha : '';
$company_or_store_name = !empty($company_or_store_name) ? $company_or_store_name : '';
$employment_type = !empty($employment_type) ? explode(',', $employment_type) : [];
$salary_type = !empty($salary_type) ? $salary_type : '';
$min_salary = !empty($min_salary) ? $min_salary : '';
$max_salary = !empty($max_salary) ? $max_salary : '';
$category = !empty($category) ? explode(',', $category) : [];
$a_region = !empty($a_region) ? $a_region : '';
$a_pref = !empty($a_pref) ? $a_pref : '';
$city = !empty($city) ? $city : '';
$address = !empty($address) ? $address : '';
$has_requirement = !empty($has_requirement) ? $has_requirement : '';
$map_url = !empty($map_url) ? $map_url : '';
$map_address = !empty($map_address) ? $map_address : 'アイリード';
$lat = !empty($lat) ? $lat : 34.6733084;
$lng = !empty($lng) ? $lng : 135.4969132;
$gfj = !empty($gfj) ? $gfj : '';
$gfj_employment_type = !empty($gfj_employment_type) ? $gfj_employment_type : '';
$gfj_working_hours = !empty($gfj_working_hours) ? $gfj_working_hours : '';
$gfj_listing_start_date = !empty($gfj_listing_start_date) ? $gfj_listing_start_date : '';
$gfj_listing_end_date = !empty($gfj_listing_end_date) ? $gfj_listing_end_date : '';
$top_picture = !empty($top_picture) ? $top_picture : '';
$status = !empty($status) ? $status : '';
$updated_at = !empty($updated_at) ? $updated_at : '';
$traits = !empty($traits) ? explode(',', $traits) : [];

?>
<div class="py-28 px-4 bg-slate-100">
    <div class="max-w-screen-2xl mx-auto space-y-4">

        <div id="updated-successfully"
            class="fixed z-10 text-center bg-slate-500 text-white left-0 w-full p-2 rounded-lg rounded-t-none xl:text-base text-sm hidden updated-successfully">
            更新完了
        </div>
        <input id="id" type="hidden" value="<?= $id ?>">
        <h2 class="text-xl">求人を登録</h2>
        <div class="flex flex-col xl:flex-row xl:space-x-12 xl:space-y-0 space-y-8 text-sm">
            <div class="flex flex-col space-y-4 left flex-1">
                <div
                    class="bg-white px-4 py-4 rounded-lg shadow <?= empty($id) ? 'hidden' : 'flex' ?> space-x-2 items-center job-id">
                    <i class="fa fa-building text-[#13b3e7]"></i>
                    <span class="font-bold">求人URL:</span>
                    <a id="job_id" class="underline" href="/jobs/<?= $id ?>"
                        target="_blank"><?= base_url() ?>jobs/<?= $id ?></a>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">業務内容 *</span>
                    <input id="business_content" name="business_content" type="text" value="<?= $business_content ?>"
                        class="p-2 border border-slate-200 w-full">
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">求人見出し *</span>
                    <input id="title" name="title" type="text" value="<?= $title ?>"
                        class="p-2 border border-slate-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">求人内容 *</span>

                    <!-- Create the editor container -->
                    <div id="editor" class="bg-white h-[600px]" style="margin-top: 0 !important">
                        <?= $body ?>
                    </div>

                    <!-- Include the Quill library -->
                    <script src="/assets/js/quill.min.js"></script>

                    <!-- Initialize Quill editor -->
                    <script>
                        const quill = new Quill('#editor',
                            {
                                theme: 'snow',
                                modules: {
                                    toolbar: [
                                        // [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                                        // [{ size: ['small', false, 'large', 'huge'] }],
                                        ['bold', 'italic', 'underline', 'strike'],
                                        ['link', 'image', 'video'], // Add image and video options to the toolbar
                                        [
                                            {
                                                color: [],
                                            },
                                            {
                                                background: [],
                                            },
                                        ],
                                        // [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                                        // [{ 'indent': '-1' }, { 'indent': '+1' }],
                                        // [{ 'align': [] }],
                                        // ['clean']
                                    ]
                                }
                            });
                    </script>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">追加メールアドレス</span>
                    <input id="tantosha" type="text" class="p-2 border border-slate-200" value="<?= $tantosha ?>"
                        placeholder="a@ilead.com,b@ilead.com,c@ilead.com">
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">会社名または店舗名 *</span>
                    <input id="company_or_store_name" type="text" class="p-2 border border-slate-200"
                        value="<?= $company_or_store_name ?>">
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">雇用形態 *</span>

                    <div class="bg-white p-2 border border-slate-200 space-y-2">
                        <label class="flex space-x-1">
                            <input class="employment_type" type="radio" name="employment_type" value="正社員"
                                <?= in_array('正社員', $employment_type) ? 'checked' : '' ?>><span>正社員</span>
                        </label>
                        <label class="flex space-x-1">
                            <input class="employment_type" type="radio" name="employment_type" value="契約社員"
                                <?= in_array('契約社員', $employment_type) ? 'checked' : '' ?>><span>契約社員</span>
                        </label>
                        <label class="flex space-x-1">
                            <input class="employment_type" type="radio" name="employment_type" value="パート"
                                <?= in_array('パート', $employment_type) ? 'checked' : '' ?>><span>パート</span>
                        </label>
                        <label class="flex space-x-1">
                            <input class="employment_type" type="radio" name="employment_type" value="派遣・在籍出向"
                                <?= in_array('派遣・在籍出向', $employment_type) ? 'checked' : '' ?>><span>派遣・在籍出向</span>
                        </label>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">給与形態 *</span>

                    <div class="flex">
                        <select id="salary_type" name="salary_type" class="p-2">
                            <option value="時給" <?= $salary_type == '時給' ? 'selected' : '' ?>>時給</option>
                            <option value="年収" <?= $salary_type == '年収' ? 'selected' : '' ?>>年収</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">

                    <div class="flex flex-wrap space-x-2 items-center">
                        <div class="flex flex-col space-y-2">
                            <br />
                            <span>￥</span>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <span class="font-bold">最低給与 *</span>
                            <input id="min_salary" class="p-2" type="text" name="min_salary" value="<?= $min_salary ?>">
                        </div>

                        <div class="flex flex-col space-y-2">
                            <br />
                            <span>～</span>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <span class="font-bold">最高給与</span>
                            <input id="max_salary" class="p-2" type="text" name="max_salary" value="<?= $max_salary ?>">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <div>
                        <span class="font-bold">職種 *</span>
                    </div>
                    <div>
                        <select id="job_type" name="job_type" class="border border-slate-200 p-1">
                            <option value="薬剤師">薬剤師</option>
                            <option value="看護師">看護師</option>
                            <option value="獣医師">獣医師</option>
                            <option value="事務（病院、薬局）">事務（病院、薬局）</option>
                            <option value="作業療法士・理学療法士・言語聴覚士">作業療法士・理学療法士・言語聴覚士</option>
                            <option value="その他">その他</option>
                        </select>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">施設・種別 *</span>
                    <div class="flex">
                        <div class="border border-slate-200 rounded p-4 bg-white">
                            <div class="flex flex-col space-y-2">
                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="調剤薬局" <?= in_array('調剤薬局', $category) ? 'checked' : '' ?>>
                                    <span>調剤薬局</span>
                                </label>

                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="病院" <?= in_array('病院', $category) ? 'checked' : '' ?>>
                                    <span>病院</span>
                                </label>

                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="クリニック" <?= in_array('クリニック', $category) ? 'checked' : '' ?>>
                                    <span>クリニック</span>
                                </label>

                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="企業" <?= in_array('企業', $category) ? 'checked' : '' ?>>
                                    <span>企業</span>
                                </label>

                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="ドラッグストア（調剤併設）"
                                        <?= in_array('ドラッグストア（調剤併設）', $category) ? 'checked' : '' ?>>
                                    <span>ドラッグストア（調剤併設）</span>
                                </label>
                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="福祉施設" <?= in_array('福祉施設', $category) ? 'checked' : '' ?>>
                                    <span>福祉施設</span>
                                </label>
                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="訪問看護ステーション" <?= in_array('訪問看護ステーション', $category) ? 'checked' : '' ?>>
                                    <span>訪問看護ステーション</span>
                                </label>
                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="美容クリニック" <?= in_array('美容クリニック', $category) ? 'checked' : '' ?>>
                                    <span>美容クリニック</span>
                                </label>
                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="動物病院" <?= in_array('動物病院', $category) ? 'checked' : '' ?>>
                                    <span>動物病院</span>
                                </label>
                                <label class="flex space-x-1 items-center">
                                    <input class="category" type="checkbox" value="その他" <?= in_array('その他', $category) ? 'checked' : '' ?>>
                                    <span>その他</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">住所 *</span>
                    <div class="flex space-x-2">
                        <select id="a_region" name="a_region">
                            <?php foreach ($japan_regions as $region_id => $japan_region): ?>
                                <?php if (empty($a_region)): ?>
                                    <option value="<?= $region_id ?>" <?= $japan_region['name'] == '近畿' ? 'selected' : '' ?>>
                                        <?= $japan_region['name'] ?>
                                    </option>
                                <?php else: ?>
                                    <option value="<?= $region_id ?>" <?= $japan_region['name'] == $a_region ? 'selected' : '' ?>>
                                        <?= $japan_region['name'] ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <select id="a_pref" name="a_pref" class="min-w-[64px]">
                            <?php foreach ($japan_regions as $region_id => $japan_region): ?>
                                <?php foreach ($japan_region['prefectures'] as $prefecture): ?>
                                    <?php if ($japan_region['name'] == $a_region): ?>
                                        <option value="<?= $prefecture ?>" <?= $prefecture == $a_pref ? 'selected' : '' ?>>
                                            <?= $prefecture ?>
                                        </option>
                                    <?php elseif (empty($a_region)): ?>
                                        <option value="<?= $prefecture ?>" <?= $prefecture == '大阪府' ? 'selected' : '' ?>>
                                            <?= $prefecture ?>
                                        </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </select>
                        <select id="city" name="city" class="min-w-[64px]"></select>

                        <script>

                            $('#a_region').change(function () {

                                $('#a_pref').children().remove();

                                var region_id = $(this).children('option:selected').val();

                                $('#a_pref').children().remove();

                                var html = "";

                                $('#prefectures_list li').each(function () {

                                    var pref_region_id = $(this).attr('region_id');

                                    if (region_id == pref_region_id) {
                                        var pref_id = $(this).attr('pref_id');
                                        var prefecture = $(this).text();

                                        html += '<option value="' + prefecture + '">' + prefecture + '</option>'
                                    }

                                });

                                $('#a_pref').append($.trim(html));

                                $('#a_pref').change();
                            });

                            $('#a_pref').change(function () {

                                $('#city').children().remove();

                                var value = $(this).children('option:selected').val();
                                $.ajax({
                                    dataType: 'jsonp',
                                    url: 'https://geoapi.heartrails.com/api/json?method=getCities&prefecture=' + value,
                                    success: function (results) {

                                        var html = '';

                                        $(results.response.location).each(function (i, el) {

                                            var city = results.response.location[i].city;

                                            var selected = city == '<?= $city ?>' ? 'selected' : '';

                                            html += '<option value="' + city + '" ' + selected + '>' + city + '</option>';
                                        });

                                        $('#city').append(html);
                                    },
                                    error: function (err) {
                                        console.log(err);
                                    }
                                });
                            });

                            $('#a_pref').change();
                        </script>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">番地・ビル名 *</span>
                    <input id="address" class="p-2" type="text" name="address" value="<?= $address ?>">
                </div>

                <div class="space-y-2">
                    <span class="font-bold">最寄り駅 *</span>
                    <div class="flex">
                        <div class="flex flex-col space-y-2">
                            <div
                                class="flex flex-col xl:flex-row space-y-2 xl:space-y-0 xl:space-x-1 space-x-0 justify-end xl:items-center">
                                <div class="xl:space-x-1 space-x-0 space-y-1 xl:space-y-0">
                                    <select class="p-1" id="s_region" name="s_region">
                                        <?php foreach ($japan_regions as $region_id => $japan_region): ?>
                                            <option value="<?= $region_id ?>" <?= $japan_region['name'] == '近畿' ? 'selected' : '' ?>><?= $japan_region['name'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <ul id="prefectures_list" style="display: none">
                                        <?php foreach ($japan_regions as $region_id => $japan_region): ?>
                                            <?php foreach ($japan_region['prefectures'] as $pref_id => $prefecture): ?>
                                                <li pref_id="<?= $pref_id ?>" region_id="<?= $region_id ?>"><?= $prefecture ?>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                    <select class="p-1" id="s_pref" name="s_pref">
                                        <?php foreach ($japan_regions as $region_id => $japan_region): ?>
                                            <?php foreach ($japan_region['prefectures'] as $pref_id => $prefecture): ?>
                                                <?php if ($region_id == 5): ?>
                                                    <option value="<?= $pref_id ?>" <?= $pref_id == 27 ? 'selected' : '' ?>>
                                                        <?= $prefecture ?>
                                                    </option>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <select class="p-1 w-[128px]" id="line" name="line">
                                        <option value="">路線を選択する</option>
                                    </select>
                                    <select class="p-1" id="station" name="station">
                                        <option value="">駅を選択する</option>
                                    </select>
                                </div>

                                <div class="flex space-x-2 items-center">
                                    <label>徒歩</label>
                                    <input id="walking_distance" class="p-1" name="walking_distance" value=""
                                        style="width: 35px" maxlength="2">
                                    <span>分</span>
                                </div>

                                <script>
                                    var lines = [];
                                    var pref_cd = 26;
                                    var stations = [];
                                    var lines_and_stations = [];
                                    var line_container = $('#line');
                                    var station_container = $('#station');

                                    $.ajax({
                                        type: "POST",
                                        url: '/admin/get_lines_stations',
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

                                            var html = '';

                                            for (i = 0; i < lines_and_stations[pref_cd].lines.length; i++) {
                                                html += '<option value="' + lines_and_stations[pref_cd].lines[i].line_name + '">' + lines_and_stations[pref_cd].lines[i].line_name + '</option>';
                                            }

                                            line_container.append(html);
                                        },
                                    });

                                    $('#s_region').change(function () {

                                        var region_id = $(this).children('option:selected').val();

                                        $('#s_pref').children().remove();

                                        var html = "";

                                        $('#prefectures_list li').each(function () {


                                            var pref_region_id = $(this).attr('region_id');

                                            if (region_id == pref_region_id) {
                                                var pref_id = $(this).attr('pref_id');
                                                var prefecture = $(this).text();

                                                html += '<option value="' + pref_id + '">' + prefecture + '</option>'
                                            }

                                        });

                                        $('#s_pref').append(html);
                                        $('#s_pref').change();
                                    });

                                    $('#s_pref').change(function () {

                                        var line_container = $('#line');

                                        line_container.children().remove();
                                        $('#line').append('<option>路線を選択する</option>');

                                        var pref = $(this).children('option:selected').text();

                                        console.log($(this).children('option:selected').val());

                                        pref_cd = parseInt($(this).children('option:selected').val()) - 1;

                                        console.log(pref_cd);


                                        var html = '';

                                        lines = lines_and_stations[pref_cd].lines;

                                        for (i = 0; i < lines.length; i++) {
                                            html += '<option value="' + lines[i].line_name + '">' + lines[i].line_name + '</option>';
                                        }

                                        line_container.append(html);

                                        $('#line').change();
                                    });

                                    $('#line').change(function () {

                                        var line = $(this).children('option:selected').val();
                                        var stations = null;

                                        lines = lines_and_stations[pref_cd].lines;

                                        station_container.children().remove();
                                        station_container.append('<option>駅を選択する</option>')

                                        $(lines).each(function (i, el) {
                                            if (lines[i].line_name == line) {
                                                stations = lines[i].stations;
                                                return false;
                                            }
                                        });

                                        $(stations).each(function (i, el) {
                                            station_container.append('<option>' + stations[i] + '</option>');
                                        });
                                    });

                                </script>
                            </div>

                            <button id="add-station" class="bg-slate-200 p-2">新規最寄り駅を登録</button>
                            <ul id="stations" class="space-y-2 max-w-[350px]">
                                <?php if (!empty($jobs_stations)): ?>
                                    <?php foreach ($jobs_stations as $job_station): ?>
                                        <li class="flex">
                                            <span class="bg-white p-2 flex-1">
                                                <?= $job_station['line'] ?>         <?= $job_station['station'] ?>
                                            </span>
                                            <button class="bg-white border border-b-0 border-r-0 border-t-0 p-2 station-delete"
                                                jobs_stations_id="<?= $job_station['id'] ?>">&times;</button>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                            <script>
                                $('#add-station').click(function () {

                                    var stations = $('#stations li');

                                    if (stations.length == 3) return;

                                    var job_id = $('#id').val();

                                    var region = $.trim($('#s_region option:selected').text());
                                    var pref = $.trim($('#s_pref option:selected').text());
                                    var line = $('#line option:selected').val();
                                    var station = $('#station option:selected').val();
                                    var walking_distance = $('#walking_distance').val();

                                    if (region && pref && line && line != "路線を選択する" && station && station != "駅を選択する" && walking_distance) {
                                        $.ajax({
                                            type: "POST",
                                            url: '/admin/jobs/stations',
                                            data: {
                                                job_id: job_id,
                                                region: region,
                                                pref: pref,
                                                line: line,
                                                station: station,
                                                walking_distance: walking_distance
                                            },
                                            success: function (data) {
                                                if (data.id) {
                                                    $('#stations').append('<li class="flex"><span class="bg-white p-2 flex-1">' + line + station + '</span><button class="bg-white border border-b-0 border-r-0 border-t-0 p-2 station-delete" jobs_stations_id="' + data.id + '">&times;</button></li>')
                                                }
                                            },
                                            dataType: 'json'
                                        });
                                    }
                                });

                                $('body').on('click', '.station-delete', function () {

                                    if (confirm('削除しますか？')) {

                                        var parent = $(this).parent();
                                        var id = $(this).attr('jobs_stations_id');

                                        if (id) {
                                            $.ajax({
                                                type: "POST",
                                                url: '/admin/jobs/stations/delete',
                                                data: {
                                                    id: id
                                                },
                                                success: function (data) {
                                                    parent.remove();
                                                },
                                            });

                                        }
                                    }
                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">必要資格 *</span>
                    <div class="flex">
                        <div class="flex space-x-1 bg-white p-2 border border-slate-200 px-3">
                            <label class="flex space-x-1">
                                <input class="has_requirement" type="radio" name="has_requirement" value="あり"
                                    <?= $has_requirement == 'あり' ? 'checked' : '' ?>><span>あり</span>
                            </label>
                            <label class="flex space-x-1">
                                <input class="has_requirement" type="radio" name="has_requirement" value="なし"
                                    <?= $has_requirement == 'なし' ? 'checked' : '' ?>><span>なし</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col pb-2 space-y-2">
                    <span class="pb-2 border border-slate-200 border-b-1 border-t-0 border-l-0 border-r-0">募集要項</span>
                    <div id="custom-fields">

                        <div id="render-custom-field" class="hidden">
                            <div
                                class="pt-2 flex xl:flex-row flex-col xl:space-x-8 xl:space-y-0 space-y-4 items-center">
                                <div class="flex flex-1 flex-col space-y-2 self-start xl:max-w-xs w-full">
                                    <span class="text-center bg-white p-2">項目</span>
                                    <input type="text" class="border border-slate-200 p-2 custom-field-title">
                                </div>

                                <div class="flex flex-1 flex-col space-y-2 w-full">
                                    <span class="text-center bg-white p-2">内容</span>
                                    <textarea
                                        class="border border-slate-200 p-2 resize-none h-[75px] custom-field-detail"></textarea>
                                </div>

                                <button
                                    class="bg-red-500 text-white p-3 rounded border border-slate-200 xl:w-auto w-full remove-column">削除</button>
                            </div>
                        </div>

                        <?php if (!empty($custom_fields)): ?>
                            <?php foreach ($custom_fields as $custom_field): ?>
                                <div class="pt-2 flex xl:flex-row flex-col xl:space-x-8 xl:space-y-0 space-y-4 items-center custom-field"
                                    custom-field-id="<?= $custom_field['id'] ?>">
                                    <div class="flex flex-1 flex-col space-y-2 self-start xl:max-w-xs w-full">
                                        <span class="text-center bg-white p-2">項目</span>
                                        <input type="text" class="border border-slate-200 p-2 custom-field-title"
                                            value="<?= $custom_field['title'] ?>">
                                    </div>

                                    <div class="flex flex-1 flex-col space-y-2 w-full">
                                        <span class="text-center bg-white p-2">内容</span>
                                        <textarea
                                            class="border border-slate-200 p-2 resize-none h-[75px] custom-field-detail"><?= $custom_field['detail'] ?></textarea>
                                    </div>

                                    <button
                                        class="bg-red-500 text-white p-3 rounded border border-slate-200 xl:w-auto w-full remove-column">削除</button>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>

                    <button id="add-columns" class="bg-white p-4 text-center border border-slate-200">+ 項目を追加</button>
                    <script>

                        var remove_custom_fields = [];

                        $('#add-columns').click(function () {
                            $('#custom-fields').append($('#render-custom-field').html());
                            $('#custom-fields').children().last().addClass('custom-field');
                        });

                        $('body').on('click', '.remove-column', function () {
                            $(this).parent().remove();

                            var cf = $(this).closest('.custom-field');

                            if (cf.attr('custom-field-id')) {
                                remove_custom_fields.push({
                                    id: cf.attr('custom-field-id'),
                                    action: 'delete'
                                });
                            }
                        });
                    </script>
                </div>

                <div class="flex flex-col space-y-4">
                    <span class="font-bold">マップ情報</span>
                    <span class="font-bold">GoogleマップURL</span>
                    <input id="map_url" type="text" class="p-2 border border-slate-200" value="<?= $map_url ?>">

                    <span class="font-bold">住所、駅名、施設名、ランドマーク *</span>
                    <input id="map_address" type="text" class="p-2 border border-slate-200" value="<?= $map_address ?>">
                    <div class="flex">
                        <button id="geocoding" class="bg-white border p-2">この住所のマップを表示する（ジオコーディング）</button>
                    </div>
                    <p>マップの拡大・縮小を使い、正確な位置にマーカーをマウスでドラッグして移動する</p>
                    <div id="map" class="max-w-[550px] h-[450px]"></div>
                    <!-- <p>調整したマーカーの緯度・経度を下記ボタンで保存する</p> -->
                    <div class="flex flex-col space-y-2">
                        <span>緯度 *</span>
                        <input readonly id="lat" type="text" class="border-slate-200 p-2" name="lat"
                            value="<?= $lat ?>">
                    </div>
                    <div class="flex flex-col space-y-2">
                        <span>経度 *</span>
                        <input readonly id="lng" type="text" class="border-slate-200 p-2" name="lng"
                            value="<?= $lng ?>">
                    </div>
                    <!-- <div class="flex">
                    <button class="bg-white p-1 border">マーカー位置を保存する</button>
                </div> -->
                    <script>
                        function initMap() {

                            var lat = parseFloat($('#lat').val());
                            var lng = parseFloat($('#lng').val());

                            var pos = { lat, lng };

                            var map = new google.maps.Map(document.getElementById("map"), {
                                center: pos,
                                zoom: 17,
                            });

                            var marker = new google.maps.Marker({
                                position: pos,
                                title: $('#map_address').val(),
                                draggable: true
                            });

                            marker.setMap(map);

                            $('#geocoding').click(function () {
                                var geocoder = new google.maps.Geocoder();
                                var address = $('#map_address').val();
                                geocoder.geocode({ 'address': address }, function (results, status) {
                                    if (status === google.maps.GeocoderStatus.OK) {
                                        map.setCenter(results[0].geometry.location);
                                        marker.setTitle($('#map_address').val());
                                        $('#lat').val(results[0].geometry.location.lat());
                                        $('#lng').val(results[0].geometry.location.lng());

                                        marker.setPosition(new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng()));

                                    } else {
                                        console.log('Geocode was not successful for the following reason: ' + status);
                                        $('#map_address').val('');
                                    }
                                });
                            });

                            google.maps.event.addListener(marker, 'dragend', function (ev) {
                                // イベントの引数evの、プロパティ.latLngが緯度経度。
                                $('#lat').val(ev.latLng.lat());
                                $('#lng').val(ev.latLng.lng());

                            });
                        }
                    </script>

                    <script
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmVMSJ-FB7idtnAQajLhCIo2SV7VZd7uw&callback=initMap"></script>

                </div>

                <div class="flex">
                    <label class="flex space-x-2">
                        <input id="gfj" type="checkbox" name="gfj" <?= $gfj ? 'checked' : '' ?>>
                        <span>Google For Jobsを使用</span>
                        </lab>
                </div>

                <div>
                    <div class="pb-2 font-bold border border-slate-200  border-b-1 border-t-0 border-r-0 border-l-0">
                        Google
                        For Jobs</div>
                    <div class="space-y-4 pt-2">
                        <div class="flex flex-col space-y-2">
                            <span class="font-bold">雇用形態 *</span>
                            <select id="gfj_employment_type" class="p-2" name="gfj_employment_type border-slate-200">
                                <option value="正社員">正社員</option>
                                <option value="契約社員">契約社員</option>
                                <option value="パート">パート</option>
                                <option value="派遣・在籍出向">派遣・在籍出向</option>
                            </select>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <span class="font-bold">労働時間 *</span>
                            <input id="gfj_working_hours" class="p-2 border border-slate-200" type="text"
                                value="<?= $gfj_working_hours ?>" name="gfj_working_hours">
                        </div>
                        <div class="flex flex-col space-y-2">
                            <span class="font-bold">掲載日 *</span>
                            <div class="flex">
                                <input id="gfj_listing_start_date" class="p-2 border border-slate-200" type="date"
                                    value="<?= $gfj_listing_start_date ?>" name="gfj_listing_start_date">
                            </div>

                        </div>
                        <div class="flex flex-col space-y-2">
                            <span class="font-bold">掲載期限 *</span>
                            <div class="flex">
                                <input id="gfj_listing_end_date" class="p-2 border border-slate-200" type="date"
                                    value="<?= $gfj_listing_end_date ?>" name="gfj_listing_end_date">
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="right flex-1">
                <div class="xl:sticky xl:top-24 flex flex-col space-y-4">
                    <div class="flex flex-col space-y-4 border border-slate-200 rounded p-4 bg-white ">
                        <div
                            class="flex justify-between pb-4 border border-b-1 border-t-0 border-l-0 border-r-0 border-slate-200">
                            <span class="font-bold">公開</span>
                            <button
                                class="border border-slate-200 p-2 flex space-x-1 items-center rounded text-sm <?= empty($id) ? 'hidden' : 'flex' ?> preview">
                                <i class="fa fa-eye text-[#13b3e7]"></i>
                                <a id="preview" href="<?= base_url() ?>jobs/<?= $id ?>" target="_blank">プレビュー</a>
                            </button>
                        </div>
                        <div class="flex flex-col space-y-2 text-sm">
                            <div class="flex space-x-1 items-center">
                                <span>公開状態：</span>
                                <select id="status" name="status" class="border border-slate-200">
                                    <option value="公開" <?= $status == '公開' ? 'selected' : '' ?>>公開</option>
                                    <option value="非公開" <?= $status == '非公開' ? 'selected' : '' ?>>非公開</option>
                                    <option value="下書き" <?= $status == '下書き' ? 'selected' : '' ?>>下書き</option>
                                </select>
                            </div>
                            <div
                                class="flex space-x-1 items-center <?= empty($updated_at) ? 'hidden' : 'flex' ?> updated-at">
                                <span>更新日時：</span>
                                <span id="updated_at"><?= $updated_at ?></span>
                            </div>
                            <div
                                class="flex space-x-1 items-center <?= empty($id) ? 'justify-end' : 'justify-between' ?>  pt-8 delete">
                                <button
                                    class="flex space-x-1 items-center <?= empty($id) ? 'hidden' : '' ?> delete-btn">
                                    <i class="fa fa-trash text-slate-600"></i>
                                    <a href="/admin/jobs/<?= $id ?>/delete" id="delete" class="text-red-500">削除</a>
                                </button>
                                <button id="update"
                                    class="text-[#13b3e7] border border-[#13b3e7] text-[#13b3e7] hover:border-white hover:text-white hover:bg-[#13b3e7] px-8 py-2">更新</button>

                                <script>
                                    $('#delete').click(function (e) {
                                        e.preventDefault();

                                        if (confirm('削除してもいいですか？')) {
                                            var href = $(this).attr('href');
                                            window.location.href = href;
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded p-4 bg-white flex flex-col space-y-4">
                        <div class="pb-4 border border-b-1 border-t-0 border-l-0 border-r-0 border-slate-200">
                            <span class="font-bold">トップ画像</span>
                        </div>
                        <div class="flex flex-col space-y-2 text-sm">
                            <?php if (!empty($top_picture)): ?>
                                <img id="top_picture" src="/uploads/top_picture/<?= $top_picture ?>" alt="Image">
                            <?php else: ?>
                                <img id="top_picture" src="/uploads/top_picture/616f869cd0af9.jpg" alt="Image">
                            <?php endif; ?>
                            <button id="select-top-picture" class="bg-slate-600 text-white px-10 py-2">トップ画像を選択</button>
                        </div>
                        <div id="select-top-picture-window"
                            class="justify-center items-center fixed bg-[rgba(0,0,0,0.6)] w-full h-full left-0 top-0 p-2 hidden"
                            style="margin-top: 0 !important">
                            <div class="max-w-screen-md w-full">
                                <div class="bg-slate-100 p-4 h-[600px] overflow-auto">
                                    <div id="photos-grid" class="grid xl:grid-cols-4 grid-cols-1 gap-4">
                                        <?php foreach (glob('./uploads/top_picture/*') as $photo): ?>
                                            <?php $photo = str_replace('./', '/', $photo); ?>
                                            <div class="border flex-1 group relative select-top-picture-highlight">
                                                <img src="<?= $photo ?>" alt="top picture">
                                                <button
                                                    class="absolute top-1/2 left-1/2 bg-red-600 text-white p-2 group-hover:block hidden select-top-picture-delete-image"
                                                    style="transform: translate(-50%, -50%)">削除</button>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button id="select-top-picture-select"
                                        class="bg-slate-600 text-white text-center p-3 flex-1">トップ画像を選択</button>
                                    <input type="file" id="photos" name="photos" class="hidden" multiple>
                                    <button id="select-top-picture-upload"
                                        class="bg-[#13b3e7] text-white text-center p-3 flex-1">画像をアップロード</button>
                                    <button id="select-top-picture-close"
                                        class="bg-red-600 text-white text-center p-3 flex-1">閉じる</button>
                                </div>
                            </div>

                            <script>

                                $(document).mouseup(function (e) {

                                    var container = $('#select-top-picture-window');

                                    if (container.is(e.target)) {
                                        $('#select-top-picture-window').css({ display: 'none' });
                                    }
                                });

                                $('body').on('click', '.select-top-picture-highlight', function (e) {

                                    var container = $('.select-top-picture-delete-image');

                                    if (container.is(e.target)) {
                                        return;
                                    }

                                    $('.select-top-picture-highlight.active').removeClass('border-[#13b3e7] border-2 active')

                                    $(this).addClass('border-[#13b3e7] border-4 active');

                                });

                                $('#select-top-picture-select').click(function () {

                                    if ($('.select-top-picture-highlight.active').length != 0) {

                                        var image = $('.select-top-picture-highlight.active').children('img').attr('src');

                                        $('#top_picture').attr('src', image);
                                        $('#select-top-picture-close').click();
                                    }

                                });

                                $('#select-top-picture-upload').click(function () {
                                    $('#photos').click();
                                });

                                $('#photos').change(function () {

                                    var formData = new FormData();
                                    var files = $(this)[0].files;

                                    for (var i = 0; i < files.length; i++) {
                                        formData.append('files[]', files[i]);
                                    }

                                    $.ajax({
                                        url: '/admin/jobs/upload',
                                        type: 'POST',
                                        data: formData,
                                        contentType: false,
                                        processData: false,
                                        success: function (data) {

                                            if (data.top_pictures) {

                                                var html = '';

                                                for (i = 0; i < data.top_pictures.length; i++) {
                                                    html += '\
                                                    <div class="border flex-1 group relative select-top-picture-highlight">\
                                                        <img src="/uploads/top_picture/'+ data.top_pictures[i] + '" alt="top picture">\
                                                        <button class="absolute top-1/2 left-1/2 bg-red-600 text-white p-2 group-hover:block hidden select-top-picture-delete-image" style="transform: translate(-50%, -50%)">削除</button>\
                                                    </div>';
                                                }
                                            }


                                            $('#photos-grid').append(html);
                                        },
                                        error: function (xhr, status, error) {
                                            // Handle errors
                                            console.error(xhr.responseText);
                                        },
                                        dataType: 'json'
                                    });
                                });

                                $('#select-top-picture').click(function () {
                                    $('#select-top-picture-window').css({ display: 'flex' });
                                });

                                $('#select-top-picture-close').click(function () {
                                    $('#select-top-picture-window').css({ display: 'none' });
                                });

                                $('body').on('click', '.select-top-picture-delete-image', function () {

                                });

                                $('.select-top-picture-delete-image').click(function () {
                                    var photo = $(this).prev().attr('src');
                                    var parent = $(this).parent();

                                    if (confirm('削除しますか？')) {
                                        $.ajax({
                                            type: "POST",
                                            url: '/admin/jobs/delete_photo',
                                            data: {
                                                photo: photo,
                                            },
                                            success: function (data) {
                                                parent.remove();
                                            },
                                        });
                                    }
                                });
                            </script>
                        </div>
                    </div>

                    <div class="border border-slate-200 rounded p-4 bg-white flex flex-col space-y-4">
                        <div class="pb-4 border border-b-1 border-t-0 border-l-0 border-r-0 border-slate-200">
                            <span class="font-bold">こだわり</span>
                        </div>
                        <div class="flex flex-col space-y-2 text-sm">
                            <label class="flex space-x-1 items-center">
                                <input class="traits" value="高収入" type="checkbox" <?= in_array('高収入', $traits) ? 'checked' : '' ?>>
                                <span>高収入</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input class="traits" value="土日休み" type="checkbox" <?= in_array('土日休み', $traits) ? 'checked' : '' ?>>
                                <span>土日休み</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input class="traits" value="～１８時の職場" type="checkbox" <?= in_array('～１８時の職場', $traits) ? 'checked' : '' ?>>
                                <span>～１８時の職場</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input class="traits" value="～１９時の職場" type="checkbox" <?= in_array('～１９時の職場', $traits) ? 'checked' : '' ?>>
                                <span>～１９時の職場</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input class="traits" value="駅チカ" type="checkbox" <?= in_array('駅チカ', $traits) ? 'checked' : '' ?>>
                                <span>駅チカ</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input class="traits" value="住居付き" type="checkbox" <?= in_array('住居付き', $traits) ? 'checked' : '' ?>>
                                <span>住居付き</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script>

            $('#update').click(function () {

                var body = $('.ql-editor').html();

                $.ajax({
                    type: "POST",
                    url: '/admin/base64_to_png',
                    data: {
                        body: body
                    },
                    success: function (data) {


                        $('.ql-editor img').each(function (i, el) {
                            var img = $(this);
                            var src = $(this).attr('src');

                            if (src.indexOf('data:image') !== -1 && src.indexOf('base64') !== -1) {
                                img.attr('src', data[i]);
                                img.removeAttr('alt');
                            }

                        });

                        var id = $('#id').val();
                        var business_content = $('#business_content').val();
                        var title = $('#title').val();
                        var body = $('.ql-editor').html();
                        var tantosha = $('#tantosha').val();
                        var company_or_store_name = $('#company_or_store_name').val();
                        var employment_type = $('.employment_type:checked').val();
                        var salary_type = $('#salary_type').children('option:selected').val();
                        var min_salary = $('#min_salary').val();
                        var max_salary = $('#max_salary').val();
                        var job_type = $('#job_type').val();
                        var category = get_checked_values($('.category:checked'));
                        var a_region = $.trim($('#a_region').children('option:selected').text());
                        var a_pref = $.trim($('#a_pref').children('option:selected').text());
                        var city = $('#city').val();
                        var address = $('#address').val();
                        var has_requirement = $('.has_requirement:checked').val();
                        var map_url = $('#map_url').val();
                        var map_address = $('#map_address').val();
                        var lat = $('#lat').val();
                        var lng = $('#lng').val();
                        var gfj = $('#gfj').is(':checked') ? 1 : 0;
                        var gfj_employment_type = $('#gfj_employment_type').val();
                        var gfj_working_hours = $('#gfj_working_hours').val();
                        var gfj_listing_start_date = $('#gfj_listing_start_date').val();
                        var gfj_listing_end_date = $('#gfj_listing_end_date').val();
                        var status = $('#status').val();
                        var top_picture = $('#top_picture').attr('src').replace('/uploads/top_picture/', '');
                        var traits = get_checked_values($('.traits:checked'));

                        var custom_fields = [];

                        $('.custom-field').each(function () {
                            custom_fields.push({
                                job_id: id,
                                id: $(this).attr('custom-field-id'),
                                title: $(this).find('.custom-field-title').val(),
                                detail: $(this).find('.custom-field-detail').val(),
                                action: !$(this).attr('custom-field-id') ? 'new' : 'update'
                            });
                        });

                        $.ajax({
                            type: "POST",
                            url: '/admin/jobs/update',
                            data: {
                                id: id,
                                business_content: business_content,
                                title: title,
                                body: body,
                                tantosha: tantosha,
                                company_or_store_name: company_or_store_name,
                                employment_type: employment_type,
                                salary_type: salary_type,
                                min_salary: min_salary,
                                max_salary: max_salary,
                                job_type: job_type,
                                category: category,
                                a_region: a_region,
                                a_pref: a_pref,
                                city: city,
                                address: address,
                                has_requirement: has_requirement,
                                map_url: map_url,
                                map_address: map_address,
                                lat: lat,
                                lng: lng,
                                gfj: gfj,
                                gfj_employment_type: gfj_employment_type,
                                gfj_working_hours: gfj_working_hours,
                                gfj_listing_start_date: gfj_listing_start_date,
                                gfj_listing_end_date: gfj_listing_end_date,
                                status: status,
                                top_picture: top_picture,
                                traits: traits,
                                custom_fields: JSON.stringify(custom_fields),
                                remove_custom_fields: JSON.stringify(remove_custom_fields)
                            },
                            success: function (data) {
                                if (data.id) {
                                    var id = data.id;
                                    var updated_at = data.updated_at;
                                    var custom_fields_ids = data.custom_fields_ids;

                                    window.history.pushState({}, null, '/admin/jobs/' + id);
                                    $('#id').val(id);

                                    $('#job_id').text('<?= base_url() ?>jobs/' + id).attr('href', '/jobs/' + id);
                                    $('.job-id').removeClass('hidden').addClass('flex');

                                    $('#updated_at').text(updated_at);
                                    $('.updated-at').removeClass('hidden').addClass('flex');

                                    $('#preview').attr('href', '<?= base_url() ?>jobs/' + id)
                                    $('.preview').removeClass('hidden').addClass('flex');

                                    $('.delete').removeClass('justify-end').addClass('justify-between');
                                    $('.delete-btn').removeClass('hidden');
                                    $('.delete-btn a').attr('href', '/admin/jobs/' + id + '/delete');

                                    var c = 0;
                                    if (custom_fields_ids.length != 0) {
                                        $('.custom-field').each(function () {
                                            if (!$(this).attr('custom-field-id')) {
                                                $(this).attr('custom-field-id', custom_fields_ids[c]);
                                                c++;
                                            }
                                        });
                                    }

                                    $('#updated-successfully').fadeIn(function () {
                                        setTimeout(function () {
                                            $('#updated-successfully').fadeOut();
                                        }, 3000);
                                    });
                                }
                            },
                            dataType: 'json'
                        });
                    },
                    dataType: 'json'
                });


            });

            function get_checked_values(key) {
                var arr = [];

                key.each(function () {
                    arr.push($(this).val());
                })

                return arr.join(',');

            }
        </script>