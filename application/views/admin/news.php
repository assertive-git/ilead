<div class="py-28 px-4 bg-slate-100">
    <div class="max-w-screen-2xl mx-auto space-y-8">
        <div class="space-y-6 flex flex-col items-center">
            <h2 class="text-2xl font-bold">ニュース</h2>
            <a href="/admin/news/new"><button class="bg-[#13b3e7] text-white py-2 px-6 text-xl">+ ニュースを作成する</button></a>
        </div>
        <div class="flex xl:flex-row flex-col xl:space-y-0 space-y-2 justify-between">
            <p><span class="text-[#13b3e7] font-bold text-3xl"><?= count($news) ?></span>件
                <?php if (count($news) > 20): ?>
                    (<?= $current_index_start ?>~<?= $current_index_end ?>件目を表示中)
                <?php endif; ?>
            </p>
            <form
                class="flex xl:flex-row flex-col xl:space-y-0 space-y-2 bg-slate-500 p-2 xl:space-x-3 space-x-0 text-sm"
                method="POST" action="/admin/news">
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
                    <input type="text" placeholder="ニュース検索・・・" class="px-2 py-1 xl:w-auto w-full" name="keyword"
                        value="<?= $keyword ?>">
                    <button type="submit"
                        class="bg-none border text-white hover:bg-white hover:text-black px-2 py-1 xl:w-auto w-full">検索</button>
                </div>
            </form>
        </div>
        <form method="POST" action="/admin/news" class="flex space-x-2 text-sm items-center">
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
        <?php if (count($news) > 10): ?>
            <div class="pagination space-x-5 flex max-w-lg mx-auto justify-center items-center bg-gray-500 text-white p-2">
                <?= $this->pagination->create_links(); ?>
            </div>
        <?php endif; ?>
        <div class="overflow-auto">
            <table class="bg-white p-8 border-collapse text-sm w-full" style="min-width: 1280px">
                <tr class="border border-black pb-4 border-t-0 border-l-0 border-r-0">
                    <td class="p-2 font-bold">ID</td>
                    <td class="p-2 font-bold" style="min-width: 500px">見出し</td>
                    <td class="p-2 font-bold">更新日時</td>
                    <td class="p-2 font-bold">公開日</td>
                    <td class="p-2 font-bold">ステータス</td>
                </tr>
                <?php foreach ($news as $article): ?>
                    <tr class="border border-black pb-4 border-t-0 border-l-0 border-r-0">
                        <td class="p-2"><a class="text-[#13b3e7] pr-2" href="/news/<?= $article['id'] ?>"
                                target="_blank"><?= $article['id'] ?></a></td>
                        <td class="p-2">
                            <div class="flex flex-col space-y-1">
                                <span><?= $article['title'] ?></span>
                                <ul class="flex space-x-2">
                                    <li><a class="underline" href="/admin/news/<?= $article['id'] ?>">編集</a></li>
                                    <li><a class="delete" class="underline"
                                            href="/admin/news/<?= $article['id'] ?>/delete">削除</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td class="p-2"><?= $article['updated_at'] ?></td>
                        <td class="p-2"><?= $article['created_at'] ?></td>
                        <td class="p-2"><?= $article['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="p-2 font-bold">ID</td>
                    <td class="p-2 font-bold">見出し</td>
                    <td class="p-2 font-bold">更新日時</td>
                    <td class="p-2 font-bold">公開日</td>
                    <td class="p-2 font-bold">ステータス</td>
                </tr>
            </table>
            <script>
                $('.delete').click(function (e) {
                    e.preventDefault();

                    if (confirm('削除してもいいですか？')) {
                        var href = $(this).attr('href');
                        window.location.href = href;
                    }

                });
            </script>
        </div>
        <?php if (count($news) > 10): ?>
            <div class="pagination space-x-5 flex max-w-lg mx-auto justify-center items-center bg-gray-500 text-white p-2">
                <?= $this->pagination->create_links(); ?>
            </div>
        <?php endif; ?>