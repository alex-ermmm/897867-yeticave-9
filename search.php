<?php
require_once('helpers.php');
require_once('functions.php');
require_once('data.php');

if ($link === false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    $sql_lot = 'SELECT cat.name AS cat_name, l.name, l.lot_id, l.image, l.start_price, l.step_lot, l.autor_id, l.date_finish FROM lot l RIGHT JOIN category cat ON cat.category_id = l.category_id WHERE l.date_finish > NOW() ORDER BY l.lot_id DESC';
    $sql_cat = 'SELECT * FROM category';       
      
	if (($res_lot = mysqli_query($link, $sql_lot)) and ($res_cat = mysqli_query($link, $sql_cat))) 
    {
        $lots = mysqli_fetch_all($res_lot, MYSQLI_ASSOC);
        $category = mysqli_fetch_all($res_cat, MYSQLI_ASSOC);	
        
    }
    else {
        print mysqli_error($link);
    }  
    
    $search = $_GET['search'] ?? '';

    if ($search) {        

        $cur_page = $_GET['page'] ?? 1;
        $page_items = 9;
        $search_lot = [];

        mysqli_query($link, 'CREATE FULLTEXT INDEX lot_search ON lot(name, description)');

        $result_page =  "SELECT COUNT(*) as counter, lot_id, date_create, lot.name, description, image, start_price, date_finish, step_lot, lot.category_id, category.name as cat_name FROM lot JOIN category ON category.category_id = lot.category_id  WHERE MATCH (lot.name, lot.description) AGAINST(?)";
        
        $stmtp = db_get_prepare_stmt($link, $result_page, [$search]);
        mysqli_stmt_execute($stmtp);
        $result_count = mysqli_stmt_get_result($stmtp);
        $search_lot = mysqli_fetch_all($result_count, MYSQLI_ASSOC); 
         
        $items_count = $search_lot['0']['counter'];

        $pages_count = ceil($items_count / $page_items);
        $offset = ($cur_page - 1) * $page_items;

        $pages = range(1, $pages_count);
        $start_link = "search.php?search";
        $get_search = $_GET['search'];  

        $sql = "SELECT lot_id, date_create, lot.name, description, image, start_price, date_finish, step_lot, lot.category_id, category.name as cat_name FROM lot JOIN category ON category.category_id = lot.category_id  WHERE MATCH (lot.name, lot.description) AGAINST(?) LIMIT ".$page_items." OFFSET ".$offset;
        $stmt = db_get_prepare_stmt($link, $sql, [$search]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $search_lot = mysqli_fetch_all($result, MYSQLI_ASSOC); 
    }


    if (empty($search_lot)) {
        $not_found = "Ничего не найдено по вашему запросу"; 
        $page_content =  include_template('search_no_found_tpl.php', ['search' => $search, 'not_found' => $not_found]);
    }
    else{

        $pagination = include_template('pagination_tpl.php', ['pages' => $pages, 'pages_count' => $pages_count, 'cur_page' => $cur_page,'start_link' => $start_link, 'get_search' => $get_search]); 
      //  print_r($search_lot);
        $page_content = include_template('search_tpl.php', ['search_lot' => $search_lot, 'search' => $search, 'pagination' => $pagination]);
    }

    

$layout_content = include_template('layout_pages.php', [
    'page_content' => $page_content,
    'category' => $category,
    'title' => 'YetiCave',
]);

print($layout_content);
}
