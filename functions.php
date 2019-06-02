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

function time_format ($bet_date)
{
	$bet_time = date("H:i", strtotime($bet_date));
	$bet_day = date("d.m.y", strtotime($bet_date));
	$bet_date = $bet_day." в ".$bet_time;
	print $bet_date;
}

function time_bet_finish ($bet_date)
{
	$ts_midnight = strtotime($bet_date);
	$secs_to_midnight = $ts_midnight - time();
	$hours = floor($secs_to_midnight / 3600);
	$minutes = floor(($secs_to_midnight % 3600) / 60);	
	if ($hours < 0) {
		echo "Торги окончены";
	}
	else{
		print("$hours:$minutes");
	}
}

function timer_finishing ($timer_finishing)
{
	$ts_midnight = strtotime($timer_finishing);
	$secs_to_midnight = $ts_midnight - time();
	$hours = floor($secs_to_midnight / 3600);
	//$one_hours = 60*60;
	if ($hours < 0)
	{
	echo "timer--end";
	}
	elseif (1 >= $hours)
	{
		print("timer--finishing");
	}
}
