<?php

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->author = $data->author;


    if($author->create()) {
        $message = array("message" => "Author Created");
        echo json_encode($message);
    } else {
        $message = array("message" => "author_id Not Found");
        echo json_encode($message);
    }
?>