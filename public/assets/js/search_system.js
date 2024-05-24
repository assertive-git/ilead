/* LINES AND STATIONS */
(function () {
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
}());

/* 検索絞り反映 */
(function () {
    $('.reflect').click(function () {
        $('.modal').hide();
        set_pluses();
    });

    $('.reset').click(function () {
        reset_all_pluses();
    });
}());

/* 検索の該当件数更新 */
(function () {
    $('body').on('change', '.modal input, .modal select', function () {

        // var pref = $('input[name="pref"]').val();
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
                // pref: pref,
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
}());


function reset_all_pluses() {
    // $('#municipalities_all').prop('checked', false);
    // $('input[name="areas[]"]:checked').prop('checked', false);
    // $('input[name="stations[]"]:checked').prop('checked', false);
    // $('#station0001').prop('checked', false);
    // $('input[name="categories[]"]:checked').prop('checked', false);
    // $('input[name="job_types[]"]:checked').prop('checked', false);
    // $('input[name="employment_types[]"]:checked').prop('checked', false);
    // $('input[name="traits[]"]:checked').prop('checked', false);

    $('input[type="checkbox"]:checked').prop('checked', false);
    $('input[type="radio"]:checked').prop('checked', false);
    $('select').find('option:eq(0)').prop('selected', true);

    set_pluses();
    $('.modal input').eq(0).change();
}

function set_pluses() {
    $('input[name="areas[]"]:checked').length ? $('.areas .plus').addClass('active') : $('.areas .plus').removeClass('active');
    $('input[name="stations[]"]:checked').length ? $('.stations .plus').addClass('active') : $('.stations .plus').removeClass('active');
    $('input[name="categories[]"]:checked').length ? $('.categories .plus').addClass('active') : $('.categories .plus').removeClass('active');
    $('input[name="job_types[]"]:checked').length ? $('.job_types .plus').addClass('active') : $('.job_types .plus').removeClass('active');
    $('input[name="employment_types[]"]:checked').length || $('select[name="salary[yearly]"]').val() || $('select[name="salary[hourly]"]').val() ? $('.employment_types .plus').addClass('active') : $('.employment_types .plus').removeClass('active');
    $('input[name="traits[]"]:checked').length ? $('.traits .plus').addClass('active') : $('.traits .plus').removeClass('active');
}

function reset_one_plus(modal) {

    console.log(modal);

    $('#' + modal + ' input[type="checkbox"]:checked').prop('checked', false);
    $('#' + modal + ' input[type="radio"]:checked').prop('checked', false);
    $('#' + modal + ' select').find('option:eq(0)').prop('selected', true);

    set_pluses();
    $('.modal input').eq(0).change();
}