<!doctype html>
<html lang="ja" class="no-js">

<head>
    <meta name="robots" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>アイリード</title>
    <link rel="icon" href="/assets/img/favicon.ico">
    <link rel="stylesheet" href="/assets/css/admin.css">

    <!--Noto Sans Japanese-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100..900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>

<body>
    <nav class="text-white">
        <div class="flex justify-between py-3 lg:px-48 px-4 items-center">
            <div class="flex lg:space-x-48 space-x-5 items-center">
                <h1 class="lg:text-lg text-sm font-bold">アイリード株式会社</h1>
                <?php if (!empty($_SESSION['logged_in'])): ?>
                    <ul class="flex whitespace-nowrap lg:space-x-16 space-x-4 lg:text-base text-sm">
                        <li><a href="#" class="<?= $_SERVER['REQUEST_URI'] == '/admin' ? 'font-bold' : '' ?>">ホーム</a></li>
                        <li><a href="#" class="<?= $_SERVER['REQUEST_URI'] == '/admin/entries' ? 'font-bold' : '' ?>">応募</a></li>
                        <li><a href="#" class="<?= $_SERVER['REQUEST_URI'] == '/admin/jobs' ? 'font-bold' : '' ?>">求人</a></li>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if (!empty($_SESSION['logged_in'])): ?>
                <div>
                    <ul class="lg:text-base text-sm nav-settings">
                        <li class="flex items-center cursor-pointer relative p-2">
                            <i class="fas fa-cog pr-2"></i>
                            <div class="hidden lg:block">
                                設定
                            </div>
                            <i class="fa-solid fa-arrow-down pl-2 text-xs"></i>
                            <ul class="absolute cursor-pointer bg-white border text-black p-1 whitespace-nowrap hidden nav-settings-child"
                                style="top: 43px; left: -40px">
                                <li class="px-4 py-1 hover:bg-slate-200">
                                    <a href="/admin/logout">ログアウト</a>
                                </li>
                            </ul>
                    </ul>
                    <script>
                        $('.nav-settings').click(function () {
                            $('.nav-settings-child').show();
                        });

                        $(document).mouseup(function (e) {

                            var container = $('.nav-settings');

                            if (!container.is(e.target) && container.has(e.target).length === 0) {
                                $('.nav-settings-child').hide();
                            }
                        });
                    </script>
                </div>
            <?php endif; ?>
        </div>


    </nav>