<ul class="pagination-list">
  <li class="pagination-item pagination-item-prev"><a>Назад</a></li>
  <?php if ($pages_count > 1): ?>
    <?php foreach ($pages as $page): ?>
      <li class="pagination-item <?php if ($page == $cur_page): ?>pagination__item--active<?php endif; ?>">
          <a href="/search.php?page=<?=$page;?>"><?=$page;?></a>
      </li>
    <?php endforeach; ?>      
<?php endif; ?>
<li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
</ul>