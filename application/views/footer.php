<!--footer-->
<footer>
  <div class="button_area">
    <a href="https://ilead-hr.co.jp/company" target="_blank" class="company">
      <p>会社概要<br>
        <span class="big">Company</span>
      </p>
    </a>
    <a href="https://ilead-hr.co.jp/contact" target="_blank" class="contact">
      <p>お問い合わせ<br>
        <span class="big">Contact</span>
      </p>
    </a>
  </div>
  <div class="footer_area">
    <div class="logo"> <a href="./"> <img src="/assets/img/logo.svg" alt="アイリード" width="176" height="35"> </a> </div>
    <p><span class="company_name">アイリード株式会社</span><br>
      〒541-0056大阪府大阪市中央区久太郎町2-5-28 久太郎町恒和ビル4F</p>
  </div>
</footer>
<!--footer-->

<script src="assets/js/slick.min.js"></script>
<script src="assets/js/main.js?v=<?= date('YmdHis') ?>"></script>

<script>
  //検索モーダル
  const modalBtns = document.querySelectorAll(".modal-toggle");
  modalBtns.forEach(function (btn) {
    btn.onclick = function () {
      var modal = btn.getAttribute('data-modal');
      document.getElementById(modal).style.display = "block";
    };
  });
  const closeBtns = document.querySelectorAll(".modal-close");
  closeBtns.forEach(function (btn) {
    btn.onclick = function () {
      var modal = btn.closest('.modal');
      modal.style.display = "none";
    };
  });

  window.onclick = function (event) {
    if (event.target.className === "modal") {
      event.target.style.display = "none";
    }
  }

  function set_pluses() {
    $('input[name="areas[]"]:checked').length ? $('.areas .plus').addClass('active') : $('.areas .plus').removeClass('active');
    $('input[name="stations[]"]:checked').length ? $('.stations .plus').addClass('active') : $('.stations .plus').removeClass('active');
    $('input[name="categories[]"]:checked').length ? $('.categories .plus').addClass('active') : $('.categories .plus').removeClass('active');
    $('input[name="job_types[]"]:checked').length ? $('.job_types .plus').addClass('active') : $('.job_types .plus').removeClass('active');
    $('input[name="employment_types[]"]:checked').length || $('select[name="salary[yearly]"]').val() || $('select[name="salary[hourly]"]').val() ? $('.employment_types .plus').addClass('active') : $('.employment_types .plus').removeClass('active');
    $('input[name="traits[]"]:checked').length ? $('.traits .plus').addClass('active') : $('.traits .plus').removeClass('active');
  }
</script>

<script>
  //マップページ横メニュー
  $('.menu-trigger').on('click', function () {

    var img = $(this).children('span').children('img');

    if ($(this).hasClass('active')) {
      $(this).removeClass('active');
      $('.list').removeClass('open');
      $('.overlay').removeClass('open');
      img.attr('src', 'assets/img/map_arrow_close.png');
    } else {
      $(this).addClass('active');
      $('.list').addClass('open');
      $('.overlay').addClass('open');
      img.attr('src', 'assets/img/map_arrow_open.png');
    }
  });
</script>
</body>

</html>