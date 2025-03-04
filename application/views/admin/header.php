<!doctype html>
<html lang="ja" class="no-js">

<head>
    <meta name="robots" content="noindex">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>アイリード</title>
    <link rel="icon" href="/public/assets/img/favicon.ico">
    <link rel="stylesheet" href="/public/assets/css/admin.css">

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
    <!-- <link rel="stylesheet" href="/public/assets/css/output.css"> -->

    <!-- Quill CSS -->
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.0-rc.5/dist/quill.snow.css" rel="stylesheet" />

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- JQuery UI -->
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.min.js"></script>
</head>

<body>
    <nav class="text-white fixed w-full z-50">
        <div class="max-w-screen-2xl mx-auto flex justify-between xl:py-4 xl:px-4 py-2 px-2 items-center">
            <div class="m-auto xl:m-0 lg:m-0 md:m-0 sm:m-0 flex xl:flex-row lg:flex-row md:flex-row sm:flex-row flex-col xl:space-x-48 space-x-5 xl:space-y-0 lg:space-y-0 md:space-y-0 sm:space-y-0 space-y-2 items-center">
                <h1 class="xl:text-lg text-sm font-bold">アイリード株式会社</h1>
                <?php if (!empty($_SESSION['logged_in'])): ?>
                    <ul class="flex whitespace-nowrap xl:space-x-4 space-x-4 xl:text-base text-sm">
                        <li>
                            <div class="space-x-1">
                                <i class="fas fa-home"></i>
                                <a href="/admin/jobs">ホーム</a>
                            </div>
                        </li>
                        <li class="relative nav-jobs z-20">
                            <div class="space-x-1 cursor-pointer">
                                <i class="fas fa-list-alt"></i>
                                <span>
                                    求人
                                </span>
                            </div>
                            <ul
                                class="absolute cursor-pointer bg-white border text-black p-1 whitespace-nowrap hidden nav-jobs-child top-10 xl:ml-[-10px] ml-[-25px]">
                                <li class="px-4 py-1 hover:bg-slate-200">
                                    <a href="/admin/jobs">求人一覧</a>
                                </li>
                                <li class="px-4 py-1 hover:bg-slate-200">
                                    <a href="/admin/jobs/new">新規求人</a>
                                </li>
                            </ul>
                        </li>
                        <li class="relative nav-news z-20">
                            <div class="space-x-1 cursor-pointer">
                                <i class="fas fa-newspaper"></i>
                                <span>
                                    ニュース
                                </span>
                            </div>
                            <ul
                                class="absolute cursor-pointer bg-white border text-black p-1 whitespace-nowrap hidden nav-news-child top-10 xl:ml-[-10px] ml-[-25px]">
                                <li class="px-4 py-1 hover:bg-slate-200">
                                    <a href="/admin/news">ニュース一覧</a>
                                </li>
                                <li class="px-4 py-1 hover:bg-slate-200">
                                    <a href="/admin/news/new">新規ニュース</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                <?php endif; ?>
            </div>

            <?php if (!empty($_SESSION['logged_in'])): ?>
                <div>
                    <ul class="xl:text-base text-sm">
                        <li class="flex items-center cursor-pointer relative nav-settings z-20">
                            <i class="fas fa-cog xl:pr-2"></i>
                            <div class="hidden xl:block">
                                設定
                            </div>
                            <i class="fa-solid fa-arrow-down pl-2 text-xs"></i>
                            <ul
                                class="absolute cursor-pointer bg-white border text-black p-1 whitespace-nowrap hidden nav-settings-child top-10 xl:ml-[-45px] ml-[-90px] z-10">
                                <li class="px-4 py-1 hover:bg-slate-200">
                                    <i class="fas fa-sign-out"></i>
                                    <a href="/admin/logout">ログアウト</a>
                                </li>
                            </ul>
                        </li>
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

                        $('.nav-jobs').click(function () {
                            $('.nav-jobs-child').show();
                        });

                        $('.nav-news').click(function () {
                            $('.nav-news-child').show();
                        });

                        $(document).mouseup(function (e) {

                            var container = $('.nav-jobs');
                            var container2 = $('.nav-news');

                            if (!container.is(e.target) && container.has(e.target).length === 0) {
                                $('.nav-jobs-child').hide();
                            }

                            if (!container2.is(e.target) && container2.has(e.target).length === 0) {
                                $('.nav-news-child').hide();
                            }
                        });
                    </script>
                </div>
            <?php endif; ?>
        </div>
    </nav>