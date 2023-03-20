<?php
    //Headers
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');
    header('Access-Control-Allow-Origin:PUT');
    header('Access-Control-Allow-Origin:Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once '../../config/';
    include_once '../../models/';

    $database = new Database();
    $db = $database->connect();

    $category = new Category($db);

    //Get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    //Set ID to update
    $category->id = $data->id;

    $category->category = $data->category;


    if($category->update()) {
        $message = array("message" => "Category Updated");
        echo json_encode($message);
    } else {
        $message = array("message" => "category_id Not Found");
        echo json_encode($message);
    }
?>