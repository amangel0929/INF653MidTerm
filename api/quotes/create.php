<?php

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    //Get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    $quote->id = $data->data->id;
    $quote->quote = $data->quote;
    $quote->author_id = $data->author_id;
    $quote->category_id = $data->category_id;


    if($quote->create()) {
        $message = array("message" => "Quote Created");
        echo json_encode($message);
    } else {
        $message = array("message" => "No Quotes Found");
        echo json_encode($message);
    }
?>