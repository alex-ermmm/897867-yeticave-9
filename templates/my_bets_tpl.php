<section class="rates container">
      <h2>Мои ставки</h2>
      <table class="rates__list">
        <? foreach ($bets as $bet):?>
          <tr class="rates__item <?if(strtotime($bet['date_fin']) < strtotime(date("Y-m-d H:i:s"))) echo "rates__item--end";?>">
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
        
        <tr class="rates__item rates__item--win">
          <td class="rates__info">
            <div class="rates__img">
              <img src="../img/rate3.jpg" width="54" height="40" alt="Крепления">
            </div>
            <div>
              <h3 class="rates__title"><a href="lot.html">Крепления Union Contact Pro 2015 года размер L/XL</a></h3>
              <p>Телефон +7 900 667-84-48, Скайп: Vlas92. Звонить с 14 до 20</p>
            </div>
          </td>
          <td class="rates__category">
            Крепления
          </td>
          <td class="rates__timer">
            <div class="timer timer--win">Ставка выиграла</div>
          </td>
          <td class="rates__price">
            10 999 р
          </td>
          <td class="rates__time">
            Час назад
          </td>
        </tr>        
      </table>
    </section>