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
        $page_content = include_template('signup_tpl.php', ['lots' => $lots, 'category' => $category, 'error' => $error]);  
    }
    else {
        print mysqli_error($link);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
    	
    	$form_array = $_POST['signup'];

    	$required = ['email', 'password', 'name'];
    	$dict = ['email' => 'e-mail', 'password' => 'Пароль', 'name' => 'Имя', 'email' => 'Пользователь'];
        $error = [];

        foreach ($required as $key) {
                if (empty($form_array[$key])){
                   $error[$key] = ' Это поле надо заполнить';
                }                
            }
        
        if(filter_var(($form_array['email']), FILTER_VALIDATE_EMAIL) == false)
            {
            	$error['email'] = 'Не верный формат';
            }

        if (empty($error)) 
	        { 
		        $email = mysqli_real_escape_string($link, $form_array['email']);
		        $sql = "SELECT user_id FROM user WHERE email = '$email'";
		        $res = mysqli_query($link, $sql);

		        if (mysqli_num_rows($res) > 0) 
		        {
		            $error['email'] = 'Пользователь с этим email уже зарегистрирован';
		        }
		        else{
		        	$password = password_hash($form_array['password'], PASSWORD_DEFAULT);
		        	$sql = 'INSERT INTO user (regestration_date, email, name, password) VALUES (NOW(), ?, ?, ?)';
		        	$stmt = db_get_prepare_stmt($link, $sql, [$form_array['email'], $form_array['name'], $password]);
		        	$res = mysqli_stmt_execute($stmt);
		        }
		        if ($res && empty($errors)) {
		            header("Location: login.php");
		            exit();
		        }
	    	}
    }

$page_content = include_template('signup_tpl.php', ['dict' => $dict, 'error' => $error]);  

$layout_content = include_template('layout_pages.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave',
    'is_auth' => $is_auth,
    'user_name' => $user_name
]);

print($layout_content);
}