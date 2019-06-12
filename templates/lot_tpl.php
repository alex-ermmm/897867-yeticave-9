<?
  foreach ($lots as $lot) 
    {?>
    <section class="lot-item container">
      <h2><?if(isset($lot['name'])) print strip_tags($lot['name']);?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="<?=$lot['image'];?>" width="730" height="548" alt="<?=$lot['name'];?>">
          </div>
            
          <p class="lot-item__category">Категория: <span><?if(isset($lot['cat_name'])) print strip_tags($lot['cat_name']);?></span></p>
          <p class="lot-item__description"><?if(isset($lot['description'])) print strip_tags($lot['description']);?></p>
        </div>
        <div class="lot-item__right">
          <?if((isset($_SESSION['user'])) and ($lot['date_finish'] > date("Y-m-d H:m:s")) and ($lot['autor_id'] !== $_SESSION['user']['user_id'])  and ($last_bet_user !== $_SESSION['user']['user_id'])):?>
          
          <div class="lot-item__state">            
            <div class="lot-item__timer timer <?if(isset($lot['date_finish'])) print timer_finishing($lot['date_finish']);?>">
               <?if(isset($lot['date_finish'])) print time_bet_finish($lot['date_finish']);?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?if(isset($last_bet)) print strip_tags(price($last_bet));?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?if(isset($min_bet)) print strip_tags(price($min_bet));?></span>
              </div>
            </div>
            <form class="lot-item__form" action="lot.php?lot_id=<?=$lot['lot_id'];?>" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <? if(isset($error['bet']['cost'])) : print "form__item--invalid"; endif;?>">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="bet[cost]" placeholder="<?if(isset($min_bet)) print strip_tags(price($min_bet));?>" value="<?if(isset($_POST['bet']['cost'])) print $_POST['bet']['cost'];?>">
                <?php if (isset($error['bet']['cost'])): ?>
                  <span class="form__error"><?=$error['bet']['cost'];?></span>
                <?php endif ?>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
          </div>
          <?endif;?>
          <div class="history">
            <h3>История ставок (<?if(isset($bets)) print count($bets);?>)</h3>
            <table class="history__list">
              <?foreach ($bets as $bet) 
              {
                  $elements = include_template('bet_tpl.php', ['bet' => $bet]); 
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