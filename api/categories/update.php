<?php
    include '../../config/Database.php';
    include_once '../../models/Category.php';

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
        $message = array("message" => "Missing Required Parameters");
        echo json_encode($message);
    }
?>