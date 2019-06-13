<?php
  foreach ($lots as $lot) 
    {?>
    <section class="lot-item container">
      <h2><?php if(isset($lot['name'])) print strip_tags($lot['name']);?></h2>
      <div class="lot-item__content">
        <div class="lot-item__left">
          <div class="lot-item__image">
            <img src="<?=$lot['image'];?>" width="730" height="548" alt="<?=$lot['name'];?>">
          </div>
            
          <p class="lot-item__category">Категория: <span><?php if(isset($lot['cat_name'])) print strip_tags($lot['cat_name']);?></span></p>
          <p class="lot-item__description"><?php if(isset($lot['description'])) print strip_tags($lot['description']);?></p>
        </div>
        <div class="lot-item__right">
          <?php if((isset($_SESSION['user'])) and ($lot['date_finish'] > date("Y-m-d H:m:s")) and ($lot['autor_id'] !== $_SESSION['user']['user_id'])  and ($last_bet_user !== $_SESSION['user']['user_id'])):?>
          
          <div class="lot-item__state">            
            <div class="lot-item__timer timer <?php if(isset($lot['date_finish'])) print timer_finishing($lot['date_finish']);?>">
               <?php if(isset($lot['date_finish'])) print time_bet_finish($lot['date_finish']);?>
            </div>
            <div class="lot-item__cost-state">
              <div class="lot-item__rate">
                <span class="lot-item__amount">Текущая цена</span>
                <span class="lot-item__cost"><?php if(isset($last_bet)) print strip_tags(price($last_bet));?></span>
              </div>
              <div class="lot-item__min-cost">
                Мин. ставка <span><?php if(isset($min_bet)) print strip_tags(price($min_bet));?></span>
              </div>
            </div>
            <form class="lot-item__form" action="lot.php?lot_id=<?=$lot['lot_id'];?>" method="post" autocomplete="off">
              <p class="lot-item__form-item form__item <?php  if(isset($error['bet']['cost'])) : print "form__item--invalid"; endif;?>">
                <label for="cost">Ваша ставка</label>
                <input id="cost" type="text" name="bet[cost]" placeholder="<?php if(isset($min_bet)) print strip_tags(price($min_bet));?>" value="<?php if(isset($_POST['bet']['cost'])) print $_POST['bet']['cost'];?>">
                <?php if (isset($error['bet']['cost'])): ?>
                  <span class="form__error"><?=$error['bet']['cost'];?></span>
                <?php endif ?>
              </p>
              <button type="submit" class="button">Сделать ставку</button>
            </form>
          </div>
          <?php endif;?>
          <div class="history">
            <h3>История ставок (<?php if(isset($bets)) print count($bets);?>)</h3>
            <table class="history__list">
              <?php foreach ($bets as $bet) 
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
<?php 
}
?>