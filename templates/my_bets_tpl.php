<section class="rates container">
      <h2>Мои ставки</h2>
      <table class="rates__list">
        <? foreach ($bets as $bet):?>
          <tr class="rates__item 
              <?if(strtotime($bet['date_fin']) < strtotime(date("Y-m-d H:i:s"))) echo "rates__item--end";?>
              <?if($bet['win_user_id'] == $_SESSION['user']['user_id']) echo "rates__item--win";?>">
            <td class="rates__info">
              <div class="rates__img">
                <img src="<?=$bet['image'];?>" width="54" height="40" alt="<?=$bet['name'];?>">
              </div>
              <h3 class="rates__title"><a href="lot.php?lot_id=<?=$bet['lot_id'];?>"><?=$bet['name'];?></a></h3>
            </td>
            <td class="rates__category">
              <?=$bet['cats_name'];?>
            </td>
            <td class="rates__timer">
              <div class="timer <?=timer_finishing($bet['date_fin']);?>">
                <?=time_bet_finish($bet['date_fin']);?></div>
            </td>
            <td class="rates__price">
              <?=price($bet['price']);?>
            </td>
            <td class="rates__time">
              <?=$bet['bet_date'];?>
            </td>
          </tr>
        <?endforeach;?>       
      </table>
    </section>