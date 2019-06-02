<?
  foreach ($lots as $lot) 
    {?>
    <section class="lot-item container">
      <h2><?=$lot['name'];?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="<?=$lot['image'];?>" width="730" height="548" alt="<?=$lot['name'];?>">
          </div>
            
          <p class="lot-item__category">Категория: <span><?=$lot['cat_name'];?></span></p>
          <p class="lot-item__description"><?=$lot['description'];?></p>
        </div>
        <div class="lot-item__right">
          <?if(isset($_SESSION['user'])):?>
          <div class="lot-item__state">            
            <div class="lot-item__timer timer <?=timer_finishing($lot['date_finish']);?>">
               <?=time_bet_finish($lot['date_finish']);?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?=price($last_bet);?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?=$min_bet?></span>
              </div>
            </div>
            <form class="lot-item__form" action="lot.php?lot_id=<?=$lot['lot_id'];?>" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <? if(isset($error['cost'])) : print "form__item--invalid"; endif;?>">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="bet[cost]" placeholder="12 000">
                <span class="form__error"><?=$error['cost'];?></span>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
          </div>
          <?endif;?>
          <div class="history">
            <h3>История ставок (<?=count($bets);?>)</h3>
            <table class="history__list">
              <?foreach ($bets as $bet) 
              {
                  $elements = include_template('bet_tpl.php', ['bet' => $bet, 'time_counter' => $time_counter, 'timer_finishing' => $timer_finishing]); 
                  print $elements;
              }

            ?>    
            </table>
          </div>
        </div>
      </div>
    </section>
<?
}
?>