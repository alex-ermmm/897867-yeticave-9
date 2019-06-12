<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное снаряжение.</p>
        <ul class="promo__list">
            <?foreach ($category as $cat_element):?>
                    <li class="promo__item promo__item--<?if(isset($cat_element['code'])) print $cat_element['code'];?>"><a class='promo__link' href="category.php?cat_id=<?if(isset($cat_element['category_id'])) print $cat_element['category_id'];?>"><?if(isset($cat_element['name'])) print $cat_element['name'];?></a></li>
                <?endforeach;?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
        </div>
        <ul class="lots__list">
        	<?foreach ($lots as $lot) 
        		{
                   $elements = include_template('element_tpl.php', ['lot' => $lot]); 
                    print $elements;
	            }
            ?>     

        </ul>
    </section>
</main>