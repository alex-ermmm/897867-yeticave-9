<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');
require_once('data.php');
require_once ('../../vendor/autoload.php');
require_once ('getwinner.php');


if ($link === false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, l.date_finish, (SELECT COUNT(bet.id) FROM bet WHERE bet.lot_id = l.lot_id) lot_count FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id WHERE l.date_finish > NOW() ORDER BY l.lot_id DESC';
    $sql_cat = 'SELECT * FROM category';       
    
    $lots=db_fetch_all($link, $sql_lot);
    $category = db_fetch_all($link, $sql_cat);
    $page_content = include_template('index_tpl.php', ['lots' => $lots, 'category' => $category]); 

	

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave',
]);

print($layout_content);
}
