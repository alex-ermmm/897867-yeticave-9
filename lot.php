<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

if ($link === false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    if ((isset($_GET['lot_id'])) and (filter_var(($_GET['lot_id']), FILTER_VALIDATE_INT)))
        {
            $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.description, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, l.date_finish FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id  WHERE lot_id ='.$_GET['lot_id']; 
            $sql_bet = 'SELECT bet_date, price, bet.user_id, lot_id, user.name AS user_name FROM bet  JOIN user ON user.user_id = bet.user_id   WHERE lot_id = "'.$_GET['lot_id'].'" ORDER BY bet_date DESC';
            $sql_cat = 'SELECT * FROM category';                       
        	

            if ($res_lot = mysqli_query($link, $sql_lot))
            {
                $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
                if (empty($lots)){
	                    $sql_cat = 'SELECT * FROM category';
				        if($res_cat = mysqli_query($link, $sql_cat)){
				            $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);
				            $page_content = include_template('404_tpl.php');
				        }
				            $layout_content = include_template('layout_pages.php', [
				            'page_content' => $page_content,
				            'category' => $category,
				            'title' => 'Просмотр лота'
				        ]);
				        print($layout_content);
                }
                else{

		            if (($res_bet = mysqli_query($link, $sql_bet)) and ($res_cat = mysqli_query($link, $sql_cat))) 
		            {		                
		                $bets = mysqli_fetch_all($res_bet, MYSQLI_ASSOC);
		                $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);	
		            }
		            else {
		                print mysqli_error($link);
		            }
	            }
            }
            
            else {
                print mysqli_error($link);                
            }

		arsort($bets);

	    if(!empty($bets)){
		    $last_bet = $bets['0']['price'];
		    $last_bet_user = $bets['0']['user_id'];
	    }
	    else{
	    	$last_bet_user = NULL;
	    }
	    

		$start_price = $lots['0']['start_price'];
		$min_step_lot = $lots['0']['step_lot'];

    	if(!isset($last_bet)) {
		       	$last_bet = $lots['0']['start_price'];
		       	$min_bet = $min_step_lot + $start_price;
	    }
	    else{      
	    	$min_bet = $min_step_lot + $last_bet;
	    }

        if (
        		($_SERVER['REQUEST_METHOD'] === 'POST') and 
        		(filter_var(($_POST['bet']['cost']), FILTER_VALIDATE_INT) !== false) and 
        		((filter_var(($_POST['bet']['cost']), FILTER_VALIDATE_INT) >= ($start_price + $min_step_lot)) and
        		(($last_bet + $lots['0']['step_lot']) <= $_POST['bet']['cost']))
        	) 
			{
				$required = ['cost'];
	            $dict = ['cost' => 'Ставка'];
	            $error = [];


		    	foreach ($required as $key) {
		            if (empty($_POST['bet'][$key])){
		               $error[$key] = ' Это поле надо заполнить';
		            }                
		         }

	        	$sql = 'INSERT INTO bet (bet_date, price, user_id, lot_id) 
	        			VALUES (NOW(), ?, ?, ?)';
	            $stmt = db_get_prepare_stmt($link, $sql, [$_POST['bet']['cost'], $_SESSION['user']['user_id'], $lots['0']['lot_id']]);
	            $res = mysqli_stmt_execute($stmt);

	            if ($res) {
		            $lot_id = mysqli_insert_id($link);
		            header("Location: lot.php?lot_id=".$lots['0']['lot_id']);	            
		        	}
			    else {
			            $content = include_template('error.php', ['error' => mysqli_error($link)]);
			    }
	        }
	        elseif ($_SERVER['REQUEST_METHOD'] === 'POST')  
	        {	        	
	        	$error['bet']['cost'] = 'Ввели не верное значение';
	        }
	        $page_content = include_template('lot_tpl.php', ['lots' => $lots, 'last_bet_user' => $last_bet_user, 'min_bet' => $min_bet, 'last_bet' => $last_bet, 'bets' => $bets, 'category' => $category]); 
	        $layout_content = include_template('layout_pages.php', [
	            'page_content' => $page_content,
	            'category' => $category,
	            'title' => 'Просмотр лота'
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
	            'title' => 'Просмотр лота'
	        ]);
	        print($layout_content);
	    }
	}