<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    if (isset($_GET['lot_id']))
        {
            $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.description, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, l.date_finish FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id  WHERE lot_id ='.$_GET['lot_id']; 
            $sql_bet = 'SELECT bet_date, price, bet.user_id, lot_id, user.name AS user_name FROM bet  JOIN user ON user.user_id = bet.user_id   WHERE lot_id = "'.$_GET['lot_id'].'" ORDER BY bet_date DESC';
            $sql_cat = 'SELECT * FROM category'; 
                      
        	if (($res_lot = mysqli_query($link, $sql_lot)) and ($res_bet = mysqli_query($link, $sql_bet)) and ($res_cat = mysqli_query($link, $sql_cat))) 
            {
                $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
                $bets = mysqli_fetch_all($res_bet, MYSQLI_ASSOC);
                $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);	

                $page_content = include_template('lot_tpl.php', ['lots' => $lots, 'bets' => $bets, 'category' => $category]);  
            }
            else {
                print mysqli_error($link);
            }

        $layout_content = include_template('layout_pages.php', [
            'page_content' => $page_content,
            'category' => $category,
            'title' => $lot['name'],
            'is_auth' => $is_auth,
            'user_name' => $user_name
        ]);

        print($layout_content);
    }
    else{
        $sql_cat = 'SELECT * FROM category';
        if($res_cat = mysqli_query($link, $sql_cat)){
            $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);
            $page_content = include_template('404_tpl.php');
        }
            $layout_content = include_template('layout_pages.php', [
            'page_content' => $page_content,
            'category' => $category,
            'title' => $lot['name'],
            'is_auth' => $is_auth,
            'user_name' => $user_name,
        ]);
        print($layout_content);
       // print "Ошибка 404. Элемент не найден";

    }
}
