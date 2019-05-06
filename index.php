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

$link = mysqli_connect("localhost", "root", "", "alexandr_yermakovich_yeticave");
mysqli_set_charset($link, "utf8");
 
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
	//получаем лоты
    $sql_lot = 'SELECT name, image, start_price FROM lot';
    $sql_cat = 'SELECT * FROM category';

    if (($res_lot = mysqli_query($link, $sql_lot)) and ($res_cat = mysqli_query($link, $sql_cat))) 
    {
        $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
        $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);

        $page_content = include_template('index_tpl.php', ['lots' => $lots, 'category' => $category, 'time_counter' => $time_counter]);
    }
    else {
        print mysqli_error($link);
    }
    /*
    //получаем категории
    $sql_cat = 'SELECT * FROM category';
    if ($res_cat = mysqli_query($link, $sql_cat)) {
        $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);
        $page_content = include_template('index_tpl.php', ['category' => $category]);
        echo $category['name'];
    }
    else {
        print mysqli_error($link);
    }*/
}




$layout_content = include_template('layout.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);

