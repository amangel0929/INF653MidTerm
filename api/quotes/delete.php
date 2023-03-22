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

    //Delete quote
    if($quote->delete() === true) {
        $quote_arr = array(
            'id' => $quote->id
        );
            print_r(json_encode($quote_arr));
    } else {
        $message = array("message" => "No Quotes Found");
        echo json_encode($message);
    }
?>