<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');


if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
        $sql_cat = 'SELECT * FROM category';       
          
        if ($res_cat = mysqli_query($link, $sql_cat))
            {
                $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);                   
            }
        else {
                print mysqli_error($link);
            }

        foreach ($category as $value) {
             if($_GET['cat_id'] == $value['category_id']){
              $cat_exist = TRUE;
              $id_cat = $_GET['cat_id'];
              $name_cat = $value['name'];
          }
        }


        if ((isset($_GET['cat_id'])) and (filter_var(($_GET['cat_id']), FILTER_VALIDATE_INT)) and ($cat_exist == TRUE)) 
        {   
            
            $page_items = 3;
            $sql_lot = 'SELECT * FROM lot WHERE category_id = '.$id_cat.'  ORDER BY lot_id DESC LIMIT ' . $page_items;
            
            if ($res_lot = mysqli_query($link, $sql_lot)){
                $arr_lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);               
            }
            else {
                print mysqli_error($link);
            }

            if(empty($arr_lots)) {
                 $error_mess = "В данной категории лоты отсутствуют";
                 $error_head = "Нет лотов";
                 $page_content = include_template('error_tpl.php', ['error_mess' => $error_mess, 'error_head' => $error_head]);
            }
            else {  
                $result = mysqli_query($link, "SELECT COUNT(*) as cnt FROM lot WHERE category_id = '.$id_cat.'  ORDER BY lot_id DESC");
                $cur_page = $_GET['page'] ?? 1;
                $items_count = mysqli_fetch_assoc($result)['cnt'];
                $pages_count = ceil($items_count / $page_items);
                $offset = ($cur_page - 1) * $page_items;
                $pages = range(1, $pages_count);

                $start_link = "category.php?cat_id";
                $get_search = $_GET['cat_id'];
                
                $sql = 'SELECT * FROM lot WHERE category_id = '.$id_cat.' LIMIT ' . $page_items . ' OFFSET ' . $offset;

                if ($lots = mysqli_query($link, $sql)) {
                    $page_content = include_template('category_tpl.php', ['lots' => $lots, 'page_pagination' => $page_pagination, 'category' => $category, 'name_cat' => $name_cat]);
                        $page_pagination = include_template('pagination_tpl.php', 
                            ['lots' => $lots,
                            'pages' => $pages,
                            'pages_count' => $pages_count,
                            'cur_page' => $cur_page,
                            'start_link' => $start_link,
                            'get_search' => $get_search
                        ]);
                    }
                    else {
                        show_error($page_content, mysqli_error($link));
                    }

                
            }
            $layout_content = include_template('layout_pages.php', [
            'page_content' => $page_content,
            'category' => $category,
            'title' => 'Вы в категории - '.$name_cat,
            ]);

            print($layout_content);
        }
        else
        {       
            $page_content = include_template('404_tpl.php');
            $layout_content = include_template('layout_pages.php', [
            'page_content' => $page_content,
            'category' => $category,
            'title' => "Ошибка 404. Старница не найдена",
        ]);
        print($layout_content);
     
    }


}
