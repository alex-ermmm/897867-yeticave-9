<ul class="pagination-list">
  <li class="pagination-item pagination-item-prev">
  	<?if((isset($_GET['page'])) and ($_GET['page']>1)):?> 
  		<a href="/<?if(isset($start_link)) print $start_link;?>=<?if(isset($get_search)) print $get_search;?>&page=<?=$_GET['page']-1;?>">Назад</a>
  	<?else:?>
  	<a>Назад</a>
  	<?endif;?>
  </li>
  <?php if ($pages_count > 1): ?>
    <?php foreach ($pages as $page): ?>
      <li class="pagination-item <?php if ($page == $_GET['page']): ?>pagination__item--active<?php endif; ?>">
          <a href="/<?=$start_link;?>=<?=$get_search?>&page=<?=$page;?>"><?=$page;?></a>
      </li>
    <?php endforeach; ?>      
<?php endif; ?>
<li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
</ul>