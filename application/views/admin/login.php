<div class="flex flex-col py-4 xl:px-64 px-4 space-y-4 bg-slate-100 h-full">
    <div class="max-w-2xl mx-auto xl:px-12 px-4 mt-32 flex flex-col space-y-4 w-full flex-1">
        <h2 class="lg:text-xl font-bold">ログイン</h2>
        <?php if (!empty($error)): ?>
            <div class="text-red-400">
                <?= $error ?>
            </div>
        <?php endif; ?>
        <form class="flex flex-col space-y-6" method="POST" action="/admin/login">
            <div class="flex flex-col space-y-2">
                <label>ユーザー名</label>
                <input type="text" required class="p-2 border border-slate-200" value="<?= set_value('username') ?>"
                    name="username">
            </div>
            <div class="flex flex-col space-y-2">
                <label>パスワード</label>
                <input type="password" required class="p-2 border border-slate-200" name="password">
            </div>
            <button class="bg-[#13b3e7] text-white p-2 border border-slate-200">ログイン</button>
        </form>
    </div>