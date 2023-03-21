<?php

    include_once '../../config/Database.php';
    include_once '../../models/Author.php';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $author->id = isset($_GET['id']) ? $_GET['id'] : die();
    $author->author = $data->author;


    if($author->create()) {
        $author_arr = array(
            'id' => $author->id,
            'author' => $author->author
        );
            print_r(json_encode($author_arr));
    } else {
        $message = array("message" => "author_id Not Found");
        echo json_encode($message);
    }
?>