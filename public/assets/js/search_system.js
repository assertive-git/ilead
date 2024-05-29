/* LINES AND STATIONS */
(function () {
    /* AREAS */

    var fetched_areas = [];
    var fetched_lines_stations_view = [];
    var fetched_stations = [];

    $('#modal1 .region input[name="region_area"]').change(function () {

        var region_id = $(this).attr('region_id');

        $('.prefectures_group').hide();
        $('.prefectures_group[region_id="' + region_id + '"]').show();

        if ($('#modal1 .search_inner').length > 1) {
            $('#modal1 .search_inner').hide();

            var prev_pref_index = $('.prefectures_group[region_id="' + region_id + '"] input:checked').parent().attr('pref_id');

            if (prev_pref_index) {
                load_area(prev_pref_index);
            } else {
                $('#modal1 .search_inner').eq(0).show();
            }
        }
    });

    $('#modal1 .prefectures .prefectures_area').change(function () {
        var pref = $(this).next().text();
        var pref_index = $(this).parent().attr('pref_id');

        $('#modal1 .search_inner').hide();

        if (fetched_areas.indexOf(pref_index) === -1) {
            fetch_areas(pref, pref_index);
        } else {
            load_area(pref_index);
        }
    });

    function fetch_areas(pref, pref_index) {

        $('#modal1 .search_inner').last().after('<div id="search_inner_pref_' + pref_index + '" class="search_inner"><div class="choice"></div></div>');

        var choice = $('#modal1 .search_inner').last().children('.choice');

        $.ajax({
            dataType: 'jsonp',
            url: 'https://geoapi.heartrails.com/api/json?method=getCities&prefecture=' + pref,
            success: function (results) {

                var html = '<input type="checkbox" class="municipalities_all" id="municipalities_all_pref_' + pref_index + '" name="areas[]" value="すべて"><label for="municipalities_all_pref_' + pref_index + '">すべて</label>';

                $(results.response.location).each(function (i, el) {
                    var city = results.response.location[i].city;
                    html += '<input type="checkbox" id="municipalities_' + (i + 1) + '_pref_' + pref_index + '" name="areas[]" value="' + pref + city + '"><label for="municipalities_' + (i + 1) + '_pref_' + pref_index + '">' + city + '</label>';
                });

                choice.append(html);
                fetched_areas.push(pref_index);
            },
            error: function (err) {
                console.log(err);
            }
        });
    }

    function load_area(pref_index) {
        $('#modal1 #search_inner_pref_' + pref_index).show();
    }

    $('body').on('change', '.municipalities_all', function () {
        $(this).siblings('input[name="areas[]"]').prop('checked', $(this).is(':checked'));
    });

    var lines = [];
    var stations = [];
    var lines_and_stations = [];

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
        },
    });

    $('#modal2 .region_route').change(function () {

        var region_id = $(this).attr('region_id');

        $('#modal2 .prefectures_group').hide();
        $('#modal2 .prefectures_group[region_id="' + region_id + '"]').show();

        var prev_pref_index;

        if ($('#modal2 .choice2').length > 1) {
            $('#modal2 .choice2').hide();

            prev_pref_index = parseInt($('#modal2 .prefectures_group[region_id="' + region_id + '"] input:checked').parent().attr('pref_id')) - 1;

            if (prev_pref_index) {
                load_lines_stations_view(prev_pref_index);
            } else {
                $('#modal2 .choice2').eq(0).show();
            }
        }

        if ($('#modal2  #choice2_pref_' + prev_pref_index + ' .line:checked').length) {
            var choice2 = $('#modal2 #choice2_pref_' + prev_pref_index + ' .line:checked').closest('.choice2');
            var line_id = $('#modal2 #choice2_pref_' + prev_pref_index + ' .line:checked').attr('line_id');
            choice2.find('.station_line_' + line_id).show();
            console.log('line 1');
        } else if (prev_pref_index) {
            $('#modal2 #choice2_pref_' + prev_pref_index + ' .station').show();
            console.log('line 2');
        } else {
            $('#modal2 .choice2:eq(0) .station').show();
            console.log('line 3');
        }
    });

    $('#modal2 .prefectures .prefectures_route').change(function () {

        $('#modal2 .choice2').hide();

        var pref = $(this).next().text();
        var pref_cd = parseInt($(this).parent().attr('pref_id')) - 1;

        if (fetched_lines_stations_view.indexOf(pref_cd) === -1) {
            fetch_lines_stations_view(pref, pref_cd);
        } else {
            load_lines_stations_view(pref_cd);
        }

        if ($('#modal2  #choice2_pref_' + pref_cd + ' .line:checked').length) {
            var choice2 = $('#modal2 #choice2_pref_' + pref_cd + ' .line:checked').closest('.choice2');
            var line_id = $('#modal2 #choice2_pref_' + pref_cd + ' .line:checked').attr('line_id');
            choice2.find('.station_line_' + line_id).show();
        } else {
            $('#modal2 #choice2_pref_' + pref_cd + ' .station:eq(0)').show();
        }
    });

    function fetch_lines_stations_view(pref, pref_index) {
        $('#modal2 .choice2').last().after('<div id="choice2_pref_' + pref_index + '" class="choice2"><div class="route"><h5>路線を選択</h5><div class="choice_inner"><p class="choice_ttl"><span class="choice_ttl_pref"></span></p><ul class="scroll_inner"></ul></div></div><div class="station"><h5>駅を選択</h5><div class="choice_inner"><p class="choice_ttl"><span class="choice_ttl_line"></span></p><ul class="scroll_inner"></ul></div></div></div>');

        var scroll_inner = $('#modal2 #choice2_pref_' + pref_index + ' .route .scroll_inner');

        $('#modal2 #choice2_pref_' + pref_index + ' .choice_ttl_pref').text(pref);

        var html = '';

        lines = lines_and_stations[pref_index].lines;

        for (i = 0; i < lines.length; i++) {
            html += '<li><input line_id="' + (i + 1) + '" id="line000' + (i + 1) + '_pref_' + pref_index + '" type="radio" style="display: none" class="line" name="line_pref_' + pref_index + '" pref_id="' + pref_index + '"><label for="line000' + (i + 1) + '_pref_' + pref_index + '">' + lines[i].line_name + '<label></li>';
        }

        scroll_inner.append(html);
        fetched_lines_stations_view.push(pref_index);
    }

    function load_lines_stations_view(pref_index) {
        $('#modal2 #choice2_pref_' + pref_index).show();
    }

    $('body').on('change', '#modal2 .line', function () {

        var pref_index = $(this).attr('pref_id');
        $('#choice2_pref_' + pref_index + ' .route .scroll_inner li').removeAttr('style');
        $(this).parent().css({ backgroundColor: '#65b9e7', color: '#fff' });

        $('.station').hide();

        var line = $(this).parent().text();
        var line_index = $(this).attr('line_id');

        if (fetched_stations.indexOf(pref_index + "_" + line_index) === -1) {
            fetch_stations(line, line_index, pref_index);
        } else {
            load_stations(pref_index, line_index);
        }

    });

    function fetch_stations(line, line_index, pref_index) {

        lines = lines_and_stations[pref_index].lines;
        $('#choice2_pref_' + pref_index + ' .station').last().after('<div class= "station station_line_' + line_index + '" ><h5>駅を選択</h5><div class="choice_inner"><p class="choice_ttl"><span class="choice_ttl_line"></span></p><ul class="scroll_inner"></ul></div>');
        $('#choice2_pref_' + pref_index + ' .station_line_' + line_index + ' .choice_ttl_line').text(line);
        var scroll_inner2 = $('#choice2_pref_' + pref_index + ' .station_line_' + line_index + ' .scroll_inner');
        scroll_inner2.append('<li><input class="stations_all" type="checkbox" id="station0001_pref_' + pref_index + '_line_' + line_index + '"><label for="station0001_pref_' + pref_index + '_line_' + line_index + '"><i class="fa-solid fa-circle-check"></i>' + line + '駅のすべて' + '</label></li>');
        var stations = null;

        $(lines).each(function (i, el) {
            if (lines[i].line_name == line) {
                stations = lines[i].stations;
                return false;
            }
        });


        $(stations).each(function (i, el) {
            scroll_inner2.append('<li><input type="checkbox" id="station000' + (i + 2) + '_pref_' + pref_index + '_line_' + line_index + '" name="stations[]" value="' + line + stations[i] + '"><label for="station000' + (i + 2) + '_pref_' + pref_index + '_line_' + line_index + '"><i class="fa-solid fa-circle-check"></i>' + stations[i] + '</label></li>');
        });

        fetched_stations.push(pref_index + "_" + line_index);
    }

    function load_stations(pref_index, line_index) {
        $('#modal2 #choice2_pref_' + pref_index + ' .station_line_' + line_index).show();
    }

    $('body').on('change', '.stations_all', function () {
        $(this).parent().siblings('li').find('input[name="stations[]"]').prop('checked', $(this).is(':checked'));
        $('input[name="stations[]"]').eq(0).change();
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
    $('body').on('change', '.modal input[name="areas[]"], .modal input[name="stations[]"], .modal input[name="job_types[]"], .modal input[name="employment_types[]"], .modal input[name="categories[]"], .modal select[name="salary[yearly]"], .modal select[name="salary[hourly]"], .modal input[name="traits[]"]', function () {
        total_jobs_update();
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
    $('.prefectures_group').hide();
    $('#modal1 .search_inner').hide();
    $('#modal1 .search_inner').eq(0).show();
    $('#modal2 .search_inner').hide();
    $('#modal2 .search_inner').eq(0).show();
    total_jobs_update();
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

    $('#' + modal + ' input[type="checkbox"]:checked').prop('checked', false);
    $('#' + modal + ' input[type="radio"]:checked').prop('checked', false);
    $('#' + modal + ' select').find('option:eq(0)').prop('selected', true);

    $('.prefectures_group').hide();
    $('#modal1 .search_inner').hide();
    $('#modal1 .search_inner').eq(0).show();
    $('#modal2 .search_inner').hide();
    $('#modal2 .search_inner').eq(0).show();

    set_pluses();
    total_jobs_update();
}

function total_jobs_update() {
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

    $.ajax({
        type: "POST",
        url: '/total_jobs',
        dataType: 'json',
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
            traits: traits
        },
        success: function (data) {
            $('.big').text(data.total_jobs);
        }
    });
}