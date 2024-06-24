// /* LINES AND STATIONS */
(function () {

    $('.region_area').change(function () {

        $('#modal1 .prefectures_group').hide();
        $('.search_inner2').hide();
        $('.search_inner2').eq(0).show();
        var index = $(this).index('.region_area');

        // select prefecture with same index
        $('#modal1 .prefectures_group').eq(index).css({ display: 'flex' });

        $('.prefectures_area').prop('checked', false);
    });

    $('.prefectures_area').change(function () {

        $('.search_inner2').hide();
        var index = $(this).index('.prefectures_area') + 1;

        // select area with same index
        $('.search_inner2').eq(index).show();
    });

    $('.region_lines_stations').change(function () {

        $('#modal2 .prefectures_group').hide();
        $('.choice2').hide();
        $('.choice2').eq(0).css({display: 'flex'});
        var index = $(this).index('.region_lines_stations');

        // select prefecture with same index
        $('#modal2 .prefectures_group').eq(index).css({ display: 'flex' });

        $('.prefectures_lines_stations').prop('checked', false);
    });

    $('.prefectures_lines_stations').change(function () {

        $('.choice2').hide();
        var index = $(this).index('.prefectures_lines_stations') + 1;

        // select area with same index
        $('.choice2').eq(index).css({display: 'flex'});
    });

    $('.route li').click(function () {

        var index = $(this).index('.route li')  + 1;
        $('.station').hide();
        $('.station').eq(index).show();
    });


    $('body').on('change', '.areas_all', function () {
        $(this).siblings('input[name="areas[]"]').prop('checked', $(this).is(':checked'));
    });

    $('body').on('change', '.stations_all', function () {
        $(this).closest('li').siblings('li').find('input[name="stations[]"]').prop('checked', $(this).is(':checked'));
        $('input[name="stations[]"]').eq(0).change();
    });
}());

/* 検索絞り反映 */
(function () {
    $('.reflect').click(function () {
        $('.modal').hide();
    });

    $('.reset').click(function () {
        var modal_id = $(this).closest('.modal').attr('id');
        reset_one_plus(modal_id);
    });
}());

/* 検索の該当件数更新 */
(function () {
    $('body').on('change', '.modal input[name="areas[]"], .modal input[name="stations[]"], .modal input[name="job_types[]"], .modal input[name="employment_types[]"], .modal input[name="categories[]"], .modal select[name="salary[yearly]"], .modal select[name="salary[hourly]"], .modal input[name="traits[]"]', function () {
        set_pluses();
        total_jobs_update();
    });
}());

(function () {

    var x;

    $('body').on('keyup', 'input[name="freeword"]', function () {

        if (x) {
            clearTimeout(x);
        }

        x = setTimeout(function () {
            total_jobs_update();
        }, 300);

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
    $('#modal1 .search_inner2').hide();
    $('#modal1 .search_inner2').eq(0).show();
    $('#modal2 .choice2').hide();
    $('#modal2 .choice2').eq(0).show();
    $('#modal2 .station').hide();
    $('#modal2 .station').eq(0).show();
    $('.scroll_inner li').removeAttr('style');
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
    $('#modal1 .search_inner2').hide();
    $('#modal1 .search_inner2').eq(0).show();
    $('#modal2 .choice2').hide();
    $('#modal2 .choice2').eq(0).show();
    $('#modal2 .station').hide();
    $('#modal2 .station').eq(0).show();
    $('.scroll_inner li').removeAttr('style');

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

    var freeword = $('input[name="freeword"]').val();

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
            traits: traits,
            freeword: freeword
        },
        success: function (data) {
            $('.total_jobs').text(data.total_jobs);
        }
    });
}