$('.favorite_btn').click(function () {
    var self = $(this);
    var status = $(this).attr('status');

    if (status == '0') {
        // Add to favorites.

        if (confirm('検討中リストに追加しますか？')) {
            $.ajax({
                type: "POST",
                url: '/favorites/add',
                data: {
                    id: $(this).attr('job-id')
                },
                success: function () {
                    self.addClass('favorite_btn--remove');
                    self.attr('status', '1');
                    self.text('★ 検討中リストから削除する');
                },
            });
        }

    } else {
        // Remove from favorites.
        if (confirm('検討中リストから削除しますか？')) {
            $.ajax({
                type: "POST",
                url: '/favorites/delete',
                data: {
                    id: $(this).attr('job-id')
                },
                success: function () {
                    if (location.href.indexOf('favorites') !== -1) {
                        location.reload();
                    } else {
                        self.removeClass('favorite_btn--remove');
                        self.attr('status', '0');
                        self.text('★ 検討中リストに追加する');
                    }
                },
            });
        }
    }
})