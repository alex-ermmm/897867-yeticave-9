<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

$page_content = include_template('index_tpl.php', ['items' => $items, 'category' => $category, 'time_counter' => $time_counter, 'timer_finishing' => $timer_finishing]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);

