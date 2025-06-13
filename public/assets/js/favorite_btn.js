$('body').on('click', '.favorite_btn', function (e) {

    e.stopPropagation()

    var self = $(this)
    var status = $(this).attr('status')

    if (status == '0') {
        // Add to favorites.

        $.ajax({
            type: "POST",
            url: '/favorites/add',
            data: {
                id: $(this).attr('job-id')
            },
            success: function () {

                $('#updated-successfully').text('検討中リストに追加しました。').fadeIn(function () {
                    setTimeout(function () {
                        $('#updated-successfully').fadeOut();
                    }, 3000);
                });


                self.addClass('favorite_btn--remove')
                self.attr('status', '1')
                if (!location.href.includes('/map')) {
                    self.text('★ 検討中リストから削除する')
                }
            },
        })

    } else {
        // Remove from favorites.
        $.ajax({
            type: "POST",
            url: '/favorites/delete',
            data: {
                id: $(this).attr('job-id')
            },
            success: function () {

                $('#updated-successfully').text('検討中リストから削除しました。').fadeIn(function () {
                    setTimeout(function () {
                        $('#updated-successfully').fadeOut();
                    }, 3000);
                }); 

                if (location.href.indexOf('favorites') !== -1) {
                    location.reload()
                } else {
                    self.removeClass('favorite_btn--remove')
                    self.attr('status', '0')

                    if (!location.href.includes('/map')) {
                        self.text('★ 検討中リストに追加する')
                    }
                }
            },
        })
    }
})