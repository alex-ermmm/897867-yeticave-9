<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

if ($link === false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, l.date_finish, (SELECT COUNT(bet.id) FROM bet WHERE bet.lot_id = l.lot_id) lot_count FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id WHERE l.date_finish > NOW() ORDER BY l.lot_id DESC';
    $sql_cat = 'SELECT * FROM category';       
      
	if (($res_lot = mysqli_query($link, $sql_lot)) and ($res_cat = mysqli_query($link, $sql_cat))) 
    {
        $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
        $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);	
        
    }
    else {
        print mysqli_error($link);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {

        $form_array = $_POST['login'];

        $required = ['email', 'password'];
        $dict = ['email' => 'e-mail', 'password' => 'Пароль'];
        $error = [];

        foreach ($required as $key) {
                if (empty($form_array[$key])){
                   $error[$key] = 'Это поле надо заполнить';
                }                
            }

        if(filter_var(($form_array['email']), FILTER_VALIDATE_EMAIL) === false)
            {
                $error['email'] = 'Не верный формат';
            }
        
        $email = mysqli_real_escape_string($link, $form_array['email']);
        $sql = "SELECT * FROM user WHERE email = '$email'";
        $res = mysqli_query($link, $sql);

        $user = $res ? mysqli_fetch_array($res, MYSQLI_ASSOC) : null;

        if (!count($error) and $user) 
            {
                if (password_verify($form_array['password'], $user['password'])) 
                    {
                        $_SESSION['user'] = $user;
                    }
                else 
                    {
                        $error['password'] = 'Неверный пароль';
                    }
            }
        else 
            {
                $error['email'] = 'Такой пользователь не найден';
            }
        if (count($error)) 
            {
                $page_content = include_template('login_tpl.php', ['error' => $error]);
            }
    
        else
            {
                header("Location: /index.php");
                exit();
            }
    }
    else 
    {
        if (isset($_SESSION['user'])) 
        {
            header("Location: /index.php");
            exit();
        }
        else 
        {
            $page_content = include_template('login_tpl.php', ['lots' => $lots, 'category' => $category]); 
        }  

    }

$layout_content = include_template('layout_pages.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'Вход в личный кабинет'
]);

print($layout_content);
}
