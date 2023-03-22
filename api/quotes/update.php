<?php

    include_once '../../config/Database.php';
    include_once '../../models/Quote.php';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    //Get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    //Set ID to update
    $quote->id = $data->id;

    $quote->quote = $data->quote;
    $quote->category_id = $data->category_id;
    $quote->author_id = $data->author_id;

    if($quote->update()) {
        $result = $quote_arr = array(
            'id' => $quote->id,
            'quote' => $quote->quote,
            'category_id' => $quote->category_id,
            'author_id' => $quote->author_id
        );
        echo json_encode($result);
    } else {
        $message = array("message" => "No Quotes Found");
        echo json_encode($message);
    }
?>