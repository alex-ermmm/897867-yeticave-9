<div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span><?if(isset($search)) print strip_tags($search);?></span>»</h2>       
        <ul class="lots__list">
          <?foreach($search_lot as $result):?>
          <li class="lots__item lot">
            <div class="lot__image">
              <img src="<?if(isset($result['image'])) print strip_tags($result['image']);?>" width="350" height="260" alt="<?if(isset($result['name'])) print strip_tags($result['name'])?>">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?if(isset($result['cat_name'])) print strip_tags($result['cat_name']);?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?if(isset($result['lot_id'])) print strip_tags($result['lot_id'])?>"><?=strip_tags($result['name'])?></a></h3>
              <div class="lot__state">
                <div class="lot__rate">
                  <span class="lot__amount">Стартовая цена</span>
                  <span class="lot__cost"><?if(isset($result['start_price'])) print strip_tags(price($result['start_price']));?></span>
                </div>
                <div class="lot__timer timer">
                  <?if(isset($result['date_finish'])) print strip_tags(time_bet_finish($result['date_finish']));?>
                </div>
              </div>
            </div>
          </li>
          <?endforeach;?>
        </ul>
      </section>
    <?if(isset($pagination)) print $pagination;?>
  </div>