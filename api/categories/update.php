<?php
    include_once '../../config/Database.php';
    include_once '../../models/Category.php';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    //Get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    //Set ID to update
    $category->id = $data->id;

    $category->category = $data->category;

    if($category->update()){
        $result = $author_arr = array(
            'id' => $category->id,
            'category' => $category->category
        );
        echo json_encode($result);
    }else{
        $message = array("message" => "category_id Not Found");
        echo json_encode($message);
    }
?>