//slickslider
$('.mv_slider').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  autoplay:true,
  autoplaySpeed:3000,
  swipe: true,
  pauseOnHover: false,

  responsive: [{
    breakpoint: 768,
    settings: {
      slidesToShow: 1,
      arrows: false,
    },
  }, ],
});

$('.recruitment_slider').slick({
  dots: true,
  //variableWidth: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  arrows: true,
  autoplay:true,
  autoplaySpeed:3000,
  //centerMode: true,
  swipe: true,
  pauseOnHover: false,

  responsive: [{
    breakpoint: 768,
    settings: {
      slidesToShow: 1,
      arrows: true,
      appendArrows: $('.arrows3'),
      prevArrow: '<div class="slide-arrow prev-arrow"></div>',
      nextArrow: '<div class="slide-arrow next-arrow"></div>',
      dots: false,
    },
  }, ],
});

$('.temporary_slider').slick({
  dots: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay:true,
  autoplaySpeed:3000,
  arrows: true,
  swipe: true,
  pauseOnHover: false,
  appendArrows: $('.arrows'),
  prevArrow: '<div class="slide-arrow prev-arrow"></div>',
  nextArrow: '<div class="slide-arrow next-arrow"></div>',
  appendDots: $('.dots'),

  responsive: [{
    breakpoint: 768,
    settings: {
      arrows: true,
      dots: false,
      slidesToShow: 1,
    },
  }, ],
});

$('.temporary_slider2').slick({
  dots: true,
  slidesToShow: 4,
  slidesToScroll: 1,
  autoplay:true,
  autoplaySpeed:3000,
  arrows: true,
  swipe: true,
  pauseOnHover: false,
  appendArrows: $('.arrows2'),
  prevArrow: '<div class="slide-arrow prev-arrow"></div>',
  nextArrow: '<div class="slide-arrow next-arrow"></div>',
  appendDots: $('.dots2'),

  responsive: [{
    breakpoint: 768,
    settings: {
      arrows: true,
      dots: false,
      slidesToShow: 1,
    },
  }, ],
});


//タブ
function GethashID(hashIDName) {
  if (hashIDName) {

    // // フォーム遷移先
    // var form_action = hashIDName == '#googlemap' ? '/map' : '/job_list';

    // $('.modal_form').each(function() {

    //   var params = new URLSearchParams($(this).attr('action').split('?')[1]);

    //   var s = params.get('s');

    //   $(this).attr('action', form_action);
    // });

    //タブ設定
    $('.search .tab li').find('a').each(function () { //タブ内のaタグ全てを取得
      var idName = $(this).attr('href'); //タブ内のaタグのリンク名（例）#directly 
      if (idName == hashIDName) { //リンク元の指定されたURLのハッシュタグ（例）http://example.com/#directly←この#の値とタブ内のリンク名（例）#directlyが同じかをチェック
        var parentElm = $(this).parent(); //タブ内のaタグの親要素（li）を取得
        $('.search .tab li').removeClass("active"); //タブ内のliについているactiveクラスを取り除き
        $(parentElm).addClass("active"); //リンク元の指定されたURLのハッシュタグとタブ内のリンク名が同じであれば、liにactiveクラスを追加
        //表示させるエリア設定
        $(".area").removeClass("is-active"); //もともとついているis-activeクラスを取り除き
        setTimeout(function () {
          $('.area').addClass("is-active"); //表示させたいエリアのタブリンク名をクリックしたら、表示エリアにis-activeクラスを追加 
        }, 1);
        // $(hashIDName).addClass("is-active"); //表示させたいエリアのタブリンク名をクリックしたら、表示エリアにis-activeクラスを追加 
      }

      if (hashIDName == '#list') {
        $('form').attr('action', '/job_list')
        $('.map-disclaimer').removeClass('flex').addClass('hide')
        $('input[name="employment_types[]"]').attr('type', 'checkbox')
        $('input[name="job_types[]"]').attr('type', 'checkbox')
      } else {
        $('.map-disclaimer').removeClass('hide').addClass('flex')
        $('form').attr('action', '/map');
        $('input[name="employment_types[]"]').attr('type', 'radio')
        $('input[name="job_types[]"]').attr('type', 'radio')
      }
    });

    $('.picup .tab li').find('a').each(function () { //タブ内のaタグ全てを取得
      var idName = $(this).attr('href'); //タブ内のaタグのリンク名（例）#directly 
      if (idName == hashIDName) { //リンク元の指定されたURLのハッシュタグ（例）http://example.com/#directly←この#の値とタブ内のリンク名（例）#directlyが同じかをチェック
        var parentElm = $(this).parent(); //タブ内のaタグの親要素（li）を取得
        $('.picup .tab li').removeClass("active"); //タブ内のliについているactiveクラスを取り除き
        $(parentElm).addClass("active"); //リンク元の指定されたURLのハッシュタグとタブ内のリンク名が同じであれば、liにactiveクラスを追加
        //表示させるエリア設定
        $(".area2").removeClass("is-active"); //もともとついているis-activeクラスを取り除き
        setTimeout(function () {
          $(hashIDName).addClass("is-active"); //表示させたいエリアのタブリンク名をクリックしたら、表示エリアにis-activeクラスを追加 ).addClass("is-active"); //表示させたいエリアのタブリンク名をクリックしたら、表示エリアにis-activeクラスを追加 
          $(hashIDName).find('.temporary_slider').slick('setPosition');
          $(hashIDName).find('.temporary_slider2').slick('setPosition');
        }, 1);
      }
    });
  }
}

//タブをクリックしたら
$('.tab a').on('click', function () {
  var idName = $(this).attr('href'); //タブ内のリンク名を取得  
  GethashID(idName); //設定したタブの読み込みと
  return false; //aタグを無効にする
});

// 上記の動きをページが読み込まれたらすぐに動かす
$(window).on('load', function () {
  // $('.tab li:first-of-type').addClass("active"); //最初のliにactiveクラスを追加
  // $('.area:first-of-type').addClass("is-active"); //最初の.areaにis-activeクラスを追加
  var hashName = location.hash; //リンク元の指定されたURLのハッシュタグを取得
  GethashID(hashName); //設定したタブの読み込み
});


//生年月日入力フォーム▼
let userBirthdayYear = document.querySelector('.birthday-year');
let userBirthdayMonth = document.querySelector('.birthday-month');
let userBirthdayDay = document.querySelector('.birthday-day');

function createOptionForElements(elem, val) {
  let option = document.createElement('option');
  option.text = val;
  option.value = val;
  elem.appendChild(option);
}

//年の生成
for (let i = 1940; i <= 2030; i++) {
  // createOptionForElements(userBirthdayYear, i);
}
//月の生成
for (let i = 1; i <= 12; i++) {
  // createOptionForElements(userBirthdayMonth, i);
}
//日の生成
for (let i = 1; i <= 31; i++) {
  // createOptionForElements(userBirthdayDay, i);
}

/**
 * 日付を変更する関数
 */
function changeTheDay() {
  //日付の要素を削除
  userBirthdayDay.innerHTML = '';

  //選択された年月の最終日を計算
  let lastDayOfTheMonth = new Date(userBirthdayYear.value, userBirthdayMonth.value, 0).getDate();

  //選択された年月の日付を生成
  for (let i = 1; i <= lastDayOfTheMonth; i++) {
    createOptionForElements(userBirthdayDay, i);
  }
}

// userBirthdayYear.addEventListener('change', function () {
//   changeTheDay();
// });

// userBirthdayMonth.addEventListener('change', function () {
//   changeTheDay();
// });


//年齢
// var selectElement = document.getElementById("age");
// for (var i = 18; i <= 80; i++) {
//   var optionElement = document.createElement("option");
//   optionElement.value = i;
//   optionElement.text = i + "歳";
//   selectElement.appendChild(optionElement);
// }

//ポップアップ
// const clickBtn = document.getElementById('click-btn');
// const popupWrapper = document.getElementById('popup-wrapper');
// const close = document.getElementById('close');

// // ボタンをクリックしたときにポップアップを表示させる
// clickBtn.addEventListener('click', () => {
//   popupWrapper.style.display = "block";
// });

// // ポップアップの外側又は「x」のマークをクリックしたときポップアップを閉じる
// popupWrapper.addEventListener('click', e => {
//   if (e.target.id === popupWrapper.id || e.target.id === close.id) {
//     popupWrapper.style.display = 'none';
//   }
// });