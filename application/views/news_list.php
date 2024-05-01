<?php include ('header.php'); ?>

<main id="news_list">

  <section class="news">
    <div class="news_inner">
      <div class="text">
        <h2><span>お知らせ</span> News</h2>
      </div>
      <ul class="news_area">
        <?php foreach ($news as $article): ?>
          <a href="/news/<?= $article['id'] ?>">
            <li><span class="day"><?= substr(str_replace('-', '.', $article['created_at']), 0, 11) ?></span><span
                class="title"><?= $article['title'] ?></span></li>
          </a>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="pagination">
      <button class="arrow_before"></button>
      <div class="page">
        <button>1</button>
        <button>2</button>
        <button>3</button>
        <button>4</button>
      </div>
      <button class="arrow_next"></button>
    </div>
  </section>


</main>


<?php include ('footer.php'); ?>