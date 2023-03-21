<?php


    include '../../config/Database.php';
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
        'category' => $category->category,
        'id' => $category->id
    );

    //Make json
    print_r(json_encode($category_arr));

?>
