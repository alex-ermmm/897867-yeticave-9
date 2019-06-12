<tr class="history__item">
    <td class="history__name"><?if(isset($bet['user_name'])) print strip_tags($bet['user_name']);?></td>
    <td class="history__price"><?if(isset($bet['price'])) print strip_tags(price($bet['price']));?></td>
    <td class="history__time"><?if(isset($bet['bet_date'])) print strip_tags(time_format($bet['bet_date']));?></td>
</tr>