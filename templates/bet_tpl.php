<tr class="history__item">
    <td class="history__name"><?php if(isset($bet['user_name'])) print strip_tags($bet['user_name']);?></td>
    <td class="history__price"><?php if(isset($bet['price'])) print strip_tags(price($bet['price']));?></td>
    <td class="history__time"><?php if(isset($bet['bet_date'])) print strip_tags(time_format($bet['bet_date']));?></td>
</tr>