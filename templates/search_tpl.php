<div class="container">
      <section class="lots">
        <h2>Результаты поиска по запросу «<span><?=$search?></span>»</h2>       
        <ul class="lots__list">
          <?foreach($search_lot as $result):?>
          <li class="lots__item lot">
            <div class="lot__image">
              <img src="<?=$result['image']?>" width="350" height="260" alt="Сноуборд">
            </div>
            <div class="lot__info">
              <span class="lot__category"><?=$result['cat_name']?></span>
              <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?=$result['lot_id']?>"><?=$result['name']?></a></h3>
              <div class="lot__state">
                <div class="lot__rate">
                  <span class="lot__amount">Стартовая цена</span>
                  <span class="lot__cost"><?=$result['start_price']?><b class="rub">р</b></span>
                </div>
                <div class="lot__timer timer">
                  <?=time_bet_finish($result['date_finish'])?>
                </div>
              </div>
            </div>
          </li>
          <?endforeach;?>
        </ul>
      </section>
    <?echo $pagination;?>
  </div>