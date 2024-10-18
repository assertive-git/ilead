<div id="backdrop"
    class="hidden flex justify-center items-center fixed top-0 left-0 w-full h-full bg-black bg-opacity-60">
    <div id="loader"><i
            class="fa-solid fa-spinner animate-spin text-white xl:text-4xl lg:text-4xl md:text-4xl sm:text-4xl text-3xl"></i>
    </div>
</div>

<div class="py-28 px-4 bg-slate-100">
    <div class="max-w-screen-2xl mx-auto space-y-8">
        <div class="space-y-6 flex flex-col items-center">
            <h2 class="text-2xl font-bold">求人票</h2>
            <a href="/admin/jobs/new"><button class="bg-[#13b3e7] text-white py-2 px-6 text-xl">+ 求人票を作成する</button></a>
        </div>
        <div class="flex xl:flex-row flex-col xl:space-y-0 space-y-2 justify-between">
            <p><span class="text-[#13b3e7] font-bold text-3xl"><?= $total_jobs ?></span>件
                (<?= $current_index_start ?>~<?= $current_index_end ?>件目を表示中)</p>
            <form
                class="flex xl:flex-row flex-col xl:space-y-0 space-y-2 bg-slate-500 p-2 xl:space-x-3 space-x-0 text-sm"
                method="POST" action="/admin/jobs">
                <div class="xl:space-x-2 space-x-0 xl:space-y-0 space-y-2 flex xl:flex-row flex-col items-center">
                    <span class="text-white">ステータス：</span>
                    <select name="status" class="px-2 py-1 xl:w-auto w-full">
                        <option value=""></option>
                        <option value="公開" <?= $status == '公開' ? 'selected' : '' ?> value="公開">公開</option>
                        <option value="非公開" <?= $status == '非公開' ? 'selected' : '' ?> value="非公開">非公開</option>
                        <option value="下書き" <?= $status == '下書き' ? 'selected' : '' ?> value="下書き">下書き</option>
                    </select>
                </div>
                <div class="xl:space-x-1 space-x-0 xl:space-y-0 space-y-2">
                    <input type="text" placeholder="求人検索・・・" class="px-2 py-1 xl:w-auto w-full" name="keyword"
                        value="<?= $keyword ?>">
                    <button type="submit"
                        class="bg-none border text-white hover:bg-white hover:text-black px-2 py-1 xl:w-auto w-full">検索</button>
                </div>

            </form>
        </div>
        <div class="flex flex-col xl:flex-row xl:space-x-6 xl:space-y-0  space-y-6">
            <div class="flex space-x-2">
                <select class="p-1" id="operations">
                    <option value="">一括操作</option>
                    <option value="複製">複製</option>
                    <option value="削除">削除</option>
                    <option value="公開">公開</option>
                    <option value="非公開">非公開</option>
                    <option value="下書き">下書き</option>
                </select>
                <button class="bg-[#13b3e7] text-white p-2 rounded" id="operations_apply">適用</button>
            </div>
            <div class="flex space-x-2">
                <button id="csv_export" class="bg-green-600 p-2 text-white rounded"><i class="fa-solid fa-file-csv"></i>
                    エクスポート</button>
                <button id="csv_import" class="bg-gray-500 p-2 text-white rounded"><i class="fa-solid fa-file-csv"></i>
                    インポート</button>
                <input id="csv_file_input" class="hidden" type="file" accept=".csv">
            </div>
        </div>
        <form method="POST" action="/admin/jobs" class="flex space-x-2 text-sm items-center">
            <span>行数：</span>
            <select name="limit" class="px-2 py-1 w-[65px]">
                <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>25</option>
                <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>50</option>
                <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>100</option>
                <option value="250" <?= $limit == 250 ? 'selected' : '' ?>>250</option>
                <option value="500" <?= $limit == 500 ? 'selected' : '' ?>>500</option>
            </select>
            <button class="bg-gray-500 px-2 py-1 text-white" id="rows">更新</button>
        </form>
        <?php if($total_jobs > 25): ?>
        <div class="pagination space-x-5 flex max-w-lg mx-auto justify-center items-center bg-gray-500 text-white p-2">
            <?= $this->pagination->create_links(); ?>
        </div>
        <?php endif; ?>
        <div class="overflow-auto">
            <table class="bg-white p-8 border-collapse text-sm w-full" style="min-width: 1280px">
                <thead>
                    <tr class="border border-black pb-4 border-t-0 border-l-0 border-r-0 text-left">
                        <th class="p-2"><input class="check_all check" type="checkbox"></th>
                        <th class="p-2 font-bold">ID</th>
                        <th class="p-2 font-bold" style="min-width: 500px">見出し</th>
                        <th class="p-2 font-bold">職種／雇用</th>
                        <th class="p-2 font-bold">勤務地</th>
                        <th class="p-2 font-bold">更新日時</th>
                        <th class="p-2 font-bold">公開日</th>
                        <th class="p-2 font-bold">ステータス</th>
                        <th class="p-2 font-bold">メモ</th>
                    </tr>
                </thead>


                <tbody>
                    <?php foreach ($jobs as $job): ?>
                        <tr class="border border-black pb-4 border-t-0 border-l-0 border-r-0">
                            <td class="p-2"><input class="check_one check" job-id="<?= $job['id'] ?>" type="checkbox"></td>
                            <td class="p-2"><a class="text-[#13b3e7] pr-2" href="/jobs/<?= $job['id'] ?>"
                                    target="_blank"><?= $job['id'] ?></a></td>
                            <td class="p-2">
                                <div class="flex flex-col space-y-1">
                                    <span><?= ellipsize($job['title'], 43) ?></span>
                                    <ul class="flex space-x-2">
                                        <li><a href="/admin/jobs/<?= $job['id'] ?>"><i class="fa-regular fa-pen-to-square"></i> 編集</a></li>
                                        <li><a class="copy" class="underline"
                                                href="/admin/jobs/<?= $job['id'] ?>/copy"><i class="fa-regular fa-copy"></i> 複製</a>
                                        </li>
                                        <li><a class="delete" class="underline"
                                                href="/admin/jobs/<?= $job['id'] ?>/delete"><i class="fa-regular fa-trash-can"></i> 削除</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                            <td class="p-2"><?= $job['employment_type'] ?></td>
                            <td class="p-2"><?= $job['city'] ?></td>
                            <td class="p-2"><?= $job['updated_at'] ?></td>
                            <td class="p-2"><?= $job['created_at'] ?></td>
                            <td class="p-2"><?= $job['status'] ?></td>
                            <td class="p-2"><textarea class="p-2 border h-[75px] w-full memo"
                                    job-id="<?= $job['id'] ?>"><?= $job['memo'] ?></textarea></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <tfoot>
                    <tr class="text-left">
                        <th class="p-2"><input class="check_all check" type="checkbox"></th>
                        <th class="p-2 font-bold">ID</th>
                        <th class="p-2 font-bold">見出し</th>
                        <th class="p-2 font-bold">職種／雇用</th>
                        <th class="p-2 font-bold">勤務地</th>
                        <th class="p-2 font-bold">更新日時</th>
                        <th class="p-2 font-bold">公開日</th>
                        <th class="p-2 font-bold">ステータス</th>
                        <th class="p-2 font-bold">メモ</th>
                    </tr>
                </tfoot>
            </table>
            <script>

                // Copy Job

                $('.copy').click(function (e) {
                    e.preventDefault();

                    if (confirm('複製してもいいですか？')) {
                        var href = $(this).attr('href');
                        window.location.href = href;
                    }

                });

                // Delete Job

                $('.delete').click(function (e) {
                    e.preventDefault();

                    if (confirm('削除してもいいですか？')) {
                        var href = $(this).attr('href');
                        window.location.href = href;
                    }

                });
            </script>

            <script>
                // Check All
                $('.check_all').change(function () {
                    $('.check').prop('checked', $(this).is(':checked'));
                });

                // Check One
                $('.check_one').change(function () {
                    var all_boxes_checked = $('.check_one:not(:checked)').length === 0;
                    $('.check_all').prop('checked', all_boxes_checked);
                });
            </script>

            <script>
                // Memo

                var memo_timeout;

                $('.memo').keyup(function () {
                    var job_id = $(this).attr('job-id');
                    var memo = $(this).val();

                    if (!memo_timeout) {
                        memo_timeout = start_memo_timeout(job_id, memo);
                    } else {
                        clearTimeout(memo_timeout);
                        memo_timeout = start_memo_timeout(job_id, memo);
                    }
                });

                function start_memo_timeout(job_id, memo) {
                    return setTimeout(function () {
                        $.ajax({
                            type: "POST",
                            url: '/admin/jobs/memo/update',
                            data: {
                                job_id: job_id,
                                column: 'memo',
                                contents: memo
                            },
                            success: function (data) {
                                console.log('Successfully updated memo.');
                            },
                        });
                    }, 500);
                }
            </script>

            <script>
                // Operations

                $('#operations_apply').click(function () {
                    var operation = $('#operations').children(':selected').val();

                    if (operation == "") return;

                    var job_ids = [];

                    $('.check_one:checked').each(function () {
                        job_ids.push($(this).attr('job-id'));
                    });

                    if (job_ids.length == 0) return;

                    switch (operation) {
                        case '複製':
                            $.ajax({
                                type: "POST",
                                url: '/admin/jobs/copy_multiple',
                                data: {
                                    job_ids: job_ids
                                },
                                success: function (data) {
                                    console.log('Successfully copied jobs.');
                                    location.reload();
                                },
                            });
                            break;
                        case '削除':
                            $.ajax({
                                type: "POST",
                                url: '/admin/jobs/delete_multiple',
                                data: {
                                    job_ids: job_ids
                                },
                                success: function (data) {
                                    console.log('Successfully deleted jobs.');
                                    location.reload();
                                },
                            });
                            break;
                        case '公開':
                        case '非公開':
                        case '下書き':
                            $.ajax({
                                type: "POST",
                                url: '/admin/jobs/status/update_multiple',
                                data: {
                                    job_ids: job_ids,
                                    column: 'status',
                                    contents: operation
                                },
                                success: function (data) {
                                    console.log('Successfully updated statuses.');
                                    location.reload();
                                },
                            });

                            break;
                        default:
                            console.log('User has not selected a valid operation');
                    }
                })
            </script>

            <script>
                // CSV Export
                $('#csv_export').click(function () {
                    location = '/admin/jobs/csv_export';
                });

                // CSV Import

                var csv_file_input = $('#csv_file_input');

                $('#csv_import').click(function () {
                    $('#csv_file_input').click();
                });

                csv_file_input.change(function (e) {
                    var file = e.target.files[0];
                    var extension = file.name.replace(/^.*\./, "");
                    if (extension != "csv") {
                        alert("CSVファイルのみ有効です。");
                        $(this).val("");
                    } else {
                        var formData = new FormData();

                        $('html').css('overflow', 'hidden');
                        $('#backdrop').css('display', 'flex');

                        formData.append('csv', file);
                        // formData.append('csrf_token', getCookie('csrf_token'));

                        $.ajax({
                            url: "/admin/jobs/csv_import",
                            type: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                location.reload();
                            },
                            error: function (err) {
                                console.log(err.responseText);
                                $('html').css('overflow', 'visible');
                                $('#backdrop').css('display', 'none');
                                csv_file_input.val('');
                            }
                        });
                    }
                });
            </script>
        </div>

        <?php if($total_jobs > 25): ?>
        <div class="pagination space-x-5 flex max-w-lg mx-auto justify-center items-center bg-gray-500 text-white p-2">
            <?= $this->pagination->create_links(); ?>
        </div>
        <?php endif; ?>