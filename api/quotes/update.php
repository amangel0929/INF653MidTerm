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

    $quote = new Quote($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //Set ID to update
    $quote->id = $data->id;

    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;


    if($quote->update()) {
        echo json_encode(
            array('message' => 'Quote Updated')
        );
    } else {
        echo json_encode(
            array('message' => 'No Quotes Found')
        );
    }
?>