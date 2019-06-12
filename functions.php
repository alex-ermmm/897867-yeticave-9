<?php
/**
 * Разделяет группы символов если цена больше 1000 руб.
 * добавляет в конце знак троеточия
 * @param string $cat_price Значение цены
 * @return string Отформатированная цена
*/
function price ($cat_price){
    ceil($cat_price);
    if ($cat_price < 1000){
            echo $cat_price." &#x20bd;";
            return;
        }
    elseif ($cat_price >= 1000 ){
        	echo number_format($cat_price, 0, ',', ' ')." &#x20bd;";
        	return;
        }
}
/**
 * Функция форматирует дату к формату дд.мм.гг в чч:мм
 * @param string $bet_date Значение даты
 * @return string Отформатированная дата
*/
function time_format ($bet_date){
	$bet_time = date("H:i", strtotime($bet_date));
	$bet_day = date("d.m.y", strtotime($bet_date));
	$bet_date = $bet_day." в ".$bet_time;
	return $bet_date;
}
/**
 * Функция форматирует дату к формату: чч:мм           
 * @param string $bet_date Значение даты
 * @return string Отформатированная дата
*/
function time_bet_finish ($bet_date){
	$ts_midnight = strtotime($bet_date);
	$secs_to_midnight = $ts_midnight - time();
	$hours = floor($secs_to_midnight / 3600);
	$minutes = floor(($secs_to_midnight % 3600) / 60);	
	if ($hours < 0) {
		return "Торги окончены";
	}
	else{
		return "$hours:$minutes";
	}
}
/**
 * Функция проверяет сколько врменени осталось до даты окончания лота           
 * и выводит строку CSS стиля если больше часа то timer--end если меньше то timer--finishing
 * @param string $timer_finishing Значение даты
 * @return string Отформатированная дата
*/
function timer_finishing ($timer_finishing){
	$ts_midnight = strtotime($timer_finishing);
	$secs_to_midnight = $ts_midnight - time();
	$hours = floor($secs_to_midnight / 3600);
	if ($hours < 0){
		return "timer--end";
	}
	if (1 >= $hours){
		return "timer--finishing";
	}
}

/**
 * 
 * @param type $link - линк базы данных
 * @param type $sql - подготовленный запрос
 * @return array|boolean массив всех записей или false 
 */
function db_fetch_all($link, $sql)
{
    if (($res_querry = mysqli_query($link, $sql))) {
        $result = mysqli_fetch_all($res_querry, MYSQLI_ASSOC);
        return $result;
    } 

    if (mysqli_errno($link) > 0) {
        $errorMsg = 'Не удалось получить ответ из mysql: ' . mysqli_error($link);
        die($errorMsg);
    }
    return false;
}