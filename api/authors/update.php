<?php

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    //Set ID to update
    $author->id = $data->id;

    $author->author = $data->author;


    if($author->update()) {
        $message = array("message" => "Author Updated");
        echo json_encode($message);
    } else {
        $message = array("message" => "Missing Required Parameters");
        echo json_encode($message);
    }
?>