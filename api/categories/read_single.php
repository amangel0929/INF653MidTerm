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

    //Make json
    print_r(json_encode($category_arr));

?>
