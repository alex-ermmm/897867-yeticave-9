<div class="container">
      <section class="lots">
        <h2>Все лоты в категории <span>«<?=$name_cat;?>»</span></h2>
        <ul class="lots__list">
         <?foreach ($lots as $lot) 
            {
              $elements = include_template('element_tpl.php', ['lot' => $lot, 'name_cat' => $name_cat, 'timer_finishing' => $timer_finishing]); 
              print $elements;
            }
            ?>          
        </ul>
      </section>
      <ul class="pagination-list">
        <?echo $page_pagination;?>
      </ul>
    </div>