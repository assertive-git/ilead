<?php
$id = !empty($id) ? $id : '';
$title = !empty($title) ? $title : '';
$body = !empty($body) ? $body : '';
$status = !empty($status) ? $status : '';
$updated_at = !empty($updated_at) ? $updated_at : '';
?>
<div class="py-28 px-4 bg-slate-100">
    <div class="max-w-screen-2xl mx-auto space-y-4">

        <div id="updated-successfully"
            class="fixed z-10 text-center bg-slate-500 text-white left-0 w-full p-2 rounded-lg rounded-t-none xl:text-base text-sm hidden updated-successfully">
            更新完了
        </div>
        <input id="id" type="hidden" value="<?= $id ?>">
        <h2 class="text-xl">ニュースを登録</h2>
        <div class="flex flex-col xl:flex-row xl:space-x-12 xl:space-y-0 space-y-8 text-sm">
            <div class="flex flex-col space-y-4 left flex-1">
                <div
                    class="bg-white px-4 py-4 rounded-lg shadow <?= empty($id) ? 'hidden' : 'flex' ?> space-x-2 items-center article-id">
                    <i class="fa fa-building text-[#13b3e7]"></i>
                    <span class="font-bold">ニュースURL:</span>
                    <a id="article_id" class="underline" href="/news/<?= $id ?>"
                        target="_blank"><?= base_url() ?>news/<?= $id ?></a>
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">ニュース見出し *</span>
                    <input id="title" name="title" type="text" value="<?= $title ?>"
                        class="p-2 border border-slate-200">
                </div>

                <div class="flex flex-col space-y-2">
                    <span class="font-bold">ニュース内容 *</span>

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
                                        [{ size: ['small', false, 'large', 'huge'] }],
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
                                <a id="preview" href="<?= base_url() ?>news/<?= $id ?>" target="_blank">プレビュー</a>
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
                                    <a href="/admin/news/<?= $id ?>/delete" id="delete" class="text-red-500">削除</a>
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
                </div>
            </div>
        </div>


        <script>

            $('#update').click(function () {

                var id = $('#id').val();
                var title = $('#title').val();
                var body = $('.ql-editor').html();
                var status = $('#status').val();

                $.ajax({
                    type: "POST",
                    url: '/admin/news/update',
                    data: {
                        id: id,
                        title: title,
                        body: body,
                        status: status,
                    },
                    success: function (data) {
                        if (data.id) {
                            var id = data.id;
                            var updated_at = data.updated_at;

                            window.history.pushState({}, null, '/admin/news/' + id);
                            $('#id').val(id);

                            $('#job_id').text('<?= base_url() ?>news/' + id).attr('href', '/news/' + id);
                            $('.job-id').removeClass('hidden').addClass('flex');

                            $('#updated_at').text(updated_at);
                            $('.updated-at').removeClass('hidden').addClass('flex');

                            $('#preview').attr('href', '<?= base_url() ?>news/' + id)
                            $('.preview').removeClass('hidden').addClass('flex');

                            $('.delete').removeClass('justify-end').addClass('justify-between');
                            $('.delete-btn').removeClass('hidden');
                            $('.delete-btn a').attr('href', '/admin/news/' + id + '/delete');

                            $('#updated-successfully').fadeIn(function () {
                                setTimeout(function () {
                                    $('#updated-successfully').fadeOut();
                                }, 3000);
                            });
                        }
                    },
                    dataType: 'json'
                });
            });
        </script>