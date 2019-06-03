<ul class="pagination-list">
  <li class="pagination-item pagination-item-prev">
  	<?if($_GET['page']>1):?> 
  		<a href="search.php?search=<?=$_GET['search']?>&page=<?=($_GET['page']-1);?>">Назад</a>
  	<?else:?>
  	<a>Назад</a>
  	<?endif;?>
  </li>
  <?php if ($pages_count > 1): ?>
    <?php foreach ($pages as $page): ?>
      <li class="pagination-item <?php if ($page == $_GET['page']): ?>pagination__item--active<?php endif; ?>">
          <a href="/search.php?search=<?=$_GET['search']?>&page=<?=$page;?>"><?=$page;?></a>
      </li>
    <?php endforeach; ?>      
<?php endif; ?>
<li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
</ul>