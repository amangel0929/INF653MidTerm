<?php
    //Headers
    header('Access-Control-Allow-Origin:*');
    header('Content-Type:application/json');

    include_once '../../config/';
    include_once '../../models/';

    $database = new Database();
    $db = $database->connect();

    $quote = new Quote($db);

    //Get ID
    $quote->id = isset($_GET['id']) ? $_GET['id'] : die();

    //Get quote
    $quote->read_single();

    //Create array
    $quote_arr = array(
        'id' => $quote->id,
        'quote' => $quote->quote,
        'category_id' =>$quote->category_id,
        'author_id' =>$quote->author_id
    );

    //Make json
    print_r(json_encode($quote_arr));

?>