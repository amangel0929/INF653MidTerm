<?php


    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    //Get ID
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get author
    $category->read_single();

    //Create array
    $category_arr = array(
        'id' => $category->id,
        'category' => $category->category
    );

    if($category_arr['category'] == false || is_null($category_arr['category'])){
        echo json_encode(
            array('message' => 'category_id Not Found')
          );
    } else{
        print_r(json_encode($category_arr));
    }
?>
