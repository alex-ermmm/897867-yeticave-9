<section class="rates container">
  <h2>Мои ставки</h2>
  <table class="rates__list">
    <?php  foreach ($bets as $bet):?>
      <tr class="rates__item 
      <?php if((strtotime($bet['date_fin']) < strtotime(date("Y-m-d H:i:s"))) and ($bet['win_user_id'] !== $_SESSION['user']['user_id'])) echo "rates__item--end";?>
      <?php if($bet['win_user_id'] === $_SESSION['user']['user_id']) echo "rates__item--win";?>">
      <td class="rates__info">
        <div class="rates__img">
          <img src="<?=$bet['image'];?>" width="54" height="40" alt="<?=$bet['name'];?>">
        </div>
        <h3 class="rates__title"><a href="lot.php?lot_id=<?=$bet['lot_id'];?>"><?=strip_tags($bet['name']);?></a></h3>
        <?php if($bet['win_user_id'] === $_SESSION['user']['user_id']) echo "<p>".strip_tags($bet['user_contact'])."</p>";?>
      </td>
      <td class="rates__category">
        <?=strip_tags($bet['cats_name']);?>
      </td>
      <td class="rates__timer ">
        <div class="timer <?php 
        if(($bet['win_user_id'] === $_SESSION['user']['user_id'])) 
        echo "timer--win"; 
        elseif (((timer_finishing($bet['date_fin'])) ==='timer--finishing')) 
        echo 'timer--finishing'; 
        elseif (((timer_finishing($bet['date_fin'])) ==='timer--end')) 
        echo 'timer--end';
        ?>">

        <?php if((strip_tags(time_bet_finish($bet['date_fin'])) === 'Торги окончены') and ($bet['win_user_id'] === $_SESSION['user']['user_id'])) echo "Ставка выиграла"; else echo strip_tags(time_bet_finish($bet['date_fin']));?></div>
      </td>
      <td class="rates__price">
        <?php if(isset($bet['price'])) print strip_tags(price($bet['price']));?>
      </td>
      <td class="rates__time">
        <?php if(isset($bet['bet_date'])) strip_tags($bet['bet_date']);?>
      </td>
    </tr>
  <?php endforeach;?>       
</table>
</section>