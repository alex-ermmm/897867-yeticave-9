<?php
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