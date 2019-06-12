<div class="container">
      <section class="lots">
        <h2>Все лоты в категории <span>«<?if(isset($name_cat)) print $name_cat;?>»</span></h2>
        <ul class="lots__list">
         <?foreach ($lots as $lot) 
            {
              $elements = include_template('element_tpl.php', ['lot' => $lot, 'name_cat' => $name_cat]); 
              print $elements;
            }
            ?>          
        </ul>
      </section>
      <ul class="pagination-list">
        <?if(isset($page_pagination)) print($page_pagination);?>
      </ul>
    </div>