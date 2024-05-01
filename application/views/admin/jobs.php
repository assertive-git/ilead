<div class="py-28 px-4 bg-slate-100">
    <div class="max-w-screen-2xl mx-auto space-y-8">
        <div class="space-y-6 flex flex-col items-center">
            <h2 class="text-2xl font-bold">求人票</h2>
            <a href="/admin/jobs/new"><button class="bg-[#13b3e7] text-white py-2 px-6 text-xl">+ 求人票を作成する</button></a>
        </div>
        <div class="flex xl:flex-row flex-col xl:space-y-0 space-y-2 justify-between">
            <p><span class="text-[#13b3e7] font-bold text-3xl">0000</span>件 (1~20件目を表示中)</p>
            <form
                class="flex xl:flex-row flex-col xl:space-y-0 space-y-2 bg-slate-500 p-2 xl:space-x-3 space-x-0 text-sm"
                method="POST" action="/admin/jobs">
                <div class="xl:space-x-2 space-x-0 xl:space-y-0 space-y-2 flex xl:flex-row flex-col items-center">
                    <span class="text-white">ステータス：</span>
                    <select name="status" class="px-2 py-1 xl:w-auto w-full">
                        <option value=""></option>
                        <option value="公開" value="公開">公開</option>
                        <option value="非公開" value="非公開">非公開</option>
                        <option value="下書き" value="下書き">下書き</option>
                    </select>
                </div>
                <div class="xl:space-x-1 space-x-0 xl:space-y-0 space-y-2">
                    <input type="text" placeholder="求人検索・・・" class="px-2 py-1 xl:w-auto w-full" name="keyword">
                    <button type="submit"
                        class="bg-none border text-white hover:bg-white hover:text-black px-2 py-1 xl:w-auto w-full">検索</button>
                </div>

            </form>
        </div>
        <div class="overflow-auto">
            <table class="bg-white p-8 border-collapse text-sm w-full" style="min-width: 1280px">
                <tr class="border border-black pb-4 border-t-0 border-l-0 border-r-0">
                    <td class="p-2 font-bold">ID</td>
                    <td class="p-2 font-bold" style="min-width: 500px">見出し</td>
                    <td class="p-2 font-bold">職種／雇用</td>
                    <td class="p-2 font-bold">勤務地</td>
                    <td class="p-2 font-bold">更新日時</td>
                    <td class="p-2 font-bold">公開日</td>
                    <td class="p-2 font-bold">ステータス</td>
                    <td class="p-2 font-bold">メモ</td>
                </tr>
                <?php foreach ($jobs as $job): ?>
                    <tr class="border border-black pb-4 border-t-0 border-l-0 border-r-0">
                        <td class="p-2"><a class="text-[#13b3e7] pr-2" href="/jobs/<?= $job['id'] ?>"
                                target="_blank"><?= $job['id'] ?></a></td>
                        <td class="p-2">
                            <div class="flex flex-col space-y-1">
                                <span><?= $job['title'] ?></span>
                                <ul class="flex space-x-2">
                                    <li><a class="underline" href="/admin/jobs/<?= $job['id'] ?>">編集</a></li>
                                    <li><a class="delete" class="underline"
                                            href="/admin/jobs/<?= $job['id'] ?>/delete">削除</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                        <td class="p-2"><?= $job['employment_type'] ?></td>
                        <td class="p-2"><?= $job['city'] ?></td>
                        <td class="p-2"><?= $job['updated_at'] ?></td>
                        <td class="p-2"><?= $job['created_at'] ?></td>
                        <td class="p-2"><?= $job['status'] ?></td>
                        <td class="p-2"><textarea class="p-2 border h-[75px] w-full"><?= $job['memo'] ?></textarea></td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="p-2 font-bold">ID</td>
                    <td class="p-2 font-bold">見出し</td>
                    <td class="p-2 font-bold">職種／雇用</td>
                    <td class="p-2 font-bold">勤務地</td>
                    <td class="p-2 font-bold">更新日時</td>
                    <td class="p-2 font-bold">公開日</td>
                    <td class="p-2 font-bold">ステータス</td>
                    <td class="p-2 font-bold">メモ</td>
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