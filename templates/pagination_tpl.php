<ul class="pagination-list">
  <li class="pagination-item pagination-item-prev">
  	<?php if((isset($_GET['page'])) and ($_GET['page']>1)):?> 
    <a href="/<?php if(isset($start_link)) print $start_link;?>=<?php if(isset($get_search)) print $get_search;?>&page=<?php =$_GET['page']-1;?>">Назад</a>
    <?php else:?>
     <a>Назад</a>
   <?php endif;?>
 </li>
 <?php if ($pages_count > 1): ?>
  <?php foreach ($pages as $page): ?>
    <li class="pagination-item <?php if ($page === $_GET['page']): ?>pagination__item--active<?php endif; ?>">
      <a href="/<?=$start_link;?>=<?=$get_search?>&page=<?=$page;?>"><?=$page;?></a>
    </li>
  <?php endforeach; ?>      
<?php endif; ?>
<li class="pagination-item pagination-item-next"><a href="#">Вперед</a></li>
</ul>