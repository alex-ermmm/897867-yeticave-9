<tr class="history__item">
    <td class="history__name"><?=strip_tags($bet['user_name']);?></td>
    <td class="history__price"><?=strip_tags(price($bet['price']));?></td>
    <td class="history__time"><?=strip_tags(time_format($bet['bet_date']));?></td>
</tr>