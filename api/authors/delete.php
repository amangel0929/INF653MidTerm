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

    //Delete author
    if($author->delete()) {
        $message = array("message" => "Author Deleted");
        echo json_encode($message);
    } else {
        $message = array("message" => "author_id Not Found");
        echo json_encode($message);
    }
?>