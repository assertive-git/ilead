/* init code */

/* last_update_check */
var last_update_check = Date.now()

var lines_stations
var areas

if (sessionStorage.getItem('lines_stations')) {
    lines_stations = JSON.parse(sessionStorage.getItem('lines_stations'))
} else {
    lines_stations = []
}

if (sessionStorage.getItem('areas')) {
    areas = JSON.parse(sessionStorage.getItem('areas'))
} else {
    areas = []
}

(function () {

    $(window).on('load', function () {

        var origin = window.origin + '/'
        var location = window.location

        // if (origin == location) {
        //     $('input, select').each(function () {
        //         $(this).prop('checked', false)
        //         if ($(this).is('select')) {
        //             $(this)[0].selectedIndex = 0
        //         }
        //     })
        // }

        $('#region_area_1').click()
        $('#prefectures_area_1_13').click()

        $('#region_lines_stations_1').click()
        $('#prefectures_lines_stations_1_13').click()
    })

}());

// /* LINES AND STATIONS */
(function () {

    $('.region_area').change(function () {

        $('#modal1 .prefectures_group').hide()
        $('.area-box').hide()
        $('.area-box').eq(0).show()
        var index = $(this).index('.region_area')

        // select prefecture with same index
        $('#modal1 .prefectures_group').eq(index).css({ display: 'flex' })

        $('.prefectures_area').prop('checked', false)
    })

    $('.prefectures_area').change(function () {

        $('.area-box').hide()
        var index = $(this).index('.prefectures_area') + 1

        // select area with same index
        $('.area-box').eq(index).show()
    })

    $('.region_lines_stations').change(function () {

        $('#modal2 .prefectures_group').hide()
        var index = $(this).index('.region_lines_stations')

        // select prefecture with same index
        $('#modal2 .prefectures_group').eq(index).css({ display: 'flex' })
    })

    $('body').on('change', '.areas_all', function () {

        var checked = $(this).is(':checked')
        var areas = $(this).siblings('.areas')

        areas.prop('checked', checked)
        areas.change()
    })

    $('body').on('change', '.stations_all', function () {

        var checked = $(this).is(':checked')
        var stations = $(this).closest('li').siblings('li').find('.stations')

        stations.prop('checked', checked)
        stations.change()
    })

    $('body').on('change', '.stations', function () {
        var stations_all = $(this).closest('.scroll_inner').find('li').eq(0).find('.stations_all')
        var stations_checked = $(this).closest('.scroll_inner').find('.stations:checked')
        var stations = $(this).closest('.scroll_inner').find('.stations')

        stations_all.prop('checked', stations_checked.length == stations.length)
    })

    $('body').on('change', '.areas', function () {
        var areas_all = $(this).closest('.choice').find('.areas_all')
        var areas_checked = $(this).closest('.choice').find('.areas:checked')
        var areas = $(this).closest('.choice').find('.areas')

        areas_all.prop('checked', areas_checked.length == areas.length)
    })


    $('body').on('change', '.line_name_cb', function () {
        var checked = $(this).is(':checked')
        checked ? $(this).next().find('.line_name').addClass('active') : $(this).next().find('.line_name').removeClass('active')
    })
}());

/* 検索絞り反映 */
(function () {
    $('.reflect').click(function () {
        $('.modal').hide()
    })

    $('.reset').click(function () {
        var modal_id = $(this).closest('.modal').attr('id')
        reset_one_plus(modal_id)
    })
}());

/* 検索の該当件数更新 */
(function () {
    $('body').on('change', '.modal input[name="areas[]"], .modal input[name="job_types[]"], .modal input[name="employment_types[]"], .modal input[name="categories[]"], .modal select[name="salary[yearly]"], .modal select[name="salary[hourly]"], .modal input[name="traits[]"]', function () {
        set_pluses()
        total_jobs_update()
    })
}())

$('.region_area').change(function () {
    var region = $(this).val()

    var el = $('label[region_id="' + region + '"]').siblings('.prefectures_area').eq(0)

    el.click()

})

$('.region_lines_stations').change(function () {
    var region = $(this).val()

    var el = $('label[region_id="' + region + '"]').siblings('.prefectures_lines_stations').eq(0)

    el.click()

})

$(".prefectures_lines_stations").change(function () {

    var pref = $(this).val()

    // $(".choice_ttl").hide()
    $(".to_pref").hide()

    // line pref title
    $('.choice_ttl').text(pref).attr('line_pref_title', pref).show()

    // line title
    $(".to_pref[line_pref='" + pref + "']").show()

    // station list
    $(".to_pref[line_pref='" + pref + "']").find('.line').eq(0).click()
})

$('.line').change(function () {

    // remove initial selection from choosing prefecture
    $('.line').eq(0).removeClass('active')

    var line_cd = $(this).attr('line_cd')
    var pref_cd = $(this).attr('pref_cd')

    if (!line_cd) return

    $.ajax({
        type: "POST",
        url: '/get_stations',
        dataType: 'json',
        data: {
            line_cd: line_cd,
            pref_cd: pref_cd,
        },
        success: function (stations) {

            var pref = stations[0].pref
            var line = stations[0].line

            var region = $('#modal2 .prefectures label:contains("' + pref + '")').attr('region_id')

            // line title
            $('.station .choice_ttl_line').text(line)
            // stations

            var html = ''

            //all
            html += '<li><label><div class="station_name"><input line="' + line + '" class="stations_all" type="checkbox"><i class="fa-solid fa-circle-check"></i>' + line + 'のすべて</div></label></li>'

            var checkedCount = 0

            //single
            var station
            for (var i = 0; i < stations.length; i++) {
                station = stations[i].station

                var checked = lines_stations.indexOf(region + "_" + pref + "_" + line + "_" + station) !== -1 ? 'checked' : ''

                if (checked) {
                    checkedCount += 1
                }

                html += '<li><label><div class="station_name"><input line="' + line + '" class="stations" ' + checked + ' type="checkbox" value="' + region + "_" + pref + "_" + line + "_" + station + '"><i class="fa-solid fa-circle-check"></i>' + station + '</div></label></li>'
            }

            $('.station .scroll_inner').html(html)

            if (checkedCount == stations.length) {
                $('.stations_all').prop('checked', true)
            }

            if (checkedCount > 0) {
                total_jobs_update()
            }
        },
        error: function () {
        }
    })
});

(function () {

    var x

    $('body').on('keyup', 'input[name="freeword"]', function () {

        if (x) {
            clearTimeout(x)
        }

        x = setTimeout(function () {
            total_jobs_update()
        }, 300)

    })
}())

function reset_all_pluses() {
    // $('#municipalities_all').prop('checked', false);
    // $('input[name="areas[]"]:checked').prop('checked', false);
    // $('.stations:checked').prop('checked', false);
    // $('#station0001').prop('checked', false);
    // $('input[name="categories[]"]:checked').prop('checked', false);
    // $('input[name="job_types[]"]:checked').prop('checked', false);
    // $('input[name="employment_types[]"]:checked').prop('checked', false);
    // $('input[name="traits[]"]:checked').prop('checked', false);

    $('input[type="checkbox"]:checked').prop('checked', false)
    $('input[type="radio"]:checked').prop('checked', false)
    $('select').find('option:eq(0)').prop('selected', true)

    set_pluses()

    $('.prefectures_group').hide()
    $('#modal1 .search_inner2').hide()
    $('#modal1 .search_inner2').eq(0).show()
    $('#modal2 .choice2').hide()
    $('#modal2 .choice2').eq(0).show()
    $('#modal2 .station').hide()
    $('#modal2 .station').eq(0).show()
    $('.scroll_inner li').removeAttr('style')

    total_jobs_update()
}

function set_pluses() {
    $('input[name="areas[]"]:checked').length ? $('.areas_h').addClass('active') : $('.areas_h').removeClass('active')
    $('.stations_hidden').length ? $('.stations_h').addClass('active') : $('.stations_h').removeClass('active')
    $('input[name="categories[]"]:checked').length ? $('.categories').addClass('active') : $('.categories').removeClass('active')
    $('input[name="job_types[]"]:checked').length ? $('.job_types').addClass('active') : $('.job_types').removeClass('active')
    $('input[name="employment_types[]"]:checked').length || $('select[name="salary[yearly]"]').val() || $('select[name="salary[hourly]"]').val() ? $('.employment_types').addClass('active') : $('.employment_types').removeClass('active')
    $('input[name="traits[]"]:checked').length ? $('.traits').addClass('active') : $('.traits').removeClass('active')
}

function reset_one_plus(modal) {

    $('#' + modal + ' input[type="checkbox"]:checked').prop('checked', false)
    $('#' + modal + ' input[type="radio"]:checked').prop('checked', false)
    $('#' + modal + ' select').find('option:eq(0)').prop('selected', true)

    // $('.prefectures_group').hide()

    if (modal == "modal1") {
        $('#region_area_1').click()
        $('#prefectures_area_1_13').click()
        areas = []
        sessionStorage.setItem('areas', [])
    }

    if (modal == "modal2") {
        $('#region_lines_stations_1').click()
        $('#prefectures_lines_stations_1_13').click()
        $('.line_name').removeClass('active')
        lines_stations = []
        sessionStorage.setItem('lines_stations', [])
        $('#stations').html('')
    }

    if (modal == "modal1" || modal == "modal2") {
        $('#' + modal + ' .region label').removeClass('active')
        $('#' + modal + ' .prefectures label').removeClass('active')
    }

    // $('#modal2 .choice2').hide()
    // $('#modal2 .choice2').eq(0).show()
    // $('#modal2 .station').hide()
    // $('#modal2 .station').eq(0).show()
    // $('.scroll_inner li').removeAttr('style')



    set_pluses()

    total_jobs_update()
}

function total_jobs_update() {

    // var current_time = Date.now()
    // if (current_time - last_update_check < 500) return
    // last_update_check = current_time

    var areas = []
    var _areas = $('input[name="areas[]"]:checked')
    $(_areas).each(function (i, el) {
        var area = $(this).val()
        areas.push(area)
    })

    var stations = []
    var _stations = $('.stations_hidden')

    $(_stations).each(function (i, el) {
        var station = $(this).val()
        stations.push(station)
    })

    var categories = []
    var _categories = $('input[name="categories[]"]:checked')
    $(_categories).each(function (i, el) {
        categories.push($(_categories[i]).val())
    })

    var job_types = []
    var _job_types = $('input[name="job_types[]"]:checked')
    $(_job_types).each(function (i, el) {
        job_types.push($(_job_types[i]).val())
    })

    var employment_types = []
    var _employment_types = $('input[name="employment_types[]"]:checked')
    $(_employment_types).each(function (i, el) {
        employment_types.push($(_employment_types[i]).val())
    })

    var yearly = $('select[name="salary[yearly]"]').val()
    var hourly = $('select[name="salary[hourly]"]').val()

    var traits = []
    var _traits = $('input[name="traits[]"]:checked')
    $(_traits).each(function (i, el) {
        traits.push($(_traits[i]).val())
    })

    var freeword = $('input[name="freeword"]').val()

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
            $('.total_jobs').text(data.total_jobs)
        }
    })
}

// アクティブなエリア、都道府県を分かりやすくする
(function () {

    $('.areas').change(function () {

        var region = $(this).attr('region_id')
        var prefArea = $(this).val()

        $(this).is(':checked') ? addToMemory_Area(region, prefArea) : removeFromMemory_Area(region, prefArea)

        var pref = $(this).attr('pref_key')
        var checkedCount = $(this).closest('.choice').find('.areas:checked').length

        if (checkedCount) {
            var _pref = $("#modal1 label:contains('" + pref + "')")
            _pref.addClass('active')
            $("#modal1 label:contains('" + pref + "')").prev().prev().prop('checked', true)

            var region_id = _pref.attr('region_id')
            $("#modal1 label:contains('" + region_id + "')").addClass('active')
            $("#modal1 label:contains('" + region_id + "')").prev().prev().prop('checked', true)

        } else {
            var _pref = $("#modal1 label:contains('" + pref + "')")

            _pref.removeClass('active')
            $("#modal1 label:contains('" + pref + "')").prev().prev().prop('checked', false)

            var region_id = _pref.attr('region_id')

            var hasSubString = areas.some(el => el.includes(region_id))

            if (!hasSubString) {
                $("#modal1 label:contains('" + region_id + "')").removeClass('active')
                $("#modal1 label:contains('" + region_id + "')").prev().prev().prop('checked', false)
            }

        }
    })

    $('body').on('change', ".stations", "stations_all", function () {


        var info = $(this).val().split('_')

        var region = info[0]
        var pref = info[1]
        var line_name = info[2]
        var station = info[3]

        $(this).is(':checked') ? addToMemory_LS(region, pref, line_name, station) : removeFromMemory_LS(region, pref, line_name, station)

        // var pref_id = $("#modal2 .prefectures input:checked+label").text()
        // var line = $("#modal2 .scroll_inner div[pref_id='" + pref_id + "']:contains('" + line__name + "')")
        // var pref = line.attr('pref_id')

        var checkedCount = $(this).closest('.station').find('input:checked').length

        if (checkedCount != 0) {

            var line = $('.to_pref[line_pref="' + pref + '"]').find('.line_name:contains("' + line_name + '")')
            line.addClass('active')
            line.parent().prev().prop('checked', true)

            var _pref = $("#modal2 label:contains('" + pref + "')")
            _pref.addClass('active')
            $("#modal2 label:contains('" + pref + "')").prev().prev().prop('checked', true)

            var region_id = _pref.attr('region_id')
            $("#modal2 label:contains('" + region_id + "')").addClass('active')
            $("#modal2 label:contains('" + region_id + "')").siblings('.prefectures_lines_stations_cb').prop('checked', true)

        } else {
            var line = $('.to_pref[line_pref="' + pref + '"]').find('.line_name:contains("' + line_name + '")')
            line.removeClass('active')
            line.parent().prev().prop('checked', false)


            var _pref = $("#modal2 label:contains('" + pref + "')")

            // different
            var checkedCount = $(this).closest('.choice2').find('.stations').find('input:checked').length

            if (checkedCount == 0) {
                _pref.removeClass('active')
                $("#modal2 label:contains('" + pref + "')").prev().prev().prop('checked', false)

                var region_id = _pref.attr('region_id')

                var hasSubString = lines_stations.some(el => el.includes(region_id))

                if (!hasSubString) {
                    $("#modal2 label:contains('" + region_id + "')").removeClass('active')
                    $("#modal2 label:contains('" + region_id + "')").prev().prev().prop('checked', false)
                }

            }
        }

        set_pluses()
        total_jobs_update()
    })

    function addToMemory_Area(region, prefArea) {
        var index = areas.indexOf(region + "_" + prefArea)
        if (index === -1) {
            areas.push(region + "_" + prefArea)
            sessionStorage.setItem('areas', JSON.stringify(areas))
        }
    }

    function removeFromMemory_Area(region, prefArea) {
        var index = areas.indexOf(region + "_" + prefArea)
        if (index !== -1) {
            areas.splice(index, 1)
            sessionStorage.setItem('areas', JSON.stringify(areas))
        }
    }

    function addToMemory_LS(region, pref, line_name, station) {
        var index = lines_stations.indexOf(region + "_" + pref + "_" + line_name + "_" + station)
        if (index === -1) {
            lines_stations.push(region + "_" + pref + "_" + line_name + "_" + station)
            sessionStorage.setItem('lines_stations', JSON.stringify(lines_stations))
        }

        $("#stations").append('<input class="stations_hidden" type="hidden" value="' + line_name + station + '" name="stations[]">')
    }


    function removeFromMemory_LS(region, pref, line_name, station) {
        var index = lines_stations.indexOf(region + "_" + pref + "_" + line_name + "_" + station)
        if (index !== -1) {
            lines_stations.splice(index, 1)
            sessionStorage.setItem('lines_stations', JSON.stringify(lines_stations))
        }

        $('.stations_hidden[value="' + line_name + station + '"]').remove()
    }

    // initial check for existing regions, prefectures, lines

    /* AREAS */

    // regions
    $('label[for*="region_area_"]').each(function () {

        var hasSubString = areas.some(el => el.includes($(this).text()))

        if (hasSubString) {
            $("#modal1 label:contains('" + $(this).text() + "')").addClass('active')
            $("#modal1 label:contains('" + $(this).text() + "')").prev().prev().prop('checked', true)
        }
    })

    // prefectures
    $('label[for*="prefectures_area_"]').each(function () {
        var hasSubString = areas.some(el => el.includes($(this).text()))

        if (hasSubString) {
            $("#modal1 label:contains('" + $(this).text() + "')").addClass('active')
            $("#modal1 label:contains('" + $(this).text() + "')").prev().prev().prop('checked', true)
        }
    })

    /* LINES_STATIONS */

    // regions
    $('label[for*="region_lines_stations_"]').each(function () {

        var self = $(this)

        var hasSubString = lines_stations.some(el => {
            var area = el.split('_')[0]
            return area.includes(self.text())
        })

        if (hasSubString) {
            $("#modal2 label:contains('" + $(this).text() + "')").addClass('active')
            // $("#modal2 label:contains('" + $(this).text() + "')").prev().prev().prop('checked', true)
        }
    })

    // prefectures
    $('label[for*="prefectures_lines_stations_"]').each(function () {
        var hasSubString = lines_stations.some(el => el.includes($(this).text()))

        if (hasSubString) {
            $("#modal2 label:contains('" + $(this).text() + "')").addClass('active')
            $("#modal2 label:contains('" + $(this).text() + "')").prev().prev().prop('checked', true)
        }
    })

    // lines
    $('.line_name').each(function () {

        var pref = $(this).closest('.to_pref').attr('line_pref')

        var text = pref + "_" + $(this).text()

        var hasSubString = lines_stations.some(el => el.includes(text))

        if (hasSubString) {
            $(this).closest('.to_pref[line_pref="' + pref + '"]').find('.line_name').addClass('active')
            // $(this).closest('.to_pref[line_pref="' + pref + '"]').find('.line').prop('checked', true)
        }
    })

    for (var i = 0; i < lines_stations.length; i++) {
        var item = lines_stations[i].split('_')


        var line_name = item[2]
        var station = item[3]

        $("#stations").append('<input class="stations_hidden" type="hidden" value="' + line_name + station + '" name="stations[]">')
    }

    set_pluses()
    total_jobs_update()
})();

(function () {

    $('.job_list_reset').click(function (e) {
        e.preventDefault()
        resetFromMemory()
        location.href = $(this).attr('href')
    })

    function resetFromMemory() {
        sessionStorage.setItem('lines_stations', [])
        sessionStorage.setItem('areas', [])
    }
})();


