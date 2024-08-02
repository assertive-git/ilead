<?php include ('header.php'); ?>

<main id="news_single">
  <section class="news">

    <div class="news_inner">
      <dl class="news_area">
        <span class="day"><?= substr(str_replace('-', '.', $news['created_at']), 0, 11) ?></span>
        <dt><span class="title"><?= $news['title'] ?></span></dt>
        <dd>
          <?= $news['body'] ?>
        </dd>
      </dl>
    </div>

    <div class="pagination">
      <?php if (!empty($news['prev_id'])): ?>
        <a href="/news/<?= $news['prev_id'] ?>"><button id="return" class="arrow_before">前の記事へ</button></a>
      <?php endif; ?>

      <?php if (!empty($news['next_id'])): ?>
        <a href="/news/<?= $news['next_id'] ?>"><button id="next" class="arrow_next">次の記事へ</button></a>
      <?php endif; ?>
    </div>
    <a href="/news" class="return_button">一覧へ戻る</a>
  </section>
</main>


<?php include ('footer.php'); ?>