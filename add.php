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
    }
    else {
        print mysqli_error($link);
    }

       if (($_SERVER['REQUEST_METHOD'] == 'POST') and (array_key_exists("lot", $_POST))) {

            $add_lot = $_POST;
            $add_lot_image = $_FILES;

            $required = ['title', 'category_id', 'description',  'start_price', 'step_lot', 'date_finish'];
            $dict = ['title' => 'Название', 'category_id' => 'Категория', 'description' => 'Описание', 'start_price' => 'Начальная цена', 'step_lot' => 'Шаг ставки', 'date_finish' => 'Дата окончания торгов', 'image_type' => 'Изображение', 'no_file' => 'Изображение'];
            $error = [];

            foreach ($required as $key) {
                if (empty($_POST['lot'][$key])){
                   $error[$key] = ' Это поле надо заполнить';
                }                
            }

            if (empty($_FILES['image']['name'])) 
            {
                $error['no_file'] = 'Вы не загрузили файл';                
            }
            else 
            {
                $tmp_name = $_FILES['image']['tmp_name'];
                $path = $_FILES['image']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
               // echo $ext;
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $file_type = finfo_file($finfo, $tmp_name);
                
                if ($file_type !== "image/png")
                {
                    $error['image_type'] = 'Загрузите картинку в формате нужном формате: jpg, jpeg, png';
                }
                else {
                	$add_lot = $_POST['lot'];

					$filename = uniqid() . '.png';

                	$add_lot['image'] = $filename;
                    move_uploaded_file($_FILES['image']['tmp_name'], 'uploads/' . $filename);
                    $img_link = "uploads/".$filename;

                    $sql = 'INSERT INTO lot (date_create, name, description, image, start_price, date_finish, step_lot, autor_id, category_id) VALUES (NOW(), ?, ?, ?, ?, ?, ?, 1, ?)';
                    $stmt = db_get_prepare_stmt($link, $sql, [$add_lot['title'], $add_lot['description'], $img_link, $add_lot['start_price'], $add_lot['date_finish'], $add_lot['step_lot'], $add_lot['category_id']]);
                    $res = mysqli_stmt_execute($stmt);

                    if ($res) {
			            $lot_id = mysqli_insert_id($link);
			            header("Location: lot.php?lot_id=" . $lot_id);
			            print $lot_id;
			        	}
				        else {
				            $content = include_template('error.php', ['error' => mysqli_error($link)]);
				        }
                } 
            }

            if (count($error)) 
            {
                $page_content = include_template('lot_add_tpl.php', ['add_lot' => $add_lot, 'error' => $error, 'dict' => $dict, 'lots' => $lots, 'category' => $category]);
                $layout_content = include_template('layout_pages.php', [
                'page_content' => $page_content,
                'category' => $category,
                'title' => 'YetiCave. Ошибки в форме.',
                'is_auth' => $is_auth,
                'user_name' => $user_name
                ]);
                print($layout_content);
            }
            
            else 
            {
                $page_content = include_template('lot_tpl.php', ['lots' => $lots, 'bets' => $bets, 'category' => $category]); 
		        $layout_content = include_template('layout_pages.php', [
		            'page_content' => $page_content,
		            'category' => $category,
		            'title' => $lot['name'],
		            'is_auth' => $is_auth,
		            'user_name' => $user_name
		        ]);
		        print($layout_content);
		        }

        }
        else {
            $page_content = include_template('lot_add_tpl.php', ['lots' => $lots, 'category' => $category]); 
            $layout_content = include_template('layout_pages.php', [
            'page_content' => $page_content,
            'category' => $category,
            'title' => 'YetiCave. Форма добавления лота',
            'is_auth' => $is_auth,
            'user_name' => $user_name
        ]);

        print($layout_content);
        }
    }