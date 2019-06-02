<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, l.date_finish FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id WHERE l.date_finish > NOW() ORDER BY l.lot_id DESC';
    $sql_cat = 'SELECT * FROM category';  
    $sql_bet = 'SELECT bet_date, price, bet.user_id, bet.lot_id, lot.name, lot.image, lot.date_finish AS date_fin, lot.category_id, (SELECT name FROM category WHERE lot.category_id = category.category_id) cats_name FROM `bet` JOIN lot ON bet.lot_id = lot.lot_id WHERE user_id = '.$_SESSION['user']['user_id'].' ORDER BY bet_date DESC';
       
      
	if (($res_bet = mysqli_query($link, $sql_bet)) and ($res_lot = mysqli_query($link, $sql_lot)) and ($res_cat = mysqli_query($link, $sql_cat))) 
    {
        $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
        $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);	
        $bets = mysqli_fetch_all($res_bet, MYSQLI_ASSOC);    
        
       

        $page_content = include_template('my_bets_tpl.php', ['lots' => $lots, 'bets' => $bets, 'category' => $category]);  
        
       
    }
    else {
        print mysqli_error($link);
    }

$layout_content = include_template('layout_pages.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'Мои ставки',
]);

print($layout_content);
}
