<?php
    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: DELETE');
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

    //Delete quote
    if($quote->delete()) {
        $message = ["message" => 'Quote Deleted']
        echo json_encode($message);
    } else {
        $message = ["message" => 'No Quotes Found']
        echo json_encode($message);
    }
?>