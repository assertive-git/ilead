<div class="py-4 lg:px-48 px-4 space-y-4 bg-slate-100">
    <h2 class="text-xl">求人を登録</h2>
    <div class="flex flex-col lg:flex-row lg:space-x-8 lg:space-y-0 space-y-8 text-sm">
        <div class="flex flex-col space-y-4 left flex-1">
            <div class="bg-white px-4 py-4 rounded-lg shadow flex space-x-2 items-center">
                <i class="fa fa-building text-[#13b3e7]"></i>
                <span class="font-bold">求人URL:</span>
                <a class="underline" href="#">https://ilead.com/job/0000</a>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">業務内容 *</span>
                <input required type="text" class="p-2 border border-slate-200 w-full">
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">求人見出し *</span>
                <input required type="text" class="p-2 border border-slate-200">
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">求人内容 *</span>
                <textarea type="text" class="p-2 border border-slate-200 h-[300px]"></textarea>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">追加メールアドレス</span>
                <input type="text" class="p-2 border border-slate-200">
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">会社名または店舗名 *</span>
                <input required type="text" class="p-2 border border-slate-200">
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">雇用形態 *</span>

                <div class="bg-white p-2 border border-slate-200">
                    <label class="flex space-x-1">
                        <input required type="radio" name="employment_type" value="1"><span>正社員</span>
                    </label>
                    <label class="flex space-x-1">
                        <input type="radio" name="employment_type" value="2"><span>契約社員</span>
                    </label>
                    <label class="flex space-x-1">
                        <input type="radio" name="employment_type" value="3"><span>パート</span>
                    </label>
                    <label class="flex space-x-1">
                        <input type="radio" name="employment_type" value="4"><span>派遣</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">給与形態 *</span>

                <div class="bg-white p-2 border border-slate-200">
                    <label class="flex space-x-1">
                        <input required type="radio" name="employment_type" value="1"><span>正社員</span>
                    </label>
                    <label class="flex space-x-1">
                        <input type="radio" name="employment_type" value="2"><span>契約社員</span>
                    </label>
                    <label class="flex space-x-1">
                        <input type="radio" name="employment_type" value="3"><span>パート</span>
                    </label>
                    <label class="flex space-x-1">
                        <input type="radio" name="employment_type" value="4"><span>派遣</span>
                    </label>
                </div>
            </div>

            <div class="flex flex-col space-y-2">

                <div class="flex flex-wrap space-x-2 items-center">
                    <div class="flex flex-col space-y-1">
                        <br />
                        <span>￥</span>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <span class="font-bold">最低給与 *</span>
                        <input class="p-2" type="text" name="min_salary">
                    </div>

                    <div class="flex flex-col space-y-1">
                        <br />
                        <span>～</span>
                    </div>

                    <div class="flex flex-col space-y-1">
                        <span class="font-bold">最高給与</span>
                        <input class="p-2" type="text" name="max_salary">
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <div>
                    <span class="font-bold">職種 *</span>
                </div>
                <div>
                    <select name="job_type" class="border border-slate-200 p-1">
                        <option value="1">薬剤師</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">施設・種別 *</span>
                <div class="flex">
                    <div class="border border-slate-200 rounded p-4 bg-white">
                        <div class="flex flex-col space-y-2">
                            <label class="flex space-x-1 items-center">
                                <input type="checkbox">
                                <span>調剤薬局</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input type="checkbox">
                                <span>ドラッグストア （調剤併設）</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input type="checkbox">
                                <span>病院</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input type="checkbox">
                                <span>企業</span>
                            </label>
                            <label class="flex space-x-1 items-center">
                                <input type="checkbox">
                                <span>その他</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">住所 *</span>
                <div class="flex space-x-2">
                    <select name="a_region">
                        <option value="1">近畿</option>
                    </select>
                    <select name="a_pref">
                        <option value="1">大阪府</option>
                    </select>
                    <select name="city">
                        <option value="1">大阪市</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">番地・ビル名 *</span>
                <input class="p-2" type="text" name="address">
            </div>

            <!-- <div class="flex flex-col space-y-2">
                <span class="font-bold">最寄り駅 *</span>
                <div class="inline-flex flex-col space-x-2 lg:space-y-0 space-y-2 flex-wrap">
                    <div class="flex">
                        
                    </div>
                    <div>
                        <button id="closest_station_register" class="bg-slate-200 p-2">新規最寄り駅登録</button>
                    </div>

                </div>
            </div> -->

            <div class="space-y-2">
                <span class="font-bold">最寄り駅 *</span>
                <div class="flex space-x-2">
                    <select name="s_region">
                        <option value="1">近畿</option>
                    </select>
                    <select name="s_pref">
                        <option value="1">大阪府</option>
                    </select>
                    <select name="line">
                        <option value="">路線を選択する</option>
                    </select>
                    <select name="station">
                        <option value="">駅を選択する</option>
                    </select>
                    <div class="flex space-x-1">
                        <label>徒歩</label>
                        <select name="walking_distance">
                            <option value="">選択する</option>
                        </select>
                    </div>
                </div>
            </div>




            <div class="flex flex-col space-y-2">
                <span class="font-bold">必要資格 *</span>
                <div class="flex">
                    <div class="bg-white p-2 border border-slate-200 px-3">
                        <label class="flex space-x-1">
                            <input required type="radio" name="need_requirement" value="1"><span>あり</span>
                        </label>
                        <label class="flex space-x-1">
                            <input type="radio" name="need_requirement" value="2"><span>なし</span>
                        </label>
                    </div>
                </div>
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">マップ情報</span>
                <span class="font-bold">GoogleマップURL</span>
                <input type="text" class="p-2 border border-slate-200">
            </div>

            <div class="flex flex-col space-y-2">
                <span class="font-bold">住所、駅名、施設名、ランドマーク *</span>
                <input type="text" class="p-2 border border-slate-200">
                <button class="inline-block bg-slate-400 p-1 text-white">この住所のマップを表示する（ジオコーディング）</button>
            </div>
        </div>

        <div class="right flex-1 flex flex-col space-y-4">
            <div class="flex flex-col space-y-4 border border-slate-200 rounded p-4 bg-white">
                <div
                    class="flex justify-between pb-4 border border-b-1 border-t-0 border-l-0 border-r-0 border-slate-200">
                    <span class="font-bold">公開</span>
                    <button class="border border-slate-200 p-2 flex space-x-1 items-center rounded text-sm">
                        <i class="fa fa-eye text-[#13b3e7]"></i><span>プレビュー</span>
                    </button>
                </div>
                <div class="flex flex-col space-y-2 text-sm">
                    <div class="flex space-x-1 items-center">
                        <span>公開状態：</span>
                        <select name="status" class="border border-slate-200">
                            <option value="0">公開</option>
                            <option value="1">非公開</option>
                            <option value="2">下書き</option>
                        </select>
                    </div>
                    <div class="flex space-x-1 items-center">
                        <span>更新日時：</span>
                        <span>0000-00-00 00:00:00</span>
                    </div>
                    <div class="flex space-x-1 items-center justify-between pt-8">
                        <button class="text-red-600 flex space-x-1 items-center">
                            <i class="fa fa-trash text-slate-600"></i>
                            <span>削除</span>
                        </button>
                        <button
                            class="text-[#13b3e7] border border-[#13b3e7] text-[#13b3e7] hover:border-white hover:text-white hover:bg-[#13b3e7] px-8 py-2">更新</button>
                    </div>
                </div>
            </div>

            <div class="border border-slate-200 rounded p-4 bg-white flex flex-col space-y-4">
                <div class="pb-4 border border-b-1 border-t-0 border-l-0 border-r-0 border-slate-200">
                    <span class="font-bold">トップ画像</span>
                </div>
                <div class="flex flex-col space-y-2 text-sm">
                    <img src="https://saiyo-connect.jp/uploads/accounts/ilead/storage/616f869cd0af9.jpg" alt="Image">
                    <button class="bg-slate-600 text-white px-10 py-2">トップ画像を選択</button>
                </div>
            </div>

            <div class="border border-slate-200 rounded p-4 bg-white flex flex-col space-y-4">
                <div class="pb-4 border border-b-1 border-t-0 border-l-0 border-r-0 border-slate-200">
                    <span class="font-bold">こだわり</span>
                </div>
                <div class="flex flex-col space-y-2 text-sm">
                    <label class="flex space-x-1 items-center">
                        <input type="checkbox">
                        <span>高収入</span>
                    </label>
                    <label class="flex space-x-1 items-center">
                        <input type="checkbox">
                        <span>土日のみ</span>
                    </label>
                    <label class="flex space-x-1 items-center">
                        <input type="checkbox">
                        <span>～１８時の職場</span>
                    </label>
                    <label class="flex space-x-1 items-center">
                        <input type="checkbox">
                        <span>～１９時の職場</span>
                    </label>
                    <label class="flex space-x-1 items-center">
                        <input type="checkbox">
                        <span>駅チカ</span>
                    </label>
                    <label class="flex space-x-1 items-center">
                        <input type="checkbox">
                        <span>住居付き</span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>