<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <? 
                foreach ($category as $cat_element) {
                    print "<li class='promo__item promo__item--".$cat_element['code']."'><a class='promo__link' href='pages/all-lots.html'>".$cat_element['name']."</a></li>";
                }
            ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
        	<?foreach ($lots as $lot) 
        		{
                   $elements = include_template('element_tpl.php', ['lot' => $lot, 'time_counter' => $time_counter]); 
                    print $elements;
	            }?>            
        </ul>
    </section>
</main>