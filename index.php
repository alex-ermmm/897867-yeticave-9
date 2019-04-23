<?php
require_once('helpers.php');
//require_once('functions.php');
require_once('data.php');

function price ($cat_price)
{
    ceil($cat_price);
    if ($cat_price < 1000)
        {
            echo $cat_price." &#x20bd;";
        }
    elseif ($cat_price >= 1000 ) 
        {
        echo number_format($cat_price, 0, ',', ' ')." &#x20bd;";
        }

}

$page_content = include_template('index_tpl.php', ['items' => $items, 'category' => $category]);
$menu_bottom = include_template('menu_bottom_tpl.php', ['category' => $category]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    //'categories' => $categories,
    'menu_bottom' => $menu_bottom,
    'title' => 'YetiCave',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);
