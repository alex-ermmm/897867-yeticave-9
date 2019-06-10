<li class="lots__item lot">
<div class="lot__image">
    <img src="<?=$lot['image'];?>" width="350" height="260" alt="<?=$lot['name'];?>">
</div>
<div class="lot__info">
    <span class="lot__category"><?=$name_cat;?><?=$lot['cat_name'];?></span>
    <h3 class="lot__title"><a class="text-link" href="lot.php?lot_id=<?=$lot['lot_id'];?>"><?=strip_tags($lot['name']);?></a></h3>
    <div class="lot__state">
        <div class="lot__rate">
            <span class="lot__amount"><?if(strip_tags($lot['lot_count']) == 0) echo "Стартовая цена"; else echo strip_tags($lot['lot_count']). " ставок";?> </span>
            <span class="lot__cost"><?strip_tags(price($lot['start_price']));?></span>
        </div>
        <div class="lot__timer timer <?=strip_tags(timer_finishing($lot['date_finish']));?>">
           <?=time_bet_finish($lot['date_finish']);?>           
        </div>
    </div>
</div>
</li>