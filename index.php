<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

// считаем время до полуночи
$ts_midnight = strtotime('tomorrow');
$secs_to_midnight = $ts_midnight - time();
$hours = floor($secs_to_midnight / 3600);
$minutes = floor(($secs_to_midnight % 3600) / 60);
$time_counter = $hours.'ч. '.$minutes.'м.';
$one_hours = 60*60;

if($one_hours <= $ts_midnight){
	$timer_finishing = "timer--finishing";
}

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, (SELECT COUNT(bet.id) FROM bet WHERE bet.lot_id = l.lot_id) lot_count FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id WHERE l.date_finish > NOW() ORDER BY l.lot_id DESC';
    $sql_cat = 'SELECT * FROM category';       
    //$sql_bet = 'SELECT id, COUNT(*) as cont_bet FROM bet GROUP BY lot_id';
  
	if (($res_lot = mysqli_query($link, $sql_lot)) and ($res_cat = mysqli_query($link, $sql_cat))) 
    {
        $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
        $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);	
        //$res_bet = mysqli_query($link, $sql_bet)	
		//$bets = mysqli_fetch_all($res_bet, MYSQLI_ASSOC);

        $page_content = include_template('index_tpl.php', ['lots' => $lots, 'category' => $category, 'time_counter' => $time_counter, 'timer_finishing' =>$timer_finishing]);  
    }
    else {
        print mysqli_error($link);
    }

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);
}
