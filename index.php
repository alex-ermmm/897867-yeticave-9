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

if($one_hours >= $ts_midnight){
	$timer_finishing = "timer--finishing";
}

$page_content = include_template('index_tpl.php', ['items' => $items, 'category' => $category, 'time_counter' => $time_counter, 'timer_finishing' => $timer_finishing]);

$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);

