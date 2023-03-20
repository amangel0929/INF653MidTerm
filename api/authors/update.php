<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: PUT');
    header('Access-Control-Allow-Origin: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once '../../config/';
    include_once '../../models/';

    $database = new Database();
    $db = $database->connect();

    $author = new Author($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $author->id = $data->id;

    $author->author = $data->author;


    if($author->update()) {
        echo json_encode(
            array('message' => 'Author Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'Author Not Updated'),
            JSON_FORCE_OBJECT
        );
    }
?>