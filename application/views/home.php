<?php include('header.php'); ?>
    
<main>
  <section class="main_img">
    <p class="main_copy">薬剤師による、<br>
      薬剤師のための<br class="sp">転職支援<br>
      <span class="sub_copy">Career change support by <br class="sp">pharmacists for pharmacists</span></p>
  </section>
    
  <div class="registration"><a href="" target="_blank">まずは簡単登録</a></div>
    
    <section class="search">
    <ul class="tab">
        <li><a href="#list"><i class="fa-regular fa-square-check"></i>&nbsp;リストから探す</a></li>
        <li><a href="#googlemap"><i class="fa-solid fa-location-dot"></i>&nbsp;GoogleMAPから探す</a></li>
      </ul>
    <div id="list" class="area">
        <div class="search_inner">
        <ul class="main7">
            <li class="workarea">
            <button class="modal-toggle btn-example" data-modal="modal1">エリア<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="station">
            <button class="modal-toggle btn-example" data-modal="modal2">沿線・駅<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="workarea">
            <button class="modal-toggle btn-example" data-modal="modal3">職種<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="facility">
            <button class="modal-toggle btn-example" data-modal="modal4">施設・種別<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="form">
            <button class="modal-toggle btn-example" data-modal="modal5">雇用形態/給与<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="commitment">
            <button class="modal-toggle btn-example" data-modal="modal6">こだわり<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="freeword">
            <h4>フリーワード検索<span>勤務地、条件など好きな言葉で検索する</span></h4>
            <input type="text" placeholder="例：残業なし">
          </li>
            <li class="number_text">
            <p class="number">該当件数<span class="big">270</span>件</p>
          </li>
          </ul>
      </div>
        <ul class="button_area">
        <li>
            <button type="submit" class="submit">検索する <i class="fa-solid fa-magnifying-glass"></i></button>
          </li>
        <li>
            <button type="reset" class="reset">すべてクリア</button>
          </li>
      </ul>
      </div>
    <div id="googlemap" class="area">
        <div class="search_inner">
        <ul class="main7">
            <li class="workarea">
            <button class="modal-toggle btn-example" data-modal="modal1">エリア<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="station">
            <button class="modal-toggle btn-example" data-modal="modal2">沿線・駅<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="workarea">
            <button class="modal-toggle btn-example" data-modal="modal3">職種<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="facility">
            <button class="modal-toggle btn-example" data-modal="modal4">施設・種別<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="form">
            <button class="modal-toggle btn-example" data-modal="modal5">雇用形態/給与<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="commitment">
            <button class="modal-toggle btn-example" data-modal="modal6">こだわり<small>を選ぶ</small><span class="plus">+</span></button>
          </li>
            <li class="freeword">
            <h4>フリーワード検索<span>勤務地、条件など好きな言葉で検索する</span></h4>
            <input type="text" placeholder="例：残業なし">
          </li>
            <li class="number_text">
            <p class="number">該当件数<span class="big">270</span>件</p>
          </li>
          </ul>
      </div>
        <ul class="button_area">
        <li>
            <button type="submit" class="submit">検索する <i class="fa-solid fa-magnifying-glass"></i></button>
          </li>
        <li>
            <button type="reset" class="reset">すべてクリア</button>
          </li>
      </ul>
      </div>
  </section>
    
<!-- modal1 -->
<div id="modal1" class="modal">
    <div class="modal-content">
      <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
      <div class="modal_container">
        <h4>エリアを選ぶ</h4>
        <div class="region">
          <input type="radio" id="region1" name="region">
          <label for="region1">北海道・東北</label>
          <input type="radio" id="region2" name="region">
          <label for="region2">関東</label>
          <input type="radio" id="region3" name="region">
          <label for="region3">甲信越・北陸</label>
          <input type="radio" id="region4" name="region">
          <label for="region4">東海</label>
          <input type="radio" id="region5" name="region">
          <label for="region5">近畿</label>
          <input type="radio" id="region6" name="region">
          <label for="region6">中国</label>
          <input type="radio" id="region7" name="region">
          <label for="region7">四国</label>
          <input type="radio" id="region8" name="region">
          <label for="region8">九州</label>
          <input type="radio" id="region9" name="region">
          <label for="region9">沖縄</label>
        </div>
        <div class="prefectures">
          <input type="radio" id="prefectures1" name="prefectures">
          <label for="prefectures1">滋賀県</label>
          <input type="radio" id="prefectures2" name="prefectures">
          <label for="prefectures2">京都府</label>
          <input type="radio" id="prefectures3" name="prefectures">
          <label for="prefectures3">大阪府</label>
          <input type="radio" id="prefectures4" name="prefectures">
          <label for="prefectures4">兵庫県</label>
          <input type="radio" id="prefectures5" name="prefectures">
          <label for="prefectures5">奈良県</label>
          <input type="radio" id="prefectures6" name="prefectures">
          <label for="prefectures6">和歌山県</label>
        </div>
        <form class="search_inner">
          <div class="choice">
            <input type="checkbox" id="all" name="すべて" value="すべて">
            <label for="all">すべて</label>
            <input type="checkbox" id="municipalities1" name="大阪市都島区" value="大阪市都島区">
            <label for="municipalities1">大阪市都島区</label>
            <input type="checkbox" id="municipalities2" name="大阪市福島区" value="大阪市福島区">
            <label for="municipalities2">大阪市福島区</label>
            <input type="checkbox" id="municipalities3" name="大阪市此花区" value="大阪市此花区">
            <label for="municipalities3">大阪市此花区</label>
            <input type="checkbox" id="municipalities4" name="大阪市西区" value="大阪市西区">
            <label for="municipalities4">大阪市西区</label>
            <input type="checkbox" id="municipalities5" name="大阪市港区" value="大阪市港区">
            <label for="municipalities5">大阪市港区</label>
            <input type="checkbox" id="municipalities6" name="大阪市大正区" value="大阪市大正区">
            <label for="municipalities6">大阪市大正区</label>
            <input type="checkbox" id="municipalities7" name="大阪市天王寺区" value="大阪市天王寺区">
            <label for="municipalities7">大阪市天王寺区</label>
            <input type="checkbox" id="municipalities8" name="大阪市浪速区" value="大阪市浪速区">
            <label for="municipalities8">大阪市浪速区</label>
              <input type="checkbox" id="municipalities9" name="大阪市西淀川区" value="大阪市西淀川区">
            <label for="municipalities9">大阪市西淀川区</label>
              <input type="checkbox" id="municipalities10" name="大阪市東淀川区" value="大阪市東淀川区">
            <label for="municipalities10">大阪市東淀川区</label>
              <input type="checkbox" id="municipalities11" name="大阪市東成区" value="大阪市東成区">
            <label for="municipalities11">大阪市東成区</label>
              <input type="checkbox" id="municipalities12" name="大阪市生野区" value="大阪市生野区">
            <label for="municipalities12">大阪市生野区</label>
          </div>
        </form>
        <ul class="button_area">
          <li>該当件数<span class="number">270</span>件</li>
          <li>
            <button type="submit" class="submit">選択した内容を反映する</button>
          </li>
          <li>
            <button type="reset" class="reset">すべてクリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
<!-- modal1 -->

<!-- modal2 -->
<div id="modal2" class="modal">
    <div class="modal-content">
      <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
      <div class="modal_container">
        <h4>沿線・駅を選ぶ</h4>
        <div class="region">
          <input type="radio" id="region10" name="region">
          <label for="region10">北海道・東北</label>
          <input type="radio" id="region11" name="region">
          <label for="region11">関東</label>
          <input type="radio" id="region12" name="region">
          <label for="region12">甲信越・北陸</label>
          <input type="radio" id="region13" name="region">
          <label for="region13">東海</label>
          <input type="radio" id="region14" name="region">
          <label for="region14">近畿</label>
          <input type="radio" id="region15" name="region">
          <label for="region15">中国</label>
          <input type="radio" id="region16" name="region">
          <label for="region16">四国</label>
          <input type="radio" id="region17" name="region">
          <label for="region17">九州</label>
          <input type="radio" id="region18" name="region">
          <label for="region18">沖縄</label>
        </div>
        <div class="prefectures">
          <input type="radio" id="prefectures7" name="prefectures">
          <label for="prefectures7">滋賀県</label>
          <input type="radio" id="prefectures8" name="prefectures">
          <label for="prefectures8">京都府</label>
          <input type="radio" id="prefectures9" name="prefectures">
          <label for="prefectures9">大阪府</label>
          <input type="radio" id="prefectures10" name="prefectures">
          <label for="prefectures10">兵庫県</label>
          <input type="radio" id="prefectures11" name="prefectures">
          <label for="prefectures11">奈良県</label>
          <input type="radio" id="prefectures12" name="prefectures">
          <label for="prefectures12">和歌山県</label>
        </div>
        <div class="choice2">
            
          <div class="route">
            <h5>路線を選択</h5>
            <div class="choice_inner">
              <p class="choice_ttl">大阪府の路線</p>
              <ul class="scroll_inner">
                <li><a href="">東海道本線</a></li>
                <li><a href="">大阪環状線</a></li>
                <li><a href="">福知山線</a></li>
                <li><a href="">山陽本線</a></li>
                <li><a href="">阪和線</a></li>
                <li><a href="">関西本線</a></li>
                <li><a href="">片町線</a></li>
                <li><a href="">○○○○○○線</a></li>
                <li><a href="">○○○○○○線</a></li>
                <li><a href="">○○○○○○線</a></li>
              </ul>
            </div>
          </div>
            
            <div class="station">
            <h5>駅を選択</h5>
            <div class="choice_inner">
              <p class="choice_ttl">大阪環状線の駅</p>
              <ul class="scroll_inner">
                <li>
                  <input type="checkbox" id="station0001" name="station" value="大阪環状線の駅すべて">
                  <label for="station0001"><i class="fa-solid fa-circle-check"></i>大阪環状線の駅すべて</label>
                </li>
                <li>
                  <input type="checkbox" id="station0002" name="station" value="天王寺駅">
                  <label for="station0002"><i class="fa-solid fa-circle-check"></i>天王寺駅</label>
                </li>
                  <li>
                  <input type="checkbox" id="station0003" name="station" value="天王寺駅">
                  <label for="station0003"><i class="fa-solid fa-circle-check"></i>新今宮駅</label>
                </li>
                  <li>
                  <input type="checkbox" id="station0004" name="station" value="芦原橋駅">
                  <label for="station0004"><i class="fa-solid fa-circle-check"></i>芦原橋駅</label>
                </li>
                  <li>
                  <input type="checkbox" id="station0005" name="station" value="大正駅">
                  <label for="station0005"><i class="fa-solid fa-circle-check"></i>大正駅</label>
                </li>
                  <li>
                  <input type="checkbox" id="station0006" name="station" value="弁天町駅">
                  <label for="station0006"><i class="fa-solid fa-circle-check"></i>弁天町駅</label>
                </li>
                  
                  <li>
                  <input type="checkbox" id="station0007" name="station" value="○○○駅">
                  <label for="station0007"><i class="fa-solid fa-circle-check"></i>○○○駅</label>
                </li>
              </ul>
            </div>
          </div>
            
        </div>
        <ul class="button_area">
          <li>該当件数<span class="number">270</span>件</li>
          <li>
            <button type="submit" class="submit">選択した内容を反映する</button>
          </li>
          <li>
            <button type="reset" class="reset">すべてクリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
<!-- modal2 -->
    
    
    
<!-- modal3 -->
<div id="modal3" class="modal">
    <div class="modal-content">
      <div class="modal-top"> <span class="modal-close">×</span> </div>
      <div class="modal_container">
        <h4>職種を選ぶ</h4>
        <form class="search_inner">
          <div class="choice">
              <input type="checkbox" id="occupation1" name="薬剤師" value="薬剤師">
              <label for="occupation1">薬剤師</label>
              <input type="checkbox" id="occupation2" name="看護師" value="看護師">
              <label for="occupation2">看護師</label>
              <input type="checkbox" id="occupation3" name="獣医師" value="獣医師">
              <label for="occupation3">獣医師</label>
              <input type="checkbox" id="occupation4" name="事務（病院、薬局）" value="事務（病院、薬局）">
              <label for="occupation4">事務（病院、薬局）</label>
              <input type="checkbox" id="occupation5" name="作業療法士・理学療法士・言語聴覚士" value="作業療法士・理学療法士・言語聴覚士">
              <label for="occupation5">作業療法士・<br>理学療法士・<br>言語聴覚士</label>
              <input type="checkbox" id="occupation6" name="その他" value="その他">
              <label for="occupation6">その他</label>
          </div>
        </form>
        <ul class="button_area">
          <li>該当件数<span class="number">270</span>件</li>
          <li>
            <button type="submit" class="submit">選択した内容を反映する</button>
          </li>
          <li>
            <button type="reset" class="reset">すべてクリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
<!-- modal3 -->

<!-- modal4 -->
<div id="modal4" class="modal">
    <div class="modal-content">
      <div class="modal-top"> <span class="modal-close">×</span> </div>
      <div class="modal_container">
        <h4>施設・種別を選ぶ</h4>
        <form class="search_inner">
          <div class="choice">
              <input type="checkbox" id="facility1" name="調剤薬局"  value="調剤薬局">
              <label for="facility1">調剤薬局</label>
              <input type="checkbox" id="facility2" name="病院"  value="病院">
              <label for="facility2">病院</label>
              <input type="checkbox" id="facility3" name="クリニック"  value="クリニック">
              <label for="facility3">クリニック</label>
              <input type="checkbox" id="facility4" name="企業"  value="企業">
              <label for="facility4">企業</label>
              <input type="checkbox" id="facility5" name="ドラッグストア"  value="ドラッグストア">
              <label for="facility5">ドラッグストア</label>
              <input type="checkbox" id="facility6" name="福祉施設"  value="福祉施設">
              <label for="facility6">福祉施設</label>
              <input type="checkbox" id="facility7" name="その他"  value="その他">
              <label for="facility7">その他</label>
          </div>
        </form>
        <ul class="button_area">
          <li>該当件数<span class="number">270</span>件</li>
          <li>
            <button type="submit" class="submit">選択した内容を反映する</button>
          </li>
          <li>
            <button type="reset" class="reset">すべてクリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
<!-- modal4 -->
    
<!-- modal5 -->
<div id="modal5" class="modal">
    <div class="modal-content">
      <div class="modal-top"> <span class="modal-close"><i class="fa-solid fa-xmark"></i></span> </div>
      <div class="modal_container">
          <h4>雇用形態 / 給与を選ぶ</h4>
          <form class="search_inner">
            <h5>雇用形態</h5>
            <div class="choice">
                <input type="checkbox" id="status1" name="正社員" value="正社員">
                <label for="status1">正社員</label>
                <input type="checkbox" id="status2" name="契約社員" value="契約社員">
                <label for="status2">契約社員</label>
                <input type="checkbox" id="status3" name="出向社員" value="出向社員">
                <label for="status3">出向社員</label>
                <input type="checkbox" id="status4" name="パート・アルバイト" value="パート・アルバイト">
                <label for="status4">パート・アルバイト</label>
                <input type="checkbox" id="status5" name="派遣" value="派遣">
                <label for="status5">派遣</label>
                <input type="checkbox" id="status6" name="紹介予定派遣" value="紹介予定派遣">
                <label for="status6">紹介予定派遣</label>
            </div>
            <h5>給与</h5>
            <ul class="salary">
              <li>月給
                <select name="salary">
                  <option value="salary1">指定なし</option>
                  <option value="salary2">20</option>
                  <option value="salary3">30</option>
                  <option value="salary4">50</option>
                  <option value="salary5">100</option>
                </select>
                万円以上 </li>
              <li>時給
                <select name="hourly">
                  <option value="hourly1">指定なし</option>
                  <option value="hourly2">1000</option>
                  <option value="hourly3">1200</option>
                  <option value="hourly4">1500</option>
                  <option value="hourly5">2000</option>
                  <option value="hourly6">3000</option>
                </select>
                円以上 </li>
            </ul>
          </form>
          <ul class="button_area">
            <li>該当件数<span class="number">270</span>件</li>
            <li>
              <button type="submit" class="submit">選択した内容を反映する</button>
            </li>
            <li>
              <button type="reset" class="reset">すべてクリア</button>
            </li>
          </ul>
      </div>
    </div>
  </div>
<!-- modal5 -->
    
    
    
    
<!-- modal6 -->
<div id="modal6" class="modal">
    <div class="modal-content">
      <div class="modal-top"> <span class="modal-close">×</span> </div>
      <div class="modal_container">
        <h4>こだわりを選ぶ</h4>
        <form class="search_inner">
          <div class="choice">
              <input type="checkbox" id="commitment1" name="高収入" value="高収入">
              <label for="commitment1">高収入</label>
              <input type="checkbox" id="commitment2" name="土日休み" value="土日休み">
              <label for="commitment2">土日休み</label>
              <input type="checkbox" id="commitment3" name="～18時の職場" value="～18時の職場">
              <label for="commitment3">～18時の職場</label>
              <input type="checkbox" id="commitment4" name="～19時の職場" value="～19時の職場">
              <label for="commitment4">～19時の職場</label>
              <input type="checkbox" id="commitment5" name="駅近" value="駅近">
              <label for="commitment5">駅近</label>
              <input type="checkbox" id="commitment6" name="住居付き" value="住居付き">
              <label for="commitment6">住居付き</label>
          </div>
        </form>
        <ul class="button_area">
          <li>該当件数<span class="number">270</span>件</li>
          <li>
            <button type="submit" class="submit">選択した内容を反映する</button>
          </li>
          <li>
            <button type="reset" class="reset">すべてクリア</button>
          </li>
        </ul>
      </div>
    </div>
  </div>
<!-- modal6 -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
  <section class="recruitment">
    <h2><span>求人情報</span>Recruitment</h2>
    <h3>新着求人情報</h3>
    <div class="recruitment_slider_wrap">
      <div class="recruitment_slider">
        <div class="slide_item"> <img src="assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
        <div class="slide_item"> <img src="assets/img/rec_img1.png">
          <div class="category"><span>正社員</span><span>調剤薬局</span></div>
          <dl>
            <dt>20代・30代積極採用の薬剤師求人</dt>
            <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
            <dd><span class="attribute">給料</span>【時給】1,400円</dd>
          </dl>
        </div>
      </div>
    </div>
  </section>
    
    
    
    
    
  <section class="picup">
    <div class="picup_wrap">
      <h3>PICK UP 求人特集</h3>
      <ul class="tab">
        <li><a href="#directly">直接雇用</a></li>
        <li><a href="#temporary">出向・派遣</a></li>
      </ul>
      <div id="directly" class="area">
        <div class="temporary_slider_wrap">
          <div class="temporary_slider">
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
          </div>
        </div>
      </div>
      
        
      <div id="temporary" class="area">
        <div class="temporary_slider_wrap">
          <div class="temporary_slider">
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
            <div class="slide_item"> <img src="assets/img/rec_img1.png">
              <div class="category"><span>出向社員</span><span>調剤薬局</span></div>
              <dl>
                <dt>20代・30代積極採用の薬剤師求人</dt>
                <dd><span class="attribute">勤務地</span>東京都千代田区</dd>
                <dd><span class="attribute">給料</span>【時給】1,400円</dd>
              </dl>
            </div>
          </div>
        </div>
        <!--/area--></div>
        <div class="arrows_area">
        <div class="arrows"></div>
      </div>
    </div>
      
      
  </section>
    
    
    
    
    
    
  <section class="aboutus">
    <div class="aboutus_back">
      <div class="aboutus_inner">
        <div class="text">
          <h2><span>事業紹介</span> About Us</h2>
          <p class="lead">企業が本当に必要とする人材<br>
            <span>×</span><br>
            求職者が力を発揮できる会社</p>
          <p>表向きの諸条件から発生するマッチングではなく、<br>
            「企業様の理念やビジョン」<br class="sp">「求職者様の人生観や価値観」から<br>
            生まれる本質的なフィッティングの実現を目的とし、<br>
            双方を深く理解した上でご提案を行っています。</p>
          
        </div>
        <img src="assets/img/aboutus_figure.png" alt="事業構成チャート" width="527" height="518">
          <div><a href="">就業までの流れ</a></div>
      </div>
        
    </div>
  </section>
  <section class="instagram">
    <div class="instagram_inner">
      <div class="text">
        <h2><span>アイリードを見る</span> Instagram</h2>
        <a href="https://www.instagram.com/ilead.company/" class="pc">VIEW MORE</a>
      </div>
      <div class="insta_list"><img src="assets/img/insta_img.png" alt="インスタ画像" width="638" height="418"></div>
        <a href="https://www.instagram.com/ilead.company/" class="sp">VIEW MORE</a>
    </div>
  </section>
  <section class="news">
    <div class="news_inner">
      <div class="text">
        <h2><span>お知らせ</span> News</h2>
        <a href="news_list.php" class="arrow"></a>
      </div>
      <ul class="news_area">
        <a href="">
        <li><span class="day">2023.12.11</span><span class="title">年末年始の営業について</span></li>
        </a> <a href="">
        <li><span class="day">2023.10.02</span><span class="title">【メディア掲載】「Alevel－エラベル－（上位８％の関西優良企業）」にて、ヒュー…</span></li>
        </a> <a href="">
        <li><span class="day">2023.10.02</span><span class="title">【メディア掲載】バーチャルオフィスツール「oVice」にて「ヒューマンステージ」…</span></li>
        </a> <a href="">
        <li><span class="day">2023.10.02</span><span class="title">【メディア掲載】バーチャルオフィスツール「oVice」にて「ヒューマンステージ」…</span></li>
        </a>
      </ul>
    </div>
  </section>
</main>
    
    
<?php include('footer.php'); ?>