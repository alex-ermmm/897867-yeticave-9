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


            $required = ['title', 'category', 'description',  'start_price', 'step-lot', 'date-finish'];
            $dict = ['title' => 'Название', 'category' => 'Категория', 'description' => 'Описание', 'start_price' => 'Начальная цена', 'step-lot' => 'Шаг ставки', 'date-finish' => 'Дата окончания торгов', 'image_type' => 'Изображение', 'no_file' => 'Изображение'];
            $errors = [];

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

                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $file_type = finfo_file($finfo, $tmp_name);
                
                if (($file_type !== "image/png") or ($file_type !== "image/jpg") or ($file_type !== "image/jpeg"))
                {
                    $error['image_type'] = 'Загрузите картинку в формате нужном формате: jpg, jpeg, png';
                }
                else {
                    move_uploaded_file($tmp_name, 'uploads/' . $path);
                    $add_lot['path'] = $path;
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
                $page_content = "все ок. тут будет форма показа загруженного лота";
                $layout_content = include_template('layout_pages.php', [
                'page_content' => $page_content,
                'category' => $category,
                'title' => 'YetiCave лот.',
                'is_auth' => $is_auth,
                'user_name' => $user_name
                ]);
                print($layout_content);
            }

        }
        else {
            print "REQUEST_METHOD = POST. НЕТ";
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