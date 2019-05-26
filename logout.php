<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, l.date_finish, (SELECT COUNT(bet.id) FROM bet WHERE bet.lot_id = l.lot_id) lot_count FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id WHERE l.date_finish > NOW() ORDER BY l.lot_id DESC';
    $sql_cat = 'SELECT * FROM category';       
      
	if (($res_lot = mysqli_query($link, $sql_lot)) and ($res_cat = mysqli_query($link, $sql_cat))) 
    {
        $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
        $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);	
        
    }
    else {
        print mysqli_error($link);
    }

$_SESSION = [];
header("Location: /index.php");

$layout_content = include_template('layout_pages.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave'
]);

print($layout_content);
}
